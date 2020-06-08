@extends('layouts.app')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet" id="bootstrap-css">
@section('estilos')

@endsection

@section('content')
{{-- Mensaje de aviso que dejo de funcionar por algún motivo raro --}}
@if(session()->has('mensajeExitoLibro'))
    <br>
        <div class="alert alert-success">
            <div class="container h6">
                {{ session()->get('mensajeExitoLibro') }}
            </div>
        </div>
    <br>
@endif
{{-- Revisa que el usuario se haya identificado con el sistema --}}
@if(Auth::user())
    <div class="container text-center">
        <h1>Bienvenido {{ Auth::user()->name }}</h1>
    </div>
    {{-- Revisa si el usuario tiene el rol de Autor para mostrar el boton para proponer contenido --}}
    @if($rol[0]["nombre"] == 'Autor')
        <div class="container mt-4 mb-5">
            <button type="button" onclick="mostrarForm()" class="btn btn-primary">Proponer contenido</button>
        </div>
    {{-- Si no, muestra las opciones del difusor (el usuario esta identificado pero su rol no es autor) --}}
    @else
        <div class="container text-center">
            <div class="row mt-5">
                <div class="col-4">
                    <h3>Autores</h3>
                </div>
                <div class="col-8">
                    <h3>Acciones</h3>
                </div>
            </div>            
            <div class="row mt-2 mb-5">
                {{-- Lista los autores registrados en el sistema --}}
                <div class="col-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        @foreach($autores as $autor)
                            @if($loop->first)
                                <a class="list-group-item list-group-item-action active primis" data-idQuery="{{ $autor->id }}" id="lA{{ $autor->id }}" data-toggle="list" href="#l{{ $autor->id }}" role="tab" aria-controls="home">{{ $autor->name }}</a>
                            @else
                                <a class="list-group-item list-group-item-action" data-idQuery="{{ $autor->id }}" id="lA{{ $autor->id }}" data-toggle="list" href="#l{{ $autor->id }}" role="tab" aria-controls="home">{{ $autor->name }}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
                {{-- Lista los permisos que se pueden otorgar o revocar por cada autor --}}
                <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="col">
                            <h6>Secciones permitidas: </h6>
                        </div>
                        @foreach($categorias as $categoria)
                            <div class="col totalCat">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" class="checkBCat" data-idCat="{{ $categoria->id }}" aria-label="Checkbox for following text input">
                                        </div>
                                    </div>
                                    <input type="text" class="form-control textBCat" id="textB{{ $categoria->id }}" aria-label="Text input with checkbox" readonly="true" value="{{ $categoria->nombre_cat }}">
                                </div>
                            </div>
                        @endforeach
                                {{--  <div class="tab-pane fade show active" id="l{{ $autor->id }}" role="tabpanel" aria-labelledby="Herramientas{{ $autor->id }}">asdf</div>--}}
                    </div>
                </div>
                {{-- Boton para registrar nueva seccion --}}
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNuevaSección">Nueva Sección</button>
            </div>
        </div>
    @endif
@else
    {{-- Indica que el usuario actual no se ha identificado frente al sistema --}}
    <div class="container text-center">
        <h1>Bienvenido Anonimo</h1>
    </div>
