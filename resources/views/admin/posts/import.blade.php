<div class="col-md-12 mb-5">
    <form method="POST" action="{{ route('import.posts') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')

         <div class="row">
            <div class="col-md-6">
                <input class="form-control" type="file" name="csv">
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary" type="submit">
                    Submit
                </button>
            </div>
        </div>
    </form>
</div>