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
                    <h3 class="card-title">Add New Category</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="{{ url('admin/category') }}" method="POST">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label>Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name')}}" placeholder="Enter Category Name">
                        {{ $errors->first('name') }}
                      </div>
                      <div class="form-group">
                        <label>Slug <span class="text-danger">*</span></label>
                        <input type="text" name="slug" class="form-control" required value="{{ old('slug')}}" placeholder="Enter Slug">
                        {{ $errors->first('slug') }}
                      </div>
                      <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" id="" class="form-control">
                            <option value="0" {{(old('status') == 0 ? 'selected' : '')}}>Active</option>
                            <option value="1" {{(old('status') == 1 ? 'selected' : '')}}>Inactve</option>
                        </select>
                      </div>
                      
                      <hr>
  
                      <div class="form-group">
                          <label for="">Meta Title <span class="text-danger">*</span></label>
                          <input type="text" required class="form-control" name="meta_title" value="{{ old('meta_title')}}" placeholder="Meta Title">
                      </div>
                      <div class="form-group">
                          <label for="">Meta Description</label>
                          <textarea name="meta_description" id="" cols="30" rows="10" placeholder="Meta Description" class="form-control">{{ old('meta_description') }}</textarea>
                      </div>
                      <div class="form-group">
                          <label for="">Meta Keywords</label>
                          <input type="text" class="form-control" name="meta_keywords" value="{{ old('meta_keywords')}}" placeholder="Meta Keywords">
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