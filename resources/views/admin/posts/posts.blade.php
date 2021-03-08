@extends('layouts.adminLayouts.admin_design')
@section('title', 'Posts')
@section('css')
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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">All Posts</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        @if(Session::has('post_add'))
            <script type="text/javascript">
                Swal.fire({
                    position: 'top-end',
                    width: 300,
                    height: 10,
                    type: 'success',
                    title: 'New post Added',
                    showConfirmButton: false,
                    timer: 5000
                });
            </script>
        @endif
        @if(Session::has('comment_edit'))
            <script type="text/javascript">
                Swal.fire({
                    position: 'top-end',
                    width: 300,
                    height: 10,
                    type: 'success',
                    title: 'comment Edited Successfully',
                    showConfirmButton: false,
                    timer: 5000
                });
            </script>
        @endif
     
        <section class="content">
            <h1 class="text-center">Posts</h1>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">All Posts</h3>
                                <div style="float:right">
                                    <a href="{{route('add-post')}}" target="_blank">
                                        <button class="btn btn-large btn-dark">Add Post</button>
                                    </a>
                                </div>
                            </div>
                          
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="post_table">
                                    <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Title</th>
                                        <th>Post Type</th>
                                        <th>Author ID</th>
                                        <th>Category</th>
                                        <th>Added</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $post)
                                        <tr class="">
                                            <td class="center">{{ $post->id }}</td>
                                            <td class="center">{{ $post->title }}</td>
                                            <td class="center">{{ $post->post_type }}</td>
                                            <td class="center">{{ $post->author_id }}</td>
                                            <td class="center">{{ $post->category->title }}</td>
                                            <td class="center">{{ date('d-m-Y H:i:s', strtotime($post->created_at)) }}</td>
                                            <td class="center">
                                                <a href="{{ route('show-post',['id'=>$post->id]) }}"
                                                class="btn btn-outline-primary btn-mini">View Post</a>
                                                <a href="{{ route('edit-post',['id'=>$post->id]) }}"
                                                class="btn btn-outline-dark btn-mini">Edit Post</a>
                                                <a rel="{{ $post->id }}"
                                                   rel1="delete-post" href="javascript:"
                                                   class="btn btn-danger btn-mini deletePost">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
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
                "order": [[5, "desc"]],
                "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                "responsive": true,
            });
        });
    </script>
@endsection
