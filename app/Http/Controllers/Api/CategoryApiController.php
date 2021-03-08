<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{

    public function __construct()
    {

    }
    //
    // GET ALL
    public function index(){
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }
    public function posts($id){
        $category = Category::find($id);
        $posts = $category->posts;
        return PostResource::collection($posts);
    }

    // GET $id
    public function show($id){

    }

    // POST
    public function store(Request $request){

    }
}
