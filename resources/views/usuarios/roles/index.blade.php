@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h2>Roles</h2>
                    <a href="{{ route('roles.create') }}" class="btn btn-primary mt-2 ms-4">Nuevo</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="userList">
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->nombre }}</td>
                                    <td class="d-flex">
                                        <!-- Botones de acciones -->
                                        <a 
                                            href="{{ route('roles.edit', $role->id) }}"
                                            class="btn btn-outline-secondary me-1">
                                            <i class="bi bi-pencil-square" style="color: green;"></i>
                                        </a>
                                        <form 
                                            action="{{ route('roles.destroy', $role->id) }}"
                                            method="post"
                                            onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-outline-secondary me-1">
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </form>
                                        <a 
                                            href="{{ route('roles.show', $role->id) }}"
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