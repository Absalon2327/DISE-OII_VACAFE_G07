let modificar = false
cargar_categorias();
$(function() {
    console.log("funcionando");
    $(document).on("change", "#ctg_Producto_edit", function(e) {
        e.preventDefault();
        if ($("#ctg_Producto_edit").val() == '2') {
            $("#costo_Producto_Edit").prop("disabled", true);
            $("#existencia_Producto_min_Edit").prop("disabled", false);
        } else if ($("#ctg_Producto_edit").val() == '3') {
            $("#costo_Producto_Edit").prop("disabled", true);
            $("#existencia_Producto_min_Edit").prop("disabled", false);
        } else {
            $("#costo_Producto_Edit").prop("disabled", false);
            $("#existencia_Producto_min_Edit").prop("disabled", true);
        }
    });
    cargar_datos();
    cargar_categorias();
    var fecha_hoy = new Date();
    $('#fechav_Producto_Edit').datepicker({
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
    $(document).on("change", "#imagen_producto_Edit", function(e) {
        validar_archivo($(this));
    });
    document.getElementById("imagen_producto_Edit").onchange = function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById('img_producto_Edit').src = e.target.result
            document.getElementById('img_producto_Edit').width = 100
            document.getElementById('img_producto_Edit').height = 100
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
        $("#imagen_producto_Edit").val(fileName);
        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
    //este eliminar
    $(document).on("click", ".btn_baja", function(e) {
        e.preventDefault();
        var id = $(this).attr("data-idcltbaja");
        var idpro_baja = $('#id_producto_baja').val(id);
        $('#modalBajaProducto').modal('show');
        cargar_categorias();
    });
    $(document).on("change", "#ctg_Producto_Cmb", function(e) {
        e.preventDefault();
        var id = $('#ctg_Producto_Cmb').val();
        console.log("El id es: ", id);
        var datos = {
            "consultar_inventario": id
        }
        cargar_datos(id);
    });
    $(document).on("submit", "#confirmaBaja", function(e) {
        e.preventDefault();
        var datos = $("#confirmaBaja").serialize();
        console.log("Imprimiendo datos: ", datos);
        console.log("#estado_productos_Edit");
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 700000000
        });
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../Controladores/inventarios_controlador.php',
            data: datos,
        }).done(function(json) {
            console.log("EL GUARDAR", json);
            cargar_datos();
            if (json[0] == "Exito") {
                $('#modalBajaProducto').modal('hide');
                cargar_datos();
                setTimeout(function(s) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Producto dado de baja con Exito!.'
                    });
                }, 500);
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Error no se pudo actualizar!.'
                });
            }
        });
    });
    $(document).on("submit", "#addProducto", function(e) {
        e.preventDefault();
        var datos = $("#addProducto").serialize();
        console.log("Imprimiendo datos: ", datos);
        console.log("#estado_productos_Edit");
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 7000
        });
        var costo = $("#precio_Producto_Edit").val();
        var precio = $("#costo_Producto_Edit").val();
        var exis = $("#existencia_Producto_Edit").val();
        var exis_min = $("#existencia_Producto_min_Edit").val();
        if ($("#ctg_Producto_edit").val() == "Seleccione") {
            Toast.fire({
                icon: 'info',
                title: 'Debe elegir una categoria'
            });
            return;
        }
        if ($("#imagen_productos_Edit").val() == "") {
            Toast.fire({
                icon: 'info',
                title: 'Debe elegir una imagen de producto'
            });
            return;
        }
        if ($("#fechav_Producto_Edit").val() == "") {
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
        if ($("#precio_Producto_Edit").val() < "0") {
            Toast.fire({
                icon: 'info',
                title: 'El Costo debe ser mayor o igual a 0'
            });
            return;
        }
        if ($("#existencia_Producto_Edit").val() == "0" || $("#existencia_Producto_Edit").val() == "") {
            Toast.fire({
                icon: 'info',
                title: 'La existencia no puede ser 0'
            });
            return;
        }
        if (((Number(costo) > Number(precio)) && (document.getElementById("costo_Producto_Edit").disabled == false))) {
            Toast.fire({
                icon: 'info',
                title: 'El costo no puede ser mayor que el precio'
            });
            return;
        }
        if (((Number(exis) < Number(exis_min)) && (document.getElementById("existencia_Producto_min_Edit").disabled == false))) {
            Toast.fire({
                icon: 'info',
                title: 'Las existencia debe ser mayor que la minima'
            });
            return;
        }
        if ($("#nombre_Producto_Edit").val() == "") {
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
            url: '../Controladores/inventarios_controlador.php',
            data: datos,
        }).done(function(json) {
            console.log("EL GUARDAR", json);
            if (json[0] == "Exito") {
                $("#nombre_Producto_Edit").val("");
                $("#descrip_Producto_Edit").val("");
                $("#fechav_Producto_Edit").val("");
                $("#precio_Producto_Edit").val("");
                $("#costo_Producto_Edit").val("");
                $("#existencia_Producto_Edit").val("");
                $("#existencia_Producto_min_Edit").val("");
                $("#ctg_Producto_edit").val("");
                if ($("#imagen_producto_Edit").val() != "") {
                    subir_archivo($("#imagen_producto_Edit"), json[1]);
                }
                setTimeout(function(s) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Producto Modificado con Exito!.'
                    });
                }, 100);
                // cargar_datos();
                $('#mod_add_producto').modal('hide');
                var timer = setInterval(function() {
                    $(location).attr('href', '../Vistas/v_inventario.php');
                    clearTimeout(timer);
                }, 600);
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
                    title: 'Error aqui!.'
                });
            }
            //return false;
        });
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
            url: '../Controladores/inventarios_controlador.php',
            data: datos,
        }).done(function(json) {
            console.log("EL consultar especifico", json);
            if (json[0] == "Exito") {
                console.log("imagen_productos_Edit: ", json[2]['nva_image_producto']);
                var fecHA_string = json[2]['dat_fecha_vencimiento'];
                var porciones = fecHA_string.split('-');
                var fecha = porciones[2] + "-" + porciones[1] + "-" + porciones[0]
                $('#llave_producto').val(id);
                $('#almacenar_datos').val("si_actualizalo");
                $('#ctg_Producto_edit').empty().html(json[3][0]);
                $('#nombre_Producto_Edit').val(json[2]['nva_nom_producto']);
                $('#descrip_Producto_Edit').val(json[2]['txt_descrip_producto']);
                $('#fechav_Producto_Edit').val(fecha);
                $('#precio_Producto_Edit').val(json[2]['dou_costo_producto']);
                $('#costo_Producto_Edit').val(json[2]['dou_precio_venta_producto']);
                $('#existencia_Producto_Edit').val(json[2]['int_existencia']);
                $('#existencia_Producto_min_Edit').val(json[2]['int_existencia_minima']);
                $("#radio_activo").prop("disabled", false);
                $("#radio_inactivo").prop("disabled", false);
                //cargar_categorias();
                document.getElementById('img_producto_Edit').src = json[2]['nva_image_producto']
                document.getElementById('img_producto_Edit').width = 100
                document.getElementById('img_producto_Edit').height = 100
                document.getElementById('almacenar_datos').value = 'si_actualizalo'
                modificar = true
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
    Swal.fire({
        title: '¡Subiendo imagen!',
        html: 'Por favor espere mientras se sube el archivo',
        timerProgressBar: true,
        allowEscapeKey: false,
        allowOutsideClick: false,
        onBeforeOpen: () => {
            Swal.showLoading()
        }
    });
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
                Swal.fire('¡Excelente!', 'La información ha sido almacenada correctamente!', 'success');
                $('#mod_add_producto').modal('hide');
                cargar_datos();
            } else {
                Swal.fire('¡Error!', 'No ha sido posible registrar la imagen', 'error');
                $('#mod_add_producto').modal('hide');
                cargar_datos();
            }
        }
    });
}

function cargar_datos(categoria) {
    //mostrar_mensaje("Consultando datos");
    var datos = {
        "consultar_info": "si_consultala",
        "idcategoria": categoria
    }
    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../Controladores/inventarios_controlador.php',
        data: datos,
    }).done(function(json) {
        console.log("EL consultar", json);
        $("#tablaPro").empty().html(json[1]);
        $('#mod_add_producto').modal('hide');
        $('#example1').DataTable();
        //$("#ctg_Producto").empty().html(json[3][0]);
        cargar_categorias();
    }).fail(function() {}).always(function() {
        Swal.close();
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
        url: '../Controladores/inventarios_controlador.php',
        data: datos,
    }).done(function(json) {
        console.log("EL consultar", json);
        $("#ctg_Producto_Cmb").empty().html(json[2][0]);
    }).fail(function() {}).always(function() {
        Swal.close();
    });
}