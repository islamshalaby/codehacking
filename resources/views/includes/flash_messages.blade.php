@if (Session::has('post_created'))
    <div class="alert alert-success">
        {{session('post_created')}}
    </div>
@endif
@if (Session::has('post_updated'))
<div class="alert alert-success">{{session('post_updated')}}</div>
@endif
@if (Session::has('post_deleted'))
<div class="alert alert-danger">{{session('post_deleted')}}</div>
@endif
@if (Session::has('photoDeleted'))
<div class="alert alert-danger">{{session('photoDeleted')}}</div>
@endif
@if (Session::has('comment_updated'))
<div class="alert alert-success">{{session('comment_updated')}}</div>
@endif
@if (Session::has('comment_deleted'))
<div class="alert alert-danger">{{session('comment_deleted')}}</div>
@endif