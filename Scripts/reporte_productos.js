$('#formulario_r_categoria_p').css("display", "none");
$('#formulario_p_leche').css("display", "none");
$('#msg_decimales').css("display", "none");
cargar_productos_l();
console.log("esta funcionando el js");
$(function() {
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
    $(document).on("click", ".btn_categorias_producto", function(e) {
        e.preventDefault();
        console.log("si llega");
        $('#formulario_r_categoria_p').css("display", "block");
        $('#formulario_p_leche').css("display", "none");
        cargar_categorias();
    });
    $(document).on("click", ".btn_leche_producto", function(e) {
        e.preventDefault();
        console.log("si llega");
        $('#formulario_r_categoria_p').css("display", "none");
        $('#formulario_p_leche').css("display", "block");
        cargar_categorias();
    });
    $(document).on("submit", "#formulario_r_categoria_p", function(e) {
        e.preventDefault();
        var datos = $("#formulario_r_categoria_p").serialize();
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
        var fecha_inicio = $("#fecha_inicio_r_cate").val();
        var fecha_fin = $("#fecha_fin_r_producto").val();
        console.log("Inicio", fecha_inicio);
        console.log("Fin", fecha_fin);
        var f1 = new Date(fecha_inicio);
        var f2 = new Date(fecha_fin);
        console.log("F1", f1);
        console.log("F2", f2);
        if (f1.getTime() > f2.getTime()) {
            Toast1.fire({
                icon: 'error',
                title: 'La fecha final no puede ser menor que la incial'
            });
            return;
        }
        if ($("#producto_r_cate").val() == "Seleccione") {
            Toast.fire({
                icon: 'info',
                title: 'Seleccione un Producto'
            });
            return;
        }
        if ($("#fecha_inicio_r_cate").val() == "" && $("#fecha_fin_r_producto").val() == "") {
            Toast.fire({
                icon: 'info',
                title: 'Seleccione Fechas'
            });
            return;
        }
        if ($("#fecha_inicio_r_cate").val() == "") {
            Toast.fire({
                icon: 'info',
                title: 'Seleccione una fecha de inicio'
            });
            return;
        }
        if ($("#fecha_fin_r_producto").val() == "") {
            Toast.fire({
                icon: 'info',
                title: 'Seleccione una fecha final'
            });
            return;
        }
        console.log("los datos: ", datos);
        mostrar_mensaje("Generando Reporte", "Espere un Momento");
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../Controladores/reporte_producto_cate_controlador.php',
            data: datos,
        }).done(function(json) {
            console.log("EL GUARDAR", json);
            var timer = setInterval(function() {
                if (json[0] == "Exito") {
                    console.log("sql", json[2]);
                    var win = window.open("http://localhost/poryecto_DISEÑOII/DISEÑOII_VACAFE_G07/reportes/r_reporte_categoria_producto.php?fei=" + json[1] + "&fef=" + json[2] + "&idp=" + json[3], '_blank');
                    // Cambiar el foco al nuevo tab (punto opcional)
                    win.focus();
                    console.log("NO entra");
                } else {
                    console.log("termino? ", termino);
                    if (termino == "si") {
                        Toast1.fire({
                            icon: 'info',
                            title: 'No hay productos registrados con esta categoria!'
                        });
                    }
                }
                clearTimeout(timer);
            }, 3500); + 6
        });
    });
    $(document).on("submit", "#formulario_p_leche", function(e) {
        e.preventDefault();
        var datos = $("#formulario_p_leche").serialize();
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
        var fecha_inicio = $("#fecha_in_r_leche_pro").val();
        var fecha_fin = $("#fecha_f_r_leche_pro").val();
        console.log("Inicio", fecha_inicio);
        console.log("Fin", fecha_fin);
        var f1 = new Date(fecha_inicio);
        var f2 = new Date(fecha_fin);
        console.log("F1", f1);
        console.log("F2", f2);
        if (f1.getTime() > f2.getTime()) {
            Toast1.fire({
                icon: 'error',
                title: 'La fecha final no puede ser menor que la incial'
            });
            return;
        }
        if (((document.getElementById("producto_r_leche").disabled) == false) && ($("#producto_r_leche").val() == "Seleccione")) {
            Toast.fire({
                icon: 'info',
                title: 'Seleccione un Producto'
            });
            return;
        }
        if ($("#fecha_in_r_leche_pro").val() == "" && $("#fecha_f_r_leche_pro").val() == "") {
            Toast.fire({
                icon: 'info',
                title: 'Seleccione Fechas'
            });
            return;
        }
        if ($("#fecha_in_r_leche_pro").val() == "") {
            Toast.fire({
                icon: 'info',
                title: 'Seleccione una fecha de inicio'
            });
            return;
        }
        if ($("#fecha_f_r_leche_pro").val() == "") {
            Toast.fire({
                icon: 'info',
                title: 'Seleccione una fecha final'
            });
            return;
        }
        console.log("los datos: ", datos);
        mostrar_mensaje("Generando Reporte", "Espere un Momento");
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../Controladores/reporte_produccion_leche_controlador.php',
            data: datos,
        }).done(function(json) {
            console.log("EL GUARDAR", json);
            var timer = setInterval(function() {
                if (json[0] == "Exito") {
                    console.log("sql", json[2]);
                    var win = window.open("http://localhost/poryecto_DISEÑOII/DISEÑOII_VACAFE_G07/reportes/r_reporte_producto_produccion.php?fei=" + json[1] + "&fef=" + json[2] + "&idp=" + json[3], '_blank');
                    // Cambiar el foco al nuevo tab (punto opcional)
                    win.focus();
                    console.log("NO entra");
                } else {
                    Toast1.fire({
                        icon: 'info',
                        title: 'No hay productos registrados!'
                    });
                }
                clearTimeout(timer);
            }, 3500);
        });
    });
    $(document).on("click", ".btn_limpiar", function(e) {
        e.preventDefault();
        console.log("si llega");
        $('#formulario_r_categoria_p').trigger('reset');
    });
});

function cargar_categorias() {
    var datos = {
        "consultar_info": "si_consultala"
    }
    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../Controladores/reporte_producto_cate_controlador.php',
        data: datos,
    }).done(function(json) {
        $("#producto_r_cate").empty().html(json[1][0]);
    }).fail(function() {}).always(function() {
        //Swal.close();
    });
}

function cargar_productos_l() {
    var datos = {
        "consultar_info": "si_consultala"
    }
    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../Controladores/reporte_produccion_leche_controlador.php',
        data: datos,
    }).done(function(json) {
        $("#producto_r_leche").empty().html(json[1][0]);
    }).fail(function() {}).always(function() {
        //Swal.close();
    });
}

function mostrar_mensaje(titulo, mensaje = "") {
    Swal.fire({
        title: titulo,
        html: mensaje,
        allowOutsideClick: false,
        icon: 'info',
        timerProgressBar: true,
        timer: 3500,
        didOpen: () => {
            Swal.showLoading()
        },
        willClose: () => {}
    }).then((result) => {});
}