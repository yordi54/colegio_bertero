@extends('layout')

@section('content')
    <div class="mt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2>Editar mis datos</h2>
                <form action="{{route('personas.update', $persona)}}" method="POST" class="row">
                    @csrf
                    @method("PUT")                    

                    <div class="form-group col-3" hidden="true">
                        <label for="ci">CI:</label>
                        <input type="number" class="form-control @error('ci') is-invalid @enderror" id="ci" name="ci" value="{{ $persona->ci }}" required>
                        @error('ci')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-4">
                        <label for="nombres">Nombres:</label>
                        <input type="text" class="form-control @error('nombres') is-invalid @enderror" id="nombres" name="nombres" value="{{ $persona->nombres }}" required>
                        @error('nombres')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-5">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" name="apellidos" value="{{ $persona->apellidos }}" required>
                        @error('apellidos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <span class="mt-4"></span>

                    <div class="form-group col-4">
                        <label for="telefono">Teléfono:</label>
                        <input type="number" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ intval($persona->telefono) }}" required>
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-4">
                        <label for="direccion">Dirección:</label>
                        <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" value="{{ $persona->direccion }}" required>
                        @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <span class="mt-4"></span>

                    {{-- <div class="form-group col-4">
                        <label for="mail">Email:</label>
                        <input type="mail" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $persona->email }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-4">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ $persona->password }}" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <span class="mt-4"></span>
                    <hr>

                    <div class="form-group col-3">
                        <label for="role">Role:</label>
                        <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                            @foreach ($persona->roles as $role)
                                <option 
                                    value="{{$role->id}}"
                                    {{ old('role') === $role->nombre ? 'selected' : '' }}
                                    >{{$role->nombre}}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <span class="mt-4"></span>

                    <div class="form-group col-3">
                        <label for="estado_activo">Estado Activo:</label>
                        <select class="form-control @error('estado_activo') is-invalid @enderror" id="estado_activo" name="estado_activo" required>
                            <option value="1" {{ old('estado_activo') == 1 ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('estado_activo') == 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado_activo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <span class=""></span>
                    <button type="submit" class="btn btn-primary mt-4 ms-3 col-2">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection