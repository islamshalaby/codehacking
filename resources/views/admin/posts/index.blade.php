@extends('layouts.admin')


@section('content')
    <h1>Posts</h1>
    @if (Session::has('post_created'))
        <div class="alert alert-success">
            {{session('post_created')}}
        </div>
    @endif
    <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>User</th>
            <th>Category</th>
            <th>Photo</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created at</th>
            <th>Updated at</th>
            {{-- <th>Action</th> --}}
          </tr>
        </thead>
        <tbody>
            @if ($posts)
                @foreach ($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category->name}}</td>
                    <td><img style="height : 50px !important" src="{{$post->photo ? $post->photo->file : '/images/user.png'}}" alt="" class="img-responsive img-rounded"></td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->body}}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
      </table>
@endsection