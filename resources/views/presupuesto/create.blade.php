@extends('layouts.app')
@section('header')
    <h1>
        {{config('app.name','EVAL')}}
        <small>Presupuesto</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/presupuesto')}}"><i class="fa fa-home"></i> Presupuesto</a></li>
        <li>Nuevo</li>
    </ol>
@stop
@section('content')
    @include('includes.notificacion')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Nuevo Presupuestos</h3>
        </div>
        <div class="box-body">

        </div>
        <div class="box-footer"></div>
    </div>
@stop