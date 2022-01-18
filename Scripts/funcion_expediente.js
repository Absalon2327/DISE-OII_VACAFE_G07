let modificar = false
//$home="http://localhost/DISEÑO-G07_Json/";
$("#msg_costoprecio").css("display","none");

function validar_campito() {

	$(document).on("change", "#tipo_bovino", function (e) {
		e.preventDefault();

		if ($("#tipo_bovino").val() == "vaca_lechera" ) {
			$("#cant_parto_bovino").prop("disabled", false);
			$("#control_fecha").val("no_hay_fecha");
		//	$("#fecha_ult_parto").prop("disabled", false);
			

		} else {
			
			$("#fecha_ult_parto").prop("disabled", true);
			$("#cant_parto_bovino").prop("disabled", true);
		}
	});
	$(document).on("change", "#cant_parto_bovino", function (e) {
		e.preventDefault();

		if ($("#cant_parto_bovino").val() >0 ) {
			$("#fecha_ult_parto").prop("disabled", false);
			$("#control_fecha").val("si_hay_fecha");

		}else{
			//$("#cant_parto_bovino").prop("disabled", true);
		}
	});
}

$(function () {
	document.getElementById("imagen_bovino").onchange = function () {
		var reader = new FileReader();

		reader.onload = function (e) {
			// get loaded data and render thumbnail.

			document.getElementById('img_bovino').src = e.target.result
			document.getElementById('img_bovino').width = 100
			document.getElementById('img_bovino').height = 100
		};

		// read the image file as a data URL.
		reader.readAsDataURL(this.files[0]);
	};
	document.getElementById("imagen_expediente").onchange = function () {
		var reader = new FileReader();

		reader.onload = function (e) {
			// get loaded data and render thumbnail.

			document.getElementById('img_carta_venta').src = e.target.result
			document.getElementById('img_carta_venta').width = 100
			document.getElementById('img_carta_venta').height = 100
		};

		// read the image file as a data URL.
		reader.readAsDataURL(this.files[0]);
	};

	var fecha_hoy = new Date();
	$('#fecha_ult_parto').datepicker({
		format: "dd-mm-yyyy",
		todayBtn: true,
		clearBtn: false,
		language: "es",
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
		endDate: fecha_hoy
		//startDate:fecha_hoy
	});
	cargar_datos();


	$(document).on("click", ".browse", function () {
		var file = $(this)
			.parent()
			.parent()
			.parent()
			.find(".file");
		file.trigger("click");
	});


	$('input[type="file"]').change(function (e) {
		var fileName = e.target.files[0].name;
		$("#imagen_bovino").val(fileName);

		var reader = new FileReader();
		reader.onload = function (e) {
			// get loaded data and render thumbnail.


		};
		// read the image file as a data URL.
		reader.readAsDataURL(this.files[0]);
	});

	$('input[type="file"]').change(function (e) {
		var fileName = e.target.files[0].name;
		console.log(fileName)
		$("#imagen_expediente").val(fileName);
		var reader = new FileReader();
		reader.onload = function (e) {
			// get loaded data and render thumbnail.

		};
		// read the image file as a data URL.
		reader.readAsDataURL(this.files[0]);
	});


	$(document).on("blur", ".validar_campos_unicos", function (e) {
		e.preventDefault();
		if ($(this).val() == "") {
			return;
		}
		console.log("validar_campo", $(this).data('quien_es'));
		mostrar_mensaje("Espere", "Validando " + $(this).data('quien_es'));
		var datos = { "validar_campos": "si_por_campo", "campo": $(this).val(), "tipo": $(this).data('quien_es') };

		console.log("datos: ", datos);
		$.ajax({
			dataType: "json",
			method: "POST",
			url: '../Controladores/Json_expediente.php',
			data: datos,
		}).done(function (json) {
			console.log("retorno de validacion", json);
			if (json[0] == "Exito") {

			}
			console.log("El envio: ", json);
		}).always(function () {
			Swal.close();
		});

	});

	$(document).on("change", "#imagen_expediente", function (e) {
		validar_archivo($(this));

	});
	$(document).on("change", "#imagen_bovino", function (e) {
		validar_archivo($(this));

	});
	//NUEVO CODIGO
	$(document).on("click", ".btn_abrir_modal", function (e) {
		e.preventDefault();
		document.getElementById('exampleModalLabel').innerText = 'Registro nuevo expediente'
		document.getElementById('boton_enviar').innerText = 'Guardar'
		document.getElementById('img_bovino').src = ''
		document.getElementById('img_bovino').width = ''
		document.getElementById('img_bovino').height = ''
		document.getElementById('img_carta_venta').src = ''
		document.getElementById('img_carta_venta').width = ''
		document.getElementById('img_carta_venta').height = ''
		document.getElementById('ingreso_datos').value = 'si_registro'
		document.querySelector('#radioPrimary1').checked = true
		modificar = false
		$('#md_registrar_expediente').modal('show');

	});

	$(document).on("click", ".btn_editar", function (e) {
		e.preventDefault();
		//	mostrar_mensaje("Consultando datos");
		document.getElementById('exampleModalLabel').innerText = 'Editar expediente'
		document.getElementById('boton_enviar').innerText = 'Modificar'

		var id = $(this).attr("data-int_idexpediente");
		console.log("El id es: ", id);
		var datos = { "consultar_info": "si_expediente_especifico", "idexpediente": id }
		$.ajax({
			dataType: "json",
			method: "POST",
			url: '../Controladores/Json_expediente.php',
			data: datos,
		}).done(function (json) {
			console.log("EL consultar especifico", json);
			if (json[0] == "Exito") {
				console.log(json[2])
				console.log("nombre: ", json[2]['nva_nom_bovino']);
				console.log("sexo: ", json[2]['nva_sexo_bovino']);
				console.log("partos: ", json[2]['int_cant_parto']);
				console.log("descrip: ", json[2]['txt_descrip_expediente']);
				console.log("propietario: ", json[2]['int_id_propietario']);
				console.log("raza: ", json[2]['int_idraza']);
				console.log("tipo bovino: ", json[2]['nva_tipo_bovino']);
				
				$('#llave_expediente').val(id);
				$('#ingreso_datos').val("si_actualizalo");
				// $('#fecha_ult_parto').val(fecha);
				$('#nom_bovino').val(json[2]['nva_nom_bovino']);
				$('#sexo_bovino').val(json[2]['nva_sexo_bovino']);
				$('#cant_parto_bovino').val(json[2]['int_cant_parto']);
				$('#descrip_expediente').val(json[2]['txt_descrip_expediente']);
				$('#propietario').val(json[2]['int_id_propietario']);
				$('#raza_bovino_select').val(json[2]['int_idraza']);
				$('#tipo_bovino').val(json[2]['nva_tipo_bovino']);
				$('#fecha_ult_parto').val(json[2]['dat_fecha_ult_parto']);
				$('#costo').val(json[2]['dou_costo_bovino']);
				$('#precioVenta').val(json[2]['dou_precio_venta_bovino']);
				if (json[2]['nva_tipo_bovino'] == "vaca_lechera") {
					$("#cant_parto_bovino").prop("disabled", false);
					$("#fecha_ult_parto").prop("disabled", false);
				

				} else {
					$("#cant_parto_bovino").prop("disabled", true);
					$("#fecha_ult_parto").prop("disabled", true);
				}
				if (json[2]['nva_sexo_bovino'] == 'femenino') {
					document.querySelector('#radioPrimary2').checked = true
				} else {
					document.querySelector('#radioPrimary1').checked = true
				}
				document.getElementById('img_bovino').src = json[2]['nva_foto_bovino']
				document.getElementById('img_carta_venta').src = json[2]['nva_carta_venta']
				document.getElementById('img_bovino').width = 100
				document.getElementById('img_bovino').height = 100
				document.getElementById('img_carta_venta').width = 100
				document.getElementById('img_carta_venta').height = 100
				document.getElementById('ingreso_datos').value = 'si_actualizalo'
				modificar = true
				$('#md_registrar_expediente').modal('show');
			} /*else if (json[1] == "existe bovino") {
				Toast.fire({
					icon: 'info',
					title: 'Bovino ya existe'
				});
				return;
			} else {
				Toast.fire({
					icon: 'error',
					title: 'No se pudo registrar!.'
				});
				cargar_datos();
			}*/

	    });
	});

	$('#formulario_registro').validate({
		rules: {
		},
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.input-group').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
	});

	$(document).on("submit", "#formulario_registro", function (e) {
		e.preventDefault();
		var datos = $("#formulario_registro").serialize();
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 1500
		});
		var Toast2 = Swal.mixin({
			toast: true,
			position: 'center',
			showConfirmButton: false,
			timer: 1500
		});
		if ($("#costo").val() > $("#precioVenta").val()) {
			Toast2.fire({
				icon: 'error',
				title: 'Costo no puede ser mayor que Precio de Venta'
			});
			console.log("precio: ", $("#precioVenta").val());
			return;
		}
		if ($("#costo").val() < 0 || $("#precioVenta").val() < 0) {
			Toast2.fire({
				icon: 'error',
				title: 'El costo o precio no puede ser menor que cero'
			});
			return;
		}
		if ($("#tipo_bovino").val() == "Seleccione") {
			Toast.fire({
				icon: 'info',
				title: 'Debe elegir el tipo de bovino'
			});
			return;
		}
		if ($("#raza_bovino_select").val() == "Seleccione") {
			Toast.fire({
				icon: 'info',
				title: 'Debe elegir la raza'
			});
			return;
		}

		if ($("#propietario").val() == "Seleccione") {
			Toast.fire({
				icon: 'info',
				title: 'Debe elegir el propietario'
			});
			return;
		}
		//SI ES MODIFICACION NO SE PIDEN LAS IMAGENES
		//YA QUE AL CREAR EL EXPEDIENTE SE AGREGARON 
		if (!modificar) {
			if ($("#imagen_expediente").val() == "") {
				Toast.fire({
					icon: 'info',
					title: 'Debe elegir la imagen del la carta de venta'
				});
				return;
			}
			if ($("#imagen_bovino").val() == "") {
				Toast.fire({
					icon: 'info',
					title: 'Debe elegir la imagen del bovino'
				});
				return;
			}
		}
		console.log("Imprimiendo datos: ", datos);

		$.ajax({
			type: "POST",
			dataType: "json",
			url: '../Controladores/Json_expediente.php',
			data: datos,
		}).done(function (json) {
			console.log("EL GUARDAR", json + ' eeeeee' + json[0]);
			if (json[0] == "Exito") {

				$('#md_registrar_expediente').modal('hide');
				if ($("#imagen_expediente").val() != "" && $("#imagen_bovino").val() != "") {

					subir_archivo($("#imagen_expediente"), json[1], "subir_imagen_ajax");
					subir_archivo($("#imagen_bovino"), json[1], "subir_imagen_bovino");

				} else if ($("#imagen_bovino").val() != "" && $("#imagen_expediente").val() == "") {
					subir_archivo($("#imagen_bovino"), json[1], "subir_imagen_bovino");
				} else if ($("#imagen_bovino").val() == "" && $("#imagen_expediente").val() != "") {
					subir_archivo($("#imagen_expediente"), json[1], "subir_imagen_ajax");


				} else {
					if (!modificar) {
						mostrar_mensaje("Error", "algo paso");

					}
				}
				$('#md_registrar_expediente').trigger('reset');
				cargar_datos();

				document.getElementById('formulario_registro').reset()
				setTimeout(function (s) {
					if (modificar) {
						Toast.fire({
							icon: 'success',
							title: 'Expediente Modificado!.'
						})
					} else {
						Toast.fire({
							icon: 'success',
							title: 'Expediente Registrado!.'
						})
					}
				}, 500)

				return;
			} else if (json[1] == "existe bovino") {
				Toast.fire({
					icon: 'info',
					title: 'Bovino ya existe'
				});
				return;
			} else {
				Toast.fire({
					icon: 'error',
					title: 'No se pudo registrar!.'
				});
				cargar_datos();
			}

		});
	});



});



function validar_archivo(file) {
	console.log("validar_archivo", file);

	var Lector;
	var Archivos = file[0].files;
	var archivo = file;
	var archivo2 = file.val();
	if (Archivos.length > 0) {


		Lector = new FileReader();
		Lector.onloadend = function (e) {
			var origen, tipo, tamanio;
			//Envia la imagen a la pantalla
			origen = e.target; //objeto FileReader
			console.log('EL ORIGEN ' + e.target.files[0].mozFullPath)
			//Prepara la información sobre la imagen

			tipo = archivo2.substring(archivo2.lastIndexOf("."));
			console.log("el tipo", tipo);
			tamanio = e.total / 1024;
			console.log("el tamaño", tamanio);

			if (tipo !== ".jpeg" && tipo !== ".JPEG" && tipo !== ".jpg" && tipo !== ".JPG" && tipo !== ".png" && tipo !== ".PNG") {
				//  
				console.log("error_tipo");
				$("#error_en_la_imagen").css('display', 'block');
			}
			else {
				$("#error_en_la_imagen").css('display', 'none');
				console.log("en el else");
			}

		};
		Lector.onerror = function (e) {
			console.log(e)
		}
		Lector.readAsDataURL(Archivos[0]);
	}
}

function subir_archivo(archivo, int_idexpediente, metodo) {

	Swal.fire({
		title: '¡Subiendo imagen!',
		html: 'Por favor espere mientras se sube el archivo',
		timerProgressBar: true,
		allowEscapeKey: false,
		allowOutsideClick: false,
		onBeforeOpen: () => {
			Swal.showLoading()
		}
	});

	console.log("aca archivos", archivo, int_idexpediente);
	// return null;
	var file = archivo.files;
	var formData = new FormData();
	formData.append('formData', $("#crear_seccion_home"));
	var data = new FormData();
	//Append files infos
	jQuery.each(archivo[0].files, function (i, file) {
		console.log('heyyyyyyyyyyfile-' + i)
		data.append('file-' + i, file);
	});

	console.log("data", data);
	$.ajax({
		url: "../Controladores/json_expediente.php?id=" + int_idexpediente + '&subir_imagen=' + metodo,
		type: "POST",
		dataType: "json",
		data: data,
		cache: false,
		processData: false,
		contentType: false,
		context: this,

		success: function (json) {
			Swal.close();
			console.log("eljson_img", json);


			if (json[0] == "Exito") {
				Swal.fire(
					'¡Excelente!',
					'La información ha sido almacenada correctamente!',
					'success'
				);
				$('#md_registrar_expediente').modal('hide');
				cargar_datos();


			} else {
				Swal.fire(
					'¡Error!',
					'No ha sido posible registrar la imagen',
					'error'
				);
				$('#md_registrar_expediente').modal('hide');
				cargar_datos();
			}

		}
	});
}
$(document).on("click", ".btn_cerrar_class", function (e) {
	e.preventDefault();
	$("#formulario_registro").trigger('reset');
	$('#md_registrar_expediente').modal('hide');

});

function cargar_datos() {
	mostrar_mensaje("Consultando datos");
	var datos = { "consultar_info": "si_consultala" }

	$.ajax({
		dataType: "json",
		method: "POST",
		url: '../Controladores/Json_expediente.php',
		data: datos,
	}).done(function (json) {
		console.log("EL consultar", json);
		$("#datos_tabla").empty().html(json[1]);
		$('#tabla_expediente').DataTable();
		$('#md_registrar_expediente').modal('hide');

	}).fail(function () {

	}).always(function () {
		Swal.close();
	});

}

function mostrar_mensaje(titulo, mensaje = "") {
	Swal.fire({
		title: titulo,
		html: mensaje,
		allowOutsideClick: false,
		timerProgressBar: true,
		didOpen: () => {
			Swal.showLoading()

		},
		willClose: () => {

		}
	}).then((result) => {


	});
}

