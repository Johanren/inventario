<h1 style="text-align: center;">Medida</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="post">
                <div class="row">
                    <div class="col">
                        <label>Medida</label>
                        <input type="text" class="form-control" name="medida" placeholder="Medida" required>
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
$agregar = new ControladorMedida();
$agregar->agregarMedida();
?>