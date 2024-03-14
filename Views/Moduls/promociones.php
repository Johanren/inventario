<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "okPromocion") {
        print '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
          Promocion agregado
        </div>
      </div>';
    }
    if ($_GET['action'] == "okPromocionActu") {
        print '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
          Promocion actualizada
        </div>
      </div>';
    }
}
$conn = new ControladorPromocion();
$con = $conn->contarDatosPromocionControlador();
$limtPagina = 10;
$pagina = $con[0]['COUNT(codigo_promocion)'] / $limtPagina;
$pagina = ceil($pagina);
if (isset($_GET['pagina'])) {
    if (!$_GET['pagina']) {
        echo '<script>window.location="index.php?action=promociones&pagina=1"</script>';
    }
    if ($_GET['pagina'] > $pagina || $_GET['pagina'] <= 0) {
        echo '<script>window.location="index.php?action=promociones&pagina=1"</script>';
    }
}
$lis = new ControladorPromocion();
if (isset($_GET['pagina'])) {
    $res = $lis->listarPromocionControlador($_GET['pagina'], $limtPagina);
}
?>
<h1 style="text-align: center;">Promociones</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <a href="agregarPromocion" class="btn btn-primary">Agregar</a>
            <form method="post" class="mt-3">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" name="buscar" placeholder="Promocion">
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
            <th>#</th>
            <th>Codigo</th>
            <th>Nombre Promocion</th>
            <th>Articulo con la Promocion</th>
            <th>Estado</th>
            <th>Acciones</th>
            <th></th>
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
                        <?php echo $value['codigo_promocion'] ?>
                    </td>
                    <td>
                        <?php echo $value['nombre_promocion'] ?>
                    </td>
                    <td>
                        <?php
                        $consular = new ControladorPromocion();
                        $resCon = $consular->lstarArticuloPromocion($value['codigo_promocion']);
                        foreach ($resCon as $key => $valu) {
                            $conn = $key + 1;
                            print $conn . ". " . $valu['nombre_producto'] . "<br>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php echo $value['nombre_activo'] ?>
                    </td>
                    <td><a href="index.php?action=editarPromocion&codigo_promocion=<?php echo $value['codigo_promocion'] ?>"
                            class="btn btn-primary"><img src="Views/img/editar.png" alt="" width="20"></a></td>
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
                            href="index.php?action=promociones&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
                    <?php for ($i = 0; $i < $pagina; $i++): ?>
                        <li class="page-item <?php if ($_GET['pagina'] == $i + 1) {
                            print 'active';
                        } ?>"><a class="page-link" href="index.php?action=promociones&pagina=<?php echo $i + 1 ?>">
                                <?php echo $i + 1 ?>
                            </a></li>
                    <?php endfor ?>
                    <li class="page-item <?php echo $_GET['pagina'] >= $pagina ? 'disabled' : '' ?>"><a class="page-link"
                            href="index.php?action=promociones&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
                </ul>
            </nav>
        </div>
    </div>
<?php } ?>