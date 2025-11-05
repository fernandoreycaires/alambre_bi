@extends('web/layout/index')

@section('conteudo')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1> <a href="{{route('usuarios')}}" class="btn text-primary "><i class="fas fa-chevron-left"></i></a> Perfil do Usuário</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
          <li class="breadcrumb-item active">Perfil de usuário</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-4">

        <div class="card card-outline card-primary">
          <?php
            if ($usuario->status === 'Ativo') {
              $color = 'success';
              $alteraStatus = 'Bloqueado';
              $btnAlteraStatus = 'Bloquear';
            } else {
              $color = 'danger';
              $alteraStatus = 'Ativo';
              $btnAlteraStatus = 'Ativar';
            }

            if ($usuario->profile_photo_path != "") {
              $photo = $usuario->profile_photo_path;
            }else {
              // $photo = $usuario->profile_photo_url;
              $photo = asset('AdminLTE/dist/img/icone_user.png');
            }
            
            ?>
          
          <!-- /.card-header -->
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="{{ $photo }} " alt="{{ $usuario->name }}">
            </div>
            <div>
              <h3 class="profile-username text-center">{{ $usuario->name }}</h3>
              {{-- <p class="text-muted text-center"> Cargo do Individuo </p> --}}
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Email:</b> <a class="float-right">{{ $usuario->email }}</a>
                </li>
                <li class="list-group-item">
                  <b>Adicionado em:</b> <a class="float-right">{{ date('d/m/Y H:m', strtotime($usuario->created_at)) }}</a>
                </li>
                <li class="list-group-item">
                  <b>Editado em: </b> <a class="float-right">{{ date('d/m/Y H:m', strtotime($usuario->updated_at)) }}</a>
                </li>
                <li class="list-group-item">
                  <b>Status: </b> <a class="float-right"><span class="badge bg-{{$color}}">{{ $usuario->status }}</span></a>
                </li>
              </ul>
              <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalEditUsuario"><i class="fas fa-pen"></i> <b>Editar</b></button>
              <button class="btn btn-outline-warning btn-block" data-toggle="modal" data-target="#modal-status"><i class="fas fa-times"></i> <b>{{$btnAlteraStatus}} </b></button>
              <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#modalDelUsuario"><i class="fas fa-times"></i> <b>Excluir</b></button>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
       
      </div> 
      <!-- ./ col md-4  -->

      <div class="col-md-4">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">Acessos Liberados </h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
              <li class="page-item"><button class="btn btn-xs text-primary" data-toggle="modal" data-target="#modalCatalogo"> <i class="fas fa-plus"></i></button></li>
              </ul>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th style="width: 300px">Acesso</th>
                  <th style="width: 50px">Remover</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($perfis as $perfil)
                  @foreach ($perfil->perfil_catalogo as $item)
                  @if ($item->id != '99307e4c-76b4-42f8-8ae3-e9f919c38c29')
                    <form action="{{route('delPerfil',['id' => $usuario->id] )}}" method="post">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="perfil" value="{{ $perfil->id }}">
                      <tr>
                        <td>{{ $item->perfil }} </td>
                        <td><button type="submit" class="btn btn-xs btn-danger" > <i class="fas fa-times"></i> Remover</button></td>
                      </tr>
                    </form>
                  @endif
                  @endforeach
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Modal Catalogo de Acessos -->
        <div class="modal fade" id="modalCatalogo" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Permissões de acesso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                                   
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th>Catálogo de Acessos</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($catalogo as $item) {{-- Busca todo o catalogo de perfis --}}
                      @if ($item->id != '99307e4c-76b4-42f8-8ae3-e9f919c38c29')
                   
                        <form action="{{route('addPerfil',['id' => $usuario->id])}} " method="post">
                          @csrf
                          <input type="hidden" name="perfil" value="{{$item->id}}">
                          <tr>
                            <td>{{$item->perfil}} </td>
                            <td><button type="submit" class="btn btn-xs btn-success" > <i class="fas fa-plus"></i> Adicionar</button></td>
                          </tr>    
                        </form>    
                        
                      @endif                       
                    @endforeach
                  </tbody>
                </table>
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- ./ COL MD-8 -->


      <!-- Modal Mudar Status do Usuario -->
      <div class="modal fade" id="modal-status">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Alterar Status do Usuário</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('usuariosStatus',['id' => $usuario->id ])}} " method="post">
              @csrf
              @method('PUT')
              <div class="modal-body">
                <input type="hidden" name="status" value="{{$alteraStatus}}">
                <p>para: <b> {{$alteraStatus}} </b> </p>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-outline-dark">Salvar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal Editar Usuario -->
      <div class="modal fade" id="modalEditUsuario" tabindex="-1" role="dialog" aria-labelledby="modalUsuarioTitle" aria-hidden="true">
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
                  <div class="form-group row">
                    <label for="nome" class="col-sm-3 col-form-label">Avatar</label>
                    <div class="col-sm-9">
                      <p>Atual</p>
                      <ul class="list-inline">
                        <li class="list-inline-item">
                          <div class="radio-container-avatar">
                            <label for="{{$usuario->id}}">
                              <input class="radio-avatar" type="radio" id="{{$usuario->id}}" name="avatar_select" checked>
                              <div class="custom-radio-avatar">
                                <img alt="Avatar" id="avatar" class="table-avatar img-circle img-sm" src="{{asset($photo)}}">
                              </div>
                            </label>
                          </div>
                        </li>
                      </ul>
                      <p>Opções para selecionar</p>
                      <ul class="list-inline">
                        @foreach ($avatares as $avatar)
                          <li class="list-inline-item">
                            <div class="radio-container-avatar">
                              <label for="{{$avatar->id}}">
                                <input class="radio-avatar" type="radio" name="avatar_select" id="{{$avatar->id}}" value="{{asset($avatar->url)}}">
                                <div class="custom-radio-avatar">
                                  <img id="avatar" class="table-avatar img-circle img-sm" alt="Avatar" src="{{asset($avatar->url)}}">
                                </div>
                              </label>
                            </div>
                          </li>
                        @endforeach
                      </ul>
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
      <div class="modal fade" id="modalDelUsuario">
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
      </div>
        
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection