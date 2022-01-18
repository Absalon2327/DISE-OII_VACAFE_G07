let modificar = false;
$(function() {
    console.log("funcionando");
    $(document).on("change", "#ctg_Producto", function(e) {
        e.preventDefault();
        if ($("#ctg_Producto").val() == '2') {
            $("#costo_Producto").prop("disabled", true);
            $("#existencia_Producto_min").prop("disabled", false);
        } else if ($("#ctg_Producto").val() == '3') {
            $("#costo_Producto").prop("disabled", true);
            $("#existencia_Producto_min").prop("disabled", false);
        } else {
            $("#costo_Producto").prop("disabled", false);
            $("#existencia_Producto_min").prop("disabled", true);
        }
    });
    cargar_categorias();
    var fecha_hoy = new Date();
    $('#fechav_Producto').datepicker({
        format: "dd-mm-yyyy",
        todayBtn: true,
        clearBtn: false,
        language: "es",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true,
        startDate: fecha_hoy
    });
    $('#addProducto').validate({
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
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.input-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
    $(document).on("change", "#imagen_producto", function(e) {
        validar_archivo($(this));
    });
    document.getElementById("imagen_producto").onchange = function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById('img_producto').src = e.target.result
            document.getElementById('img_producto').width = 100
            document.getElementById('img_producto').height = 100
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };
    $(document).on("click", ".browse", function() {
        var file = $(this).parent().parent().parent().find(".file");
        file.trigger("click");
    });
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#imagen_producto").val(fileName);
        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
    //este editar
    $(document).on("click", ".btn_editar", function(e) {
        e.preventDefault();
        var id = $(this).attr("data-idproducto");
        var idCat = $(this).attr("data-nombrecategoria");
        console.log("El id es: ", id);
        var datos = {
            "consultar_info": "si_coneste_id",
            "id": id,
            "nombre_categoria": idCat
        }
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../Controladores/productos_controlador.php',
            data: datos,
        }).done(function(json) {
            console.log("EL consultar especifico", json);
            if (json[0] == "Exito") {
                console.log("imagen_productos: ", json[2]['nva_image_producto']);
                var fecHA_string = json[2]['dat_fecha_vencimiento'];
                var porciones = fecHA_string.split('-');
                var fecha = porciones[2] + "-" + porciones[1] + "-" + porciones[0]
                $('#llave_producto').val(id);
                $('#almacenar_datos').val("si_actualizalo");
                $('#ctg_Producto').empty().html(json[3][0]);
                $('#nombre_Producto').val(json[2]['nva_nom_producto']);
                $('#descrip_Producto').val(json[2]['txt_descrip_producto']);
                $('#fechav_Producto').val(fecha);
                $('#precio_Producto').val(json[2]['dou_costo_producto']);
                $('#costo_Producto').val(json[2]['dou_precio_venta_producto']);
                $('#existencia_Producto').val(json[2]['int_existencia']);
                $('#existencia_Producto_min').val(json[2]['int_existencia_minima']);
                $('#imagen_producto').empty().html(json[2]['nva_image_producto']);
                $("#radio_activo").prop("disabled", false);
                $("#radio_inactivo").prop("disabled", false);
                //cargar_categorias();  
                $('#mod_add_producto').modal('show');
            }
        }).fail(function() {}).always(function() {
            Swal.close();
        });
    });
    $(document).on("click", "#btn_nuevo_producto", function(e) {
        e.preventDefault();
        $("#mod_add_producto").modal("show");
    });
    //categoria
    $(document).on("click", "#btn_nueva_categoria", function(e) {
        e.preventDefault();
        $("#mod_add_categoria").modal("show");
    });
    $(document).on("click", "#registrar_producto", function(e) {
        e.preventDefault();
        console.log("Capturando evento");
        //$('#myModal').modal('show'); para abrir modal
        //$('#myModal').modal('hide'); para cerrar modal
        $('#mod_add_producto').modal('show');
        $(".select2").select2({}).on("select2:opening", function() {
            $(".modal").removeAttr("tabindex", "-1");
        }).on("select2:close", function() {
            $(".modal").attr("tabindex", "-1");
        });
    });
    //categoria
    $(document).on("click", "#registrar_categoria", function(e) {
        e.preventDefault();
        console.log("Capturando evento");
        //$('#myModal').modal('show'); para abrir modal
        //$('#myModal').modal('hide'); para cerrar modal
        $('#mod_add_categoria').modal('show');
        $(".select2").select2({}).on("select2:opening", function() {
            $(".modal").removeAttr("tabindex", "-1");
        }).on("select2:close", function() {
            $(".modal").attr("tabindex", "-1");
        });
    });
    $(document).on("submit", "#addProducto", function(e) {
        e.preventDefault();
        var datos = $("#addProducto").serialize();
        console.log("Imprimiendo datos: ", datos);
        console.log("#estado_productos");
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 7000
        });
        var costo = $("#precio_Producto").val();
        var precio = $("#costo_Producto").val();
        var exis = $("#existencia_Producto").val();
        var exis_min = $("#existencia_Producto_min").val();
        if ($("#ctg_Producto").val() == "Seleccione") {
            Toast.fire({
                icon: 'info',
                title: 'Debe elegir una categoria'
            });
            return;
        }
        if ($("#imagen_productos").val() == "") {
            Toast.fire({
                icon: 'info',
                title: 'Debe elegir una imagen de producto'
            });
            return;
        }
        if ($("#fechav_Producto").val() == "") {
            Toast.fire({
                icon: 'info',
                title: 'Debe elegir una fecha de producto'
            });
            return;
        }
        /*
        if ($("#costo_Producto").val() == "0" || $("#costo_Producto").val() < "0") {
            Toast.fire({
                icon: 'info',
                title: 'El Precio debe ser mayor que 0'
            });
            return;
        }*/
        if ($("#precio_Producto").val() < "0") {
            Toast.fire({
                icon: 'info',
                title: 'El Costo debe ser mayor o igual a 0'
            });
            return;
        }
        if ($("#existencia_Producto").val() == "0" || $("#existencia_Producto").val() == "") {
            Toast.fire({
                icon: 'info',
                title: 'La existencia no puede ser 0'
            });
            return;
        }
        if (((Number(costo) > Number(precio)) && (document.getElementById("costo_Producto").disabled == false))) {
            Toast.fire({
                icon: 'info',
                title: 'El costo no puede ser mayor que el precio'
            });
            return;
        }
        if (((Number(exis) < Number(exis_min)) && (document.getElementById("existencia_Producto_min").disabled == false))) {
            Toast.fire({
                icon: 'info',
                title: 'Las existencia debe ser mayor que la minima'
            });
            return;
        }
        if ($("#nombre_Producto").val() == "") {
            Toast.fire({
                icon: 'info',
                title: 'Ingrese un nombre'
            });
            return;
        }
        //mostrar_mensaje("Almacenando información","Por favor no recargue la página");
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../Controladores/productos_controlador.php',
            data: datos,
        }).done(function(json) {
            console.log("EL GUARDAR", json);
            if (json[0] == "Exito") {
                $("#nombre_Producto").val("");
                $("#descrip_Producto").val("");
                $("#fechav_Producto").val("");
                $("#precio_Producto").val("");
                $("#costo_Producto").val("");
                $("#existencia_Producto").val("");
                $("#existencia_Producto_min").val("");
                $("#ctg_Producto").val("");
                if ($("#imagen_producto").val() != "") {
                    subir_archivo($("#imagen_producto"), json[1]);
                }
                /*else{
                                        Toast.fire({
                                            icon: 'error',
                                            title: 'El campo de la imagen está vacío'
                                        });
                                    }*/
                setTimeout(function(s) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Producto registrado con Exito!.'
                    });
                }, 500);
            } else if (json[1] == "existe producto") {
                Toast.fire({
                    icon: 'error',
                    title: 'Este nombre de producto ya existe'
                });
                return;
            } else {
                console.error("Ocurrio un error");
                Toast.fire({
                    icon: 'error',
                    title: 'Error!.'
                });
            }
            return false;
        });
    });
    //categoria
    $(document).on("submit", "#addCategoria", function(e) {
        e.preventDefault();
        var datos = $("#addCategoria").serialize();
        console.log("Imprimiendo datos: ", datos);
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 7000
        });
        if ($("#nombre_Categoria").val() == "") {
            Toast.fire({
                icon: 'info',
                title: 'Por favor ingrese una categoria'
            });
            return;
        }
        //mostrar_mensaje("Almacenando información","Por favor no recargue la página");
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../Controladores/productos_controlador.php',
            data: datos,
        }).done(function(json) {
            console.log("EL GUARDAR", json);
            if (json[0] == "Exito") {
                $("#nombre_Categoria").val("");
                $('#mod_add_categoria').modal('hide');
                Toast.fire({
                    icon: 'success',
                    title: 'Categoria registrada exitosamente!.'
                });
            } else if (json[1] == "existe categoria") {
                Toast.fire({
                    icon: 'error',
                    title: 'Este nombre de categoria ya existe'
                });
                return;
            }
        });
    });
});
//Guardar Prducto
function validar_archivo(file) {
    console.log("validar_archivo", file);
    var Lector;
    var Archivos = file[0].files;
    var archivo = file;
    var archivo2 = file.val();
    if (Archivos.length > 0) {
        Lector = new FileReader();
        Lector.onloadend = function(e) {
            var origen, tipo, tamanio;
            //Envia la imagen a la pantalla
            origen = e.target; //objeto FileReader
            //Prepara la información sobre la imagen
            tipo = archivo2.substring(archivo2.lastIndexOf("."));
            console.log("el tipo", tipo);
            tamanio = e.total / 1024;
            console.log("el tamaño", tamanio);
            if (tipo !== ".jpeg" && tipo !== ".JPEG" && tipo !== ".jpg" && tipo !== ".JPG" && tipo !== ".png" && tipo !== ".PNG") {
                //  
                console.log("error_tipo");
                $("#error_en_la_imagen").css('display', 'block');
            } else {
                $("#error_en_la_imagen").css('display', 'none');
                console.log("en el else");
            }
        };
        Lector.onerror = function(e) {
            console.log(e)
        }
        Lector.readAsDataURL(Archivos[0]);
    }
}

function subir_archivo(archivo, int_idproducto) {
    console.log("aca archivos", archivo, int_idproducto);
    // return null;
    var file = archivo.files;
    var formData = new FormData();
    formData.append('formData', $("#crear_seccion_home"));
    var data = new FormData();
    //Append files infos
    jQuery.each(archivo[0].files, function(i, file) {
        data.append('file-' + i, file);
    });
    console.log("data", data);
    $.ajax({
        url: "../Controladores/productos_controlador.php?id=" + int_idproducto + '&subir_imagen=subir_imagen_ajax',
        type: "POST",
        dataType: "json",
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        context: this,
        success: function(json) {
            Swal.close();
            console.log("eljson_img", json);
            if (json[0] == "Exito") {
                $("#addProducto").trigger('reset');
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Error al tratar de subir la imagen'
                });
            }
        }
    });
}

function cargar_categorias() {
    //mostrar_mensaje("Consultando datos");
    var datos = {
        "consultar_categorias": "si_consultar"
    }
    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../Controladores/productos_controlador.php',
        data: datos,
    }).done(function(json) {
        console.log("EL consultar", json);
        $("#ctg_Producto").empty().html(json[2][0]);
    }).fail(function() {}).always(function() {
        Swal.close();
    });
}