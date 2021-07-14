<?php $__env->startSection('content'); ?>
    <div class="row">

        <?php echo $__env->make('includes.notificacion', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="col-md-12">
            
            <div class="nav-tabs-custom">
                
                <ul class="nav nav-tabs">
                    <?php $__currentLoopData = $cuentas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuenta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="<?php echo e($tabActiva==$cuenta->id?'active':''); ?>">
                            <a id="<?php echo e($cuenta->id); ?>" class="tabCuentaLista" href="#tab_<?php echo e($cuenta->id); ?>" data-toggle="tab"><?php echo e($cuenta->nombre); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a class="btn btn-social-icon" title="Nueva Cuenta" data-toggle="modal" data-target="#modalFormCuenta" style="background: #06a388;color: white"><i class="fa fa-plus"></i></a>
                    </li>
                </ul>
                
                <div class="tab-content">
                    <?php if(count($cuentas) != 0): ?>
                        <?php $__currentLoopData = $cuentas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuenta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-pane <?php echo e($tabActiva==$cuenta->id?'active':''); ?>" id="tab_<?php echo e($cuenta->id); ?>">
                                <?php echo $__env->make('cuentas.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="content" align="center">
                            <h4 class="text-danger">No hay cuentas</h4>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <?php echo $__env->make('ingreso.modal_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->make('gasto.modal_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->make('cuentas.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->make('cuentas.modal_transferir', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->make('cuentas.modal_edit_transacc', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <script type="text/javascript">
        $(function () {
            $('.table').DataTable({
                paging: false,
                lengthChange: true,
                searching: true,
                // order: [[ 2, "desc" ]],
                ordering: false,
                autoWidth: false,
                retrieve: true,
                responsive: true,
                scrollY: '50vh',
                scrollCollapse: true
                /*columnDefs: [ {
                    targets: 2,
                    render: $.fn.dataTable.render.moment('YYYY/MM/DD', 'DD/MM/YYYY')
                } ]*/
            });
        });
        
        $(document).ready(function () {
            moment.locale('es');
            var cuentaId = "<?php echo e($tabActiva); ?>";
            var hasta = moment().format('Y-M-D');
            var desde = moment().format('Y')+'-'+moment().format('M')+'-1';
            obtTransacciones(cuentaId,desde,hasta);
            //Poner el focus al mostrar el modal
            $('.modal').on('shown.bs.modal', function (e) {
                $('[autofocus]', e.target).focus();
            });
            //Inicializa el tooaltip
            $('[data-toggle="tooltip"]').tooltip();
        });
        // Reloj
        setInterval(function(){
            var times = moment().format('h:mm:ss a');
            var par = $('.spaReloj');
            par.html(times);
        },1000);
        // Boton para llenar el formulario de Ingresos
        $('.btnFormIngreso').on('click',function () {
            $('#cuenta_id_ingreso').val($(this).attr('cuentaId'));
            $('#nombre_ingreso').val('');
            $('#valor_ingreso').val('');
        });
        // Boton para llenar el formulario de Gastos
        $('.btnFormGastos').on('click',function () {
            $('#cuenta_id_gastos').val($(this).attr('cuentaId'));
            $('#nombre_gasto').val('');
            $('#valor_gasto').val('');
        });
        // Tab para cargar transacciones
        $('.tabCuentaLista').on('click',function () {
            var cuentaId = $(this).attr('id');
            var overlay = $('.overlay');
            var hasta = moment().format('Y-M-D');
            var desde = moment().format('Y')+'-'+moment().format('M')+'-1';
            overlay.fadeIn();
            obtTransacciones(cuentaId,desde,hasta);
            $('.btnMesActual').addClass('active');
            $('.btnMesAnterior').removeClass('active');
            $('.btnDateCustom').removeClass('active');
            $('.divDesdeHasta').hide();
        });
        // Boton mes actual
        $('.btnMesActual').on('click',function () {
            var cuentaId = $(this).data('id');
            var overlay = $('.overlay');
            $('.divDesdeHasta').hide();
            if(!$(this).hasClass('active')){
                var hasta = moment().format('Y-M-D');
                var desde = moment().format('Y')+'-'+moment().format('M')+'-1';
                overlay.fadeIn();
                obtTransacciones(cuentaId,desde,hasta);
            }
            $(this).addClass('active');
            $('.btnMesAnterior').removeClass('active');
            $('.btnDateCustom').removeClass('active');
        });
        // Boton mes anterior
        $('.btnMesAnterior').on('click',function () {
            var cuentaId = $(this).data('id');
            var overlay = $('.overlay');
            $('.divDesdeHasta').hide();
            if(!$(this).hasClass('active')){
                var hasta = moment().subtract(moment().format('D'),'days').format('Y-M-D');
                var numDias = moment(hasta).format('D');
                var desde = moment(hasta).subtract(numDias-1,'days').format('Y-M-D');
                overlay.fadeIn();
                obtTransacciones(cuentaId,desde,hasta);
            }
            $(this).addClass('active');
            $('.btnMesActual').removeClass('active');
            $('.btnDateCustom').removeClass('active');
        });
        // Boton fecha personalizada
        $('.btnDateCustom').on('click',function () {
            $('.divDesdeHasta').show();
            $(this).addClass('active');
            $('.btnMesAnterior').removeClass('active');
            $('.btnMesActual').removeClass('active');
        });
        // Boton buscar por fecha personalizada
        $('.btnSearchDateCustom').on('click',function () {
            var cuentaId = $(this).data('id');
            var overlay = $('.overlay');
            var desde = $('#inpDate1_'+cuentaId).val();
            var hasta = $('#inpDate2_'+cuentaId).val();
            if(desde === '' && hasta==='')
                toastr.error("Fechas no validas", 'Error');
            else if(moment(desde).isSameOrBefore(hasta)){
                overlay.fadeIn();
                obtTransacciones(cuentaId,desde,hasta);
            }else {
                toastr.error("Las fechas deben ser pertinentes", 'Error');
            }
        });
        // Boton mostrar modal de transferencias
        $('.btnTransferirEntreCuentas').on('click',function () {
            var url = '<?php echo e(URL::to('cuenta/listransferir')); ?>'+'/'+$(this).data('id');
            var select = $('.selCuetnasDestinoTransfer');
            $('input[name=cuenta_ini]').val($(this).data('nombre'));
            $('input[name=cuenta_ini_id]').val($(this).data('id'));
            $.get(url,function (json) {
                select.empty();
                $.each(json, function(id,value){
                    select.append('<option value="'+id+'">'+value+'</option>');
                });
            },'json');
        });
        // Boton mostrar modal para editar transaccion
        $(document).on('click','.btnEditarTransaccionModal',function () {
            var id = $(this).data('id');
            var categoriaId = $(this).data('categoria');
            var valor = $(this).data('valor');
            var fecha = $(this).data('fecha');
            var descripcion = $(this).data('descripcion');
            var tipoTransac = $(this).data('tipotransac');
            var select = $('#selCategoriaTransacEdit');
            var cuenta = $(this).data('cuenta');
            var categorias;

            if(tipoTransac === 1){
                categorias = JSON.parse($('input[name=categoriasIngreso]').val());
            }else{
                categorias = JSON.parse($('input[name=categoriasGasto]').val());
            }
            console.log(categorias);
            select.empty();
            $.each(categorias, function(id,value){
                select.append('<option value="'+id+'">'+value+'</option>');
            });

            var elementos = select.children("option").get();
            elementos.sort(function(a,b) {
                var A = $(a).text().toUpperCase();
                var B = $(b).text().toUpperCase();
                return (A < B) ? -1 : (A > B) ? 1 : 0;
            });
            $.each(elementos, function(id, elemento) {
                select.append(elemento);
            });

            $('#selCategoriaTransacEdit > option[value='+categoriaId+']').attr("selected",true);
            $('#inpHiddenIdTransac').val(id);
            $('#valorTransacEdit').val(valor);
            $('#fechaTransacEdit').val(fecha);
            $('#descripTransacEdit').val(descripcion);
            $('#inpCuentaIdEditTransac').val(cuenta);
            $('#inpTipoIdEditTransac').val(tipoTransac);
        });

        // Funcion para obtener las transacciones de X cuenta desde fecha inicio hasta fecha fin
        function obtTransacciones(cuentaId,desde,hasta) {
            var url = "<?php echo e(URL::to('/transaccion/listatransacciones/')); ?>"+"/"+cuentaId+"/"+desde+"/"+hasta;
            var ti = $('#tblIngresos_'+cuentaId).DataTable();
            var tg = $('#tblGastos_'+cuentaId).DataTable();
            $.get(url,function (transac) {
                dibujarTabla(transac.ingresos,ti);
                dibujarTabla(transac.gastos,tg);
                $('#totalIng_'+cuentaId).html(parseFloat(transac.totalIng).toFixed(2));
                $('#totalGas_'+cuentaId).html(parseFloat(transac.totalGas).toFixed(2));
                $('#total_'+cuentaId).html(parseFloat(transac.total).toFixed(2));
                $('.overlay').fadeOut('slow');
            },'json');
        }
        // Funcion que dibuja la tabla con sus transacciones
        function dibujarTabla(json,t) {
            t.clear().draw();
                json.forEach(function(c){
                    t.row.add([
                        '<span data-toggle="tooltip" title="'+ (c.descripcion!=null ? c.descripcion : c.categoria_nombre) +'" data-placement="right">'+c.categoria_nombre+'</span>',
                        c.valor,
                        '<span data-toggle="tooltip" title="'+ c.created_at +'" data-placement="right">'+moment(c.fecha).format('DD/MMM/YYYY')+'</span>',
                        '<form action="<?php echo e(URL::to('transaccion/destroy/')); ?>/'+c.id+'" method="GET">' +
                            '<div class="btn-group">' +
                                '<button class="btn btn-primary btn-xs btnEditarTransaccionModal" type="button"     data-toggle="modal" data-target="#modalEditTransac" data-id="'+c.id+'" data-categoria="'+c.categoria_id+'" data-valor="'+c.valor+'" data-fecha="'+c.fecha+'" data-descripcion="'+c.descripcion+'" data-tipotransac="'+c.tipo_transac_id+'" data-cuenta="'+c.cuenta_id+'"><i class="fa fa-edit"></i></button>' +
                                '<button class="btn btn-danger btn-xs" type="submit" title="Eliminar Transaccion"><i class="fa fa-trash"></i></button>'+
                            '</div>' +
                        '</form>'
                    ]).draw();
                });
            $('[data-toggle="tooltip"]').tooltip();
        }
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <?php echo Html::script('plugins/moment.js/datetime.js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>