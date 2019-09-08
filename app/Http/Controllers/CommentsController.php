<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function comment(Post $post, Request $request)
    {
        $request->validate(['body' => 'required|string']);

        $comment = $post->comment([
            'body'          => $request->body,
            'creator_id'    => auth()->id(),
        ]);

        $comment->load(['creator', 'replies']);

        return response()->json(['type' => 'success', 'message' => 'Comment Saved', 'comment' => $comment]);
    }
    
    public function update(Post $post, Comment $comment, Request $request)
    {
        $request->validate(['body' => 'required|string']);

        $comment->update($request->only('body'));

        return response()->json(['type' => 'success', 'message' => 'Comment Updated']);
    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();

        return response()->json(['type' => 'success', 'message' => 'Comment Deleted']);
    }
}
