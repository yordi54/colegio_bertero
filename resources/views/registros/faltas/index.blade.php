@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h2>Faltas</h2>
                    @if (Auth::user()->roles->contains("nombre", "Secretario"))
                        <a href="{{ route('faltas.create') }}" class="btn btn-primary mt-2 ms-4">Nuevo</a>
                    @endif
                </div>
                <div class="card">

                    @if (Auth::user()->roles->contains("nombre", "Secretario"))
                        <div class="mt-4 ms-4 col-3">
                            <input type="number" id="search" class="form-control" placeholder="Buscar por ci">
                            <label for="" id="csrf" hidden="true">{{ csrf_token() }}</label>
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <table class="table" id="personas">
                            <thead>
                                <tr>
                                    <th>CI Docente</th>
                                    <th>Docente</th>
                                    <th>Motivo</th>
                                    <th>Fecha</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="userList">
                                @foreach($faltas as $falta)
                                <tr>
                                    <td>{{ $falta->docente->persona->ci }}</td>
                                    <td>
                                        {{ $falta->docente->persona->nombres .' '. $falta->docente->persona->apellidos  }}
                                    </td>
                                    <td>{{ $falta->motivo }}</td>
                                    <td>{{ $falta->fecha }}</td>
                                    <td class="d-flex">
                                        <!-- Botones de acciones -->
                                        @if (Auth::user()->roles->contains("nombre", "Secretario"))
                                            <a 
                                                href="{{ route('faltas.edit', $falta->id) }}"
                                                class="btn btn-outline-secondary me-1">
                                                <i class="bi bi-pencil-square" style="color: green;"></i>
                                            </a>
                                            <form 
                                                action="{{ route('faltas.destroy', $falta->id) }}" method="post"
                                                onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                @csrf
                                                @method("delete")
                                                <button type="submit" class="btn btn-outline-secondary me-1">
                                                    <i class="bi bi-trash text-danger"></i>
                                                </button>
                                            </form>
                                        @endif
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
        {{ $faltas->links() }}
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
                "/faltas/buscar",
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

    function displayResults(faltas) {
        var userList = document.getElementById('userList');
        userList.innerHTML = ''; // Limpiar los resultados anteriores

        faltas.forEach(falta => {
            var row = document.createElement('tr');
            row.innerHTML = `
                <td>${falta.ci}</td>
                <td>${falta.docente}</td>
                <td>${falta.motivo}</td>
                <td>${falta.fecha}</td>
                <td class="d-flex">
                    <a 
                        href="{{ route('faltas.edit', '__falta_id__') }}"
                        class="btn btn-outline-secondary me-1">
                        <i class="bi bi-pencil-square" style="color: green;"></i>
                    </a>
                    <form 
                        action="{{ route('faltas.destroy', '__falta_id__') }}" method="post"
                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-outline-secondary me-1">
                            <i class="bi bi-trash text-danger"></i>
                        </button>
                    </form>
                </td>
            `;
            row.innerHTML = row.innerHTML.replace(/__falta_id__/g, falta.id);
            userList.appendChild(row);
        });
    }
</script>
@endsection