<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Image;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as MakeImage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::all();
        
        return view('admin.posts.posts')->with(compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);
        $images = $post->images;
        $comments = $post->comments;
        return view('admin.posts.post')->with(compact('post', 'images', 'comments'));
    }

    public function newPost()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.add_post', compact('tags', 'categories'));
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
        $user = Auth::user();

        $post = new Post();

        $post->title = $request->input('post_title');
        $post->content = $request->input('post_content');
        //$post->slug = str_slug($request->input('post_title'),en);
        $slug = $this->make_slug($request->input('post_title'));
        $post -> slug = $slug;
        $post->post_type = 'text';
        $post->author_id = $user->id;
        $post->category_id = intval($request->input('post_category'));
        
        $post->save();
        if ($request->has('post_tags')) {
            foreach ($request->input('post_tags') as $id) {
                DB::table('post_tag')->insert([
                    'post_id' => $post->id,
                    'tag_id' => $id
                ]);
            }
        }
        if ($request->hasFile('post_images')) {
            $counter = 0;
            $images = $request->file('post_images');
            foreach ($images as $image) {
                $filename = str_slug($request->input('post_title')) . '-' . rand(111, 99999) . '.' . $image->getClientOriginalExtension();
                $image_path = 'images/postImages/' . $filename;
                ini_set('memory_limit', '256M');
                MakeImage::make($image)->save($image_path);
                $image = new Image();
                $image->description = '';
                $image->url = $filename;
                $image->post_id = $post->id;
                if ($counter == 0) {
                    $image->featured = true;
                } else {
                    $image->featured = false;
                }
                $image->save();
                $counter++;
            }
        }
        
        return redirect('posts')->with('post_add', 'Post Added Successfully');
    }

    public function edit(Request $request, $id)
    {

        if ($request->isMethod('post')) {
            //$data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $post = Post::find($id);

            $post->title = $request->post_title;
            $post->content = $request->post_content;
            $post->slug = str_slug($request->post_title);
            $post->category_id = $request->post_category;

            $post->update();
            if ($request->hasFile('post_images')) {
                $counter = 0;
                $images = $request->file('post_images');
                foreach ($images as $image) {
                    $filename = str_slug($request->input('post_title')) . '-' . rand(111, 99999) . '.' . $image->getClientOriginalExtension();
                    $image_path = 'images/postImages/' . $filename;
                    ini_set('memory_limit', '256M');
                    MakeImage::make($image)->save($image_path);
                    $image = new Image();
                    $image->description = '';
                    $image->url = $filename;
                    $image->post_id = $post->id;
                    if ($counter == 0) {
                        $image->featured = true;
                    } else {
                        $image->featured = false;
                    }
                    $image->save();
                    $counter++;
                }
            }
            $post->tags()->sync($request->post_tags);

            return redirect()->to('/posts')->with('flash_message_success', 'Post Edited Successfully');
        }
        $tags = Tag::all();
        $categories = Category::all();
        $posts = Post::with('tags', 'category')->where(['id' => $id])->first();
        $images = $posts->images;

        return view('admin.posts.edit_post')->with(compact('posts', 'tags','images', 'categories'));
    }

    public function delete($id = null)
    {
        Post::where(['id' => $id])->delete();
        Image::where(['post_id' => $id])->delete();
        Comment::where(['post_id' => $id])->delete();
        DB::table('post_tag')->where('post_id', $id)->delete();
        return redirect()->back();
    }
    // import product
    public function importPosts(Request $request)
    {
        $file = $request->file('csv');

        $filename  = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath  = $file->getRealPath();
        $fileSize  = $file->getSize();
        $mimeType  = $file->getMimeType();


        $valid_extension = array("csv");
        $maxFileSize     = 80971520;

        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
                $location = 'csv';

                if (!file_exists(public_path($location))) {
                    mkdir(public_path($location), 0777, true);
                }

                $file->move(public_path($location), $filename);
                $filepath       = public_path($location . "\\" . $filename);
                $file           = fopen($filepath, "r");
                $importData_arr = array();

                $i = 0;
                while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                    $num = count($filedata);
                    if ($i == 0) {
                        $i++;
                        continue;
                    }
                    for ($c = 0; $c < $num; $c++) {
                        if (isset($filedata[$c])) {
                            $importData_arr[$i][] = $filedata[$c];
                            array_filter($importData_arr[$i]);
                        }
                    }
                    $i++;
                }
                fclose($file);
                // array_filter($importData_arr);
                // echo "<pre>";
                // print_r($importData_arr);exit;

                foreach ($importData_arr as $importData) {
                    if (!(isset($importData[0]) && isset($importData[1]) && isset($importData[2]))) {
                        continue;
                    }
                    $post          = new Post;
                    $post->title   = $importData[3] ;
                    $post->slug    = $importData[4] ;
                    $post->content    = $importData[5] ;
                    $post->post_type = 'text';
                    $post->author_id = 1;
                    // // $post->category_id    = array($importData_arr[6][6] ? $importData_arr[6][6] : "Not Found");
                    $post->category_id=1;
                    $post->meta_data  = 'null';
                    $post->place  =  $importData[0] ;
                    $post->editor  =  $importData[1];
                    $post->views  =    $importData[9] ;
                    $post->created_at  =    $importData[10] ;

                    $post->save();

                   
                    
                

                }
                Session::flash('message', 'Import Successful.');
            } else {
                Session::flash('message', 'File too large. File must be less than 2MB.');
            }
        } else {
            Session::flash('message', 'Invalid File Extension.');
        }

        return redirect()->back()->with('success-message', 'Products Imported successfully!');
    
    }

    public function GetimportPosts(Request $request){
        return view('admin.posts.import');
    }
}
