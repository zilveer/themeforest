jQuery(document).ready(function(){
	if(jQuery('.met_portfolio_row .span6:nth-child(2n + 1)').length > 0){
		jQuery('.met_portfolio_row .span6:nth-child(2n + 1)').addClass('nth-child-2np1');
	}
	if(jQuery('.met_portfolio_row .span4:nth-child(3n + 1)').length > 0){
		jQuery('.met_portfolio_row .span4:nth-child(3n + 1)').addClass('nth-child-3np1');
	}
    if(jQuery('.met_gallery .span3:nth-child(4n + 1)').length > 0){
        jQuery('.met_gallery .span3:nth-child(4n + 1)').addClass('nth-child-4np1');
    }
});