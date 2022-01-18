let modificar = false
$(function (){
	console.log("funcionando");
	cargar_datos();

	var fecha_hoy = new Date(); 
	$('.datefechaleche').datepicker({
	    format: "dd-mm-yyyy",
	    todayBtn: true,
	    clearBtn: false,
	    language: "es",
	    calendarWeeks: true,
	    autoclose: true,
	    todayHighlight: true,
	    startDate:fecha_hoy
	});

	$('#addLeche').validate({
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

	//este eliminar
	$(document).on("click",".btn_baja",function(e){
		e.preventDefault();
		var id = $(this).attr("data-idcltbaja");
		var idpro_baja =$('#id_producto_baja').val(id); 
		$('#modalBajaProducto').modal('show');
		
	});
	
	$(document).on("submit","#confirmaBaja",function(e){
		e.preventDefault();
		var datos = $("#confirmaBaja").serialize();
		console.log("Imprimiendo datos: ",datos);
		console.log("#estado_productos");
		 var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 700000000
    	});
		$.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/productos_controlador.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);
        	cargar_datos();
        	 if (json[0]=="Exito") {
                	$('#modalBajaProducto').modal('hide');
	        		cargar_datos();
	        		Toast.fire({
                    icon: 'success',
                    title: 'Producto dado de baja con Exito!.'
                     });
                }else{                	
                    Toast.fire({
                    icon: 'error',
                    title: 'Error no se pudo actualizar!.'
                    });
                }
        });
    });

	//este editar
	$(document).on("click",".btn_editar",function(e){

		e.preventDefault(); 
		var id = $(this).attr("data-idbotella");	
		var idp = $(this).attr("data-idproducto");	
		console.log("El id es: ",id);
		var datos = {"consultar_info":"si_coneste_id","idbotella":id,"idproducto":idp}

		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'../Controladores/leche_controlador.php',
	        data : datos,
	    }).done(function(json) {
	    	console.log("EL consultar especifico",json);
	    	if (json[0]=="Exito") {	
	    	var fecHA_string = json[2]['dat_fecha_vencimiento_botella'];
				var porciones = fecHA_string.split('-');
				var fecha = porciones[2]+"-"+porciones[1]+"-"+porciones[0]   
	    		$('#llave_leche').val(id);
	    		$('#almacenar_datos').val("si_actualizalo");
	    		$('#botella_Leche').empty().html(json[3][0]);
	    		$('#cantidad_Leche').val(json[2]['int_cantidad']);
	    		$('#precio_Leche').val(json[2]['dou_costo_botella']);
	    		$('#fecha_Leche').val(fecha);		
	    		modificar = true
	    		$('#mod_add_leche').modal('show');
	    	}
	    	setTimeout(function (s) {
	        		Toast.fire({
                    icon: 'success',
                    title: 'Registro Modificado con Exito!.'
                     });
	        	}, 500);
	    	 
	    }).fail(function(){

	    }).always(function(){
	    	Swal.close();
	    });

	});

	$(document).on("click","#btn_nuevo_producto",function(e){
		e.preventDefault();
		$("#mod_add_leche").modal("show");
	});

//categoria
$(document).on("click","#registrar_leche",function(e){
		e.preventDefault();
		console.log("Capturando evento");
		//$('#myModal').modal('show'); para abrir modal
		//$('#myModal').modal('hide'); para cerrar modal
		$('#mod_add_leche').modal('show');

		$(".select2").select2({
	    }).on("select2:opening", 
	        function(){
	            $(".modal").removeAttr("tabindex", "-1");
	    }).on("select2:close", 
	        function(){ 
	            $(".modal").attr("tabindex", "-1");
	    });
    
	});


	$(document).on("submit","#addLeche",function(e){
		e.preventDefault();
		var datos = $("#addLeche").serialize();
		console.log("Imprimiendo datos: ",datos);
		console.log("#estado_productos");
		 var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 7000
    	});
		if ($("#botella_Leche").val() == "Seleccione"){
		 			Toast.fire({
				    icon: 'info',
				    title: 'Debe elegir un producto'
				    });
					return;
 		        }
 		        if ($("#precio_Leche").val() == "0" || $("#precio_Leche").val() < "0"){
		 			Toast.fire({
				    icon: 'info',
				    title: 'El Costo debe ser mayor o igual a 0'
				    });
					return;
 		        }
 		        if ($("#cantidad_Leche").val() == "0" || $("#precio_Leche").val() < "0"){
		 			Toast.fire({
				    icon: 'info',
				    title: 'La cantidad debe ser mayor a 0'
				    });
					return;
 		        }
		//mostrar_mensaje("Almacenando información","Por favor no recargue la página");
		$.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/leche_controlador.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);
        	cargar_datos();
        	 if (json[0]=="Exito") {
                	$("#cantidad_Leche").val("");
	                $("#fechav_Leche").val("");
	                $("#precio_Leche").val("");
	                $("#botella_Leche").val("");
	                $('#mod_add_leche').trigger('reset');
	        		cargar_datos();
	        		document.getElementById('addLeche').reset()
                setTimeout(function (s) {
	        		Toast.fire({
                    icon: 'success',
                    title: 'Datos registrados con Exito!.'
                     });
	        	}, 500);  
                }else if(modificar){
                	setTimeout(function (s) {
	        		Toast.fire({
                    icon: 'success',
                    title: 'Registro modificado con Exito!.'
                     });
	        	}, 500); 
                }else if(!modificar){
                	mostrar_mensaje("Error", "algo paso");
                }else{
                	console.error("Ocurrio un error");
                    Toast.fire({
                    icon: 'error',
                    title: 'Error!.'
                    });
                }
        	return false;
        });
    });
});

function cargar_datos(){
	//mostrar_mensaje("Consultando datos");
	var datos = {"consultar_info":"si_consultala"}
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/leche_controlador.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    	$("#tablaPro").empty().html(json[1]); 
    	$('#mod_add_leche').modal('hide');
    	$("#botella_Leche").empty().html(json[4][0]); 
    	
    	$('#example1').DataTable(); 
    }).fail(function(){

    }).always(function(){
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
	
