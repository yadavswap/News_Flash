<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // GET ALL
    public function index(){
        $comments=Comment::with(['author','post'])->orderBy('created_at','DESC')->get();
        return view('admin.comments.comments')->with(compact('comments'));
    }

    // POST
    public function store(Request $request){
        $request->validate([
            'comment_content' => 'required',
        ]);
        $user = Auth::user();
        $comment = new Comment();
        $comment -> content = $request->input('comment_content');
        $comment -> author_id = $user->id;
        $comment -> post_id = $request->input('post_id');
        $comment->save();
        return redirect()->back()->with('comment_added','Comment Added Successfully');
    }

    public function delete($id=null){
        Comment::where(['id'=>$id])->delete();
        return redirect()->back();
    }
}
