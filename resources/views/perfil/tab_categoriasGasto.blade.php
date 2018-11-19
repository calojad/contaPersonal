<div>
    <a class="btn btn-primary" title="Nueva Categoria Ingreso" data-toggle="modal" data-target="#modalFormCategorias"><i class="fa fa-plus"></i> Nueva</a>
</div>
<div class="table-responsive">
    <table class="table table-responsive table-striped table-bordered table-hover table-checkable datatable">
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categoriasGasto as $catGasto)
                <tr>
                    <td>
                        <span id="catga_span_{{ $catGasto->id }}">{{ $catGasto->nombre }}</span>
                        <input id="catga_{{ $catGasto->id }}" class="form-control" type="text" name="nombre" value="{{ $catGasto->nombre }}" style="display: none">
                    </td>
                    <td>
                        <div id="btngrpCatGa_{{ $catGasto->id }}" class="btn-groupn acciones">
                            <button type="button" class="btn btn-primary btnEditarCateGa" categId="{{ $catGasto->id }}"><i class="fa fa-edit"></i></button>
                            @if ($catGasto->usuario_id == Auth::user()->id)
                            <button type="button" class="btn btn-danger btnDeleted" elemId="{{ $catGasto->id }}" band="CA"><i class="fa fa-trash"></i></button>
                            @endif
                        </div>
                        <div id="btngrpEditCatGa_{{ $catGasto->id }}" class="btn-group" style="display: none;">
                            <button type="button" class="btn btn-primary btnSaveEdit" categId="{{ $catGasto->id }}"><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger btnCancelEdit" categId="{{ $catGasto->id }}"><i class="fa fa-close"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $('.btnEditarCateGa').on('click',function(){
        var id = $(this).attr('categId');
        obtElementosEditGasto(id,'S');
    });

    $('.btnCancelEdit').on('click',function(){
        var id = $(this).attr('categId');
        obtElementosEditGasto(id,'H');
    });

    function obtElementosEditGasto(id,band){
        var inputEdt = $('#catga_'+id);
        var botonsEdt = $('#btngrpEditCatGa_'+id);
        var botons = $('#btngrpCatGa_'+id);
        var span = $('#catga_span_'+id);
        if(band === 'S'){
            showEdit(inputEdt, botonsEdt, botons, span);
        }else{
            hideEdit(inputEdt, botonsEdt, botons, span);
        }
    }
</script>