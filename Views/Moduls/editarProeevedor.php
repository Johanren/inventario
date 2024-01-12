<?php
$actualizar = new ControladorProeevedor();
$actualizar->agregarProeevedor();
$listar = $actualizar->listarProeevedorEditar();
?>
<h1 style="text-align: center;">Proeevedor</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="post">
                <div class="row">
                    <div class="col">
                        <label>Nit</label>
                        <input type="text" class="form-control" name="nit" placeholder="Nit Proeevedor" value="<?php echo $listar[0]['nit_proeevedor'] ?>" required>
                    </div>
                    <div class="col">
                        <label>Proeevedor</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre Proeevedor" required value="<?php echo $listar[0]['nombre_proeevedor'] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Telefono</label>
                        <input type="number" class="form-control" name="tel" placeholder="Telefono Proeevedor" required value="<?php echo $listar[0]['telefono_proeevedor'] ?>">
                    </div>
                    <div class="col">
                        <label>Dirección</label>
                        <input type="text" class="form-control" name="dire" placeholder="Dirección Proeevedor" required value="<?php echo $listar[0]['direccion_proeevedor'] ?>">
                    </div>
                </div>
                <button name="actualizar" class="btn btn-primary mt-5">Actualizar</button>
            </form>
        </div>
    </div>
</div>
