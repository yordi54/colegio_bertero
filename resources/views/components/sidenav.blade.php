<nav id="sidenav">
    <div class="m-3">          
        <div class="d-flex">
            <div>
                <div id="img-logo" class="img-fluid">
                </div>
            </div>
            <div>
                <h3 class="ms-2">
                    Maria Nelly
                </h3>
                <span class="fw-bold d-flex justify-content-end">de Bertero </span>
            </div>
        </div>            
    </div>
  
    
    @if (Auth::user()->roles->contains('nombre', 'Secretario'))
        <div class="m-3 btn-dropdown">
            <button 
                class="btn btn-primary collapsed d-flex justify-content-center" style="width: 100%;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
                    <span class="pt-3 pe-1">USUARIOS</span>
                    <i class="bi bi-person-fill fs-2"></i>
            </button>
                
            <div class="collapse" id="collapseUser">
                <div class="list-group card-body">
                    <a class="list-group-item list-group-item-action" href="{{route("personas.index")}}">Personas</a>
                    <a class="list-group-item list-group-item-action" href="{{route("juntas.index")}}">Junta Escolar</a>              
                </div>
            </div>
        </div>
    @endif
    

    @if (Auth::user()->roles->contains('nombre', 'Secretario'))
    <div class="m-3 btn-dropdown">
        <button 
            class="btn btn-primary collapsed d-flex justify-content-center" style="width: 100%;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeguridad" aria-expanded="false" aria-controls="collapseSeguridad">
                <span class="pt-3 pe-1">SEGURIDAD</span>
                <i class="bi bi-person-fill fs-2"></i>
        </button>
            
        <div class="collapse" id="collapseSeguridad">
            <div class="list-group card-body">
                <a class="list-group-item list-group-item-action" href="{{route("roles.index")}}">Roles</a>                  
            </div>
        </div>
    </div>
    @endif

    @if (Auth::user()->roles->contains('nombre', 'Secretario'))
        <div class="m-3 btn-dropdown">
            <button 
            class="btn btn-primary collapsed d-flex justify-content-center" style="width: 100%;" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePedagogico" aria-expanded="false" aria-controls="collapsePedagogico">
                    <span class="pt-3 pe-1">PEDAGOGICO</span>
                    <i class="bi bi-person-fill fs-2"></i>
            </button>
            
            <div class="collapse" id="collapsePedagogico">
                <div class="list-group card-body">
                <a class="list-group-item list-group-item-action" href="{{route("materias.index")}}">Materias</a>
                <a class="list-group-item list-group-item-action" href="{{route("grados.index")}}">Grados</a>
                <a class="list-group-item list-group-item-action" href="{{route("aulas.index")}}">Aulas</a>
                <a class="list-group-item list-group-item-action" href="{{route("gradosmaterias.index")}}">Grados Materias</a>
                </div>
            </div>
        </div>
    @endif

    @if (Auth::user()->roles->contains('nombre', 'Secretario')
            || Auth::user()->roles->contains('nombre', 'Docente'))
        <div class="m-3 btn-dropdown">
            <button 
            class="btn btn-primary collapsed d-flex justify-content-center" style="width: 100%;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRegistro" aria-expanded="false" aria-controls="collapseRegistro">
                    <span class="pt-3 pe-1">REGISTRO</span>
                    <i class="bi bi-person-fill fs-2"></i>
            </button>
            
            <div class="collapse" id="collapseRegistro">
                <div class="list-group card-body">
                    <a class="list-group-item list-group-item-action" href="{{route("faltas.index")}}">Faltas</a>
                    <a class="list-group-item list-group-item-action" href="{{route("asistencias.index")}}">Asistencia</a>
                </div>
            </div>
        </div>
    @endif

     @if (Auth::user()->roles->contains('nombre', 'Secretario'))
    <div class="m-3 btn-dropdown">
        <button 
            class="btn btn-primary collapsed d-flex justify-content-center" style="width: 100%;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGeocerca" aria-expanded="false" aria-controls="collapseGeocerca">
                <span class="pt-3 pe-1">GEOCERCA</span>
                <i class="bi bi-person-fill fs-2"></i>
        </button>
            
        <div class="collapse" id="collapseGeocerca">
            <div class="list-group card-body">
                <a class="list-group-item list-group-item-action" href="{{route("geocercas.index")}}">Geocerca</a>                  
            </div>
        </div>
    </div>
    @endif

    <div class="m-3 btn-dropdown">
        <button
            id="configDropdown"
            class="btn btn-primary collapsed d-flex justify-content-center" style="width: 100%;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThemes"
            aria-expanded="false" aria-controls="collapseThemes">
                <span class="pt-3 pe-1">Configuraciones</span>
                <i class="bi bi-person-fill fs-2"></i>
        </button>
            
        <div class="collapse" id="collapseThemes">
            <div class="list-group card-body">
                <a
                    href="{{route('temas')}}"
                    style="{{ request()->routeIs('temas') ? 'background: #1662a0; color: white;': '' }}"
                    class="list-group-item list-group-item-action"
                    role="button">Temas
                </a>
                <button id="btnDark" class="list-group-item list-group-item-action">
                    Modo Oscuro
                </button>
            </div>
        </div>
    </div>
    
</nav>