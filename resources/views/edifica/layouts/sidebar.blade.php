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
        @include('edifica/layouts.menu')
    </ul>
</aside>
