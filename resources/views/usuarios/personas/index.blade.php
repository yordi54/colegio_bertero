@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h2>Personas</h2>
                    <a href="{{ route('personas.create') }}" class="btn btn-primary mt-2 ms-4">Nuevo</a>
                </div>
                <div class="card">

                    <div class="mt-4 ms-4 col-6">
                        <input type="text" id="search" class="form-control" placeholder="Buscar por nombres o apellidos">
                        <label for="" id="csrf" hidden="true">{{ csrf_token() }}</label>
                    </div>
                    
                    <div class="card-body">
                        <table class="table" id="personas">
                            <thead>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Teléfono</th>
                                    <th>Sexo</th>
                                    <th>Rol</th>
                                    <th>Estado Activo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="userList">
                                @foreach($personas as $persona)
                                <tr>
                                    <td>{{ $persona["persona"]->nombres }}</td>
                                    <td>{{ $persona["persona"]->apellidos }}</td>
                                    <td>{{ $persona["persona"]->telefono }}</td>
                                    <td>{{ $persona["persona"]->sexo }}</td>
                                    <td>{{ $persona["role"]["nombre"] }}</td>
                                    <td>{{ $persona["role"]["estado_activo"] ? 'Activo' : 'Inactivo' }}</td>
                                    <td class="d-flex">
                                        <!-- Botones de acciones -->
                                        <a 
                                            href="{{ route('personas.edit', $persona["persona"]->id) }}"
                                            class="btn btn-outline-secondary me-1">
                                            <i class="bi bi-pencil-square" style="color: green;"></i>
                                        </a>
                                        <form 
                                            action="{{ route('personas.destroy', $persona["persona"]->id) }}" method="post"
                                            onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-outline-secondary me-1">
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </form>
                                        <a 
                                            href="{{ route('personas.show', $persona["persona"]->id) }}"
                                            class="btn btn-outline-secondary">
                                            <i class="bi bi-eye text-info"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $personasPag->links() }}
    </div>

    @if (session("info"))
        <x-alert 
            style="position: fixed; bottom: 0;"
            type="success"
            message="{{session('info')}}"
        />
    @endif
@endsection

@section('js')
<script>
    var typingTimer;
    var doneTypingInterval = 100;
    var searchInput = document.getElementById('search');
    var userList = document.getElementById('userList');

    var currentPage = 1; // Página actual para la búsqueda
    var resultsPerPage = 5; // Cantidad de resultados por página

    searchInput.addEventListener('keyup', function() {
        clearTimeout(typingTimer);
        if (searchInput.value) {
            typingTimer = setTimeout(search, doneTypingInterval);
        };
    });

    function search() {
        var query = searchInput.value;
        if (query.length >= 2) { // Realizar la búsqueda solo si se han ingresado al menos 2 caracteres

            sendData(
                "personas/buscar",
                {
                "query": query
                }
            )
            .then(res => res.json())
            .then(data => {
                    var startIndex = (currentPage - 1) * resultsPerPage;
                    var endIndex = startIndex + resultsPerPage;
                    var currentPageResults = data.slice(startIndex, endIndex);
                    displayResults(currentPageResults);
            })
            .catch(error => console.error('Error al realizar la búsqueda:', error));
        }
    }

    function displayResults(personas) {
        var userList = document.getElementById('userList');
        userList.innerHTML = ''; // Limpiar los resultados anteriores

        personas.forEach(persona => {
            var row = document.createElement('tr');
            row.innerHTML = `
                <td>${persona.persona.nombres}</td>
                <td>${persona.persona.apellidos}</td>
                <td>${persona.persona.telefono}</td>
                <td>${persona.persona.sexo}</td>
                <td>${persona.role.nombre}</td>
                <td>${persona.role.estado_activo}</td>
                <td class="d-flex">
                    <a 
                        href="{{ route('personas.edit', '__persona_id__') }}"
                        class="btn btn-outline-secondary me-1">
                        <i class="bi bi-pencil-square" style="color: green;"></i>
                    </a>
                    <form 
                        action="{{ route('personas.destroy', '__persona_id__') }}" method="post"
                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-outline-secondary me-1">
                            <i class="bi bi-trash text-danger"></i>
                        </button>
                    </form>
                    <a 
                        href="{{ route('personas.show', '__persona_id__') }}"
                        class="btn btn-outline-secondary">
                        <i class="bi bi-eye text-info"></i>
                    </a>
                </td>
            `;
            row.innerHTML = row.innerHTML.replace(/__persona_id__/g, persona.persona.id);
            userList.appendChild(row);
        });
    }
</script>
@endsection