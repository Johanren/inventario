<?php
$listarDiseno = new ControladorDiseno();
$diseno = $listarDiseno->listarDisenoTemplete();
//
$agregarFactura = new ModeloFactura();
$resUltimoId = $agregarFactura->mostrarUltimoId();
$id_factura = $_GET['id_factura'];
//
$mostrarVenta = new ControladorVenta();
$resVenta = $mostrarVenta->mostrarFacturaVenta($id_factura);
//
$mostrarVenta = new ModeloFactura();
$resFactura = $mostrarVenta->mostrarFacturaVentaModelo($id_factura);
$id_cliente = $resFactura[0]['id_cliente'];
//
$mostrarCliente = new ModeloCliente();
$resCliente = $mostrarCliente->mostrarClienteFacturaVentaModelo($id_cliente);

date_default_timezone_set('America/Mexico_City');
$fechaActal = date('Y-m-d');
?>
<h1 style="text-align: center;">Factura deudora</h1>
<form method="post">
    <div class="container">
        <div class="row">
            <div class="col">
                <div style="text-align: right;">
                    <p>FACTURA N°<span id="nom_proeevedor">
                            <?php echo $resFactura[0]['id_factura'] ?>
                        </span></p>
                </div>
                <div style="text-align: right;">
                    Fecha:
                    <?php
                    echo $resFactura[0]['fecha_factura']
                        ?>
                </div>
                <div class="mt-3" style="text-align: center;">
                    Sistema: <span id="nom_proeevedor">
                        <?php if ($diseno != null) {
                            echo $diseno[0]['nom_sistema'];
                        } else {
                            echo "Inventario";
                        } ?>
                    </span><br>
                    Nit: <span id="nit_proeevedor">
                        <?php if ($diseno != null) {
                            echo $diseno[0]['nit'];
                        } else {
                            echo "1111";
                        } ?>
                    </span><br>
                    Telefono: <span id="tel_proeevedor">
                        <?php if ($diseno != null) {
                            echo $diseno[0]['telefono'];
                        } else {
                            echo "11111";
                        } ?>
                    </span><br>
                    Dirección: <span id="dir_proeevedor">
                        <?php if ($diseno != null) {
                            echo $diseno[0]['direccion'];
                        } else {
                            echo "NNNNN";
                        } ?>
                    </span>
                </div>
            </div>
        </div>
        <table class="table mt-5">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="factura">
                <?php
                foreach ($resVenta as $key => $value) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $value['codigo_producto'] ?>
                        </td>
                        <td>
                            <?php echo $value['nombre_producto'] ?>
                        </td>
                        <td>
                            <?php echo $value['valor_unitario'] ?>
                        </td>
                        <td>
                            <?php if ($value['cantidad'] > 0) {
                                echo $value['cantidad'];
                            } else {
                                echo $value['peso'] . " GR";
                            } ?>
                        </td>
                        <td>
                            <?php echo $value['precio_compra'] ?>
                        </td>
                    </tr>
                    <?php
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
                        <?php echo $resFactura[0]['total_factura']; ?>
                    </th>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th>Pago</th>
                    <th>
                        <?php echo $resFactura[0]['efectivo'] ?><input type="hidden" id="" name="efectivo"
                            class="form-control" value="<?php echo $resFactura[0]['efectivo'] ?>">
                    </th>
                    <th></th>
                    <th>Debe</th>
                    <th>
                        <input type="text" id="deuda" name="" class="form-control" disabled
                            value="<?php echo $resFactura[0]['cambio'] ?>">
                        <input type="hidden" id="" name="debe" class="form-control"
                            value="<?php echo $resFactura[0]['cambio'] ?>">
                    </th>
                </tr>
            </tbody>
            <tbody>

                <tr>
                    <th>Abono deuda</th>
                    <th>
                        <input type="text" name="abono" id="abono" class="form-control" required>
                    </th>
                    <th></th>
                    <th>Total a deber</th>
                    <th>
                        <input type="text" id="Total" class="form-control" disabled>
                    </th>
                </tr>

            </tbody>
        </table>
        <div style="text-align: right;">
            <button name="guardar" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                    height="30" fill="currentColor" class="bi bi-floppy-fill" viewBox="0 0 16 16">
                    <path
                        d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z" />
                    <path
                        d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z" />
                </svg></button>
        </div>
    </div>
</form>
<?php
$cosultarDeuda = new ControladorFactura();
$cosultarDeuda->actualizarDeudaFactura();
?>