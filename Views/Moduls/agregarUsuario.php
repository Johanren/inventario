<?php
$listarActivo = new ControladorActivo();
$activo = $listarActivo->listarActivo();

$listarRol = new ControladorRol();
$rol = $listarRol->listarRol();

$listarCaja = new ControladorCaja();
$caja = $listarCaja->listarCaja();
if ($_SESSION['rol'] != "Administrado") {
    echo '<script>window.location="inicio"</script>';
}
?>
<h1 style="text-align: center;">Usuario</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="post">
                <div class="row">
                    <div class="col">
                        <label>Usuario</label>
                        <input type="text" class="form-control" name="usuario" placeholder="Nombre Usuario" required>
                    </div>
                    <div class="col">
                        <label>Contraseña</label>
                        <input type="text" class="form-control" name="clave" placeholder="Contrasña Usuario" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Activo</label>
                        <select name="activo" class="form-control" required>
                            <option value="">Seleccionar....</option>
                            <?php
                            foreach ($activo as $key => $value) {
                                ?>
                                <option value="<?php echo $value['id_activo'] ?>">
                                    <?php echo $value['nombre_activo'] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <label>Rol</label>
                        <select name="rol" class="form-control" required>
                            <option value="">Seleccionar....</option>
                            <?php
                            foreach ($rol as $key => $value) {
                                ?>
                                <option value="<?php echo $value['id_rol'] ?>">
                                    <?php echo $value['rol'] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Caja</label>
                        <select name="caja" class="form-control" required>
                            <option value="">Seleccionar....</option>
                            <?php
                            foreach ($caja as $key => $value) {
                                ?>
                                <option value="<?php echo $value['id_caja'] ?>">
                                    <?php echo $value['nombre_caja'] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <button name="agregar" class="btn btn-primary mt-5">Agregar</button>
            </form>
        </div>
    </div>
</div>
<?php
$agregar = new ControladorUsuario();
$agregar->agregarUsuario();
?>