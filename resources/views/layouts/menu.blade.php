<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/home">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
    <a class="nav-link" href="/usuarios">
        <i class=" fas fa-users"></i><span>Usuarios</span>
    </a>
    <a class="nav-link" href="/roles">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a>
    <!-- <a class="nav-link" href="/blogs">
        <i class=" fas fa-blog"></i><span>Blogs</span>
    </a> -->
    <a class="nav-link" href="/individuos">
        <i class=" fas fa-user"></i><span>Individuos</span>
    </a>
    <a class="nav-link" href="{{ route('individuos.grupales') }}">
        <i class=" fas fa-layer-group"></i><span>Grupales</span>
    </a>
    <a class="nav-link" href="{{ route('tecnica.index') }}">
        <i class=" fas fa-user-lock"></i><span>Area Tecnica</span>
    </a>
</li>
