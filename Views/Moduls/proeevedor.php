<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "proeevedorAgregado") {
        print '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
          Proeevedor agregado
        </div>
      </div>';
    }
    if ($_GET['action'] == "proeevedorActualizado") {
        print '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
          Proeevedor agregado
        </div>
      </div>';
    }
}
$conn = new ControladorProeevedor();
$con = $conn->contarDatosProeevedorControlador();
$limtPagina = 10;
$pagina = $con[0]['COUNT(id_proeevedor)'] / $limtPagina;
$pagina = ceil($pagina);
if (isset($_GET['pagina'])) {
    if (!$_GET['pagina']) {
        echo '<script>window.location="index.php?action=proeevedor&pagina=1"</script>';
    }
    if ($_GET['pagina'] > $pagina || $_GET['pagina'] <= 0) {
        echo '<script>window.location="index.php?action=proeevedor&pagina=1"</script>';
    }
}
$lis = new ControladorProeevedor();
if (isset($_GET['pagina'])) {
    $res = $lis->listarProeevedorControlador($_GET['pagina'], $limtPagina);
}
?>
<h1 style="text-align: center;">Proeevedor</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <a href="agregarProeevedor" class="btn btn-primary">Agregar</a>
            <form method="post" class="mt-3">
                <input type="text" class="form-control" name="buscar" placeholder="Nombre Proeevedor y/o Nit">
            </form>
        </div>
    </div>
</div>
<table class="table mt-4">
    <thead>
        <tr>
            <th>#</th>
            <th>Nit</th>
            <th>Proeevedor</th>
            <th>Telefono</th>
            <th>Dirección</th>
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
                        <?php echo $value['id_proeevedor'] ?>
                    </td>
                    <td>
                        <?php echo $value['nit_proeevedor'] ?>
                    </td>
                    <td>
                        <?php echo $value['nombre_proeevedor'] ?>
                    </td>
                    <td>
                        <?php echo $value['telefono_proeevedor'] ?>
                    </td>
                    <td>
                        <?php echo $value['direccion_proeevedor'] ?>
                    </td>
                    <td><a href="index.php?action=editarProeevedor&id_proeevedor=<?php echo $value['id_proeevedor'] ?>"
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
                            href="index.php?action=proeevedor&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
                    <?php for ($i = 0; $i < $pagina; $i++): ?>
                        <li class="page-item <?php if ($_GET['pagina'] == $i + 1) {
                            print 'active';
                        } ?>"><a class="page-link" href="index.php?action=proeevedor&pagina=<?php echo $i + 1 ?>">
                                <?php echo $i + 1 ?>
                            </a></li>
                    <?php endfor ?>
                    <li class="page-item <?php echo $_GET['pagina'] >= $pagina ? 'disabled' : '' ?>"><a class="page-link"
                            href="index.php?action=proeevedor&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
                </ul>
            </nav>
        </div>
    </div>
<?php } ?>