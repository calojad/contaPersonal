<div class="modal fade" id="modalFormCuenta" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #06a388; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times" aria-hidden="true"></span></button>
                <h4 class="modal-title"><i class="fa fa-briefcase"></i> Nueva cuenta</h4>
            </div>
            <?php echo Form::open(['action' => 'CuentaController@crear']); ?>

            <div class="modal-body">
                <?php echo $__env->make('cuentas.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary pull-right" type="submit">Guardar</button>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>