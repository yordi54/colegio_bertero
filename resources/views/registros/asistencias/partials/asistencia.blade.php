<div id="map">
        
</div>
<label for="" id="csrf" hidden="true">{{ csrf_token() }}</label>
<div class="buttons">
    <button id="btn-marcar-asistencia" class="btn btn-secondary">Marcar asistencia</button>
    <a href="{{route('asistencias.show', Auth::user())}}" class="btn btn-secondary">Mis asistencias</a>
    <button id="btn-get-location" class="btn btn-primary mb-5" style="width: 50px;">
        <i class="bi bi-geo-alt-fill"></i>
    </button>
<form id="datosDocenteForm" style="display: none;">
    <label for="latitud">Latitud:</label>
    <input type="text" id="latitud" name="latitud" value="{{ $datosDocente['latitud'] }}" readonly>

    <label for="longitud">Longitud:</label>
    <input type="text" id="longitud" name="longitud" value="{{ $datosDocente['longitud'] }}" readonly>

    <label for="radio">Radio:</label>
    <input type="text" id="radio" name="radio" value="{{ $datosDocente['radio'] }}" readonly>
</form>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5ZElF3PG1e52lcJkI-CrZLQ9-k4bs98g&callback=initMap" async defer></script>
<script src="{{asset('js/google-map.js')}}"></script>