

console.log("funcionando");
$(function (){	
	cargar_gastos();

	var fecha_hoy = new Date();
	$(".form_datetime").datetimepicker({
		format: 'd-mm-yyyy HH:ii:ss',
		endDate: fecha_hoy,
		todayBtn: true
	});
	
	$('#formulario_gasto').validate({
	    rules: {
	      email: {
	        required: true,
	        email: true,
	      },
	      password: {
	        required: true,
	        minlength: 5
	      },
	      terms: {
	        required: true
	      },
	    },
	    messages: {
	      email: {
	        required: "Por favor ingresa un email",
	        email: "Por favor ingresa un email valido"
	      },
	      password: {
	        required: "Please provide a password",
	        minlength: "Your password must be at least 5 characters long"
	      },
	      terms: "Please accept our terms"
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

	$(document).on("change", "#cbx_insumo", function (e) {
		e.preventDefault();
		var idcbxpro = $("#cbx_insumo").val();
		var datos = {"consulta_existencia":"si_consultala","idProducto":idcbxpro};
		var Toast = Swal.mixin({
	        toast: true,
	        position: 'top-end',
	        showConfirmButton: false,
	        timer: 5000
    	});
    	
		console.log("Imprimiendo datos: ",datos);		
		$.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/gastos_controlador.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);        	
	        if (json[0]=="Exito") {	    	 	
				$("#exitencia_actual").val(json[2]['int_existencia']);
	        	if (json[2]['int_existencia'] == 0) {
	        		$("#msg_existencia_actual").removeClass("text-success").addClass("text-danger");
	    			$("#icono_exis").removeClass("fas fa-check").addClass("icon fas fa-exclamation-triangle");
	    			$("#icono_color").removeClass("text-success").addClass("text-danger");
	    			$("#msg_existencia_actual").empty().html("Existencia actual: "+json[2]['int_existencia']);

	        	}else{
	        		$("#msg_existencia_actual").removeClass("text-danger").addClass("text-success");
	    			$("#icono_exis").removeClass("icon fas fa-exclamation-triangle").addClass("fas fa-check");
	    			$("#icono_color").removeClass("text-danger").addClass("text-success");
	        		$("#msg_existencia_actual").empty().html("Existencia actual: "+json[2]['int_existencia']);
	        	}
       			
	    	}else{

	    	}
        });
	});

	$(document).on("click",".btn_anular_gasto",function(e){

		e.preventDefault();
		var idpro = $(this).attr("data-pro"); 
		var idgasto = $(this).attr("data-idgasto");		
		var exist_gastada = $(this).attr("data-existencia");

		$('#idpro').val(idpro);	
		$('#idgasto').val(idgasto);		
		$('#existencia').val(exist_gastada);
		$('#md_anular_gasto').modal('show');

	});

	$(document).on("submit","#formulario_gasto",function(e){
		e.preventDefault();
		var datos = $("#formulario_gasto").serialize();
		var Toast = Swal.mixin({
	        toast: true,
	        position: 'top-end',
	        showConfirmButton: false,
	        timer: 5000
    	});

    	if ($("#exitencia_actual").val() == 0) {
    		if ($("#cantidad_insumo").val() >= $("#exitencia_actual").val()) {
    			$('#md_existencias').modal('show');
    			return;
    		}
    	}
    	
		console.log("Imprimiendo datos: ",datos);		
		$.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/gastos_controlador.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);        	
	        if (json[0]=="Exito") {	    	 	
					    	
		    	$("#formulario_gasto").trigger('reset');
				$('#mod_add_gasto').modal('hide');
				
       			setTimeout(function (s) {
	       			Toast.fire({
				        icon: 'success',
				        title: 'Gasto registrado con exito!'
			    	});
			    }, 500);
		    	cargar_gastos();	
       			
	    	}else{
	    		setTimeout(function (s) {
		    	 	Toast.fire({
			            icon: 'error',
			            title: 'Error al registrar el gasto!'
			        });
			    }, 500);    
	    	}
	    	cargar_gastos();
        });
	});

	$(document).on("submit","#formulario_anular",function(e){
		e.preventDefault();
		var datos = $("#formulario_anular").serialize();
		var Toast = Swal.mixin({
	        toast: true,
	        position: 'top-end',
	        showConfirmButton: false,
	        timer: 5000
    	});
    	
		console.log("Imprimiendo datos: ",datos);		
		$.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/gastos_controlador.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);        	
	        if (json[0]=="Exito") {	    	 	
					    	
		    	$("#formulario_anular").trigger('reset');
				$('#md_anular_gasto').modal('hide');
				
       			setTimeout(function (s) {
	       			Toast.fire({
				        icon: 'success',
				        title: 'Gasto anulado con exito!'
			    	});
			    }, 500);
		    	cargar_gastos();	
       			
	    	}else{
	    		setTimeout(function (s) {
		    	 	Toast.fire({
			            icon: 'error',
			            title: 'Error al anular el gasto!'
			        });
			    }, 500);    
	    	}
	    	cargar_gastos();
        });
	});

	


});

function cargar_gastos(){

	var datos = {"consultar_info":"si_consultala"}

	$.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/gastos_controlador.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    	$("#tb_gasto").empty().html(json[1]); 
    	$("#cbx_insumo").empty().html(json[5][0]);
    	$('#example1').DataTable(); 

    }).fail(function(){

    }).always(function(){
    	Swal.close();
    });
}

