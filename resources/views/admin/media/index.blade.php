@extends('layouts.admin')

@section('content')
<h1>Media</h1>
@include('includes.flash_messages')
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
            @foreach ($photos as $photo)
            <tr>
                <td>{{$photo->id}}</td>
                <td><img style="height : 50px !important" src="{{$photo->file ? $photo->file : '/images/user.png'}}" alt="" class="img-responsive img-rounded"></td>
                <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : ''}}</td>
                <td>{{$photo->updated_at ? $photo->updated_at->diffForHumans() : ''}}</td>
                <td>
                    <form action="{{route('admin.media.destroy', $photo->id)}}" method="post">
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