<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "usuarioAgregado") {
        print '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
          Usuario agregado
        </div>
      </div>';
    }
    if ($_GET['action'] == "usuarioActualizado") {
        print '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
          Usuario Actualizado
        </div>
      </div>';
    }
}
$conn = new ControladorUsuario();
$con = $conn->contarDatosUsuarioControlador();
$limtPagina = 10;
$pagina = $con[0]['COUNT(id_usuario)'] / $limtPagina;
$pagina = ceil($pagina);
if (isset($_GET['pagina'])) {
    if (!$_GET['pagina']) {
        echo '<script>window.location="index.php?action=usuario&pagina=1"</script>';
    }
    if ($_GET['pagina'] > $pagina || $_GET['pagina'] <= 0) {
        echo '<script>window.location="index.php?action=usuario&pagina=1"</script>';
    }
}
$lis = new ControladorUsuario();
if (isset($_GET['pagina'])) {
    $res = $lis->listarUsuarioControlador($_GET['pagina'], $limtPagina);
}
if ($_SESSION['rol'] != "Administrado") {
    echo '<script>window.location="inicio"</script>';
}
?>
<h1 style="text-align: center;">Usuario</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <a href="agregarUsuario" class="btn btn-primary">Agregar</a>
            <form method="post" class="mt-3">
                <input type="text" class="form-control" name="buscar" placeholder="Nombre Usuario">
            </form>
        </div>
    </div>
</div>
<table class="table mt-4">
    <thead>
        <tr>
            <th>#</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Activo</th>
            <th>Rol</th>
            <th># Caja</th>
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
                        <?php echo $value['id_usuario'] ?>
                    </td>
                    <td>
                        <?php echo $value['usuario'] ?>
                    </td>
                    <td>
                        <?php echo $value['clave'] ?>
                    </td>
                    <td>
                        <?php echo $value['nombre_activo'] ?>
                    </td>
                    <td>
                        <?php echo $value['rol'] ?>
                    </td>
                    <td>
                        <?php echo $value['nombre_caja'] ?>
                    </td>
                    <td><a href="index.php?action=editarUsuario&id_usuario=<?php echo $value['id_usuario'] ?>"
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
                            href="index.php?action=usuario&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
                    <?php for ($i = 0; $i < $pagina; $i++): ?>
                        <li class="page-item <?php if ($_GET['pagina'] == $i + 1) {
                            print 'active';
                        } ?>"><a class="page-link" href="index.php?action=usuario&pagina=<?php echo $i + 1 ?>">
                                <?php echo $i + 1 ?>
                            </a></li>
                    <?php endfor ?>
                    <li class="page-item <?php echo $_GET['pagina'] >= $pagina ? 'disabled' : '' ?>"><a class="page-link"
                            href="index.php?action=usuario&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
                </ul>
            </nav>
        </div>
    </div>
<?php } ?>