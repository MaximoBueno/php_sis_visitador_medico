var myCodeBean = 0;
function cerrarme() {
    $("#miModalEliminar .close").click();
}

function controlAdd(isNot){
    isNot = !isNot;
    $("#producto").prop("disabled", isNot);
    $("#descripcion").prop("disabled", isNot);
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

    document.getElementById("producto").value = "";
    document.getElementById("descripcion").value = "";

    controlAdd(false);

    this.cerrarme(); //PUEDE SER UN POSIBLE BUG
}

function modalMul(des){
    var text = "";
    switch(des){
        case 1:
            text = "¿Deseas Registrarlo?";
            $("#eventeame").attr('onclick', 'registrarProducto();');
            break;
        case 2:
            text = "¿Deseas Modificarlo?";
            $("#eventeame").attr('onclick', 'modificarProducto();');
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

function registrarProducto(){
    var datosRegistro = new Array(2);
    datosRegistro[0] = $("#producto").val();
    datosRegistro[1] = $("#descripcion").val();

    $.post("./procesos/registrarProducto.php", {valor: datosRegistro}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(2);
            buscarProducto(1);
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

    document.getElementById("producto").value = fila1;
    document.getElementById("descripcion").value = fila2;

    myCodeBean = fila0;

    $("#btn-modificar").prop("disabled", false);
    $("#btn-cancelar").prop("disabled", false);
    $("#btn-nuevo").prop("disabled", true);
    $("#btn-registrar").prop("disabled", true);

    controlAdd(true);
}

function modificarProducto(){
    var datosRegistro = new Array(3);
    datosRegistro[0] = $("#producto").val();
    datosRegistro[1] = $("#descripcion").val();
    datosRegistro[2] = myCodeBean;

    $.post("./procesos/modificarProducto.php", {valor: datosRegistro}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(3);
            buscarProducto(1);
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