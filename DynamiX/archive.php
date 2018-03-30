<?php
/**
 * @package WordPress
 * @subpackage NorthVantage
*/

	get_header(); 
	
	$NV_layout = of_get_option('arhlayout','layout_four');
	
	// Grid Layout Options
	$count = 1;
	$NV_postlayout = of_get_option('arhpostdisplay','');
	$NV_gridcols = of_get_option('arhpostcolumns','2');
	 
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
	
		if (have_posts()) : ?>
	

			<h2 class="archive-title">
            <?php
				if ( is_day() ) :
					printf( __( 'Daily Archives: %s', 'themeva' ), '<span>' . get_the_date() . '</span>' );
				elseif ( is_month() ) :
					printf( __( 'Monthly Archives: %s', 'themeva' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'themeva' ) ) . '</span>' );
				elseif ( is_year() ) :
					printf( __( 'Yearly Archives: %s', 'themeva' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'themeva' ) ) . '</span>' );
				elseif ( is_category() ) :
					printf( __( 'Archive For: %s', 'themeva' ), '<span>' . single_cat_title( '', false ) . '</span>' );		
				elseif ( get_post_type() == 'portfolio' ) :
					_e( 'Portfolio', 'themeva' );	
				else :
					_e( 'Archives', 'themeva' );
				endif;            
            ?>
            </h2>
			
            <?php
			while (have_posts()) : the_post();
	
				// Setup Grid Layout
				if( $NV_postlayout == 'grid' )
				{
					if( $count == $NV_gridcols )
					{
						$class = 'last';
						$count = 1;
					}
					elseif( $count == 1 )
					{
						$class= 'clear';
						$count++;
					}
					else
					{
						$class = '';	
						$count++;
					}
				
					echo '<div class="columns '. numberToWords( $NV_gridcols ) .'_column grid_layout '. $class .'">';
				
						get_template_part( 'content', get_post_format());
					
					echo '</div>';
				}
				else
				{
					get_template_part( 'content', get_post_format());
				}
						
			endwhile; 
			
		else :
	
			if ( is_category() ) { // If this is a category archive
				printf("<h2 class='center'>". __("Sorry, but there aren't any posts in the %s category yet.", 'themeva' ) ."</h2>", single_cat_title('',false));
			} else if ( is_date() ) { // If this is a date archive
				echo("<h2>". __( "Sorry, but there aren't any posts with this date.", 'themeva' )  ."</h2>");
			} else if ( is_author() ) { // If this is a category archive
				$userdata = get_userdatabylogin(get_query_var('author_name'));
				printf("<h2 class='center'>". __("Sorry, but there aren't any posts by %s yet.", 'themeva' ) ."</h2>", $userdata->display_name);
			} else {
				echo("<h2 class='center'>". __('No posts found.', 'themeva' ) ."</h2>");
			}
	
		endif;
	
		$postcount = 0; 
		
		global $wp_query;
	
		$total_pages = $wp_query->max_num_pages;
					
		if ($total_pages > 1)
		{	
			$current_page = max(1, get_query_var('paged'));
					  
			echo '<div class="page_nav">';
					  
				echo paginate_links(array(
					'base' => get_pagenum_link(1) . '%_%',
					'format' => 'page/%#%',
					'current' => $current_page,
					'total' => $total_pages,
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;'
				));
				
			echo '</div>';
		}
	
		wp_reset_query();

		echo "\n\t\t". '<div class="clear"></div>';
		echo "\n\t". '</div><!-- #content -->';
		
		get_sidebar(); 
	
	} // Hide Content *END* 
	 
	get_footer();		