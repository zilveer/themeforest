jQuery(document).ready(function($) {
    var portfolioList = $('#portfolio_list');
    
    portfolioList.sortable({
        update: function(event, ui) {
            
            opts = {
                url: ajaxurl,
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data:{
                    action: 'portfolio_sort',
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