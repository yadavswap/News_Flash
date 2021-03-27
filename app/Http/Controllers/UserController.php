<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Image;
use App\Post;
use App\post_tag;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as MakeImage;
use Stringy\Stringy;

class UserController extends Controller
{
    //
    public function home(){
        $posts = Post::with(['images'])->orderBy('created_at','DESC')->paginate(10);
        $featuredPosts = Post::with(['images'])->orderBy('created_at','DESC')->get();
        $categories = Category::all();
        $tags = Tag::all();
        return view('guest.welcome')->with(compact('posts','categories','tags','featuredPosts'));
    }

    public function showSinglePost(Post $post){
//        $post = Post::find($id);
        $images = $post->images;
        $comments = $post->comments;
        $categories = Category::all();
        $tags = Tag::all();
        // dd($post->image);
        return view('guest.single_post')->with(compact('post','images','comments','categories','tags'));
    }

    public function categoryPosts(Category $category){
//        $category = Category::findOrFail($id);
        $posts = $category->posts()->paginate(15);
        $categories = Category::all();
        $tags = Tag::all();
        return view('guest.category_posts')->with(compact('posts','categories','tags','category'));
    }
    public function tagPosts(Tag $tag){
//        $tag = Tag::findOrFail($id);
        $posts = $tag->posts()->paginate(15);
        $categories = Category::all();
        $tags = Tag::all();
        return view('guest.tag_posts')->with(compact('posts','categories','tags','tag'));
    }


    public function dashboard(){
        return view('user.dashboard', array('user' => Auth::user()));
    }

    public function update_avatar(Request $request){

        // Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = Auth::user()->id .'-'. time(). '.' . $avatar->getClientOriginalExtension();
            $image_path = 'images/userImages/'.$filename;
            ini_set('memory_limit','256M');
            MakeImage::make($avatar)->resize(300, 300)->save($image_path);

            User::where('id',Auth::user()->id)->update(['avatar'=>$filename]);
        }

        return redirect()->back()->with('flash_message_success','Profile Picture Updated Successfully');

    }

    public function chkPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $check_password = User::find(Auth::user()->id);
        if (Hash::check($current_password,$check_password->password)) {
            echo "true"; die;
        } else {
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request){
        if($request ->isMethod('post')){
            $data = $request->all();
            $password = bcrypt($data['new_pwd']);
            User::find(Auth::user()->id)->update(['password'=>$password]);
            return redirect()->back()->with('password_success','Password updated Successfully');
        }
    }

    public function addComment(Request $request){
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

    public function newPost(){
        $tags = Tag::all();
        $categories = Category::all();
        return view('user.post.add_post',compact('tags','categories'));
    }

    public function myPosts(){
        $posts = Post::where('author_id',Auth::id())->idDescending()->get();
        return view('user.post.my_posts')->with(compact('posts'));
    }


    function make_slug($string) {
        $string = html_entity_decode($string);

        $string = preg_replace('/\s+/u','-',$string);

        //$string = htmlentities($string);
        return $string;
        //return preg_replace('/\s+/u', '-', trim($string));
    }

    public function store(Request $request){
        //dd($request->all());

        $user = Auth::user();

        $post = new Post();

        $post -> title = $request->input('post_title');
        $post -> content = $request->input('post_content');
        $slug = $this->make_slug($request->input('post_title'));
        $post -> slug = $slug;
        $post -> post_type = 'text';
        $post -> author_id = $user->id;
        $post -> category_id = intval($request->input('post_category'));
        $post->save();
        if($request->has('post_tags')){
            foreach ($request->input('post_tags') as $id){
                DB::table('post_tag')->insert([
                    'post_id' => $post->id,
                    'tag_id' => $id
                ]);
            }
        }
        if($request->hasFile('post_images')){
            $counter = 0;
            $images = $request->file('post_images');
            foreach ($images as $image){
                $filename = $request->input('post_title') .'-'. rand(111,99999). '.' . $image->getClientOriginalExtension();
                $image_path = 'images/postImages/'.$filename;
                ini_set('memory_limit','256M');
                MakeImage::make($image)->save($image_path);
                $image = new Image();
                $image->description = '';
                $image->url = $filename;
                $image->post_id = $post->id;
                if($counter == 0){
                    $image->featured = true;
                }else{
                    $image->featured = false;
                }
                $image->save();
                $counter++;
            }
        }
        return redirect('/my-posts')->with('post_add','Post Added Successfully');
    }

    public function logout(){
        Session::flush();
        return redirect('/');
    }

}
