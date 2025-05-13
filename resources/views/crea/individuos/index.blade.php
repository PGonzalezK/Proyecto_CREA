@extends('crea/layouts.app')

@section('crea/content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Individuos</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        @can('crear-individuo')
                        <a class="btn btn-success mb-3" href="{{ route('crea.individuos.create') }}">Nuevo</a>
                        @endcan

                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">                                     
                                <th style="display: none;">ID</th>
                                <th style="color:#fff;">Nombre</th>
                                <th style="color:#fff;">Apellido</th>
                                <th style="color:#fff;">RUT</th>
                                <th style="color:#fff;">Acciones</th>                                                                   
                            </thead>
                            <tbody>
                                @foreach ($individuos as $individuo)
                                <tr>
                                    <td style="display: none;">{{ $individuo->id }}</td>
                                    <td>{{ $individuo->nombre }}</td>
                                    <td>{{ $individuo->apellido }}</td>
                                    <td>{{ $individuo->rut }}</td>
                                    <td>
                                        <form action="{{ route('crea.individuos.destroy',$individuo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar a {{ $individuo->nombre }} {{ $individuo->apellido }}? Esta acción no se puede deshacer.');">

                                            @can('ver-individuo')
                                            <a class="btn btn-primary btn-sm" href="{{ route('crea.individuos.show', $individuo->id) }}">Ver</a>
                                            @endcan

                                            @can('editar-individuo')
                                            <a class="btn btn-warning btn-sm" href="{{ route('crea.individuos.edit',$individuo->id) }}">Editar</a>
                                            @endcan

                                            @csrf
                                            @method('DELETE')
                                            @can('borrar-individuo')
                                            <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Paginación -->
                        <div class="pagination justify-content-end">
                            {!! $individuos->links() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
