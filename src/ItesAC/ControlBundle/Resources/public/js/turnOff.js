$(document).ready(function(){
    $('body').on('click','.turn_off',function(event){
        event.preventDefault();
        if(!enab){
            alert('espere a que termine el proceso');
            return;
        }
        var turner = $(this);
        var link;
        turner.hasClass('ac') ? link='../ac/'+turner.data('id')+'/off': link=turner.data('link');
        $.ajax({
            url: link,
            type:'GET',
            error: function(){
                alert('hubo un error al tratar de apagar.');
            },
            success: function(){
                if(turner.hasClass('ac')){
                    turner.removeClass('is_on');
                    turner.removeClass('turn_off');
                    turner.addClass('is_off');
                    turner.addClass('turn_on');
                    var plaon=$('#planta_on').find('span');
                    var plaoff=$('#planta_off').find('span');
                    var con=parseInt(plaon.text());con--;
                    var coff=parseInt(plaoff.text());coff++;
                    plaon.text(String(con));
                    plaoff.text(String(coff));
                }
                else if(turner.hasClass('planta')){
                    $('.ac').removeClass('is_on');
                    $('.ac').addClass('is_off');
                    $('.ac').removeClass('turn_off');
                    $('.ac').addClass('turn_on');
                    var plaon=$('#planta_on').find('span');
                    var plaoff=$('#planta_off').find('span');
                    var con=parseInt(plaon.text());
                    var coff=parseInt(plaoff.text());
                    coff+=con;con=0;
                    plaon.text(String(con));
                    plaoff.text(String(coff));
                }
                else if(turner.hasClass('edificio')){
                    var edion=$('#edificio_'+turner.attr('data-id')+'_on').find('span');
                    var edioff=$('#edificio_'+turner.attr('data-id')+'_off').find('span');
                    var con=parseInt(edion.text());
                    var coff=parseInt(edioff.text());
                    var allon=$('#all_on').find('span');
                    var alloff=$('#all_off').find('span');
                    var acon=parseInt(allon.text());
                    var acoff=parseInt(alloff.text());
                    acon-=con;acoff+=con;
                    coff+=con;con=0;
                    edion.text(String(con));
                    edioff.text(String(coff));
                    allon.text(String(acon));
                    alloff.text(String(acoff));
                }
                else if(turner.hasClass('all')){
                    $('.edif_data').each(function(){
                        var edion=$(this).find('.cont_on').find('span');
                        var edioff=$(this).find('.cont_off').find('span');
                        var con=parseInt(edion.text());
                        var coff=parseInt(edioff.text());
                        coff+=con;con=0;
                        edion.text(String(con));
                        edioff.text(String(coff));
                    });
                    var allon=$('#all_on').find('span');
                    var alloff=$('#all_off').find('span');
                    var con=parseInt(allon.text());
                    var coff=parseInt(alloff.text());
                    coff+=con;con=0;
                    allon.text(String(con));
                    alloff.text(String(coff));
                }
            }
        });
    });
});
