<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Laravel') }}</title>
<link rel="icon" href="{{asset('coins-finance.ico')}}">

<!-- Styles -->
{{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
<!-- Boostrap -->
{!! Html::style('boostrap-3.3.7/css/bootstrap.min.css') !!}
<!-- FontAwesome -->
{!! Html::style('adminLTE-2.4.3/bower_components/font-awesome/css/font-awesome.min.css') !!}
{{--<!-- Ionicons -->--}}
{{--{!! Html::style('adminLTE-2.4.3/bower_components/Ionicons/css/ionicons.min.css') !!}--}}
<!-- AdminLTE -->
{!! Html::style('adminLTE-2.4.3/dist/css/AdminLTE.min.css') !!}
{!! Html::style('adminLTE-2.4.3/dist/css/skins/skin-green.css') !!}

<!-- JQuery -->
{!! Html::script('plugins/jquery/jquery-3.3.1.min.js') !!}
<!-- Alert Confirm -->
{!! Html::style('plugins/jquery_alerts/jquery-confirm.min.css') !!}