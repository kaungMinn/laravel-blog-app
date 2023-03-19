<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function delete($id)
    {
        $comment = Comment::find($id);

        if(Gate::allows('comment-delete', $comment)){
            $comment->delete();
            return back();
        }else{
            return back()->with('info', 'Unauthorize');
        }
       
        $comment->delete();
        return back()->with('info', 'A comment deleted');
        
    }

    public function create(Request $req)
    {
        $comment = new Comment;
        
        $comment->content = $req->content;
        $comment->article_id = $req->article_id;
        $comment->user_id = $req->user_id;
        $comment->save();
        return back();
    }

    public function edit($id, )
    {
        $comment = Comment::find($id);
        
        return view('comments.edit', [
            'comment' => $comment
        ]);
    }

    public function update($id,Request $req){
        $comment = new Comment;
        $commentForId = Comment::find($id);
        
        $comment->content = $req->content;
        $comment->article_id = $commentForId->article_id;
        $comment->user_id = $commentForId->user_id;
        $comment->save();
        return redirect("/articles/detail/$commentForId->article_id")->with('info', 'Comment Edited');
    }
    
}
