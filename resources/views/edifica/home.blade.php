@extends('edifica/layouts.app')

@section('edifica/content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Dashboard</h3>
    </div>
    <div class="section-body">
        <div class="row">
            {{-- Tarjetas de conteo --}}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">                          
                        <div class="row">
                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-c-blue order-card">
                                    <div class="card-block">
                                        <h5>Usuarios</h5>                                               
                                        @php
                                            use App\Models\User;
                                            $cant_usuarios = User::count();                                                
                                        @endphp
                                        <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{$cant_usuarios}}</span></h2>
                                        <p class="m-b-0 text-right"><a href="/edifica/usuarios" class="text-white">Ver más</a></p>
                                    </div>                                            
                                </div>                                    
                            </div>
                            
                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-c-green order-card">
                                    <div class="card-block">
                                        <h5>Roles</h5>                                               
                                        @php
                                            use Spatie\Permission\Models\Role;
                                            $cant_roles = Role::count();                                                
                                        @endphp
                                        <h2 class="text-right"><i class="fa fa-user-lock f-left"></i><span>{{$cant_roles}}</span></h2>
                                        <p class="m-b-0 text-right"><a href="/edifica/roles" class="text-white">Ver más</a></p>
                                    </div>
                                </div>
                            </div>                                                                
                            
                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-c-pink order-card">
                                    <div class="card-block">
                                        <h5>Blogs</h5>                                               
                                        @php
                                            use App\Models\Blog;
                                            $cant_blogs = Blog::count();                                                
                                        @endphp
                                        <h2 class="text-right"><i class="fa fa-blog f-left"></i><span>{{$cant_blogs}}</span></h2>
                                        <p class="m-b-0 text-right"><a href="/blogs" class="text-white">Ver más</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>

            {{-- Tabla: Carnets por vencer --}}
            <div class="col-lg-12">
                <div class="card mt-4">
                    <div class="card-header bg-warning text-dark">
                        <h5>Individuos con carnet por vencer (próximos 30 días)</h5>
                    </div>
                    <div class="card-body">
                        @if($individuosPorVencer->isEmpty())
                            <p class="text-muted">No hay carnets por vencer en los próximos 30 días.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="table-warning">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>RUT</th>
                                            <th>Fecha Carnet</th>
                                            <th>Días restantes</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($individuosPorVencer as $individuo)
                                            <tr>
                                                <td>{{ $individuo->nombre }}</td>
                                                <td>{{ $individuo->apellido }}</td>
                                                <td>{{ $individuo->rut }}</td>
                                                <td>{{ \Carbon\Carbon::parse($individuo->fecha_carnet)->format('d-m-Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($individuo->fecha_carnet)->diffInDays(now()) }}</td>
                                                <td>
                                                    <a href="{{ route('individuos.show', $individuo->id) }}" class="btn btn-sm btn-primary">Ver</a>
                                                    <a href="{{ route('individuos.edit', $individuo->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Tabla: Carnets vencidos --}}
            <div class="col-lg-12">
                <div class="card mt-4">
                    <div class="card-header bg-danger text-white">
                        <h5>Individuos con carnet vencido</h5>
                    </div>
                    <div class="card-body">
                        @if($individuosVencidos->isEmpty())
                            <p class="text-muted">No hay carnets vencidos.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="table-danger">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>RUT</th>
                                            <th>Fecha Carnet</th>
                                            <th>Días vencido</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($individuosVencidos as $individuo)
                                            <tr>
                                                <td>{{ $individuo->nombre }}</td>
                                                <td>{{ $individuo->apellido }}</td>
                                                <td>{{ $individuo->rut }}</td>
                                                <td>{{ \Carbon\Carbon::parse($individuo->fecha_carnet)->format('d-m-Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($individuo->fecha_carnet)->diffInDays(now()) }}</td>
                                                <td>
                                                    <a href="{{ route('edifica.individuos.show', $individuo->id) }}" class="btn btn-sm btn-primary">Ver</a>
                                                    <a href="{{ route('edifica.individuos.edit', $individuo->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
