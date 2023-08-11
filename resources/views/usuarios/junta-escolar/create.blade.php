@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2>Nuevo persona - junta  escoalar</h2>
                <form action="{{route('juntas.store')}}" method="POST" class="row">
                    @csrf

                    <div class="form-group col-5">
                        <label for="nombres">Nombres:</label>
                        <input type="text" class="form-control @error('nombres') is-invalid @enderror" id="nombres" name="nombres" value="{{ old('nombres') }}" required>
                        @error('nombres')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-5">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
                        @error('apellidos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-5">
                        <label for="telefono">Teléfono:</label>
                        <input type="number" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}" required>
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-5">
                        <label for="rol">Rol:</label>
                        <select class="form-control @error('rol') is-invalid @enderror" id="rol" name="rol" required>
                            @foreach ($roles as $rol)
                                <option value={{$rol}} {{ old('rol') == $rol ? 'selected' : '' }}>{{$rol}}</option>
                            @endforeach
                        </select>
                        @error('rol')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="grado">Grado:</label>
                            <select class="form-control @error('grado') is-invalid @enderror" id="grado" name="grado" required>
                                @foreach ($grados as $grado)
                                    <option value={{$grado->id}} {{ old('grado') == $grado->nombre ? 'selected' : '' }}>{{$grado->nombre}}</option>
                                @endforeach
                            </select>
                            @error('grado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <select class="form-control @error('sexo') is-invalid @enderror" id="sexo" name="sexo" required>
                                <option value="M" {{ old('sexo') === 'M' ? 'selected' : '' }}>Hombre</option>
                                <option value="F" {{ old('sexo') === 'F' ? 'selected' : '' }}>Mujer</option>
                            </select>
                            @error('sexo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="estado_activo">Estado Activo:</label>
                            <select class="form-control @error('estado_activo') is-invalid @enderror" id="estado_activo" name="estado_activo" required>
                                <option value="1" {{ old('estado_activo') == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('estado_activo') == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado_activo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <span></span>
                    <button type="submit" class="btn btn-primary mt-4 col-3">Registrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection