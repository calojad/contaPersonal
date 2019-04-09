<div id="divEditarInfoUsuario" class="col-md-4" style="display: none">
    <div class="box box-principal">
        <div class="box-header"></div>
        {{Form::open(['url' => 'perfil/saveuserperfil','method' => 'post'])}}
        <div class="box-body">
            <div class="col-md-12 show-grid contenedor-img">
                <a href="" data-toggle="modal" data-target="#modalPerfilAvatar">
                    <img class="profile-user-img img-responsive img-circle imagenmuestra image" src="{{ asset($user->imagen) }}" alt="User profile picture" style="cursor: pointer">
                    <div class="middle">
                        <div class="text-img"><i class="fa fa-camera"></i> Editar</div>
                    </div>
                </a>
            </div>
            <div class="col-md-12">
                <div class="row show-grid">
                    <label class="col-md-4">Nombre:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" value="{{$user->name}}" name="name" required>
                    </div>
                </div>
                <div class="row show-grid">
                    <label class="col-md-4">Username:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" value="{{$user->username}}" name="username" required>
                    </div>
                </div>
                <div class="row show-grid">
                    <label class="col-md-4">Email:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" value="{{$user->email}}" name="email" required>
                    </div>
                </div>
                <div>
                    <hr>
                    <h4>Cambiar Contraseña</h4>
                </div>
                <!-- Password Field -->
                <div class="row show-grid {{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-md-4">
                        {!! Form::label('password', 'Password:') !!}
                    </div>
                    <div class="col-md-8">
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <!-- Confirm Password Field -->
                <div class="row show-grid {{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-md-4">
                        {!! Form::label('password_confirmation', 'Confirmar:') !!}
                    </div>
                    <div class="col-md-8">
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button id="btnCancelEditUserPerfil" class="btn btn-default pull-left" type="button">Cancelar</button>
            <button id="btnSaveEditUserPerfil" class="btn btn-primary pull-right" type="submit">Guardar</button>
        </div>
        {{Form::close()}}
    </div>
</div>