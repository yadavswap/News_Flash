@extends('layouts.frontendLayouts.frontend_design')
@section('title', 'My Posts')
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
                            <li class="breadcrumb-item active">My Posts</li>
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
        <section class="content">
            <h1 class="text-center">My Posts</h1>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">My Posts</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="my_post_table">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Added</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $post)
                                        <tr class="">
                                            <td class="center">{{ $post->title }}</td>
                                            <td class="center">{{ $post->category->title }}</td>
                                            <td class="center">{{ date('d-m-Y', strtotime($post->created_at)) }}</td>
                                            <td class="center">
                                                <a href="{{url('/post/'.$post->slug)}}"
                                                   class="btn btn-outline-primary btn-mini">View Post</a>
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
            $('#my_post_table').DataTable({
                "order": [[2, "desc"]],
                "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                "responsive": true,
            });
        });
    </script>
@endsection
