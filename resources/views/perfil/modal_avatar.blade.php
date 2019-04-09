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
                        {!! Form::open(['url' => 'perfil/imguser', 'method' => 'post', 'files' => true]) !!}
                            <label class="control-label">Seleccione una Imagen:</label>
                            <input id="imagen" name="imagen" type="file">
                            <input type="hidden" name="userId" value="{{$user->id}}">
                            <div class="form-group" align="center">
                                <img src="{{asset($user->imagen)}}" width="40%" height="40%" class="imagenmuestra" alt="Imagen de usuario">
                            </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default pull-left" type="button" data-dismiss="modal">Cancelar</button>
                <button id="btnAceptarAvatar" class="btn btn-primary pull-right" type="submit">Aceptar</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>