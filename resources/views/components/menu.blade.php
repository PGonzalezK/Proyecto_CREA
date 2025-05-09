@php
    $portal = session('portal', 'crea'); // fallback por si no existe
@endphp
<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <img src="{{ asset('img/logo.png') }}?v={{ filemtime(public_path('img/logo.png')) }}" width="65" alt="logo">
        <a href="{{ url('/') }}"></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}" class="small-sidebar-text">
        <img src="{{ asset('img/logo.png') }}?v={{ filemtime(public_path('img/logo.png')) }}" width="45" alt="logo">
        </a>
    </div>
        <ul class="sidebar-menu">
<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route($portal . '.home') }}">
        <i class="fas fa-building"></i><span>Dashboard</span>
    </a>
    <a class="nav-link" href="{{ route($portal . '.usuarios.index') }}">
        <i class="fas fa-users"></i><span>Usuarios</span>
    </a>
    <a class="nav-link" href="{{ route($portal . '.roles.index') }}">
        <i class="fas fa-user-lock"></i><span>Roles</span>
    </a>
    <a class="nav-link" href="{{ route($portal . '.individuos.index') }}">
        <i class="fas fa-user"></i><span>Individuos</span>
    </a>
    <a class="nav-link" href="{{ route($portal . '.individuos.grupales') }}">
        <i class="fas fa-layer-group"></i><span>Grupales</span>
    </a>
    <a class="nav-link" href="{{ route($portal . '.tecnica.index') }}">
        <i class="fas fa-user-lock"></i><span>Área Técnica</span>
    </a>
</li>
    </ul>
</aside>

