<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Person;
use App\Models\country;
use App\Models\department;
use App\Models\Province;
use App\Models\District;
use App\Models\Registered;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CertificadoRequest;

// 0 ANULADO
// 1 registrado
// 2 matriculado
// 3 finalizo el curso
// 4 para certificado
// 5 certificado generado
// 6 certificado impreso
// 7 certificado firmado
// 8 certificado entregado


class CertificadoController extends Controller
{
    public function index()
    {
        $courses = Course::where('estado', '=', '1')->get()
        ->sortByDesc('id');

        return view('certificados.index', compact('courses'));
    }

    public function create()
    {
        return view('certificados.create');
    }

    public function store(CertificadoRequest $request)
    {
        $persona = $request->all();
        $idPersona = Person::create($persona)->id;
        
        $registered = new Registered;
        $registered->idCurso = $request['idCurso'];
        $registered->idPersona = $idPersona;
        $registered->montoPagado = $request['montoPagado'];
        $registered->fechaPago = $request['fechaPago'];
        $registered->idUsuario = 1;
        $registered->estado = 1;
        $registered->fechaInscripcion = date('Y-m-d');

        $registro = $registered->save();

        //return redirect()->route('certificados.')->with('success-registrado', 'Persona creada exitosamente');
        return redirect()->back()->with('success-registrado', 'Persona creada exitosamente') ;
        
    }

    public function update(Request $datos)
    {
        $array = array(
            'nombre' => $datos->nombre,
            'apellido' => $datos->apellido,
            'email' => $datos->email,
            'telefono' => $datos->telefono,
            'profesion' => $datos->profesion,
            'gradoAcademico' => $datos->gradoAcademico,
            'idPais' => $datos->idPais,
            'idDepartamento' => $datos->idDepartamento,
            'idProvincia' => $datos->idProvincia,
            'idDistrito' => $datos->idDistrito
        );
        $persona= Person::where('id', '=', $datos->idPersona)->update($array);

        $registro = array(
            'idPersona' => $datos->idPersona,
            'idCurso' => $datos->idCurso,
            'montoPagado' => $datos->montoPagado,
            'fechaPago' => $datos->fechaPago,
            'idUsuario' => 1,
            'estado' => 1,
            'fechaInscripcion' => date('Y-m-d')
        );
        $registroCurso = Registered::create($registro);
        //$persona::where('id', '=', $datos->idPersona)->update($datos->all());
        //dd($datos->all());
        return redirect()->back()->with('success-registrado', 'Datos Actualizados y registrado al curso exitosamente'); 
    }

    public function verificar(Request $request)
    {
        $dni = $request->input('dniVerificar');
        $idCurso = $request->input('idCurso');
        $datos = Person::where('nroDocumento', '=', $dni)->first();
        
        
        if ($datos == null)
        {
            $valor =0; //no existe el dni en la bd
            $datos = new Person();
            $datos->gradoAcademico=1;
            $datos->idPais=1;
            $datos->nroDocumento=$dni;
        }else{ //SI EXISTE EL DNI EN LA BD
            //$codProv = province::where('id', '=', $datos->idProvincia)->first();
            $registroCurso = Registered::where('idCurso', '=', $idCurso)
                ->where('idPersona', '=', $datos->id)->first();
            if ($registroCurso == null)
            {
                $valor =1; //existe el dni pero no esta registrado en el curso
            }else{
                $valor =2; //existe el dni y esta registrado en el curso
                if ($registroCurso->estado == 2)
                {
                    $valor =3; //existe el dni y esta registrado en el curso y esta pagado
                }
                if ($registroCurso->estado == 3)
                {
                    $valor =4; //el estudiante aprobo el curso
                }
                if ($registroCurso->estado == 4)
                {
                    $valor =5; //se genero su certificado
                }
            }
            
        }

        $curso = Course::where('id', '=', $idCurso)->first();
        $pais = country::All();
        $departamento = department::where('idPais', '=', $datos->idPais)->get();
        $provincia = Province::where('idDepartamento', '=', $datos->idDepartamento)->get();
        $distrito = District::where('idProvincia', '=', $datos->idProvincia)->get();
        return view('certificados.inscripcion', ['datos' => $datos,
            'pais' => $pais,
            'valor' => $valor,
            'departamento' => $departamento,
            'provincia' => $provincia,
            'distrito' => $distrito,
            'idCurso' => $idCurso,
            'curso' => $curso,
        ]);
    }

    

    public function getDepartamento($id)
    {
        $departamento = department::where('idPais', '=', $id)->get();
        return response()->json($departamento);
    }

