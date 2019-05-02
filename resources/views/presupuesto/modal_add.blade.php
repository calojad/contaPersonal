{!! Form::open(['url'=>'/presupuesto/store','method'=>'post']) !!}
<div class="modal fade" id="modalAddPresupuesto" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #06a388; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times" aria-hidden="true"></span></button>
                <h4 class="modal-title">Agregar Gasto Presupuestario</h4>
            </div>

            <div class="modal-body">
                <div class="content">
                    <input id="usuario_id" type="hidden" name="usuario_id" value="{{Auth::user()->id}}">

                    {{-- Field Categoria --}}
                    <div class="form-group">
                        <label for="nombre">Categoria: </label>
                        {{ Form::select('categoria_transac_id',$categoriaTransac,null,['class'=>'form-control','required'=>true]) }}
                    </div>

                    {{-- Field Valor --}}
                    <div class="form-group">
                        <label for="valor">Valor: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input class="form-control" type="number" name="valor" id="valor_ingreso"
                                   placeholder="375.00" required step="any">
                        </div>
                    </div>

                    {{-- Field Descripcion --}}
                    <div class="form-group">
                        <label for="nombre">Descripcion: </label>
                        <input class="form-control" id="nombre_ingreso" name="descripcion" type="text">
                    </div>
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