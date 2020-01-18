@extends('layouts.admin')

@section('content')
<h1>Replies</h1>
@include('includes.flash_messages')
    <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
            {{-- <th>Approve</th>
            <th>Action</th> --}}
          </tr>
        </thead>
        <tbody>
            @if ($replies)
                @foreach ($replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{$reply->body}}</td>
                    <td>
                        @if ($reply->is_active == 1)
                        <form action="{{route('admin.comment.replies.update', $reply->id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}
                            <input type="hidden" name="is_active" value="0">
                            <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-danger">Disapprove</button>
                        </form>
                        @else
                        <form action="{{route('admin.comment.replies.update', $reply->id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}
                            <input type="hidden" name="is_active" value="1">
                            <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-info">Approve</button>
                        </form>
                        @endif
                    </td>
                    <td>
                        <form action="{{route('admin.comment.replies.destroy', $reply->id)}}" method="post">
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