@extends('layouts.app')
@section('header')
    <h1>
        {{config('app.name','EVAL')}}
        <small>Presupuesto</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/presupuesto')}}"><i class="fa fa-home"></i> Presupuesto</a></li>
    </ol>
@stop
@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Presupuestos</h3>
            <button class="btn btn-primary pull-right">Nuevo</button>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-responsive table-striped table-bordered table-hover table-checkable datatable">
                        <thead>
                            <tr>
                                <th>Presupuesto</th>
                                <th>Descripción</th>
                                <th>Total</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="box-footer"></div>
    </div>
    <script>
        $(function () {
            $('.table').DataTable({
                pagingType: "full_numbers",
                paging: false,
                lengthChange: true,
                searching: true,
                ordering: true,
                autoWidth: false,
                retrieve: true,
                responsive: true
            });
        });
    </script>
@stop