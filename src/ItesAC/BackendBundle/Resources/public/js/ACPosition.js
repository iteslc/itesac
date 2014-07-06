
$(document).ready(function(){
   $('#ac_position').on('click',function(e){
       var posX = $(this).offset().left-4;
       var posY = $(this).offset().top-4;
       $('#aireacondicionado_posicionX').val(e.pageX - posX);
       $('#aireacondicionado_posicionY').val(e.pageY - posY);
       $('#actarget').css('position','relative');
       $('#actarget').css('left',(e.pageX - posX)+'px');
       $('#actarget').css('top',(e.pageY - posY)+'px');
   });
});


