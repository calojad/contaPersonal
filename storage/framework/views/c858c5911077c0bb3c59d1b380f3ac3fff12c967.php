<?php echo Form::open(['url'=>'/presupuesto/update','method'=>'post']); ?>

<div class="modal fade" id="modalEditPresupuesto" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #06a388; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times" aria-hidden="true"></span></button>
                <h4 class="modal-title">Editar Gasto Presupuestario</h4>
            </div>

            <div class="modal-body">
                <div class="content">
                    <input type="hidden" name="usuario_id" value="<?php echo e(Auth::user()->id); ?>">
                    <input id="idPresupuesto" type="hidden" name="id">

                    
                    <div class="form-group">
                        <label for="presupuesto_categoria_transac_id">Categoria: </label>
                        <?php echo e(Form::select('categoria_transac_id',$categoriaTransac,null,['class'=>'form-control','required'=>true,'id'=>'presupuesto_categoria_transac_id'])); ?>

                    </div>

                    
                    <div class="form-group">
                        <label for="valorPresupuesto">Valor: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input class="form-control" type="number" name="valor" id="valorPresupuesto" placeholder="375.00" required step="any">
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label for="descripcionPresupuesto">Descripcion: </label>
                        <input class="form-control" id="descripcionPresupuesto" name="descripcion" type="text">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><b>Guardar</b></button>
            </div>

        </div>
    </div>
</div>
<?php echo Form::close(); ?>