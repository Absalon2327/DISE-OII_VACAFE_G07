

function cargar_factura(){
	//mostrar_mensaje("Consultando datos");
	var datos = {"consultar_info":"si_esta"}
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/factura_previa_controlador.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    	if (json[0]=="Exito") {
    			var numero_factura = numerofactura(json[4]['int_idventa']);
	    		$('#vendedor_fact').empty().html(json[4]['nva_nom_empleado']);
	    		$('#nom_cliente_fact').empty().html(json[4]['nva_nom_cliente']);
	    		$('#dui_cliente_fact').empty().html(json[4]['nva_dui_cliente']);
	    		$('#direc_cliente_fact').empty().html(json[4]['txt_direc_cliente']);
	    		$('#tel_cliente_fact').empty().html(json[4]['nva_telefono_cliente']);
	    		$('#num_fact').empty().html(numero_factura);
	    		$('#fecha_fact').empty().html(json[4]['nva_tipo_documento']);
	    		$('#tipo_doc').empty().html(json[4]['dat_fecha_venta']);   

	         	$("#tb_factura_ver").empty().html(json[2]);
	         
	         
	    }
    }).fail(function(){

    }).always(function(){
    	//Swal.close();
    });
}

	function numerofactura(numero){
		//divido la feha de la hora
		var cifras = numero;
		var numero_factura = "";		
		if (cifras.length == 1) {
			return numero_factura = "00000"+""+numero;
		}else if (cifras.length == 2) {
			return numero_factura = "0000"+""+numero;
		}else if (cifras.length == 3) {
			return numero_factura = "000"+""+numero;
		}else if (cifras.length == 4){
			return numero_factura = "00"+""+numero;
		}else if (cifras.length == 5){
			return numero_factura = "0"+""+numero;
		}else{
			return numero;
		}

	}
    function cargar_totales(){
		//mostrar_mensaje("Consultando datos");
		var datos = {"estos_totales":"si_estos"}
		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'../Controladores/factura_previa_controlador.php',
	        data : datos,
	    }).done(function(json) {
	    	console.log("EL consultar",json);
	    	
		    if (json[0]=="obtenido") {
				$("#tb_sumas_factura").empty().html(json[3]);
		    }   
	    }).fail(function(){

	    }).always(function(){
	    	//Swal.close();
	    });
	}

