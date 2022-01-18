cargar_datos();
$(function (){
    console.log("esta funcionando")
    //$('#formulario_registro').parsley();
     $('[data-mask]').inputmask()
    $('#formulario_cliente').validate({
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
    $('#formulario_editar').validate({
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
    
    
    

   

    
    /*$(document).on("click",".btn_cerrar_class",function(e){
        e.preventDefault();
        $("#formulario_registro").trigger('reset');
        $('#md_registrar_usuario').modal('hide');


    });

    $(document).on("click","#registrar_usuario",function(e){
        e.preventDefault();
        console.log("Capturando evento");
        //$('#myModal').modal('show'); para abrir modal
        //$('#myModal').modal('hide'); para cerrar modal
        $('#md_registrar_usuario').modal('show');

        $(".select2").select2({
        }).on("select2:opening", 
            function(){
                $(".modal").removeAttr("tabindex", "-1");
        }).on("select2:close", 
            function(){ 
                $(".modal").attr("tabindex", "-1");
        });
    
    });*/

    $(document).on("click",".btn_baja_cliente",function(e){
        e.preventDefault();
        var id = $(this).attr("data-idcltbaja");
        $('#id_baja').val(id);
         $('#modalBajaCliente').modal('show');
    });

    $(document).on("click",".btn_edit_cliente",function(e){

        e.preventDefault(); 
        var id = $(this).attr("data-idcliente");
        console.log("El id es: ",id);
        var datos = {"consultar_info":"si_id_especifico","id":id}
        $.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/clientes_controlador.php',
            data : datos,
        }).done(function(json) {
            console.log("EL consultar especifico",json);
            if (json[0]=="Exito") {
                


                $('#llave_cliente').val(id);
                $('#nombre_cliente_edit').val(json[2]['nva_nom_cliente']);
                $('#direc_cliente_edit').val(json[2]['txt_direc_cliente']);
                $('#dui_cliente_edit').val(json[2]['nva_dui_cliente']);
                $('#telefono_cliente_edit').val(json[2]['nva_telefono_cliente']);
                $('#apellido_cliente_edit').val(json[2]['nva_ape_cliente']);
                
                $('#modalClienteEdit').modal('show');
            }else{
                setTimeout(function (s) {
                    Toast.fire({
                        icon: 'success',
                        title: 'No se obtuvieron los datos del cliente !'
                    });
                }, 500);
            }
             
        }).fail(function(){

        }).always(function(){
            Swal.close();
        });
            
    });
    


    $(document).on("submit","#formulario_cliente",function(e){
        e.preventDefault();
        var datos = $("#formulario_cliente").serialize();
        console.log("Imprimiendo datos: ",datos);
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500
        });
        $.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/clientes_controlador.php',
            data : datos,
        }).done(function(json) {
            console.log("EL GUARDAR",json);
            if (json[0] == "Exito") {
                $('#formulario_cliente').trigger('reset');
                $('#modalAddCliente').modal('hide');
                setTimeout(function (s) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Cliente registrado con exito !'
                    });
                }, 500);   
                cargar_datos();
            }else if (json[1] == "datos iguales") {
                setTimeout(function (s) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Estos Datos pertenecen a un cliente registrado !'
                    });
                }, 500); 

            }else if (json[1] == "dui") {
                setTimeout(function (s) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Este DUI ya sido registrado!'
                    });
                }, 500); 
            }else if (json[1] == "tel") {
                setTimeout(function (s) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Este teléfono pertenece a un cliente registrado!'
                    });
                }, 500); 
            }else{
                setTimeout(function (s) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Registro incorrecto !'
                    });
                }, 500); 
                cargar_datos();
            }
                
                    
            
        }).fail(function(){

        }).always(function(){

        });


    });

    $(document).on("submit","#formulario_editar",function(e){
        e.preventDefault();
        var datos = $("#formulario_editar").serialize();
        console.log("Imprimiendo datos: ",datos);
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500
        });
        $.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/clientes_controlador.php',
            data : datos,
        }).done(function(json) {
            console.log("EL GUARDAR",json);
            if (json[0] == "Exito") {
                $('#formulario_editar').trigger('reset');
                $('#modalClienteEdit').modal('hide');
                setTimeout(function (s) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Cliente modificado con exito !'
                    });
                }, 500);   
                cargar_datos();
            }else if (json[1] == "datos iguales") {
                setTimeout(function (s) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Estos Datos pertenecen a un cliente registrado !'
                    });
                }, 500); 

            }else if (json[1] == "dui") {
                setTimeout(function (s) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Este DUI ya sido registrado!'
                    });
                }, 500); 
            }else if (json[1] == "tel") {
                setTimeout(function (s) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Este teléfono pertenece a un cliente registrado!'
                    });
                }, 500); 
            }else{
                setTimeout(function (s) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Modificación incorrecta!'
                    });
                }, 500); 
                cargar_datos();
            }
                
                    
            
        }).fail(function(){

        }).always(function(){

        });


    });

    $(document).on("submit","#confirmaBaja",function(e){
        e.preventDefault();
        var datos = $("#confirmaBaja").serialize();
        console.log("Imprimiendo datos: ",datos);
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500
        });
        $.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/clientes_controlador.php',
            data : datos,
        }).done(function(json) {
            console.log("EL GUARDAR",json);
            if (json[0] == "Exito") {
                $('#confirmaBaja').trigger('reset');
                $('#modalBajaCliente').modal('hide');
                setTimeout(function (s) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Cliente dado de baja con exito !'
                    });
                }, 500);   
                cargar_datos();
            }else{
                setTimeout(function (s) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Ops. Ocurrio un error!'
                    });
                }, 500); 
                cargar_datos();
            }
                
                    
            
        }).fail(function(){

        }).always(function(){

        });


    });
});

function cargar_datos(){
    
    var datos = {"consultar_info":"si_consultala"}
    $.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/clientes_controlador.php',
        data : datos,
    }).done(function(json) {
        console.log("EL consultar",json);
        $("#tablaCl").empty().html(json[1]); 
        $('#example1').DataTable(); 
    }).fail(function(){

    }).always(function(){
        Swal.close();
    });
}
