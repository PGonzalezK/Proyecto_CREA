@extends('crea/layouts.app')

@section('crea/content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Usuarios</h3>
  </div>
  <div class="section-body">
      <div class="row">
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
 
                      <a class="btn btn-success mb-3" href="{{ route('crea.usuarios.create') }}">Nuevo</a>

                      <table class="table table-striped mt-2">
                          <thead style="background-color:#6777ef">                                     
                              <th style="display: none;">ID</th>
                              <th style="color:#fff;">Nombre</th>
                              <th style="color:#fff;">E-mail</th>
                              <th style="color:#fff;">Rol</th>
                              <th style="color:#fff;">Acciones</th>                                                                   
                          </thead>
                          <tbody>
                            @foreach ($usuarios as $usuario)
                              <tr>
                                <td style="display: none;">{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                  @if(!empty($usuario->getRoleNames()))
                                    @foreach($usuario->getRoleNames() as $rolNombre)                                       
                                      <h5><span class="badge badge-dark">{{ $rolNombre }}</span></h5>
                                    @endforeach
                                  @endif
                                </td>

                                <td>
                                  <a class="btn btn-warning btn-sm" href="{{ route('crea.usuarios.edit', $usuario->id) }}">Editar</a>
                                  {!! Form::open([
                                      'method' => 'DELETE',
                                      'route' => ['crea.usuarios.destroy', $usuario->id],
                                      'style' => 'display:inline',
                                      'onsubmit' => "return confirm('¿Estás seguro de que deseas eliminar al usuario " . e($usuario->name) . "? Esta acción no se puede deshacer.');"
                                  ]) !!}
                                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger btn-sm']) !!}
                                  {!! Form::close() !!}
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                      </table>

                      <div class="pagination justify-content-end">
                          {!! $usuarios->links() !!}
                      </div>     
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
