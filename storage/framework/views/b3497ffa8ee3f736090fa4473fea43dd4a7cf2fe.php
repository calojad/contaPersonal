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
                    <?php echo Form::open(['url' => 'perfil/imguser', 'method' => 'post', 'files' => true]); ?>

                    <label class="control-label">Seleccione una Imagen:</label>
                    <input id="imagen" name="imagen" type="file">
                    <input type="hidden" name="userId" value="<?php echo e($user->id); ?>">
                    <input id="inpImgPath" type="hidden" name="defaultImagen">
                    <div class="form-group" align="center">
                        <img src="<?php echo e(asset($user->imagen)); ?>" width="20%" height="20%" class="imagenmuestra" alt="Imagen de usuario">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="users-list clearfix" style="border-top: 1px solid lightgray">
                            <li>
                                <a class="aUserImageProfileDefault"><img class="img-rounded img-responsive" src="<?php echo e(asset('adminLTE-2.4.3/dist/img/avatar.png')); ?>" alt="Avatar 1"></a>
                            </li>
                            <li>
                                <a class="aUserImageProfileDefault"><img class="img-rounded img-responsive" src="<?php echo e(asset('adminLTE-2.4.3/dist/img/avatar2.png')); ?>" alt="Avatar 3"></a>
                            </li>
                            <li>
                                <a class="aUserImageProfileDefault"><img class="img-rounded img-responsive" src="<?php echo e(asset('adminLTE-2.4.3/dist/img/avatar3.png')); ?>" alt="Avatar 3"></a>
                            </li>
                            <li>
                                <a class="aUserImageProfileDefault"><img class="img-rounded img-responsive" src="<?php echo e(asset('adminLTE-2.4.3/dist/img/avatar04.png')); ?>" alt="Avatar 4"></a>
                            </li>
                            <li>
                                <a class="aUserImageProfileDefault"><img class="img-rounded img-responsive" src="<?php echo e(asset('adminLTE-2.4.3/dist/img/avatar5.png')); ?>" alt="Avatar 5"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default pull-left btnCancelarAvatar" type="button" data-dismiss="modal">Cancelar</button>
                <button id="btnAceptarAvatar" class="btn btn-primary pull-right" type="submit">Aceptar</button>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>