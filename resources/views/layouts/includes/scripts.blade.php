<!-- Scripts -->
<!-- JQuery -->
{!! Html::script('plugins/jquery/jquery-3.3.1.min.js') !!}
<!-- Boostrap 3 -->
{!! Html::script('boostrap-3.3.7/js/bootstrap.min.js') !!}
<!-- AdminLTE -->
{!! Html::script('adminLTE-2.4.3/dist/js/adminlte.min.js') !!}
<!-- iCheck -->
{!! Html::script('plugins/iCheck/icheck.min.js') !!}
<!-- DataTables -->
{!! Html::script('adminLTE-2.4.3/bower_components/datatables/js/jquery.dataTables.js') !!}
{!! Html::script('adminLTE-2.4.3/bower_components/datatables/js/dataTables.bootstrap.js') !!}
<!-- Alert Confirm -->
{!! Html::script('plugins/jquery_alerts/jquery-confirm.min.js') !!}
<!-- Moment -->
{!! Html::script('plugins/moment.js/moment-with-locales.min.js') !!}

<script type="text/javascript">
    function validarSesion() {
        try {
            var url = '{{ URL::to("/validasesion") }}';
            var userLogin = '{{ Auth::user() }}'
            $.get(url, function(json) {
                // console.log(json);
                if (!json.band && userLogin != '')
                    window.location.href = json.href;
            }, 'json');
        } catch (error) {
            console.log(error);
        }
    }
    setInterval(validarSesion, 906000);
</script>