<div>
    <a class="btn btn-primary btnAddCategory" title="Nueva Categoria Ingreso" data-toggle="modal" data-target="#modalFormCategorias" data-tipo="GA"><i class="fa fa-plus"></i> Nueva</a>
</div>
<div class="table-responsive">
    <table class="table table-responsive table-striped table-bordered table-hover table-checkable datatable">
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $categoriasGasto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catGasto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <span id="catga_span_<?php echo e($catGasto->id); ?>"><?php echo e($catGasto->nombre); ?></span>
                        <input id="catga_<?php echo e($catGasto->id); ?>" class="form-control" type="text" name="nombre" value="<?php echo e($catGasto->nombre); ?>" style="display: none">
                    </td>
                    <td>
                        <div id="btngrpCatGa_<?php echo e($catGasto->id); ?>" class="btn-group acciones">
                            <?php if($catGasto->usuario_id == Auth::user()->id): ?>
                            <button type="button" class="btn btn-primary btnEditarCateGa" categId="<?php echo e($catGasto->id); ?>"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btnDeleted" elemId="<?php echo e($catGasto->id); ?>" band="CA"><i class="fa fa-trash"></i></button>
                            <?php endif; ?>
                        </div>
                        <div id="btngrpEditCatGa_<?php echo e($catGasto->id); ?>" class="btn-group" style="display: none;">
                            <button type="button" class="btn btn-primary btnSaveEdit" elemId="<?php echo e($catGasto->id); ?>" band="CA"><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger btnCancelEdit" categId="<?php echo e($catGasto->id); ?>"><i class="fa fa-close"></i></button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $('.btnEditarCateGa').on('click',function(){
        var id = $(this).attr('categId');
        obtElementosEditGasto(id,'S');
    });

    $('.btnCancelEdit').on('click',function(){
        var id = $(this).attr('categId');
        obtElementosEditGasto(id,'H');
    });

    function obtElementosEditGasto(id,band){
        var inputEdt = $('#catga_'+id);
        var botonsEdt = $('#btngrpEditCatGa_'+id);
        var botons = $('#btngrpCatGa_'+id);
        var span = $('#catga_span_'+id);
        if(band === 'S'){
            showEdit(inputEdt, botonsEdt, botons, span);
        }else{
            hideEdit(inputEdt, botonsEdt, botons, span);
        }
    }
</script>