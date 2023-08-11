const btnMarcarAsistencia = document.getElementById("btn-marcar-asistencia");
const btnGetLocation = document.getElementById("btn-get-location");
let myLatLng;

function initMap() {            
    // var center = { lat: -17.8061312, lng: -63.127552}; //Ubicación del colegio.
    var center = { lat: -17.8126848, lng: -63.1406592}; //Mi ubicación.
    
    var map = new google.maps.Map(document.getElementById('map'), {
        center: center,
        zoom: 12 // Nivel de zoom inicial
    });

    window.map = map; //referencia al mapa

    var userMarker = new google.maps.Marker({
        position: center,
        map: map
    });

    // Crea el círculo alrededor del marcador
    var circle = new google.maps.Circle({
        map: map,
        center: center,
        radius: 50, // Radio en metros
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35
    });

    // Función para verificar si una coordenada está dentro del radio
    function isCoordinateInsideRadius(coord) {
        var distance = google.maps.geometry.spherical.computeDistanceBetween(center, coord);
        return distance <= circle.getRadius();
    }

    btnMarcarAsistencia.addEventListener("click", (e) => {
        var isInside = isCoordinateInsideRadius(myLatLng);
        if(!isInside)
            alert("No se encuentra dentro del área del colegio");
        else {
            sendData(
                "asistencias/marcar",
                {
                "query": true
                }
            )
            .then(res => res.json())
            .then(data => {
                    alert(data);
            })
            .catch(error => console.error('Error al realizar la búsqueda:', error));
        }
    })

    getUserLocation();
}

// Función para obtener la ubicación del usuario
function getUserLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showUserPosition);
    } else {
        alert("La geolocalización no es soportada por tu navegador.");
    }
}        

function showUserPosition(position) {
    var userLatLng = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
    };

    var customIcon = {
        url: './assets/asistencia-customsf.png',
        scaledSize: new google.maps.Size(80, 80), // Tamaño del ícono personalizado
        origin: new google.maps.Point(0, 0), // Punto de origen del ícono
        // anchor: new google.maps.Point(20, 40) // Punto de anclaje del ícono
        anchor: new google.maps.Point(40, 60) // Punto de anclaje del ícono
    };

    var userMarker = new google.maps.Marker({
        position: userLatLng,
        map: map, //referencia al mapa
        title: "¡Aquí estoy!",
        icon: customIcon
    });

    // Centra el mapa en la posición del usuario
    map.setCenter(userLatLng);
    myLatLng = userLatLng;
}

btnGetLocation.addEventListener("click", getUserLocation);