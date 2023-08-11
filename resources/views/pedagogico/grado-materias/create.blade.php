@extends('layout')

@section('content')
    <div class="mt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2>Nuevo Grado Materia</h2>
                <form action="{{route('gradosmaterias.store')}}" method="POST" class="row">
                    @csrf

                    <h3 class="mb-3 mt-3" style="font-size: 18px;">Grado Materias</h3>
                    @include('pedagogico.grado-materias.partials.grados-materias')

                    <hr>

                    <h3 class="mb-3 mt-3" style="font-size: 18px;">Horario</h3>
                    @include('pedagogico.grado-materias.partials.horarios')

                    <span class=""></span>
                    <button type="submit" class="btn btn-primary mt-4 ms-3 col-2">Registrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection