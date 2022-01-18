let fechaTexto = ""
let fechaTextoEdit = ""

$(function () {

	var fecha_hoy = new Date();
	var fecha_mañana = new Date();
	$('#dat_fecha_monta').datepicker({
		format: "dd/mm/yyyy",
		todayBtn: true,
		clearBtn: false,
		language: "es",
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
		endDate: fecha_hoy
	});
	$('#dat_fecha_celo').datepicker({
		format: "dd/mm/yyyy",
		todayBtn: true,
		clearBtn: false,
		language: "es",
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
		endDate: fecha_hoy
	});
	$('#dat_fecha_parto').datepicker({
		format: "dd/mm/yyyy",
		todayBtn: true,
		clearBtn: false,
		language: "es",
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
		// endDate:fecha_hoy
		startDate: fecha_mañana
	});

	$('#dat_fecha_monta_edit').datepicker({
		format: "dd/mm/yyyy",
		todayBtn: true,
		clearBtn: false,
		language: "es",
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
		endDate: fecha_hoy
	});
	$('#dat_fecha_celo_edit').datepicker({
		format: "dd/mm/yyyy",
		todayBtn: true,
		clearBtn: false,
		language: "es",
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
		endDate: fecha_hoy
	});
	$('#dat_fecha_parto_edit').datepicker({
		format: "dd/mm/yyyy",
		todayBtn: true,
		clearBtn: false,
		language: "es",
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
		// endDate:fecha_hoy
		startDate: fecha_mañana
	});



	cargar_datos();
	// $(".select2").select2();
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
			url: '../Controladores/Json_prenez.php',
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
	$(document).on("click", ".btn_cerrar_class", function (e) {
		e.preventDefault();
		$("#formulario_registroP").trigger('reset');
		$('#md_registrar_prenez').modal('hide');
	});

	$(document).on("click", ".btn_editar", function (e) {
		e.preventDefault();
		mostrar_mensaje("Consultando datos");
		var int_id_preñez = $(this).attr("data-int_id_preñez");
		console.log("El id es: ", int_id_preñez);
		var datos = { "consultar_info": "si_condui_especifico", "int_id_preñez": int_id_preñez }
		$.ajax({
			dataType: "json",
			method: "POST",
			url: '../Controladores/Json_prenez.php',
			data: datos,
		}).done(function (json) {
			console.log("EL consultar especifico", json);
			if (json[0] == "Exito") {
				var fecHA_string = json[2]['dat_fecha_celo'];
				var porciones = fecHA_string.split('-');
				var fecha = porciones[2] + "/" + porciones[1] + "/" + porciones[0]
				var fecHA1_string = json[2]['dat_fecha_monta'];
				var porciones = fecHA1_string.split('-');
				var fecha1 = porciones[2] + "/" + porciones[1] + "/" + porciones[0]
				var fecHA2_string = json[2]['dat_fecha_parto'];
				var porciones = fecHA2_string.split('-');
				var fecha2 = porciones[2] + "/" + porciones[1] + "/" + porciones[0]

				$('#llave_preñez').val(int_id_preñez);
				$('#ingreso_datos').val("si_actualizalo");
				$('#int_bovino_edit').empty().html(json[2]['int_bovino_fk']);
				$('#dat_fecha_celo_edit').val(fecha);
				$('#dat_fecha_monta_edit').val(fecha1);
				$('#dat_fecha_parto_edit').val(fecha2);
				$('#md_actualizar_prenez').modal('show');
				
			}
				

		}).fail(function () { }).always(function () {
			Swal.close();
		});
	});

	$('#formulario_registroP').validate({
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
	$('#formulario_Editar').validate({
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

	$(document).on("submit", "#formulario_Editar", function (e) {
		e.preventDefault();
		var datos = $("#formulario_Editar").serialize();
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 1000
		});
		var Toast1 = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 1000
		});
		if ($("#int_bovino_edit").val() == "Seleccione") {
			Toast.fire({
				icon: 'info',
				title: 'Debe elegir el tipo de bovino'
			});
			return;
		}
		var fecha_inicio = $("#dat_fecha_monta_edit").val();
        var fecha_fin = $("#dat_fecha_celo_edit").val();
        var f1 = new Date(fecha_inicio);
        var f2 = new Date(fecha_fin)
		if (f1.getTime() > f2.getTime()){
                        Toast1.fire({
                                icon: 'error',
                                title: 'La fecha de celo no puede ser mayor que la fecha de carga'
                        });
                        return;
                }
		console.log("Imprimiendo datos: ", datos);
		//mostrar_mensaje("Almacenando información","Por favor no recargue la página");
		$.ajax({
			dataType: "json",
			method: "POST",
			url: '../Controladores/Json_prenez.php',
			data: datos,
		}).done(function (json) {
			console.log("EL EDITAR", json);

			if (json[0] == "Exito") {
				$('#formulario_Editar').trigger('reset');
				$('#md_actualizar_prenez').modal('hide');
			}
			setTimeout(function (s) {
					 Toast.fire({
							icon: 'success',
							title: 'Preñez Modificada!.'
						})
					
				}, 500)
			cargar_datos();
		}).fail(function () { }).always(function () { });
	});

	$(document).on("submit", "#formulario_registroP", function (e) {
		e.preventDefault();
		var datos = $("#formulario_registroP").serialize();
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 1000
		});
		if ($("#int_bovino_fk").val() == "Seleccione") {
			Toast.fire({
				icon: 'info',
				title: 'Debe elegir el tipo de bovino'
			});
			return;
		}
		var fecha_inicio = $("#dat_fecha_monta").val();
        var fecha_fin = $("#dat_fecha_celo").val();
        var f1 = new Date(fecha_inicio);
        var f2 = new Date(fecha_fin)
		if (f1.getTime() > f2.getTime()){
                        Toast1.fire({
                                icon: 'error',
                                title: 'La fecha de celo no puede ser mayor que la fecha de carga'
                        });
                        return;
                }
		console.log("Imprimiendo datos: ", datos);
		//mostrar_mensaje("Almacenando información","Por favor no recargue la página");
		$.ajax({
			dataType: "json",
			method: "POST",
			url: '../Controladores/Json_prenez.php',
			data: datos,
		}).done(function (json) {
			console.log("EL GUARDAR", json);

			if (json[0] == "Exito") {
				$('#formulario_registroP').trigger('reset');
				$('#md_registrar_prenez').modal('hide');
				setTimeout(function (s) {
					 Toast.fire({
							icon: 'success',
							title: 'Preñez Registrada!.'
						})
					
				}, 500)
			}
			cargar_datos();
		}).fail(function () { }).always(function () { });
	});

	$("#dat_fecha_monta").datepicker().on('changeDate', function (e) {
		var fechaEstimadaParto = new Date(e.date.getFullYear(), e.date.getMonth(), e.date.getDate())
		fechaTexto = e.date.getDate() + '/' + (e.date.getMonth() < 9 ? '0' : '') + ((e.date.getMonth()) + 1) + '/' + e.date.getFullYear()
		document.getElementById('dat_fecha_monta').value = fechaTexto
		fechaEstimadaParto.setMonth((fechaEstimadaParto.getMonth()) + 9)
		var $datepicker = $('#dat_fecha_parto');
		$datepicker.datepicker();
		$datepicker.datepicker('setDate', fechaEstimadaParto);


	});
	$("#dat_fecha_monta").blur(function () {
		document.getElementById('dat_fecha_monta').value = fechaTexto

	});

	$("#dat_fecha_monta_edit").datepicker().on('changeDate', function (e) {
		console.log('Holaaa')
		var fechaEstimadaParto = new Date(e.date.getFullYear(), e.date.getMonth(), e.date.getDate())
		fechaTextoEdit = e.date.getDate() + '/' + (e.date.getMonth() < 9 ? '0' : '') + ((e.date.getMonth()) + 1) + '/' + e.date.getFullYear()
		document.getElementById('dat_fecha_monta_edit').value = fechaTextoEdit
		console.log(fechaEstimadaParto)
		fechaEstimadaParto.setMonth((fechaEstimadaParto.getMonth()) + 9)
		console.log('+9 ' + fechaEstimadaParto)

		var $datepicker = $('#dat_fecha_parto_edit');
		$datepicker.datepicker();
		$datepicker.datepicker('setDate', fechaEstimadaParto);
	});
	$("#dat_fecha_monta_edit").blur(function () {
		document.getElementById('dat_fecha_monta_edit').value = fechaTextoEdit
	});


});



function cargar_datos() {
	mostrar_mensaje("Consultando datos");
	var datos = { "consultar_info": "si_consultala" }
	$.ajax({
		dataType: "json",
		method: "POST",
		url: '../Controladores/Json_prenez.php',
		data: datos,
	}).done(function (json) {
		console.log("EL consultar", json);
		console.log("esto el status: ", json[4]);
		$("#datos_tabla").empty().html(json[1]);
		$('#tabla_preñez').DataTable();
		$('#md_registrar_prenez').modal('hide');
		$('#md_actualizar_prenez').modal('hide');


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


	})
}

