<?php $__env->startSection('content'); ?>
<div class="row">
    <?php echo $__env->make('includes.notificacion', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="content">
        <div class="row">
            <div id="divInfUsuario" class="col-md-4">
                <div class="box box-principal">
                    <div class="box-header"><h3 class="box-title">Información del Perfil</h3></div>
                    <div class="box-body">
                        <div class="col-md-12 show-grid">
                            <img class="profile-user-img img-responsive img-circle" src="<?php echo e(asset($user->imagen)); ?>" alt="User profile picture">
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <label class="col-md-4">Nombre:</label><span class="col-md-7"> <?php echo e($user->name); ?> </span>
                            </div>
                            <div class="row">
                                <label class="col-md-4">Username:</label><span class="col-md-7"> <?php echo e($user->username); ?></span>
                            </div>
                            <div class="row">
                                <label class="col-md-4">Email:</label><span class="col-md-7"> <?php echo e($user->email); ?></span>
                            </div>
                        </div>
                        <a id="btnEditarUserPerfil" class="btn btn-xs btn-primary pull-right" title="Editar" href="#"><i class="fa fa-edit"></i></a>
                    </div>
                </div>
            </div>
            <?php echo $__env->make('perfil.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('perfil.modal_avatar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="col-md-8">
                <div class="box box-principal">
                    <div class="box-header"><h3 class="box-title">Información de Cuentas</h3></div>
                    <div class="box-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#tab_1" data-toggle="tab"><strong class="text-success">Cuentas</strong></a></li>
                              <li><a href="#tab_2" data-toggle="tab"><strong class="text-primary">Categorias de ingreso</strong></a></li>
                              <li><a href="#tab_3" data-toggle="tab"><strong class="text-danger">Categorias de gasto</strong></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <?php echo $__env->make('perfil.tab_cuentas', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                </div>
                                <div class="tab-pane" id="tab_2">
                                    <?php echo $__env->make('perfil.tab_categoriasIngreso', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                </div>
                                <div class="tab-pane" id="tab_3">
                                    <?php echo $__env->make('perfil.tab_categoriasGasto', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('cuentas.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('categorias.modal_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript" charset="utf-8" async defer>
    $(document).ready(function () {
        $('.modal').on('shown.bs.modal', function (e) {
            $('[autofocus]', e.target).focus();
        });
    });
    // Boton para eliminar un elemento
    $('.btnDeleted').on('click',function(){
        var id = $(this).attr('elemId');
        var band = $(this).attr('band');
        $.confirm({
            type: 'red',
            icon: 'glyphicon glyphicon-remove',
            title: 'Eliminar',
            content: '¿Esta Seguro de eliminar este elemento?<br>Puede contener datos valiosos.',
            buttons: {
                Eliminar: {
                    btnClass: 'btn-red any-other-class',
                    action: function(){
                        var url;
                        if(band === 'CU'){
                            url = "<?php echo e(URL::to('/cuenta/destroy/')); ?>"+"/"+id;
                        }else if(band === 'CA'){
                            url = "<?php echo e(URL::to('/categoria/destroy/')); ?>"+"/"+id;
                        }
                        $.get(url,function(json){
                            if(json.error){
                                toastr.error(json.url, 'Error');
                            }else{
                                window.location.href = json.url;
                            }
                        },'json');
                    }
                },
                cancel: function () {}
            },
            escapeKey: true,
            backgroundDismiss: true
        });
    });
    //Boton Nueva Categoria
    $('.btnAddCategory').on('click',function () {
        var tipo = $(this).data('tipo');
        if(tipo==='IN'){
            $('#mdlHeaderCategory').css('background-color','#3c8dbc');
            $('#inpHiddenTipoCategory').val(1);
        }else{
            $('#mdlHeaderCategory').css('background-color','#dd4b39');
            $('#inpHiddenTipoCategory').val(2);
        }
    });
    //Boton Guardar Edicion Tab's
    $('.btnSaveEdit').on('click',function () {
        var id = $(this).attr('elemId');
        var url;
        var band = $(this).attr('band');
        var data;
        if(band === 'CU'){
            data = {nombre:$('#cue_'+id).val()};
            url = "<?php echo e(URL::to('/cuenta/update/')); ?>"+"/"+id;
        }else if(band === 'CA'){
            data = {nombre:$('#catin_'+id).val()};
            url = "<?php echo e(URL::to('/categoria/update/')); ?>"+"/"+id;
        }
        $.get(url,data,function(json){
            window.location.href = json.url;
        },'json');
    });
    //Boton Editar Informacion del Usuario
    $('#btnEditarUserPerfil').on('click',function () {
        $('#divInfUsuario').hide();
        $('#divEditarInfoUsuario').show();
    });
    //Boton Cancelar Edicion Usuario
    $('#btnCancelEditUserPerfil').on('click',function () {
        $('#divInfUsuario').show();
        $('#divEditarInfoUsuario').hide();
    });
    //Inicializacion de DataTable
    $(function () {
            $('.table').DataTable({
                scrollY: '50vh',
                scrollCollapse: true,
                paging: false
            });
    });
    // Cargara imagen al seleccionar en el input:file
    $("#imagen").on('change',function() {
        readURL(this);
    });
    $('.aUserImageProfileDefault').on('click',function () {
        var path = $(this).find('img').attr('src');
        $('.imagenmuestra').attr('src', path);
        $('#inpImgPath').val(path);
    });
    // Cancelar modal avatar
    $('.btnCancelarAvatar').on('click',function () {
        var path = '<?php echo e(asset($user->imagen)); ?>';
        $('.imagenmuestra').attr('src', path);
        $('#inpImgPath').val(path);
    });

// FUNCIONES EDITAR TABS
    // Previsualizar Imagen
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Asignamos el atributo src a la tag de imagen
                $('.imagenmuestra').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    // Mostrar botones de Editar
    function showEdit(inputEdt, botonsEdt, botons, span){
        inputEdt.show();
        botons.hide();
        span.hide();
        botonsEdt.show();

        $('.acciones *').prop('disabled',true);
    }
    // Ocultar botones de Editar
    function hideEdit(inputEdt, botonsEdt, botons, span){
        inputEdt.hide();
        span.show();
        botons.show();
        botonsEdt.hide();

        $('.acciones *').prop('disabled',false);
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>