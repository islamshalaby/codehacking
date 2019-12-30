@extends('layouts.admin')

@section('content')
    <h2>Create User</h2>
    <div class="row">
        <div class="col-sm-2">
            <img src="{{$user->photo ? $user->photo->file : '/images/user.png'}}" alt="" class="img-responsive img-rounded">
        </div>
        <div class="col-sm-10">
            <form action="{{route('admin.users.update', $user->id)}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input value="{{$user->name}}" type="text" name="name" class="form-control" id="name">
                </div>
                {{csrf_field()}}
                {{method_field('PATCH')}}
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" autocomplete="new-password" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input value="{{$user->email}}" type="text" name="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="sel1">Role:</label>
                    <select name="role_id" class="form-control" id="sel1">
                        <option selected disabled>Select</option>
                        @foreach ($roles as $role)
                            <option {{$role->id == $user->role_id ? 'selected' :''}} value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="checkbox-inline"><input type="checkbox" {{$user->is_active == 1 ? 'checked' : ''}} name="is_active" value="1">Active</label>
                </div>
                <div class="form-group">
                    <label for="photo">Photo:</label>
                    <input type="file" name="photo_id" class="form-control" id="photo">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>    
    </div>
    

    @include('includes.form_errors')
@endsection