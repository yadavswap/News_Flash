$(document).ready(function () {

    $(document).on('click','.deleteCategory',function(){
        var id = $(this).attr('rel');
        var deleteFunction = $(this).attr('rel1');
        Swal.fire({
            title: 'Are you sure?',
            text: 'Category will be removed!!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#d61610',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Deleted!',
                    'Category has been deleted.',
                    'success'
                );
                setTimeout(function () {
                    window.location.href="/admin/"+deleteFunction+"/"+id; //will redirect to your blog page (an ex: blog.html)
                }, 2000);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'Category is safe :)',
                    'success'
                )
            }
        });
    });

    $(document).on('click','.deleteTag',function(){
        var id = $(this).attr('rel');
        var deleteFunction = $(this).attr('rel1');
        Swal.fire({
            title: 'Are you sure?',
            text: 'Tag will be removed!!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#d61610',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Deleted!',
                    'Tag has been deleted.',
                    'success'
                );
                setTimeout(function () {
                    window.location.href="/admin/"+deleteFunction+"/"+id; //will redirect to your blog page (an ex: blog.html)
                }, 2000);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'Tag is safe :)',
                    'success'
                )
            }
        });
    });

    $(document).on('click','.deleteComment',function(){
        var id = $(this).attr('rel');
        var deleteFunction = $(this).attr('rel1');
        Swal.fire({
            title: 'Are you sure?',
            text: 'Comment will be removed!!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#d61610',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Deleted!',
                    'Comment has been deleted.',
                    'success'
                );
                setTimeout(function () {
                    window.location.href="/admin/"+deleteFunction+"/"+id; //will redirect to your blog page (an ex: blog.html)
                }, 2000);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'Comment is safe :)',
                    'success'
                )
            }
        });
    });

    $(document).on('click','.deletePost',function(){
        var id = $(this).attr('rel');
        var deleteFunction = $(this).attr('rel1');
        Swal.fire({
            title: 'Are you sure?',
            text: 'Post will be removed!!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#d61610',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Deleted!',
                    'Post has been deleted.',
                    'success',
                );
                setTimeout(function () {
                    window.location.href="/admin/"+deleteFunction+"/"+id; //will redirect to your blog page (an ex: blog.html)
                }, 2000);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'Post is safe :)',
                    'success'
                )
            }
        });
    });

    $(document).on('click','.deleteUser',function(){
        var id = $(this).attr('rel');
        var deleteFunction = $(this).attr('rel1');
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will loose a user!!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#d61610',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Deleted!',
                    'User has been deleted.',
                    'success',
                );
                setTimeout(function () {
                    window.location.href="/admin/"+deleteFunction+"/"+id; //will redirect to your blog page (an ex: blog.html)
                }, 2000);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'User is safe :)',
                    'success'
                )
            }
        });
    });

    $(function () {
        $('#user_table').DataTable();
    });

    $(document).ready(function() {
        $(".fancybox").fancybox();
    });
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2({
            theme:'bootstrap4',

        });
    })

});