@endif    
{{-- Logica para el llenado de las categorias --}}
<div class="container card text-center">
    {{-- Llenando las categorias en las navs --}}
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            @foreach($categorias as $categoria)
                {{-- Revisa que las categorias no tengan dependencia --}}
                @if(is_null($categoria->catPadre))
                     <input name="categoriasPadre" style="visibility: hidden; display: none" value="{{ $categoria->id }}">
                    {{-- Si es uno, hablamos de lirico, el que se debe mostrar por defecto --}}
                    @if( $categoria->id <= 1)
                        <li class="activo nav-item main-nav-item" id="{{ $categoria->id }}">
                            <a class="nav-link" href="#">{{ $categoria->nombre_cat }}</a>
                        </li>
                    @else
                    {{-- Si no, se llena lo demás --}}
                    <li class="nav-item main-nav-item" id="{{ $categoria->id }}">
                        <a class="nav-link" href="#">{{ $categoria->nombre_cat }}</a>
                    </li>
                    @endif
                @else
                    <input name="categoriasHija" nombre="{{ $categoria->nombre_cat }}" padres="{{ $categoria->catPadre }}" style="visibility: hidden; display: none" value="{{ $categoria->id }}">
                @endif
            @endforeach
        </ul>
    </div>
    {{-- Llenando las sub-categorias en las navs --}}
    <div class="card-body">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    @foreach($categorias as $categoria)
                        {{-- Analiza que la categoría tenga dependencia (no sea padre) --}}
                        @if($categoria->catPadre > 0)
                            {{-- Si es 1 tiene que activar esos primeros dado que pertenece a la categoría padre que se muestra por defecto al cargar la pagina --}}
                            @if($categoria->catPadre == 1)
                                <li class="nav-item nav-item-sub" nombCat="{{ $categoria->nombre_cat }}" idChildCat="{{ $categoria->id }}" id="{{ $categoria->catPadre }}" data-iden2="{{ $categoria->catPadre }}{{ $categoria->id }}">
                                    <a class="nav-link" href="#">{{ $categoria->nombre_cat }}</a>
                                </li>
                            @else
                            {{-- Si no, llena las demás --}}
                            <li class="nav-item oculto nav-item-sub" nombCat="{{ $categoria->nombre_cat }}" idChildCat="{{ $categoria->id }}" id="{{ $categoria->catPadre }}" data-iden2="{{ $categoria->catPadre }}{{ $categoria->id }}">
                                <a class="nav-link" href="#">{{ $categoria->nombre_cat }}</a>
                            </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </div>
            {{-- Programación para hacer funcionar las "cards" de los libros--}}
            <div class="card-body">
                <div class="row mt-2">
                    @foreach($libros as $libro)
                        {{-- Muestra cada libro de una categoría <6 porque son los primeros que muestro, las obras liricas y sus subcategorias--}}
                        @if($libro->idcategoria <= 6)
                            @foreach($categorias as $cate)
                                @if($cate->id == $libro->idcategoria)
                                    <div class="col-4 libros" id="{{ $libro->idcategoria }}" nombreLib="{{ $libro->nombre }}" nombreCat="{{ $cate->nombre_cat }}">
                                    <div class="card-header">
                                        Agregado el {{ $libro->fagregado }}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{ $libro->nombre }}
                                        </h5>
                                        <h6 class="card-subtitle">
                                            {{ $libro->autor }}
                                        </h6>
                                        <p class="card-text">
                                            {{ $libro->descripcion }}
                                        </p>
                                        <p class="card-text"><small class="text-muted">Ultima actualización: {{ $libro->actualizado }}</small></p>
                                        @if(auth()->check())
                                            {{-- Opciones que se mostraran dependiendo si es autor, difusor o anonimo el usuario --}}
                                            @if($rol[0]["nombre"] == 'Autor')
                                                <form method="POST" action="{{ route('libros.destroy', $libro->id) }}">
                                                    @csrf   
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Borrar</button>
                                                </form>
                                                <button type="button" data-toggle="modal" data-libroiden="{{ $libro->id }}" data-titulo="{{ $libro->nombre }}" data-descripcion="{{ $libro->descripcion }}" data-target="#edit" class="btn btn-success">Editar</button>
                                            @elseif($rol[0]["nombre"] == 'Difusor')

                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Versiones
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        @foreach($versiones as $version)
                                                            @if($version->idlibro == $libro->id)
                                                                <a data-nombreLibro="{{ $version->nombre }}" data-descLibro="{{ $version->descripcion }}" data-verLibro="{{ $version->version }}.0" data-toggle="modal" data-target="#modalVersion" class="dropdown-item" href="#">{{ $version->version }}.0</a>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <button data-titulo="{{ $libro->nombre }}" data-toggle="modal" data-target="#modalSubscribirse" class="btn btn-primary">
                                                SUBSCRIBIRSE
                                            </button>
                                        @endif
                                    </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                        {{-- Muestra cada libro de las categorias faltantes--}}
                            @foreach($categorias as $cate)
                                @if($cate->id == $libro->idcategoria)
                                    <div class="col-4 libros oculto" nombreLib="{{ $libro->nombre }}" id="{{ $libro->idcategoria }}" nombreCat="{{ $cate->nombre_cat }}">
                                <div class="card-header">
                                    Agregado el {{ $libro->fagregado }}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $libro->nombre }}
                                    </h5>
                                    <h6 class="card-subtitle">
                                        {{ $libro->autor }}
                                    </h6>
                                    <p class="card-text">
                                        {{ $libro->descripcion }}
                                    </p>
                                    <p class="card-text"><small class="text-muted">Ultima actualización: {{ $libro->actualizado }}</small></p>
                                    {{-- Opciones que se mostraran dependiendo si es autor, difusor o anonimo el usuario --}}
                                    @if(auth()->check())
                                        @if($rol[0]["nombre"] == 'Autor')
                                            <form method="POST" action="{{ route('libros.destroy', $libro->id) }}">
                                                @csrf   
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Borrar</button>
                                            </form>
                                            <button type="button" data-libroiden="{{ $libro->id }}" data-titulo="{{ $libro->nombre }}" data-descripcion="{{ $libro->descripcion }}" data-toggle="modal" data-target="#edit" class="btn btn-success">Editar</button>
                                        @elseif($rol[0]["nombre"] == 'Difusor')

                                        <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownVersions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Versiones
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownVersions">
                                                    @foreach($versiones as $version)
                                                        @if($version->idlibro == $libro->id)
                                                            <a data-nombreLibro="{{ $version->nombre }}" data-descLibro="{{ $version->descripcion }}" data-verLibro="{{ $version->version }}.0" data-toggle="modal" data-target="#modalVersion" class="dropdown-item" href="#">{{ $version->version }}.0</a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <button data-titulo="{{ $libro->nombre }}" data-toggle="modal" data-target="#modalSubscribirse" class="btn btn-primary">
                                            SUBSCRIBIRSE
                                        </button>
                                    @endif
                                </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif 
                    @endforeach
                </div>                  
            </div>
        </div>
    </div>
