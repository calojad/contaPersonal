<div class="modal fade" id="modalFormGasto" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times" aria-hidden="true"></span></button>
                <h4 class="modal-title"><i class="fa fa-dollar"></i> Nuevo gasto</h4>
            </div>
            <?php echo Form::open(['url'=>'/transaccion/gasto/create','method'=>'post']); ?>

            <div class="modal-body">
                <input id="cuenta_id_gastos" type="hidden" name="cuenta_id">
                <input type="hidden" name="tipo_transac_id" value="2">
                <input type="hidden" name="tipo" value="S">
                
                <div class="form-group">
                    <label>Categoria: </label>
                    <?php echo e(Form::select('categoria_transac_id',$categoriasGasto,null,['class'=>'form-control','required'=>true])); ?>

                </div>
                
                <div class="form-group">
                    <label for="valor_gasto">Valor: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                        <input class="form-control" type="number" name="valor" id="valor_gasto" placeholder="250.00" required step="any">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="fecha">Fecha: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input class="form-control" type="date" name="fecha" id="fecha" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="nombre">Descripcion: </label>
                    <input class="form-control" id="nombre_gasto" name="descripcion" type="text" placeholder="Arriendo">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><b>Guardar</b></button>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>