<!DOCTYPE html>
<html>
<head>
    @include('layouts.includes.head')
    @yield('styles')
</head>
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">
    <header class="main-header">
        @include('layouts.includes.menuSuperior')
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="content">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('header')
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
        </div>
    </div>
    <footer class="main-footer">
        <div class="container">
            <div class="pull-right">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; {{date('Y')}} <a href="https://cal-webdes.com" target="_blank">CAL-WebDes</a>.</strong> All rights reserved.
        </div>
    </footer>
</div>

@include('layouts.includes.scripts')
@yield('scripts')
</body>
</html>