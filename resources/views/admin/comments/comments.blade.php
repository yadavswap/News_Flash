@extends('layouts.adminLayouts.admin_design')
@section('title', 'Comments')
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
                            <li class="breadcrumb-item active">All Comments</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        @if(Session::has('failed_error_messege'))
            <script type="text/javascript">
                Swal.fire({
                    position: 'top-end',
                    type: 'warning',
                    width: 350,
                    height: 50,
                    title: 'Invalid e-mail or password. Please try again!',
                    timer: 5000
                });
            </script>
        @endif
        @if(Session::has('comment_added'))
            <script type="text/javascript">
                Swal.fire({
                    position: 'top-end',
                    width: 300,
                    height: 10,
                    type: 'success',
                    title: 'New comment Added',
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
            <h1 class="text-center">COMMENTS</h1>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">All Comments</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="comment_table">
                                    <thead>
                                    <tr>
                                        <th>Comment</th>
                                        <th>Author ID</th>
                                        <th>Post ID</th>
                                        <th>Added</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($comments as $comment)
                                        <tr class="">
                                            <td class="center">{{ $comment->content }}</td>
                                            <td class="center">{{ $comment->author_id }}</td>
                                            <td class="center">{{ $comment->post_id }}</td>
                                            <td class="center">{{ $comment->created_at }}</td>
                                            <td class="center">
                                                <a href="{{$comment->post->link()}}"
                                                   class="btn btn-outline-primary btn-mini">View Post</a>
                                                <a rel="{{ $comment->id }}"
                                                   rel1="delete-comment" href="javascript:"
                                                   class="btn btn-danger btn-mini deleteComment">Delete</a>
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
            $('#comment_table').DataTable({
                "order": [[3, "desc"]],
                "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                "responsive": true,
            });
        });
    </script>
@endsection
