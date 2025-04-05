@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Crear Individuo</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>¡Ups!</strong> Revisa los campos obligatorios.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('individuos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @include('individuos.form')
                            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                            <a class="btn btn-secondary mt-3" href="{{ route('individuos.index') }}">Volver</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

