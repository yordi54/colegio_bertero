<div class="row">
    <div class="form-group col-4">
        <label for="aula">Aula:</label>
        <select class="form-control @error('aula') is-invalid @enderror" id="aula" name="aula" required>
            @foreach ($aulas as $aula)
                <option value={{$aula->nro}} {{ old('aula') == $aula->nro ? 'selected' : '' }}>{{$aula->nro}}</option>
            @endforeach
        </select>
        @error('aula')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-4">
        <label for="dia">Dia:</label>
        <select class="form-control @error('dia') is-invalid @enderror" id="dia" name="dia" required>
            @foreach ($dias as $dia)
                <option value={{$dia->id}} {{ old('dia') == $dia->nombre ? 'selected' : '' }}>{{$dia->nombre}}</option>
            @endforeach
        </select>
        @error('dia')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-4">
        <label for="hora">Horas:</label>
        <select class="form-control @error('hora') is-invalid @enderror" id="hora" name="hora" required>
            @foreach ($horas as $hora)
                <option 
                    value={{$hora->id}}
                    {{ old('hora') == $hora->id ? 'selected' : '' }}
                    >{{$hora->hora_ini .' - '.$hora->hora_fin}}
                </option>
            @endforeach
        </select>
        @error('hora')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>