</div>
{{-- Se revisa que la persona loggeada sea el difusor para mostrar los pendientes que tiene por aceptar o negar --}}
    @if(auth()->check())
        @if($rol[0]["nombre"] == 'Difusor')
            <h2 class="text-center">PENDIENTES</h2>
            <div class="container">
                <div class="row">
                    <div class="col-4 text-center">
                        @foreach($pendientes as $pendiente)
                            <div class="card-header">
                                Agregado el {{ $pendiente->fagregado }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $pendiente->nombre }}
                                </h5>
                                <h6 class="card-subtitle">
                                    {{ $pendiente->autor }}
                                </h6>
                                <p class="card-text">
                                    {{ $pendiente->descripcion }}
                                </p>
                                <p class="card-text"><small class="text-muted">Ultima actualización: {{ $pendiente->actualizado }}</small></p>
                                    <input type="hidden" id="idLibroAceptar" name="idLibroAceptar" value="">
                                    <input type="hidden" id="fpublicarL" name="fpublicarL" value="">
                                    <input type="hidden" id="idAutor" name="idAutor" value="{{ $pendiente->user_iden }}">
                                    <input class="form-control" type="hidden" id="razonNegadoHidden" name="razonNegadoHidden"></input>
                                    <button type="button" id="aprovado" data-idAceptar="{{ $pendiente->id }}" class="btn btn-primary" data-toggle="modal" data-target="#modalAprovacion">Aceptar</button>
                                    <button type="button" id="denegado" data-idNegar="{{ $pendiente->id }}" data-idAutorNegar="{{ $pendiente->user_iden }}" data-toggle="modal" data-target="#razonNegadoModal" class="btn btn-danger">Denegar</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h2 class="text-center">REVISIÓN</h2>
                </div>
                <div class="col-6">
                    <h2 class="text-center">NEGADOS POR DIFUSOR</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-6 text-center">
                    @foreach($pendientes as $pendiente)
                        @if($pendiente->user_iden ==  Auth::user()->id )
                            <div class="card-header">
                                Agregado el {{ $pendiente->fagregado }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $pendiente->nombre }}
                                </h5>
                                <h6 class="card-subtitle">
                                    {{ $pendiente->autor }}
                                </h6>
                                <p class="card-text">
                                    {{ $pendiente->descripcion }}
                                </p>
                                <p class="card-text"><small class="text-muted">Ultima actualización: {{ $pendiente->actualizado }}</small></p>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="col-6 text-center">
                    @foreach($rechazados as $rechazado)
                        @if($rechazado->user_id ==  Auth::user()->id )
                            <div class="card-header">
                                Libro Rechazado: {{ $rechazado->nombre_libro }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    Razón
                                </h5>
                                <p class="card-text">
                                    {{ $rechazado->razón_eliminado }}
                                </p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    @endif

{{-- Modal para nueva sección --}}
<div class="modal fade" id="modalNuevaSección" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Registrar nueva sección</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('nuevacat') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre_cat">Nombre de la categoría: </label>
                            <input class="form-control" type="text" id="nombre_cat" name="nombre_cat" required>
                        </div>
                        <div class="form-group">
                            <label for="subCat">Es subcategoría de: </label>
                            <select class="form-control" id="subCat" name="subCat">
                                <option value="0">NIVEL SITIO</option>
                                @foreach($categoriasTodas as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nombre_cat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal personalizado para agregar un nuevo libro --}}
