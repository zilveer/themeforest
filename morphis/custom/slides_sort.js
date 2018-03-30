jQuery(document).ready(function($) {
    var slidesItems = $('#slides-items');
    
    slidesItems.sortable({
        update: function(event, ui) {
            
            opts = {
                url: ajaxurl,
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data:{
                    action: 'slides_sort',
                    order: slidesItems.sortable('toArray').toString() 
                },
                success: function(response) {
                    return;						
                },
                error: function(xhr,textStatus,e) {
                    alert(slides_sort_data.alert_error);					
                    return;
                }
            };
            $.ajax(opts);
        }
    });
});