jQuery(document).ready(function($) {
    var portfolioList = $('#portfolio-lists');
    
    portfolioList.sortable({
        update: function(event, ui) {
            
            opts = {
                url: ajaxurl,
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data:{
                    action: 'portfolio_reorder',
                    order: portfolioList.sortable('toArray').toString() 
                },
                success: function(response) {
                    return;
                },
                error: function(xhr,textStatus,e) {
                    alert('There was an error saving the update.');
                    return;
                }
            };
            $.ajax(opts);
        }
    });
});