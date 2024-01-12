<h1 style="text-align: center;">Diseño Sistema</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <label>Nombre Sistema</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre sistema" required>
                    </div>
                    <div class="col">
                        <label>Icono Sistema</label>
                        <input id="uploadImage1" required class="form-control" type="file" required id="subirAntes"
                            name="subirAntes" onchange="previewImage1(1);" />
                        <img id="uploadPreview1" class="mt-3" width="350" height="350" src="Views/img/img.jpg" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label>Nit Sistema</label>
                        <input type="number" class="form-control" name="nit" placeholder="Nit sistema" required>
                    </div>
                    <div class="col">
                        <label>Telefono Sistema</label>
                        <input type="number" class="form-control" name="telefono" placeholder="Telefono sistema" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label>Dirección Sistema</label>
                        <input type="text" class="form-control" name="direccion" placeholder="Dirección sistema" required>
                    </div>
                </div>
                <button name="agregar" class="btn btn-primary mt-5">Agregar</button>
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