<section class="container-fluid" id="LibroForm">
        <form style="background-color: rgba(54,54,54,0.9); color: #E8E9EB" class="p-4" method="POST" action="{{ route('libros.store') }}">
            @csrf
            <button type="button" class="close" aria-label="Close" onclick="mostrarForm()">
                    <span style="color: #E8E9EB;" aria-hidden="true">&times;</span>
            </button>
            <div class="form-group">
                <label for="nombreL">Nombre del libro: </label>
                <input class="form-control" type="text" id="nombreL" name="nombreL">
            </div>
            <div class="form-group">
                <label for="descripcionL">Descripción del libro: </label>
                <textarea class="form-control" type="text" id="descripcionL" name="descripcionL" rows="4" cols="50"></textarea>
            </div>
            <div class="form-group">
                <label for="autorL">Nombre del autor: </label>
                <input class="form-control" type="text" id="autorL" name="autorL">
            </div>
            <div class="form-group">
                <label for="categoriaL">Categoria del libro: </label>
                <select class="form-control" name="categoriaL" id="categoriaL">
                    @if(count($categorias)==0)
                        <option id="x" value="x">
                            Habla con un difusor para pedir permisos de publicación
                        </option>
                    @else
                        @foreach($categorias as $categoria)
                            <option id="{{ $categoria->id }}" value="{{ $categoria->id }}">
                                {{ $categoria->nombre_cat }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            <button style="background-color: #E8E9EB!important; color: #363636;" type="submit" id="aproveEnv" class="btn btn-primary mb-2">Enviar para aprovacion</button>
            <br>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
</section>
    
<!-- Modal para editar un libro-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="edit">Editar libro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="{{ route('libros.update', '1') }}">
            @csrf
            {{ method_field('put') }}
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="idLibro" id="idLibro" value="">
                    <label for="nombreL">Nombre del libro: </label>
                    <input class="form-control" type="text" id="nombreL" name="nombreL">
                </div>
                <div class="form-group">
                    <label for="descripcionL">Descripción del libro: </label>
                    <textarea class="form-control" type="text" id="descripcionL" name="descripcionL" rows="4" cols="50"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
</div>
    
<!-- Modal versiones-->
<div class="modal fade" id="modalVersion" tabindex="-1" role="dialog" aria-labelledby="modalVersion" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalVersion">Version Seleccionada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="nombreL">Version del libro: </label>
        <input class="form-control" type="text" id="verL" name="verL" readonly="" value="">
        <label for="nombreL">Nombre del libro: </label>
        <input class="form-control" type="text" id="nomL" name="nombreL" readonly="" value="">
        <label for="nombreL">Descripcion del libro: </label>
        <textarea class="form-control" type="text" id="desL" name="descL" readonly="" value="" rows="4" cols="50"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal suscribirse-->
<div class="modal fade" id="modalSubscribirse" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ingrese su correo porfavor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="subscribirseForm" method="POST" action="{{ route('nuevosub') }}">
                <div class="modal-body">
                        @csrf
                        <label for="emailAnonimo">Correo: </label>
                        <input class="form-control" type="email" id="emailAnonimo" name="emailAnonimo" value="">
                        <input type="hidden" id="titLibroSub" name="titLibroSub" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                    <button type="submit" class="btn btn-primary">SUBSCRIBIRSE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal AceptarNegacion-->
<div class="modal fade" id="razonNegadoModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ingrese el motivo para negar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('libros.update', 'none') }}" id="negadoncio">
                    @csrf
                    {{ method_field('patch') }}
                    <input type="hidden" id="siOno" name="siOno" value="false">
                    <input type="hidden" id="idAutorNegado" name="idAutorNegado">
                    <input type="hidden" id="idLibroNegar" name="idLibroNegar" value="">
                    <textarea class="form-control" type="text" id="razonNegadoTxt" name="razonNegadoTxt" rows="4" cols="50"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="aceptarNegado" data-dismiss="modal" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Aprovación-->
<div class="modal fade" id="modalAprovacion" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center" style="display: inline;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="staticBackdropLabel">¿Cuando desea que se publique?</h5><br>
                <small class="modal-sm">SI SE DEJA EN BLANCO SE PUBLICA HOY</small>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('libros.update', 'none') }}" id="aceptarono">
                    @csrf
                    {{ method_field('patch') }}
                    <input type="hidden" id="idLibroPublicar" name="idLibroPublicar" value="">
                    <input type="hidden" id="siOno" name="siOno" value="false">
                    <div class='input-group date' id='datepickerL'>
                        <input type='text' class="form-control" id="fnpubliL" name="fnpubliL">
                        <span class="input-group-addon">
                        </span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="PublicarCont" class="btn btn-primary">Publicar</button>
            </div>
        </div>
    </div>
