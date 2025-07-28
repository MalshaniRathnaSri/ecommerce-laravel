@extends('admin.layouts.master')
    
@section('content')

<div class="container-fluid px-4">
  <h1 class="mt-4">Slider Manager</h1>
</div>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add New Sliders
</button>

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('success')}}
  </div>
@endif

@if($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="/saveSlider" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Slider</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="topSubHeading" class="form-label">Top Sub Heading</label>
            <input type="text" class="form-control" id='topSubHeading' name="top_sub_heading" placeholder="Enter Top Sub Heading ">
          </div>
          <div class="mb-3">
            <label for="heading" class="form-label">Heading</label>
            <input type="text" class="form-control" id="heading" name="heading" placeholder="Enter Heading">
          </div>
          <div class="mb-3">
            <label for="buttomSubHeading" class="form-label">Buttom Sub Heading</label>
            <input type="text" class="form-control" id="buttomSubHeading" name="buttomSubHeading" placeholder="Enter Buttom Sub Heading">
          </div>
          <div class="mb-3">
            <label for="imageUploader" class="form-label">Image Upload</label>
            <input type="file" class="form-control" id="imageUpload" name="image">
          </div>
          <div class="mb-3">
            <label for="moreInfoLink" class="form-label">More Info Link</label>
            <input type="url" class="form-control" id="moreInfoLink" name="moreInfoLink" placeholder="Enter Link for more info...">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Slider</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="card mb-4">
  <div class="card-header">
      <i class="fas fa-table me-1"></i>
      DataTable Example
  </div>
  <div class="card-body">
    <table id="datatablesSimple">
        <thead>
            <tr>
                <th>Top Sub Heading</th>
                <th>Heading</th>
                <th>Bottom Sub Heading</th>
                <th>Image Link</th>
                <th>More Info</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
          @foreach($sliders as $slider)
            <tr>
                <td>{{$slider->top_sub_heading}}</td>
                <td>{{$slider->heading}}</td>
                <td>{{$slider->bottom_sub_heading}}</td>
                <td><img width="100" height="100" src="{{asset('storage/'.$slider->image_link)}}" alt="Slider Images"/></td>
                <td>{{$slider->more_info_link}}</td>
                <td>
                  <div class="d-flex justify-content-between align-items-center gap-2"> 
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sliderModal{{$slider->id}}">
                      Edit
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $slider->id }}">
                      Delete
                    </button>
                  </div>

                  <div class="modal fade" id="deleteModal{{ $slider->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $slider->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="{{ route('slider.destroy', $slider->id) }}" method="POST">
                          @csrf
                          @method('DELETE')

                          <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $slider->id }}">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>

                          <div class="modal-body">
                            Are you sure you want to delete the slider: <strong>{{ $slider->heading }}</strong>?
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                </td>
            </tr>
            <div class="modal fade" id="sliderModal{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form method="POST" action="/updateSlider" enctype="multipart/form-data">
                    @csrf
                      <input type="hidden" value="{{$slider->id}}" name="slider_id"/>
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Update Slider</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="top_sub_heading" class="form-label">Top Sub Heading</label>
                        <input type="text" class="form-control" id='top_sub_heading' value="{{ $slider->top_sub_heading }}" name="top_sub_heading" placeholder="Enter Top Sub Heading ">
                      </div>
                      <div class="mb-3">
                        <label for="heading" class="form-label">Heading</label>
                        <input type="text" class="form-control" id="heading" name="heading" value="{{$slider->heading}}" placeholder="Enter Heading">
                      </div>
                      <div class="mb-3">
                        <label for="bottom_sub_heading" class="form-label">Buttom Sub Heading</label>
                        <input type="text" class="form-control" id="bottom_sub_heading" name="bottom_sub_heading" value="{{$slider->bottom_sub_heading}}" placeholder="Enter Buttom Sub Heading">
                      </div>
                      <div class="mb-3">
                        <label for="imageUploader" class="form-label">Image Upload</label>
                        <input type="file" class="form-control" id="imageUpload" name="image">
                      </div>
                      <div class="mb-3">
                        <label for="moreInfoLink" class="form-label">More Info Link</label>
                        <input type="url" class="form-control" id="moreInfoLink" name="moreInfoLink" value="{{$slider->more_info_link}}" placeholder="Enter Link for more info...">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Update Slider</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          @endforeach
        </tbody>
    </table>
  </div>
</div>

@endsection