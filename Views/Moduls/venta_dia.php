<?php
$cantidad = new ControladorVenta();
$res = $cantidad->consultarVentaDia();
$total = $cantidad->ventaTotalDia();
?>
<h1 style="text-align: center;">Venta del dia</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="post" class="mt-3">
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="buscar">
                    </div>
                    <div class="col">
                        <button type="hidden" name="consultar" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<table class="table mt-4">
    <thead>
        <tr>
            <th>Productos Vendidos</th>
            <th>Valor unitario</th>
            <th>Peso</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($res as $key => $value) {
            $res_cantidad_total = $cantidad->consultarVentaDiaCantidadTotal($value['id_producto']);
            foreach ($res_cantidad_total as $key => $valueCantidad) {
                ?>
                <tr>
                    <td>
                        <?php echo $value['nombre_producto'] ?>
                    </td>
                    <td>
                        <?php echo $value['valor_unitario'] ?>
                    </th>
                    <td>
                        <?php echo $valueCantidad['SUM(peso)'] ?>
                    </td>
                    <td>
                        <?php echo $valueCantidad['SUM(cantidad)'] ?>
                    </td>
                    <td>
                        <?php echo $valueCantidad['SUM(precio_compra)'] ?>
                    </td>
                    <td>
                        <?php echo $value['fecha_ingreso'] ?>
                    </td>
                    <td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
    <tbody>
        <tr>
            <th>Total</th>
            <th></th>
            <th></th>
            <th></th>
            <th>
                <?php echo $total[0]['SUM(precio_compra)'] ?>
            </th>
        </tr>
    </tbody>
</table>