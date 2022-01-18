cargar_datos();
$(function () {
	//$('#formulario_registro').parsley();

	var fecha_hoy = new Date();
	$('#dat_fecha_nacimiento').datepicker({
		format: "dd/mm/yyyy",
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

	$('#formulario_registroN').validate({
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

	$(document).on("click", ".btn_cerrar_class", function (e) {
		e.preventDefault();
		$("#formulario_registroN").trigger('reset');
		$('#md_registrar_Natalidad').modal('hide');
	});

	$(document).on("click", ".btn_editar", function (e) {

		e.preventDefault();
		mostrar_mensaje("Consultando datos");
		var id = $(this).attr("data-int_id_natalidad");
		console.log("El id es: ", id);
		var datos = { "consultar_info": "si_nombre_especifico", "int_id_natalidad": id }
		$.ajax({
			dataType: "json",
			method: "POST",
			url: '../Controladores/Json_natalidad.php',
			data: datos,
		}).done(function (json) {
			console.log("EL consultar especifico", json);
			if (json[0] == "Exito") {
				var fecHA_string = json[2]['dat_fecha_nacimiento'];
				var porciones = fecHA_string.split('-');
				var fecha = porciones[2] + "/" + porciones[1] + "/" + porciones[0]
				$('#llave_natalidad').val(id);
				$('#ingreso_datos').val("si_actualizalo");
				$('#dat_fecha_nacimiento').val(fecha);
				$('#int_id_expe_madre').val(json[2]['int_id_expe_madre']);
				$('#int_id_expe_ternero').val(json[2]['int_id_expe_ternero']);
				$('#md_registrar_Natalidad').modal('show');
			}

		}).fail(function () {

		}).always(function () {
			Swal.close();
		});


	});




	$(document).on("submit", "#formulario_registroN", function (e) {
		e.preventDefault();
		var datos = $("#formulario_registroN").serialize();
		
		var Toast = Swal.mixin({
			toast: true,
			position: 'center',
			showConfirmButton: false,
			timer: 1500
		});
			if ($("#int_id_expe_madre").val() == "Seleccione") {
			Toast.fire({
				icon: 'info',
				title: 'Seleccione la madre'
			});
			return;
		}
		if ($("#int_id_expe_ternero").val() == "Seleccione") {
			Toast.fire({
				icon: 'info',
				title: 'Seleccione el Hijo'
			});
			return;
		}
		console.log("Imprimiendo datos: ", datos);
		//mostrar_mensaje("Almacenando información","Por favor no recargue la página");
		$.ajax({
			dataType: "json",
			method: "POST",
			url: '../Controladores/Json_natalidad.php',
			data: datos,
		}).done(function (json) {
			console.log("EL GUARDAR", json);
			if (json[0] == "Exito") {
				$('#md_registrar_Natalidad').modal('hide');
				$("#formulario_registroN").trigger('reset');
					setTimeout(function (s) {
					 Toast.fire({
							icon: 'success',
							title: 'Natalidad Registrada!.'
						})
					
				}, 500)
					var timer = setInterval(function(){
						$(location).attr('href','../Vistas/v_natalidad.php');
						clearTimeout(timer);
					},3500);

			}else if (json[1]=="Ternero asignado a la vaca") {
	    		Toast.fire({
		            icon: 'error',
		            title: 'El Ternero ya fue asignado a su madre'
		        });
		        return;
	    	}else if (json[1]=="consulta"){
	    	 	Toast.fire({
		            icon: 'error',
		            title: 'Error en la consulta!'
		        });
		        return;
	    	}


			
		}).fail(function () {

		}).always(function () {
			
		});


	});

	$(document).on("change", "#int_id_expe_madre", function (e) {
		e.preventDefault();
		if ($("#int_id_expe_madre").val() != "0") {
			var id = $("#int_id_expe_madre").val();
			console.log('se buscara ka vaca ' + id)
			var datos = { "consultar_parto": "fecha", "idExpediente": id }
			$.ajax({
				dataType: "json",
				method: "POST",
				url: '../Controladores/Json_natalidad.php',
				data: datos,
			}).done(function (json) {
				console.log("RESULTADO CONSULTA FECHA", json);
				if (json[0] == "Exito") {
					document.getElementById('dat_fecha_nacimiento').value = json[1]
				}

			}).fail(function () {

			}).always(function () {
				Swal.close();
			});
		}else{
			document.getElementById('dat_fecha_nacimiento').value = ''
		}
	});
});


function cargar_datos() {
	mostrar_mensaje("Consultando datos");
	var datos = { "consultar_info": "si_consultala" }
	$.ajax({
		dataType: "json",
		method: "POST",
		url: '../Controladores/Json_natalidad.php',
		data: datos,
	}).done(function (json) {
		console.log("EL consultar", json);
		$("#datos_tabla").empty().html(json[1]);
		$('#tabla_natalidad').DataTable();
		$('#md_registrar_natalidad').modal('hide');
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

