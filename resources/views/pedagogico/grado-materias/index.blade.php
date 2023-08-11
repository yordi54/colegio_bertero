@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h2>Grados Materias</h2>
                    <a href="{{ route('gradosmaterias.create') }}" class="btn btn-primary mt-2 ms-4">Nuevo</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Grado</th>
                                    <th>Materia</th>
                                    <th>Docente</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="userList">
                                @foreach($gradosMaterias as $gradoMateria)
                                <tr>
                                    <td>{{ $gradoMateria->id }}</td>
                                    <td>{{ $gradoMateria->grado->nombre }}</td>
                                    <td>{{ $gradoMateria->materia->nombre }}</td>
                                    <td>{{ $gradoMateria->docente->persona->nombres }}  {{$gradoMateria->docente->persona->apellidos }}</td>
                                    <td class="d-flex">
                                        <!-- Botones de acciones -->
                                        <a 
                                            href="{{ route('gradosmaterias.edit', $gradoMateria->id) }}"
                                            class="btn btn-outline-secondary me-1">
                                            <i class="bi bi-pencil-square" style="color: green;"></i>
                                        </a>
                                        <form 
                                            action="{{ route('gradosmaterias.destroy', $gradoMateria->id) }}"
                                            method="post"
                                            onclick="return confirm('¿Estás seguro de eliminar?')">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-outline-secondary me-1">
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </form>
                                        <a 
                                            href="{{ route('gradosmaterias.show', $gradoMateria->id) }}"
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

    @if (session("info"))
        <x-alert 
            style="position: fixed; bottom: 0;"
            type="success"
            message="{{session('info')}}"
        />
    @endif
@endsection