<?php echo Html::script('plugins/toastr/toastr.min.js'); ?>

<?php echo Html::style('plugins/toastr/toastr.min.css'); ?>


<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "2000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    <?php if(Session::has('success')): ?>
    toastr.success("<?php echo e(Session::get('success')); ?>", 'Correcto');
    <?php endif; ?>
    <?php if(Session::has('info')): ?>
    toastr.info("<?php echo e(Session::get('info')); ?>");
    <?php endif; ?>
    <?php if(Session::has('warning')): ?>
    toastr.warning("<?php echo e(Session::get('warning')); ?>", 'Advertencia');
    <?php endif; ?>
    <?php if(Session::has('error')): ?>
    toastr.error("<?php echo e(Session::get('error')); ?>", 'Error');
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            toastr.error("<?php echo e($error); ?>", 'Error');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</script>