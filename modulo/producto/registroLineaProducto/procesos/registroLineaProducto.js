var modal_lv = 0;
$('.modal').on('shown.bs.modal', function (e) {
    $('.modal-backdrop:last').css('zIndex',1051+modal_lv);
    $(e.currentTarget).css('zIndex',1150+modal_lv);
    modal_lv++
});

/*EVALUAR SI ESTA INTERVENCION DEL EVENTO HIDEN VALE LA PENA O NO*/
$('.modal').on('hidden.bs.modal', function (e) {
    modal_lv--
});

function nuevo(){
    $('#miModalRegistro').modal('show');
    $('#miModalRegistro').on('shown.bs.modal', function () {
        $('#cerrarReg').focus();
    });
}

function cancelarx(){
    document.getElementById("lineaProducto").value = "";
    document.getElementById("descripcion").value = "";
    document.getElementById("producto").value = "0";

    this.cerrarme(); //PUEDE SER UN POSIBLE BUG
}

function modalMul(des, code = 0){
    var text = "";
    switch(des){
        case 1:
            text = "¿Deseas Registrarlo?";
            $("#eventeame").attr('onclick', 'registrarLineaProducto();');
            break;
        case 2:
            text = "¿Deseas Modificarlo?";
            $("#eventeame").attr('onclick', 'modificarLineaProducto();');
            break;
        case 3:
            text = "¿Deseas Cancelarlo?";
            $("#eventeame").attr('onclick', 'cancelarx();');
            break;
        case 4:
            text = "¿Deseas Registrarlo?";
            $("#eventeame").attr('onclick', 'registrarProducto();');
            break;
        case 7:
            text = "¿Deseas Eliminarlo?";
            $("#eventeame").attr('onclick', 'eliminar(' + code + ');');
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

function buscarLineaProducto(des){
    var text = $("input#buscar").val();

    if (des == 1){
        text = "%";
    }

    if(text == ""){
        text = "%";
    }

    if (text != "") {
        $.post("./procesos/buscarLineaProducto.php", {valor: text}, function(mensaje) {
            $("#contenidoIngreso").html(mensaje);
        });
    }
}

function registrarLineaProducto(){
    var datosRegistro = new Array(2);
    datosRegistro[0] = $("#lineaProducto").val();
    datosRegistro[1] = $("#descripcion").val();

    $.post("./procesos/registrarLineaProducto.php", {valor: datosRegistro}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(2);
            buscarLineaProducto(1);
            cancelarx();
        }else if(mensaje == "NUL"){
            modalOKI(4);
        }else{
            modalOKI(5);
        }
    });
}

var myCodeBean = 0;
function modificar(r){
    var indice = r.parentNode.parentNode.rowIndex - 1; //Indice llega como objeto (return int32 -> pos fila tabla)
    var tabla = document.getElementById('contenidoIngreso'); //Instanciamos al objeto tabla (return DataTable)

    var fila0 =tabla.rows[indice].cells[1].innerText; //Indexamos
    var fila1 =tabla.rows[indice].cells[2].innerText;
    var fila2 =tabla.rows[indice].cells[3].innerText;

    document.getElementById("mlineaProducto").value = fila1;
    document.getElementById("mdescripcion").value = fila2;

    myCodeBean = fila0;

    $('#miModalModificar').modal('show');
    $('#miModalModificar').on('shown.bs.modal', function () {
        $('#cerrarMod').focus();
    });
}

function modificarLineaProducto(){
    var datosRegistro = new Array(2);
    datosRegistro[0] = $("#mlineaProducto").val();
    datosRegistro[1] = $("#mdescripcion").val();
    datosRegistro[2] = myCodeBean;

    $.post("./procesos/modificarLineaProducto.php", {valor: datosRegistro}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(3);
            buscarLineaProducto(1);
            cancelarx();
        }else if(mensaje == "NUL"){
            modalOKI(4);
        }else{
            modalOKI(5);
        }
    });
}

function cerrarme(){
    $("#miModalEliminar .close").click();
    $("#miModalRegistro .close").click();
    $("#miModalModificar .close").click();
    $("#miModalRegPL .close").click();
    modal_lv = 0;
}

var myLineaCod = 0;
function cargarProducto(r, o){
    $("#btn-regresar").prop("disabled", false);
    $("#btn-nuevo").attr('onclick', 'nuevoProductoLineado();');
    document.getElementById('changeA').textContent = "Descripción";
    document.getElementById('changeB').textContent = "Producto";
    document.getElementById('changeC').textContent = "Eliminar";
    $('#buscadorPL').addClass('d-none');
    $('#titlePL').removeClass('d-none py-2');

    if(o == 1){
        myLineaCod = r.cells[1].innerText;
        document.getElementById('titlePL').textContent = r.cells[2].innerText; 
    }

    $("#contenidoIngreso").load("./procesos/cargarProductosLinea.php", {valor: myLineaCod});
}

function volverLineaProducto(){
    $.post("./procesos/buscarLineaProducto.php", {load: 1}, function(mensaje) {
        $("#btn-regresar").prop("disabled", true);
        $("#btn-nuevo").attr('onclick', 'nuevo();');
        document.getElementById('changeA').textContent = "Linea de Producto";
        document.getElementById('changeB').textContent = "Descripción";
        document.getElementById('changeC').textContent = "Modificar";
        $('#buscadorPL').removeClass('d-none');
        $('#titlePL').addClass('d-none py-2');
        $("#contenidoIngreso").html(mensaje);
    });
}

function registrarProducto(){
    var datosRegistro = new Array(2);
    datosRegistro[0] = myLineaCod;
    datosRegistro[1] = $("#producto").val();

    $.post("./procesos/registrarProducto.php", {valor: datosRegistro}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(2);
            cargarProducto(myLineaCod, 2);
            cancelarx();
        }else if(mensaje == "NUL"){
            modalOKI(4);
        }else{
            modalOKI(5);
        }
    });
}

function nuevoProductoLineado(){
    $('#miModalRegPL').modal('show');
    $('#miModalRegPL').on('shown.bs.modal', function () {
        $('#cerrarRegPL').focus();
    });
}

function eliminar(r){
    //var indice = r.parentNode.parentNode.rowIndex - 1;
    //var tabla = document.getElementById('contenidoIngreso');

    //var fila0 =tabla.rows[indice].cells[1].innerText; //Indexamos
    var fila0 = r;
    $.post("./procesos/eliminarProducto.php", {valor: fila0}, function(mensaje) {
        if(mensaje == "OK"){
            modalOKI(7);
            cargarProducto(myLineaCod, 2);
            cancelarx(); //EVFA
        }else if(mensaje == "NUL"){
            modalOKI(4);
        }else{
            modalOKI(5);
        }
    });
}

function exportarDLProducto(){
    var form = $(document.createElement('form'));
    $(form).attr("action", "procesos/exportarDLProducto.php");
    $(form).attr("method", "POST");
    $(form).css("display", "none");

    form.appendTo(document.body);
    $(form).submit();

    //DESTROY
    form.remove();
}

function exportarLProducto(){
    var form = $(document.createElement('form'));
    $(form).attr("action", "procesos/exportarLProducto.php");
    $(form).attr("method", "POST");
    $(form).css("display", "none");

    form.appendTo(document.body);
    $(form).submit();

    //DESTROY
    form.remove();
}