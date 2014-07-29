function remoteProcess(json){
    //consiste en un countdown con datos de cuantos ac hay en 
    //cola para encender y cuando llegue a su fin
    //volvera a conseguir informacion de cola, actualizar datos
    //y si aun esta el proceso repetir la funcion
    enab=false;
    var time=(35-parseInt(json['lastOn']));
    var date=new Date();
    date.setSeconds(date.getSeconds()+time);
    var bf,af;
    if(json['tail']===0){
        bf='La aplicacion esta en proceso de encendido.';
        af='para que pueda realizar acciones.';
    }
    else{
        bf='La aplicacion esta en proceso de encendido.';
        af='para encender el siguiente AC. Quedan '+json['tail']+' por encender.';
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
            if(json['tail']!==0){
                $.ajax({
                    dataType: 'json',
                    url: '/control/checkprocess',
                    type:'GET',
                    error: function(){
                        alert('hubo un error con el servidor.');
                        enab=true;
                    },
                    success: function(json){
                        remoteProcess(json);
                    }
                });
            }
            else{
                enab=true;
            }
    });
}
