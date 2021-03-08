@extends('layouts.adminLayouts.admin_design')
@section('title', 'Users')
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
                            <li class="breadcrumb-item active">All Users</li>
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
            <h1 class="text-center">Users</h1>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">All Users</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="user_table">
                                    <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Joined</th>
                                        <th>Avatar</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr class="">
                                            <td class="center">{{ $user->id }}</td>
                                            <td class="center">{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td class="center">{{ $user->email }}</td>
                                            <td class="center">{{ $user->user_type }}</td>
                                            <td class="center">{{ date('d-m-Y H:i:s', strtotime($user->created_at)) }}</td>
                                            <td class="center"><img width="40" height="40" src="{{url('/images/userImages/'.$user->avatar)}}" alt="userImage"></td>
                                            <td class="center">
                                                <a rel="{{ $user->id }}"
                                                   rel1="delete-user" href="javascript:"
                                                   class="btn btn-danger btn-mini deleteUser">Delete</a>
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
            $('#user_table').DataTable({
                "order": [[4, "desc"]],
                "lengthMenu": [[10, 50, 100, -1], [10, 50, 100 ,"All"]],
                "responsive": true,
            });
        });
    </script>
@endsection
