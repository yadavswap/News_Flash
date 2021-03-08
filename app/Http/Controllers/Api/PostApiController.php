<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use App\Image;
use App\Post;
use App\post_tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as MakeImage;

class PostApiController extends Controller
{
    //
    public function index()
    {
        $posts = Post::with(['author', 'images', 'category', 'tags'])->orderBy('updated_at', 'DESC')->get();
        return PostResource::collection($posts);
    }

    function make_slug($string) {
        $string = html_entity_decode($string);

        $string = preg_replace('/\s+/u','-',$string);

        //$string = htmlentities($string);
        return $string;
        //return preg_replace('/\s+/u', '-', trim($string));
    }
    public function store(Request $request)
    {
//        $data = $request->all();
//        return response()->json($data);

        $post = new Post();
        $post->title = $request->get('post_title');
        $post->content = $request->get('post_content');
        $slug = $this->make_slug($request->input('post_title'));
        $post -> slug = $slug;
        $post->author_id = Auth::id();
        $post->post_type = 'text';
        $post->category_id = intval($request->get('post_category'));
        $post->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $post->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $post->save();
        if($request->has('post_tags')){
            foreach ($request->get('post_tags') as  $id){
                DB::table('post_tag')->insert([
                    'post_id' => $post->id,
                    'tag_id' => $id
                ]);
            }
        }
        if($request->has('image')){
            $image = $request->get('image');
            $name = $request->get('imageName');

            $realImage = base64_decode($image);
            //file_put_contents($name,$realImage);

            $image_path = 'images/postImages/'.$name;
            ini_set('memory_limit','256M');
            MakeImage::make($realImage)->save($image_path);

            //file_put_contents('/tmp/image.png', $data);

            //$counter = 0;
            //$image = $request->file('post_images');
            //dd($data);
            //$filename =  $data;
            //$path = $data->move(public_path('images/postImages/'),$filename);
            //file_put_contents('images/postImages/'.$data,$filename);
            //file_put_contents(public_path('images/postImages/'), $filename);
            //$image_path = 'images/postImages/'.$filename;
            //file_put_contents($image_path, $data);
            //ini_set('memory_limit','256M');
            //MakeImage::make($data)->save($image_path);
            $image = new Image();
            $image->description = '';
            $image->featured = 1;
            $image->url = $name;
            $image->post_id = $post->id;
            $image->save();
        }
        return new PostResource($post);
    }
}
