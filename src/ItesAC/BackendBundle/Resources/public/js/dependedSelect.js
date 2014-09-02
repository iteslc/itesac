
$(document).ready(function(){
    $('.changer').on('change',function() {
        var $changer = $(this);
        $($changer.attr('data-target')).attr('disabled',true);
        // ... retrieve the corresponding form.
        var $form = $(this).closest('form');
        // Simulate form data, but only include the selected value.
        var data = {};
        data[$changer.attr('name')] = $changer.val();
        // Submit data via AJAX to the form's action path.
        var inp=$("input[name='_method']");
        if(inp!==null){
            data[inp.attr('name')]=inp.attr('value');
            alert(data[inp.attr('name')]);
        }
        $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            data : data,
            error : function(xhr,er){
                alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
                alert("responseText: "+xhr.responseText);
            },
            success: function(html) {
                // Replace current field ...
                $($changer.attr('data-target')).replaceWith(
                    // ... with the returned one from the AJAX response.
                    $(html).find($changer.attr('data-target'))
                );
                $($changer.attr('data-target')).attr('disabled',false);
                // field now displays the appropriate values.
            }
        });
    });
});
