<div class="modal fade" id="modalTransferencia" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #06a388; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times" aria-hidden="true"></span></button>
                <h4 class="modal-title"><i class="fa fa-exchange"></i> Transferencia</h4>
            </div>
            <?php echo Form::open(['url' => '/cuenta/transferir','method'=>'POST','class'=>'form-horizontal']); ?>

            <div class="modal-body">
                
                <div class="form-group">
                    <label class="col-md-3 control-label">Cuenta Inicio:</label>
                    <div class="input-group col-md-6">
                        <input type="hidden" name="cuenta_ini_id">
                        <input class="form-control" name="cuenta_ini" disabled>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-3 control-label">Cuenta Destino:</label>
                    <div class="input-group col-md-6">
                        <select name="cuenta_des" class="form-control selCuetnasDestinoTransfer" required></select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-3 control-label">Valor: </label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                        <input class="form-control" type="text" name="valor" placeholder="375.00" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-3 control-label">Por Concepto de: </label>
                    <div class="input-group col-md-6">
                        <?php echo Form::select('categorias', $categorias , null , ['class' => 'form-control']); ?>

                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-3 control-label">Descripción: </label>
                    <div class="input-group col-md-6">
                        <input class="form-control" name="descripcion" type="text" placeholder="Opcional">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary pull-right" type="submit">Guardar</button>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>