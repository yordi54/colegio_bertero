@extends('layout')

@section('content')
    <div class="mt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2>Nuevo grado</h2>
                <form action="{{route('aulas.store')}}" method="POST" class="row">
                    @csrf

                    <div class="form-group col-4">
                        <label for="nro">Nro de aula:</label>
                        <input 
                            type="number" 
                            class="form-control 
                            @error('nro') is-invalid @enderror" 
                            id="nro" 
                            name="nro" 
                            value="{{ old('nro') }}" 
                            required
                            placeholder="1"
                        >
                        @error('nro')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-4">
                        <label for="capacidad">Capacidad:</label>
                        <input 
                            type="number" 
                            class="form-control 
                            @error('capacidad') is-invalid @enderror" 
                            id="capacidad" 
                            name="capacidad" 
                            value="{{ old('capacidad') }}" 
                            required
                            placeholder="35"
                        >
                        @error('capacidad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <span class=""></span>
                    <button type="submit" class="btn btn-primary mt-4 mb-4 ms-3 col-2">Registrar</button>

                    <hr>
                    <h3 style="font-size: 18px;">Nro de aula existentes</h3>
                    <div class="card">
                        <div class="card-body row">                            
                            @foreach ($aulas as $aula)                                
                                <div class="form-group col-4">
                                    <label class="form-input-label" for="nro">Nro aula:</label>
                                    <div class="form-input">{{ $aula->nro }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
@endsection