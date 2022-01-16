cargar_factura_ventas();

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


function cargar_factura_ventas(){
	//mostrar_mensaje("Consultando datos");
	var data_idventa = $('#idventa').val();
        console.log("Si se ejecuta",data_idventa);

        var datos = {"ver_venta":"si_esta","idventa":data_idventa};
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/registro_ventas_controlador.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    				var hora = formateartime(json[4]['dat_fecha_venta']);
		        	var fecha = formatearDate(json[4]['dat_fecha_venta']);
		        	var hora_sistema = formateartime(json[4]['dat_fecha_sistema_venta']);
		        	var fecha_sistema = formatearDate(json[4]['dat_fecha_sistema_venta']);

		        

		        	var num_fact = numerofactura(json[4]['int_num_doc']);

					var apellido_cliente_v = "";
	        		if (json[4]['nva_ape_cliente'] == null) {
		        		apellido_cliente_v = "";
		        	}else{
						apellido_cliente_v = json[4]['nva_ape_cliente'];
		        	}

	        		$('#tipo_doc_ver_fact').empty().html(json[4]['nva_tipo_documento']);
		    		$('#num_doc_ver_fact').empty().html('#'+num_fact);
		    		$('#fecha_fact').empty().html(fecha);
		    		$('#hora_fact').empty().html(hora);

		    		$('#nom_cliente_fact').empty().html(json[4]['nva_nom_cliente']+' '+apellido_cliente_v);
		    		$('#dui_cliente_fact').empty().html(json[4]['nva_dui_cliente']);
		    		$('#direc_cliente_fact').empty().html(json[4]['txt_direc_cliente']);
		    		$('#tel_cliente_fact').empty().html(json[4]['nva_telefono_cliente']);
		    		
					$('#vendedor_fact').empty().html(json[4]['nva_nom_empleado']+' '+json[4]['nva_ape_empleado']);
		    		$('#fecha_fact_sis').empty().html(fecha_sistema);
		    		$('#hora_fact_sis').empty().html(hora_sistema);

		    		$('#iva_aplicado').empty().html('$'+json[4]['dou_iva_venta']);
		    		$('#sub_total_fact').empty().html('$'+json[6]);
					$('#total_fact').empty().html('$'+json[4]['dou_total_venta']);
					 window.addEventListener("load", window.print());    	
    }).fail(function(){

    }).always(function(){
    	//Swal.close();
    });
}