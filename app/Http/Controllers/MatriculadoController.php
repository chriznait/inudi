<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registered;
use App\Models\Course;
use App\Models\Person;
use App\Http\Controllers\CourseController;
use App\Http\Requests\MatriculadoRequest;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

// 0 ANULADO
// 1 registrado
// 2 matriculado
// 3 finalizo el curso
// 4 para certificado
// 5 certificado generado
// 6 certificado impreso
// 7 certificado firmado
// 8 certificado entregado


class MatriculadoController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::where('estado', '=', '1')->orderBy('id', 'desc')->get();
        foreach ($courses as $course) {
            $course->registered = Registered::where('idCurso', '=', $course->id)
            ->where('estado', '>=', '2')
            ->count();
        }

        return view('matriculados.index', [
            'courses' => $courses,
        ]);
        
    }

    public function show($id)
    {
        $course = Course::find($id);
        $registered = Registered::join('people', 'people.id', '=', 'registereds.idPersona')
        ->where('registereds.idCurso', '=', $id)
        ->wherein('registereds.estado', [2,3,4,5])
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
        ->where('estado', '=', '2')
        ->get()->count();
        //dd($course->id);
        //dd($registered);
        return view('matriculados.show', [
            'curso' => $course,
            'inscritos' => $registered,
            'total' => $total
        ]);
    }

    public function subirCertificado(MatriculadoRequest $request)
    {
        $course = Course::find($request->idCursoMat);
        
        if($request->hasFile('imgCertificado')){
            $file = $request->file('imgCertificado');
            $name = time().$file->getClientOriginalName();
            $course->imgCertificado = $name;
            $file->move(public_path().'/img/modCertificado/', $name);
        }
        $course->nomEjeX = $request->posXNombre;
        $course->nomEjeY = $request->posYNombre;
        $course->notaEjeX = $request->posXNota;
        $course->notaEjeY = $request->posYNota;
        $course->codigoEjeX = $request->posXCodigo;
        $course->codigoEjeY = $request->posYCodigo;
        //dd($request->All());
        $course->save();
        return redirect()->route('matriculado.index')->with('success', 'Certificado subido exitosamente');
        
    }

    public function export($id)
    {
        $course = Course::find($id);
        $registered = Registered::where('idCurso', '=', $id)
        ->where('estado', '=', '2')
        ->get();
        $pdf = PDF::loadView('matriculados.modeloCertificado', 
        [
            'course' => $course,
            'inscritos' => $registered,]
        );
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('certificado.pdf');
    }

    public function editCertificado($id)
    {
        $estudiante = Registered::find($id);
        $persona = Person::find($estudiante->idPersona);
        //dd($id);
        return response()->json([
            'estudiante' => $estudiante,
            'persona' => $persona,
            'status' => 200
        ]);
    }

    public function updateCertificado(Request $request)
    {
        $id = $request->idRegistro;
        $inicio = 1000;
        $registro = Registered::find($id);
        $registro->nota = $request->nota;
        //dd($registro);
        if($request->certificado == 1)
            $registro->estado = 4;
        else
            $registro->estado = 3;
        $codigo = $inicio+$id;
        $registro->codigoCertificado = $codigo;
        $registro->save();
        
        return back()->with('success', 'Certificado generado exitosamente');

    }

    public function download($id)
    {
        $registered = Registered::find($id);
        $persona = Person::find($registered->idPersona);
        $course = Course::find($registered->idCurso);
        $codigo = $registered->codigoCertificado;
        
        $registered->estado = 5;
        $registered->save();

        $pdf=PDF::loadView('matriculados.download', [
            'registered' => $registered,
            'persona' => $persona,
            'course' => $course,
            'codigo' => $codigo,
        ]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download($codigo.'.pdf');
    }

    public function generarCertificado(Request $request)
    {
        $id = $request->idCurso;
        $inicio = 1000;
        $registros = Registered::where('idCurso', '=', $id)
        ->where('estado', '=', '2')
        ->get();
        //dd($registros);
        foreach($registros as $registered){
            $registered->estado = 4;
            $registered->nota = $request->nota;
            $codigo = $inicio+$registered->id;
            $registered->codigoCertificado = $codigo;
            $registered->save();
        }
        //dd($registered);
        return back()->with('generado', 'Certificado generado exitosamente');
        
    }

}
