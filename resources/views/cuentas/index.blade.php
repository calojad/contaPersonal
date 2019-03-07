{{--
**  DENTRO DE UN FORM
**  Por cada cuenta se crea un panel
**  con la informacion de la cuenta
--}}
<div class="box box-solid box-principal">
    {{--NOMBRE DE LA CUENTA--}}
    <div class="box-header">
        <span class="box-title">{{Auth::user()->name.' - '.$cuenta->nombre}}</span>
        <a class="btn btn-default" title="Transferir" style="margin-left:15px"><i class="fa fa-exchange"></i></a>
    </div>
    {{--CAJAS DE INGRESOS Y GASTOS DE LA CUENTA--}}
    <div class="box-body" style="background: #ecf0f5">
        {{-- FILTRO POR FECHAS --}}
        <div class="col-md-12">
            <div class="box box-sombra" style="border-top: none">
                <div class="box-body">
                    <div class="col-md-12 form-group" align="center">
                        <button class="btn btn-default">Mes Actual</button>
                        <button class="btn btn-default">Mes Anterior</button>
                        <button id="btnDateCustom" class="btn btn-default">Fecha Personalizada</button>
                    </div>
                    {{ Form::open(['route' => 'home', 'method' => 'post', 'class' => 'form-horizontal']) }}
                    <div class="form-group" style="display: none;">
                        <div class="col-md-4 col-md-offset-1">
                            <label class="col-md-3 control-label" for="inpDate1">Desde:</label>
                            <div class="col-md-9">
                                <input id="inpDate1" class="form-control" type="date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-3 control-label" for="inpDate2">Hasta:</label>
                            <div class="col-md-9">
                                <input id="inpDate2" class="form-control" type="date">
                            </div>
                        </div>
                        <div class="col-md-2" align="right">
                            <button class="btn btn-primary" title="Buscar"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        {{--INGRESOS--}}
        <div class="col-md-6">
            <div class="box box-primary box-sombra" align="center">
                <div class="box-header">
                    <span class="box-title"><i class="fa fa-money"></i> Ingresos</span>
                    <a class="btn btn-social-icon btn-primary pull-right btnFormIngreso" data-toggle="modal" data-target="#modalFormIngreso" cuentaId="{{$cuenta->id}}"><i class="fa fa-plus"></i></a>
                </div>
                <div class="box-body">
                    @include('ingreso.tabla')
                </div>
                <div class="box-footer">
                    <p style="font-weight: bold;font-size: 14pt">Total Ingresos: <span id="totalIng_{{ $cuenta->id }}" class="text-info"></span></p>
                </div>
            </div>
        </div>
        {{--GASTOS--}}
        <div class="col-md-6">
            <div class="box box-danger box-sombra" align="center">
                <div class="box-header">
                    <span class="box-title"><i class="fa fa-dollar"></i> Gastos</span>
                    <a class="btn btn-social-icon btn-danger pull-right btnFormGastos" data-toggle="modal" data-target="#modalFormGasto" cuentaId="{{$cuenta->id}}"><i class="fa fa-plus"></i></a>
                </div>
                <div class="box-body">
                    @include('gasto.tabla')
                </div>
                <div class="box-footer">
                    <p style="font-weight: bold;font-size: 14pt">Total Gastos: <span id="totalGas_{{ $cuenta->id }}" class="text-danger"></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <p style="font-weight: bold;font-size: 14pt">SALDO TOTAL: <span id="total_{{ $cuenta->id }}" class="text-success"></span></p>
    </div>
    <div class="overlay">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</div>