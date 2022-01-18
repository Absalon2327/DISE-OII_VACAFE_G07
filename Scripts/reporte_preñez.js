$('#formulario_r_preñez').css("display","none");
$('#msg_decimales').css("display","none");
$('#formulario_r_baja').css("display","none");
$('#formulario_natalidad').css("display","block");
$("#proveedor_r_compras_b").prop("disabled", true);
$("#formulario_r_preñez").prop("disabled", true);
$('#formulario_vacuna').css("display","none");
cargar_nombre();
console.log("esta funcionando el js");

$(function(){
               
 	      $(document).on("click",".btn_preñez",function(e){ 
                e.preventDefault();
                console.log("si llega");
                $('#formulario_r_preñez').css("display","block");
                $('#formulario_natalidad').css("display","none");
                 $('#formulario_r_baja').css("display","none");
                 $('#formulario_vacuna').css("display","none");
                
                cargar_proveedores();
            });

        $(document).on("click",".btn_natalidad",function(e){ 
                e.preventDefault();
                console.log("si llega");
                $('#formulario_r_preñez').css("display","none");
                $('#formulario_natalidad').css("display","block");
                $('#formulario_r_baja').css("display","none");
                $('#formulario_vacuna').css("display","none");
                
                 cargar_nombre();
        });
         $(document).on("click",".btn_dar_baja",function(e){ 
                e.preventDefault();
                console.log("si llega");
                $('#formulario_r_preñez').css("display","none");
                $('#formulario_natalidad').css("display","none");
                $('#formulario_r_baja').css("display","block");
                  $('#formulario_vacuna').css("display","none");
                cargar_nombre();
        });
          $(document).on("click",".btn_vacunas",function(e){ 
                e.preventDefault();
                console.log("si llega");
                $('#formulario_r_preñez').css("display","none");
                $('#formulario_natalidad').css("display","none");
                $('#formulario_r_baja').css("display","none");
               $('#formulario_vacuna').css("display","block");
                cargar_nombre();
        });

        $(document).on("submit","#formulario_r_preñez",function(e){
                e.preventDefault();
                var datos = $("#formulario_r_preñez").serialize();

                
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
              

                if ($("#raza_r").val() == "Seleccione"){
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione un Proveedor'
                        });
                        return;
                }
              

                console.log("los datos: ",datos);
               
                mostrar_mensaje("Generando Reporte","Espere un Momento");
              
                
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url:'../Controladores/reporte_preñez_controlador.php',
                    data : datos,
                }).done(function(json) {
                        console.log("EL GUARDAR",json); 

                        var timer = setInterval(function(){
                                if (json[0]=="Exito") {
                                        console.log("sql",json[2]);

                                        
                                               var win = window.open("http://localhost/FINCA_VACA_CAFE/reportes/r_reporte_preñez.php?idraza="+json[1], '_blank');
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

        $(document).on("submit","#formulario_vacuna",function(e){
                e.preventDefault();
                var datos = $("#formulario_vacuna").serialize();

                
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
              

                if ($("#idexpe").val() == "Seleccione"){
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione un Proveedor'
                        });
                        return;
                }
              

                console.log("los datos: ",datos);
               
                mostrar_mensaje("Generando Reporte","Espere un Momento");
              
                
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url:'../Controladores/reporte_vacunas_controlador.php',
                    data : datos,
                }).done(function(json) {
                        console.log("EL GUARDAR",json); 

                        var timer = setInterval(function(){
                                if (json[0]=="Exito") {
                                        console.log("sql",json[2]);

                                        
                                               var win = window.open("http://localhost/FINCA_VACA_CAFE/reportes/r_reporte_vacuna.php?idexpe="+json[1], '_blank');
                                                // Cambiar el foco al nuevo tab (punto opcional)
                                                win.focus();
                                                
                                       
                                      console.log("NO entra");

                                }else{
                                        console.log("termino? ", termino);
                                        if (termino == "si") {
                                                Toast1.fire({
                                                    icon: 'info',
                                                    title: 'No hay bovinos registrados!'
                                                });
                                        }
                                }
                        clearTimeout(timer);
                        },3500);
                });
        });
         $(document).on("submit","#formulario_natalidad",function(e){
                e.preventDefault();
                var datos = $("#formulario_natalidad").serialize();

                
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
              

                if ($("#idexpe").val() == "Seleccione"){
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione un Proveedor'
                        });
                        return;
                }
              

                console.log("los datos: ",datos);
               
                mostrar_mensaje("Generando Reporte","Espere un Momento");
              
                
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url:'../Controladores/reporte_natalidad_controlador.php',
                    data : datos,
                }).done(function(json) {
                        console.log("EL GUARDAR",json); 

                        var timer = setInterval(function(){
                                if (json[0]=="Exito") {
                                        console.log("sql",json[2]);

                                        
                                               var win = window.open("http://localhost/FINCA_VACA_CAFE/reportes/r_reporte_natalidad.php?idexpe="+json[1], '_blank');
                                                // Cambiar el foco al nuevo tab (punto opcional)
                                                win.focus();
                                                
                                       
                                      console.log("NO entra");

                                }else{
                                        console.log("termino? ", termino);
                                        if (termino == "si") {
                                                Toast1.fire({
                                                    icon: 'info',
                                                    title: 'No hay bovinos registrados!'
                                                });
                                        }
                                }
                        clearTimeout(timer);
                        },3500);
                });
        });
         $(document).on("submit","#formulario_r_baja",function(e){
                e.preventDefault();
                var datos = $("#formulario_r_baja").serialize();

                
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
              

              
              

                console.log("los datos: ",datos);
               
                mostrar_mensaje("Generando Reporte","Espere un Momento");
              
                
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url:'../Controladores/reporte_mortalidad_controlador.php',
                    data : datos,
                }).done(function(json) {
                        console.log("EL GUARDAR",json); 

                        var timer = setInterval(function(){
                                if (json[0]=="Exito") {
                                        console.log("sql",json[2]);

                                        
                                               var win = window.open("http://localhost/FINCA_VACA_CAFE/reportes/r_reporte_mortalidad.php", '_blank');
                                                // Cambiar el foco al nuevo tab (punto opcional)
                                                win.focus();
                                                
                                       
                                      console.log("NO entra");

                                }else{
                                        console.log("termino? ", termino);
                                        if (termino == "si") {
                                                Toast1.fire({
                                                    icon: 'info',
                                                    title: 'No hay bovinos en mortalidad!'
                                                });
                                        }
                                }
                        clearTimeout(timer);
                        },3500);
                });
        });
});

function cargar_proveedores(){
        var datos = {"consultar_info":"si_consultala"}
        $.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/reporte_preñez_controlador.php',
        data : datos,
    }).done(function(json) {
    
        $("#raza_r").empty().html(json[1][0]);         
    }).fail(function(){

    }).always(function(){
        //Swal.close();
    });
}
function  cargar_nombre (){
        var datos = {"consultar_info":"si_consultala"}
        $.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/reporte_vacunas_controlador.php',
        data : datos,
    }).done(function(json) {
       

        $("#idexpe").empty().html(json[1][0]);  
        
         $("#idexpe_vacuna").empty().html(json[1][0]);        
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