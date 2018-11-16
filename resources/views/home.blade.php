@extends('layouts.app')
@section('content')
    <div class="row">
        @include('includes.notificacion')
        <div class="col-md-12">
            {{-- TAB'S --}}
            <div class="nav-tabs-custom">
                {{--PESTAÑAS DE LAS CUENTAS--}}
                <ul class="nav nav-tabs">
                    @foreach($cuentas as $cuenta)
                        <li class="{{$tabActiva==$cuenta->id?'active':''}}">
                            <a id="{{$cuenta->id}}" class="tabCuentaLista" href="#tab_{{$cuenta->id}}" data-toggle="tab">{{$cuenta->nombre}}</a>
                        </li>
                    @endforeach
                    <li>
                        <a class="btn btn-social-icon" title="Nueva Cuenta" data-toggle="modal" data-target="#modalFormCuenta" style="background: #06a388;color: white"><i class="fa fa-plus"></i></a>
                    </li>
                </ul>
                {{--CONTENIDO DE CADA PESTAÑA--}}
                <div class="tab-content">
                    @if(count($cuentas) != 0)
                        @foreach($cuentas as $cuenta)
                            <div class="tab-pane {{$tabActiva==$cuenta->id?'active':''}}" id="tab_{{$cuenta->id}}">
                                @include('cuentas.index')
                            </div>
                        @endforeach
                    @else
                        <div class="content" align="center">
                            <h4 class="text-danger">No hay datos</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{--MODAL FORM INGRESOS--}}
    @include('ingreso.modal_form')
    {{--MODAL FORM GASTOS--}}
    @include('gasto.modal_form')
    {{--MODAL FORM CUENTAS--}}
    @include('cuentas.modal')
    <script type="text/javascript">
        $(function () {
            $('.table').DataTable({
                pagingType: "full_numbers",
                paging: false,
                lengthChange: true,
                searching: false,
                ordering: true,
                autoWidth: false,
                retrieve: true,
                responsive: true
            });
        });
        {{--Cuando cargue la pagina--}}
        $(document).ready(function () {
            var cuentaId = "{{$tabActiva}}";
            obtTransacciones(cuentaId);

            $('.overlay').fadeOut();

            $('.modal').on('shown.bs.modal', function (e) {
                $('[autofocus]', e.target).focus();
            })
        });
        // Boton para llenar el formulario de Ingresos
        $('.btnFormIngreso').on('click',function () {
            $('#cuenta_id_ingreso').val($(this).attr('cuentaId'));
            $('#nombre_ingreso').val('');
            $('#valor_ingreso').val('');
        });
        // Boton para llenar el formulario de Gastos
        $('.btnFormGastos').on('click',function () {
            $('#cuenta_id_gastos').val($(this).attr('cuentaId'));
            $('#nombre_gasto').val('');
            $('#valor_gasto').val('');
        });
        // Tab para cargar transacciones
        $('.tabCuentaLista').on('click',function () {
            var cuentaId = $(this).attr('id');
            var overlay = $('.overlay');
            overlay.fadeIn();
            obtTransacciones(cuentaId);
            overlay.fadeOut();
        });
        function obtTransacciones(cuentaId) {
            var url = "{{URL::to('/transaccion/listatransacciones/')}}"+"/"+cuentaId;
            var ti = $('#tblIngresos_'+cuentaId).DataTable();
            var tg = $('#tblGastos_'+cuentaId).DataTable();
            $.get(url,function (transac) {
                dibujarTabla(transac.ingresos,ti);
                dibujarTabla(transac.gastos,tg);
                $('#totalIng_'+cuentaId).html(parseFloat(transac.totalIng).toFixed(2));
                $('#totalGas_'+cuentaId).html(parseFloat(transac.totalGas).toFixed(2));
                $('#total_'+cuentaId).html(parseFloat(transac.total).toFixed(2));
            },'json');
        }
        function dibujarTabla(json,t) {
            t.clear().draw();
            json.forEach(function(c){
                t.row.add([
                    c.categoria_nombre,
                    c.valor,
                    new Date(c.created_at).toLocaleDateString("es-ES",{day:'2-digit',month:'short',year:'numeric'})
                ]).draw(false);
            });
        }
    </script>
@endsection