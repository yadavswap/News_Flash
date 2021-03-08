@extends('layouts.adminLayouts.admin_design')
@section('title', 'Tag')
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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">All Tags</li>
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
        @if(Session::has('tag_added'))
            <script type="text/javascript">
                Swal.fire({
                    position: 'top-end',
                    width: 300,
                    height: 10,
                    type: 'success',
                    title: 'New tag Added',
                    showConfirmButton: false,
                    timer: 5000
                });
            </script>
        @endif
        @if(Session::has('tag_edit'))
            <script type="text/javascript">
                Swal.fire({
                    position: 'top-end',
                    width: 300,
                    height: 10,
                    type: 'success',
                    title: 'tag Edited Successfully',
                    showConfirmButton: false,
                    timer: 5000
                });
            </script>
        @endif
        <section class="content">
            <h1 class="text-center">TAGS</h1>
            <div class="container-fluid">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Add New
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title text-center"
                                    id="exampleModalLongTitle">Add Tag
                                </h6>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body" style="text-align: left">
                                <br>
                                <form enctype="multipart/form-data" method="post"
                                      action="{{route('add-tag')}}" name="add_tag"
                                      id="add_tag"
                                      novalidate="novalidate">{{ csrf_field() }}

                                    <div class="form-group row">
                                        <label for=""
                                               class="col-sm-4 col-form-label" style="font-size: 15px;">Title</label>
                                        <div class="col-sm-6">
                                            <input required style="font-size: 20px;" class="form-control" type="text"
                                                   name="tag_title"
                                                   id="tag_title"/>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-success">Confirm</button>
                                        <button class="btn btn-danger" data-dismiss="modal">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">All Tags</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="tag_table">
                                    <thead>
                                    <tr>
                                        <th>Tag Name</th>
                                        <th>Added</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tags as $tag)
                                        <tr class="gradeX">
                                            <td class="center">{{ $tag->title }}</td>
                                            <td class="center">{{ $tag->created_at }}</td>
                                            <td class="center">
                                                <a href="{{ url('/admin/edit-tag/'.$tag->id) }}"
                                                   class="btn btn-primary btn-mini" data-toggle="modal"
                                                   data-target="#modal-edit-customers{{ $tag->id }}">Edit</a>
                                                <a rel="{{ $tag->id }}"
                                                   rel1="delete-tag" href="javascript:"
                                                   class="btn btn-danger btn-mini deleteTag">Delete</a></td>
                                        </tr>

                                        <div class="modal fade" id="modal-edit-customers{{ $tag->id }}"
                                             tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title text-center"
                                                            id="exampleModalLongTitle">Edit tag
                                                        </h6>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body" style="text-align: left">
                                                        <br>
                                                        <form enctype="multipart/form-data" method="post"
                                                              action="{{route('edit-tag',[$tag->id])}}"
                                                              name="edit_tag"
                                                              id="edit_tag"
                                                              novalidate="novalidate">{{ csrf_field() }}

                                                            <div class="form-group row">
                                                                <label for=""
                                                                       class="col-sm-4 col-form-label"
                                                                       style="font-size: 15px;">Title</label>
                                                                <div class="col-sm-6">
                                                                    <input style="font-size: 20px;" class="form-control"
                                                                           type="text" name="tag_title"
                                                                           id="tag_title"
                                                                           value="{{$tag->title}}"/>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-success">Confirm</button>
                                                                <button class="btn btn-danger" data-dismiss="modal">
                                                                    Cancel
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
            $('#tag_table').DataTable({
                "order": [[1, "desc"]],
                "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                "responsive": true,
            });
        });
        $("#add_tag").validate({
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
