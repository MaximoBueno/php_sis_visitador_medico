$(document).ready(function(){
    if ($(window).width() > 950){
        $('#uCheck').attr('checked','checked');
    }else{
        $('#uMain').removeClass('uMain-lg');
        $('#uLateral').removeClass('uLateral-lg');
        $('#uMain').addClass('uMain-sm');
        $('#uLateral').addClass('uLateral-sm');
        $('.contensMenuLat').css('overflow','auto');        
    }
});
$(window).resize(function(){
    if ($(window).width() > 950){        
        $('#uMain').removeClass('uMain-sm');        
        $('#uLateral').removeClass('uLateral-sm');
        $('#uMain').addClass('uMain-lg');
        $('#uLateral').addClass('uLateral-lg');        
        $('#uLateral').removeClass('u-Lateral');
        $('.contensMenuLat').css('overflow','hidden');
        if (document.getElementById('uCheck').checked == true) {
            $('#uMain').removeClass('uMain');        
            $('#uLateral').removeClass('uLateral');
        }else{
            $('#uMain').addClass('uMain');
            $('#uLateral').addClass('uLateral');
        }
    }else{
        $('#uMain').removeClass('uMain-lg');        
        $('#uLateral').removeClass('uLateral-lg');
        $('#uMain').addClass('uMain-sm');
        $('#uLateral').addClass('uLateral-sm');   
        $('.contensMenuLat').css('overflow','auto');     
        if (document.getElementById('uCheck').checked == true) { 
            $('#uLateral').addClass('u-Lateral');  
        }else{
            $('#uLateral').removeClass('u-Lateral');
        }
    }
});

function clickLabel(){
    if ($(window).width() > 950){
        if (document.getElementById('uCheck').checked == true) {
            $('#uMain').addClass('uMain');
            $('#uLateral').addClass('uLateral');
        }else{
            $('#uMain').removeClass('uMain');        
            $('#uLateral').removeClass('uLateral');
        }
    }else{
        if (document.getElementById('uCheck').checked == true) {   
            $('#uLateral').removeClass('u-Lateral');
        }else{
            $('#uLateral').addClass('u-Lateral');
        }
    }
}
function desplega(a) {
    $('#'+a).toggle("slow");
}