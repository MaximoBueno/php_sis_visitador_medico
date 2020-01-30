var myCodeBean = 0;
function cerrarme() {
    $("#miModalEliminar .close").click();
}

function controlAdd(isNot){
    isNot = !isNot;
    $("#fechaHorario").prop("disabled", isNot);
    $("#producto").prop("disabled", isNot);
    $("#clinica").prop("disabled", isNot);
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

    document.getElementById("fechaHorario").value = "0000-00-00";
    document.getElementById("producto").value = "0";
    document.getElementById("clinica").value = "0";

    controlAdd(false);

    this.cerrarme(); //PUEDE SER UN POSIBLE BUG
}

function modalMul(des){
    var text = "";
    switch(des){
        case 1:
            text = "¿Deseas Registrarlo?";
            $("#eventeame").attr('onclick', 'registrarPClinica();');
            break;
        case 2:
            text = "¿Deseas Modificarlo?";
            $("#eventeame").attr('onclick', 'modificarPClinica();');
            break;
        case 3:
            text = "¿Deseas Cancelarlo?";
            $("#eventeame").attr('onclick', 'cancelarx();');
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

function buscarPClinica(des){
    var text = document.getElementById('bFechaHorario').value;

    if (des == 1){ text = "-"; }

    if (text == ""){ text = "-"; }

    if (text != "") {
        $.post("./procesos/buscarPClinica.php", {valor: text}, function(mensaje) {
            $("#contenidoIngreso").html(mensaje);
        });
    }
}

function registrarPClinica(){
    var datosRegistro = new Array(2);
    datosRegistro[0] = $("#fechaHorario").val();
    datosRegistro[1] = $("#producto").val();
    datosRegistro[2] = $("#clinica").val();

    $.post("./procesos/registrarPClinica.php", {valor: datosRegistro}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(2);
            buscarPClinica(1);
            cancelarx();
        }else if(mensaje == "NUL"){
            modalOKI(4);
        }else{
            modalOKI(5);
        }
    });
}

function obtenerRegistro(r){
    var fila0 =r.cells[1].innerText;
    var fila1 =r.cells[2].innerText;
    var fila2 =r.cells[3].innerText;
    var fila3 =r.cells[4].innerText;

    document.getElementById("fechaHorario").value = fila1;

    selectComboByText("producto", fila2);
    selectComboByText("clinica", fila3);

    myCodeBean = fila0;

    $("#btn-modificar").prop("disabled", false);
    $("#btn-cancelar").prop("disabled", false);
    $("#btn-nuevo").prop("disabled", true);
    $("#btn-registrar").prop("disabled", true);

    controlAdd(true);
}

function modificarPClinica(){
    var datosRegistro = new Array(3);
    datosRegistro[0] = $("#fechaHorario").val();
    datosRegistro[1] = $("#producto").val();
    datosRegistro[2] = $("#clinica").val();
    datosRegistro[3] = myCodeBean;

    $.post("./procesos/modificarPClinica.php", {valor: datosRegistro}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(3);
            buscarPClinica(1);
            cancelarx();
        }else if(mensaje == "NUL"){
            modalOKI(4);
        }else{
            modalOKI(5);
        }
    });
}

function exportarExcel(){
    var form = $(document.createElement('form'));
    $(form).attr("action", "procesos/exportarExcel.php");
    $(form).attr("method", "POST");
    $(form).css("display", "none");

    form.appendTo(document.body);
    $(form).submit();

    //DESTROY
    form.remove();
}