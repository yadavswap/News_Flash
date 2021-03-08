@extends('layouts.adminLayouts.admin_design')
@section('title', 'Category')
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
                            <li class="breadcrumb-item active">All Categories</li>
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
        @if(Session::has('category_added'))
            <script type="text/javascript">
                Swal.fire({
                    position: 'top-end',
                    width: 300,
                    height: 10,
                    type: 'success',
                    title: 'New category Added',
                    showConfirmButton: false,
                    timer: 5000
                });
            </script>
        @endif
        @if(Session::has('category_edit'))
            <script type="text/javascript">
                Swal.fire({
                    position: 'top-end',
                    width: 300,
                    height: 10,
                    type: 'success',
                    title: 'Category Edited Successfully',
                    showConfirmButton: false,
                    timer: 5000
                });
            </script>
        @endif
        <section class="content">
            <h1 class="text-center">CATEGORIES</h1>
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
                                    id="exampleModalLongTitle">Add Category
                                </h6>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body" style="text-align: left">
                                <br>
                                <form enctype="multipart/form-data" method="post"
                                      action="{{route('add-category')}}" name="add_category"
                                      id="add_category"
                                      novalidate="novalidate">{{ csrf_field() }}

                                    <div class="form-group row">
                                        <label for=""
                                               class="col-sm-4 col-form-label" style="font-size: 15px;">Title</label>
                                        <div class="col-sm-6">
                                            <input required style="font-size: 20px;" class="form-control" type="text" name="category_title"
                                                   id="category_title"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for=""
                                               class="col-sm-4 col-form-label" style="font-size: 15px;">Color</label>
                                        <div class="col-sm-6">
                                            <input required style="font-size: 20px;" class="form-control" type="color" name="category_color"
                                                   id="category_color"/>
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
                                <h3 class="card-title">All Categories</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="category_table">
                                    <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Color</th>
                                        <th>Added on</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr class="gradeX">
                                            <td class="center">{{ $category->title }}</td>
                                            <td style="background-color: {{ $category->color }}"></td>
                                            <td class="center">{{ $category->created_at }}</td>
                                            <td class="center">
                                                <a href="{{ url('/admin/edit-category/'.$category->id) }}"
                                                   class="btn btn-primary btn-mini" data-toggle="modal" data-target="#modal-edit-customers{{ $category->id }}" >Edit</a>
                                                <a rel="{{ $category->id }}"
                                                   rel1="delete-category" href="javascript:"
                                                   class="btn btn-danger btn-mini deleteCategory">Delete</a></td>
                                        </tr>

                                        <div class="modal fade" id="modal-edit-customers{{ $category->id }}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title text-center"
                                                            id="exampleModalLongTitle">Edit Category
                                                        </h6>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body" style="text-align: left">
                                                        <br>
                                                        <form enctype="multipart/form-data" method="post"
                                                              action="{{route('edit-category',[$category->id])}}" name="edit_category"
                                                              id="edit_category"
                                                              novalidate="novalidate">{{ csrf_field() }}

                                                            <div class="form-group row">
                                                                <label for=""
                                                                       class="col-sm-4 col-form-label" style="font-size: 15px;">Title</label>
                                                                <div class="col-sm-6">
                                                                    <input style="font-size: 20px;" class="form-control" type="text" name="category_title"
                                                                           id="category_title" value="{{$category->title}}"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for=""
                                                                       class="col-sm-4 col-form-label" style="font-size: 15px;">Color</label>
                                                                <div class="col-sm-6">
                                                                    <input style="font-size: 20px;" class="form-control" type="color" name="category_color"
                                                                           id="category_color" value="{{$category->color}}"/>
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
            $('#category_table').DataTable({
                "order": [[2, "desc"]],
                "lengthMenu": [ [10, 50, 100, -1], [10, 50, 100, "All"] ],
                "responsive":true,
            });
        });
        $("#add_category").validate({
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
