<?php
$listarActivo = new ControladorActivo();
$activo = $listarActivo->listarActivo();

$listarDiseno = new ControladorDiseno();
$diseno = $listarDiseno->listarDisenoEditar();
?>
<h1 style="text-align: center;">Diseño Sistema</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <label>Nombre Sistema</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre sistema" required
                            disabled value="<?php echo $diseno[0]['nom_sistema'] ?>">
                    </div>
                    <div class="col">
                        <label>Icono Sistema</label>
                        <img id="uploadPreview1" class="form-control mt-3" width="350" height="350"
                            src="<?php echo $diseno[0]['icon_sistema'] ?>" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label>Nit Sistema</label>
                        <input type="number" class="form-control" name="nit" placeholder="Nit sistema" required disabled
                            value="<?php echo $diseno[0]['nit'] ?>">
                    </div>
                    <div class="col">
                        <label>Telefono Sistema</label>
                        <input type="number" class="form-control" name="telefono" placeholder="Telefono sistema"
                            required disabled value="<?php echo $diseno[0]['telefono'] ?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label>Dirección Sistema</label>
                        <input type="text" class="form-control" name="direccion" placeholder="Dirección sistema"
                            required disabled value="<?php echo $diseno[0]['direccion'] ?>">
                    </div>
                    <div class="col">
                        <label>Activo</label>
                        <select name="activo" class="form-control" required>
                            <option value="">Seleccionar....</option>
                            <?php
                            foreach ($activo as $key => $value) {
                                ?>
                                <option value="<?php echo $value['id_activo'] ?>" <?php if ($value['id_activo'] == $diseno[0]['id_activo']) {
                                       echo 'selected';
                                   } ?>>
                                    <?php echo $value['nombre_activo'] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <button name="actualizar" class="btn btn-primary mt-5">Actualizar</button>
            </form>
        </div>
    </div>
</div>
<?php
if ($_SESSION['rol'] != "Administrado") {
    echo '<script>window.location="inicio"</script>';
}
$agregar = new ControladorDiseno();
$agregar->agregarDiseno();
?>