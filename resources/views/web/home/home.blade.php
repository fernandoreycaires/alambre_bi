@extends('web/layout/index')

@section('conteudo')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Menu Inicial</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
          <li class="breadcrumb-item active">Menu Inicial</li>
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

        <div class="col-md-6">
          <!-- Application buttons -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Application Buttons</h3>
            </div>
            <div class="card-body">
              <p>Add the classes <code>.btn.btn-app</code> to an <code>&lt;a></code> tag to achieve the following:</p>
              <a class="btn btn-app">
                <i class="fas fa-edit"></i> Edit
              </a>
              <a class="btn btn-app">
                <i class="fas fa-play"></i> Play
              </a>
              <a class="btn btn-app">
                <i class="fas fa-pause"></i> Pause
              </a>
              <a class="btn btn-app">
                <i class="fas fa-save"></i> Save
              </a>
              <a class="btn btn-app">
                <span class="badge bg-warning">3</span>
                <i class="fas fa-bullhorn"></i> Notifications
              </a>
              <a class="btn btn-app">
                <span class="badge bg-success">300</span>
                <i class="fas fa-barcode"></i> Products
              </a>
              <a class="btn btn-app">
                <span class="badge bg-purple">891</span>
                <i class="fas fa-users"></i> Users
              </a>
              <a class="btn btn-app">
                <span class="badge bg-teal">67</span>
                <i class="fas fa-inbox"></i> Orders
              </a>
              <a class="btn btn-app">
                <span class="badge bg-info">12</span>
                <i class="fas fa-envelope"></i> Inbox
              </a>
              <a class="btn btn-app">
                <span class="badge bg-danger">531</span>
                <i class="fas fa-heart"></i> Likes
              </a>

              <p>Application Buttons with Custom Colors</p>
              <a class="btn btn-app bg-secondary">
                <span class="badge bg-success">300</span>
                <i class="fas fa-barcode"></i> Products
              </a>
              <a class="btn btn-app bg-success">
                <span class="badge bg-purple">891</span>
                <i class="fas fa-users"></i> Users
              </a>
              <a class="btn btn-app bg-danger">
                <span class="badge bg-teal">67</span>
                <i class="fas fa-inbox"></i> Orders
              </a>
              <a class="btn btn-app bg-warning">
                <span class="badge bg-info">12</span>
                <i class="fas fa-envelope"></i> Inbox
              </a>
              <a class="btn btn-app bg-info">
                <span class="badge bg-danger">531</span>
                <i class="fas fa-heart"></i> Likes
              </a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div> 

      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
    if (!localStorage.getItem('hasReloaded')) {
        localStorage.setItem('hasReloaded', 'true');
        window.location.href = "{{ route('dashboard') }}";
    }
</script>

@endsection