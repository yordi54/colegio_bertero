@extends('layout')

@section('content')
    <div class="mt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2>Editar capacidad de aula</h2>
                <form action="{{route('aulas.update', $aula)}}" method="POST" class="row">
                    @csrf
                    @method("PUT")
                    
                    <h3 style="font-size: 18px;">Nro de aula a actualizar</h3>
                    <div class="card">
                        <div class="card-body row">                            
                            <div class="form-group col-4">
                                <label class="form-input-label" for="capacidad">Nro aula:</label>
                                <div class="form-input">{{ $aula->nro }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <hr>

                    <div class="form-group col-4">
                        <label for="capacidad">Capacidad:</label>
                        <input 
                            type="number" 
                            class="form-control 
                            @error('capacidad') is-invalid @enderror" 
                            id="capacidad" 
                            name="capacidad" 
                            value="{{ $aula->capacidad }}" 
                            required
                            placeholder="35"
                        >
                        @error('capacidad')
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