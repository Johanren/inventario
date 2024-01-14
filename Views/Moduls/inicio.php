<?php
$listarDiseno = new ControladorDiseno();
$diseno = $listarDiseno->listarDisenoTemplete();
?>
<h1 style="text-align: center;">Factura</h1>
<div class="container mt-5">
    <form method="post">
        <div class="row">
            <div class="col">
                <input type="hidden" name="id_cliente" id="id_cliente">
                <input type="text" name="cc" id="cc" placeholder="Ingresar número cc" class="form-control" required>
            </div>
            <div class="col">
                <input type="text" name="cliente" id="cliente" class="form-control" disabled>
            </div>
        </div>
        <div class="row mt-5">
            <div class="row">
                <div class="col">
                    <div style="text-align: right;">
                        Fecha:
                        <?php
                        date_default_timezone_set('America/Mexico_City');
                        print $fechaActal = date('Y-m-d');
                        ?>
                    </div>
                    <div class="mt-3" style="text-align: center;">
                        Sistema: <span id="nom_proeevedor">
                            <?php echo $diseno[0]['nom_sistema'] ?>
                        </span><br>
                        Nit: <span id="nit_proeevedor">
                            <?php echo $diseno[0]['nit'] ?>
                        </span><br>
                        Telefono: <span id="tel_proeevedor">
                            <?php echo $diseno[0]['telefono'] ?>
                        </span><br>
                        Dirección: <span id="dir_proeevedor">
                            <?php echo $diseno[0]['direccion'] ?>
                        </span>
                    </div>
                </div>
            </div>
            <a class="btn btn-primary mt-3" id="agregarFactura">Agregar</a>
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Precio descuento</th>
                        <th>Peso</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="factura">
                    <tr>
                        <td><input type="hidden" name="id_articulo[]" id="id_articulo_1"><input type="text"
                                name="codigo" class="form-control codigo_articulo" id="codigo_1"
                                placeholder="Codigo producto"></td>
                        <td><input type="text" name="articulo" class="form-control nombre_articulo" id="nombre_1" placeholder="Nombre producto"></td>
                        <td><input type="text" name="precio" class="form-control" id="valor_1" disabled></td>
                        <td><input type="text" name="descuento[]" class="form-control" id="descuento_1" value="0"></td>
                        <td><input type="text" name="peso[]" class="form-control peso" id="peso_1" value="0" required>
                        <td><input type="text" name="cantidad[]" class="form-control cantidad" id="cantidad_1" value="0" required>
                        </td>
                        <td><input type="text" name="total" class="form-control resultado" id="resultado_1" disabled>
                        </td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><input type="text" class="form-control factura" name="total_Factura" id="total_1" disabled>
                        </th>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th>Paga</th>
                        <th><input type="text" class="form-control pago" name="pago" id="pago_1" required></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Cambio</th>
                        <th><input type="text" class="form-control" name="cambio" id="cambio_1" disabled></th>
                    </tr>
                </tbody>
            </table>
            <div style="text-align: right;">
                <button name="imprimir" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                        height="30" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                        <path
                            d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1" />
                    </svg></button>
            </div>
        </div>
    </form>
</div>
<?php
$agregar = new ControladorFactura();
$agregar->agregarFactura();
?>