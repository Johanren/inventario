<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "disenoAgregado") {
        print '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
          Diseño agregado
        </div>
      </div>';
    }
    if ($_GET['action'] == "disenoActualizado") {
        print '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
          Diseño actualizado
        </div>
      </div>';
    }
}
$conn = new ControladorDiseno();
$con = $conn->contarDatosDisenoControlador();
$limtPagina = 10;
$pagina = $con[0]['COUNT(id_diseno)'] / $limtPagina;
$pagina = ceil($pagina);
if (isset($_GET['pagina'])) {
    if (!$_GET['pagina']) {
        echo '<script>window.location="index.php?action=diseñoSistema&pagina=1"</script>';
    }
    if ($_GET['pagina'] > $pagina || $_GET['pagina'] <= 0) {
        echo '<script>window.location="index.php?action=diseñoSistema&pagina=1"</script>';
    }
}
$lis = new ControladorDiseno();
if (isset($_GET['pagina'])) {
    $res = $lis->listarDisenoControlador($_GET['pagina'], $limtPagina);
}
if ($_SESSION['rol'] != "Administrado") {
    echo '<script>window.location="inicio"</script>';
}
?>
<h1 style="text-align: center;">Diseño sistema</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <a href="agregarDiseno" class="btn btn-primary">Agregar</a>
        </div>
    </div>
</div>
<table class="table mt-4">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre sistema</th>
            <th>Icono</th>
            <th>Activo</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_GET['pagina'])) {
            foreach ($res as $key => $value) {
                ?>
                <tr>
                    <td>
                        <?php echo $value['id_diseno'] ?>
                    </td>
                    <td>
                        <?php echo $value['nom_sistema'] ?>
                    </td>
                    <td>
                        <img src="<?php echo $value['icon_sistema'] ?>" alt="h" width="100">
                    </td>
                    <td>
                        <?php echo $value['nombre_activo'] ?>
                    </td>
                    <td><a href="index.php?action=editarDiseno&id_diseno=<?php echo $value['id_diseno'] ?>"
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
                            href="index.php?action=diseñoSistema&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
                    <?php for ($i = 0; $i < $pagina; $i++): ?>
                        <li class="page-item <?php if ($_GET['pagina'] == $i + 1) {
                            print 'active';
                        } ?>"><a class="page-link" href="index.php?action=diseñoSistema&pagina=<?php echo $i + 1 ?>">
                                <?php echo $i + 1 ?>
                            </a></li>
                    <?php endfor ?>
                    <li class="page-item <?php echo $_GET['pagina'] >= $pagina ? 'disabled' : '' ?>"><a class="page-link"
                            href="index.php?action=diseñoSistema&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
<?php } ?>