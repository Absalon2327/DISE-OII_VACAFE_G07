console.log("funciona");
$("#formulario_vista_gasto").css("display","block");
$("#cbx_proveedor").prop("disabled", true);
cargar_proveedores();
cargar_insumos();
grafico();
$(function (){

      var fecha_hoy_inicio = new Date();
      $(".form_datetime_inicio").datetimepicker({
          format: 'd-mm-yyyy h:ii:ss',
            // endDate: fecha_hoy_inicio,
            todayBtn: true
          });
      var fecha_hoy_fin = new Date();
      $(".form_datetime_fin").datetimepicker({
            format: 'd-mm-yyyy h:ii:ss',
            //startDate: fecha_hoy_fin,
            todayBtn: true
      });
  document.getElementById("rbtn_todos").onclick = function(){
    if (document.getElementById("cbx_insumos").disabled){
        document.getElementById("cbx_insumos").disabled = false;
      }else{
        document.getElementById("cbx_insumos").disabled = true;
    }
  }

  document.getElementById("rbtn_todos_proveedores").onclick = function(){
    if (document.getElementById("cbx_proveedor").disabled){
        document.getElementById("cbx_proveedor").disabled = false;
      }else{
        document.getElementById("cbx_proveedor").disabled = true;
    }
  }


	$(document).on("submit","#formulario_gasto_filtro",function(e){
		e.preventDefault();
		var datos = $("#formulario_gasto_filtro").serialize();
		console.log("fecha inicio: ", $("#fecha_inicio").val());

                var fecha_inicio = $("#fecha_inicio").val();
                var fecha_fin = $("#form_datetime_fin").val();

                console.log("Inicio", fecha_inicio);
                console.log("Fin", fecha_fin);

                var f1 = new Date(fecha_inicio);
                var f2 = new Date(fecha_fin);

                console.log("F1", f1);
                console.log("F2", f2);

                if (f1.getTime() > f2.getTime()){
                        Toast1.fire({
                                icon: 'error',
                                title: 'La fecha final no puede ser menor que la incial'
                        });
                        return;
                }
                if (($("#cbx_proveedor").val() == "Seleccione") && (document.getElementById("cbx_proveedor").disabled == false)){
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione un Proveedor'
                        });
                        return;
                }
                if ($("#fecha_inicio").val() == "" && $("#form_datetime_fin").val() == ""){
                        Toast.fire({
                        icon: 'info',
                        title: 'Seleccione Fechas'
                    });
                        return;
                }
                if ($("#fecha_inicio").val() == ""){                        
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione una fecha de incio'
                        });
                        return;
                }
                if ($("#form_datetime_fin").val() == "") {
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione una fecha final'
                        });
                        return;
                }

		$.ajax({
          dataType: "json",
          method: "POST",
          url:'../Controladores/reporte_ventas_general_controlador.php',
          data : datos,
        }).done(function(json) {
          console.log("EL GUARDAR",json); 
          if (json[0]=="Exito") {
            grafico();
          }else{
            Toast1.fire({
              icon: 'info',
              title: 'No hay ventas registradas!'
            });
          }
        });
	});

	 
});

function grafico(){
    //-------------
    //- DONUT CHART -
    //-------------insumos,datos
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#grafico_gastos').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Galón de Gasolina',
          'Manojo de Zacate',
          'Agua',
          'Sal',
          'Concentrado',
      ],
      datasets: [
        {
          data: [700,500,400,600,300],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })
}

function generarLetra(){
  var letras = ["a","b","c","d","e","f","0","1","2","3","4","5","6","7","8","9"];
  var numero = (Math.random()*15).toFixed(0);
  return letras[numero];
}
  
function colorHEX(){
  var coolor = "";
  for(var i=0;i<6;i++){
    coolor = coolor + generarLetra() ;
  }
  return "#" + coolor;
}

function cargar_proveedores(){
        var datos = {"consultar_info":"si_consultala"}
        $.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/gasto_registro_controlador.php',
        data : datos,
    }).done(function(json) {
        

        $("#cbx_proveedor").empty().html(json[1][0]);         
    }).fail(function(){

    }).always(function(){
        //Swal.close();
    });
}
function cargar_insumos(){
        var datos = {"consultar_info":"si_consultala"}
        $.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/gasto_registro_controlador.php',
        data : datos,
    }).done(function(json) {
        

        $("#cbx_insumos").empty().html(json[2][0]);         
    }).fail(function(){

    }).always(function(){
        //Swal.close();
    });
}

