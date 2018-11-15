<div class="table-responsive">
    <table class="table table-responsive table-striped table-bordered table-hover table-checkable datatable">
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categoriasIngreso as $catIngreso)
                <tr>
                    <td>
                        <span id="catin_span_{{ $catIngreso->id }}">{{ $catIngreso->nombre }}</span>
                        <input id="catin_{{ $catIngreso->id }}" class="form-control" type="text" name="nombre" value="{{ $catIngreso->nombre }}" style="display: none">
                    </td>
                    <td>
                        <div id="btngrpCatIn_{{ $catIngreso->id }}" class="btn-group acciones">
                            <button type="button" class="btn btn-primary btnEditarCateIn" categId="{{ $catIngreso->id }}"><i class="fa fa-edit"></i></button>
                            @if ($catIngreso->usuario_id == Auth::user()->id)
                            <button type="button" class="btn btn-danger btnDeleted" elemId="{{ $catIngreso->id }}" band="IN"><i class="fa fa-trash"></i></button>
                            @endif
                        </div>
                        <div id="btngrpEditCatIn_{{ $catIngreso->id }}" class="btn-group" style="display: none;">
                            <button type="button" class="btn btn-primary btnSaveEdit" categId="{{ $catIngreso->id }}"><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger btnCancelEdit" categId="{{ $catIngreso->id }}"><i class="fa fa-close"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $('.btnEditarCateIn').on('click',function(){
        var id = $(this).attr('categId');
        obtElementosEditIngreso(id,'S');
    });

    $('.btnCancelEdit').on('click',function(){
        var id = $(this).attr('categId');
        obtElementosEditIngreso(id,'H');
    });

    function obtElementosEditIngreso(id,band){
        var inputEdt = $('#catin_'+id);
        var botonsEdt = $('#btngrpEditCatIn_'+id);
        var botons = $('#btngrpCatIn_'+id);
        var span = $('#catin_span_'+id);
        if(band == 'S'){
            showEdit(inputEdt, botonsEdt, botons, span);
        }else{
            hideEdit(inputEdt, botonsEdt, botons, span);
        }
    }
</script>