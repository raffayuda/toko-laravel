@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
         <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-10">
              <h1>Product List</h1>
            </div>
            <div class="col">
              <a href="{{url('admin/product/create')}}" class="btn btn-success " style="text-align: right">Add New Product</a>
            </div>
          </div>
          @include('admin.layouts._message')
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Product List</h3>
                </div>
                <div class="card-body p-0">
                  <table class="table table-sm table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Meta Title</th>
                        <th>Meta Description</th>
                        <th>Meta Keywords</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
           
          </div>
          <!-- /.row -->
          
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
@endsection