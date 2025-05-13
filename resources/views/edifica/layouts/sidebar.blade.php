<aside id="sidebar-wrapper">
    @php
        $portal = session('portal', 'crea'); // CREA por defecto si no está seteado
        $logoFile = public_path("img/logo-$portal.png");
        $logoPath = file_exists($logoFile) ? "img/logo-$portal.png" : "img/logo.png"; // fallback
    @endphp

    <div class="sidebar-brand">
        <img src="{{ asset($logoPath) }}?v={{ filemtime(public_path($logoPath)) }}" width="65" alt="logo">
        <a href="{{ url('/') }}"></a>
    </div>

    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}" class="small-sidebar-text">
            <img src="{{ asset($logoPath) }}?v={{ filemtime(public_path($logoPath)) }}" width="45" alt="logo">
        </a>
    </div>

    <ul class="sidebar-menu">
        @include('edifica/layouts.menu')
    </ul>
</aside>
