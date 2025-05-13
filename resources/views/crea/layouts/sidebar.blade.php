<aside id="sidebar-wrapper">
    @php
        $portal = session('portal', 'crea');
        $logoPath = "img/logo-$portal.png";
    @endphp

    <div class="sidebar-brand">
        <img src="{{ asset($logoPath) }}?v={{ file_exists(public_path($logoPath)) ? filemtime(public_path($logoPath)) : time() }}" width="65" alt="logo">
        <a href="{{ url('/') }}"></a>
    </div>

    <div class="sidebar-brand sidebar-brand-sm" style="height: 70px;">
        <a href="{{ url('/') }}" 
        class="d-flex justify-content-center align-items-center" 
        style="width: 100%; height: 100%;">
            <i class="fas fa-home text-danger" 
            style="font-size: 30px; line-height: 1; margin: 0 auto;" 
            title="Inicio"></i>
        </a>
    </div>
    </div>
    <ul class="sidebar-menu">
        @include('crea/layouts.menu')
    </ul>
</aside>
