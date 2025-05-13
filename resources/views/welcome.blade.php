<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" />
    <title>Portal</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                    <div class="card-header text-white bg-dark text-center py-3">
                        <h4 class="mb-0">Ingreso al Portal</h4>
                    </div>
                    <div class="card-body px-4 py-5">

                        {{-- Selector de portal --}}
                        <div class="form-group text-center mb-4">
                            <label for="portalToggle" class="mb-3 font-weight-bold">Selecciona el portal</label>
                            
                            <div class="d-flex justify-content-center align-items-center mb-2">
                                <div class="text-right pr-2">Portal Crea</div>
                                
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="portalToggle">
                                    <label class="custom-control-label" for="portalToggle"></label>
                                </div>
                                
                                <div class="text-left pl-2">Portal Edifica</div>
                            </div>
                            
                            <div class="text-center">
                                <span id="portalSelectedText" class="font-weight-bold text-primary">
                                    Estás ingresando al Portal Crea
                                </span>
                            </div>
                        </div>


                        {{-- Mensaje de error --}}
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{-- Formulario de login --}}
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input type="hidden" name="portal_selected" id="portal_selected" value="crea">

                            <div class="form-group mb-4">
                                <label for="email">Correo Electrónico</label>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password">Contraseña</label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required>
                                @error('password')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-dark w-100 mb-3">Ingresar</button>

                            @if (Route::has('password.request'))
                                <div class="text-center">
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                </div>
                            @endif
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script del switch --}}
    <script>
        const toggle = document.getElementById('portalToggle');
        const portalInput = document.getElementById('portal_selected');
        const portalText = document.getElementById('portalSelectedText');

        toggle.addEventListener('change', function () {
            const selected = this.checked ? 'edifica' : 'crea';
            portalInput.value = selected;

            portalText.textContent = `Estás ingresando al Portal ${selected.charAt(0).toUpperCase() + selected.slice(1)}`;
            portalText.className = selected === 'crea'
                ? 'font-weight-bold text-primary'
                : 'font-weight-bold text-success';
        });
    </script>

</body>
</html>
