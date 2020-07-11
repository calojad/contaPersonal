<div>
    <a class="btn btn-primary" title="Nueva Cuenta" data-toggle="modal" data-target="#modalFormCuenta"><i class="fa fa-plus"></i> Nueva</a>
</div>
<div class="table-responsive">
    <table class="table table-responsive table-striped table-bordered table-hover table-checkable datatable" id="tblCuentasUser">
        <thead>
            <tr>
                <th>Cuenta</th>
                <th>Saldo</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
        <?php ($total = 0); ?>
            <?php $__currentLoopData = $cuentas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuenta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <a href="<?php echo e(URL::to('/home').'/'.$cuenta->id); ?>"><span id="cue_span_<?php echo e($cuenta->id); ?>"><?php echo e($cuenta->nombre); ?></span></a>
                        <input id="cue_<?php echo e($cuenta->id); ?>" class="form-control" type="text" name="nombre" value="<?php echo e($cuenta->nombre); ?>" style="display:none">
                    </td>
                    <td><?php echo e($cuenta->saldo==null?'0.00':$cuenta->saldo); ?></td>
                    <td>
                        <div id="btngrpCuenta_<?php echo e($cuenta->id); ?>" class="btn-group acciones">
                            <button type="button" class="btn btn-primary btnEditarCuenta" cuentaId="<?php echo e($cuenta->id); ?>"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btnDeleted" elemId="<?php echo e($cuenta->id); ?>" band="CU"><i class="fa fa-trash"></i></button>
                        </div>
                        <div id="btngrpEditCuenta_<?php echo e($cuenta->id); ?>" class="btn-group" style="display: none;">
                            <button type="button" class="btn btn-primary btnSaveEdit" elemId="<?php echo e($cuenta->id); ?>" band="CU"><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger btnCancelEdit" cuentaId="<?php echo e($cuenta->id); ?>"><i class="fa fa-close"></i></button>
                        </div>
                    </td>
                </tr>
                <?php ($total = $total + $cuenta->saldo); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tfoot>
        <tr>
            <td><b>TOTAL:</b></td>
            <td><b><?php echo e($total); ?></b></td>
            <td></td>
        </tr>
        </tfoot>
    </table>
</div>
<script type="text/javascript">
    $('.btnEditarCuenta').on('click',function(){
        var id = $(this).attr('cuentaId');
        obtElementosEditCuenta(id,'S');
    });

    $('.btnCancelEdit').on('click',function(){
        var id = $(this).attr('cuentaId');
        obtElementosEditCuenta(id,'H');
    });

    function obtElementosEditCuenta(id,band){
        var inputEdt = $('#cue_'+id);
        var botonsEdt = $('#btngrpEditCuenta_'+id);
        var botons = $('#btngrpCuenta_'+id);
        var span = $('#cue_span_'+id);
        if(band === 'S'){
            showEdit(inputEdt, botonsEdt, botons, span);
        }else{
            hideEdit(inputEdt, botonsEdt, botons, span);
        }
    }
</script>