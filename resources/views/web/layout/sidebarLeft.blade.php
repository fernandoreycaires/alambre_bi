<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <?php
  
    $photo = asset('AdminLTE/dist/img/user2-160x160.jpg');

    if (Auth::user()->profile_photo_path != "") {
      $photo = Auth::user()->profile_photo_path;
    }

  ?>
    
  <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
      <img src="{{asset('AdminLTE/dist/img/AdminLTELogo.png')}}"  class="brand-image img-circle elevation-3" style="opacity: 1">
      <span class="brand-text font-weight-light">Alambre B.I.</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" width="10px" height="10px" >
          <img class="img-circle elevation-2" src="{{ $photo }}" alt="{{ Auth::user()->name }}" >
          {{-- <img class="img-circle elevation-2" src="{{asset('AdminLTE/dist/img/user2-160x160.jpg')}}" alt="{{ Auth::user()->name }}" > --}}
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          @foreach ( $permissoes as $permissao )
            @foreach ( $permissao->perfil_catalogo as $item )
              
              @if ($permissao->id_catalogo == '99307e4c-76b4-42f8-8ae3-e9f919c38c29' || $item->perfil == 'Diretoria')
                <li class="nav-item">
                  <a href="{{route('dashboard')}}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                      Pagina Inicial
                    </p>
                  </a>
                </li>
              @endif

              {{-- @if ($permissao->id_catalogo == '99307e4c-76b4-42f8-8ae3-e9f919c38c29' || $item->perfil == 'Diretoria' || $item->perfil == 'Comercial' || $item->perfil == 'Clientes')
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Clientes
                    </p>
                  </a>
                </li>
              @endif

              @if ($permissao->id_catalogo == '99307e4c-76b4-42f8-8ae3-e9f919c38c29' || $item->perfil == 'Diretoria' || $item->perfil == 'Recursos Humanos')
                <li class="nav-item">
                  <a href="{{route('dashboardRH')}} " class="nav-link">
                    <i class="nav-icon fas fa-user-cog"></i>
                    <p>
                      Recursos Humanos
                    </p>
                  </a>
                </li>
              @endif

              @if ($permissao->id_catalogo == '99307e4c-76b4-42f8-8ae3-e9f919c38c29' || $item->perfil == 'Diretoria' || $item->perfil == 'Operacional' || $item->perfil == 'Veículos')
                <li class="nav-item">
                  <a href="{{route('veiculo')}}" class="nav-link">
                    <i class="nav-icon fas fa-car"></i>
                    <p>
                      Veículos
                    </p>
                  </a>
                </li>
              @endif
              
              @if ($permissao->id_catalogo == '99307e4c-76b4-42f8-8ae3-e9f919c38c29' || $item->perfil == 'Diretoria' || $item->perfil == 'Operacional' || $item->perfil == 'Motoristas')
                <li class="nav-item">
                  <a href=" {{route('motorista')}} " class="nav-link">
                    <i class="nav-icon fas fa-tag"></i>
                    <p>
                      Motoristas
                    </p>
                  </a>
                </li>
              @endif --}}

              {{-- @if ($permissao->id_catalogo == '99307e4c-76b4-42f8-8ae3-e9f919c38c29' || $item->perfil == 'Diretoria' || $item->perfil == 'Operacional' || $item->perfil == 'Motoristas')
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-dharmachakra"></i>
                    <p>
                      Operacional
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview"> --}}
                    {{-- <li class="nav-item">
                      <a href="{{route('dashboardOpm')}}" class="nav-link">
                        <i class="far fa-circle text-success nav-icon"></i>
                        <p>Inicio Operacional </p>
                      </a>
                    </li> --}}
                    
                    {{-- Operacional EDI / CTE --}}
                    {{-- <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Inserir Docts (EDI/XML)
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{route('dashboardEdi')}} " class="nav-link">
                            <i class="far fas fa-dharmachakra text-warning nav-icon"></i>
                            <p>EDI (Inserir)</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{route('dashboardXml')}} " class="nav-link">
                            <i class="far fas fa-dharmachakra text-warning nav-icon"></i>
                            <p>XML (Inserir)</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{route('dashboardCte')}} " class="nav-link">
                            <i class="far fas fa-dharmachakra text-warning nav-icon"></i>
                            <p>CTEs (Consultar)</p>
                          </a>
                        </li>
                      </ul>
                    </li> --}}

                    {{-- Operacional Agregados --}}
                    {{-- <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Motoristas
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{route('veiculo')}} " class="nav-link">
                            <i class="far fas fa-car text-warning nav-icon"></i>
                            <p>Veiculos</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{route('motorista')}} " class="nav-link">
                            <i class="far fas fa-tag text-warning nav-icon"></i>
                            <p>Motoristas</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{route('controleMotorista')}} " class="nav-link">
                            <i class="far fas fa-dharmachakra text-warning nav-icon"></i>
                            <p>Controles</p>
                          </a>
                        </li>
                      </ul>
                    </li>

                    
                  </ul>
                </li>
              @endif --}}

              {{-- @if ($permissao->id_catalogo == '99307e4c-76b4-42f8-8ae3-e9f919c38c29' || $item->perfil == 'Diretoria' || $item->perfil == 'Financeiro' )
                <!--Financeiro-->
                <li class="nav-item">
                  <a href=" " class="nav-link">
                    <i class="nav-icon fas fa-wallet"></i>
                    <p>
                      Financeiro
                    </p>
                  </a>
                </li> 
              @endif --}}
            
              {{-- @if ($permissao->id_catalogo == '99307e4c-76b4-42f8-8ae3-e9f919c38c29' || $item->perfil == 'Diretoria' || $item->perfil == 'Contábil' )
                <!--Contabilidade-->
                <li class="nav-item">
                  <a href=" " class="nav-link">
                    <i class="nav-icon fas fa-receipt"></i>
                    <p>
                      Contábil
                    </p>
                  </a>
                </li> 
              @endif --}}

              @if ($permissao->id_catalogo == '99307e4c-76b4-42f8-8ae3-e9f919c38c29' || $item->perfil == 'Diretoria' || $item->perfil == 'Relatorios' )
                <!--Relatorios-->
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-file-signature"></i>
                    <p>
                      Relatórios
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{route('dashboardRel')}} " class="nav-link">
                        <i class="fa fa-users text-warning nav-icon"></i>
                        <p>Home</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{route('dashboardML')}} " class="nav-link">
                        <i class="fa fa-store-alt text-warning nav-icon"></i>
                        <p>Mercado Livre </p>
                      </a>
                    </li>
                  </ul> 
                </li>
              @endif

              @if ($permissao->id_catalogo == '99307e4c-76b4-42f8-8ae3-e9f919c38c29' || $item->perfil == 'Diretoria' || $item->perfil == 'Administrador' )
                <!--Administração-->
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-address-card"></i>
                    <p>
                      Administração
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{route('dashboardAdm')}} " class="nav-link">
                        <i class="fa fa-tools text-warning nav-icon"></i>
                        <p>Configurações </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{route('usuarios')}} " class="nav-link">
                        <i class="fa fa-users text-warning nav-icon"></i>
                        <p>Usuários</p>
                      </a>
                    </li>
                  </ul> 
                </li>
              @endif

            @endforeach
          @endforeach

          <li class="nav-item">
            <a href="#" onclick="event.preventDefault; document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon fas fa-door-open"></i>
              <p>
                Sair
              </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
              @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  