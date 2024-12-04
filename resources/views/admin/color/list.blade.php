@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
         <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-10">
              <h1>Color List</h1>
            </div>
            <div class="col">
              <a href="{{url('admin/color/create')}}" class="btn btn-success " style="text-align: right">Add New Brand</a>
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
                  <h3 class="card-title">Color List</h3>
                </div>
                <div class="card-body p-0">
                  <table class="table table-sm table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created By</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($datas as $item)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->created_by}}</td>
                        <td>{{$item->code}}</td>
                        <td>{{($item->status == 0) ? 'Active' : 'Inactive'}}</td>
                        <td>{{ $item->created_at->format('d-m-Y')}}</td>
                        <td class="d-flex justify-content-center">
                          <form action="{{url('admin/color/'.$item->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                          </form> | 
                          <a href="{{url('admin/color/'.$item->id.'/edit')}}" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            {{ $datas->links() }}
           
          </div>
          <!-- /.row -->
          
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
@endsection