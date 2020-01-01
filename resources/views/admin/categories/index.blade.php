@extends('layouts.admin')

@section('content')
<h1>Categories</h1>
@if (Session::has('categoryDeleted'))
<div class="alert alert-danger">{{session('categoryDeleted')}}</div>
@endif
<div class="row">
    <form action="{{route('admin.categories.store')}}" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>
@include('includes.form_errors')
<div class="row">
    <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
                <td>{{$category->created_at ? $category->created_at->diffForHumans() : ''}}</td>
                <td>{{$category->updated_at ? $category->updated_at->diffForHumans() : ''}}</td>
                <td>
                  <form action="{{route('admin.categories.destroy', $category->id)}}" method="post">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-danger">Delete</button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>

@endsection