{{--
**  DENTRO DE UN FORM
**  Por cada cuenta se crea un panel
**  con la informacion de la cuenta
--}}
<div class="box box-solid box-principal">
    {{--NOMBRE DE LA CUENTA--}}
    <div class="box-header">
        <div class="row">
            <div class="col-md-9">
                <span class="box-title">{{$cuenta->nombre .' - Ultimos Movimientos' }}</span>
            </div>
            <div class="pull-right col-md-3">
                <div class="col-md-8">
                    <span class="text-bold" style="font-size: large">{{\Carbon\Carbon::now()->formatLocalized('%A %d de %b %Y')}}</span>
                </div>
                <div class="col-md-4">
                    <span class="spaReloj text-bold" style="font-size: large"></span>
                </div>
            </div>
        </div>
    </div>
    {{--CAJAS DE INGRESOS Y GASTOS DE LA CUENTA--}}
    <div class="box-body" style="background: #ecf0f5">
        {{-- FILTRO POR FECHAS --}}
        <div class="col-md-12">
            <div class="box box-sombra" style="border-top: none">
                <div class="box-body">
                    <div class="col-md-2">
                        <a class="btn btn-warning btnTransferirEntreCuentas" title="Transferir"  style="margin-left:15px" data-toggle="modal" data-target="#modalTransferencia" data-id="{{$cuenta->id}}" data-nombre="{{$cuenta->nombre}}">Transferir <i class="fa fa-exchange"></i></a>
                    </div>
                    <div class="col-md-10 form-group col-md-pull-1" align="center">
                        <button class="btn btn-default active btnMesActual" data-id="{{$cuenta->id}}">Mes Actual</button>
                        <button class="btn btn-default btnMesAnterior" data-id="{{$cuenta->id}}">Mes Anterior</button>
                        <button class="btn btn-default btnDateCustom" data-id="{{$cuenta->id}}">Fecha Personalizada</button>
                    </div>
                    <div class="form-group divDesdeHasta" style="display: none;">
                        <div class="col-md-4 col-md-offset-1">
                            <label class="col-md-3 control-label">Desde:</label>
                            <div class="col-md-9">
                                <input id="inpDate1_{{$cuenta->id}}" class="form-control" type="date" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-3 control-label">Hasta:</label>
                            <div class="col-md-9">
                                <input id="inpDate2_{{$cuenta->id}}" class="form-control" type="date" required>
                            </div>
                        </div>
                        <div class="col-md-2" align="right">
                            <button class="btn btn-primary btnSearchDateCustom" title="Buscar" data-id="{{$cuenta->id}}"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
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