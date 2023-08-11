<header id="header" class="d-flex align-items-center justify-content-between p-3">
    <div>
        <button id="toggleButton" type="button" class="btn btn-header"></button>
        <span>Mi Aplicación</span>
    </div>
    <div>
        <span>{{ Auth::user()->nombres.' '.Auth::user()->apellidos  }}</span>
        
        {{-- <button href="{{ route('login.logout') }}" id="btnLogout" type="button" class="btn btn-header"></button> --}}

        {{-- Revisar los estilos de este button --}}
        <a href="{{ route('login.logout') }}" id="btnLogout" type="button" class="btn btn-header"></a>
    </div>
</header>