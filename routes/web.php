<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\UserRol\Models\Rol;
use App\Mail\CorreoSubscriptor;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/libros', 'LibroController')->except(['index', 'create']);

Route::post('/nuevosub', 'EnviarCorreosController@nuevoSubscritor') -> name('nuevosub');

Route::get('/autor/{id}', 'WelcomeController@autores')->name('autores');
Route::get('/dar_permisos', 'WelcomeController@permisos')->name('permisos');
Route::get('/revocar_permisos', 'WelcomeController@revocar')->name('revocar');

Route::post('/nuevacat', 'WelcomeController@nuevacat')->name('nuevacat');

Route::get('/prueba', function(){
	//Mail::to('email@email.com')->send(new CorreoSubscriptor());

	return new CorreoSubscriptor();
});