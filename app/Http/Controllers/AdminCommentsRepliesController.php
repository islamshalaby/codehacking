<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminCommentsRepliesController extends Controller
{
    //
    public function createReply(Request $request)
    {
        $user = Auth::user();
        $data = [
            'comment_id' => $request->comment_id,
            'email' => $user->email,
            'author' => $user->name,
            'photo' => $user->photo->file,
            'body' => $request->body
        ];
        CommentReply::create($data);
        Session::flash('comment_added', 'Reply has been added successfully and waiting for approve');
        return redirect()->back();
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        $replies = $comment->replies;

        return view('admin.comments.replies.show', compact('replies'));
    }

    public function update(Request $request, $id)
    {
        CommentReply::findOrFail($id)->update($request->all());

        return redirect()->back();
    }

    public function destroy($id)
    {
        CommentReply::findOrFail($id)->delete();

        return redirect()->back();
    }
}
