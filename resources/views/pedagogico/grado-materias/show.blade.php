@extends('layout')

@section('content')

<div class="col-md-10 offset-md-1">
    <h2>Ver Grado Materia</h2>
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="form-group col-4">
                    <label class="form-input-label" for="grado">Grado</label>
                    <div class="form-input">{{ $gradoMateria->grado->nombre }}</div>
                </div>

                <div class="form-group col-4">
                    <label class="form-input-label" for="materia">Materia:</label>
                    <div class="form-input">{{ $gradoMateria->materia->nombre }}</div>
                </div>

                <div class="form-group col-4">
                    <label class="form-input-label" for="docente">Docente:</label>
                    <div class="form-input">{{ $gradoMateria->docente->persona->nombres }} {{ $gradoMateria->docente->persona->apellidos }}</div>
                </div>
            </div>
            <hr>

            <h4 style="font-size: 18px;">Horarios</h4>
            <a href="{{ route('createHorario', $gradoMateria) }}" class="btn btn-secondary mt-2 ms-4">Asignar horario</a>
            <ul>
                @foreach ($gradoMateria->horarios as $horario)
                    <li>
                        <div class="row">
                            <div class="form-group col-3">
                                <label class="form-input-label" for="dia">Día:</label>
                                <div class="form-input">{{ $horario->dia->nombre }}</div>
                            </div>

                            <div class="form-group col-3">
                                <label class="form-input-label" for="hora_ini">Hora inicial:</label>
                                <div class="form-input">{{ $horario->hora->hora_ini }}</div>
                            </div>

                            <div class="form-group col-3">
                                <label class="form-input-label" for="hora_fin">Hora final:</label>
                                <div class="form-input">{{ $horario->hora->hora_fin }}</div>
                            </div>

                            <div class="form-group col-3">
                                <label class="form-input-label" for="nro_aula">Nro Aula:</label>
                                <div class="form-input">{{ $horario->aula->nro }}</div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <a href="{{ route('gradosmaterias.index') }}" class="btn btn-primary mt-4">Volver</a>
</div>

@if (session("info"))
    <x-alert 
        style="position: fixed; bottom: 0;"
        type="success"
        message="{{session('info')}}"
    />
@endif
@endsection