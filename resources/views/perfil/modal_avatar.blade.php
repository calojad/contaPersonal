<div class="modal fade" id="modalPerfilAvatar" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #06a388; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times" aria-hidden="true"></span></button>
                <h4 class="modal-title"><i class="fa fa-user"></i> Perfil Imagen</h4>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Seleccione una Imagen:</label>
                        <input id="imagen" name="imagen" type="file">
                        <div class="form-group" align="center">
                            <img src="{{asset($user->imagen)}}" width="40%" height="40%" class="imagenmuestra" alt="Imagen de usuario">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary pull-right" type="submit">Aceptar</button>
            </div>
        </div>
    </div>
</div>