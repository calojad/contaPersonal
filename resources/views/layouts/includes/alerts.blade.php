@if (session('status'))
    <div class="alert alert-success" align="center">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        {{ session('status') }}
    </div>
@endif