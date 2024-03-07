//teclas especiales
document.addEventListener('keydown', function (event) {
	//agregar factura
	if (event.key === 'F2') {
		var urlActual = window.location.href;
		var hosting = window.location.hostname;
		//console.log(hosting);
		if (urlActual == "http://"+hosting+"/inventario/agregarArticulo") {
			document.getElementById("agregarArticulo").click();
		} else {
			document.getElementById("agregarFactura").click();
		}

	}
	//eliminar columna factura
	if (event.key === 'F4') {
		document.getElementById("eliminarFactura").click();
	}
});

//previsualizar imagen
function previewImage1(nb) {
	var reader = new FileReader();
	reader.readAsDataURL(document.getElementById('uploadImage' + nb).files[0]);
	reader.onload = function (e) {
		document.getElementById('uploadPreview' + nb).src = e.target.result;
	};

}
//Autocomplete
$("#proeevedor").autocomplete({
	source: function (request, response) {
		$.ajax({
			url: 'Views/ajax.php',
			type: 'get',
			dataType: 'json',
			data: { proeevedor: request.term },
			success: function (data) {
				response(data);
				console.log("el dato", data);

			}

		});
	},
	minLength: 1,
	select: function (event, ui) {
		$(this).val(ui.item.id);
		$("#id_proeevedor").val(ui.item.label);
		$("#nom_proeevedor").html(ui.item.nom);
		$("#nit_proeevedor").html(ui.item.nit);
		$("#tel_proeevedor").html(ui.item.tel);
		$("#dir_proeevedor").html(ui.item.dire);
		return false;
	}

});

$('body').on('click', '#cc', function () {
	$(this).autocomplete({
		source: function (request, response) {
			$.ajax({
				url: 'Views/ajax.php',
				type: 'get',
				dataType: 'json',
				data: { cc: request.term },
				success: function (data) {
					response(data);
					console.log("el dato", data);

				}

			});
		},
		minLength: 1,
		select: function (event, ui) {
			$(this).val(ui.item.label1);
			$("#cliente").val(ui.item.label);
			$("#id_cliente").val(ui.item.id);
			return false;
		}

	});
});


$('body').on('click', '.categoria', function () {
	var id = this.id;
	var splitid = id.split('_');
	var index = splitid[1];
	$(this).autocomplete({
		source: function (request, response) {
			$.ajax({
				url: 'Views/ajax.php',
				type: 'get',
				dataType: 'json',
				data: { categoria: request.term },
				success: function (data) {
					response(data);
					console.log("el dato", data);
					var len = data.length;
					if (len > 0) {
						var id = data[0]['id_categoria'];
						var categoria = data[0]['categoria'];

						document.getElementById('id_categoria_' + index).value = id;
						document.getElementById('categoria_' + index).value = categoria;

					}
				}

			});
		}

	});
});

$('body').on('click', '.medida', function () {
	var id = this.id;
	var splitid = id.split('_');
	var index = splitid[1];
	$(this).autocomplete({
		source: function (request, response) {
			$.ajax({
				url: 'Views/ajax.php',
				type: 'get',
				dataType: 'json',
				data: { medida: request.term },
				success: function (data) {
					response(data);
					console.log("el dato", data);
					var len = data.length;
					if (len > 0) {
						var id = data[0]['id_medida'];
						var medida = data[0]['medida'];

						document.getElementById('id_medida_' + index).value = id;
						document.getElementById('medida_' + index).value = medida;

					}
				}

			});
		}

	});
});

$(".codigo").autocomplete({
	source: function (request, response) {
		$.ajax({
			url: 'Views/ajax.php',
			type: 'get',
			dataType: 'json',
			data: { codigo: request.term },
			success: function (data) {
				response(data);
				console.log("el dato", data);

			}

		});
	},
	select: function (event, ui) {
		$(this).val(ui.item.label); // display the selected text
		var id = ui.item.value; // selected id to input

		// AJAX
		$.ajax({
			url: 'Views/ajax.php',
			type: 'get',
			data: { id: request.term },
			dataType: 'json',
			success: function (response) {
				response(response);
				console.log("el dato", response);
			}
		});

		return false;
	}

});
//agregar factura codigo

