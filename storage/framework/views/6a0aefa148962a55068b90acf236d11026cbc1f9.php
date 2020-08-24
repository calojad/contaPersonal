<div id="divEditarInfoUsuario" class="col-md-4" style="display: none">
    <div class="box box-principal">
        <div class="box-header"><h3 class="box-title">Información del Perfil</h3></div>
        <?php echo e(Form::open(['url' => 'perfil/saveuserperfil','method' => 'post'])); ?>

        <div class="box-body">
            <div class="col-md-12 show-grid contenedor-img">
                <a href="" data-toggle="modal" data-target="#modalPerfilAvatar">
                    <img class="profile-user-img img-responsive img-circle imagenmuestra image" src="<?php echo e(asset($user->imagen)); ?>" alt="User profile picture" style="cursor: pointer">
                    <div class="middle">
                        <div class="text-img"><i class="fa fa-camera"></i> Editar</div>
                    </div>
                </a>
            </div>
            <div class="col-md-12">
                <div class="row show-grid">
                    <label class="col-md-4">Nombre:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" value="<?php echo e($user->name); ?>" name="name" required>
                    </div>
                </div>
                <div class="row show-grid">
                    <label class="col-md-4">Username:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" value="<?php echo e($user->username); ?>" name="username" required>
                    </div>
                </div>
                <div class="row show-grid">
                    <label class="col-md-4">Email:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" value="<?php echo e($user->email); ?>" name="email" required>
                    </div>
                </div>
                <div>
                    <hr>
                    <h4>Cambiar Contraseña</h4>
                </div>
                <!-- Password Field -->
                <div class="row show-grid <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <div class="col-md-4">
                        <?php echo Form::label('password', 'Password:'); ?>

                    </div>
                    <div class="col-md-8">
                        <?php echo Form::password('password', ['class' => 'form-control']); ?>

                    </div>
                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <!-- Confirm Password Field -->
                <div class="row show-grid <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <div class="col-md-4">
                        <?php echo Form::label('password_confirmation', 'Confirmar:'); ?>

                    </div>
                    <div class="col-md-8">
                        <?php echo Form::password('password_confirmation', ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button id="btnCancelEditUserPerfil" class="btn btn-default pull-left" type="button">Cancelar</button>
            <button id="btnSaveEditUserPerfil" class="btn btn-primary pull-right" type="submit">Guardar</button>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
</div>