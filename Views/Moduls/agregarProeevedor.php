<h1 style="text-align: center;">Proeevedor</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="post">
                <div class="row">
                    <div class="col">
                        <label>Nit</label>
                        <input type="text" class="form-control" name="nit" placeholder="Nit Proeevedor" required>
                    </div>
                    <div class="col">
                        <label>Proeevedor</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre Proeevedor" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Telefono</label>
                        <input type="number" class="form-control" name="tel" placeholder="Telefono Proeevedor" required>
                    </div>
                    <div class="col">
                        <label>Dirección</label>
                        <input type="text" class="form-control" name="dire" placeholder="Dirección Proeevedor" required>
                    </div>
                </div>
                <button name="agregar" class="btn btn-primary mt-5">Agregar</button>
            </form>
        </div>
    </div>
</div>
<?php
    $agregar = new ControladorProeevedor();
    $agregar->agregarProeevedor();
?>