@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
@stop
@section('content')
    <input id="inpHiddenCuentas" type="hidden" value="{{$cuentas}}">
    <input id="inpHiddenGCategorias" type="hidden" value="{{$cuentas}}">
    @include('includes.notificacion')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary box-sombra">
                <div class="box-header with-border">
                    <h3 class="box-title">Cuentas</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-responsive table-striped table-bordered table-hover table-checkable datatable">
                            <thead>
                                <tr>
                                    <th>Cuenta</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead> 1

                            <tbody>
                                @php($total = 0)
                                @foreach ($cuentas as $cuenta)
                                    <tr>
                                        <td>
                                            <a href="{{URL::to('/home').'/'.$cuenta->id}}">{{ $cuenta->nombre }}</a>
                                        </td>
                                        <td>{{ $cuenta->saldo==null?'0.00':$cuenta->saldo }}</td>
                                    </tr>
                                    @php($total = $total + $cuenta->saldo)
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td><b>TOTAL:</b></td>
                                    <td><b>{{$total}}</b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Saldo</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="chartCuentas" style="height: 40vh;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border"><h3 class="box-title">Gastos por Categoría</h3></div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="chartGCategorias" style="height: 60vh;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var colores = ["rgba(255, 205, 86, 0.2)","rgba(255, 99, 132, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 159, 64, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)"];
        //Inicializar Chart Cuentas
        $(function () {
            var ids=0;
            var cuentas = JSON.parse($('#inpHiddenCuentas').val());
            var ctx = document.getElementById('chartCuentas').getContext('2d');
            var labels=[], valor=[], color=[];
            $.each(cuentas, function(id, value) {
                labels.push(value.nombre);
                valor.push(value.saldo);
                color.push(colores[ids]);
                if(ids>7)
                    ids=0;
                else
                    ids++;
            });

            var data = {
                labels  : labels,
                datasets: [
                    {
                        label: 'Saldo',
                        data: valor,
                        backgroundColor:color,
                        borderWidth:1
                    }
                ]
            };
            var opciones = {
                responsive: true,
                maintainAspectRatio: false,
                sscales:{
                    xAxes:[{
                        ticks:{beginAtZero:true}
                    }]
                }
            };

            var chart = new Chart(ctx, {
                type: 'horizontalBar',
                data: data,
                options: opciones
            });
        });
        //Inicializar Chart Gastos por Categorias
        $(function () {
            var d = new Date();
            var n = d.getMonth();
            var ids=0;
            var categorias = JSON.parse($('#inpHiddenGCategorias').val());
            var ctx = document.getElementById('chartGCategorias').getContext('2d');
            var valor=[], color=[];
            var meses =['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

        /*    $.each(cuentas, function(id, value) {
                valor.push(value.saldo);
                color.push(colores[ids]);
                if(ids>7)
                    ids=0;
                else
                    ids++;
            });*/

            var data = {
                labels  : [meses[n]],
                datasets: [
                    {
                        label: 'Arriendo',
                        data: [250],
                        backgroundColor:'red',
                        borderWidth:1
                    },
                    {
                        label: 'Agua',
                        data: [20],
                        backgroundColor:'blue',
                        borderWidth:1
                    }
                ]
            };
            var opciones = {
                responsive: true,
                maintainAspectRatio: false,
                sscales:{
                    xAxes:[{
                        ticks:{beginAtZero:true}
                    }]
                }
            };

            var chart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: opciones
            });
        });
        //Inicializacion de DataTable
        $(function () {
            $('.table').DataTable({
                scrollCollapse: true,
                paging: false
            });
        });
    </script>
@stop
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
@stop