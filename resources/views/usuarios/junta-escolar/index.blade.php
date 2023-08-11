@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h2>Junta Escolar</h2>
                    <a href="{{ route('juntas.create') }}" class="btn btn-primary mt-2 ms-4">Nuevo</a>
                </div>
                <div class="card" id="card-juntas">

                    <div class="mt-4 ms-4 col-6">
                        <input type="text" id="search" class="form-control" placeholder="Buscar por nombres o apellidos">
                        <label for="" id="csrf" hidden="true">{{ csrf_token() }}</label>
                    </div>
                    
                    <div class="card-body">
                        <table class="table" id="juntas">
                            <thead>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Teléfono</th>
                                    <th>Sexo</th>
                                    <th>Estado Activo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="userList">
                                @foreach($juntaEscolar as $juntaEsco)
                                <tr>
                                    <td>{{ $juntaEsco->nombres }}</td>
                                    <td>{{ $juntaEsco->apellidos }}</td>
                                    <td>{{ $juntaEsco->telefono }}</td>
                                    <td>{{ $juntaEsco->sexo }}</td>
                                    <td>{{ $juntaEsco->estado_activo ? 'Activo' : 'Inactivo' }}</td>
                                    <td class="d-flex">
                                        <!-- Botones de acciones -->
                                        <a 
                                            href="{{ route('juntas.edit', $juntaEsco->id) }}"
                                            class="btn btn-outline-secondary me-1">
                                            <i class="bi bi-pencil-square" style="color: green;"></i>
                                        </a>
                                        <form 
                                            action="{{ route('juntas.destroy', $juntaEsco->id) }}" method="post"
                                            onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-outline-secondary me-1">
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </form>
                                        <a 
                                            href="{{ route('juntas.show', $juntaEsco->id) }}"
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
        {{ $juntaEscolar->links() }}
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
                "/junta-escolar/buscar",
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

    function displayResults(users) {
        var userList = document.getElementById('userList');
        userList.innerHTML = ''; // Limpiar los resultados anteriores

        users.forEach(user => {
            var row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.nombres}</td>
                <td>${user.apellidos}</td>
                <td>${user.telefono}</td>
                <td>${user.sexo}</td>
                <td>${user.estado_activo}</td>
                <td class="d-flex">
                    <a 
                        href="{{ route('juntas.edit', '__user_id__') }}"
                        class="btn btn-outline-secondary me-1">
                        <i class="bi bi-pencil-square" style="color: green;"></i>
                    </a>
                    <form 
                        action="{{ route('juntas.destroy', '__user_id__') }}" method="post"
                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-outline-secondary me-1">
                            <i class="bi bi-trash text-danger"></i>
                        </button>
                    </form>
                    <a 
                        href="{{ route('juntas.show', '__user_id__') }}"
                        class="btn btn-outline-secondary">
                        <i class="bi bi-eye text-info"></i>
                    </a>
                </td>
            `;
            row.innerHTML = row.innerHTML.replace(/__user_id__/g, user.id);
            userList.appendChild(row);
        });
    }
</script>
@endsection