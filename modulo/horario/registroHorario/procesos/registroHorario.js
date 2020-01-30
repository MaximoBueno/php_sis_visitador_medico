var myCodeBean = 0;
function actualizarIHorario(myvalor){
    var retorno = new Array(5);
    $.post("./procesos/getIHorario.php", {valor: myvalor}, function(mensaje) {
        retorno = mensaje.split("|")
        myCodeBean = retorno[0];
        document.getElementById("fechaHorario").value = retorno[1];
        document.getElementById("dia").value = retorno[2];
        document.getElementById("hora").value = retorno[3];
        document.getElementById("distrito").value = retorno[4];
        document.getElementById("ruta").value = retorno[5];
        document.getElementById("producto").value = retorno[6];
        
        controlAdd(true);

        $("#btn-modificar").prop("disabled", false);
        $("#btn-cancelar").prop("disabled", false);
        $("#btn-nuevo").prop("disabled", true);
        $("#btn-registrar").prop("disabled", true);
    });
}

function eliminarIHorario(myvalor){
    $.post("./procesos/eliminarIHorario.php", {valor: myvalor}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(7);
            buscarHorario(1);
            cancelarx();
        }else if(mensaje == "NUL"){
            modalOKI(4);
        }else{
            modalOKI(5);
        }
    });
}

function registrarIHorario(){
    var datosRegistro = new Array(4);
    datosRegistro[0] = $("#fechaHorario").val();
    datosRegistro[1] = $("#dia").val();
    datosRegistro[2] = $("#hora").val();
    datosRegistro[3] = $("#distrito").val();
    datosRegistro[4] = $("#ruta").val();
    datosRegistro[5] = $("#producto").val();

    $.post("./procesos/registrarHorario.php", {valor: datosRegistro}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(2);
            buscarHorario(1);
            cancelarx();
        }else if(mensaje == "NUL"){
            modalOKI(4);
        }else{
            modalOKI(5);
        }
    });
}

function buscarHorario(des = 0){
    var text = $("#fechaHorario").val();
    $.post("./procesos/getHorarios.php", {valor: text}, function(mensaje) {
        $("#contenidoIngreso").html(mensaje);
    });
}

function cerrarme() {
    $("#miModalEliminar .close").click();
}

function controlAdd(isNot){
    isNot = !isNot;
    $("#dia").prop("disabled", isNot);
    $("#hora").prop("disabled", isNot);
    $("#distrito").prop("disabled", isNot);
    $("#ruta").prop("disabled", isNot);
    $("#producto").prop("disabled", isNot);
}

function nuevo(){
    $("#btn-nuevo").prop("disabled", true);
    $("#btn-modificar").prop("disabled", true);
    $("#btn-registrar").prop("disabled", false);
    $("#btn-cancelar").prop("disabled", false);
    controlAdd(true);
}

function cancelarx(){
    $("#btn-nuevo").prop("disabled", false);
    $("#btn-registrar").prop("disabled", true);
    $("#btn-modificar").prop("disabled", true);
    $("#btn-cancelar").prop("disabled", true);

    //document.getElementById("fechaHorario").value = "0000-00-00";
    document.getElementById("dia").value = "0";
    document.getElementById("hora").value = "0";
    document.getElementById("distrito").value = "0";
    document.getElementById("ruta").value = "0";
    document.getElementById("producto").value = "0";

    controlAdd(false);

    this.cerrarme(); //PUEDE SER UN POSIBLE BUG
}

function modificarIHorario(){
    var datosRegistro = new Array(4);
    datosRegistro[0] = $("#fechaHorario").val();
    datosRegistro[1] = $("#dia").val();
    datosRegistro[2] = $("#hora").val();
    datosRegistro[3] = $("#distrito").val();
    datosRegistro[4] = $("#ruta").val();
    datosRegistro[5] = $("#producto").val();
    datosRegistro[6] = myCodeBean;

    $.post("./procesos/modificarIHorario.php", {valor: datosRegistro}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(3);
            buscarHorario(1);
            cancelarx();
        }else if(mensaje == "NUL"){
            modalOKI(4);
        }else{
            modalOKI(5);
        }
    });
}

function modalMul(des, code = 0){
    var text = "";
    switch(des){
        case 1:
            text = "¿Deseas Registrarlo?";
            $("#eventeame").attr('onclick', 'registrarIHorario();');
            break;
        case 2:
            text = "¿Deseas Modificarlo?";
            $("#eventeame").attr('onclick', 'modificarIHorario();');
            break;
        case 3:
            text = "¿Deseas Cancelarlo?";
            $("#eventeame").attr('onclick', 'cancelarx();');
            break;
        case 7:
            text = "¿Deseas Eliminarlo?";
            $("#eventeame").attr('onclick', 'eliminarIHorario(' + code + ');');
            break;
        default:
            console.log("NOTIFICACIÓN E-002");
            text = "NOTIFICACIÓN E-002";
            break;
    }

    document.getElementById('modalConcepto').textContent = text;
    $('#miModalEliminar').modal('show');
    $('#miModalEliminar').on('shown.bs.modal', function () {
        $('#cerrarMulti').focus();
    });
}

function modalOKI(des){
    var text = "";
    switch(des){
        case 1:
            text = "Los Campos estan vacios.";
            break;
        case 2:
            text = "Se Registro Correctamente.";
            break;
        case 3:
            text = "Se Modifico Correctamente.";
            break;
        case 4:
            text = "Error al Ejecutar la Operación.";
            break;
        case 7:
            text = "Se Elimino correctamente.";
            break;
        case 8:
            text = "Se Marco la asistencia.";
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

function mAsistencia(valor = ""){
    var my_mCode = valor.split("-");
    var my_mValor = document.getElementById("asistencia".concat(valor)).value;

    $.post("./procesos/marcarAsistencia.php", {v1: my_mCode[1], v2: my_mValor}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(8);
            buscarHorario(1);
            cancelarx();
        }else if(mensaje == "NUL"){
            modalOKI(4);
        }else{
            modalOKI(5);
        }
    });
}