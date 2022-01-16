$('#formulario_r_compras_p').css("display","none");
$('#formulario_b_compras').css("display","none");
$('#formulario_ins_compras').css("display","none");
$("#proveedor_r_compras_b").prop("disabled", true);
$("#categoria_r_compras_b").prop("disabled", true);
$("#proveedor_r_compras_ins").prop("disabled", true);
$("#categoria_r_compras_ins").prop("disabled", true);
cargar_proveedores_ins();
cargar_proveedores_b();

console.log("esta funcionando el js");

$(function(){

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
        document.getElementById("rbtn_proveedor_c").onclick = function(){
                if (document.getElementById("proveedor_r_compras").disabled == false){
                       document.getElementById("proveedor_r_compras").disabled = true;
                }else{
                      document.getElementById("proveedor_r_compras").disabled = false;
                }
        }
        document.getElementById("rbtn_categoria_ins").onclick = function(){
                if (document.getElementById("categoria_r_compras_ins").disabled){
                       document.getElementById("categoria_r_compras_ins").disabled = false;
                       
                }else{
                      document.getElementById("categoria_r_compras_ins").disabled = true;
                }
        }

        document.getElementById("rbtn_proveedor_ins").onclick = function(){
                if (document.getElementById("proveedor_r_compras_ins").disabled){
                       document.getElementById("proveedor_r_compras_ins").disabled = false;
                }else{
                      document.getElementById("proveedor_r_compras_ins").disabled = true;
                }
        }        
        


 	$(document).on("click",".btn_compras_proveedor",function(e){ 
                e.preventDefault();
                console.log("si llega");
                $('#formulario_r_compras_p').css("display","block");
                $('#formulario_b_compras').css("display","none");
                $('#formulario_ins_compras').css("display","none");
                cargar_proveedores();
        });

        $(document).on("click",".btn_compras_bovinos",function(e){ 
                e.preventDefault();
                console.log("si llega");
                $('#formulario_r_compras_p').css("display","none");
                $('#formulario_b_compras').css("display","block");
                $('#formulario_ins_compras').css("display","none");
                cargar_proveedores();
        });
        $(document).on("click",".btn_compras_insumos",function(e){ 
                e.preventDefault();
                console.log("si llega");
                $('#formulario_ins_compras').css("display","block");
                $('#formulario_r_compras_p').css("display","none");
                $('#formulario_b_compras').css("display","none");
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
                if (($("#proveedor_r_compras").val() == "Seleccione") && (document.getElementById("proveedor_r_compras").disabled == false)){
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
               
               // mostrar_mensaje("Generando Reporte","Espere un momento");
                Swal.fire({
                        title: 'Generando Reporte...',
                        html: 'Espere un momento',
                        allowOutsideClick: true,
                        icon:'info',
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 3500, 
                      onBeforeOpen: () => {
                        Swal.showLoading()
                      }
                });
                var timer = setInterval(function(){
                        $.ajax({
                            dataType: "json",
                            method: "POST",
                            url:'../Controladores/reporte_compras_controlador.php',
                            data : datos,
                        }).done(function(json) {
                                console.log("EL GUARDAR",json); 
                                
                                if (json[0]=="Exito") {
                                        console.log("sql",json[2]);
                                        var win = window.open("http://localhost/poryecto_DISEÑOII/DISEÑOII_VACAFE_G07/reportes/r_reporte_proveedor_compras.php?fei="+json[1]+"&fef="+json[2]+"&idp="+json[3], '_blank');
                                        // Cambiar el foco al nuevo tab (punto opcional)
                                        win.focus();
                                        Swal.close();

                                }else{
                                              
                                        Toast1.fire({
                                                icon: 'info',
                                                title: 'No hay compras registradas con este proveedor!'
                                        });
                                        
                                                
                                }
                                
                        });
                clearTimeout(timer);
                },3500);

        });

        $(document).on("submit","#formulario_b_compras",function(e){
                e.preventDefault();
                var datos = $("#formulario_b_compras").serialize();

                
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
                var fecha_inicio = $("#fecha_in_r_compras_b").val();
                var fecha_fin = $("#fecha_f_r_compras_b").val();

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
                if ((((document.getElementById("proveedor_r_compras_b").disabled) == false) && ($("#proveedor_r_compras_b").val() == "Seleccione")) && ((document.getElementById("categoria_r_compras_b").disabled) == false) && ($("#categoria_r_compras_b").val() == "Seleccione")) {
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione una categoría y un proveedor'
                        });
                        return;
                }
                if (((document.getElementById("proveedor_r_compras_b").disabled) == false) && ($("#proveedor_r_compras_b").val() == "Seleccione")){
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione un Proveedor'
                        });
                        return;
                }
                if (((document.getElementById("categoria_r_compras_b").disabled) == false) && ($("#categoria_r_compras_b").val() == "Seleccione")) {
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione una categoría'
                        });
                        return;
                }

               

                if ($("#fecha_in_r_compras_b").val() == "" && $("#fecha_f_r_compras_b").val() == ""){
                        Toast.fire({
                        icon: 'info',
                        title: 'Seleccione Fechas'
                    });
                        return;
                }
                if ($("#fecha_in_r_compras_b").val() == ""){                        
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione una fecha de incio'
                        });
                        return;
                }
                if ($("#fecha_f_r_compras_b").val() == "") {
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione una fecha final'
                        });
                        return;
                }

                console.log("los datos: ",datos);
               
                Swal.fire({
                        title: 'Generando Reporte...',
                        html: 'Espere un momento',
                        allowOutsideClick: true,
                        icon:'info',
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 3500, 
                      onBeforeOpen: () => {
                        Swal.showLoading()
                      }
                });
              
                var timer = setInterval(function(){
                        $.ajax({
                            dataType: "json",
                            method: "POST",
                            url:'../Controladores/reporte_compras_b_controlador.php',
                            data : datos,
                        }).done(function(json) {
                                console.log("EL GUARDAR",json); 

                                
                                        if (json[0]=="Exito") {
                                                console.log("sql",json[2]);
                                                var win = window.open("http://localhost/poryecto_DISEÑOII/DISEÑOII_VACAFE_G07/reportes/r_reporte_bovinos_compras.php?fei="+json[3]+"&fef="+json[4]+"&idp="+json[1]+"&cat="+json[2], '_blank');
                                                // Cambiar el foco al nuevo tab (punto opcional)
                                                win.focus();
                                                 Swal.close();

                                        }else if (json[0]=="Error" && json[3] == "") {

                                               
                                                Toast1.fire({
                                                        icon: 'info',
                                                        title: 'No hay ventas registradas con esta categoría'
                                                });

                                        }else if (json[0]=="Error" && json[1] == "") {

                                               
                                                Toast1.fire({
                                                        icon: 'info',
                                                        title: 'No hay ventas registradas con este Proveedor!'
                                                });
                                        }else{
                                               
                                               
                                                Toast1.fire({
                                                        icon: 'info',
                                                        title: 'No hay compras registradas con este Proveedor o con esta categpría!'
                                                });
                                                
                                        }
                               
                        });
                clearTimeout(timer);
                },3500);
        });

        $(document).on("submit","#formulario_ins_compras",function(e){
                e.preventDefault();
                var datos = $("#formulario_ins_compras").serialize();

                
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
                var fecha_inicio = $("#fecha_in_r_compras_insu").val();
                var fecha_fin = $("#fecha_f_r_compras_ins").val();

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
                if ((f1 == "Invalid Date") && (f2 != "Invalid Date")) {
                        Toast1.fire({
                                icon: 'error',
                                title: 'La fecha final no puede ser menor que la incial'
                        });
                        return;
                }
                if ((((document.getElementById("proveedor_r_compras_ins").disabled) == false) && ($("#proveedor_r_compras_ins").val() == "Seleccione")) && ((document.getElementById("categoria_r_compras_ins").disabled) == false) && ($("#categoria_r_compras_ins").val() == "Seleccione")) {
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione una categoría y un proveedor'
                        });
                        return;
                }
                if (((document.getElementById("proveedor_r_compras_ins").disabled) == false) && ($("#proveedor_r_compras_ins").val() == "Seleccione")){
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione un Proveedor'
                        });
                        return;
                }
                if (((document.getElementById("categoria_r_compras_ins").disabled) == false) && ($("#categoria_r_compras_ins").val() == "Seleccione")) {
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione una categoría'
                        });
                        return;
                }

               

                if ($("#fecha_in_r_compras_insu").val() == "" && $("#fecha_f_r_compras_ins").val() == ""){
                        Toast.fire({
                        icon: 'info',
                        title: 'Seleccione Fechas'
                    });
                        return;
                }
                if ($("#fecha_in_r_compras_insu").val() == ""){                        
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione una fecha de incio'
                        });
                        return;
                }
                if ($("#fecha_f_r_compras_ins").val() == "") {
                        Toast.fire({
                                icon: 'info',
                                title: 'Seleccione una fecha final'
                        });
                        return;
                }

                console.log("los datos: ",datos);
                console.log("Inicio", fecha_inicio);
                console.log("Fin", fecha_fin);


                Swal.fire({
                        title: 'Generando Reporte...',
                        html: 'Espere un momento',
                        allowOutsideClick: true,
                        icon:'info',
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 3500, 
                      onBeforeOpen: () => {
                        Swal.showLoading()
                      }
                });
                var timer = setInterval(function(){
                        $.ajax({
                            dataType: "json",
                            method: "POST",
                            url:'../Controladores/reporte_compras_insumos_controlador.php',
                            data : datos,
                        }).done(function(json) {
                                console.log("EL GUARDAR",json); 
                                
                                
                                if (json[0]=="Exito") {
                                        console.log("sql",json[2]);
                                        var win = window.open("http://localhost/poryecto_DISEÑOII/DISEÑOII_VACAFE_G07/reportes/r_reporte_insumos_compras.php?fei="+json[3]+"&fef="+json[4]+"&idp="+json[1]+"&cat="+json[2], '_blank');
                                        // Cambiar el foco al nuevo tab (punto opcional)
                                        win.focus();
                                       Swal.close();

                                }else if (json[0]=="Error" && json[3] == "") {
                                        Toast1.fire({
                                                icon: 'info',
                                                title: 'No hay ventas registradas con esta categoría'
                                        });
                                       

                                }else if (json[0]=="Error" && json[1] == "") {
                                        Toast1.fire({
                                                icon: 'info',
                                                title: 'No hay ventas registradas con este Proveedor!'
                                        });
                                       
                                }else{
                                               
                                        Toast1.fire({
                                                icon: 'info',
                                                title: 'No hay compras registradas con este Proveedor o con esta categpría!'
                                        });
                                       
                                                
                                }

                                
                        });
                clearTimeout(timer);
                },3500);
                
        });



        $(document).on("click",".btn_limpiar",function(e){ 
                e.preventDefault();
                console.log("si llega");
                $('#formulario_r_compras_p').trigger('reset');
                $('#formulario_b_compras').trigger('reset');
                $('#formulario_ins_compras').trigger('reset');
                
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
        url:'../Controladores/reporte_compras_b_controlador.php',
        data : datos,
    }).done(function(json) {
        

        $("#proveedor_r_compras_b").empty().html(json[1][0]);         
    }).fail(function(){

    }).always(function(){
        //Swal.close();
    });
}

function cargar_proveedores_ins(){
        var datos = {"consultar_info":"si_consultala"}
        $.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/reporte_compras_insumos_controlador.php',
        data : datos,
    }).done(function(json) {
        

        $("#proveedor_r_compras_ins").empty().html(json[1][0]);         
    }).fail(function(){

    }).always(function(){
        //Swal.close();
    });
}



function mostrar_mensaje(titulo,mensaje=""){
       
        Swal.fire({
          title: titulo,
          html: mensaje,
          allowOutsideClick: true,
          icon:'info',
          timerProgressBar: true,
          timer: 3500,         
          didOpen: () => {
            Swal.showLoading()
             
          },
          willClose: () => {
               
                
          }
        }).then(() => {
           
        });


}