@extends('layouts.admin')

@section('content')
<h1>Comments</h1>
@include('includes.flash_messages')
    <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
            <th>Post</th>
            <th>Replies</th>
            <th>Approve</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @if ($comments)
                @foreach ($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->body}}</td>
                    <td><a href="{{route('post.home', $comment->post_id)}}">{{$comment->post->title}}</a></td>
                    <td><a href="{{route('admin.comment.replies.show', $comment->id)}}">Show replies</a></td>
                    <td>
                        @if ($comment->is_active == 1)
                        <form action="{{route('admin.comments.update', $comment->id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}
                            <input type="hidden" name="is_active" value="0">
                            <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-danger">Disapprove</button>
                        </form>
                        @else
                        <form action="{{route('admin.comments.update', $comment->id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}
                            <input type="hidden" name="is_active" value="1">
                            <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-info">Approve</button>
                        </form>
                        @endif
                    </td>
                    <td>
                        <form action="{{route('admin.comments.destroy', $comment->id)}}" method="post">
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
@stop