</div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> 
    <script type="text/javascript" src="{{ asset('js/funnavitems.js') }}">      
    </script>  
    <script type="text/javascript" src="{{ asset('js/libroStore.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/JDMcKinstry/JavaScriptDateFormat/master/Date.format.min.js"></script>

{{-- Script para asignar o revocar permisos de un usuario --}}  
    <script>
        $('.tab-content .checkBCat').on('click',function(e){
            var idAutorActivo = $('#list-tab .active').attr("data-idQuery");
            var nombAutorActivo = $('#list-tab .active').val();
            var idCategoria = $(this).attr("data-idCat");
            console.log(idCategoria,idAutorActivo);
            if($(this).is(':checked')){
                //check
                $.ajax({
                    method: "GET",
                    url: "dar_permisos/",
                    data: {idAutor:idAutorActivo, idCategoria:idCategoria},
                    success : function(data){
                        alert("Le haz dado permisos al usuario: "+data.name);
                    }
                });
            }else{
                $.ajax({
                    method: "GET",
                    url: "revocar_permisos/",
                    data: {idAutor:idAutorActivo, idCategoria:idCategoria},
                    success : function(data){
                        alert("Le haz quitado los permisos al usuario: "+data.name);
                    }
                });
            }
        });
    </script>

{{-- Script para llenar los checkboxes de los permisos para secciones --}}  
    <script>
        $(function(){
            var autorActivo = $('#list-tab .active').attr("id");
            var idAutorActivo = $('#list-tab .active').attr("data-idQuery");
            var checkSeccionesPerm = $('.tab-content .checkBCat');
            var tituSeccionesPerm = $('.tab-content .textBCat');
            $.ajax({
                url: 'autor/{id}',
                method: "GET",
                data: {id: idAutorActivo},
                success : function(data){
                        $.each(data, function(a){
                            for(var i=0;i<tituSeccionesPerm.length;i++){
                                if(tituSeccionesPerm[i].value === data[a].nombre_cat){
                                    checkSeccionesPerm[i].checked = true;
                                }
                            }
                        });
                }
            });

            $('#list-tab a').on('click', function(e){
                vaciarChecks();
                autorActivo = $(this).attr("data-idQuery");
                $.ajax({
                    url: 'autor/{id}',
                    method: "GET",
                    data: {id: autorActivo},
                    success : function(data){
                        $.each(data, function(a){
                            for(var i=0;i<tituSeccionesPerm.length;i++){
                                if(data[a].nombre_cat == tituSeccionesPerm[i].value){
                                    checkSeccionesPerm[i].checked = true;
                                }
                            }
                        });
                    }
                });
            });
        });

        function vaciarChecks(){
            var checkSeccionesPerm = $('.tab-content .checkBCat');
            for(var i=0;i<checkSeccionesPerm.length;i++){
                checkSeccionesPerm[i].checked = false;
            }
        } 
    </script>  
    
