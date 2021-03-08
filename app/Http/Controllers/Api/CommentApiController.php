<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CommentApiController extends Controller
{
    public function index($id){
        $comments=Comment::where('post_id','=',$id)->orderBy('created_at','DESC')->get();
        return CommentResource::collection( $comments );
    }
    //
    public function store(Request $request , $id){
        $comment = new Comment();
        $comment->content = $request->get( 'content' );
        $comment->author_id = Auth::id();
        $comment->post_id = $id;
        $comment->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $comment->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $comment->save();
        return new CommentResource( $comment );
    }
}
