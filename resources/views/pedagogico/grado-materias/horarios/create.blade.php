@extends('layout')

@section('content')
    <div class="mt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2>Nuevo horario</h2>
                <h3 class="mb-3 mt-3" style="font-size: 18px;">Grado Materia</h3>

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

                <form action="{{route('storeHorario', $gradoMateria)}}" method="POST" class="row">
                    @csrf

                    <hr>
                    <h3 class="mb-3 mt-3" style="font-size: 18px;">Horario</h3>
                    @include('pedagogico.grado-materias.partials.horarios')

                    <span class=""></span>
                    <button type="submit" class="btn btn-primary mt-4 ms-3 col-2">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection