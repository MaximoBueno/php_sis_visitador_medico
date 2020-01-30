var myCodeBean = 0;
function cerrarme() {
    $("#miModalEliminar .close").click();
}

function controlAdd(isNot){
    isNot = !isNot;
    $("#paterno").prop("disabled", isNot);
    $("#materno").prop("disabled", isNot);
    $("#nombres").prop("disabled", isNot);
    $("#tipo_documento").prop("disabled", isNot);
    $("#nro_documento").prop("disabled", isNot);
    $("#genero").prop("disabled", isNot);
    $("#fecha_nacimiento").prop("disabled", isNot);
    $("#direccion").prop("disabled", isNot);
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


    document.getElementById("paterno").value = "";
    document.getElementById("materno").value = "";
    document.getElementById("nombres").value = "";
    document.getElementById("tipo_documento").value = "0";
    document.getElementById("nro_documento").value = "";
    document.getElementById("genero").value = "0";
    document.getElementById("fecha_nacimiento").value = "0000-00-00";
    document.getElementById("direccion").value = "";

    controlAdd(false);

    this.cerrarme(); //PUEDE SER UN POSIBLE BUG
}

function modalMul(des){
    var text = "";
    switch(des){
        case 1:
            text = "¿Deseas Registrarlo?";
            $("#eventeame").attr('onclick', 'registrarPersonal();');
            break;
        case 2:
            text = "¿Deseas Modificarlo?";
            $("#eventeame").attr('onclick', 'modificarPersonal();');
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

function buscarPersonal(des){
    var text = $("input#buscar").val();

    if (des == 1){
        text = "%";
    }

    if(text == ""){
        text = "%";
    }

    if (text != "") {
        $.post("./procesos/buscarPersonal.php", {valor: text}, function(mensaje) {
            $("#contenidoIngreso").html(mensaje);
        });
    }
}

function registrarPersonal(){
    var datosRegistro = new Array(7);
    datosRegistro[0] = $("#paterno").val();
    datosRegistro[1] = $("#materno").val();
    datosRegistro[2] = $("#nombres").val();
    datosRegistro[3] = $("#tipo_documento").val();
    datosRegistro[4] = $("#nro_documento").val();
    datosRegistro[5] = $("#genero").val();
    datosRegistro[6] = $("#fecha_nacimiento").val();
    datosRegistro[7] = $("#direccion").val();

    $.post("./procesos/registrarPersonal.php", {valor: datosRegistro}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(2);
            buscarPersonal(1);
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
    var fila6 =r.cells[7].innerText;
    var fila7 =r.cells[8].innerText;
    var fila8 =r.cells[9].innerText;

    document.getElementById("paterno").value = fila1;
    document.getElementById("materno").value = fila2;
    document.getElementById("nombres").value = fila3;
    
    document.getElementById("nro_documento").value = fila5;
    
    document.getElementById("fecha_nacimiento").value = fila7;
    document.getElementById("direccion").value = fila8;
    
    selectComboByText("tipo_documento", fila4);
    selectComboByText("genero", fila6);

    myCodeBean = fila0;

    $("#btn-modificar").prop("disabled", false);
    $("#btn-cancelar").prop("disabled", false);
    $("#btn-nuevo").prop("disabled", true);
    $("#btn-registrar").prop("disabled", true);

    controlAdd(true);
}

function modificarPersonal(){
    var datosRegistro = new Array(9);
    datosRegistro[0] = $("#paterno").val();
    datosRegistro[1] = $("#materno").val();
    datosRegistro[2] = $("#nombres").val();
    datosRegistro[3] = $("#tipo_documento").val();
    datosRegistro[4] = $("#nro_documento").val();
    datosRegistro[5] = $("#genero").val();
    datosRegistro[6] = $("#fecha_nacimiento").val();
    datosRegistro[7] = $("#direccion").val();
    datosRegistro[8] = myCodeBean;

    $.post("./procesos/modificarPersonal.php", {valor: datosRegistro}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(3);
            buscarPersonal(1);
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