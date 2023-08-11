@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Mis datos</h2>
            <div class="card" id="card-datos">
                <div class="card-body">
                    <div>
                        <div class="form-group">
                            <label class="form-input-label" for="nombres">Nombres:</label>
                            <div class="form-input">{{ $juntaEscolar->nombres }}</div>
                        </div>
    
                        <div class="form-group">
                            <label class="form-input-label" for="apellidos">Apellidos:</label>
                            <div class="form-input">{{ $juntaEscolar->apellidos }}</div>
                        </div>
    
                        <div class="form-group">
                            <label class="form-input-label" for="telefono">Teléfono:</label>
                            <div class="form-input">{{ $juntaEscolar->telefono }}</div>
                        </div>
    
                        <div class="form-group">
                            <label class="form-input-label" for="sexo">Sexo:</label>
                            <div class="form-input">{{ $juntaEscolar->sexo === 'M' ? 'Masculino' : 'Femenino' }}</div>
                        </div>
    
                        <div class="form-group">
                            <label class="form-input-label" for="estado_activo">Estado Activo:</label>
                            <div class="form-input">{{ $juntaEscolar->estado_activo ? 'Activo' : 'Inactivo' }}</div>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <h4 style="font-size: 18px;">Grados correspondiente</h4>
                        @foreach ($juntaEscolar->grados as $grado)
                            <ul>
                                <li>
                                    <div class="form-group">
                                        <label class="form-input-label" for="grado">Nombre:</label>
                                        <div class="form-input">{{ $grado->nombre }}</div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection