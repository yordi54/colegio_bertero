<div class="row">
    <div class="form-group col-4">
        <label for="grado">Grados:</label>
        <select class="form-control @error('grado') is-invalid @enderror" id="grado" name="grado" required>
            @foreach ($grados as $grado)
                <option value={{$grado->id}} {{ old('grado') == $grado->nombre ? 'selected' : '' }}>{{$grado->nombre}}</option>
            @endforeach
        </select>
        @error('grado')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-4">
        <label for="materia">Materias:</label>
        <select class="form-control @error('materia') is-invalid @enderror" id="materia" name="materia" required>
            @foreach ($materias as $materia)
                <option value={{$materia->id}} {{ old('materia') == $materia->nombre ? 'selected' : '' }}>{{$materia->nombre}}</option>
            @endforeach
        </select>
        @error('materia')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-4">
        <label for="docente">Docentes:</label>
        <select class="form-control @error('docente') is-invalid @enderror" id="docente" name="docente" required>
            @foreach ($docentes as $docente)
                <option 
                    value={{$docente->persona->id}}
                    {{ old('docente') == $docente->persona->ci ? 'selected' : '' }}
                    >{{$docente->persona->nombres .' '.$docente->persona->apellidos}}
                </option>
            @endforeach
        </select>
        @error('docente')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>