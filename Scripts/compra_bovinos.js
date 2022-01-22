	var impuesto=18;
	var cont=0;
	var detalles=0;
	var subtotal_todos = 0;
	$('#msg_decimales_compra_b').css("display","none");
$(function (){	

	cargar_tabla_bovinos();
	var fecha_hoy = new Date();
	$(".form_datetime_b").datetimepicker({
		format: 'd-mm-yyyy HH:ii:ss',
		endDate: fecha_hoy,
		todayBtn: true
	});
	
	$('#formulario_registro_compra_b').validate({
	    rules: {	     
	    },
	    errorElement: 'span',
	    errorPlacement: function (error, element) {
	      error.addClass('invalid-feedback');
	      element.closest('.form-group').append(error);
	    },
	    highlight: function (element, errorClass, validClass) {
	      $(element).addClass('is-invalid');
	    },
	    unhighlight: function (element, errorClass, validClass) {
	      $(element).removeClass('is-invalid');
	    }
	});


	$(document).on("submit","#formulario_registro_compra_b",function(e){
		e.preventDefault();
		var datos = $("#formulario_registro_compra_b").serialize();
		var Toast = Swal.mixin({
	        toast: true,
	        position: 'top-end',
	        showConfirmButton: false,
	        timer: 5000
    	});
    	
    	if ($("#proveedor_compra_b").val() == "Todos"){
 			Toast.fire({
		        icon: 'info',
		        title: 'Debe elegir un Proveedor'
		    });
			return;
 		} 		
		console.log("Imprimiendo datos: ",datos);
		$.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/compra_bovinos_controlador.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);        	
	        if (json[0]=="Exito") {
	        	limpiar();    	 	
				Toast.fire({
	            	icon: 'success',
	            	title: 'Compra registrada exitosamente!.'
       			});
       			var timer = setInterval(function(){
					$(location).attr('href','../Vistas/v_registro_compras.php');
					clearTimeout(timer);
				},3500);	
				

	    	}else if (json[0]=="Error" && json[1]=="ultimacompra"){
	    	 	Toast.fire({
		            icon: 'error',
		            title: 'No se pudo obtener la ultima compra!'
		        });
	    	 	
	    	}else if (json[0]=="Error" && json[1]=="en la insercion de la compra"){
	    	 	Toast.fire({
		            icon: 'error',
		            title: 'No se pudo registrar la compra!'
		        });
	    	 	
	    	}else{
	    	 	Toast.fire({
		            icon: 'info',
		            title: 'No ha seleccionado bovinos!'
		        });
	    	}
        	
        	
        });


	});

	//selecionando y añadiento el producto a la lista del detalle


	$(document).on("click",".btn_bovino_seleccionado",function(e){ 
        e.preventDefault();
        var elemento = $(this);
        var data_idexpe = elemento.attr('data-idbovino_seleccionado');
		var data_nombreb = elemento.attr('data-nombre_bovino_selec');
		var data_raza = elemento.attr('data-raza_bovino_selec');
		var data_foto = elemento.attr('data-foto_bovino_selec');


		
        console.log("viene este id: ",data_idexpe);
        console.log("bovino: ",data_nombreb);
        console.log("raza: ",data_raza);
        console.log("foto: ",data_foto);
        var Toast = Swal.mixin({
	        toast: true,
	        position: 'top-end',
	        showConfirmButton: false,
	        timer: 5000
    	});
		var costo_bovino_compra=1;
		var precio_venta=1;
		var cantidad=1;
		if (data_idexpe) {
			var subtotal=cantidad*costo_bovino_compra;
			var fila='<tr class="filas" id="fila'+cont+'">'+	        
	       '<td><input type="hidden" class="form-control" id="idexpediente[]" name="idexpediente[]" value="'+data_idexpe+'">'+data_nombreb+'</td>'+

	       	'<td class="text-center"><div class="product-image-thumb active"><img alt="Product Image" style="width: 89px; height: 81px;" src="'+data_foto+'"></div></td>'+

	       	'<td class="text-center"><span id="raza_bovino" name="raza_bovino" >'+data_raza+'</span> </td>'+

	        '<td><input type="number" autocomplete="off" class="form-control" min="0" step="00.01" name="costo_bovino_compra[]" id="costo_bovino_compra[]" value="'+costo_bovino_compra+'">'+

	        '<input type="hidden" autocomplete="off" class="form-control" name="cantidad[]" id="cantidad[]" value="'+cantidad+'">'+

	        '<span style="display:none" id="subtotal'+cont+'" name="subtotal" >'+subtotal+'</span>'+

	        '<input type="hidden" class="form-control" name="subtotal_guardar[]"  id="subtotal_guardar[]" value="'+subtotal+'">'+'</td>'+

	        '<td class="text-center project-actions"><button type="button" onclick="verificar_costo_comprar_b('+cont+')" class="btn btn-info"><i class="fa fa-sync-alt"></i></button>'+
	        
	        	'<button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')"><i class="fas fa-trash"></i></button>'+
	        '</td>'+
			'</tr>';
			cont++;
			subtotal_todos = subtotal_todos + subtotal;
			detalles++;
			$("#Subtotal_compra_vista").val("$"+subtotal_todos);
			$('#tablaDetalleBovinos').append(fila);
			//modificarSubtotales();
			$('#msg_decimales_compra_b').css("display","block");
			console.log("vuelve tener est: ",data_idexpe);
			
		}else{
			Toast.fire({
		        icon: 'error',
		        title: 'El ID no está llegando!'
		    });
	    	 	
		}
		
    });

    $(document).on("click",".btn_limpiar",function(e){
    	limpiar();
    });

    $('.validcion_solo_numeros_fact').keypress(function(e) {

        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==8) return true;
        else if (tecla==0 || tecla==9)  return true;
        // patron =/[0-9\s]/;// -> solo letras
        patron =/[0-9\s]/;// -> solo numeros
        te = String.fromCharCode(tecla);
        return patron.test(te);
  	});
  	$('.fecha_compra_val').keypress(function(e) {

        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==8) return true;
        else if (tecla==0 || tecla==9 || tecla==47 || tecla==58)  return true;
        // patron =/[0-9\s]/;// -> solo letras
        patron =/[0-9\s]/;// -> solo numeros
        te = String.fromCharCode(tecla);
        return patron.test(te);
  	});
  	

     
});

