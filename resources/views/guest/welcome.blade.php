@extends('layouts.guestLayouts.guest_design')
@section('title', 'Home')
@section('css')
    <style>
            marquee{
      font-size: 20px;
      font-weight: 800;
      color: #8ebf42;
      font-family: sans-serif;
      background-color:brown;
      }
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
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        
        {{-- master --}}
        <div class="row">
            <div class="col-12">
            <img src="images/newskatta_masthead.png"  style="width:60%"/>
            </div>
        </div>
        @foreach($featuredPosts->take(1) as $featured)
       <marquee>{{$featured->title}}</marquee>
        @endforeach
        <style>
                    img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: -10px;



            }
            .mySlides {display:none;}

            </style>
          
            
          @foreach($featuredPosts->take(3) as $featured)

            <div class="w3-content w3-section" style="max-width:500px">
                @foreach($featured->images->where('featured',1) as $key => $slider)
                <img class="mySlides w3-animate-right" src="{{ url('images/postImages/'.$slider->url) }}" style="width:100%">
              {{-- <img class="mySlides w3-animate-bottom" src="images/newskatta_masthead.png" style="width:100%">
              <img class="mySlides w3-animate-top" src="images/newskatta_masthead.png" style="width:100%">
              <img class="mySlides w3-animate-bottom" src="images/newskatta_masthead.png" style="width:100%"> --}}
              @endforeach

            </div>
            @endforeach

          
            
           
            
        <!-- Main content -->

        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="h-sm-auto">
                            <div class="h-1-3 overflow-hidden">
                                @foreach($featuredPosts->take(3) as $featured)
                                    <div class="pr-5 pr-sm-0 pt-5 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
                                        <a class="pos-relative h-100 dplay-block"
                                           href="{{url('/post/'.$featured->slug)}}">
                                            @foreach($featured->images->where('featured',1) as $key => $slider)
                                                <img src="{{ url('images/postImages/'.$slider->url) }}"
                                                     class="d-block w-100" style="width:100%; height:200px !important;"
                                                     alt="{{$slider->url}}">
                                            @endforeach
                                            <div class="abs-blr color-white p-5 bg-sm-color-7"
                                                 style="background: rgba(0,0,0,.5)">
                                                <h4 class="mb-10 mb-sm-5"><b>{{$featured->title}}</b></h4>
                                            </div><!--abs-blr -->
                                        </a><!-- pos-relative -->
                                    </div><!-- w-1-3 -->
                                @endforeach
                            </div><!-- h-2-3 -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <h4 class="p-title mt-30"><b>ALL NEWS</b></h4>
                        <div class="row">
                            @foreach($posts as $allPost)
                                    <div class="col-sm-6">
                                        <div id="carouselExampleIndicators{{$allPost->id}}" class="carousel slide"
                                             data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <li data-target="#carouselExampleIndicators{{$allPost->id}}"
                                                    data-slide-to="0" class="active"></li>
                                            </ol>
                                            <div class="carousel-inner" style="width:100%; height:150px !important;">
                                                @foreach($allPost->images as $key => $slider)
                                                    <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                                        <img src="{{ url('images/postImages/'.$slider->url) }}"
                                                             class="d-block w-100" alt="{{$slider->url}}">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev"
                                               href="#carouselExampleIndicators{{$allPost->id}}" role="button"
                                               data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true">     </span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next"
                                               href="#carouselExampleIndicators{{$allPost->id}}" role="button"
                                               data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                        <a style="color:black" href="{{url('/post/'.$allPost->slug)}}"><h4 class="pt-20">{{$allPost->title}}</h4></a>
                                        <ul class="list-li-mr-20 pt-10 mb-30">
                                            <li class="color-black">
                                                <a href="{{url('/category/posts/'.$allPost->category->slug)}}"
                                                   style="color:white; background-color: {{$allPost->category->color}}"
                                                   class="color-black p-2"><b>{{$allPost->category->title}}</b></a>
                                            </li>
                                            <li class="color-black float-right">
                                                {{date("l, M d Y", strtotime($allPost->created_at))}}</li>
                                        </ul>
                                    </div><!-- col-sm-6 -->
                            @endforeach
                        </div>
                        <br>
                        {{$posts->links()}}
                        <br>
                    </div>
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
                    </aside>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <script>
        var myIndex = 0;
        carousel();
        
        function carousel() {
          var i;
          var x = document.getElementsByClassName("mySlides");
          for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
          }
          myIndex++;
          if (myIndex > x.length) {myIndex = 1}    
          x[myIndex-1].style.display = "block";  
          setTimeout(carousel, 2500);    
        }
        </script>
@endsection


