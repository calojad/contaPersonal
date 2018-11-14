<div class="table-responsive">
    <table class="table table-responsive table-striped table-bordered table-hover table-checkable datatable" id="tblCuentasUser">
        <thead>
            <tr>
                <th>Cuenta</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cuentas as $cuenta)
                <tr>
                    <td>{{ $cuenta->nombre }}</td>
                    <td>{{ $cuenta->saldo==null?'0.00':$cuenta->saldo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>