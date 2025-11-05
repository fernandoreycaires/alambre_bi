<!DOCTYPE html>
<html lang="pt-br">

  @includeIf('web/layout/head')

  <body class="hold-transition {{ Auth::user()->theme_body }} sidebar-mini layout-fixed sidebar-collapse">
    <div class="wrapper">

      <!-- Preloader -->
      {{-- @includeIf('web/layout/preloader') --}}

      <!-- header e navbar -->
      @includeIf('web/layout/header')

      <!-- Main Sidebar Container -->
      @includeIf('web/layout/sidebarLeft')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- CONTEUDO DA PAGINA -->
        @yield('conteudo')

        
      </div>
      <!-- /.content-wrapper -->
      
      <!-- footer -->
      @includeIf('web/layout/footer')

      <!-- Control Sidebar -->
      {{-- @includeIf('web/layout/sidebarRight') --}}

    </div>
    <!-- ./wrapper -->

    <!-- JavaScript -->
    @includeIf('web/layout/js')


  </body>
</html>