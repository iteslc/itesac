$(document).ready(function(){
    var url;
    $('#all_on').length ? url='all/check' : url= '../planta/'+$('.planta').attr('data-id')+'/check';
    //llamada ajax a servidor
    $.ajax({
        dataType: 'json',
        url: url,
        type: 'GET',
        error: function(){
            alert('hubo un error al checar el estado de los aires.');
        },
        success: function(json){
            //correr el for para cada aire y contarlo en cada elemento
            if($('#all_on').length){
                var on=0; var off=0;
                $.map(json,function(elem){
                    var enc;
                    if(elem['isOn']){
                        enc='on';
                        on++;
                    } else {
                        enc='off';
                        off++;
                    }
                    var edi=$('#edificio_'+elem['edificio']+'_'+enc).find('span');
                    var con=parseInt(edi.text());
                    con++;
                    edi.text(String(con));
                });
                $('#all_on').find('span').text(String(on));
                $('#all_off').find('span').text(String(off));
            } else {
                var on=0; var off=0;
                $.map(json,function(elem){
                    var ac=$('#ac_'+elem['id']);
                    if(elem['isOn']){
                        ac.removeClass('is_off');
                        ac.addClass('is_on turn_off');
                        on++;
                    } else {
                        ac.removeClass('is_on');
                        ac.addClass('is_off');
                        off++;
                    }
                    
                });
                $('#planta_on').find('span').text(String(on));
                $('#planta_off').find('span').text(String(off));
            }
        }
    });
});
