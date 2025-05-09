@extends('crea/layouts.app')

@section('crea/content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Área Técnica</h3>
    </div>
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Listado de Códigos SERVIU</h5>
                        <form method="GET" action="{{ route('crea.tecnica.index') }}" class="d-flex">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm me-2" placeholder="Buscar código...">
                            <button class="btn btn-light btn-sm" type="submit">Buscar</button>
                        </form>
                    </div>
                    <div class="card-body">
                        @if($paginados->isEmpty())
                            <p class="text-center text-muted">No se encontraron resultados.</p>
                        @else
                            <div class="list-group">
                                @foreach($paginados as $codigo => $grupo)
                                    <a href="{{ route('crea.tecnica.show', $codigo) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span><strong>Código:</strong> {{ $codigo }}</span>
                                        <span class="badge bg-primary rounded-pill">{{ $grupo->count() }} individuos</span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                    {{ $paginados->withQueryString()->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
