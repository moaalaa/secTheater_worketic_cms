<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Reply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function reply(Comment $comment, Request $request)
    {
        $request->validate(['body' => 'required|string']);

        $reply = $comment->reply([
            'body'          => $request->body,
            'creator_id'    => auth()->id(),
        ]);

        $reply->load('creator');

        return response()->json(['type' => 'success', 'message' => 'Reply Saved', 'reply' => $reply]);
    }
    
    public function update(Comment $comment, Reply $reply, Request $request)
    {
        $request->validate(['body' => 'required|string']);

        $reply->update($request->only('body'));

        return response()->json(['type' => 'success', 'message' => 'Reply Updated']);
    }

    public function destroy(Comment $comment, Reply $reply)
    {
        $reply->delete();

        return response()->json(['type' => 'success', 'message' => 'Reply Deleted']);
    }
}
