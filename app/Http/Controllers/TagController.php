<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        $tags=Tag::orderBy('created_at','DESC')->get();
        return view('admin.tags.tags')->with(compact('tags'));
    }

    // GET $id
    public function show($id){
        $tag = Tag::find($id);
        return view('admin.tags.tag')->with(compact('tag'));
    }

    function make_slug($string) {
        $string = html_entity_decode($string);

        $string = preg_replace('/\s+/u','-',$string);

        //$string = htmlentities($string);
        return $string;
        //return preg_replace('/\s+/u', '-', trim($string));
    }
    // POST
    public function store(Request $request){
        $tag = new Tag();
        $tag->title = $request->get('tag_title');
       // $tag->slug = str_slug($request->get('tag_title'));
        $slug = $this->make_slug($request->input('tag_title'));
        $tag -> slug = $slug;
        $tag->save();
        return redirect()->back()->with('tag_added','Tag Add Successful');
    }

    public function update(Request $request,$id=null){
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'tag_title' => 'required',
            ]);
            Tag::where(['id'=>$id])->update([
                'title'=>$data['tag_title'],'slug'=>str_slug($data['tag_title'])
            ]);
            return redirect()->back()->with('tag_edit','Tag Edit Successful');
        }
        $tag = Tag::where(['id'=>$id])->first();
        return view('admin.tags.tags')->with(compact('tag'));
    }

    public function delete($id=null){
        Tag::where(['id'=>$id])->delete();
        return redirect()->back();
    }
}
