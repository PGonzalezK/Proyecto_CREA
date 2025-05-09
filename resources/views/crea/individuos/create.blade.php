@extends('crea/layouts.app')

@section('crea/content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Crear Individuo</h3>
    </div>
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-body">

                        {{-- Mensajes de error --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>¡Ups!</strong> Revisa los campos obligatorios.
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Formulario --}}
                        <form action="{{ route('crea.individuos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Incluye los campos del formulario --}}
                            @include('crea.individuos.form')

                            <div class="mt-4 d-flex justify-content-end">
                                <a class="btn btn-secondary me-2" href="{{ route('crea.individuos.index') }}">Volver</a>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
