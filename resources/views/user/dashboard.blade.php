@extends('layouts.frontendLayouts.frontend_design')
@section('title', 'Dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="img-fluid img-circle"
                                         src="/images/userImages/{{ Auth::user()->avatar }}" width="40%" style="border-radius: 50%;"
                                         alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>

                                <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Joined</b> <a class="float-right">{{ Auth::user()->created_at->diffForHumans() }}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card card-primary card-outline">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="settings">
                                        <div class="row">
                                                <div class="col-6">
                                                        <div class="card card-primary">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Change Profile Picture</h3>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body">
                                                                <form role="form" enctype="multipart/form-data" action="{{route('update.avatar')}}" method="post">@csrf
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="custom-file">
                                                                                <input type="file" name="avatar" class="custom-file-input" id="avatar">
                                                                                <label class="custom-file-label" for="avatar">Choose file</label>
                                                                            </div>
                                                                            <div class="input-group-append">
                                                                                <input class="input-group-text" type="submit" value="Update">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="col-6">
                                                        <div class="card card-primary">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Change Password</h3>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body">
                                                                <form method="post" action="{{ url('/user/update-pwd') }}" name="password_validate" id="password_validate" novalidate="novalidate">{{ csrf_field() }}
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <!-- text input -->
                                                                            <div class="form-group">
                                                                                <label>New Password</label>
                                                                                <input required class="form-control" type="password" name="new_pwd" id="new_pwd" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <!-- text input -->
                                                                            <div class="form-group">
                                                                                <label>Confirm Password</label>
                                                                                <input required class="form-control" type="password" name="confirm_pwd" id="confirm_pwd" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="" style="text-align: right">
                                                                        <input type="submit" value="Update Password" class="btn btn-primary">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
    @if(Session::has('flash_message_success'))
        <script>
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Avatar Changed!',
                timer: 2000
            });
        </script>
    @endif
    @if(Session::has('password_success'))
        <script>
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Password Changed Successfully',
                timer: 2000
            });
        </script>
    @endif

    <script>
        $("#password_validate").validate({
            rules:{
                new_pwd:{
                    required: true,
                    minlength:6,
                    maxlength:20
                },
                confirm_pwd:{
                    required:true,
                    minlength:6,
                    maxlength:20,
                    equalTo:"#new_pwd"
                }
            },
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