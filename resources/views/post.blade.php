@extends('layouts.blog-post')

@section('content')
@if (Session::has('comment_added'))
<div class="alert alert-success">{{session('comment_added')}}</div>
@endif
<!-- Title -->
<h1>{{$post->title}}</h1>

<!-- Author -->
<p class="lead">
    by <a href="#">{{$post->user->name}}</a>
</p>

<hr>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

<hr>

<!-- Preview Image -->
<img class="img-responsive" src="{{$post->photo ? $post->photo->file : ''}}" alt="">

<hr>

<!-- Post Content -->
<p class="lead">{{$post->body}}</p>

<hr>

<!-- Blog Comments -->

<!-- Comments Form -->
@if (Auth::check())
<div class="well">
    <h4>Leave a Comment:</h4>
    <form method="POST" action="{{route('admin.comments.store')}}" role="form">
    {{ csrf_field() }}
        <div class="form-group">
            <textarea class="form-control" name="body" rows="3"></textarea>
        </div>
        <input type="hidden" value="{{$post->id}}" name="post_id">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endif

<hr>

<!-- Posted Comments -->

<!-- Comment -->
@if (count($comments) > 0)
@foreach ($comments as $comment)
<div class="media">
    <a class="pull-left" href="#">
        <img height="64" class="media-object" src="{{$comment->photo}}" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">{{$comment->author}}
            <small>{{$comment->created_at->diffForHumans()}}</small>
        </h4>
        {{$comment->body}}
        <!-- Nested Comment -->
        @if (count($comment->replies) > 0)
            @foreach ($comment->replies as $reply)
            @if ($reply->is_active == 1)
        <div class="media">
            <a class="pull-left" href="#">
                <img height="64" class="media-object" src="{{$reply->photo}}" alt="">
            </a>
            <div class="media-body">
                
                <h4 class="media-heading">{{$reply->author}}
                    <small>{{$reply->created_at->diffForHumans()}}</small>
                </h4>
                {{$reply->body}}
                
                
            </div>
        </div>
        @endif
        @endforeach
        @endif
        @if (Auth::check())
        <form class="nested" method="POST" action="{{route('comment.reply.create')}}" role="form">
            {{ csrf_field() }}
            <div class="form-group">
                <textarea class="form-control" name="body" rows="3"></textarea>
            </div>
            <input type="hidden" value="{{$comment->id}}" name="comment_id">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        @endif
        
        <!-- End Nested Comment -->
    </div>
</div>
@endforeach
@endif


    
@endsection