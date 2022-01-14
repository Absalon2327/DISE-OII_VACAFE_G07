$('#formulario_r_compras_p').css("display","none");
$('#msg_decimales').css("display","none");
$('#formulario_b_compras').css("display","block");
$("#proveedor_r_compras_b").prop("disabled", true);
$("#categoria_r_compras_b").prop("disabled", true);
cargar_proveedores_b();

console.log("esta funcionando el js");

$(function(){

        var fecha_hoy_inicio = new Date();
        $(".form_datetime_inicio").datetimepicker({
                format: 'd-mm-yyyy HH:ii:ss',
               // endDate: fecha_hoy_inicio,
                todayBtn: true
        });
        var fecha_hoy_fin = new Date();
        $(".form_datetime_fin").datetimepicker({
                format: 'd-mm-yyyy HH:ii:ss',
                //startDate: fecha_hoy_fin,
                todayBtn: true
        });

        

        document.getElementById("rbtn_categoria").onclick = function(){
                if (document.getElementById("categoria_r_compras_b").disabled){
                       document.getElementById("categoria_r_compras_b").disabled = false;
                       
                }else{
                      document.getElementById("categoria_r_compras_b").disabled = true;
                }
        }

       document.getElementById("rbtn_proveedor").onclick = function(){
                if (document.getElementById("proveedor_r_compras_b").disabled){
                       document.getElementById("proveedor_r_compras_b").disabled = false;
                }else{
                      document.getElementById("proveedor_r_compras_b").disabled = true;
                }
        }        
        


 	$(document).on("click",".btn_compras_proveedor",function(e){ 
                e.preventDefault();
                console.log("si llega");
                $('#formulario_r_compras_p').css("display","block");
                $('#formulario_b_compras').css("display","none");
                cargar_proveedores();
        });

        $(document).on("click",".btn_compras_bovinos",function(e){ 
                e.preventDefault();
                console.log("si llega");
                $('#formulario_r_compras_p').css("display","none");
                $('#formulario_b_compras').css("display","block");
                cargar_proveedores();
        });

        $(document).on("submit","#formulario_r_compras_p",function(e){
                e.preventDefault();
                var datos = $("#formulario_r_compras_p").serialize();

                
                var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3500
                });
                var Toast1 = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3500
                });
                console.log("Entro aqui");
                var fecha_inicio = $("#fecha_inicio_r_compras").val();
                var fecha_fin = $("#fecha_fin_r_compras").val();

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
                if ($("#proveedor_r_compras").val() == "Seleccione"){
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione un Proveedor'
                        });
                        return;
                }
                if ($("#fecha_inicio_r_compras").val() == "" && $("#fecha_fin_r_compras").val() == ""){
                        Toast.fire({
                        icon: 'info',
                        title: 'Seleccione Fechas'
                    });
                        return;
                }
                if ($("#fecha_inicio_r_compras").val() == ""){                        
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione una fecha de incio'
                        });
                        return;
                }
                if ($("#fecha_fin_r_compras").val() == "") {
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione una fecha final'
                        });
                        return;
                }

                console.log("los datos: ",datos);
               
                mostrar_mensaje("Generando Reporte","Espere un Momento");
              
                
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url:'../Controladores/reporte_compras_controlador.php',
                    data : datos,
                }).done(function(json) {
                        console.log("EL GUARDAR",json); 

                        var timer = setInterval(function(){
                                if (json[0]=="Exito") {
                                        console.log("sql",json[2]);

                                        
                                               var win = window.open("http://localhost/poryecto_DISEÑOII/DISEÑOII_VACAFE_G07/reportes/r_reporte_proveedor_compras.php?fei="+json[1]+"&fef="+json[2]+"&idp="+json[3], '_blank');
                                                // Cambiar el foco al nuevo tab (punto opcional)
                                                win.focus();
                                                
                                       
                                      console.log("NO entra");

                                }else{
                                        console.log("termino? ", termino);
                                        if (termino == "si") {
                                                Toast1.fire({
                                                    icon: 'info',
                                                    title: 'No hay compras registradas con este proveedor!'
                                                });
                                        }
                                }
                        clearTimeout(timer);
                        },3500);
                });
        });

        $(document).on("click",".btn_limpiar",function(e){ 
                e.preventDefault();
                console.log("si llega");
                $('#formulario_r_compras_p').trigger('reset');
                
        });


});

function cargar_proveedores(){
        var datos = {"consultar_info":"si_consultala"}
        $.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/reporte_compras_controlador.php',
        data : datos,
    }).done(function(json) {
        

        $("#proveedor_r_compras").empty().html(json[1][0]);         
    }).fail(function(){

    }).always(function(){
        //Swal.close();
    });
}

function cargar_proveedores_b(){
        var datos = {"consultar_info":"si_consultala"}
        $.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/reporte_compras_controlador.php',
        data : datos,
    }).done(function(json) {
        

        $("#proveedor_r_compras_b").empty().html(json[1][0]);         
    }).fail(function(){

    }).always(function(){
        //Swal.close();
    });
}



function mostrar_mensaje(titulo,mensaje=""){
       
        Swal.fire({
          title: titulo,
          html: mensaje,
          allowOutsideClick: false,
          icon:'info',
          timerProgressBar: true,
          timer: 3500,         
          didOpen: () => {
            Swal.showLoading()
             
          },
          willClose: () => {
               
                
          }
        }).then((result) => {
          
           
        });
}