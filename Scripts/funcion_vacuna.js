let modificar = false
$(function (){
	//$('#addvacuna').parsley();
	
	cargar_datos();
	$(document).on("click",".btn_cerrar_class",function(e){
		e.preventDefault();
		$("#addvacuna").trigger('reset');
		$('#modalAddvacuna').modal('hide');


	});
	var fecha_hoy = new Date(); 
	var fecha_mañana = new Date(); 
	$('#fecha_aplicacion').datepicker({
	   	format: "dd/mm/yyyy",
	    todayBtn: true,
	    clearBtn: false,
	    language: "es",
	    calendarWeeks: true,
	    autoclose: true,
	    todayHighlight: true,
	    endDate:fecha_hoy
	});
		//NUEVO CODIGO
	$(document).on("click", ".btn_abrir_modal_v", function (e) {
		e.preventDefault();
		document.getElementById('exampleModalLabel').innerText = 'Administración de Medicamento'
		document.getElementById('boton_enviar').innerText = 'Guardar'
	
		document.getElementById('ingreso_datos').value = 'si_registro'
	
		modificar = false
		$('#modalAddvacuna').modal('show');

	});
	$(document).on("click",".btn_editar",function(e){

		e.preventDefault(); 
	 //	mostrar_mensaje("Consultando datos");
	 	document.getElementById('exampleModalLabel').innerText = 'Editar Control de Vacunas'
		document.getElementById('boton_enviar').innerText = 'Modificar'
		var int_id_control_vac = $(this).attr("data-int_id_control_vac");
		console.log("El id es: ",int_id_control_vac);
		var datos = {"consultar_info":"si_condui_especifico","int_id_control_vac":int_id_control_vac}
		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'../Controladores/vacuna_controlador_Json.php',
	        data : datos,
	    }).done(function(json) {
	    	console.log("EL consultar especifico",json);
	    	if (json[0]=="Exito") {

	    		var fecHA_string = json[2]['dat_fecha_aplicacion'];
				var porciones = fecHA_string.split('-');
	    		var fecha = porciones[2]+"/"+porciones[1]+"/"+porciones[0]
	    		$('#llave_vacuna').val(int_id_control_vac);
	    		$('#ingreso_datos').val("si_actualizalo");
	    		$('#exped_aplicado').val(json[2]['id_exped_aplicado']);
	    		$('#fecha_aplicacion').val(fecha);
	    		$('#vacuna').val(json[2]['nva_vacuna_aplicada']);
	    		$('#dosis').val(json[2]['nva_dosis']);
	    	   document.getElementById('ingreso_datos').value = 'si_actualizalo'
				modificar = true
	    		$('#modalAddvacuna').modal('show');

	    	}
	    	 
	    }).fail(function(){

	    }).always(function(){
	    	Swal.close();
	    });


	});
    $('#addvacuna').validate({
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


	$(document).on("submit","#addvacuna",function(e){
		e.preventDefault();
		var datos = $("#addvacuna").serialize();
			var Toast = Swal.mixin({
	        toast: true,
	        position: 'top-end',
	        showConfirmButton: false,
	        timer: 1500
    	});
			if ($("#id_exped_aplicado").val() == "Seleccione"){
	 			Toast.fire({
			        icon: 'info',
			        title: 'Debe elegir el  bovino'
			    });
				return;
 			}
 			if ($("#vacuna").val() == "Seleccione"){
	 			Toast.fire({
			        icon: 'info',
			        title: 'Debe elegir la vacuna'
			    });
			return;
 		}
		console.log("Imprimiendo datos: ",datos);
		$.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/vacuna_controlador_Json.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);
        	if (json[0] == "Exito") {
        		$('#modalAddvacuna').modal('hide');
				document.getElementById('addvacuna').reset()
				setTimeout(function (s) {
					if (modificar) {
						Toast.fire({
							icon: 'success',
							title: 'Control de vacuna Modificado!.'
						})
					} else {
						Toast.fire({
							icon: 'success',
							title: 'Control de vacuna Registrado!.'
						})
					}
				
				},500)
         $("#modalAddvacuna").trigger('reset');//ver aqui en modal o addmodal
				cargar_datos();
        	}else if (json[1]=="Medicamento aplicado") {
	    		Toast.fire({
		            icon: 'error',
		            title: 'El bovino ya fue vacunado con este medicamento en esta fecha'
		        });
		        return;
	    	}else if (json[1]=="consulta"){
	    	 	Toast.fire({
		            icon: 'error',
		            title: 'Error en la consulta!'
		        });
		        return;
	    	}
        	
       
        });


	});
});

function cargar_datos(){
	//mostrar_mensaje("Consultando datos");
	var datos = {"consultar_info":"si_consultala"}
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/vacuna_controlador_Json.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    	$("#tabla_vacuna").empty().html(json[1]);
    	$('#example1').DataTable();
    	$('#modalAddvacuna').modal('hide');
    }).fail(function(){

    }).always(function(){
    	Swal.close();
    });
}
function mostrar_mensaje(titulo,mensaje=""){
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


