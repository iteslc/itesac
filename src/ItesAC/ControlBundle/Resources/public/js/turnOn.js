$(document).ready(function(){
    $('body').on('click','.turn_on',function(event){
        event.preventDefault();
        if(!enab){
            alert('espere a que termine el proceso');
            return;
        }
        var turner = $(this);
        var link;
        turner.hasClass('ac') ? link='../ac/'+turner.data('id')+'/on': link=turner.data('link');
        $.ajax({
            dataType: 'json',
            url: link,
            type:'GET',
            timeout:50000,
            error: function(){
                alert('hubo un error al tratar de encender.');
            },
            success: function(json){
                if(json['tail']!=null){
                    //si el json contiene datos sobre un proceso
                    //activara el proceso con los datos recibidos
                    //esta funcion estara en otra parte y podra ser llamada 
                    //desde cuando la pagina capta que hay un proceso desde 
                    //que es cargada
                    remoteProcess(json);
                }
                else{
                    if(turner.hasClass('ac')){
                        enab=false;
                        turnOnAC(turner);
                        var date=new Date();
                        date.setSeconds(date.getSeconds()+31);
                        $('#infobf').html('La aplicacion esta en proceso de encendido.');
                        $('#infoaf').html('para que pueda realizar acciones.');
                        $('#clock').countdown(date)
                            .on('update.countdown', function(event){
                                $(this).html(event.strftime(' %-S segundos '));
                            })
                            .on('finish.countdown', function(){
                                enab=true;
                            });
                    }
                    else {
                        //recibira los datos json
                        //encendera el primer ac con ajax y actualizara
                        //iniciara un countdown con 31 seg
                        //al final vera si hay mas ac en cola
                        //mientras haya encendera el siguiente, actualizara
                        //tambien dira cuantos hay en cola
                        if(json.length>0){
                            enab=false;
                            turnOneByOne(json,0);
                        }
                    }
                }
            }
        });
    });
});
function turnOneByOne(json,index){
    var tail=json.length-index-1;
    $.ajax({
        dataType: 'json',
        url: '/Geekly%20Development%20House/ItesAC/web/app_dev.php/control/ac/'+json[index]['id']+'/on/'+tail,
        type:'GET',
        error: function(){
            alert('hubo un error con el servidor.');
            enab=true;
        },
        success: function(data){
            if(data['id']!=null){
                alert('hubo un error al con el servidor.');
            }
            else{
                turnOnAC($('ac_'+json[index]['id']),json[index]['edificio']);
                var date=new Date();
                date.setSeconds(date.getSeconds()+31);
                var bf,af;
                if(tail===0){
                    bf='La aplicacion esta en proceso de encendido.';
                    af='para que pueda realizar acciones.';
                }
                else{
                    bf='La aplicacion esta en proceso de encendido.';
                    af='para encender el siguiente AC. Quedan '+tail+' por encender.';
                }
                $('#infobf').html(bf);
                $('#infoaf').html(af);
                $('#clock').countdown(date)
                    .on('update.countdown', function(event){
                        $(this).html(event.strftime(' %-S segundos '));
                    })
                    .on('finish.countdown', function(){
                        $(this).html('');
                        $('#infobf').html('');
                        $('#infoaf').html('');
                        if(tail>0){
                            index++;
                            turnOneByOne(json,index);
                        }
                        else{
                            enab=true;
                        }
                    });
            }
        }
    });
}
function turnOnAC(turner,edificio){
    if(!$('#all_on').length){
        turner.removeClass('is_off');
        turner.removeClass('turn_on');
        turner.addClass('is_on');
        turner.addClass('turn_off');
        var plaon=$('#planta_on').find('span');
        var plaoff=$('#planta_off').find('span');
        var con=parseInt(plaon.text());con++;
        var coff=parseInt(plaoff.text());coff--;
        plaon.text(String(con));
        plaoff.text(String(coff));
    }
    else{
        var edion=$('#edificio_'+edificio+'_on').find('span');
        var edioff=$('#edificio_'+edificio+'_off').find('span');
        var con=parseInt(edion.text());con++;
        var coff=parseInt(edioff.text());coff--;
        edion.text(String(con));
        edioff.text(String(coff));
        var allon=$('#all_on').find('span');
        var alloff=$('#all_off').find('span');
        con=parseInt(allon.text());con++;
        coff=parseInt(alloff.text());coff--;
        allon.text(String(con));
        alloff.text(String(coff));
    }
}
