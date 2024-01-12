<?php
$actualizar = new ControladorCLiente();
$actualizar->agregarCliente();
$listar = $actualizar->listarClienteEditar();
?>
<h1 style="text-align: center;">Cliente</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="post">
                <div class="row">
                    <div class="col">
                        <label>Nombres</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre Cliente" required value="<?php echo $listar[0]['nombre'] ?>">
                    </div>
                    <div class="col">
                        <label>Apellidos</label>
                        <input type="text" class="form-control" name="apellido" placeholder="Apellido Cliente" required value="<?php echo $listar[0]['apellido'] ?>" >
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>CC</label>
                        <input type="number" class="form-control" name="cc" placeholder="Cedula Cliente" required value="<?php echo $listar[0]['numero_cedula'] ?>">
                    </div>
                </div>
                <button name="actualizar" class="btn btn-primary mt-5">Actualizar</button>
            </form>
        </div>
    </div>
</div>