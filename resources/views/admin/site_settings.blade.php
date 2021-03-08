@extends('layouts.adminLayouts.admin_design')
@section('title', 'Admin Dashboard')
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
                        {{--<h1 class="m-0 text-dark">Dashboard</h1>--}}
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin Dashboard</a></li>
                            <li class="breadcrumb-item active">Website Settings</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        @if(Session::has('flash_message_success'))
            <script type="text/javascript">
                Swal.fire({
                    position: 'top-end',
                    width: 300,
                    height: 10,
                    type: 'success',
                    title: 'Update Successful',
                    showConfirmButton: false,
                    timer: 5000
                });
            </script>
        @endif

        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline">
                    <div class="card-header h3">Website Settings</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Website Details</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <form method="post" action="{{route('update.others')}}" name="site_details" id="site_details"
                                              novalidate="novalidate">{{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label for="title">Website Title</label>
                                                        <input required class="form-control" type="text" name="title"
                                                               id="title" value="{{$details->title}}"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label for="link">Website Link</label>
                                                        <input required class="form-control" type="text" name="link"
                                                               id="link" value="{{$details->link}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="" style="text-align: right">
                                                <input type="submit" value="Update" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Change Website Logo</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <form role="form" enctype="multipart/form-data" action="{{route('update.logo')}}"
                                              method="post">@csrf
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input required type="file" name="logo" class="custom-file-input"
                                                               id="logo">
                                                        <label class="custom-file-label" for="logo">Choose file</label>
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
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="card-header h3">Admin Settings</div>
                        <div class=" p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#name" data-toggle="tab">Name</a></li>
                                <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Password</a></li>
                                <li class="nav-item"><a class="nav-link" href="#avatar" data-toggle="tab">Avatar</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                                <div class="active tab-pane" id="name">
                                    <div class="col-6">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Change Admin Details</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <form method="post" action="{{ route('update.adminDetails') }}" name="update_details" id="update_details" novalidate="novalidate">{{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <!-- text input -->
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input required class="form-control" type="text" name="first_name" id="first_name" value="{{Auth::user()->first_name}}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <!-- text input -->
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input required class="form-control" type="text" name="last_name" id="last_name" value="{{Auth::user()->last_name}}"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <!-- text input -->
                                                            <div class="form-group">
                                                                <label>Email Address</label>
                                                                <input required class="form-control" type="text" name="email" id="email" value="{{Auth::user()->email}}"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="" style="text-align: right">
                                                        <input type="submit" value="Update" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="password">
                                    <div class="col-6">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Change Admin Password</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <form method="post" action="{{ url('/admin/update-pwd') }}" name="password_validate" id="password_validate" novalidate="novalidate">{{ csrf_field() }}
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
                                <div class="tab-pane" id="avatar">
                                    <div class="col-6">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Change Admin Avatar</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <form role="form" enctype="multipart/form-data" action="{{route('update.adminAvatar')}}"
                                                      method="post">@csrf
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input required type="file" name="avatar" class="custom-file-input"
                                                                       id="avatar">
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
                                </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </section>
    </div>
    <!--end-main-container-part-->
@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
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


