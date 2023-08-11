@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Mis datos</h2>
            <div class="card" id="card-datos">
                <div class="card-body">

                    <div class="form-group">
                        <label class="form-input-label" for="ci">CI:</label>
                        <div class="form-input">{{ $persona->ci }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-input-label" for="nombres">Nombres:</label>
                        <div class="form-input">{{ $persona->nombres }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-input-label" for="apellidos">Apellidos:</label>
                        <div class="form-input">{{ $persona->apellidos }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-input-label" for="telefono">Teléfono:</label>
                        <div class="form-input">{{ $persona->telefono }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-input-label" for="direccion">Dirección:</label>
                        <div class="form-input">{{ $persona->direccion }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-input-label" for="sexo">Sexo:</label>
                        <div class="form-input">{{ $persona->sexo === 'M' ? 'Masculino' : 'Femenino' }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-input-label" for="email">Email:</label>
                        <div class="form-input">{{ $persona->email }}</div>
                    </div>

                    <hr>
                    <h3 style="font-size: 18px;">Roles: </h3>
                    <a href="{{ route('createRole', $persona) }}" class="btn btn-secondary mt-2 ms-4 mb-3">Asignar role</a>
                    <div>
                        @foreach ($persona->roles as $role)
                            <ul>
                                <li>
                                    <div class="form-group">
                                        <label class="form-input-label" for="role">Nombre:</label>
                                        <div class="form-input">{{ $role->nombre }}</div>
                                    </div>
        
                                    <div class="form-group">
                                        <label class="form-input-label" for="estado_activo">Estado Activo:</label>
                                        <div class="form-input">{{ $role->pivot->estado_activo ? 'Activo' : 'Inactivo' }}</div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                    <a href="{{ route('personas.index') }}" class="btn btn-primary mt-4">Volver</a>
                </div>
            </div>
        </div>
    </div>
    
@endsection