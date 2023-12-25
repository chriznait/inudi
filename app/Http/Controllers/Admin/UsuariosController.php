<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('Admin/usuarios', compact('users'));
    }

    public function create()
    {
        //return "hola";
        view('Admin/create');
    }

    public function crear(){
        return view('Admin/crear');
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->get('name'); //name es el name del input
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        //$user->tipo = $request->get('tipo');
        $user->save();
        return redirect('admin/usuarios');
    }

}
