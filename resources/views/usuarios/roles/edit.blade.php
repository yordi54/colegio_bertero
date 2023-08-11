@extends('layout')

@section('content')
    <div class="mt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2>Editar role</h2>
                <form action="{{route('roles.update', $role)}}" method="POST" class="row">
                    @csrf
                    @method("PUT")
                    <div class="form-group col-4">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ $role->nombre }}" required>
                        @error('nombre')
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