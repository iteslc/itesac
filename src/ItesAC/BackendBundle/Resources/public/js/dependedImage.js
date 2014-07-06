
$(document).ready(function(){
   $('body').on('change','#aireacondicionado_planta',function(){
       var planta = $(this).val();
       $.ajax({
           //cambiar ruta cuando se configure el servidor, talvez
            url : '../planta/image/'+planta,
            type: 'GET',
            success: function(text) {
                $('#ac_position').css("background-image", "url("+text+")");
            }
        });
    });
});


