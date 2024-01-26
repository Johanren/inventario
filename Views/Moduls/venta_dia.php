<?php
$cantidad = new ControladorVenta();
$res = $cantidad->consultarVentaDia();
$total = $cantidad->ventaTotalDia();
////
$listarDiseno = new ControladorDiseno();
$diseno = $listarDiseno->listarDisenoTemplete();
?>
<h1 style="text-align: center;">Venta del dia</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="post" class="mt-3">
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="buscar">
                    </div>
                    <div class="col">
                        <button type="hidden" name="consultar" class="btn btn-primary">Buscar</button>
                    </div>
                    <div class="col">
                        <a id="btnImprimir" class="btn btn-primary mt-2"><svg xmlns="http://www.w3.org/2000/svg"
                                width="30" height="30" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                                <path
                                    d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1" />
                            </svg></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<table class="table mt-4">
    <thead>
        <tr>
            <th>Productos Vendidos</th>
            <th>Valor unitario</th>
            <th>Peso</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($res as $key => $value) {
            $res_cantidad_total = $cantidad->consultarVentaDiaCantidadTotal($value['id_producto']);
            foreach ($res_cantidad_total as $key => $valueCantidad) {
                ?>
                <tr>
                    <td>
                        <?php echo $value['nombre_producto'] ?>
                    </td>
                    <td>
                        <?php echo $value['valor_unitario'] ?>
                        </th>
                    <td>
                        <?php echo $valueCantidad['SUM(peso)'] ?>
                    </td>
                    <td>
                        <?php echo $valueCantidad['SUM(cantidad)'] ?>
                    </td>
                    <td>
                        <?php echo $valueCantidad['SUM(precio_compra)'] ?>
                    </td>
                    <td>
                        <?php echo $value['fecha_ingreso'] ?>
                    </td>
                    <td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
    <tbody>
        <tr>
            <th>Total</th>
            <th></th>
            <th></th>
            <th></th>
            <th>
                <?php echo $total[0]['SUM(precio_compra)'] ?>
            </th>
        </tr>
    </tbody>
</table>
<div class="container">
    <div class="columns">
        <div class="column">
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="select is-rounded">
                <select hidden id="listaDeImpresoras"></select>
            </div>
            <div class="field">
                <!--<label class="label">Separador</label>-->
                <div class="control">
                    <input hidden id="separador" value=" " class="input" type="text" maxlength="1"
                        placeholder="El separador de columnas">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Relleno</label>-->
                <div class="control">
                    <input hidden id="relleno" value=" " class="input" type="text" maxlength="1"
                        placeholder="El relleno de las celdas">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para el nombre</label>-->
                <div class="control">
                    <input hidden id="maximaLongitudNombre" value="20" class="input" type="number">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para la cantidad</label>-->
                <div class="control">
                    <input hidden id="maximaLongitudCantidad" value="8" class="input" type="number">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para el precio</label>-->
                <div class="control">
                    <input hidden id="maximaLongitudPrecio" value="8" class="input" type="number">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    
    //Imprimir

    document.addEventListener("DOMContentLoaded", async () => {
        /*const conector = new ConectorPluginV3();
        conector.Iniciar();
        conector.EscribirTexto("<?php echo $diseno[0]['nom_sistema'] ?>\n");
        conector.EscribirTexto("<?php echo $diseno[0]['nit'] ?>\n");
        conector.EscribirTexto("<?php echo $diseno[0]['telefono'] ?>\n");
        conector.EscribirTexto("<?php echo $diseno[0]['direccion'] ?>\n");
        conector.EscribirTexto("--------------------------------------------------\n");
        conector.EscribirTexto("Producto  |  Cantidad  |  Precio  | Total\n");
        <?php
        foreach ($resVenta as $key => $value) {
            ?>
            conector.EscribirTexto("<?php echo $value['nombre_producto'] ?>                                                                <?php echo $value['cantidad'] ?>                                                                <?php echo $value['valor_producto_iva'] ?>                                                               <?php echo $value['precio_compra'] ?>\n");
            <?php
        }
        ?>
        conector.EscribirTexto("--------------------------------------------------\n");
        conector.EscribirTexto("Total $<?php echo $resFactura[0]['total_factura'] ?>\n");
        conector.EscribirTexto("--------------------------------------------------\n");
        conector.EscribirTexto("Pago <?php echo $resFactura[0]['efectivo'] ?>   Cambio: <?php echo $resFactura[0]['cambio'] ?>\n");
        conector.Feed(1);
        const respuesta = await conector
            .imprimirEn("prueba1");
        init();*/
        // Las siguientes 3 funciones fueron tomadas de: https://parzibyte.me/blog/2023/02/28/javascript-tabular-datos-limite-longitud-separador-relleno/
        // No tienen que ver con el plugin, solo son funciones de JS creadas por mí para tabular datos y enviarlos
        // a cualquier lugar
        const separarCadenaEnArregloSiSuperaLongitud = (cadena, maximaLongitud) => {
            const resultado = [];
            let indice = 0;
            while (indice < cadena.length) {
                const pedazo = cadena.substring(indice, indice + maximaLongitud);
                indice += maximaLongitud;
                resultado.push(pedazo);
            }
            return resultado;
        }
        const dividirCadenasYEncontrarMayorConteoDeBloques = (contenidosConMaximaLongitud) => {
            let mayorConteoDeCadenasSeparadas = 0;
            const cadenasSeparadas = [];
            for (const contenido of contenidosConMaximaLongitud) {
                const separadas = separarCadenaEnArregloSiSuperaLongitud(contenido.contenido, contenido.maximaLongitud);
                cadenasSeparadas.push({ separadas, maximaLongitud: contenido.maximaLongitud });
                if (separadas.length > mayorConteoDeCadenasSeparadas) {
                    mayorConteoDeCadenasSeparadas = separadas.length;
                }
            }
            return [cadenasSeparadas, mayorConteoDeCadenasSeparadas];
        }
        const tabularDatos = (cadenas, relleno, separadorColumnas) => {
            const [arreglosDeContenidosConMaximaLongitudSeparadas, mayorConteoDeBloques] = dividirCadenasYEncontrarMayorConteoDeBloques(cadenas)
            let indice = 0;
            const lineas = [];
            while (indice < mayorConteoDeBloques) {
                let linea = "";
                for (const contenidos of arreglosDeContenidosConMaximaLongitudSeparadas) {
                    let cadena = "";
                    if (indice < contenidos.separadas.length) {
                        cadena = contenidos.separadas[indice];
                    }
                    if (cadena.length < contenidos.maximaLongitud) {
                        cadena = cadena + relleno.repeat(contenidos.maximaLongitud - cadena.length);
                    }
                    linea += cadena + separadorColumnas;
                }
                lineas.push(linea);
                indice++;
            }
            return lineas;
        }


        const obtenerListaDeImpresoras = async () => {
            return await ConectorPluginV3.obtenerImpresoras();
        }
        const URLPlugin = "http://localhost:8000"
        const $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
            $btnImprimir = document.querySelector("#btnImprimir"),
            $separador = document.querySelector("#separador"),
            $relleno = document.querySelector("#relleno"),
            $maximaLongitudNombre = document.querySelector("#maximaLongitudNombre"),
            $maximaLongitudCantidad = document.querySelector("#maximaLongitudCantidad"),
            $maximaLongitudPrecio = document.querySelector("#maximaLongitudPrecio");
        $maximaLongitudPrecioTotal = document.querySelector("#maximaLongitudPrecio");

        const init = async () => {
            /*const impresoras = await ConectorPluginV3.obtenerImpresoras();
            for (const impresora of impresoras) {
                $listaDeImpresoras.appendChild(Object.assign(document.createElement("option"), {
                    value: impresora,
                    text: impresora,
                }));
            }*/
            $btnImprimir.addEventListener("click", () => {
                const nombreImpresora = "prueba1";
                if (!nombreImpresora) {
                    return alert("Por favor seleccione una impresora. Si no hay ninguna, asegúrese de haberla compartido como se indica en: https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/")
                }
                imprimirTabla("prueba1");
            });
        }


        const imprimirTabla = async (nombreImpresora) => {
            const maximaLongitudNombre = parseInt($maximaLongitudNombre.value),
                maximaLongitudCantidad = parseInt($maximaLongitudCantidad.value),
                maximaLongitudPrecio = parseInt($maximaLongitudPrecio.value),
                maximaLongitudPrecioTotal = parseInt($maximaLongitudPrecio.value),
                relleno = $relleno.value,
                separadorColumnas = $separador.value;
            const obtenerLineaSeparadora = () => {
                const lineasSeparador = tabularDatos(
                    [
                        { contenido: "-", maximaLongitud: maximaLongitudNombre },
                        { contenido: "-", maximaLongitud: maximaLongitudCantidad },
                        { contenido: "-", maximaLongitud: maximaLongitudPrecio },
                        { contenido: "-", maximaLongitud: maximaLongitudPrecioTotal },
                    ],
                    "-",
                    "+",
                );
                let separadorDeLineas = "";
                if (lineasSeparador.length > 0) {
                    separadorDeLineas = lineasSeparador[0]
                }
                return separadorDeLineas;
            }
            // Simple lista de ejemplo. Obviamente tú puedes traerla de cualquier otro lado,
            // definir otras propiedades, etcétera
            const listaDeProductos = [
                <?php

                foreach ($res as $key => $value) {
                    $res_cantidad_total = $cantidad->consultarVentaDiaCantidadTotal($value['id_producto']);
                    foreach ($res_cantidad_total as $key => $valueCantidad) {
                        ?>{
                            nombre: "<?php echo $value['nombre_producto'] ?>",
                            cantidad: <?php if ($valueCantidad['SUM(cantidad)'] > 0) {
                                echo $valueCantidad['SUM(cantidad)'];
                            } else {
                                echo $valueCantidad['SUM(peso)'];
                            } ?>,
                            precio: <?php echo $value['valor_unitario'] ?>,
                            precioTotal: <?php echo $valueCantidad['SUM(precio_compra)'] ?>,
                        },
                        <?php
                    }
                }
                ?>
            ];
            // Comenzar a diseñar la tabla
            let tabla = obtenerLineaSeparadora() + "\n";


            const lineasEncabezado = tabularDatos([

                { contenido: "Nombre", maximaLongitud: maximaLongitudNombre },
                { contenido: "Cantidad", maximaLongitud: maximaLongitudCantidad },
                { contenido: "Precio", maximaLongitud: maximaLongitudPrecio },
                { contenido: "Total", maximaLongitud: maximaLongitudPrecioTotal },
            ],
                relleno,
                separadorColumnas,
            );

            for (const linea of lineasEncabezado) {
                tabla += linea + "\n";
            }
            tabla += obtenerLineaSeparadora() + "\n";
            for (const producto of listaDeProductos) {
                const lineas = tabularDatos(
                    [
                        { contenido: producto.nombre, maximaLongitud: maximaLongitudNombre },
                        { contenido: producto.cantidad.toString(), maximaLongitud: maximaLongitudCantidad },
                        { contenido: producto.precio.toString(), maximaLongitud: maximaLongitudPrecio },
                        { contenido: producto.precioTotal.toString(), maximaLongitud: maximaLongitudPrecio },
                    ],
                    relleno,
                    separadorColumnas
                );
                for (const linea of lineas) {
                    tabla += linea + "\n";
                }
                tabla += obtenerLineaSeparadora() + "\n";
            }
            console.log(tabla);



            const conector = new ConectorPluginV3(URLPlugin);
            const respuesta = await conector
                .Iniciar()
                .DeshabilitarElModoDeCaracteresChinos()
                .EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO)
                .DescargarImagenDeInternetEImprimir("http://<?php echo $_SERVER['HTTP_HOST'] ?>/inventario/<?php echo $diseno[0]['icon_sistema'] ?>", 0, 216)
                .Feed(1)
                .EscribirTexto("<?php echo $diseno[0]['nom_sistema'] ?>\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "Nit: <?php echo $diseno[0]['nit'] ?>\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "Teléfono: <?php echo $diseno[0]['telefono'] ?>\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "Nit: <?php echo $diseno[0]['direccion'] ?>\n")
                .EscribirTexto("Fecha: " + (new Intl.DateTimeFormat("es-MX").format(new Date())))
                .Feed(1)
                .EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA)
                .EscribirTexto("____________________\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "Venta de plugin para impresoras versión 3\n")
                .EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA)
                .EscribirTexto(tabla)
                .EscribirTexto("------------------------------------------------\n")
                .EscribirTexto("Total $<?php echo $total[0]['SUM(precio_compra)'] ?>\n")
                .Feed(3)
                .Corte(1)
                .Pulso(48, 60, 120)
                .imprimirEn("prueba1");
            if (respuesta === true) {
                alert("Impreso correctamente");
            } else {
                alert("Error: " + respuesta);
            }
        }
        init();
    });
</script>