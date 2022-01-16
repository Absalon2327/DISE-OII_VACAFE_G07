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
    
    
    

   

    
    /*$(document).on("click",".btn_cerrar_class",function(e){
        e.preventDefault();
        $("#formulario_registro").trigger('reset');
        $('#md_registrar_usuario').modal('hide');


    });

    $(document).on("click",".btn_eliminar",function(e){
        e.preventDefault();
        var id = $(this).attr("data-id");
        var datos = {"eliminar_persona":"si_eliminala","id":id}
        $.ajax({
            dataType: "json",
            method: "POST",
            url:'json_usuarios.php',
            data : datos,
        }).done(function(json) {
            cargar_datos();

        });
    });
    $(document).on("click",".btn_editar",function(e){

        e.preventDefault(); 
        mostrar_mensaje("Consultando datos");
        var id = $(this).attr("data-id");
        console.log("El id es: ",id);
        var datos = {"consultar_info":"si_condui_especifico","id":id}
        $.ajax({
            dataType: "json",
            method: "POST",
            url:'json_usuarios.php',
            data : datos,
        }).done(function(json) {
            console.log("EL consultar especifico",json);
            if (json[0]=="Exito") {
                var fecHA_string = json[2]['fecha_nacimiento'];
                var porciones = fecHA_string.split('-');
                var fecha = porciones[2]+"/"+porciones[1]+"/"+porciones[0]

                $('#llave_persona').val(id);
                $('#ingreso_datos').val("si_actualizalo");
                $('#nombre').val(json[2]['nombre']);
                $('#email').val(json[2]['email']);
                $('#dui').val(json[2]['dui']);
                $('#telefono').val(json[2]['telefono']);
                $('#fecha').val(fecha);
                $('#tipo_persona').val(json[2]['tipo_persona']);

                $("#usuario").removeAttr("required");
                $("#contrasenia").removeAttr("required");
                
                
                $('#md_registrar_usuario').modal('show');
            }
             
        }).fail(function(){

        }).always(function(){
            Swal.close();
        });


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
});

function cargar_datos(){
    //mostrar_mensaje("Consultando datos");
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
