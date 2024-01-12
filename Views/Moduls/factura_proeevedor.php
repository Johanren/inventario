<?php
$conn = new ControladorFacturaProeevedor();
$con = $conn->contarDatosFacturaProeevedorControlador();
$limtPagina = 10;
$pagina = $con[0]['COUNT(DISTINCT(fecha_ingreso))'] / $limtPagina;
$pagina = ceil($pagina);
if (isset($_GET['pagina'])) {
    if (!$_GET['pagina']) {
        echo '<script>window.location="index.php?action=factura_proeevedor&pagina=1"</script>';
    }
    if ($_GET['pagina'] > $pagina || $_GET['pagina'] <= 0) {
        echo '<script>window.location="index.php?action=factura_proeevedor&pagina=1"</script>';
    }
}
$lis = new ControladorFacturaProeevedor();
if (isset($_GET['pagina'])) {
    $res = $lis->listarFacturaProeevedoControlador($_GET['pagina'], $limtPagina);
}
?>
<h1 style="text-align: center;">Factura Proeevedor</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <a href="agregarArticulo" class="btn btn-primary">Agregar</a>
            <form method="post" class="mt-3">
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="buscar">
                    </div>
                    <div class="col">
                        <button type="hidden" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<table class="table mt-4">
    <thead>
        <tr>
            <th>#</th>
            <th>Proeevedor</th>
            <th>Fecha Factura</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_GET['pagina'])) {
            foreach ($res as $key => $value) {
                ?>
                <tr>
                    <td>
                        <?php echo $key + 1 ?>
                    </td>
                    <td>
                        <?php echo $value['nombre_proeevedor'] ?>
                    </td>
                    <td>
                        <?php echo $value['fecha_ingreso'] ?>
                    </td>
                    <td><a href="index.php?action=mostrarFactura&id_proeevedor=<?php echo $value['id_proeevedor'] ?>&fecha=<?php echo $value['fecha_ingreso'] ?>"
                            class="btn btn-primary"><img src="Views/img/editar.png" alt="" width="20"></a></td>
                    <td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<?php if (!isset($_POST['buscar'])) { ?>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link"
                            href="index.php?action=factura_proeevedor&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a>
                    </li>
                    <?php for ($i = 0; $i < $pagina; $i++): ?>
                        <li class="page-item <?php if ($_GET['pagina'] == $i + 1) {
                            print 'active';
                        } ?>"><a class="page-link"
                                href="index.php?action=factura_proeevedor&pagina=<?php echo $i + 1 ?>">
                                <?php echo $i + 1 ?>
                            </a></li>
                    <?php endfor ?>
                    <li class="page-item <?php echo $_GET['pagina'] >= $pagina ? 'disabled' : '' ?>"><a class="page-link"
                            href="index.php?action=factura_proeevedor&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
<?php } ?>