$(document).ready(function () {

	$(document).on('keydown', '.codigo_articulo', function () {

		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		$('#' + id).autocomplete({
			source: function (request, response) {
				$.ajax({
					url: 'Views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { codigo: request.term },
					success: function (data) {
						response(data);
						console.log("el dato", data);
					}

				});
			}, select: function (event, ui) {
				$(this).val(ui.item.label); // display the selected text
				var userid = ui.item.value; // selected id to input

				// AJAX
				$.ajax({
					url: 'Views/ajax.php',
					type: 'get',
					data: { userid: userid, request: 2 },
					dataType: 'json',
					success: function (data) {

						var len = data.length;
						if (len > 0) {
							var id = data[0]['id_articulo'];
							var codigo = data[0]['codigo_producto'];
							var name = data[0]['nombre_producto'];
							var valor = data[0]['valor_producto_iva'];

							document.getElementById('id_articulo_' + index).value = id;
							document.getElementById('codigo_' + index).value = codigo;
							document.getElementById('nombre_' + index).value = name;
							document.getElementById('valor_' + index).value = valor;
						}

					}
				});

				return false;
			}
		});
	});
});

//agregar factura nombre

$(document).ready(function () {

	$(document).on('keydown', '.nombre_articulo', function () {

		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		$('#' + id).autocomplete({
			source: function (request, response) {
				$.ajax({
					url: 'Views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { nombre: request.term },
					success: function (data) {
						response(data);
						console.log("el dato", data);
					}

				});
			}, select: function (event, ui) {
				$(this).val(ui.item.labelN); // display the selected text
				var userid = ui.item.value; // selected id to input

				// AJAX
				$.ajax({
					url: 'Views/ajax.php',
					type: 'get',
					data: { userid: userid, request: 2 },
					dataType: 'json',
					success: function (data) {

						var len = data.length;
						if (len > 0) {
							var id = data[0]['id_articulo'];
							var codigo = data[0]['codigo_producto'];
							var name = data[0]['nombre_producto'];
							var valor = data[0]['valor_producto_iva'];

							document.getElementById('id_articulo_' + index).value = id;
							document.getElementById('codigo_' + index).value = codigo;
							document.getElementById('nombre_' + index).value = name;
							document.getElementById('valor_' + index).value = valor;
						}

					}
				});

				return false;
			}
		});
	});
});

//Agregar Articulo codigo autocomplete
$(document).ready(function () {

	$(document).on('keydown', '.codigo', function () {

		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		$(this).autocomplete({
			source: function (request, response) {
				$.ajax({
					url: 'Views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { codigo: request.term },
					success: function (data) {
						response(data);
						console.log("el dato", data);
					}

				});
			},
			select: function (event, ui) {
				$(this).val(ui.item.label); // display the selected text
				var userid = ui.item.value; // selected id to input

				// AJAX
				$.ajax({
					url: 'Views/ajax.php',
					type: 'get',
					data: { userid: userid, request: 2 },
					dataType: 'json',
					success: function (data) {

						var len = data.length;
						if (len > 0) {
							var id = data[0]['id_articulo'];
							var codigo = data[0]['codigo_producto'];
							var name = data[0]['nombre_producto'];
							var id_categoria = data[0]['id_categoria'];
							var categoria = data[0]['categoria'];
							var id_medida = data[0]['id_medida'];
							var medida = data[0]['medida'];
							var iva = data[0]['iva']
							var valor = data[0]['precio_unitario'];
							var cantidad_articulo = data[0]['cantidad_producto'];

							document.getElementById('id_articulo_' + index).value = id;
							document.getElementById('codigo_' + index).value = codigo;
							document.getElementById('nombre_' + index).value = name;
							document.getElementById('id_categoria_' + index).value = id_categoria;
							document.getElementById('categoria_' + index).value = categoria;
							document.getElementById('id_medida_' + index).value = id_medida;
							document.getElementById('medida_' + index).value = medida;
							document.getElementById('iva_' + index).value = iva;
							document.getElementById('valor_' + index).value = valor;
							document.getElementById('cantidad_' + index).value = cantidad_articulo;
						}

					}
				});

				return false;
			}
		});
	});
});

//Agregar Articulo nombre autocomplete

