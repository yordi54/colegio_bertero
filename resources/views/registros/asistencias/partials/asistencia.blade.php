<div id="map">
        
</div>
<label for="" id="csrf" hidden="true">{{ csrf_token() }}</label>
<div class="buttons">
    <button id="btn-marcar-asistencia" class="btn btn-secondary">Marcar asistencia</button>
    <a href="{{route('asistencias.show', Auth::user())}}" class="btn btn-secondary">Mis asistencias</a>
    <button id="btn-get-location" class="btn btn-primary mb-5" style="width: 50px;">
        <i class="bi bi-geo-alt-fill"></i>
    </button>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
<script src="{{asset('js/google-map.js')}}"></script>