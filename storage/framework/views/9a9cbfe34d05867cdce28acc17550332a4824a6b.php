<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <input id="inpHiddenCuentas" type="hidden" value="<?php echo e($cuentas); ?>">
    <input id="inpHiddenGCategorias" type="hidden" value="<?php echo e($gastosCateg); ?>">
    <?php echo $__env->make('includes.notificacion', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                        <table class="table table-striped table-bordered table-hover table-checkable datatable">
                            <thead>
                                <tr>
                                    <th>Cuenta</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php ($total = 0); ?>
                                <?php $__currentLoopData = $cuentas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuenta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(URL::to('/home').'/'.$cuenta->id); ?>"><?php echo e($cuenta->nombre); ?></a>
                                        </td>
                                        <td><?php echo e($cuenta->saldo==null?'0.00':$cuenta->saldo); ?></td>
                                    </tr>
                                    <?php ($total = $total + $cuenta->saldo); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td><b>TOTAL:</b></td>
                                    <td><b><?php echo e($total); ?></b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-info box-sombra">
                <div class="box-header with-border">
                    <h3 class="box-title">Saldo</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="chartCuentas" style="height: 60vh"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning box-sombra">
                <div class="box-header with-border">
                    <h3 class="box-title">Categoría</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-checkable datatable">
                            <thead>
                            <tr>
                                <th>Categoria</th>
                                <th>Gasto</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php ($total = 0); ?>
                            <?php $__currentLoopData = $gastosCateg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gasto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <a class="btnVerDetallesGasto" style="cursor: pointer" data-idcategoria="<?php echo e($gasto->categoria_transac_id); ?>" data-toggle="modal" data-target="#modalDetallesGastoDashboard" title="Ver Detalles"><?php echo e($gasto->nombre); ?></a>
                                    </td>
                                    <td><?php echo e($gasto->gasto==null?'0.00':$gasto->gasto); ?></td>
                                </tr>
                                <?php ($total = $total + $gasto->gasto); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                            <tfoot>
                            <tr>
                                <td><b>TOTAL:</b></td>
                                <td><b><?php echo e($total); ?></b></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('dashboard.modal_detallesGasto', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="col-md-8">
            <div class="box box-danger box-sombra">
                <div class="box-header with-border">
                    <h3 class="box-title">Gastos por Categoría</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="chartGCategorias" style="height: 92vh;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var colores = ["rgba(255, 205, 86, 0.5)","rgba(255, 99, 132, 0.5)","rgba(75, 192, 192, 0.5)","rgba(201, 203, 207, 0.5)","rgba(54, 162, 235, 0.5)","rgba(255, 159, 64, 0.5)","rgba(153, 102, 255, 0.5)"];
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
                if(ids===6)
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
                plugins: {
                    datalabels:{
                        anchor:'end',
                        align:'right',
                        offset:2
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                scales:{
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
        //*Fin Chart Cuentas*
        //Inicializar Chart Gastos por Categorias
        $(function () {
            var d = new Date();
            var n = d.getMonth();
            var ids=0;
            var categorias = JSON.parse($('#inpHiddenGCategorias').val());
            var ctx = document.getElementById('chartGCategorias').getContext('2d');
            var datasets=[];
            var meses =['ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];

            $.each(categorias, function(id, value) {
                var obj;
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

            var data = {
                labels  : [meses[n]],
                datasets: datasets
            };
            var opciones = {
                responsive: true,
                plugins: {
                    datalabels:{
                        anchor:'end'
                    }
                },
                legend: {
                    position:'bottom'
                },
                maintainAspectRatio: false,
                scales:{
                    xAxes:[{
                        ticks:{beginAtZero:true}
                    }],
                    yAxes: [{
                        ticks: {mirror: true}
                    }]
                }
            };

            var chart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: opciones
            });
        });
        //*Fin Chart Categoria Gastos*
        //Inicializacion de DataTable
        $(function () {
            $('.table').DataTable({
                scrollCollapse: true,
                paging: false,
                searching: false
            });
        });
        //Boton ver detalles del gasto
        $('.btnVerDetallesGasto').on('click', function () {
            var id = $(this).data('idcategoria');
            var url = '<?php echo e(URL::to('/dashboard/detalle-cat-gasto')); ?>'+'/'+id;
            var t = $('#tblDetallesCatGastos').DataTable();
            $.get(url,function (json) {
                t.clear().draw();
                json.forEach(function(g){
                    t.row.add([
                        g.descripcion!=null?g.descripcion:g.nombre,
                        g.valor
                    ]).draw(false);
                });
            },'json');
        })
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>