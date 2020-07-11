
<div class="box box-solid box-principal">
    
    <div class="box-header">
        <div class="row">
            <div class="col-md-9">
                <span class="box-title"><?php echo e($cuenta->nombre .' - Ultimos Movimientos'); ?></span>
                <a class="btn btn-default btnTransferirEntreCuentas" title="Transferir"  style="margin-left:15px" data-toggle="modal" data-target="#modalTransferencia" data-id="<?php echo e($cuenta->id); ?>" data-nombre="<?php echo e($cuenta->nombre); ?>"><i class="fa fa-exchange"></i></a>
            </div>
            <div class="pull-right col-md-3">
                <div class="col-md-8">
                    <span class="text-bold" style="font-size: large"><?php echo e(\Carbon\Carbon::now()->formatLocalized('%A %d de %b %Y')); ?></span>
                </div>
                <div class="col-md-4">
                    <span class="spaReloj text-bold" style="font-size: large"></span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="box-body" style="background: #ecf0f5">
        
        <div class="col-md-12">
            <div class="box box-sombra" style="border-top: none">
                <div class="box-body">
                    <div class="col-md-12 form-group" align="center">
                        <button class="btn btn-default active btnMesActual" data-id="<?php echo e($cuenta->id); ?>">Mes Actual</button>
                        <button class="btn btn-default btnMesAnterior" data-id="<?php echo e($cuenta->id); ?>">Mes Anterior</button>
                        <button class="btn btn-default btnDateCustom" data-id="<?php echo e($cuenta->id); ?>">Fecha Personalizada</button>
                    </div>
                    <div class="form-group divDesdeHasta" style="display: none;">
                        <div class="col-md-4 col-md-offset-1">
                            <label class="col-md-3 control-label">Desde:</label>
                            <div class="col-md-9">
                                <input id="inpDate1_<?php echo e($cuenta->id); ?>" class="form-control" type="date" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-3 control-label">Hasta:</label>
                            <div class="col-md-9">
                                <input id="inpDate2_<?php echo e($cuenta->id); ?>" class="form-control" type="date" required>
                            </div>
                        </div>
                        <div class="col-md-2" align="right">
                            <button class="btn btn-primary btnSearchDateCustom" title="Buscar" data-id="<?php echo e($cuenta->id); ?>"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="box box-primary box-sombra" align="center">
                <div class="box-header">
                    <span class="box-title"><i class="fa fa-money"></i> Ingresos</span>
                    <a class="btn btn-social-icon btn-primary pull-right btnFormIngreso" data-toggle="modal" data-target="#modalFormIngreso" cuentaId="<?php echo e($cuenta->id); ?>"><i class="fa fa-plus"></i></a>
                </div>
                <div class="box-body">
                    <?php echo $__env->make('ingreso.tabla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="box-footer">
                    <p style="font-weight: bold;font-size: 14pt">Total Ingresos: <span id="totalIng_<?php echo e($cuenta->id); ?>" class="text-info"></span></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="box box-danger box-sombra" align="center">
                <div class="box-header">
                    <span class="box-title"><i class="fa fa-dollar"></i> Gastos</span>
                    <a class="btn btn-social-icon btn-danger pull-right btnFormGastos" data-toggle="modal" data-target="#modalFormGasto" cuentaId="<?php echo e($cuenta->id); ?>"><i class="fa fa-plus"></i></a>
                </div>
                <div class="box-body">
                    <?php echo $__env->make('gasto.tabla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="box-footer">
                    <p style="font-weight: bold;font-size: 14pt">Total Gastos: <span id="totalGas_<?php echo e($cuenta->id); ?>" class="text-danger"></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <p style="font-weight: bold;font-size: 14pt">SALDO TOTAL: <span id="total_<?php echo e($cuenta->id); ?>" class="text-success"></span></p>
    </div>
    <div class="overlay">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</div>