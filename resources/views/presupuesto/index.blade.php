@extends('layouts.app')
@section('content')
    <style>
        .tooltip.top > .tooltip-inner{
            max-width: 200px;
            padding: 3px 8px;
            color: #fff;
            text-align: center;
            background-color: #06a388;
            border-radius: 4px
        }
    </style>
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
                                <input type="text" name="ingresoTotal" id="ingresoTotal" class="form-control" value="0" data-toggle="tooltip" title="Digite sus Ingresos Mensuales" data-placement="top" autofocus onkeypress="return filterFloat(event,this);">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <button  class="btn btn-primary" data-toggle="modal" data-target="#modalAddPresupuesto">Agregar
                            Categoria
                        </button>
                    </div>
                    @include('presupuesto.modal_add')

                </div>

                <div class="col-md-12">
                    <table class="table table-responsive table-striped table-bordered table-hover table-checkable datatable">
                        <thead>
                        <tr>
                            <th width="5"></th>
                            <th>Categoría</th>
                            <th>Valor</th>
                            <th>Descripcion</th>
                            <th>Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($presupuestos as $presup)
                            <tr class="trPresupuestoCategoria_{{$presup->id}}" style="{{$presup->estado==1?'text-decoration:line-through':''}}">
                                <td align="center"><i class="fa {{$presup->estado==0?'fa-square-o':'fa-check-square-o'}} fa-2x text-blue iCheckCompleto" style="cursor: pointer" data-id="{{$presup->id}}"></i></td>
                                <td>{{$presup->categoria->nombre}}</td>
                                <td class="tdValorG">{{$presup->valor}}</td>
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
                        <tfoot>
                            <tr>
                                <td colspan="2"><span class="text-bold h4">Total Gastos:</span></td>
                                <td><span class="text-bold h4" id="spaTotalGastos">$0.00</span></td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="box-footer">
            <div class="container">
                <h2 class="">TOTAL: <span id="spaTotalPresupuesto" class="text-bold"></span></h2>
            </div>
        </div>
        <div class="overlay">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
    @include('presupuesto.modal_edit')

    <script type="text/javascript">
        //Input con el valor de ingresos mensuales
        var inputIngreso = $("#ingresoTotal");
        // Al Cargar la pagina
        $(document).ready(function () {
            obtTotalGasto();
            sumaGastos();
            inputIngreso.on('keypress', function (e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if (code === 13) {
                    obtTotalGasto();
                }
            });
            $('[data-toggle="tooltip"]').tooltip();

            $('.overlay').fadeOut('slow');
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

        //Click al icono del chekbox para cambiar el estado del presupuesto
        $('.iCheckCompleto').on('click', function () {
            var id = $(this).data('id');
            var url = '{{URL::to('/presupuesto/actualizar-estado')}}';
            if ($(this).hasClass('fa-square-o')){
                $(this).removeClass('fa-square-o');
                $(this).addClass('fa-check-square-o');
                $('.trPresupuestoCategoria_'+id).css('text-decoration','line-through')
                $.get(url+'/'+id+'/'+1);
            }else{
                $(this).removeClass('fa-check-square-o');
                $(this).addClass('fa-square-o');
                $('.trPresupuestoCategoria_'+id).css('text-decoration','none')
                $.get(url+'/'+id+'/'+0);
            }
        });
        //Funcion para que solo se ingresen numeros en el input de ingreso mensual
        function filterFloat(evt,input){
            // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
            var key = window.Event ? evt.which : evt.keyCode;
            var chark = String.fromCharCode(key);
            var tempValue = input.value+chark;
            if(key >= 48 && key <= 57){
                return filter(tempValue) !== false;
            }else{
                if(key === 8 || key === 13 || key === 0) {
                    return true;
                }else if(key === 46){
                    return filter(tempValue) !== false;
                }else{
                    return false;
                }
            }
        }
        //Funcion para que solo se ingresen numeros en el input de ingreso mensual
        function filter(__val__){
            var preg = /^([0-9]+\.?[0-9]{0,2})$/;
            return preg.test(__val__) === true;
        }

        // Sumar los gastos
        function sumaGastos() {
            var totalGasto=0;
            $(".tdValorG").each(function(){
                totalGasto+=parseInt($(this).html()) || 0;
            });
            $('#spaTotalGastos').html('$'+totalGasto);
        }

        // Calcular total del presupuesto
        function obtTotalGasto() {
            var ingreso = $('#ingresoTotal');
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
                paging: false,
                searching: false,
                ordering: true,
                order: ['2','desc']
            });
        });
    </script>
@stop