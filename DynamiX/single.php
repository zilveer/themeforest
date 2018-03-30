<?php
/**
 * @package WordPress
 * @subpackage NorthVantage
 */

	get_header();

	global $NV_layout;

	if( empty( $NV_layout ) )
	{
		$NV_layout = of_get_option('pagelayout'); 
	}
		
	if( $NV_hidecontent != "yes" )
	{
		if (have_posts()) : 
	
			$columns = '';
			
			if( $NV_layout == "layout_one" ) 		$columns = 'twelve';
			elseif( $NV_layout == "layout_two" )	$columns = 'eight last';
			elseif( $NV_layout == "layout_three" )	$columns = 'six last';
			elseif( $NV_layout == "layout_four" )	$columns = 'eight';
			elseif( $NV_layout == "layout_five" )   $columns = 'six';
			elseif( $NV_layout == "layout_six" )  	$columns = 'six';
			else $columns = 'eight';	
		
			echo "\n\t". '<div id="content" class="columns '. $columns .' '. $NV_layout .'">';
	
			while (have_posts()) : the_post();
	
				get_template_part( 'content', get_post_format() );
							
			endwhile; endif; 

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}				
			
			echo "\n\t". '</div><!-- #content -->'; 
			
			get_sidebar();
	
	} // Hide Content *END*  

	get_footer();