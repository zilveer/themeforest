jQuery(document).ready(function($) {
    var servicesItems = $('#services-items');
    
    servicesItems.sortable({
        update: function(event, ui) {
            
            opts = {
                url: ajaxurl,
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data:{
                    action: 'services_item_sort',
                    order: servicesItems.sortable('toArray').toString() 
                },
                success: function(response) {
                    return;
                },
                error: function(xhr,textStatus,e) {
                    alert(services_item_sort_data.alert_error);					
                    return;
                }
            };
            $.ajax(opts);
        }
    });
});