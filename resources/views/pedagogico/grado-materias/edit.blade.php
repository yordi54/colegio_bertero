@extends('layout')

@section('content')
    <div class="mt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2>Editar materia</h2>
                <form action="{{route('gradosmaterias.update', $gradoMateria)}}" method="POST" class="row">
                    @csrf
                    @method("PUT")
                    
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
                                    <label for="docente" class="fw-bold mb-1">Nuevo docente:</label>
                                    <select class="form-control @error('docente') is-invalid @enderror" id="docente" name="docente" required>
                                        @foreach ($docentes as $docente)
                                            <option 
                                                value={{$docente->persona->id}}
                                                {{ $gradoMateria->docente->personas_id == $docente->persona->id ? 'selected' : '' }}
                                                >{{$docente->persona->nombres .' '.$docente->persona->apellidos}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('docente')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <h4 style="font-size: 18px;">Horarios</h4>
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

                    <span class=""></span>
                    <div>
                        <a href="{{ route('gradosmaterias.index') }}" class="btn btn-secondary mt-4">Volver</a>
                    <button type="submit" class="btn btn-primary mt-4 ms-3 col-2">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection