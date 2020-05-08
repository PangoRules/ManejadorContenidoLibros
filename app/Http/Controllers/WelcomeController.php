<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\categorias;
use App\libros;
use App\versiones;
use App\UserRol\Models\Rol;
use Auth;

class WelcomeController extends Controller
{
   	function index(){
   		$user = Auth::user();
   		$rol = null;
   		if($user != null){
   			$rol = $user->rols->map->only('nombre')->toarray();
   			//$rol = $user->rols;	
   		}
   		// donde e
   		$categorias = categorias::get()->all();
   		$libros = libros::where("aceptado",true)->get()->all();
   		$pendientes = libros::where("aceptado",false)->get()->all();
   		$versiones = versiones::get()->all();

    	return view('welcome', compact('categorias', 'libros','pendientes','versiones', 'rol'));
    }
}
