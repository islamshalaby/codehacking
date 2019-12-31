@extends('layouts.admin')

@section('content')
    <h1>Create Post</h1>
    <div class="row">
        <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" id="title">
            </div>
            
            <div class="form-group">
                <label for="category_id">Category:</label>
                <select name="category_id" class="form-control" id="category_id">
                    <option selected disabled>Select</option>
              
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach 
                   
                </select>
            </div>
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" name="photo_id" class="form-control" id="photo">
            </div>
            <div class="form-group">
                <label for="body">Description:</label>
                <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
            </div>
            
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
    @include('includes.form_errors')
@endsection