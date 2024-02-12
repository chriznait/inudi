<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registered;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $courses = Course::where('estado', '=', '1')->orderBy('id', 'desc')->get();
        foreach ($courses as $course) {
            $course->registered = Registered::where('idCurso', '=', $course->id)
            ->where('estado', '=', '2')
            ->count();
        }

        return view('courses.index', [
            'courses' => $courses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        //dd($request->all());
        $course = $request->all();
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $name = time().$file->getClientOriginalName();
            $course['imagen'] = $name;
            $file->move(public_path().'/cursos/', $name);
        }
        Course::create($course);

        return redirect()->route('courses.index')->with('success', 'Curso creado exitosamente');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //dd($course);
        return view('courses.edit', compact('course'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {

        //dd($request->hasFile('imagen'));
        //$course = $request->all();
        //dd($request->id);
        //dd($course['id']);
        $nombreImg = Course::find($request->id);
        //dd($nombreImg->imagen);
        if ($request->hasFile('imagen')) {
            //dd($request->hasFile('imagen'));
            if(file_exists(public_path().'/cursos/'.$nombreImg->imagen) and !empty($nombreImg->imagen)){
            unlink(public_path().'/cursos/'.$nombreImg->imagen);
            //$request->imagen = '';
            
            }
            //dd($request->all());
            $file = $request->file('imagen');
            $name = time().$file->getClientOriginalName();
            //dd($course);
            $request->imagen = $name;
            $file->move(public_path().'/cursos/', $name);
            //dd($course);
            
        }else{
            $request->imagen = $nombreImg->imagen;
        }

        $course->update($request->all());
        $course->update(['imagen' => $request->imagen]);


        return redirect()->route('courses.index')->with('success-update', 'Curso actualizado exitosamente');
    }

    public function show(Course $course)
    {
        $course = $course->id;
        return redirect()->route('registered.index', ['id' => $course]);
        //return redirect()->action([RegisteredController::class, 'index', ['id' => 1]]);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->update(['estado' => '0']);
        return redirect()->route('courses.index')->with('success-delete', 'Curso eliminado exitosamente');

    }
}
