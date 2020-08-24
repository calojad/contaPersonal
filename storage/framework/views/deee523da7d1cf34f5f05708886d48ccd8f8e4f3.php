<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo e(config('app.name', 'Laravel')); ?></title>
<link rel="icon" href="<?php echo e(asset('coins-finance.ico')); ?>">

<!-- Boostrap -->
<?php echo Html::style('boostrap-3.3.7/css/bootstrap.min.css'); ?>

<!-- FontAwesome -->
<?php echo Html::style('adminLTE-2.4.3/bower_components/font-awesome/css/font-awesome.min.css'); ?>

<!-- AdminLTE -->
<?php echo Html::style('adminLTE-2.4.3/dist/css/AdminLTE.min.css'); ?>

<?php echo Html::style('adminLTE-2.4.3/dist/css/skins/skin-green.css'); ?>

<!-- iCheck -->
<?php echo Html::style('/plugins/iCheck/square/_all.css'); ?>

<!-- DataTables -->
<?php echo Html::style('/adminLTE-2.4.3/bower_components/datatables/css/dataTables.bootstrap.min.css'); ?>

<!-- Mis Estilos -->
<?php echo Html::style('css/miestilo.css'); ?>

<!-- Alert Confirm -->
<?php echo Html::style('plugins/jquery_alerts/jquery-confirm.min.css'); ?>

<!-- JQuery -->
<?php echo Html::script('plugins/jquery/jquery-3.3.1.min.js'); ?>