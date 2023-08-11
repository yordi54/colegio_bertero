@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>Editar</h2>
                <form action="{{ route('juntas.update', $juntaEscolar) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nombres">Nombres:</label>
                        <input type="text" class="form-control @error('nombres') is-invalid @enderror" id="nombres" name="nombres" value="{{ $juntaEscolar->nombres }}" required>
                        @error('nombres')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" name="apellidos" value="{{ $juntaEscolar->apellidos }}" required>
                        @error('apellidos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="number" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ intval($juntaEscolar->telefono) }}" required>
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <select class="form-control @error('sexo') is-invalid @enderror" id="sexo" name="sexo" required>
                            <option value="M" {{ $juntaEscolar->sexo === 'M' ? 'selected' : '' }}>Hombre</option>
                            <option value="F" {{ $juntaEscolar->sexo === 'F' ? 'selected' : '' }}>Mujer</option>
                        </select>
                        @error('sexo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="estado_activo">Estado Activo:</label>
                        <select class="form-control @error('estado_activo') is-invalid @enderror" id="estado_activo" name="estado_activo" required>
                            <option value="1" {{ $juntaEscolar->estado_activo == 1 ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ $juntaEscolar->estado_activo == 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado_activo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <a href="{{route("juntas.index")}}" class="btn btn-primary mt-4">Atrás</a>

                    <button type="submit" class="btn btn-secondary mt-4">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection