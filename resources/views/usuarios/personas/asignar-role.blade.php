@extends('layout')

@section('content')
    <div class="mt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2>Asignando roles</h2>
                <form action="{{route('storeRole', $persona)}}" method="POST" class="row">
                    @csrf
                    
                    <div class="row">
                        <div class="form-group col-4">
                            <label class="form-input-label" for="ci">CI:</label>
                            <div class="form-input">{{ $persona->ci }}</div>
                        </div>
    
                        <div class="form-group col-4">
                            <label class="form-input-label" for="nombres">Nombres:</label>
                            <div class="form-input">{{ $persona->nombres }}</div>
                        </div>
    
                        <div class="form-group col-4">
                            <label class="form-input-label" for="apellidos">Apellidos:</label>
                            <div class="form-input">{{ $persona->apellidos }}</div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group col-3">
                        <label for="role">Role:</label>
                        <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                            @foreach ($roles as $role)
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