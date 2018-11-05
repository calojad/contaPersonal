<div class="modal fade" id="modalFormCuenta" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #06a388; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-briefcase"></i> Nueva cuenta</h4>
            </div>
            {!! Form::open(['action' => 'CuentaController@crear']) !!}
            <div class="modal-body">
                @include('cuentas.form')
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary pull-right" type="submit">Guardar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>