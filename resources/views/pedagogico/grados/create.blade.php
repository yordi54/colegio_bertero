@extends('layout')

@section('content')
    <div class="mt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2>Nuevo grado</h2>
                <form action="{{route('grados.store')}}" method="POST" class="row">
                    @csrf

                    <div class="form-group col-4">
                        <label for="nombre">Nombre:</label>
                        <input 
                            type="text" 
                            class="form-control 
                            @error('nombre') is-invalid @enderror" 
                            id="nombre" 
                            name="nombre" 
                            value="{{ old('nombre') }}" 
                            required
                            placeholder="1ro 'A' de secundaria"
                        >
                        @error('nombre')
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