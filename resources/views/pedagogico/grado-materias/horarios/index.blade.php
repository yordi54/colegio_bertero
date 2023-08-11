@extends('layout')

@section('content')
    <div class="mt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2>Nuevo horario</h2>
                <form action="{{route('gradosmaterias.store')}}" method="POST" class="row">
                    @csrf

                    <hr>
                    <h3 class="mb-3 mt-3" style="font-size: 18px;">Horarios</h3>
                    @include('pedagogico.grado-materias.partials.horarios')

                    <span class=""></span>
                    <button type="submit" class="btn btn-primary mt-4 ms-3 col-2">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection