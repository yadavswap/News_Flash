@extends('layouts.adminLayouts.admin_design')
@section('title', 'Edit Post')
@section('css')
@stop
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Post</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Post</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="box box-info">
                                            <!-- form start -->
                                            <form action="{{ route('edit-post',['id'=>$posts->id]) }}" method="post"
                                                  enctype="multipart/form-data" id="edit_post">
                                                @csrf
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="">Post Title</label>
                                                                <input required type="text" class="form-control"
                                                                       id="text" name="post_title"
                                                                       value="{{$posts->title}}">
                                                            </div>
                                                            <div class="form-group" style="margin-top: 28px;">
                                                                <label>Category</label>
                                                                <select required
                                                                        class="form-control select2 select2-hidden-accessible"
                                                                        name="post_category"
                                                                        style="width: 100%;" tabindex="-1"
                                                                        aria-hidden="true">
                                                                    @foreach($categories as $category)
                                                                        <option value="{{ $category->id }}"
                                                                        @if($category->id == $posts->category->id) selected @endif>{{$category->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group" style="margin-top: 28px;">
                                                                <label>Tags</label>
                                                                <select required
                                                                        class="form-control select2 select2-hidden-accessible"
                                                                        name="post_tags[]" multiple=""
                                                                        data-placeholder="Select Tags"
                                                                        style="width: 100%;" tabindex="-1"
                                                                        aria-hidden="true">
                                                                    @foreach($tags as $tag)
                                                                        <option value="{{ $tag->id }}"
                                                                                @foreach ($posts->tags as $postTag)
                                                                                @if ($postTag->id == $tag->id)
                                                                                selected
                                                                            @endif
                                                                            @endforeach
                                                                        >{{$tag->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                         <div class="card-body" style="display: block;">
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
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <div class="box">
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body pad">
                                                                        <label for="editor1">Post Body</label><textarea
                                                                            required name="post_content" id="editor1"
                                                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$posts->content}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->

                                                <div class="box-footer">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
        $("#edit_post").validate({
            errorClass: "text-danger",
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });
    </script>
@endsection

