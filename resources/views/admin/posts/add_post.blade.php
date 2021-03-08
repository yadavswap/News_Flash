@extends('layouts.adminLayouts.admin_design')
@section('title', 'Add Post')
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
                            <li class="breadcrumb-item active">Add Post</li>
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
                                <h3 class="card-title">Add Post</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="box box-info">
                                            <!-- form start -->
                                            <form action="{{route('save-post')}}" method="post" enctype="multipart/form-data" id="add_new_post">
                                                @csrf
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="">Post Title</label>
                                                                <input required type="text" class="form-control" id="text" name="post_title" placeholder="Enter Post Title">
                                                            </div>
                                                            <div class="form-group" style="margin-top: 28px;">
                                                                <label>Select a Category</label>
                                                                <select required class="form-control select2 select2-hidden-accessible" name="post_category" data-placeholder="Select a Category" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                                    @foreach($categories as $category)
                                                                        <option value="{{ $category->id }}">{{$category->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group" style="margin-top: 28px;">
                                                                <label>Select Tags</label>
                                                                <select required class="form-control select2 select2-hidden-accessible" name="post_tags[]" multiple="" data-placeholder="Select Tags" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                                    @foreach($tags as $tag)
                                                                        <option value="{{ $tag->id }}">{{$tag->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label>Select Multiple Images <small style="font-size: 12px;">(First image will be featured)</small></label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input required type="file" name="post_images[]" class="custom-file-input" id="post_image" multiple>
                                                                        <label class="custom-file-label" for="post_image">Choose files</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <div class="box">
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body pad">
                                                                        <label for="editor1">Post Body</label><textarea required name="post_content" id="editor1" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
        $("#add_new_post").validate({
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

