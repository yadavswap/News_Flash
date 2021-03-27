@extends('layouts.guestLayouts.guest_design')
{{-- @section('title', 'Post') --}}
@section('title', $post->title)
@section('image', $post->images)


@section('css')
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5fe2e4577c936200185ee863&product=inline-share-buttons" async="async"></script>

    <style>
        .tags a {
            display: inline-block;
            height: 24px;
            line-height: 23px;
            position: relative;
            margin: 0 12px 8px 0;
            padding: 0 12px 0 10px;
            background: #777;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            color: #fff;
            font-size: 12px;
            font-family: "Lucida Grande", "Lucida Sans Unicode", Verdana, sans-serif;
            text-decoration: none;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            font-weight: bold;
        }

        .tags a.tagColor {
            background: #313131;
        }

        .tags a.tagColor:after {
            border-color: transparent transparent transparent #313131
        }

        .tags a:hover {
            background: #3e3e3e !important
        }

        .tags a:hover:after {
            border-color: transparent transparent transparent #313131 !important
        }

        .small a {
            height: 21px;
            line-height: 21px;
            float: none;
            font-size: 11px;
        }

        .small a:before {
            right: 0;
            top: 8px;
            border-width: 10px 0 10px 10px;
        }

        .small a:after {
            right: -11px;
            top: 0;
            border-width: 11px 0 11px 11px;
        }
    </style>
@stop
@section('content')
    <!--main-container-part-->
    <div class="content-wrapper">
        <!--breadcrumbs-->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{'/'}}">Home</a></li>
                            <li class="breadcrumb-item active">Post</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        @if(Session::has('comment_added'))
            <script type="text/javascript">
                Swal.fire({
                    position: 'top-end',
                    width: 300,
                    height: 10,
                    type: 'success',
                    title: 'New Comment Added',
                    showConfirmButton: false,
                    timer: 5000
                });
            </script>
        @endif
        <div class="content">
            <div class="container">
                <div class="row">
                    <aside class="col-4">
                        <h4 class="p-title mt-30"><b>CATEGORIES</b></h4>
                        <div class="card-body p-0">
                            <ul class="flex-column">
                                @foreach($categories as $category)
                                    <li class="nav-item tags">
                                        <a href="{{url('/category/posts/'.$category->slug)}}"
                                           class="nav-link tagColor" style="background-color:{{$category->color}} ">{{$category->title}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <h4 class="p-title mt-30"><b>TAGS</b></h4>
                        <div class="card-body p-0">
                            <div class="tags">
                                <p>
                                    @foreach($tags as $tag)
                                        <a href="{{url('/tag/posts/'.$tag->slug)}}"
                                           class="tagColor tag-cloud-link">{{ $tag->title }}</a>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        {{-- <div class="sharethis-inline-share-buttons"></div> --}}
                    </aside>

                    <div class="col-8">
                        <h4 class="p-title mt-30"><b>{{$post->title}}</b></h4>
                        <div class="card">
                            <div class="card-header">
                                <div class="">
                                    <ul>
                                        <li><i class="fa fa-edit"></i></li>
                                        <li><a>{{$post->author->first_name}} {{$post->author->last_name}}</a></li>
                                        <li class="float-right">{{date("l, M d Y", strtotime($post->created_at))}}</li>
                                    </ul>
                                    <br>
                                    {{--<div class="description tags">--}}
                                            {{--<span>--}}
                                                {{--<a title="" href="{{url('/category/posts/'.$post->category->slug)}}" style="background:{{ $post->category->color }};">{{ $post->category->title }}</a>--}}
                                            {{--</span>--}}
                                    {{--</div>--}}
                                </div>
                                <!-- /.user-block -->
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                <div class="row">
                                    <div class="col-2"></div>
                                    <div class="col-8">
                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                            </ol>
                                            <div class="carousel-inner" style="width:100%; height:300px !important;">
                                                @foreach($post->images as $key => $slider)
                                                    <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                                        <a href="{{ url('images/postImages/'.$slider->url) }}" class="fancybox">
                                                            <img src="{{ url('images/postImages/'.$slider->url) }}" class="d-block mx-auto w-100"  alt="{{$slider->url}}">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"  data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true">     </span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                        <p class="p-4" style="font-size: 10px">**Click on the image for full-size view</p>
                                    </div>
                                    <div class="col-2"></div>
                                </div>
                                <div class="row flex">
                                    <div class="col-12 pt-xl-3">
                                        {!! htmlspecialchars_decode($post->content) !!}
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="tags">
                                    <ul>
                                        <li> <i class="fa fa-tags"></i></li>
                                        <li>
                                            <p>
                                                @foreach($post->tags as $tag)
                                                    <a href="{{url('/tag/posts/'.$tag->slug)}}" class="color5">{{ $tag->title }}</a>
                                                @endforeach
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="sharethis-inline-share-buttons" data-url="{{url('post')}}/{{$post->slug}}" data-title="{{$post->title}}" data-image="http://newskatta.in/posts/2012186335520121721032news%20%20katta.png"
                                    ></div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer card-comments" style="display: block;">
                                @foreach($comments as $comment)
                                    <div class="card-comment">
                                        <!-- User image -->
                                        <img class="img-circle img-sm" src="{{url('/images/userImages/'.$comment->author->avatar)}}"
                                             alt="User Image">
                                        <div class="comment-text"><span class="username">{{$comment->author->first_name.' '.$comment->author->last_name}}
                                                <span class="text-muted float-right">{{$comment->created_at->diffForHumans()}}</span>
                                            </span><!-- /.username -->
                                            {{$comment->content}}
                                        </div>
                                        <!-- /.comment-text -->
                                    </div>
                                @endforeach
                            </div>
                            <!-- /.card-footer -->
                            <div class="card-footer" style="display: block;">
                                @auth
                                    <form action="{{route('add.post-comment')}}" method="post">@csrf
                                        <img class="img-fluid img-circle img-sm" src="{{url('/images/userImages/'.Auth::user()->avatar)}}"
                                             alt="User Image">
                                        <!-- .img-push is used to add margin to elements next to floating images -->
                                        <div class="img-push">
                                        <textarea type="text" class="form-control form-control-sm"
                                                  name="comment_content"
                                                  placeholder="Type your comment"></textarea>
                                            <input hidden readonly required name="post_id" value="{{$post->id}}">
                                        </div>
                                        <br>
                                        <div class="box-footer float-right">
                                            <button type="submit" class="btn btn-primary">Comment</button>
                                        </div>
                                    </form>
                                @endauth
                                @guest
                                        <textarea disabled type="text" class="form-control form-control-sm"
                                                  name="comment_content"
                                                  placeholder="Please Login to add comment"></textarea>
                                @endguest
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>
@endsection
