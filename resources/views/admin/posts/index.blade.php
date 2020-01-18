@extends('layouts.admin')


@section('content')
    <h1>Posts</h1>
    @include('includes.flash_messages')
    <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>User</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th>View Post</th>
            <th>View Comments</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @if ($posts)
                @foreach ($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td><img style="height : 50px !important" src="{{$post->photo ? $post->photo->file : '/images/user.png'}}" alt="" class="img-responsive img-rounded"></td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category->name}}</td>
                    <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a></td>
                    <td>{{str_limit($post->body, 10)}}</td>
                    <td><a href="{{route('post.home', $post->id)}}">{{$post->title}}</a></td>
                    <td><a href="{{route('admin.comments.show', $post->id)}}">Comments</a></td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                    <td>
                        <form action="{{route('admin.posts.destroy', $post->id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
      </table>
@endsection