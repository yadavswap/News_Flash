<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiteDetailResource;
use App\SiteDetail;
use Illuminate\Http\Request;

class SiteApiController extends Controller
{
    public function index(){
        $details = SiteDetail::all();
        return SiteDetailResource::collection( $details );
    }
}
