<?php
$listarActivo = new ControladorActivo();
$activo = $listarActivo->listarActivo();
if ($_SESSION['rol'] != "Administrado") {
    echo '<script>window.location="inicio"</script>';
}
?>
<h1 style="text-align: center;">Caja</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="post">
                <div class="row">
                    <div class="col">
                        <label>Caja</label>
                        <input type="text" class="form-control" name="caja" placeholder="Nombre Caja" required>
                    </div>
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
                </div>
                <button name="agregar" class="btn btn-primary mt-5">Agregar</button>
            </form>
        </div>
    </div>
</div>
<?php
$agregar = new ControladorCaja();
$agregar->agregarCaja();
?>