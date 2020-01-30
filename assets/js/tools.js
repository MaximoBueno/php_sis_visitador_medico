if (!String.prototype.trim) {
    (function() {
        // VER SI ES NECESARIO ESTA VAINA LOCA PARA LA TREACION GLOBAL DE LA FUNCION TRIM()
        var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
        String.prototype.trim = function() {
            return this.replace(rtrim, '');
        };
    })();
}

function pulsarTecla(e, ex) {
    var tecla=(document.all) ? e.keyCode : e.which;
    if(tecla==13){
        filtroMV();
    }
}

function filtroMV(){
    var myMenu = document.getElementById("myMenuVertical"); //=> my menu completo
    var myMVLi = myMenu.getElementsByTagName("ul"); //=> my list
    var nuLi = myMVLi.length;
    var myEleccion = document.getElementById("buscadorMV").value;
    if( myEleccion == ""){
        for(var i = 0; i< nuLi; i++){
            myMVLi[i].classList.remove("d-none");
        }
    }else{
        for(var i = 0; i< nuLi; i++){
            if(myMVLi[i].textContent.indexOf(myEleccion) > 0){
                //console.log(i);
                // $('#uMain').removeClass('uMain-sm');   
                console.log(i);
                myMVLi[i].classList.remove("d-none");
            }else{
                myMVLi[i].classList.add("d-none");
            }
        }
    }
}

function selectComboByText(id, texto){
    var eid = document.getElementById(id);
    for (var i = 0; i < eid.options.length; ++i) {
        if (eid.options[i].text === texto){
            eid.options[i].selected = true;
            break;
        }
    }
}

function validarNone(valores){
    var myReturn = false;
    var tam = valores.length;
    for(var i = 0; i < tam; i++){
        if(valores[i]== 0){
            myReturn = false;
            break;
        }else{
            myReturn = true;
        }
    }
    return myReturn;
}