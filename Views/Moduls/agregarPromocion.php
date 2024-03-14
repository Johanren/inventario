<h1 style="text-align: center;">Promociones</h1>
<div class="container">
    <div class="row">
        <form action="" method="post">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Articulo</th>
                        <th>Precio Promocion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="hidden" name="id_promocion" id="id_articulo_1">
                            <input type="text" name="codigo" class="form-control codigo_articulo" id="codigo_1"
                                placeholder="Codigo producto">
                        </td>
                        <td><input type="text" name="articulo" placeholder="Articulo"
                                class="form-control nombre_articulo" id="nombre_1"></td>
                        <td><input type="text" name="precio" class="form-control" id="valor_1" placeholder="precio">
                        </td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th></th>
                        <th>Articulo a promocionar</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="promocion">
                    <tr>
                        <td><input type="hidden" name="id_articulo[]" id="id_articulo_2">
                            <input type="text" name="Codigopromocion[]" class="form-control codigo_articulo"
                                id="codigo_2" placeholder="Codigo producto">
                        </td>
                        <td><input type="text" name="articuloPromocion[]" placeholder="Articulo"
                                class="form-control nombre_articulo" id="nombre_2"></td>
                        <td><a class="btn btn-primary" id="agregarPromocion"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="30" height="30" fill="currentColor" class="bi bi-file-earmark-plus"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5" />
                                    <path
                                        d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z" />
                                </svg></a></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary" name="agregar">Agregar</button>
        </form>
    </div>
</div>
<?php
$agregar = new ControladorPromocion();
$agregar->agregarPromocion();
?>