$(document).ready(function () {

	$(document).on('keydown', '.nombre', function () {

		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		$(this).autocomplete({
			source: function (request, response) {
				$.ajax({
					url: 'Views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { nombre: request.term },
					success: function (data) {
						response(data);
						console.log("el dato", data);
					}

				});
			},
			select: function (event, ui) {
				$(this).val(ui.item.label); // display the selected text
				var userid = ui.item.value; // selected id to input

				// AJAX
				$.ajax({
					url: 'Views/ajax.php',
					type: 'get',
					data: { userid: userid, request: 2 },
					dataType: 'json',
					success: function (data) {

						var len = data.length;
						if (len > 0) {
							var id = data[0]['id_articulo'];
							var codigo = data[0]['codigo_producto'];
							var name = data[0]['nombre_producto'];
							var id_categoria = data[0]['id_categoria'];
							var categoria = data[0]['categoria'];
							var id_medida = data[0]['id_medida'];
							var medida = data[0]['medida'];
							var iva = data[0]['iva']
							var valor = data[0]['precio_unitario'];
							var cantidad_articulo = data[0]['cantidad_producto'];

							document.getElementById('id_articulo_' + index).value = id;
							document.getElementById('codigo_' + index).value = codigo;
							document.getElementById('nombre_' + index).value = name;
							document.getElementById('id_categoria_' + index).value = id_categoria;
							document.getElementById('categoria_' + index).value = categoria;
							document.getElementById('id_medida_' + index).value = id_medida;
							document.getElementById('medida_' + index).value = medida;
							document.getElementById('iva_' + index).value = iva;
							document.getElementById('valor_' + index).value = valor;
							document.getElementById('cantidad_' + index).value = cantidad_articulo;
						}

					}
				});

				return false;
			}
		});
	});
});
//Multiplicar factura valor * cantidad
$(document).ready(function () {
	$(document).on('keydown', '.cantidad', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		var valor_descuento = document.getElementById('descuento_' + index + '').value;
		var valor = document.getElementById('valor_' + index + '').value;
		let cantidad = document.getElementById('cantidad_' + index + '');
		cantidad.addEventListener("keyup", function () {
			if (valor_descuento > 0) {

			} else {
				var result = parseInt(valor) * parseInt(this.value);
				document.getElementById('resultado_' + index).value = result;
				let valor_total_elems = document.querySelectorAll('#resultado_' + index + '')
				let suma = 0
				valor_total_elems.forEach(e => suma += parseInt(e.value))

				document.querySelector('#total_1').value = suma
			}
		});
	});
});
//sumar factura
$(document).ready(function () {
	$(document).on('keydown', '.cantidad', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		let cantidad = document.getElementById('cantidad_' + index + '');
		cantidad.addEventListener("keyup", function () {
			let valor_total_elems = document.querySelectorAll('.resultado')
			let suma = 0
			valor_total_elems.forEach(e => suma += parseInt(e.value))
			console.log(suma);
			document.querySelector('#total_1').value = suma
		});
	});
});
//peso
$(document).ready(function () {
	$(document).on('keydown', '.peso', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		let peso = document.getElementById('peso_' + index + '');
		peso.addEventListener("keyup", function () {
			let valor_total_elems = document.querySelectorAll('.resultado')
			let suma = 0
			valor_total_elems.forEach(e => suma += parseInt(e.value))

			document.querySelector('#total_1').value = suma
		});
	});
});
//Calcular el precio del gramo
$(document).ready(function () {
	$(document).on('keydown', '.peso', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		var valor = document.getElementById('valor_' + index + '').value;
		let gramo = document.getElementById('peso_' + index + '');
		gramo.addEventListener("keyup", function () {
			var precio_gramo = parseInt(valor) / 1000;
			console.log(parseInt(precio_gramo));
			var total_gramo = precio_gramo * parseInt(this.value);
			document.getElementById('resultado_' + index).value = total_gramo;

		});
	});
});
//Calcular descuento precio del gramo
$(document).ready(function () {
	$(document).on('keydown', '.peso', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		var valor = document.getElementById('descuento_' + index + '').value;
		let gramo = document.getElementById('peso_' + index + '');
		gramo.addEventListener("keyup", function () {
			if (parseInt(valor) > 0) {
				var precio_gramo = parseInt(valor) / 1000;
				var total_gramo = parseInt(precio_gramo) * parseInt(this.value);
				document.getElementById('resultado_' + index).value = total_gramo;
			} else {

			}
		});
	});
});
//Multiplicar factura valor descuento * cantidad
$(document).ready(function () {
	$(document).on('keydown', '.cantidad', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		var valor = document.getElementById('descuento_' + index + '').value;
		let cantidad = document.getElementById('cantidad_' + index + '');
		cantidad.addEventListener("keyup", function () {
			if (parseInt(valor) > 0) {
				var result = parseInt(valor) * parseInt(this.value);
				document.getElementById('resultado_' + index).value = result;
			}
		});
	});
});
//cambio
$(document).ready(function () {
	$(document).on('keydown', '.pago', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		let cantidad = document.getElementById('pago_1');
		cantidad.addEventListener("keyup", function () {
			let valor_total_elems = document.querySelectorAll('#total_1')
			let suma = 0
			valor_total_elems.forEach(e => suma += parseInt(e.value))
			let resta = 0
			resta = parseInt(this.value) - suma;
			document.querySelector('#cambio_1').value = resta
		});
	});
});
//abono deuda
$(document).ready(function () {
	$(document).on('keydown', '#abono', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		let cantidad = document.getElementById('abono');
		cantidad.addEventListener("keyup", function () {
			let valor_total_elems = document.querySelectorAll('#deuda')
			let suma = 0
			valor_total_elems.forEach(e => suma -= parseInt(e.value))
			let resta = 0
			resta = suma - parseInt(this.value);
			document.querySelector('#Total').value = resta
		});
	});
});
//agregar factura

