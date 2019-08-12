@extends('layouts.app')
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
                                <td>{{$presup->descripcion}}</td>
                                <td>
                                    <div class="btn-group acciones">
                                        <button type="button" class="btn btn-primary btnEditPresu" data-toggle="modal" data-target="#modalEditPresupuesto" data-presupuesto="{{$presup}}"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btnDeletePresu" data-id="{{ $presup->id }}"><i class="fa fa-trash"></i></button>
                                    </div>
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
    @include('presupuesto.modal_edit')
    <script type="text/javascript">
        var inputIngreso = $("#ingresoTotal");
        $(document).ready(function () {
            obtTotalGasto();

            inputIngreso.on('keypress', function (e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if (code === 13) {
                    obtTotalGasto();
                }
            });
        });
        // Boton para editar el presupuesto
        $('.btnEditPresu').on('click', function () {
            var presupuesto =$(this).data('presupuesto');

            $('#presupuesto_categoria_transac_id option').attr("selected",false);

            $('#presupuesto_categoria_transac_id > option[value='+presupuesto.categoria_transac_id+']').attr("selected",true);
            $('#idPresupuesto').val(presupuesto.id);
            $('#valorPresupuesto').val(presupuesto.valor);
            $('#descripcionPresupuesto').val(presupuesto.descripcion);
        });
        // Boton para eliminar el presupuesto
        $('.btnDeletePresu').on('click', function () {
            var id = $(this).data('id');
            $.confirm({
                type: 'red',
                icon: 'glyphicon glyphicon-remove',
                title: 'Eliminar',
                content: '¿Esta Seguro de eliminar este elemento?',
                buttons: {
                    Eliminar: {
                        btnClass: 'btn-red any-other-class',
                        action: function () {
                            var url = '{{URL::to('/presupuesto/destroy')}}' + '/' + id;
                            $.get(url, function (json) {
                                window.location.href = json.url;
                            }, 'json');
                        }
                    },
                    cancel: function () {
                    }
                },
                escapeKey: true,
                backgroundDismiss: true
            });
        });

        inputIngreso.on('input', function () {
            this.value = this.value.replace(/[^0-9,.]/g, '');
        });

        // Calcular total del presupuesto
        function obtTotalGasto() {
            var ingreso = $('#ingresoTotal');
            console.log(ingreso.val());
            if (ingreso.val() === '') {
                ingreso.val(0);
            }
            var url = '{{URL::to('presupuesto/totales')}}' + '/' + ingreso.val();
            var span = $('#spaTotalPresupuesto');

            $.get(url, function (json) {
                if (json < 0)
                    span.html('$ ' + json).css('color', 'red');
                else
                    span.html('$ ' + json).css('color', 'black');
            }, 'json');
        }

        // Inicializar Tabla
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