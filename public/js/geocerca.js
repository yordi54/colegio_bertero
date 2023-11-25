const btnMarcarAsistencia = document.getElementById("btn-marcar-asistencia");
const btnGetLocation = document.getElementById("btn-get-location");
const radiusSlider = document.getElementById('radius-slider');
const searchInput = document.getElementById('search-input');
const btnSearch = document.getElementById('btn-search');
const btnGuardar = document.getElementById('btn-guardar');
const form = document.getElementById('guardar-form');

let map, userMarker, circle, placesService;
const lat = -17.783229;
const lng =-63.182123;
const santaCruzLocation = { lat, lng };


function initMap(initialLocation) {
    map = new google.maps.Map(document.getElementById('map'), {
        center: initialLocation,
        zoom: 13
    });

    userMarker = createMarker(initialLocation, true);
    circle = createCircle(initialLocation, 50);

    radiusSlider.addEventListener('input', function () {
        circle.setRadius(parseInt(radiusSlider.value));
    });

    placesService = new google.maps.places.PlacesService(map);
    setupPlacesSearchBox();

    radiusSlider.value = circle.getRadius();
}

function createMarker(position, draggable) {
    return new google.maps.Marker({
        position: position,
        map: map,
        draggable: draggable
    });
}

function createCircle(center, radius) {
    return new google.maps.Circle({
        map: map,
        center: center,
        radius: radius,
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35
    });
}

function setupPlacesSearchBox() {
    const searchBox = new google.maps.places.SearchBox(searchInput);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(searchInput);

    map.addListener('bounds_changed', function () {
        searchBox.setBounds(map.getBounds());
    });

    searchBox.addListener('places_changed', function () {
        const places = searchBox.getPlaces();

        if (places.length > 0) {
            const place = places[0];
            updateMapForPlace(place);
        }
    });
}

function updateMapForPlace(place) {
    const location = place.geometry.location;
    userMarker.setPosition(location);
    circle.setCenter(location);
    radiusSlider.value = circle.getRadius();
    map.panTo(location);
    document.getElementById('latitud-input').value = location.lat();
    document.getElementById('longitud-input').value = location.lng();
}

function performSearchAndMark() {
    const searchValue = searchInput.value.trim();

    if (searchValue !== "") {
        const geocoder = new google.maps.Geocoder();

        geocoder.geocode({ address: searchValue }, function (results, status) {
            if (status === 'OK' && results[0]) {
                const place = results[0];
                updateMapForPlace(place);
            } else {
                console.error('No se pudieron obtener las coordenadas para la búsqueda:', status);
            }
        });
    } else {
        console.log("El cuadro de búsqueda está vacío");
    }
}

btnSearch.addEventListener('click', performSearchAndMark);

function performGuardar() {
    // Obtener los valores de los campos
    const nombre = searchInput.value.trim();
    const radio = radiusSlider.value;
    const startTime = document.getElementById('start-time').value;
    const endTime = document.getElementById('end-time').value;
    const selectedDocentes = Array.from(document.querySelectorAll('[name="docentes[]"]:checked'))
        .map(option => option.value);


    if (nombre && radio && startTime && endTime && selectedDocentes.length > 0) {
        form.querySelector('[name="nombre"]').value = nombre;
        form.querySelector('[name="radio"]').value = radio;
        form.querySelector('[name="startTime"]').value = startTime;
        form.querySelector('[name="endTime"]').value = endTime;
        form.querySelector('[name="docentes[]"]').value = JSON.stringify(selectedDocentes);      

        document.getElementById('guardar-form').submit();
    } else {
        console.error('Por favor, complete todos los campos antes de guardar.');
    }
}
btnGuardar.addEventListener('click', performGuardar);
initMap(santaCruzLocation);
