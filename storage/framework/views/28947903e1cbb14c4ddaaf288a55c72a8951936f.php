<div class="col-md-12">
    <form id="formLoginConfirm" class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="form-group divUsername">
            <label for="username" class="col-md-4 control-label">Username</label>
            <div class="col-md-6">
                <input id="username" type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>" required autofocus>
                <span class="help-block" style="text-align: left"><strong id="spaErrorUsername"></strong></span>
            </div>
        </div>

        <div class="form-group divPassword">
            <label for="password" class="col-md-4 control-label">Password</label>
            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>
                <span class="help-block" style="text-align: left"><strong id="spaErrorPassword"></strong></span>
            </div>
        </div>

        

        <div class="form-group">
            <div class="col-md-8 col-md-offset-2">
                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">Forgot Your Password?</a>
                <a id="btnCompCredencial" class="btn btn-primary pull-right">Iniciar <i id="iLoginSpinner" class="fa fa-sign-in"></i></a>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function () {
        $('input[type=checkbox]').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });
    });
    $("#username").on('keypress',function(e){
        let code = (e.keyCode ? e.keyCode : e.which);
        if(code===13){
            $('#password').focus();
        }
    });
    $('#password').on('keypress',function(e){
        let code = (e.keyCode ? e.keyCode : e.which);
        let username = $('#username').val();
        let password = $('#password').val();
        if(code===13){
            abrirSesion(username,password);
        }
    });
    $('#btnCompCredencial').on('click',function (){
        let username = $('#username').val();
        let password = $('#password').val();
        abrirSesion(username,password);
    });

    function abrirSesion(user,pass){
        $("#iLoginSpinner").addClass('fa-spinner fa-spin');
        let url = "<?php echo e(URL::to('/login/credenciales')); ?>";
        let inpUser = $('#username');
        if(inpUser.val().length <= 0){
            toastr.error('Ingrese sus credenciales para continuar', 'Error al iniciar sesión');
            $('#iLoginSpinner').removeClass('fa-spinner fa-spin');
        }else {
            let data = {username: user, password: pass, _token: '<?php echo e(csrf_token()); ?>'};
            $.post(url, data, function (json) {
                if (json === 'True') {
                    $('#formLoginConfirm').submit();
                } else {
                    toastr.error(json, 'Error al iniciar sesión');
                    $('#iLoginSpinner').removeClass('fa-spinner fa-spin');
                }
            }, 'json');
        }
    }
</script>