<div class="table-responsive">
    <table class="table table-responsive table-striped table-bordered table-hover table-checkable datatable" id="tblCuentasUser">
        <thead>
            <tr>
                <th>Cuenta</th>
                <th>Saldo</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cuentas as $cuenta)
                <tr>
                    <td>
                        <span id="cue_span_{{ $cuenta->id }}">{{ $cuenta->nombre }}</span>
                        <input id="cue_{{ $cuenta->id }}" class="form-control" type="text" name="nombre" value="{{ $cuenta->nombre }}" style="display:none">
                    </td>
                    <td>{{ $cuenta->saldo==null?'0.00':$cuenta->saldo }}</td>
                    <td>
                        <div id="btngrpCuenta_{{ $cuenta->id }}" class="btn-group acciones">
                            <button type="button" class="btn btn-primary btnEditarCuenta" cuentaId="{{ $cuenta->id }}"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btnDeleted" elemId="{{ $cuenta->id }}" band="CU"><i class="fa fa-trash"></i></button>
                        </div>
                        <div id="btngrpEditCuenta_{{ $cuenta->id }}" class="btn-group" style="display: none;">
                            <button type="button" class="btn btn-primary btnSaveEdit" cuentaId="{{ $cuenta->id }}"><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger btnCancelEdit" cuentaId="{{ $cuenta->id }}"><i class="fa fa-close"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $('.btnEditarCuenta').on('click',function(){
        var id = $(this).attr('cuentaId');
        obtElementosEditCuenta(id,'S');
    });

    $('.btnCancelEdit').on('click',function(){
        var id = $(this).attr('cuentaId');
        obtElementosEditCuenta(id,'H');
    });

    function obtElementosEditCuenta(id,band){
        var inputEdt = $('#cue_'+id);
        var botonsEdt = $('#btngrpEditCuenta_'+id);
        var botons = $('#btngrpCuenta_'+id);
        var span = $('#cue_span_'+id);
        if(band == 'S'){
            showEdit(inputEdt, botonsEdt, botons, span);
        }else{
            hideEdit(inputEdt, botonsEdt, botons, span);
        }
    }
</script>