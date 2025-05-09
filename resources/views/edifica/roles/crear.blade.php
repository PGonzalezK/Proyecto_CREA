@extends('edifica/layouts.app')

@section('edifica/content')
<section class="section">
    <div class="section-header text-center">
        <h2 class="page__heading">Crear Rol</h2>
    </div>
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">

                        @if ($errors->any())                                                            
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                <strong>¡Revise los campos!</strong>
                                @foreach ($errors->all() as $error)
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        {!! Form::open(['route' => 'edifica.roles.store', 'method' => 'POST']) !!}
                        
                        <div class="form-group">
                            <label for="name" class="display-4 font-weight-bold">Nombre del Rol:</label>
                            {!! Form::text('name', null, ['class' => 'form-control form-control-sm']) !!}
                        </div>

                        <div class="form-group mt-4">
                            <label class="h3 font-weight-bold d-block mb-4">Permisos para este Rol:</label>

                            <div id="accordion">
                                @foreach($permission as $grupo => $permisos)
                                    <div class="card border-light mb-2">
                                        <div class="card-header py-2 px-3 bg-light" id="heading-{{ $grupo }}">
                                            <h6 class="mb-0">
                                                <a class="d-block text-dark small font-weight-bold" style="font-size: 0.9rem;" data-toggle="collapse" href="#collapse-{{ $grupo }}" aria-expanded="false" aria-controls="collapse-{{ $grupo }}">
                                                    {{ strtoupper($grupo) }}
                                                </a>
                                            </h6>
                                        </div>

                                        <div id="collapse-{{ $grupo }}" class="collapse" aria-labelledby="heading-{{ $grupo }}" data-parent="#accordion">
                                            <div class="card-body py-2">
                                                <div class="row">
                                                    @foreach($permisos as $permiso)
                                                        <div class="col-md-4 mb-2">
                                                            <div class="form-check small">
                                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permiso->id }}" id="permiso_{{ $permiso->id }}">
                                                                <label class="form-check-label font-weight-bold" for="permiso_{{ $permiso->id }}">
                                                                    {{ ucwords(str_replace('-', ' ', $permiso->name)) }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4 text-right">
                            <a href="{{ route('edifica.roles.index') }}" class="btn btn-secondary btn-sm mr-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
