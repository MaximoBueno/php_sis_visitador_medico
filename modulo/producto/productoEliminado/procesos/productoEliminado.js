function buscarProducto(des){
    var text = $("input#buscar").val();

    if (des == 1){
        text = "%";
    }

    if(text == ""){
        text = "%";
    }

    if (text != "") {
        $.post("./procesos/buscarProducto.php", {valor: text}, function(mensaje) {
            $("#contenidoIngreso").html(mensaje);
        });
    }
}

function modalOKI(des){
    var text = "";
    switch(des){
        case 1:
            text = "Los Campos estan vacios.";
            break;
        case 2:
            text = "Se Deshabilito Correctamente.";
            break;
        case 3:
            text = "Se Habilito Correctamente.";
            break;
        case 4:
            text = "Error al Ejecutar la Operación.";
            break;
        default:
            console.log("NOTIFICACIÓN E-003");
            text = "NOTIFICACIÓN E-003";
            break;
    }

    document.getElementById('OKIconcepto').textContent = text;
    $('#miModalOKI').modal('show');
    $('#miModalOKI').on('shown.bs.modal', function () {
        $('#cerrarOKI').focus();
    });
}

function deshabilitarProducto(r){
    $.post("./procesos/estadoProducto.php", {valor: r, ind: 0}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(2);
            buscarProducto(1);
        }else if(mensaje == "NUL"){
            modalOKI(4);
        }else{
            modalOKI(5);
        }
    });
}

function habilitarProducto(r){
    $.post("./procesos/estadoProducto.php", {valor: r, ind: 1}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(3);
            buscarProducto(1);
        }else if(mensaje == "NUL"){
            modalOKI(4);
        }else{
            modalOKI(5);
        }
    });
}