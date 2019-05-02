@extends('layouts.app')
@section('header')
    <h1>
        {{config('app.name','EVAL')}}
        <small>Presupuesto</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/presupuesto')}}"><i class="fa fa-home"></i> Presupuesto</a></li>
    </ol>
@stop
@section('content')
    @include('includes.notificacion')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Presupuestos</h3>
        </div>
        <div class="box-body">
            <div class="container">
                <div class="form-horizontal col-md-12 col-md-offset-2">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-md-5 control-label" for="ingresoTotal">Total ingresos:</label>
                            <div class="col-md-5">
                                <input type="number" name="ingretoTotal" id="ingresoTotal" class="form-control" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddPresupuesto">Agregar
                            Categoria
                        </button>
                    </div>
                    @include('presupuesto.modal_add')

                </div>

                <div class="col-md-12">
                    <table class="table table-responsive table-striped table-bordered table-hover table-checkable datatable">
                        <thead>
                        <tr>
                            <th>Categoría</th>
                            <th>Valor</th>
                            <th>Descripcion</th>
                            <th>Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($presupuestos as $presup)
                            <tr>
                                <td>{{$presup->categoria->nombre}}</td>
                                <td>{{$presup->valor}}</td>
                                <td>{{$presup->estado}}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="container">
                <h2 class="">TOTAL: <span id="spaTotalPresupuesto" class="text-bold"></span></h2>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        $(document).ready(function () {
            obtTotalGasto();

            $("#ingresoTotal").on('keypress', function (e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code===13){
                    obtTotalGasto();
                }
            });
        });

        $('#ingresoTotal').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        function obtTotalGasto(){
            var ingreso = $('#ingresoTotal');
            var url= '{{URL::to('presupuesto/totales')}}'+'/'+ingreso.val();
            var span =  $('#spaTotalPresupuesto');

            $.get(url,function (json) {
                console.log(json);
                span.html('$ '+json);
            },'json');
        }

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

    </script>
@stop