<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoriesResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // GET ALL
    public function index(){
        $categories=Category::orderBy('created_at','DESC')->get();
        return view('admin.categories.categories')->with(compact('categories'));
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
        $category = new Category();
        $category->title = $request->get('category_title');
        //$category->slug = str_slug($request->get('category_title'));
        $slug = $this->make_slug($request->input('category_title'));
        $category -> slug = $slug;
        $category->color = $request->get('category_color');
        $category->save();
        return redirect()->back()->with('category_added','Category Add Successful');
    }

    public function update(Request $request,$id=null){
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'category_title' => 'required',
                'category_color' => 'required'
            ]);
            Category::where(['id'=>$id])->update([
                'title'=>$data['category_title'],
                'color'=>$data['category_color'],'slug'=>str_slug($data['category_title'])
            ]);
            return redirect()->back()->with('category_edit','Category Edit Successful');
        }
        $category = Category::where(['id'=>$id])->first();
        return view('admin.categories.categories')->with(compact('category'));
    }

    public function delete($id=null){
        Category::where(['id'=>$id])->delete();
        return redirect()->back();
    }
}
