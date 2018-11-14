{!! Html::script('plugins/toastr/toastr.min.js') !!}
{!! Html::style('plugins/toastr/toastr.min.css') !!}

<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "2000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}", 'Correcto');
    @endif
    @if(Session::has('info'))
    toastr.info("{{ Session::get('info') }}");
    @endif
    @if(Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}", 'Advertencia');
    @endif
    @if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}", 'Error');
    @endif

    @if($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{$error}}", 'Error');
        @endforeach
    @endif
</script>