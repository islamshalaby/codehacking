@extends('layouts.admin')

@section('content')
    <h1>Edit Post</h1>
    <div class="row">
        <div class="col-sm-2">
            <img src="{{$post->photo ? $post->photo->file : '/images/user.png'}}" alt="" class="img-responsive img-rounded">
        </div>
        <div class="col-sm-10">
            <form action="{{route('admin.posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('PATCH')}}
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" value="{{$post->title}}" class="form-control" id="title">
                </div>
                
                <div class="form-group">
                    <label for="category_id">Category:</label>
                    <select name="category_id" class="form-control" id="category_id">
                        <option selected disabled>Select</option>
                  
                        @foreach ($categories as $category)
                            <option {{$post->category_id == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach 
                       
                    </select>
                </div>
                <div class="form-group">
                    <label for="photo">Photo:</label>
                    <input type="file" name="photo_id" class="form-control" id="photo">
                </div>
                <div class="form-group">
                    <label for="body">Description:</label>
                    <textarea class="form-control" name="body" id="body" cols="30" rows="10">{{$post->body}}</textarea>
                </div>
                
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
        
    </div>
    @include('includes.form_errors')
@endsection