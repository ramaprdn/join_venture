<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    public function sendComment(Request $request){
    	$comment = new Comment();
    	$comment->user_id = $request->user_id;
    	$comment->post_id = $request->post_id;
    	$comment->comment = $request->comment;
    	$comment->save();
    }

    public function loadComment($post_id){
    	$comments = Comment::with('user')
    		->where('post_id', $post_id)
    		->orderBy('created_at', 'desc')
    		->get();


    	return view('ajax.comment.load', compact('comments'));
    }
}
