<div class="modal fade" id="modalFormCategorias" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="mdlHeaderCategory" class="modal-header" style="color: white;"> <!--#dd4b39-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times" aria-hidden="true"></span></button>
                <h4 class="modal-title"><i class="fa fa-list-ul"></i> Nueva Categoria</h4>
            </div>
            {!! Form::open(['url'=>'/categoria/store','method'=>'post']) !!}
            <input type="hidden" id="inpHiddenTipoCategory" name="tipo_transac_id">
            <div class="modal-body">
                <div class="form-group">
                    <label for="catNombre">Nombre: </label>
                    <input id="catNombre" title="Nombre Categoria" class="form-control" name="nombre" type="text" autofocus required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><b>Guardar</b></button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>