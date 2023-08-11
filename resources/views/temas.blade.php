@extends('layout')

@section('content')
    <h1>Bienvenido a temas</h1>
    <p>Aquí podras escoger temas</p>

    <div class="card mb-4" style="max-width: 900px;">
        <img
            src="{{asset('assets/default-theme.png')}}" 
            alt="default-theme"
            class="p-2"
            width="100%"
        >
        <div class="card-body">
            <h5 class="card-title">Tema por defecto</h5>
            <p><strong>Fuente: </strong>Arial, Helvetica, sans-serif</p>
            <button id="btnDefaultTheme" class="btn btn-primary">Aplicar</button>
        </div>
    </div>

    <div class="card mb-4" style="max-width: 900px;">
        <img
            src="{{asset('assets/child-theme.png')}}"
            alt="default-theme"
            class="p-2"
            width="100%"
        >
        <div class="card-body">
            <h5 class="card-title">Tema para niños</h5>
            <p><strong>Fuente: </strong>'Lucida Sans', 'Lucida Sans Regular'</p>
            <button id="btnChildTheme" class="btn btn-primary">Aplicar</button>
        </div>
    </div>

    <div class="card" style="max-width: 900px;">
        <img
            src="{{asset('assets/old-theme.png')}}"
            alt="default-theme"
            class="p-2"
            width="100%"
        >
        <div class="card-body">
            <h5 class="card-title">Tema para mayores</h5>
            <p><strong>Fuente: </strong>'Open Sans', sans-serif</p>
            <button id="btnOldTheme" class="btn btn-primary">Aplicar</button>
        </div>
    </div>
@endsection