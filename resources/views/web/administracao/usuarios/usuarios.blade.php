@extends('web/layout/index')

@section('conteudo')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Usuários</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
          <li class="breadcrumb-item active">Controle de usuarios</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">Lista de Usuários</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
              <li class="page-item"><button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalAddUsuario"> <i class="fas fa-plus"></i></button></li>
              </ul>
            </div>
          </div>

          <!-- Modal Adicionar Usuario -->
          <div class="modal fade" id="modalAddUsuario" tabindex="-1" role="dialog" aria-labelledby="modalUsuarioTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalAddUsuario"> Adicionar Usuário </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <form action="{{route('usuariosAdd')}} " class="form-horizontal" method="POST">
                  @csrf
                  <div class="modal-body">
                    <div class="card-body">
                      
                      <div class="form-group row">
                        <label for="nome" class="col-sm-3 col-form-label">Nome</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome completo">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" name="email" id="email" placeholder="email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Senha</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" name="password" id="email" placeholder="Insira nova senha">
                        </div>
                      </div>
                      
                      {{-- <div class="form-group row">
                        <label for="perfil" class="col-sm-3 col-form-label">Perfil</label>
                        <div class="col-sm-9">
                          <select class="form-control select2" name="perfil" id="perfil">
                            <option selected="selected">Select</option>
                            @foreach ($perfilCatalogo as $item)
                                <option value="{{$item->id}}">{{$item->perfil}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div> --}}

                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                  </div>

                </form>
              </div>
            </div>
          </div>


          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped ">
              <thead>
                <tr>
                  <th></th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Criado em</th>
                  <th>Status</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody>

                @foreach ( $usuarios as $usuario )

                <?php
                if ($usuario->status === 'Ativo') {
                  $color = 'success';
                } else {
                  $color = 'danger';
                }

                if ($usuario->profile_photo_path != "") {
                  $photo = $usuario->profile_photo_path;
                }else {
                  // $photo = $usuario->profile_photo_url;
                  $photo = asset('AdminLTE/dist/img/icone_user.png');
                }
                
                ?>
                
                <tr>
                  <td>
                    <div class="image user-panel" width="10px" height="10px" >
                      <img class="img-circle img-sm" src="{{ asset($photo)}}" alt="{{ $usuario->name }}" >
                    </div>
                  </td>
                  <td>{{ $usuario->name }} </td>
                  <td>{{ $usuario->email }}</td>
                  <td>{{ date('d/m/Y', strtotime($usuario->created_at)) }}</td>
                  <td><span class="badge bg-{{$color}}"> {{ $usuario->status }} </span></td>
                  <td><a href="{{route('usuariosPerfil',['id' => $usuario->id]) }} " class="btn btn-xs text-primary"> <i class="fas fa-eye"></i></a>
                      <button class="btn btn-xs text-primary" data-toggle="modal" data-target="#modalEditUsuario{{ $usuario->id }}"> <i class="fas fa-pen"></i> </button>
                      <button class="btn btn-xs text-danger" data-toggle="modal" data-target="#modalDelUsuario{{ $usuario->id }}"> <i class="fas fa-times"></i> </button> </td>
                </tr>

                <!-- Modal Editar Usuario -->
                <div class="modal fade" id="modalEditUsuario{{ $usuario->id }}" tabindex="-1" role="dialog" aria-labelledby="modalUsuarioTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalEditUsuarioTitle"> Editar Usuário </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <form action="{{route('usuariosEdit',['id' => $usuario->id ])}} " class="form-horizontal" method="POST">
                        @csrf
                        @method("PUT")
                        <div class="modal-body">
                          <div class="card-body">
                            
                            <div class="form-group row">
                              <label for="nome" class="col-sm-3 col-form-label">Nome</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" name="nome" id="nome" value="{{ $usuario->name }}" placeholder="Nome completo">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="email" class="col-sm-3 col-form-label">Email</label>
                              <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="email" value="{{ $usuario->email }}" placeholder="email">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="password" class="col-sm-3 col-form-label">Senha</label>
                              <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" id="email" placeholder="Insira nova senha">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>

                <!-- Modal Deletar Usuario -->

                <div class="modal fade" id="modalDelUsuario{{ $usuario->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content bg-danger">
                      <div class="modal-header">
                        <h4 class="modal-title">Deletar Usuário</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="{{route('usuariosDelete',['id' => $usuario->id ] )}}" method="post">
                        @csrf
                        @method("DELETE")
                        <div class="modal-body">
                          <p>Deseja deletar o usuario :</p>
                          <p><b> {{ $usuario->name }} </b></p>
                        </div>
                        <div class="modal-footer justify-content-between">  
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-outline-light">Deletar</button>
                      </form>
                  </div>
                </div>
                  
                @endforeach
                
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection