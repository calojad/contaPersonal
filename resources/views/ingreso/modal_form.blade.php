<div class="modal fade" id="modalFormIngreso" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #3c8dbc; color: white;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span class="fa fa-times" aria-hidden="true"></span></button>
				<h4 class="modal-title"><i class="fa fa-money"></i> Nuevo ingeso</h4>
			</div>
			{!! Form::open(['url'=>'/transaccion/ingreso/create','method'=>'post']) !!}
			<div class="modal-body">
				<input id="cuenta_id_ingreso" type="hidden" name="cuenta_id">
                <input type="hidden" name="tipo_transac_id" value="1">
				<div class="form-group">
					<label for="nombre">Categoria: </label>
					{{ Form::select('categoria_transac_id',$categoriasIngreso,null,['class'=>'form-control','required'=>true]) }}
				</div>
				<div class="form-group">
					<label for="nombre">Descripcion: </label>
					<input class="form-control" id="nombre_ingreso" name="descripcion" type="text" placeholder="Sueldo fin de mes">
				</div>
				<div class="form-group">
					<label for="valor">Valor: </label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
						<input class="form-control" type="text" name="valor" id="valor_ingreso" placeholder="375.00" required>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary"><b>Guardar</b></button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>