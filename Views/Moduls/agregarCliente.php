<h1 style="text-align: center;">Cliente</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="post">
                <div class="row">
                    <div class="col">
                        <label>Nombres</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre Cliente" required>
                    </div>
                    <div class="col">
                        <label>Apellidos</label>
                        <input type="text" class="form-control" name="apellido" placeholder="Apellido Cliente" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>CC</label>
                        <input type="text" class="form-control" name="cc" placeholder="Cedula Cliente" required>
                    </div>
                    <div class="col">
                        <label>CC</label>
                        <input type="email" class="form-control" name="email" placeholder="Correo Cliente" required>
                    </div>
                </div>
                <button name="agregar" class="btn btn-primary mt-5">Agregar</button>
            </form>
        </div>
    </div>
</div>
<?php
$agregar = new ControladorCLiente();
$agregar->agregarCliente();
?>