@php
    $portal = session('portal', 'crea'); // fallback a 'crea' si no hay valor en sesión
    $logoPath = "img/logo-$portal.png";
    if (!file_exists(public_path($logoPath))) {
        $logoPath = "img/logo.png"; // fallback si el logo del portal no existe
    }
@endphp

<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <img src="{{ asset($logoPath) }}?v={{ filemtime(public_path($logoPath)) }}" width="30" height="70" alt="logo">
        <a href="{{ url('/') }}"></a>
    </div>

    <div class="sidebar-brand sidebar-brand-sm" style="height: 70px;">
        <a href="{{ url('/') }}" 
        class="d-flex justify-content-center align-items-center" 
        style="width: 100%; height: 100%;">
            <i class="fas fa-home" 
            style="font-size: 30px; line-height: 1; margin: 0 auto; color: #007bff;" 
            title="Inicio"></i>
        </a>
    </div>


    <ul class="sidebar-menu">
        <li class="side-menus {{ Request::is('*') ? 'active' : '' }}">

            <a class="nav-link" href="{{ route($portal . '.home') }}">
                <i class="fas fa-building"></i><span>Dashboard</span>
            </a>

            @can('ver-usuario')
            <a class="nav-link" href="{{ route($portal . '.usuarios.index') }}">
                <i class="fas fa-users"></i><span>Usuarios</span>
            </a>
            @endcan

            @can('ver-rol')
            <a class="nav-link" href="{{ route($portal . '.roles.index') }}">
                <i class="fas fa-user-lock"></i><span>Roles</span>
            </a>
            @endcan

            @can('ver-individuo')
            <a class="nav-link" href="{{ route($portal . '.individuos.index') }}">
                <i class="fas fa-user"></i><span>Individuos</span>
            </a>
            @endcan

            @can('ver-individuo')
            <a class="nav-link" href="{{ route($portal . '.individuos.grupales') }}">
                <i class="fas fa-layer-group"></i><span>Grupales</span>
            </a>
            @endcan

            @can('ver-area-tecnica')
            <a class="nav-link" href="{{ route($portal . '.tecnica.index') }}">
                <i class="fas fa-user-lock"></i><span>Área Técnica</span>
            </a>
            @endcan

        </li>
    </ul>
</aside>
