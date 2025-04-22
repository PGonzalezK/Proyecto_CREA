@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Individuos</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <ul>
                            @foreach($tecnicos as $codigo => $grupo)
                            <li>
                                <a href="{{ route('tecnica.show', $codigo) }}">
                                    Código: {{ $codigo }} ({{ $grupo->count() }} individuos)
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection