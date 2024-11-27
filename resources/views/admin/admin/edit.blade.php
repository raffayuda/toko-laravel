@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
         <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Edit Admin</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="{{ url('admin/admin/list/'.$data->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                      <input type="hidden" name="is_admin" value="1">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ $data->name }}" required>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ $data->email }}" required>
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="pasword" class="form-control" placeholder="Enter Password">
                        <p>Do you want to change password?</p>
                      </div>
                      <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="" class="form-control" required>
                            <option {{($data->status == 0 ? 'selected' : '')}} value="0">Active</option>
                            <option {{($data->status == 1 ? 'selected' : '')}} value="1">Inactve</option>
                        </select>
                      </div>
                     
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
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