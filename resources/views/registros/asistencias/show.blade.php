@extends('layout')

@section('content')

<div class="col-md-10 offset-md-1">
    <h2>Mis datos</h2>
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="form-group col-4">
                    <label class="form-input-label" for="ci">CI</label>
                    <div class="form-input">{{ $persona->ci }}</div>
                </div>

                <div class="form-group col-4">
                    <label class="form-input-label" for="nombre">Nombres:</label>
                    <div class="form-input">{{ $persona->nombres }}</div>
                </div>

                <div class="form-group col-4">
                    <label class="form-input-label" for="apellido">Apellidos:</label>
                    <div class="form-input">{{ $persona->apellidos }}</div>
                </div>
            </div>
            <hr>

            <h4 style="font-size: 18px;">Asistencias</h4>
            <ul>
                @foreach ($persona->docente->asistencias as $asistencia)
                    <li>
                        <div class="row">
                            <div class="form-group col-3">
                                <label class="form-input-label" for="dia">Fecha:</label>
                                <div class="form-input">{{ $asistencia->fecha }}</div>
                            </div>

                            <div class="form-group col-3">
                                <label class="form-input-label" for="hora_ini">Hora ingreso:</label>
                                <div class="form-input">{{ $asistencia->hora_ingreso }}</div>
                            </div>

                            <div class="form-group col-3">
                                <label class="form-input-label" for="hora_fin">Hora salida:</label>
                                <div class="form-input">{{ $asistencia->hora_salida }}</div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <a href="{{ route('asistencias.index') }}" class="btn btn-primary mt-4">Volver</a>
</div>
@endsection