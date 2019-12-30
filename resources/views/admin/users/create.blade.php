@extends('layouts.admin')

@section('content')
    <h2>Create User</h2>
    <form action="{{route('admin.users.store')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>
        {{csrf_field()}}
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" autocomplete="new-password" class="form-control" id="password">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" class="form-control" id="email">
        </div>
        <div class="form-group">
            <label for="sel1">Role:</label>
            <select name="role_id" class="form-control" id="sel1">
                <option selected disabled>Select</option>
                @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="checkbox-inline"><input type="checkbox" name="is_active" value="1">Active</label>
        </div>
        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" name="photo_id" class="form-control" id="photo">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

    @include('includes.form_errors')
@endsection