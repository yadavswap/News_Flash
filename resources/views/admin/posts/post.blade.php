@extends('layouts.adminLayouts.admin_design')
@section('title', 'Post')
@section('css')
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
                            <li class="breadcrumb-item"><a href="{{'/admin/dashboard'}}">Dashboard</a></li>
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
        <section class="content">
            <div class="container-fluid">
                <h3>{{$post->title}}</h3>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-widget card-outline card-primary">
                            <div class="card-header">
                                <div class="user-block">
                                    <img class="img-circle" src="{{url('/images/userImages/'.$post->author->avatar)}}" alt="Author Image">
                                    <span class="username"><a>{{$post->author->first_name}} {{$post->author->last_name}}</a></span>
                                    <span class="description">Posted: {{$post->created_at->diffForHumans()}}</span>
                                    <br>
                                    <div class="description tags">
                                            <span>
                                                <a title="" href="{{url('/category/posts/'.$post->category->slug)}}" style="background:{{ $post->category->color }};">{{ $post->category->title }}</a>
                                            </span>
                                    </div>
                                </div>
                                <!-- /.user-block -->
                                <div class="card-tools">
                                    <div class="tags">
                                        <p>
                                            @foreach($post->tags as $tag)
                                                <a href="{{url('/tag/posts/'.$tag->slug)}}" class="color5">{{ $tag->title }}</a>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                             {{-- <div class="card-body" style="display: block;">
                                <div class="row">
                                    <div class="col-6">
                                        <h5>Images</h5>
                                        @foreach($images->chunk(4) as $imageItems)
                                            <div class="row">
                                                @foreach($imageItems as $imageItem)
                                                    <div class="col-md-3">
                                                        <a href="{{url('images/postImages/'.$imageItem->url)}}" class="fancybox">
                                                            <img src="{{url('images/postImages/'.$imageItem->url)}}" class="d-block mx-auto w-100"  alt="{{$imageItem->url}}">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div><br>
                                        @endforeach
                                        <p class="p-4" style="font-size: 12px">**Click on the image for full-size view</p>
                                    </div>
                                </div>  --}}
                                <div class="row flex">
                                    <div class="col-6">
                                        <br>
                                        <br>
                                        <br>
                                        {!! htmlspecialchars_decode($post->content) !!}
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer card-comments" style="display: block;">
                                @foreach($comments as $comment)
                                    <div class="card-comment">
                                        <!-- User image -->
                                        <img class="img-circle img-sm" src="{{url('/images/userImages/'.$comment->author->avatar)}}"
                                             alt="User Image">
                                        <div class="comment-text">
                                            <span class="username">{{$comment->author->first_name.' '.$comment->author->last_name}}
                                                <span class="text-muted float-right pl-1"><a rel="{{ $comment->id }}"
                                                                                        rel1="delete-comment" href="javascript:"
                                                                                        class="deleteComment"><i style="color: red" class="fa fa-trash"></i></a></span>
                                                <span class="text-muted float-right">{{$comment->created_at->diffForHumans()}}</span>
                                            </span>
                                            {{$comment->content}}
                                        </div>
                                        <!-- /.comment-text -->
                                    </div>
                                @endforeach
                            </div>
                            <!-- /.card-footer -->
                            <div class="card-footer" style="display: block;">
                                <form action="{{route('add-comment')}}" method="post">@csrf
                                    <img class="img-fluid img-circle img-sm" src="{{url('/images/userImages/'.Auth::user()->avatar)}}"
                                         alt="User Image">

                                    <!-- .img-push is used to add margin to elements next to floating images -->
                                    <div class="img-push">
                                        <textarea type="text" class="form-control form-control-sm"
                                                  name="comment_content"
                                                  placeholder="Press enter to post comment"></textarea>
                                        <input hidden readonly required name="post_id" value="{{$post->id}}">
                                    </div>
                                    <br>
                                    <div class="box-footer float-right">
                                        <button type="submit" class="btn btn-primary">Comment</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript')
    <script>
        $(function () {
            $('#post_table').DataTable({
                "lengthMenu": [[5, 50, 100, -1], [5, 50, 100, "All"]],
                "responsive": true,
            });
        });
    </script>
@endsection
