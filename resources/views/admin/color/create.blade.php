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
                    <h3 class="card-title">Add New Color</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="{{ url('admin/color') }}" method="POST">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label>Color Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name')}}" placeholder="Enter Brand Name">
                        {{ $errors->first('name') }}
                      </div>
                      <div class="form-group">
                        <label>Color Code <span class="text-danger">*</span></label>
                        <input type="color" name="code" class="form-control" required value="{{ old('code')}}" placeholder="Enter Color Code">
                        {{ $errors->first('code') }}
                      </div>
                      <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" id="" class="form-control">
                            <option value="0" {{(old('status') == 0 ? 'selected' : '')}}>Active</option>
                            <option value="1" {{(old('status') == 1 ? 'selected' : '')}}>Inactve</option>
                        </select>
                      </div>
                      
                      <hr>
  
                     
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