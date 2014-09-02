
$(document).ready(function(){
   $('#ac_position').on('click',function(e){
   		var ancho = $("#ac_position").width();
   		var alto = $("#ac_position").height();
       var posX = $(this).offset().left;
       var posY = $(this).offset().top;
       $('#aireacondicionado_posicionX').val(((e.pageX - posX)*100)/ancho);
       $('#aireacondicionado_posicionY').val(((e.pageY - posY)*100)/alto);
       $('#actarget').css('position','absolute');
       $('#actarget').css('left',(((e.pageX - posX)*100)/ancho)+'%');
       $('#actarget').css('top',(((e.pageY - posY)*100)/alto)+'%');
   });
});


