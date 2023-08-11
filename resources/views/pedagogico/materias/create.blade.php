@extends('layout')

@section('content')
    <div class="mt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2>Nueva materia</h2>
                <form action="{{route('materias.store')}}" method="POST" class="row">
                    @csrf

                    <div class="form-group col-6">
                        <label for="nombre">Nombre:</label>
                        <input
                            type="text"
                            class="form-control
                            @error('nombre') is-invalid @enderror"
                            id="nombre"
                            name="nombre"
                            value="{{ old('nombre') }}"
                            required
                            placeholder="Matemáticas"
                        >
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="carga_horaria">Carga horaria:</label>
                        <input
                            type="text"
                            class="form-control
                            @error('carga_horaria') is-invalid @enderror"
                            id="carga_horaria"
                            name="carga_horaria"
                            value="{{ old('carga_horaria') }}"
                            required
                            placeholder="40 min/día"
                        >
                        @error('carga_horaria')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <span class=""></span>
                    <button type="submit" class="btn btn-primary mt-4 ms-3 col-2">Registrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection