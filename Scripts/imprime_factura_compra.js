cargar_factura_compras();

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

function formatearDate(date){
	//divido la feha de la hora
	var fecha_string = date;
	var separacion = fecha_string.split(' ');
	var fecha = separacion[0];
	var hora = separacion[1];
	var fecha_formateada = "";

	//Formteo la fecha
	var porciones_fecha = fecha.split('-');
	var fecha1 = porciones_fecha[2]+"-"+porciones_fecha[1]+"-"+porciones_fecha[0];

	//envio la fecha formateada
	fecha_formateada = fecha1;
	return fecha_formateada;

}
function formateartime(datetime){
	//divido la feha de la hora
	var fecha_string = datetime;
	var separacion = fecha_string.split(' ');
	var fecha = separacion[0];
	var hora = separacion[1];
	
	//envio la hora
	return hora;
}



function cargar_factura_compras(){
	//mostrar_mensaje("Consultando datos");
	var data_idcompra = $('#idcompra').val();
        console.log("Si se ejecuta",data_idcompra);

        var datos = {"ver_compra":"si_esta","idcompra":data_idcompra};
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/registro_compras_controlador.php',
        data : datos,
    }).done(function(json) {
    			console.log("EL consultar",json);
    		if (json[0]=="Exito") {
    			var fecha_compra = formatearDatetime(json[4]['dat_fecha_compra']);	        		
	        	var fecha_sistema = formatearDatetime(json[4]['dat_fecha_sistema']);


	    		$('#proveedor').empty().html(json[4]['nva_nom_proveedor']);
	    		$('#tipo_doc').empty().html(json[4]['nva_tipo_documento']);
	    		$('#num_doc').empty().html(json[4]['nva_numero_documento']);
	    		$('#descrip').empty().html(json[4]['txt_descrip_compra']);
	    		$('#fecha_compra').empty().html(fecha_compra);
	    		$('#fecha_sistema').empty().html(fecha_sistema);
	    		$('#total_compra').empty().html('$'+json[4]['dou_total_compra']);
	    		$('#iva_compra').empty().html('$'+json[4]['dou_iva_aplicado']);
	    		$('#sub_total_compra').empty().html('$'+json[6].toFixed(2));
	         	$("#tb_Detalle_Insumos_Ver").empty().html(json[2]);
				window.addEventListener("load", window.print());
			}else{
				console.log("error en: ",json);
			}    	
    }).fail(function(){

    }).always(function(){
    	//Swal.close();
    });

function formatearDatetime(datetime){
	//divido la feha de la hora
	var fecha_string = datetime;
	var separacion = fecha_string.split(' ');
	var fecha = separacion[0];
	var hora = separacion[1];
	var fecha_formateada = "";

	//Formteo la fecha
	var porciones_fecha = fecha.split('-');
	var fecha1 = porciones_fecha[2]+"-"+porciones_fecha[1]+"-"+porciones_fecha[0];

	//concateno la fecha formteada con la hora y un espacio
	fecha_formateada = fecha1+" "+hora;
	return fecha_formateada;

}
}