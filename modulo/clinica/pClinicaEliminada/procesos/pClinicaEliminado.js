function buscarPClinica(des){
    var text = document.getElementById('bFechaHorario').value;

    if (des == 1){ text = "-"; }

    if (text == ""){ text = "-"; }

    if (text != "") {
        $.post("./procesos/buscarPClinica.php", {valor: text}, function(mensaje) {
            alert(mensaje);
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

function deshabilitarPClinica(r){
    $.post("./procesos/estadoPClinica.php", {valor: r, ind: 0}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(2);
            buscarPClinica(1);
        }else if(mensaje == "NUL"){
            modalOKI(4);
        }else{
            modalOKI(5);
        }
    });
}

function habilitarPClinica(r){
    $.post("./procesos/estadoPClinica.php", {valor: r, ind: 1}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(3);
            buscarPClinica(1);
        }else if(mensaje == "NUL"){
            modalOKI(4);
        }else{
            modalOKI(5);
        }
    });
}