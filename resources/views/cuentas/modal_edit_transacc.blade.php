{!! Form::open(['url'=>'/transaccion/update','method'=>'post']) !!}
<div class="modal fade" id="modalEditTransac" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #06a388; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times" aria-hidden="true"></span></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Editar</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="inpHiddenIdTransac">
                <input type="hidden" name="categoriasIngreso" value="{{$categoriasIngreso}}">
                <input type="hidden" name="categoriasGasto" value="{{$categoriasGasto}}">
                <input type="hidden" name="cuenta_id" id="inpCuentaIdEditTransac">
                <input type="hidden" name="tipo_transac_id" id="inpTipoIdEditTransac">

                {{-- Field Categoria --}}
                <div class="form-group">
                    <label for="nombre">Categoria: </label>
                    <select name="categoria_transac_id" id="selCategoriaTransacEdit" class="form-control" required></select>
                </div>
                {{-- Field Valor --}}
                <div class="form-group">
                    <label for="valorTransacEdit">Valor: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                        <input id="valorTransacEdit" class="form-control" type="number" name="valor" placeholder="375.00" required step="any">
                    </div>
                </div>
                {{-- Field Fecha --}}
                <div class="form-group">
                    <label for="fechaTransacEdit">Fecha: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input id="fechaTransacEdit" class="form-control" type="date" name="fecha" required>
                    </div>
                </div>
                {{-- Field Descripcion --}}
                <div class="form-group">
                    <label for="descripTransacEdit">Descripcion: </label>
                    <input id="descripTransacEdit" class="form-control" name="descripcion" type="text" placeholder="Sueldo fin de mes">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><b>Guardar</b></button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}