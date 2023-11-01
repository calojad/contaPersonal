@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
@stop
@section('content')
    <input id="inpHiddenCuentas" type="hidden" value="{{$cuentas}}">
    <input id="inpHiddenGCategorias" type="hidden" value="{{$gastosCateg}}">
    @include('includes.notificacion')
{{-- FILA DE CARDS CON SALDOS DE CUENTAS --}}
    <div class="row">
        <div style="overflow: auto;white-space: nowrap;margin-bottom: 20px">
            @foreach ($cuentas as $cuenta)
                <div style="display:inline-block;width: 20em;">
                    <div class="col-lg-12 col-xs-12 col-md-12">
                        <div class="small-box {{$cuenta->saldo <= 0 ? 'bg-red':(($cuenta->saldo >0) && ($cuenta->saldo < 150) ? 'bg-yellow':(($cuenta->saldo >150) && ($cuenta->saldo < 500)?'bg-aqua':'bg-green'))}}" style="margin-bottom: 0px">
                            <div class="inner">
                                <h3>{{ $cuenta->saldo ?? '0.00' }}</h3>
                                <p>{{ $cuenta->nombre }}</p>
                            </div>
                            <div class="icon" style="display: block; !important">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            <a href="{{URL::to('/home').'/'.$cuenta->id}}" class="small-box-footer">Ver Cuenta <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
{{-- FILA CHART DE CUENTAS --}}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info box-sombra collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Diagrama de Saldos</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="chartCuentas"></canvas>
                    </div>
                </div>
                <div class="overlay">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
        </div>
    </div>
{{-- FILA DE GASTOS --}}
    <div class="row">
        {{--  CUADRO DEL DETALLE GASTOS CATEGORIAS  --}}
        <div class="col-md-4">
            {{--  MENU PARA CAMBIAR DE FECHA  --}}
            <div class="box box-primary box-sombra">
                <div class="box-body">
                    <div class="col-md-6" style="padding-left:5px">
                        <button id="btnLeftMesGasto" class="btn btn-default"><i class="fa fa-angle-left fa-2x"></i></button>
                        <span class="spaMesGastosButton text-bold text-center" style="display: inline-block;width: 85px;"></span>
                        <button id="btnRightMesGasto" class="btn btn-default"><i class="fa fa-angle-right fa-2x"></i></button>
                    </div>
                    <div class="col-md-4" style="padding-left:5px">
                        <select id="selectAnosFinan" class="form-control" name="anio">
                        @foreach($anosTransacciones as $ano)
                            @if ($ano->años === (int)$a)
                                <option value="{{$ano->años}}" selected="selected">{{$ano->años}}</option>
                            @else
                                <option value="{{$ano->años}}">{{$ano->años}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                    <div class="col-md-2" style="padding-left:5px">
                        <button id="btnHoy" class="btn btn-success text-bold">Hoy</button>
                    </div>
                </div>
                <div class="overlay overlay-gastos">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
            {{-- LISTA / TABLA CON LOS GASTOS  --}}
            <div class="box box-warning box-sombra">
                <div class="box-header with-border">
                    <h3 class="box-title">Categoría</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-checkable datatable" id="tblCategoriasGastosDash">
                            <thead>
                            <tr>
                                <th>Categoria</th>
                                <th>Gasto</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($total = 0)
                            @foreach ($gastosCateg as $gasto)
                                <tr>
                                    <td>
                                        <a class="btnVerDetallesGasto" style="cursor: pointer" onclick="VerDetalleCategoriaGasto({{$gasto->categoria_transac_id}})" data-toggle="modal" data-target="#modalDetallesGastoDashboard" title="Ver Detalles">{{ $gasto->nombre }}</a>
                                    </td>
                                    <td>{{ $gasto->gasto ?? '0.00' }}</td>
                                </tr>
                                @php($total += $gasto->gasto)
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td><b>TOTAL:</b></td>
                                <td><b class="bTotalCategoriaGastoDash">{{round($total, 2)}}</b></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="overlay overlay-gastos">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
        </div>
        @include('dashboard.modal_detallesGasto')
        {{--    CUADRO DEL CHART DE GASTO POR CATEGORIA    --}}
        <div class="col-md-8">
            <div class="box box-danger box-sombra">
                <div class="box-header with-border">
                    <h3 class="box-title">Gastos por Categoría</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div >
                <div class="box-body">
                    <div class="chart">
                        <canvas id="chartGCategorias"></canvas>
                    </div>
                </div>
                <div class="overlay overlay-gastos">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const colores = ["rgba(255, 205, 86, 0.5)", "rgba(255, 99, 132, 0.5)", "rgba(75, 192, 192, 0.5)", "rgba(201, 203, 207, 0.5)", "rgba(56,155,226,0.5)", "rgba(255, 159, 64, 0.5)", "rgba(153, 102, 255, 0.5)"];
        const meses =['ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
        const overlay = $('.overlay');
        const overlayGasto = $('.overlay-gastos');
        const mesActual = new Date().getMonth();
        const anoActual = new Date().getFullYear();
        const labelMes =   $('.spaMesGastosButton');
        var ano = $('select[name="anio"]').val();
        var mes = mesActual;
        var chart;
        $(document).ready(function(){
            labelMes.html(meses[mesActual]);
            overlay.fadeOut('slow');
        });

        //Inicializacion de DataTable
        $(function () {
            $('.table').DataTable({
                scrollY:"32vh",
                scrollCollapse: true,
                paging: false,
                searching: false
            });
        });

        //Inicializar Chart Cuentas
        $(function () {
            let ids=0;
            let cuentas = JSON.parse($('#inpHiddenCuentas').val());
            let ctx = document.getElementById('chartCuentas').getContext('2d');
            let labels=[], valor=[], color=[];
            $.each(cuentas, function(id, value) {
                labels.push(value.nombre);
                valor.push(value.saldo);
                color.push(colores[ids]);
                if(ids===6)
                    ids=0;
                else
                    ids++;
            });
            let data = {
                labels  : labels,
                datasets: [
                    {
                        label: 'Saldo',
                        data: valor,
                        backgroundColor:color,
                        borderWidth:2
                    }
                ]
            };
            let opciones = {
                legend: {
                    display: false
                },
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'right',
                        offset: 2
                    }
                },
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMax: Math.max.apply(null,valor)+100,
                            stepSize: 100
                        }
                    }],
                    yAxes: [{
                        categoryPercentage: 0.7
                    }]
                }
            };

            let chart = new Chart(ctx, {
                type: 'horizontalBar',
                data: data,
                options: opciones
            });
        });
        //*Fin Chart Cuentas*

        //Inicializar Chart Gastos por Categorias
        $(function () {
            let categorias = JSON.parse($('#inpHiddenGCategorias').val());
            let ctx = document.getElementById('chartGCategorias').getContext('2d');
            cargaChartGastos(categorias,ctx,mesActual);
        });
        //*Fin Chart Categoria Gastos*

        //Combo box años cada que cambie dar el valor a la variable global
        $('#selectAnosFinan').on('change', function (){
            overlayGasto.fadeIn();
            ano = $(this).val();
            $('#selectAnosFinan > option').attr('selected',false);
            $('#selectAnosFinan > option[value = "'+ano+'"]').attr('selected',true);
            let ctx = document.getElementById('chartGCategorias').getContext('2d');
            let url = "{{URL::to('/dashboard/gastos-mes')}}"+"/"+(mes+1)+"/"+ano;
            chart.destroy();
            $.get(url, function(json){
                cargaChartGastos(json,ctx,mes);
                cargaTblCategorias(json);
                labelMes.html(meses[mes]);
            },'json');
            overlayGasto.fadeOut();
        });

        //Boton mover al mes actual (HOY)
        $('#btnHoy').on('click',function (){
            overlayGasto.fadeIn();
            mes = mesActual;
            ano = anoActual;
            let anoAnt = $('#selectAnosFinan');
            $('#selectAnosFinan > option[value = "'+anoAnt.val()+'"]').attr('selected',false);
            $('#selectAnosFinan > option[value = "'+ano+'"]').attr('selected',true);
            let ctx = document.getElementById('chartGCategorias').getContext('2d');
            let url = "{{URL::to('/dashboard/gastos-mes')}}"+"/"+(mes+1)+"/"+ano;
            chart.destroy();
            $.get(url, function(json){
                cargaChartGastos(json,ctx,mes);
                cargaTblCategorias(json);
                labelMes.html(meses[mes]);
            },'json');
            overlayGasto.fadeOut();
        });

        // Boton cambiar mes anterior
        $('#btnLeftMesGasto').on('click',function(){
            overlayGasto.fadeIn();
            if(mes > 0){
                mes--;
                let ctx = document.getElementById('chartGCategorias').getContext('2d');
                let url = "{{URL::to('/dashboard/gastos-mes')}}"+"/"+(mes+1)+"/"+ano;
                chart.destroy();
                $.get(url, function(json){
                    cargaChartGastos(json,ctx,mes);
                    cargaTblCategorias(json);
                    labelMes.html(meses[mes]);
                },'json');
            }
            overlayGasto.fadeOut();
        });

        // Boton cambiar mes siguiente
        $('#btnRightMesGasto').on('click',function(){
            overlayGasto.fadeIn();
            if(mes <11){
                mes++;
                let ctx = document.getElementById('chartGCategorias').getContext('2d');
                let url = "{{URL::to('/dashboard/gastos-mes')}}"+"/"+(mes+1)+"/"+ano;
                chart.destroy();
                $.get(url, function(json){
                    labelMes.html(meses[mes]);
                    cargaTblCategorias(json);
                    cargaChartGastos(json,ctx,mes);
                },'json');
            }
            overlayGasto.fadeOut();
        });

        //Funcion ver modal con el detalle de los gastos
        function VerDetalleCategoriaGasto(id){
            let url = '{{URL::to('/dashboard/detalle-cat-gasto')}}'+'/'+id+'/'+(mes+1)+'/'+(ano);
            let t = $('#tblDetallesCatGastos').DataTable();
            $.get(url,function (json) {
                t.clear().draw();
                json.forEach(function(g){
                    t.row.add([
                        g.descripcion!=null?g.descripcion:g.nombre,
                        g.valor,
                        moment(g.fecha).format('DD/MMM/YYYY')
                    ]).draw(false);
                });
            },'json');
        }

        //Funcion para cargar datos en chart de gastos
        function cargaChartGastos(categorias,ctx,mes){
            let ids = 0;
            let datasets = [];
            $.each(categorias, function(id, value) {
                let obj;
                obj = {
                    label: value.nombre,
                    data: [value.gasto],
                    backgroundColor:colores[ids],
                    borderWidth:2
                };
                datasets.push(obj);
                if(ids===6)
                    ids=0;
                else
                    ids++;
            });
            let data = {
                labels: [meses[mes]],
                datasets: datasets
            };
            let opciones = {
                responsive: true,
                plugins: {
                    datalabels: {
                        anchor: 'center'
                    }
                },
                legend: {
                    position: 'bottom'
                },
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        ticks: {beginAtZero: true},
                        categoryPercentage: 0.5
                    }],
                    yAxes: [{
                        ticks: {mirror: true, min: 0}
                    }]
                }
            };
            chart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: opciones
            });
        }
        //Funcion recargar tabla de Categorias
        function cargaTblCategorias(data){
            let t = $('#tblCategoriasGastosDash').DataTable();
            let totalhtml =  $('.bTotalCategoriaGastoDash');
            let total = 0;
            t.clear().draw();
            data.forEach(function(g){
                t.row.add([
                    '<a class="btnVerDetallesGasto" style="cursor: pointer" data-toggle="modal" data-target="#modalDetallesGastoDashboard" title="Ver Detalles" onclick="VerDetalleCategoriaGasto('+g.categoria_transac_id+')">'+g.nombre+'</a>',
                    g.gasto
                ]).draw(true);
                total += parseFloat(g.gasto);
            });
            totalhtml.empty();
            totalhtml.html(Math.round(total * 100) / 100);
        }
    </script>
@stop
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
@stop