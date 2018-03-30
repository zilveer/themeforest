jQuery(document).ready(function($) {
    var portfolioItems = $('#portfolio-items');
    
    portfolioItems.sortable({
        update: function(event, ui) {
            
            opts = {
                url: ajaxurl,
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data:{
                    action: 'portfolio_item_sort',
                    order: portfolioItems.sortable('toArray').toString() 
                },
                success: function(response) {
                    return;
                },
                error: function(xhr,textStatus,e) {
                    alert(portfolio_item_sort_data.alert_error);					
                    return;
                }
            };
            $.ajax(opts);
        }
    });
});