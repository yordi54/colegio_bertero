@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2>Nueva falta</h2>

                <div class="card">

                    <div class="card-body">                        
    
                        <form action="{{ route('faltas.store') }}" method="POST" class="ms-4 col-6">
                            @csrf

                            <div>
                                <div class="col-5">
                                    <label for="search">Buscar docente</label>
                                    <input 
                                        class="form-control @error('ci') is-invalid 
                                        @enderror" 
                                        type="number"
                                        id="search"
                                        name="ci"
                                        placeholder="Buscar ci"
                                    >
                                    @error('ci')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <label for="" id="csrf" hidden="true">{{ csrf_token() }}</label>
                                </div>
                                <div class="mt-2" id="userList"></div>
                            </div>

                            <div class="form-group">
                                <label for="motivo">Motivo:</label>
                                <textarea 
                                    class="form-control 
                                    @error('motivo') is-invalid 
                                    @enderror" 
                                    id="motivo" 
                                    name="motivo"
                                >{{ old('motivo') }}
                                </textarea>
                                @error('motivo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
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
                "personas/buscarForCI",
                {
                "query": query
                }
            )
            .then(res => res.json())
            .then(data => {
                    displayResults(data);
            })
            .catch(error => console.error('Error al realizar la búsqueda:', error));
        }
    }

    function displayResults(personas) {
        userList.innerHTML = ''; // Limpiar los resultados anteriores

        personas.forEach(persona => {
            var personaP = document.createElement('p');
            var personaUl = document.createElement('ul');
            var personaLi = document.createElement('li');

            personaP.innerHTML = `${persona.nombres} ${persona.apellidos}`;
            
            personaLi.appendChild(personaP);
            personaUl.appendChild(personaLi);
            userList.appendChild(personaUl);
        });
    }
</script>
@endsection