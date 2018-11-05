{{--
**  DENTRO DE UN FORM
**  Por cada cuenta se crea un panel
**  con la informacion de la cuenta
--}}
<div class="panel panel-primary">
    {{--NOMBRE DE LA CUENTA--}}
    <div class="panel-heading">
        <span class="panel-title">{{Auth::user()->name.' - '.$cuenta->nombre}}</span>
    </div>
    {{--CAJAS DE INGRESOS Y GASTOS DE LA CUENTA--}}
    <div class="panel-body" style="background: #ecf0f5">
        {{--INGRESOS--}}
        <div class="box box-primary col-md-5 col-offset-0 box-sombra" align="center">
            <div class="box-header">
                <span class="box-title"><i class="fa fa-money"></i> Ingresos</span>
                <a class="btn btn-social-icon btn-primary pull-right btnFormIngreso" data-toggle="modal" data-target="#modalFormIngreso" cuentaId="{{$cuenta->id}}"><i class="fa fa-plus"></i></a>
            </div>
            <div class="box-body">
                @include('ingreso.tabla')
            </div>
        </div>
        {{--GASTOS--}}
        <div class="box box-danger col-md-5 col-offset-0 box-sombra" align="center">
            <div class="box-header">
                <span class="box-title"><i class="fa fa-dollar"></i> Gastos</span>
                <a class="btn btn-social-icon btn-danger pull-right" data-toggle="modal" data-target="#modalFormGasto" cuentaId="{{$cuenta->id}}"><i class="fa fa-plus"></i></a>
            </div>
            <div class="box-body">
                @include('gasto.tabla')
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <b>Saldo Total =</b>
    </div>
</div>