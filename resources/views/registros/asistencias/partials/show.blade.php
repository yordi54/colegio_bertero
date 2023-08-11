<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex mb-4">
                <h2>Asistencias</h2>
            </div>
            <div class="card">
            
                <div class="mt-4 ms-4 d-flex justify-content-between">
                    <div class="col-3">
                        <input type="number" id="search" class="form-control" placeholder="Buscar por ci">
                        <label for="" id="csrf" hidden="true">{{ csrf_token() }}</label>
                    </div>

                    <button type="button" id="btn-pdf" class="btn btn-outline-secondary me-5">
                        <i class="bi bi-file-pdf fs-4"></i>
                    </button>
                </div>                            

                <div class="card-body" id="report-container">
                    <table class="table" id="personas">
                        <thead>
                            <tr>
                                <th>CI Docente</th>
                                <th>Docente</th>
                                <th>Fecha</th>
                                <th>Hora Ingreso</th>
                                <th>Hora Salida</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="userList">
                            @foreach($asistencias as $asistencia)
                            <tr>
                                <td>{{ $asistencia->docente->persona->ci }}</td>
                                <td>
                                    {{ $asistencia->docente->persona->nombres .' '. $asistencia->docente->persona->apellidos  }}
                                </td>
                                <td>{{ $asistencia->fecha }}</td>
                                <td>{{ $asistencia->hora_ingreso }}</td>
                                <td>{{ $asistencia->hora_salida }}</td>
            
                                <td class="d-flex">
                                    <!-- Botones de acciones -->
                                    <form
                                        action="{{ route('asistencias.destroy', $asistencia->id) }}" method="post"
                                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        @csrf
                                        @method("delete")
                                        <button type="submit" class="btn btn-outline-secondary me-1">
                                            <i class="bi bi-trash text-danger"></i>
                                        </button>
                                    </form>
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
    {{ $asistencias->links() }}
</div>

@if (session("info"))
    <x-alert 
        style="position: fixed; bottom: 0;"
        type="success"
        message="{{session('info')}}"
    />
@endif