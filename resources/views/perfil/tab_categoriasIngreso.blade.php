<div class="table-responsive">
    <table class="table table-responsive table-striped table-bordered table-hover table-checkable datatable" id="tblCuentasUser">
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categoriasIngreso as $catIngreso)
                <tr>
                    <td>{{ $catIngreso->nombre }}</td>
                    <td>
                        @if ($catIngreso->usuario_id == Auth::user()->id)
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>