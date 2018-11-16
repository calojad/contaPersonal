<div class="modal fade" id="modalFormCategorias" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times" aria-hidden="true"></span></button>
                <h4 class="modal-title"><i class="fa fa-list-ul"></i> Nueva Categoria</h4>
            </div>
            {!! Form::open(['url'=>'/transaccion/ingreso/create','method'=>'post']) !!}
            <div class="modal-body">
                <div class="form-group">
                    <label for="nombre">Descripcion: </label>
                    <input class="form-control" id="nombre_ingreso" name="nombre" type="text" placeholder="Sueldo fin de mes">
                </div>
                <div class="form-group">
                    <label for="valor">Valor: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                        <input class="form-control" type="text" name="valor" id="valor_ingreso" placeholder="375.00" required>
                    </div>
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