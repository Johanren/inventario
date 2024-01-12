<?php
$mostrar = new ControladorFacturaProeevedor();
$res = $mostrar->mostrarFacturaProeevedor();

$msotrarProeevedor = new ControladorProeevedor();
$resProe = $msotrarProeevedor->listarProeevedorEditar();
?>
<h1 style="text-align: center;">Factura Proeevedor</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="mt-3" style="text-align: center;">
                Proeevedor: <span id="nom_proeevedor">
                        <?php echo $resProe[0]['nombre_proeevedor'] ?>
                    </span><br>
                Nit: <span id="nit_proeevedor">
                        <?php echo $resProe[0]['nit_proeevedor'] ?>
                    </span><br>
                Telefono: <span id="tel_proeevedor">
                        <?php echo $resProe[0]['telefono_proeevedor'] ?>
                    </span><br>
                Dirección: <span id="dir_proeevedor">
                        <?php echo $resProe[0]['direccion_proeevedor'] ?>
                    </span>
            </div>
        </div>
    </div>
</div>
<div class="table-responsive mt-5">
    <table class="table">
        <thead>
            <tr>
                <th>Codigo Producto</th>
                <th>Nombre Producto</th>
                <th>Categoria</th>
                <th>Medida</th>
                <th>Valor</th>
                <th>Cantidad</th>
                <th>Usuario</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody id="articulo">
            <?php
            foreach ($res as $key => $value) {
                ?>
                <tr>
                    <td><input type="hidden" name="id_articulo[]" id="id_articulo_1"><input type="text" name="codigo[]"
                            class="form-control codigo" value="<?php echo $value['codigo_producto'] ?>" id="codigo_1"
                            required disabled></td>
                    <td><input type="text" name="nombre[]" class="form-control" id="nombre_1"
                            value="<?php echo $value['nombre_producto'] ?>" disabled required></td>
                    <td><input type="hidden" name="id_categoria[]" class="id_categoria" id="id_categoria_1"><input
                            type="text" name="categoria[]" class="form-control categoria" id="categoria_1"
                            value="<?php echo $value['categoria'] ?>" disabled required>
                    </td>
                    <td><input type="hidden" name="id_medida[]" class="id_medida" id="id_medida_1"><input type="text"
                            name="medida[]" class="form-control medida" id="medida_1" value="<?php echo $value['medida'] ?>"
                            disabled required></td>
                    <td><input type="text" name="valor[]" class="form-control" id="valor_1"
                            value="<?php echo $value['precio_unitario'] ?>" disabled required></td>
                    <td><input type="hidden" name="cantidad_articulo[]" class="form-control" id="cantidad_1"><input
                            type="text" name="cantidad[]" class="form-control"
                            value="<?php echo $value['cantidad_producto'] ?>" disabled required></td>
                    <td><input type="hidden" name="cantidad_articulo[]" class="form-control" id="cantidad_1"><input
                            type="text" name="cantidad[]" class="form-control"
                            value="<?php echo $value['usuario'] ?>" disabled required></td>
                    <td><input type="hidden" name="cantidad_articulo[]" class="form-control" id="cantidad_1"><input
                            type="text" name="cantidad[]" class="form-control" value="<?php echo $value['fecha_ingreso'] ?>"
                            disabled required></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>