function exportarExcel(){
    var form = $(document.createElement('form'));
    $(form).attr("action", "procesos/exportarExcel.php");
    $(form).attr("method", "POST");
    $(form).css("display", "none");

    var my_fecha = $("<input>")
    .attr("type", "date")
    .attr("name", "my_fecha")
    .val(document.getElementById("fechaHorario").value);
    $(form).append($(my_fecha));

    form.appendTo(document.body);
    $(form).submit();

    //DESTROY
    form.remove();
}

function buscarHorario(des = 0){
    var text = $("#fechaHorario").val();
    $.post("./procesos/getHorarios.php", {valor: text}, function(mensaje) {
        console.log(mensaje);
        $("#contenidoIngreso").html(mensaje);
    });
}