    public function getProvincia($id)
    {
        $provincia = Province::where('idDepartamento', '=', $id)->get();
        return response()->json($provincia);
    }

    public function getDistrito($id)
    {
        $cod = Province::where('id', '=', $id)->first();
        $codProv = $cod->codigoProvincia;
        $distrito = District::where('idProvincia', '=', $codProv)->get();
        return response()->json($distrito);
    }

    public function buscar(Request $request)
    {
        $dni = $request->input('dniBuscar');
        //dd($request->all());
        $datos = Person::where('nroDocumento', '=', $dni)->first();
        if ($datos == null)
        {
            $valor =0; //no existe el dni en la bd
            $certificados = null;
        }else{ //SI EXISTE EL DNI EN LA BD

            $certificados = DB::table('registereds')
            ->select('registereds.*', 'courses.nombreCurso')
            ->join('courses', 'registereds.idCurso', '=', 'courses.id')
            ->where('registereds.idPersona', '=', $datos->id)
            ->get();

            $valor =1; //existe el dni pero no esta registrado en el curso
        }
        //dd($datos);
        return view('certificados.buscar', ['datos' => $datos,
            'valor' => $valor,
            'certificados' => $certificados,
            'dniBuscar' => $dni,
        ]);
    }
    //VER CERTIFICADO DE UNA PERSONA
    
    public function ver($rutaArchivo)
    {
        $rutaCompleta = storage_path('storage/app/public/certificados/'.$rutaArchivo);

        if (file_exists($rutaCompleta)) {
            return response()->file($rutaCompleta);
        } else {
            abort(404, 'El archivo no existe');
        }
    }

    //ADMIN PARA ENVIAR CERTIFICADO DE UNA PERSONA QUE YA ESTA REGISTRADA
        
    public function certificadoIndex()
    {
        $courses = Course::where('estado', '=', '1')->get()
        ->sortByDesc('id');
        foreach ($courses as $course) {
            $course->registered = Registered::where('idCurso', '=', $course->id)
            ->where('estado', '>=', '5')
            ->count();
        }

        return view('certificados.certificadoIndex', [
            'courses' => $courses,
        ]);
    }

    public function verLista($id)
    {
    
        $course = Course::find($id);
        $registered = Registered::join('people', 'people.id', '=', 'registereds.idPersona')
        ->where('registereds.idCurso', '=', $id)
        ->wherein('registereds.estado', [5,6,7,8])
        ->get(
            [
                'registereds.id',
                'registereds.idPersona',
                'registereds.idCurso',
                'registereds.estado',
                'registereds.nota',
                'registereds.codigoCertificado',
                'people.nombre',
                'people.apellido',
                'people.nroDocumento',
                'people.email',
                'people.telefono',
                
            ]
        );
        $total = Registered::where('idCurso', '=', $id)
        ->where('estado', '>=', '5')
        ->get()->count();
        //dd($course->id);
        //dd($registered);
        return view('certificados.verLista', [
            'curso' => $course,
            'inscritos' => $registered,
            'total' => $total
        ]);
    }

    public function uploadCertificado(Request $request)
    {
        $id = $request->input('idRegistro');
        $certificado = Registered::find($id);
        
        if ($request->hasFile('pdfFirma')) {
            $file = $request->file('pdfFirma');
            $nombre = $certificado->codigoCertificado.'.pdf';

            //dd($nombre);
            if ($file->getClientOriginalExtension() != 'pdf') {
                return redirect()->back()->with('error', 'El archivo no es un PDF');
            }
            elseif(file_exists(public_path('certificados/'.$certificado->codigoCertificado))){
                return redirect()->back()->with('error', 'El archivo ya existe');
            }else{
                $file->move(public_path('certificados'), $nombre);
                $certificado->codigoCertificado = $certificado->codigoCertificado;
                $certificado->estado = 7;
            }

            $certificado->save();
            
            return redirect()->route('mail.sendCertificado', $id)->with('success', 'Se subio el certificado exitosamente');

        }else {
            return redirect()->back()->with('error', 'No se ha seleccionado un archivo');
        }
        
    }

    public function download($id)
    {
        $certificado = Registered::find($id);
        $rutaCompleta = public_path('certificados/'.$certificado->codigoCertificado.'.pdf');
        if (file_exists($rutaCompleta)) {
            return response()->file($rutaCompleta);
            //return $pdf->download($codigo.'.pdf');
        } else {
            abort(404, 'El archivo no existe');
        }
    }

}
