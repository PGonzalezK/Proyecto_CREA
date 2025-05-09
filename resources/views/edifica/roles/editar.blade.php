@extends('edifica/layouts.app')

@section('edifica/content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Editar Rol</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

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

                        {!! Form::model($role, ['method' => 'PATCH','route' => ['edifica.roles.update', $role->id]]) !!}

                        <div class="form-group">
                            <label for="name">Nombre del Rol:</label>
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="permission"><strong>Permisos para este Rol:</strong></label>
                            <div class="row">
                                @foreach($permission as $group => $permissions)
                                <div class="col-12">
                                    <h5>{{ ucfirst($group) }}</h5>
                                </div>
                                @foreach($permissions as $value)
                                <div class="col-md-4">
                                    <div class="form-check mb-2">
                                        <label class="form-check-label">
                                            {!! Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions), ['class' => 'form-check-input']) !!}
                                            {{ ucwords(str_replace('-', ' ', $value->name)) }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                                @endforeach

                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection