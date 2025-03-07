@extends('layouts.backend')

@section('content')
<div class="container py-4">
    <div class="card shadow-xl">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Mi Perfil</h4>
        </div>
        <div class="card-body">

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('perfil.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="last_name">Apellido</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="mb-3">
                    <label>Avatar (Opcional)</label>
                    <input type="file" name="avatar" class="form-control">
                    @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" width="100" class="mt-2 rounded">
                    @endif
                </div>

                <hr>
                <h5 class="mb-3">Cambiar Contraseña (Opcional)</h5>

                <div class="mb-3">
                    <label for="password">Nueva Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
            </form>

        </div>
    </div>
</div>
@endsection