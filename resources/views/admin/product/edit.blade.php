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
          @include('admin.layouts._message')
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Product</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('admin/product', $data->id) }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Title <span class="text-danger">*</span></label>
                      <input type="text" name="title" class="form-control" required
                        value="{{ old('title', $data->title)}}" placeholder="Enter Title">
                      {{ $errors->first('title') }}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>SKU <span class="text-danger">*</span></label>
                      <input type="text" name="sku" class="form-control" required value="{{ old('title', $data->sku)}}"
                        placeholder="Enter Title">
                      {{ $errors->first('sku') }}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Category <span class="text-danger">*</span></label>
                      <select name="category_id" class="form-control" id="ChangeCategory">
                        <option value="">Select</option>
                        @foreach ($categories as $item)
                        <option {{ (old('category_id', $data->category_id) == $item->id ? 'selected' : '') }} value="{{
                          $item->id }}">{{ $item->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Sub Category <span class="text-danger">*</span></label>
                      <select name="sub_category_id" class="form-control" id="getSubCategory">
                        @foreach ($subcategories as $item)
                        <option {{ (old('sub_category_id', $data->sub_category_id) == $item->id ? 'selected' : '') }}
                          value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Brand <span class="text-danger">*</span></label>
                      <select name="brand_id" class="form-control" id="">
                        <option value="">Select</option>
                        @foreach ($brand as $item)
                        <option {{ (old('brand_id', $data->brand_id) == $item->id ? 'selected' : '') }} value="{{
                          $item->id }}">{{ $item->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Color <span class="text-danger">*</span></label>
                      @foreach ($color as $item)
                      @php
                      $checked = '';
                      $existingColor = $data->getColor->where('color_id', $item->id)->first();
                      if($existingColor) {
                      $checked = 'checked';
                      }
                      @endphp
                      <div>
                        <label>
                          <input {{ $checked }} type="checkbox" name="color_id[]" value="{{ $item->id }}"> {{
                          $item->name }}
                        </label>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>

                <hr>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Price ($)<span class="text-danger">*</span></label>
                      <input type="text" name="price" class="form-control" required
                        value="{{ old('price', $data->price) }}" placeholder="Enter Price">
                      {{ $errors->first('price') }}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Old Price ($)<span class="text-danger">*</span></label>
                      <input type="text" name="old_price" class="form-control" required
                        value="{{ old('old_price', $data->old_price) }}" placeholder="Enter Old Price">
                      {{ $errors->first('old_price') }}
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Size <span class="text-danger">*</span></label>
                      <div>
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Price ($)</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody id="AppendSize">
                            <tr>
                              <td>
                                <input type="text" name="size[100][name]" class="form-control" placeholder="Enter Name">
                              </td>
                              <td>
                                <input type="text" name="size[100][price]" class="form-control"
                                  placeholder="Enter Price">
                              </td>
                              <td>
                                <button type="button" class="btn btn-primary btn-sm AddSize">Add</button>
                              </td>
                            </tr>

                          </tbody>
                          @php
                          $count = 1;
                          @endphp
                          @foreach ($data->getSize as $item)
                          <tbody id="AppendSize">
                            <tr id="DeleteSize{{ $count }}">
                              <td>
                                <input type="text" value="{{ $item->name }}" name="size[{{ $count }}][name]"
                                  class="form-control" placeholder="Enter Name">
                              </td>
                              <td>
                                <input type="text" value="{{ $item->price }}" name="size[{{ $count }}][price]"
                                  class="form-control" placeholder="Enter Price">
                              </td>
                              <td>
                                <button type="button" class="btn btn-danger btn-sm RemoveSize">Remove</button>
                              </td>
                            </tr>

                          </tbody>
                          @php
                          $count++;
                          @endphp
                          @endforeach

                        </table>
                      </div>
                    </div>
                  </div>

                </div>

                <hr>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group ">
                      <label>Image <span class="text-danger"></span></label>
                      <input type="file" name="image[]" multiple accept="image/*" class="form-control">
                    </div>
                  </div>
                </div>

                @if (!empty($data->getImage->count()))
                <div class="row">
                  @foreach ($data->getImage as $item)
                  <div class="col-md-4 mb-3">
                    @if (!empty($item->image_name) && file_exists(public_path('upload/product/'.$item->image_name)))
                    <img src="{{ asset('upload/product/'.$item->image_name) }}" class="img-fluid" alt="Product Image" style="width: 100%; height: 200px">
                    <a href="{{ url('admin/product/image/'.$item->id.'/delete') }}" class="btn btn-danger btn-sm mt-2">Delete</a>
                    @endif
                  </div>
                  @endforeach
                </div>
                @endif

                <hr>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Short Description <span class="text-danger">*</span></label>
                      <textarea name="short_description" id="" rows="5" class="form-control"
                        placeholder="Enter Short Description">{{ old('short_description', $data->short_description) }}</textarea>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Description <span class="text-danger">*</span></label>
                      <textarea name="description" id="tiny" rows="5" class="form-control editor"
                        placeholder="Enter Description">{{ old('description', $data->description) }}</textarea>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Additional Information <span class="text-danger">*</span></label>
                      <textarea name="additional_information" id="" rows="5" class="form-control editor"
                        placeholder="Enter additional information">{{ old('additional_information', $data->additional_information) }}</textarea>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Shipping Returns <span class="text-danger">*</span></label>
                      <textarea name="shipping_returns" id="" rows="5" class="form-control editor"
                        placeholder="Enter Shipping Returns">{{ old('shipping_returns', $data->shipping_returns) }}</textarea>
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Status <span class="text-danger">*</span></label>
                      <select name="status" id="" class="form-control">
                        <option value="0" {{(old('status')==0 ? 'selected' : '' )}}>Active</option>
                        <option value="1" {{(old('status')==1 ? 'selected' : '' )}}>Inactve</option>
                      </select>
                    </div>
                  </div>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/cy85fq5hivrxpljukn7l4b48574018i8e3tkblo0i341v648/tinymce/7/tinymce.min.js"
  referrerpolicy="origin"></script>


<script>
  // TinyMCE Initialization
  tinymce.init({
    selector: '.editor',
    height: 300,
    plugins: [
      'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
      'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
      'insertdatetime', 'media', 'table', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | blocks | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | help',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
  });

  // Size handling
  $('body').delegate('.AddSize', 'click', function (e) {

    var i = $('#AppendSize tr').length + 1;
    e.preventDefault();
    var html = `<tr id="DeleteSize${i}">
                      <td>
                        <input type="text" name="size['${i}'][name]" class="form-control" placeholder="Enter Size Name">
                      </td>
                      <td>
                        <input type="text" name="size['${i}'][price]" class="form-control" placeholder="Enter Size Price">
                      </td>
                      <td>
                        <button type="button" id="${i}" class="btn btn-danger btn-sm RemoveSize">Remove</button>
                      </td>
                    </tr>`;
    $('#AppendSize').append(html);
  });

  $('body').delegate('.RemoveSize', 'click', function (e) {
    e.preventDefault();
    $(this).parent().parent().remove();
  });

  // Category handling
  $('body').delegate('#ChangeCategory', 'change', function (e) {
    var id = $(this).val();
    $.ajax({
      type: "POST",
      url: "{{url('admin/get_sub_category')}}",
      data: {
        "id": id,
        "_token": "{{ csrf_token() }}"
      },
      dataType: "json",
      success: function (data) {
        $('#getSubCategory').html(data.html);
      },
      error: function (data) {

      }
    });
  });
</script>
@endsection