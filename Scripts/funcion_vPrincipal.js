
$(function () {
	cargarDatos();
	function cargarDatos() {
		var datos = { "consultar_info": "si_consultala" }
		$.ajax({
			dataType: "json",
			method: "POST",
			url: '../Controladores/controlador_principal.php',
			data: datos,
		}).done(function (json) {

			if (json[0] == "Exito") {

				$("#alertas_preñez").empty().html(json[1]);

			}/*else if (json[0]=="2"){
		   
		   $("#alert_preñez").empty().html(json[1]);
		    	 	
		}else if (json[0]=="2"){
		   
		   $("#alert_preñez").empty().html(json[1]);
		    	 	
		} */
		}).fail(function () {

		}).always(function () {
			//Swal.close();
		});

	}


	$(document).on("click", ".btn_ok", function (e) {
		e.preventDefault();
		var id = $(this).attr("data-int_id_preñez");
		console.log('CAMBIAR A PARIDA EL ID ' + id)
		var datos = { "cambiar_estado": "cambio_estado", "idPrenez": id }
		$.ajax({
			dataType: "json",
			method: "POST",
			url: '../Controladores/Json_prenez.php',
			data: datos,
		}).done(function (json) {
			console.log("RESULTADO CAMBIO DE ESTADO", json);
			if (json[0] == "Exito") {

				cargarDatos();
			}

		}).fail(function () {

		}).always(function () {
			Swal.close();
		});

	});
});
