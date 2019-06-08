<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommentController extends Controller
{
    // add Commment
    public function addComment(Request $request , $id ){
        if ($request->isMethod('post')){
            $comment = new Comment();
            $comment->comment_body = $request->input('comment_body');
            $comment->post_id = $id ;
            $comment->user_id = JWTAuth::parseToken()->authenticate()->id ;
            $comment->save();
        }

          return redirect('api/posts/'.$id)->with('success', 'Done successfully');
    }

    //delete comment

    public function destroyComment($id){
        $comment = Comment::findOrFail($id);
        $pid = $comment->post_id;
        $comment->delete();
        return redirect("/post/".$pid);
    }

}
