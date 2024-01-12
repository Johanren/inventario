<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "medidaAgregado") {
        print '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
          Medida agregado
        </div>
      </div>';
    }
    if ($_GET['action'] == "clienteActualizado") {
        print '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
          Cliente agregado
        </div>
      </div>';
    }
}
$conn = new ControladorMedida();
$con = $conn->contarDatosMedidaControlador();
$limtPagina = 10;
$pagina = $con[0]['COUNT(id_medida)'] / $limtPagina;
$pagina = ceil($pagina);
if (isset($_GET['pagina'])) {
    if (!$_GET['pagina']) {
        echo '<script>window.location="index.php?action=medida&pagina=1"</script>';
    }
    if ($_GET['pagina'] > $pagina || $_GET['pagina'] <= 0) {
        echo '<script>window.location="index.php?action=medida&pagina=1"</script>';
    }
}
$lis = new ControladorMedida();
if (isset($_GET['pagina'])) {
    $res = $lis->listarMedidaControlador($_GET['pagina'], $limtPagina);
}
if ($_SESSION['rol'] != "Administrado") {
    echo '<script>window.location="inicio"</script>';
}
?>
<h1 style="text-align: center;">Medida</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <a href="agregarMedida" class="btn btn-primary">Agregar</a>
        </div>
    </div>
</div>
<table class="table mt-4">
    <thead>
        <tr>
            <th>#</th>
            <th>Medida</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_GET['pagina'])) {
            foreach ($res as $key => $value) {
                ?>
                <tr>
                    <td>
                        <?php echo $value['id_medida'] ?>
                    </td>
                    <td>
                        <?php echo $value['medida'] ?>
                    </td>
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
                            href="index.php?action=medida&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
                    <?php for ($i = 0; $i < $pagina; $i++): ?>
                        <li class="page-item <?php if ($_GET['pagina'] == $i + 1) {
                            print 'active';
                        } ?>"><a class="page-link" href="index.php?action=medida&pagina=<?php echo $i + 1 ?>">
                                <?php echo $i + 1 ?>
                            </a></li>
                    <?php endfor ?>
                    <li class="page-item <?php echo $_GET['pagina'] >= $pagina ? 'disabled' : '' ?>"><a class="page-link"
                            href="index.php?action=medida&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
                </ul>
            </nav>
        </div>
    </div>
<?php } ?>