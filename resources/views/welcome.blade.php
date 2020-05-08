@extends('layouts.app')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@section('estilos')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection

@section('content')
    
    @if(session()->has('mensajeExitoLibro'))
    <br>
    <div class="alert alert-success">
        <div class="container h6">
            {{ session()->get('mensajeExitoLibro') }}
        </div>
    </div>
    <br>
    @endif

    @if(Auth::user())
        <div class="container text-center">
            <h1>Bienvenido {{ Auth::user()->name }}</h1>
        </div>
        @if($rol[0]["nombre"] == 'Autor')
            <div class="container mt-4 mb-5">
                <button type="button" onclick="mostrarForm()" class="btn btn-primary">Proponer contenido</button>
            </div>
        @endif
    @else
        <div class="container text-center">
            <h1>Bienvenido Anonimo</h1>
        </div>
    @endif    

    <div class="container card text-center">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                @foreach($categorias as $categoria)
                    @if(is_null($categoria->catPadre))
                        @if( $categoria->id <= 1)
                            <li class="activo nav-item main-nav-item" id="{{ $categoria->id }}">
                                <a class="nav-link" href="#">{{ $categoria->nombre }}</a>
                            </li>
                        @else
                        <li class="nav-item main-nav-item" id="{{ $categoria->id }}">
                            <a class="nav-link" href="#">{{ $categoria->nombre }}</a>
                        </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="card-body">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        @foreach($categorias as $categoria)
                            @if($categoria->catPadre > 0)
                                @if($categoria->catPadre == 1)
                                    <li class="nav-item nav-item-sub" id="{{ $categoria->catPadre }}" data-iden2="{{ $categoria->catPadre }}{{ $categoria->id }}">
                                        <a class="nav-link" href="#">{{ $categoria->nombre }}</a>
                                    </li>
                                @else
                                <li class="nav-item oculto nav-item-sub" id="{{ $categoria->catPadre }}" data-iden2="{{ $categoria->catPadre }}{{ $categoria->id }}">
                                    <a class="nav-link" href="#">{{ $categoria->nombre }}</a>
                                </li>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        @foreach($libros as $libro)
                            @if($libro->idcategoria <= 6)
                                <div class="col-4 libros" id="{{ $libro->idcategoria }}">
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
                                            @if($rol[0]["nombre"] == 'Autor')
                                                <form method="POST" action="{{ route('libros.destroy', $libro->id) }}">
                                                    @csrf   
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Borrar</button>
                                                </form>
                                                <button type="button" data-toggle="modal" data-libroid="{{ $libro->id }}" data-titulo="{{ $libro->nombre }}" data-descripcion="{{ $libro->descripcion }}" data-target="#edit" class="btn btn-success">Editar</button>
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
                                            <button onclick="Suscribirse()" class="btn btn-primary">
                                                SUBSCRIBIRSE
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                @else
                                <div class="col-4 libros oculto" id="{{ $libro->idcategoria }}">
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
                                            @if($rol[0]["nombre"] == 'Autor')
                                                <form method="POST" action="{{ route('libros.destroy', $libro->id) }}">
                                                    @csrf   
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Borrar</button>
                                                </form>
                                                <button type="button" data-libroid="{{ $libro->id }}" data-titulo="{{ $libro->nombre }}" data-descripcion="{{ $libro->descripcion }}" data-toggle="modal" data-target="#edit" class="btn btn-success">Editar</button>
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
                                            <button onclick="Suscribirse()" class="btn btn-primary">
                                                SUBSCRIBIRSE
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endif 
                        @endforeach
                    </div>                  
                </div>
            </div>
        </div>
    </div>

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
                                <form method="post" action="{{ route('libros.update', 'none') }}" id="aceptarono">
                                    @csrf
                                    {{ method_field('patch') }}
                                    <input type="hidden" id="siOno" name="siOno" value="">
                                    <input type="hidden" id="idLibroAceptar" name="idLibroAceptar" value="{{ $pendiente->id }}">
                                    <button type="button" id="aprovado" class="btn btn-primary">Aceptar</button>
                                    <button type="button" id="denegado" class="btn btn-danger">Denegar</button>
                                </form>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endif

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
                        @foreach($categorias as $categoria)
                            {{--  @if($categoria->id > 3)--}}
                                <option id="{{ $categoria->id }}" value="{{ $categoria->id }}">
                                    {{ $categoria->nombre }}
                                </option>
                            {{--@endif  --}}
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="fpubliL">Fecha en que publico el libro: </label>
                    <input class="form-control" type="text" id="fpubliL" name="fpubliL">
                </div>
                <button style="background-color: #E8E9EB!important; color: #363636;" type="submit" class="btn btn-primary mb-2">Enviar para aprovacion</button>
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
    
    <!-- Modal -->
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
                    {{ method_field('patch') }}
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


    
<!-- Modal -->
<div class="modal fade" id="modalVersion" tabindex="-1" role="dialog" aria-labelledby="modalVersion" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalVersion">Modal title</h5>
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

    <script type="text/javascript" src="{{ asset('js/funnavitems.js') }}">      
    </script>    
    <script type="text/javascript" src="{{ asset('js/libroStore.js') }}"></script>

    <script>
        $('#edit').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var titulo = button.data('titulo');
            var descripcion = button.data('descripcion');
            var id = button.data('libroid');
            var modal = $(this);
            modal.find('.modal-body #nombreL').val(titulo);
            modal.find('.modal-body #descripcionL').val(descripcion);
            modal.find('.modal-body #idLibro').val(id);
        });

        $('#aprovado').click(function(){
            $('#siOno').val(true);
            $('#aceptarono').submit();
        });

        $('#denegado').click(function(){
            $('#siOno').val(false);
            $('#aceptarono').submit();
        });

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