$(document).ready(function () {
	var index = 2;
	$("#agregarFactura").click(function () {
		$("#factura").append('<tr class="eliminar_' + index + '"><td><input type="hidden" name="id_articulo[]" id="id_articulo_' + index + '"><input type="text" name="codigo" class="form-control codigo_articulo" id="codigo_' + index + '" placeholder="Codigo producto"></td><td><input type="text" name="articulo" class="form-control nombre_articulo" id="nombre_' + index + '" placeholder="Nombre producto"></td><td><input type="text" name="precio" class="form-control" id="valor_' + index + '" disabled></td><td><input type="text" name="descuento[]" class="form-control" id="descuento_' + index + '" value="0"></td><td><input type="text" name="peso[]" class="form-control peso" id="peso_' + index + '" value="0" required><td><input type="text" name="cantidad[]" class="form-control cantidad" id="cantidad_' + index + '" value="0" required></td><td><input type="text" name="total" class="form-control resultado" id="resultado_' + index + '" disabled></td><td><a class="btn btn-primary mt-3 eliminar" id="eliminarFactura">Eliminar</a></td></tr>');
		index++;
	});
});

//agregar articulo
$(document).ready(function () {
	var index = 2;
	$("#agregarArticulo").click(function () {
		$("#articulo").append('<tr><td><input type="hidden" name="id_articulo[]" id="id_articulo_' + index + '"><input type="text" name="codigo[]" class="form-control codigo" id="codigo_' + index + '" required></td><td><input type="text" name="nombre[]" class="form-control nombre" id="nombre_' + index + '" required></td><td><input type="hidden" name="id_categoria[]" class="id_categoria" id="id_categoria_' + index + '"><input type="text" name="categoria[]" class="form-control categoria" id="categoria_' + index + '"></td><td><input type="hidden" name="id_medida[]" class="id_medida" id="id_medida_' + index + '"><input type="text" name="medida[]" class="form-control medida" id="medida_' + index + '" required></td><td><input type="text" name="iva[]" class="form-control" id="iva_' + index + '" required></td><td><input type="text" name="valor[]" class="form-control"id="valor_' + index + '" required></td><td><input type="hidden" name="cantidad_articulo[]" class="form-control" id="cantidad_' + index + '"><input type="text" name="cantidad[]" class="form-control" required></td></tr>');
		index++;
	});
});

//revome
for (let index = 0; index < 30; index++) {

	$(document).on('click', '.eliminar', function () {
		$(this).parents('.eliminar_' + index + '').remove();
	})
}


//obtener peso de una valanza
window.addEventListener('deviceorientation', handleOrientation);

