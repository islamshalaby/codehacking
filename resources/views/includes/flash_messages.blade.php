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