<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\categorias;
use App\libros;
use App\versiones;

class WelcomeController extends Controller
{
   	function index(){
   		$categorias = categorias::get()->all();
   		$libros = libros::where("aceptado",true)->get()->all();
   		$pendientes = libros::where("aceptado",false)->get()->all();
   		$versiones = versiones::get()->all();
    	return view('welcome', compact('categorias', 'libros','pendientes','versiones'));
    }
}
