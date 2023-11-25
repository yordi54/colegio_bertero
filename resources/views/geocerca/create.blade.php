@extends('layout')
@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
<div id="map"></div>
<style>
    .buttons {
        border: 5px solid #ccc; /* Borde de 1 píxel con color gris claro */
        padding: 20px; /* Añade un espacio interno de 20 píxeles alrededor del contenido */
        border-radius: 8px; /* Bordes redondeados */
    }

</style>
<form id="guardar-form" method="POST" action="{{ route('geocercas.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="buttons">
        <label for="" id="csrf" hidden="true">{{ csrf_token() }}</label>
        <div class="input-group">
            <input type="text" id="search-input" name="nombre" class="form-control" placeholder="Lugar">
            <div class="input-group-append">
                <button id="btn-search" class="btn btn-primary" type="button">
                    <i class="fas fa-search" aria-hidden="true"></i> Buscar
                </button>
            </div>
        </div>
        <div class="input-group mt-2">
            <label for="docentes" class="mr-2">Seleccionar Docentes:</label>
            <div class="input-group mt-2">
                <select multiple name="docentes[]" class="form-control">
                    @foreach ($docentes as $docente)
                        <option value="{{ $docente->persona->id }}">
                            {{ $docente->persona->nombres}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="input-group mt-2">
            <input type="text" id="latitud-input" name="latitud" class="form-control d-none" readonly>
        </div>
        <div class="input-group mt-2">
            <input type="text" id="longitud-input" name="longitud" class="form-control d-none" readonly>
        </div>
        <div class="input-group mt-2">
            <label for="radius-slider" class="mr-2">Radio:</label>
            <input type="range" id="radius-slider" name="radio" min="1" max="500" step="1" value="50">
        </div>
        <div class="input-group mt-2">
            <label for="start-time" class="mr-2">Hora de inicio:</label>
            <input type="time" id="start-time" name="startTime" class="form-control">
        </div>
        <div class="input-group mt-2">
            <label for="end-time" class="mr-2">Hora de final:</label>
            <input type="time" id="end-time" name="endTime" class="form-control">
        </div>
        <div class="input-group mt-2">
            <button id="btn-guardar" class="btn btn-success" type="submit">
                Guardar
            </button>
        </div>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var script1 = document.createElement('script');
        script1.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA5ZElF3PG1e52lcJkI-CrZLQ9-k4bs98g&callback=initMap';
        script1.async = true;
        script1.defer = true;

        var script2 = document.createElement('script');
        script2.src = '{{ asset("js/geocerca.js") }}';
        script2.async = true;
        script2.defer = true;

        // Añadir los scripts al final del cuerpo del documento
        document.body.appendChild(script1);
        document.body.appendChild(script2);
    });
</script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5ZElF3PG1e52lcJkI-CrZLQ9-k4bs98g&libraries=places&callback=initMap" async defer></script> -->
@endsection
