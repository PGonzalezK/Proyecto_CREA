<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('crea.home') }}">
        <i class="fas fa-building"></i><span>Dashboard</span>
    </a>
    <a class="nav-link" href="{{ route('crea.usuarios.index') }}">
        <i class="fas fa-users"></i><span>Usuarios</span>
    </a>
    <a class="nav-link" href="{{ route('crea.roles.index') }}">
        <i class="fas fa-user-lock"></i><span>Roles</span>
    </a>
    <a class="nav-link" href="{{ route('crea.individuos.index') }}">
        <i class="fas fa-user"></i><span>Individuos</span>
    </a>
    <a class="nav-link" href="{{ route('crea.individuos.grupales') }}">
        <i class="fas fa-layer-group"></i><span>Grupales</span>
    </a>
    <a class="nav-link" href="{{ route('crea.tecnica.index') }}">
        <i class="fas fa-user-lock"></i><span>Área Técnica</span>
    </a>
</li>