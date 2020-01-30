var myCodeBean = 0;
function cerrarme() {
    $("#miModalEliminar .close").click();
}

function controlAdd(isNot){
    isNot = !isNot;
    $("#contrasenia").prop("disabled", isNot);
    $("#usuario").prop("disabled", isNot);
}

function nuevo(){
    $("#btn-modificar").prop("disabled", true);
    $("#btn-registrar").prop("disabled", false);
    $("#btn-cancelar").prop("disabled", false);
    controlAdd(true);
}

function cancelarx(){
    $("#btn-registrar").prop("disabled", true);
    $("#btn-modificar").prop("disabled", true);
    $("#btn-cancelar").prop("disabled", true);

    document.getElementById("apellidos").value = "";
    document.getElementById("nombres").value = "";
    document.getElementById("tipo_persona").value = "0";
    document.getElementById("usuario").value = "";
    document.getElementById("contrasenia").value = "";

    controlAdd(false);
    this.cerrarme(); //PUEDE SER UN POSIBLE BUG
}

function modalMul(des){
    var text = "";
    switch(des){
        case 1:
            text = "¿Deseas Registrarlo?";
            $("#eventeame").attr('onclick', 'registrarUsuario();');
            break;
        case 2:
            text = "¿Deseas Modificarlo?";
            $("#eventeame").attr('onclick', 'modificarUsuario();');
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

function buscarUsuario(des){
    var text = $("input#buscar").val();

    if (des == 1){
        text = "%";
    }

    if(text == ""){
        text = "%";
    }

    if (text != "") {
        $.post("./procesos/buscarUsuario.php", {valor: text}, function(mensaje) {
            $("#contenidoIngreso").html(mensaje);
        });
    }
}

function registrarUsuario(){
    var datosRegistro = new Array(3);
    datosRegistro[0] = myCodeBean;
    datosRegistro[1] = $("#tipo_persona").val();
    datosRegistro[2] = $("#usuario").val();
    datosRegistro[3] = $("#contrasenia").val();

    $.post("./procesos/registrarUsuario.php", {valor: datosRegistro}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(2);
            buscarUsuario(1);
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
    var fila4 =r.cells[5].innerText;
    var fila5 =r.cells[6].innerText;

    document.getElementById("apellidos").value = fila1;
    document.getElementById("nombres").value = fila2;
    document.getElementById("usuario").value = fila4;
    document.getElementById("contrasenia").value = fila5;

    selectComboByText("tipo_persona", fila3);

    myCodeBean = fila0;

    $("#btn-modificar").prop("disabled", false);
    $("#btn-cancelar").prop("disabled", false);
    $("#btn-registrar").prop("disabled", true);

    controlAdd(true);
}

function modificarUsuario(){
    var datosRegistro = new Array(2);
    datosRegistro[0] = $("#usuario").val();
    datosRegistro[1] = $("#contrasenia").val();
    datosRegistro[2] = myCodeBean;

    $.post("./procesos/modificarUsuario.php", {valor: datosRegistro}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(3);
            buscarUsuario(1);
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

$(function() {
    $(document).on('keydown', 'body', function(event) {
        if(event.keyCode==113){ //F2
            modalbuscar();
        }
    });
});

function modalbuscar(){
    $('#miModalBuscar').modal('show');
    $('#miModalBuscar').on('shown.bs.modal', function () {
        $('#buscarPaterno').focus();
    });
}

function buscarPersona(){
    var text = $("input#buscarPaterno").val();
    if (text != ""){
        $.post("./procesos/buscarPersona.php", {valor: text}, function(mensaje) {
            $("#conBuscarPersona").html(mensaje);
        });
    }
}

function getBuscarFila(e, ex) {
    var myObjectFill = document.getElementById("setbuscarNow");
    var tecla=(document.all) ? e.keyCode : e.which;
    if(tecla==13){
        seleccionarPersonal(myObjectFill);
    }
}

function seleccionarPersonal(r){
    if(r != null){
        var fila1 =r.cells[1].innerText;
        if(fila1 != ""){
            buscarDatos(fila1, 2);

        }
    }
}

function buscarDatos(codigo, r){
    var dato = null;
    $.post("./procesos/buscarDatos.php", {valor: codigo}, function(mensaje) {
        dato = mensaje.split("|");
        myCodeBean = dato[0];
        document.getElementById("apellidos").value = dato[1];
        document.getElementById("nombres").value = dato[2];
        document.getElementById("tipo_persona").value = dato[3];
        document.getElementById("usuario").value = dato[4];
        afterbusData();
    });
}

function afterbusData(){
    $("#miModalBuscar .close").click();
    controlAdd(true);
    $('#contrasenia').focus();
    nuevo();
}
