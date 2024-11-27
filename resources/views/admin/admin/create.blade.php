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
                    <h3 class="card-title">Add New Admin</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="{{ url('admin/admin/list') }}" method="POST">
                    @csrf
                    <div class="card-body">
                      <input type="hidden" name="is_admin" value="1">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name')}}" placeholder="Enter Name">
                        {{ $errors->first('name') }}
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ old('email')}}">
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pasword" class="form-control" placeholder="Enter Password">
                        {{ $errors->first('password') }}
                      </div>
                      <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="0" {{(old('status') == 0 ? 'selected' : '')}}>Active</option>
                            <option value="1" {{(old('status') == 1 ? 'selected' : '')}}>Inactve</option>
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