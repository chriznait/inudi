<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\country;
use App\Models\department;
use App\Models\province;
use App\Models\district;
use App\Models\Course;
use App\Models\Registered;
use Illuminate\Http\Request;
use App\Http\Requests\PersonRequest;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $persons = Person::leftjoin('countries', 'countries.id', '=', 'people.idPais')
        ->leftjoin('departments', 'departments.id', '=', 'people.idDepartamento')
        ->leftjoin('provinces', 'provinces.id', '=', 'people.idProvincia')
        ->leftjoin('districts', 'districts.id', '=', 'people.idDistrito')
        ->orderBy('people.apellido', 'asc')
        ->get(['people.id',
        'people.nroDocumento as nroDocumento',
        'people.nombre',
        'people.apellido',
        'people.email',
        'people.telefono',
        'people.profesion',
        'departments.nombreDepartamento as departamento',
        'provinces.nombreProvincia as provincia',
        'districts.nombreDistrito as distrito']);
        //dd($persons->apellido);
        return view('person.index', 
            [
                'persons' => $persons,
            ]
        );
        /*$filterValue = $request->input('filterValue');
        $datos = Person::where(
            'nombre', 'like', "%$filterValue%"
        );*/

        //$persons = $datos->simplePaginate(10);

        //dd($persons);
        /*return view('person.index',
            [
                'persons' => $persons,
                'filterValue' => $filterValue,
            ]);*/
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('person.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $person = $request->all();
        Person::create($person);

        return redirect()->route('person.index')->with('success', 'Persona creada exitosamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        $persona = Person::find($person->id);
        $pais = country::find($persona->idPais);
        $departamento = department::find($persona->idDepartamento);
        $provincia = province::find($persona->idProvincia);
        $distrito = district::find($persona->idDistrito);
        $cursos = Registered::join('courses', 'courses.id', '=', 'registereds.idCurso')
        ->where('registereds.idPersona', '=', $persona->id)
        ->get(['courses.nombreCurso as nombreCurso',
            'courses.fechaInicio as fechaInicio',
            'courses.fechaFin as fechaFin',
            'registereds.id as id',
            'registereds.montoPagado as montoPagado',
            'registereds.fechaPago as fechaPago',
            'registereds.estado as estado',
            'registereds.codigoCertificado as codigoCertificado',
        ]);
        
        if ($distrito == null) {
            $distrito = new district();
            $distrito->nombreDistrito = 'No especificado';
        }
        //estado
        foreach ($cursos as $curso) {
            if ($curso->estado == 1) {
                $curso->estado = 'Inscrito';
            } else if ($curso->estado == 2) {
                $curso->estado = 'Matriculado';
            }
            else if ($curso->estado == 3) {
                $curso->estado = 'Aprobado';
            }
            else if ($curso->estado == 4) {
                $curso->estado = 'Certificado';
            }
            else if ($curso->estado == 5) {
                $curso->estado = 'Entregado';
            }
        }
        return view('person.show', 
            [
                'persona' => $persona,
                'pais' => $pais,
                'departamento' => $departamento,
                'provincia' => $provincia,
                'distrito' => $distrito,
                'cursos' => $cursos,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        //
    }
}
