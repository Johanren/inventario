<h1 style="text-align: center;">Articulo</h1>
<form method="post">
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <input type="hidden" name="id_proeevedor" id="id_proeevedor" disabled>
                <input type="text" name="proeevedor" placeholder="Nit y/o nombre proeevedor" id="proeevedor" required
                    class="form-control">
                <div class="mt-3" style="text-align: center;">
                    Proeevedor: <span id="nom_proeevedor"></span><br>
                    Nit: <span id="nit_proeevedor"></span><br>
                    Telefono: <span id="tel_proeevedor"></span><br>
                    Dirección: <span id="dir_proeevedor"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Codigo Producto</th>
                    <th>Nombre Producto</th>
                    <th>Categoria</th>
                    <th>Medida</th>
                    <th>Iva</th>
                    <th>Valor</th>
                    <th>Cantidad</th>
                    <th><a class="btn btn-primary" id="agregarArticulo">Añadir</a></th>
                </tr>
            </thead>
            <tbody id="articulo">
                <tr>
                    <td><input type="hidden" name="id_articulo[]" id="id_articulo_1"><input type="text" name="codigo[]"
                            class="form-control codigo" id="codigo_1" required></td>
                    <td><input type="text" name="nombre[]" class="form-control nombre" id="nombre_1" required></td>
                    <td><input type="hidden" name="id_categoria[]" class="id_categoria" id="id_categoria_1"><input
                            type="text" name="categoria[]" class="form-control categoria" id="categoria_1" required>
                    </td>
                    <td><input type="hidden" name="id_medida[]" class="id_medida" id="id_medida_1"><input type="text"
                            name="medida[]" class="form-control medida" id="medida_1" required></td>
                    <td><input type="text" name="iva[]" class="form-control" id="iva_1" required></td>
                    <td><input type="text" name="valor[]" class="form-control" id="valor_1" required></td>
                    <td><input type="hidden" name="cantidad_articulo[]" class="form-control" id="cantidad_1"><input type="text" name="cantidad[]" class="form-control" required></td>
                </tr>
            </tbody>
        </table>
    </div>
    <button name="agregar" class="btn btn-primary mt-5">Agregar</button>
</form>
<?php
$agregar = new ControladorArticulo();
$agregar->agregarArticulo();
?>