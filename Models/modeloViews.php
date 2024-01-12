<?php

class modeloViews
{
    function enlacePagina($enlace)
    {
        if (
            $enlace == 'inicio' ||
            $enlace == 'salir' ||
            $enlace == 'proeevedor' ||
            $enlace == 'agregarProeevedor' ||
            $enlace == 'editarProeevedor' ||
            $enlace == 'cliente' ||
            $enlace == 'agregarCliente' ||
            $enlace == 'editarCliente' ||
            $enlace == 'medida' ||
            $enlace == 'agregarMedida' ||
            $enlace == 'usuario' ||
            $enlace == 'agregarUsuario' ||
            $enlace == 'editarUsuario' ||
            $enlace == 'caja' ||
            $enlace == 'agregarCaja' ||
            $enlace == 'editarCaja' ||
            $enlace == 'categoria' ||
            $enlace == 'agregarCategoria' ||
            $enlace == 'diseñoSistema' ||
            $enlace == 'agregarDiseno' ||
            $enlace == 'editarDiseno' ||
            $enlace == 'articulo' ||
            $enlace == 'agregarArticulo' ||
            $enlace == 'factura_proeevedor' ||
            $enlace == 'mostrarFactura' ||
            $enlace == 'ingresar' ||
            $enlace == 'venta_dia' ||
            $enlace == 'factura_pdf'
        ) {
            $modulo = 'Views/Moduls/' . $enlace . '.php';
        } elseif ($enlace == 'proeevedorAgregado') {
            $modulo = 'Views/Moduls/proeevedor.php';
        } elseif ($enlace == 'proeevedorActualizado') {
            $modulo = 'Views/Moduls/proeevedor.php';
        } elseif ($enlace == 'clienteAgregado') {
            $modulo = 'Views/Moduls/cliente.php';
        } elseif ($enlace == 'clienteActualizado') {
            $modulo = 'Views/Moduls/cliente.php';
        } elseif ($enlace == 'medidaAgregado') {
            $modulo = 'Views/Moduls/medida.php';
        } elseif ($enlace == 'usuarioAgregado') {
            $modulo = 'Views/Moduls/usuario.php';
        } elseif ($enlace == 'usuarioActualizado') {
            $modulo = 'Views/Moduls/usuario.php';
        } elseif ($enlace == 'cajaAgregado') {
            $modulo = 'Views/Moduls/caja.php';
        } elseif ($enlace == 'cajaActualizar') {
            $modulo = 'Views/Moduls/caja.php';
        } elseif ($enlace == 'categoriaAgregado') {
            $modulo = 'Views/Moduls/categoria.php';
        } elseif ($enlace == 'disenoAgregado') {
            $modulo = 'Views/Moduls/diseñoSistema.php';
        } elseif ($enlace == 'disenoActualizado') {
            $modulo = 'Views/Moduls/diseñoSistema.php';
        } elseif ($enlace == 'articuloActualizar') {
            $modulo = 'Views/Moduls/articulo.php';
        } elseif ($enlace == 'articuloRegistrado') {
            $modulo = 'Views/Moduls/articulo.php';
        }elseif ($enlace == 'loginFallido') {
            $modulo = 'Views/Moduls/ingresar.php';
        }elseif ($enlace == 'loginInactivo') {
            $modulo = 'Views/Moduls/ingresar.php';
        }
        return $modulo;

    }
}
