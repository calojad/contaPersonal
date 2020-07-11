<!DOCTYPE html>
<html>
<head>
    <?php echo $__env->make('layouts.includes.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">
    <header class="main-header">
        <?php echo $__env->make('layouts.includes.menuSuperior', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="content">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <?php echo $__env->yieldContent('header'); ?>
            </section>

            <!-- Main content -->
            <section class="content">
                <?php echo $__env->yieldContent('content'); ?>
            </section>
        </div>
    </div>
    <footer class="main-footer">
        <div class="container">
            <div class="pull-right">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; <?php echo e(date('Y')); ?> <a href="https://cal-webdes.com" target="_blank">CAL-WebDes</a>.</strong> All rights reserved.
        </div>
    </footer>
</div>

<?php echo $__env->make('layouts.includes.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>