function handleOrientation(event) {
	if (event.absolute) {
		// El peso estará en la propiedad event.alpha, event.beta o event.gamma
		// Dependiendo de la orientación del dispositivo
		console.log('Peso: ' + event.alpha);
	}
}
//codigo de barra articulo
$(document).ready(function () {
	$(document).on('keydown', '.codigo', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		var controladorTiempo = "";
		var cantidad = 0;
		var posicion = [];
		var arrayQR = [];
		function codigoAJAX() {
			var codigo = $('#codigo_' + index + '').val();
			var numero = (cantidad + 1) == 0 ? 1 : cantidad + 1;
			//console.log(numero);
			inicio = 0;
			for (i = 0; i < numero; i++) {
				codigobarra = codigo.substring(inicio, posicion[i]);
				inicio = posicion[i];
				arrayQR.push(codigobarra);
				$.ajax({
					url: 'Views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { codigo1: codigo },

				})
					.done(function (data) {
						//console.log("el dato", data);

						var len = data.length;
						if (len > 0) {
							console.log("el dato", data);
							var id = data[0]['id_articulo'];
							var codigo = data[0]['codigo_producto'];
							var name = data[0]['nombre_producto'];
							var id_categoria = data[0]['id_categoria'];
							var categoria = data[0]['categoria'];
							var id_medida = data[0]['id_medida'];
							var medida = data[0]['medida'];
							var iva = data[0]['iva']
							var valor = data[0]['precio_unitario'];
							var cantidad_articulo = data[0]['cantidad_producto'];

							document.getElementById('id_articulo_' + index).value = id;
							document.getElementById('codigo_' + index).value = codigo;
							document.getElementById('nombre_' + index).value = name;
							document.getElementById('id_categoria_' + index).value = id_categoria;
							document.getElementById('categoria_' + index).value = categoria;
							document.getElementById('id_medida_' + index).value = id_medida;
							document.getElementById('medida_' + index).value = medida;
							document.getElementById('iva_' + index).value = iva;
							document.getElementById('valor_' + index).value = valor;
							document.getElementById('cantidad_' + index).value = cantidad_articulo;
						}
					})

			}
			cantidad = 0;
			posicion = [];
			$('#codigo_' + index + '').val('');
			document.getElementById('codigo_' + index).value = codigo;
		}
		$('#codigo_' + index + '').on("keyup", function (e) {
			var codigo = $('#codigo_' + index + '').val();
			largo = codigo.length;

			if (e.which == 13) {
				cantidad++;
				posicion.push(largo);
			}
			//console.log("el dato", codigo);
			$.ajax({
				url: 'Views/ajax.php',
				type: 'get',
				dataType: 'json',
				data: { codigo1: codigo },

			})
				.done(function (data) {
					//console.log("el dato", data);
					var len = data.length;
					if (len > 0) {
						clearTimeout(controladorTiempo);
						controladorTiempo = setTimeout(codigoAJAX, 500);
					} else {
						console.log("el dato", data);
					}
				})
		});
	});
});
//codigo de barra factura
$(document).ready(function () {
	$(document).on('keydown', '.codigo_articulo', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		var controladorTiempo = "";
		var cantidad = 0;
		var posicion = [];
		var arrayQR = [];
		function codigoAJAX() {
			var codigo = $('#codigo_' + index + '').val();
			var numero = (cantidad + 1) == 0 ? 1 : cantidad + 1;
			//console.log(numero);
			inicio = 0;
			for (i = 0; i < numero; i++) {
				codigobarra = codigo.substring(inicio, posicion[i]);
				inicio = posicion[i];
				arrayQR.push(codigobarra);
				$.ajax({
					url: 'Views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { codigo1: codigo },

				})
					.done(function (data) {
						console.log("el dato", data);
						var len = data.length;
						if (len > 0) {
							var id = data[0]['id_articulo'];
							var codigo = data[0]['codigo_producto'];
							var name = data[0]['nombre_producto'];
							var valor = data[0]['valor_producto_iva'];

							document.getElementById('id_articulo_' + index).value = id;
							document.getElementById('codigo_' + index).value = codigo;
							document.getElementById('nombre_' + index).value = name;
							document.getElementById('valor_' + index).value = valor;
						}
					})

			}
			cantidad = 0;
			posicion = [];
			$('#codigo_' + index + '').val('');
		}
		$('#codigo_' + index + '').on("keyup", function (e) {
			var codigo = $('#codigo_' + index + '').val();
			largo = codigo.length;

			if (e.which == 13) {
				cantidad++;
				posicion.push(largo);
			}
			clearTimeout(controladorTiempo);
			controladorTiempo = setTimeout(codigoAJAX, 500);
		});
	});
});