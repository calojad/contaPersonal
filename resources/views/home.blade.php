@extends('layouts.app')
@section('styles')
    {!! Html::style('css/miestilo.css') !!}
@endsection
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
    <script>
        {{--Cuando cargue la pagina--}}
        $(document).ready(function () {
            var cuentaId = "{{$tabActiva}}";
            obtTransacciones(cuentaId);
            $('.overlay').fadeOut();
        });
        // Boton para llenar el formulario de Ingresos
        $('.btnFormIngreso').on('click',function () {
            $('#cuenta_id_ingreso').val($(this).attr('cuentaId'));
            $('#nombre_ingreso').val('');
            $('#valor_ingreso').val('');
        });
        // Boton para llenar el formulario de Gastos
        $('.btnFormGastos').on('click',function () {
            $('#cuenta_id_gasto').val($(this).attr('cuentaId'));
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
            $.get(url,function (transac) {
                console.log(transac);
            },'json');
        }
        function dibujarTabla() {

        }
    </script>
@endsection