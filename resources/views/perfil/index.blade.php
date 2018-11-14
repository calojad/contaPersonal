@extends('layouts.app')
@section('content')
<div class="row">
    @include('includes.notificacion')
    <div class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-principal">
                    <div class="box-header"></div>
                    <div class="box-body">
                        <div class="col-md-12 show-grid">
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/CAL_logo.png') }}" alt="User profile picture">
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <label class="col-md-4">Nombre:</label><span class="col-md-7"> {{$user->name}} </span>
                            </div>
                            <div class="row">
                                <label class="col-md-4">Username:</label><span class="col-md-7"> {{$user->username}}</span>
                            </div>
                            <div class="row">
                                <label class="col-md-4">Email:</label><span class="col-md-7"> {{$user->email}}</span>
                            </div>
                        </div>
                        <a class="btn btn-xs btn-primary pull-right" title="Editar" href="#"><i class="fa fa-edit"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box box-principal">
                    <div class="box-header"><h3 class="box-title">Ajustes</h3></div>
                    <div class="box-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#tab_1" data-toggle="tab">Cuentas</a></li>
                              <li><a href="#tab_2" data-toggle="tab">Categorias de ingreso</a></li>
                              <li><a href="#tab_3" data-toggle="tab">Categorias de gasto</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    @include('perfil.tab_cuentas')
                                </div>
                                <div class="tab-pane" id="tab_2">
                                    @include('perfil.tab_categoriasIngreso')
                                </div>
                                <div class="tab-pane" id="tab_3">
                                    @include('perfil.tab_categoriasGasto')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
            $('.table').DataTable({
                pagingType: "full_numbers",
                paging: false,
                lengthChange: true,
                searching: false,
                ordering: true,
                autoWidth: false,
                retrieve: true,
                responsive: true
            });
        });
</script>
@endsection