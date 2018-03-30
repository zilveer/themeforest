jQuery(document).ready(function($) {

	var pageNum = parseInt(portfolio.startPage) + 1;
	var max = parseInt(portfolio.maxPages);
	var nextLink = portfolio.nextLink;
	var items_per_line = portfolio.items_per_line;
	var load_more_text = portfolio.load_more_text;
	var loading_text = portfolio.loading_text;
	
	if(pageNum <= max) {
		$('.portfolio_section').append('<p id="load-more-portfolio-items"><a href="#">'+load_more_text+'</a></p>');
	}

	$('#load-more-portfolio-items a').click(function() {
	
		if(pageNum <= max) {
		
			$(this).text(loading_text);
			
			$.get(nextLink, function(data){ 
				$(data).find(".portfolio_"+items_per_line+"_col_item_wrapper").css("display", "inline-block").appendTo(".items_wrapper");
				
				pageNum++;
				nextLink = nextLink.replace(/\/page\/[0-9]*/, '/page/'+ pageNum);
				
				if(pageNum <= max) {
					$('#load-more-portfolio-items a').text(load_more_text);
				} else {
					$('#load-more-portfolio-items').css("display", "none");
				}
			});
			
		}
		
		return false;
		
	});
});