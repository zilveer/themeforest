<?php
/**
 * @package WordPress
 * @subpackage NorthVantage
 */

	get_header();

	global $NV_layout;
	
	if( empty( $NV_layout ) )
	{
		$NV_layout = "layout_one";	
	}
	 
	if( $NV_hidecontent != "yes" )
	{ 	
		$columns = '';
		
		if( $NV_layout == "layout_one" ) 		$columns = 'twelve';
		elseif( $NV_layout == "layout_two" )	$columns = 'eight last';
		elseif( $NV_layout == "layout_three" )	$columns = 'six last';
		elseif( $NV_layout == "layout_four" )	$columns = 'eight';
		elseif( $NV_layout == "layout_five" )   $columns = 'six';
		elseif( $NV_layout == "layout_six" )  	$columns = 'six';
		else $columns = 'eight';	
		
		echo "\n\t". '<div id="content" class="columns '. $columns .' '. $NV_layout .'">';
							
		if (have_posts()) : while (have_posts()) : the_post(); 
		
				get_template_part( 'content','page' );
							
		endwhile;endif;	
		
		echo "\n\t\t". '<div class="clear"></div>';


		if( of_get_option('pagecomments') == 'enable' && ( comments_open() || get_comments_number() ) )
		{
			comments_template();
		}
		
		echo "\n\t". '</div><!-- #content -->';
		
		get_sidebar(); 
	
	} // Hide Content *END* 
	 
	get_footer();