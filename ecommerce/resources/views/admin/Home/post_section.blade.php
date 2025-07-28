@extends('admin.layouts.master')

@section('content')
   <div class="container-fluid px-4">
        <h1 class="mt-4">Post Manager</h1>
    </div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postModal">
        Add New Post
    </button>

    @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
        </div>
    
    @endif

    @if($errors->any()){
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    }
    @endif

    <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="/SavePost" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <div class="mb-3">
                        <label for="heading" class="form-label">Heading</label>
                        <input type="text" class="form-control" id="heading" name="heading" placeholder="Enter Heading">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description">
                    </div>
                    <div class="mb-3">
                        <label for="imageUploader" class="form-label">Image Upload</label>
                        <input type="file" class="form-control" id="imageUpload" name="image">
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Post</button>
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
                        <th>Heading</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->heading}}</td>
                        <td>{{$post->description}}</td>
                        <td><img width="100" height="100" src="{{asset('storage/'.$post->post_image)}}" alt="Slider Images"/></td>
                        <td>
                        <div class="d-flex justify-content-between align-items-center gap-2"> 
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postModal{{$post->id}}">
                            Edit
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePostModal{{ $post->id }}">
                            Delete
                            </button>
                        </div>
                        
                        <div class="modal fade" id="postModal{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="postModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="/UpdatePost" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{$post->id}}" name="post_id"/>
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="postModal">Update Post</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="heading" class="form-label">Heading</label>
                                            <input type="text" class="form-control" id='heading' value="{{ $post->heading }}" name="heading" placeholder="Enter Heading ">
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <input type="text" class="form-control" id="description" name="description" value="{{$post->description}}" placeholder="Enter Description">
                                        </div>
                                        <div class="mb-3">
                                            <label for="imageUploader" class="form-label">Image Upload</label>
                                            <input type="file" class="form-control" id="imageUpload" name="image">
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update Post</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                      
                         <div class="modal fade" id="deletePostModal{{ $post->id }}" tabindex="-1" aria-labelledby="deletePostModal{{ $post->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('post.delete', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deletePostModal{{ $post->id }}">Confirm Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the post: <strong>{{ $post->heading }}</strong>?
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
                   
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection