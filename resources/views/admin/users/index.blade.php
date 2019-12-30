@extends('layouts.admin')

@section('content')
<h1>Users</h1>
@if (Session::has('deleted_user'))
<div class="alert alert-danger">{{session('deleted_user')}}</div>
@endif
<table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td><img style="height : 50px !important" class="img-responsive img-rounded" src="{{$user->photo ? $user->photo->file : '/images/user.png'}}" /></td>
            <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>{{$user->is_active == 0 ? 'Not Active' : 'Active'}}</td>
            <td>{{$user->created_at->diffForHumans()}}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>
            <td>
              <form action="{{route('admin.users.destroy', $user->id)}}" method="post">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-danger">Delete</button>
              </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
@endsection