function verificar_costo_comprar_b(indice){	
	var costo_c_b=document.getElementsByName("costo_bovino_compra[]");
	
	var fila = $("#fila"+indice);
	console.log("fila: ",fila);

	if (costo_c_b[indice] < 0) {
		$('#md_costo_b').modal('show');
	}else{
		modificarSubtotales();
	}		

}

function limpiar(){
	$('#msg_decimales_compra_b').css("display","none");
	$("#formulario_registro_compra_b").trigger('reset');
	cont = cont-1;
	detalles=detalles-1;	
	$(".filas").remove();
}


function modificarSubtotales(){
	var cant=document.getElementsByName("cantidad[]");
	var prec=document.getElementsByName("costo_bovino_compra[]");
	var sub=document.getElementsByName("subtotal");

	
	for (var i = 0; i < cant.length; i++) {
		var inpC=cant[i];
		var inpP=prec[i];
		var inpS=sub[i];


		inpS.value=inpC.value*inpP.value;
		document.getElementsByName("subtotal")[i].innerHTML=inpS.value;
	}

	calcularTotales();
}

function calcularTotales(){
	var sub = document.getElementsByName("subtotal");
	var subt  = 0.0;
	var total=0.0;

	for (var i = 0; i < sub.length; i++) {
		total += document.getElementsByName("subtotal")[i].value;
		subt = subt + document.getElementsByName("subtotal")[i].value;
	}

	if ($("#tipo_doc_compra_b").val() == "Crédito Fiscal"){
 							
			total = (parseFloat(subt) + parseFloat(subt*0.13)).toFixed(2);
			iva = total-subt;
			$("#iva_compra_vista_b").val("$"+iva.toFixed(2));
			$("#iva_guardar_b").val(iva);

			$("#total_compra_vista_b").val("$"+total);
			$("#total_compra_guardar_b").val(total);

 		}else{
 			$("#total_compra_vista_b").val("$"+total);
			$("#total_compra_guardar_b").val(total);
 		}
	
 		$("#subtotal_compra_vista_b").val("$"+subt.toFixed(2));
		$("#subtotal_guardar_b").val(subt);
	evaluar();
}

function evaluar(){

	if (detalles>0) 
	{
		$("#btnGuardar").show();
	}
	else
	{
		$("#btnGuardar").hide();
		cont=0;
	}
}

function eliminarDetalle(indice){
	$("#fila"+indice).remove();
	calcularTotales();
	cont = cont-1;
	detalles=detalles-1;
	if (cont >= 1 ) {
		$('#msg_decimales_compra_b').css("display","block");
	}else{
		$('#msg_decimales_compra_b').css("display","none");
	}

}

function cargar_tabla_bovinos(){
	//mostrar_mensaje("Consultando datos");
	var datos = {"consultar_info":"si_consultala"}
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/compra_bovinos_controlador.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    	$("#tb_seleccion_bovino").empty().html(json[1]);
    	$('#example1').DataTable(); 

    	$("#proveedor_compra_b").empty().html(json[5][0]);    	
    }).fail(function(){

    }).always(function(){
    	//Swal.close();
    });
}