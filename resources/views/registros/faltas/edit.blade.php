@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2>Nueva falta</h2>

                <div class="card">

                    <div class="card-body">                        
    
                        <form action="{{ route('faltas.update', $falta) }}" method="POST" class="ms-4 col-6">
                            @csrf

                            @method("PUT")
                            <div class="form-group">
                                <label for="motivo">Motivo:</label>
                                <textarea 
                                    class="form-control 
                                    @error('motivo') is-invalid 
                                    @enderror" 
                                    id="motivo" 
                                    name="motivo"
                                >{{ $falta->motivo }}
                                </textarea>
                                @error('motivo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection