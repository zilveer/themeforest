<?php 
	get_header(); 
	
	echo ebor_get_page_title( 
		get_option('portfolio_title','Our portfolio'), 
		$subtitle = get_option('portfolio_subtitle', 'The portfolio subtitle'), 
		$icon = false, 
		$thumbnail = ( get_option('foundry_portfolio_header_image') ) ? '<img src="'. get_option('foundry_portfolio_header_image') .'" alt="Portfolio Header" class="background-image" />' : false, 
		$layout = get_option('foundry_portfolio_header_layout', 'left-short-grey')
	);
	
	get_template_part('loop/loop-portfolio', get_option('portfolio_layout','parallax'));
	
	get_footer();