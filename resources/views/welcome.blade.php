<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="public/img/logo.png" />
    <title>Portal</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .btn-group-toggle .btn input[type="radio"] {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg rounded">
                    <div class="card-header text-white bg-dark text-center">
                        <h4>Ingreso al Portal</h4>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Selector de portal con switch -->
                            <div class="form-group text-center mb-4">
                                <label for="portalToggle" class="mb-2"><strong>Selecciona el portal</strong></label>
                                <div class="custom-control custom-switch d-flex justify-content-center align-items-center">
                                    <span class="mr-3">Portal Crea</span>
                                    <input type="checkbox" class="custom-control-input" id="portalToggle">
                                    <label class="custom-control-label" for="portalToggle"></label>
                                    <span class="ml-3">Portal Edifica</span>
                                </div>
                            </div>
                            <div class="mt-2 text-center">
                                <span id="portalSelectedText" class="font-weight-bold text-primary">Estás ingresando al Portal Crea</span>
                            </div>

                            <!-- Campo oculto para enviar el portal -->
                            <input type="hidden" name="portal_selected" id="portal_selected" value="crea">
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">Contraseña</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" required>
                                @error('password')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group form-check mt-3">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Recordarme</label>
                            </div>
                            
                            <button type="submit" class="btn btn-dark w-100 mt-3">Ingresar</button>
                            
                            @if (Route::has('password.request'))
                            <a class="btn btn-link d-block text-center mt-2" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para capturar selección del portal -->
    <script>
        const toggle = document.getElementById('portalToggle');
        const portalInput = document.getElementById('portal_selected');
        const portalText = document.getElementById('portalSelectedText');

        toggle.addEventListener('change', function() {
            const selected = this.checked ? 'edifica' : 'crea';
            portalInput.value = selected;

            portalText.textContent = `Estás ingresando al Portal ${selected.charAt(0).toUpperCase() + selected.slice(1)}`;
            portalText.className = selected === 'crea' ?
                'font-weight-bold text-primary' :
                'font-weight-bold text-success';
        });
    </script>


</body>

</html>