{{-- Script para llenar los datepickers --}}    
    <script >
        $(function () {
            $('#datepicker').datepicker({
                format: "yyyy/mm/dd",
                autoclose: true,
                todayHighlight: true,
                showOtherMonths: true,
                selectOtherMonths: true,
                autoclose: true,
                changeMonth: true,
                changeYear: true,
                orientation: "button"
            });
            $('#datepickerL').datepicker({
                format: "yyyy/mm/dd",
                autoclose: true,
                todayHighlight: true,
                showOtherMonths: true,
                selectOtherMonths: true,
                autoclose: true,
                changeMonth: true,
                changeYear: true,
                orientation: "button"
            });
        });
    </script>

{{-- Script para las funciones del modal que permite a un usuario anonimo subscribirse --}}
    <script>
        $('#modalSubscribirse').on('show.bs.modal', function(event){
            var modal=$(this);
            var botonSubscribirse = $(event.relatedTarget);
            $('#subscribirseForm').submit(function(event){
                event.preventDefault();
                var subForm = $(this);
                var email = subForm.find('#emailAnonimo').val();
                var titSubLibro = botonSubscribirse.data('titulo');
                var url = subForm.attr("action");
                subForm.find('#titLibroSub').val(titSubLibro);

                var _token = modal.find('input[name="_token"]').val();
                console.log(titSubLibro,email);
                $.ajax({
                    method: "POST",
                    url: url,
                    data: {email: email, tituloLibro: titSubLibro, _token:_token},
                    success : function(data){
                        if(data == 'chido'){
                            alert("Te haz subscrito a \""+titSubLibro+"\"");
                            location.reload();
                        }else if(data == 'medio'){
                            alert("Este correo ya esta subscrito a \""+titSubLibro+"\"");
                            location.reload();
                        }else{
                            console.log(data);
                            alert("Ha ocurrido un error, intentelo de nuevo");
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>

{{-- Script para llenar el modal que muestra el formulario para editar una entrada --}}
    <script>
        $('#edit').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var titulo = button.data('titulo');
            var descripcion = button.data('descripcion');
            var id = button.data('libroiden');
            var modal = $(this);
            modal.find('.modal-body #nombreL').val(titulo);
            modal.find('.modal-body #descripcionL').val(descripcion);
            modal.find('.modal-body #idLibro').val(id);
        });
    </script>

{{-- Script para llevar a cabo si se aprobo o no el libro propuesto por el autor--}}
    <script>
        $('#modalAprovacion').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            //console.log(button.attr('data-idAceptar'));
            $(this).find('#idLibroPublicar').val(button.attr('data-idAceptar'));
            console.log((button.attr('data-idAceptar')));
        })
        $('#PublicarCont').click(function(){
            var modal = $('#modalAprovacion');
            var fecha = modal.find('.modal-body #fnpubliL').val();
            modal.find('.modal-body #siOno').val(true);
            if(fecha == ""){
                modal.find('.modal-body #fnpubliL').val(new Date().format('Y-m-d'));
            }
            $('#aceptarono').submit();
        });

        $('#razonNegadoModal').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            $(this).find('#idAutorNegado').val(button.attr('data-idAutorNegar'));
            $(this).find('#idLibroNegar').val(button.attr('data-idNegar'));            
        });

        $('#aceptarNegado').click(function(){
            var modal = $('#razonNegadoModal');
            modal.find('.modal-body #idAutorNegado').val();
            $('#siOno').val(false);
            $('#negadoncio').submit();
        });
    </script>

    {{-- Script para llenar el modal que muestra las versiones del libro --}}
    <script>
        $('#modalVersion').on('show.bs.modal', function(event){
            var a = $(event.relatedTarget);
            var modalNow = $(this);
            var version = a.attr("data-verLibro");
            var titulo = a.attr("data-nombreLibro");
            var descripcion = a.attr("data-descLibro");
            modalNow.find('.modal-body #verL').val(version);
            modalNow.find('.modal-body #nomL').val(titulo);
            modalNow.find('.modal-body #desL').val(descripcion);
        });
    </script>
@endsection