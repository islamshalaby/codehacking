@extends('layouts.admin')

@section('content')
    <h2>Create User</h2>
    <div class="row">
        <div class="col-sm-10">
            <form action="{{route('admin.categories.update', $category->id)}}" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input value="{{$category->name}}" type="text" name="name" class="form-control" id="name">
                </div>
                {{csrf_field()}}
                {{method_field('PATCH')}}
                
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>    
    </div>
    

    @include('includes.form_errors')
@endsection