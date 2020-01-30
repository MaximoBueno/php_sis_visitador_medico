var myCodeBean = 0;
function cerrarme() {
    $("#miModalEliminar .close").click();
}

function controlAdd(isNot){
    isNot = !isNot;
    $("#centroSalud").prop("disabled", isNot);
    $("#distrito").prop("disabled", isNot);
    $("#medico").prop("disabled", isNot);
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

    document.getElementById("centroSalud").value = "0";
    document.getElementById("distrito").value = "0";
    document.getElementById("medico").value = "0";
    document.getElementById("direccion").value = "";

    controlAdd(false);

    this.cerrarme(); //PUEDE SER UN POSIBLE BUG
}

function modalMul(des){
    var text = "";
    switch(des){
        case 1:
            text = "¿Deseas Registrarlo?";
            $("#eventeame").attr('onclick', 'registrarRuta();');
            break;
        case 2:
            text = "¿Deseas Modificarlo?";
            $("#eventeame").attr('onclick', 'modificarRuta();');
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

function buscarRuta(des){
    var text = $("input#buscar").val();

    if (des == 1){
        text = "%";
    }

    if(text == ""){
        text = "%";
    }

    if (text != "") {
        $.post("./procesos/buscarRuta.php", {valor: text}, function(mensaje) {
            $("#contenidoIngreso").html(mensaje);
        });
    }
}

function registrarRuta(){
    var datosRegistro = new Array(3);
    datosRegistro[0] = $("#centroSalud").val();
    datosRegistro[1] = $("#distrito").val();
    datosRegistro[2] = $("#medico").val();
    datosRegistro[3] = $("#direccion").val();

    $.post("./procesos/registrarRuta.php", {valor: datosRegistro}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(2);
            buscarRuta(1);
            cancelarx();
        }else if(mensaje == "NUL"){
            modalOKI(4);
        }else{
            modalOKI(5);
        }
    });
}

function verTexto(){
    var combo = document.getElementById("medico");
    var selected = combo.options[combo.selectedIndex].text;
    combo.selectedIndex = 1;
    alert(selected2);
}

function obtenerRegistro(r){
    var fila0 =r.cells[1].innerText;
    var fila1 =r.cells[2].innerText;
    var fila2 =r.cells[3].innerText;
    var fila3 =r.cells[4].innerText;
    var fila4 =r.cells[5].innerText;

    document.getElementById("direccion").value = fila4;
    
    selectComboByText("centroSalud", fila1);
    selectComboByText("distrito", fila2);
    selectComboByText("medico", fila3);

    myCodeBean = fila0;

    $("#btn-modificar").prop("disabled", false);
    $("#btn-cancelar").prop("disabled", false);
    $("#btn-nuevo").prop("disabled", true);
    $("#btn-registrar").prop("disabled", true);

    controlAdd(true);
}

function modificarRuta(){
    var datosRegistro = new Array(4);
    datosRegistro[0] = $("#centroSalud").val();
    datosRegistro[1] = $("#distrito").val();
    datosRegistro[2] = $("#medico").val();
    datosRegistro[3] = $("#direccion").val();
    datosRegistro[4] = myCodeBean;

    $.post("./procesos/modificarRuta.php", {valor: datosRegistro}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(3);
            buscarRuta(1);
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