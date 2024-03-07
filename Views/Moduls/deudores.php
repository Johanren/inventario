<?php
$cosultarDeuda = new ControladorFactura();
$resConsul = $cosultarDeuda->listarDeudoresFactura();
?>
<h1 style="text-align: center;">Deudores</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="post" class="mt-3">
                <div class="row">
                    <div class="col">
                        <input type="number" class="form-control" name="buscar" placeholder="Numero de documento">
                    </div>
                    <div class="col">
                        <button type="hidden" name="consultar" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<table class="table mt-5">
    <thead>
        <tr>
            <th>Número factura</th>
            <th>Deudor</th>
            <th>Número Documento</th>
            <th>Deuda</th>
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resConsul as $key => $value) {
            if ($value['cambio'] < 0) {
                ?>
                <tr>
                    <td>
                        <?php echo $value['id_factura'] ?>
                    </td>
                    <td>
                        <?php echo $value['nombre'] . $value['apellido'] ?>
                    </td>
                    <td>
                        <?php echo $value['numero_cedula'] ?>
                    </td>
                    <td>
                        <?php echo $value['cambio'] ?>
                    </td>
                    <td>
                        <?php echo $value['usuario'] ?>
                    </td>
                    <td>
                        <?php echo $value['fecha_factura'] ?>
                    </td>
                    <td><a href="index.php?action=editarDeudorFactura&id_factura=<?php echo $value['id_factura'] ?>"
                            class="btn btn-primary"><img src="Views/img/editar.png" alt="" width="20"></a></td>
                </tr>
            <?php }
        } ?>
    </tbody>
</table>