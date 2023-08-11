<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <title>Mapa de Google</title>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        /* Establece la altura del mapa */
        #map {
            position: relative; 
            height: 500px;
            width: 100%;
        }

        .buttons {
            height: 380px;
            position: absolute;
            top: 120px;
            left: 10px;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
    <!-- Otras etiquetas head si las necesitas -->
</head>
<body>
    <!-- Contenido de la página que muestra el mapa -->
    <!-- Contenedor para el mapa -->
    <div id="map">
        
    </div>

    <div class="buttons">
        <button id="btn-marcar-asistencia" class="btn btn-secondary">Marcar asistencia</button>
        <button id="btn-get-location" class="btn btn-primary mb-5" style="width: 50px;">
            <i class="bi bi-geo-alt-fill"></i>
        </button>
    </div>
    
    <script>
        
        const btnMarcarAsistencia = document.getElementById("btn-marcar-asistencia");
        const btnGetLocation = document.getElementById("btn-get-location");
        let myLatLng;

        function initMap() {            
            var center = { lat: -17.8061312, lng: -63.127552};

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

            // // Función para manejar los clics en el círculo y el mapa
            // function handleClick(event) {
            //     var clickedCoord = event.latLng;
            //     var isInside = isCoordinateInsideRadius(clickedCoord);
            //     isInTheRadius = isInside;
            // }
            
            // google.maps.event.addListener(circle, "click", handleClick);

            // google.maps.event.addListener(map, 'click', handleClick);

            btnMarcarAsistencia.addEventListener("click", (e) => {
                var isInside = isCoordinateInsideRadius(myLatLng);
                console.log(isInside)
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
                url: '/assets/asistencia-customsf.png',
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

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
