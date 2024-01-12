<?php  

//controllers
require_once 'controllers/controladorViews.php';
require_once 'controllers/controladorProeevedor.php';
require_once 'controllers/controladorCLiente.php';
require_once 'controllers/controladorMedida.php';
require_once 'controllers/controladorActivo.php';
require_once 'controllers/controladorRol.php';
require_once 'controllers/controladorUsuario.php';
require_once 'controllers/controladorCaja.php';
require_once 'controllers/controladorCategoria.php';
require_once 'controllers/controladorDiseno.php';
require_once 'controllers/controladorArticulo.php';
require_once 'controllers/controladorFacturaProeevedor.php';
require_once 'controllers/controladorFactura.php';
require_once 'controllers/controladorVenta.php';
//Modelo
require_once 'Models/conexion.php';
require_once 'Models/modeloViews.php';
require_once 'Models/modeloProeevedor.php';
require_once 'Models/modeloCliente.php';
require_once 'Models/modeloMedida.php';
require_once 'Models/modeloActivo.php';
require_once 'Models/modeloRol.php';
require_once 'Models/modeloUsuario.php';
require_once 'Models/modeloCaja.php';
require_once 'Models/modeloCategoria.php';
require_once 'Models/modeloDiseno.php';
require_once 'Models/modeloArticulo.php';
require_once 'Models/modeloFacturaProeevedor.php';
require_once 'Models/modeloFactura.php';
require_once 'Models/modeloVenta.php';
//fpdf


$views = new controladorViews();
$views->cargarTemplate();

?>