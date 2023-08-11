@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Ver Role</h2>
            <div class="card" id="card-datos">
                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-4">
                            <label class="form-input-label" for="id">ID:</label>
                            <div class="form-input">{{ $role->id }}</div>
                        </div>
    
                        <div class="form-group col-4">
                            <label class="form-input-label" for="nombre">Nombre:</label>
                            <div class="form-input">{{ $role->nombre }}</div>
                        </div>
                    </div>
                    <hr>
                    {{-- <h4 style="font-size: 18px;">Permisos</h4> --}}
                </div>
            </div>
        </div>
    </div>
    
@endsection