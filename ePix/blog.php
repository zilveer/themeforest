<?php
/**
 * @package WordPress
 * @subpackage NorthVantage
*/

/*
Template Name: Blog
*/ 

	get_header();  

	global $NV_layout;
	 
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
				
				if(have_posts()) : the_post(); 
				
					$content = get_the_content(); 
					
					if( $content != '' )
					{ ?>                            
						<div class="entry">
							<?php echo do_shortcode($content); // Check if there is content ?>
						</div><!-- /entry -->                   
					<?php
					} 
				
				endif;
				
				// Selected Blog Categories	
				if( !empty($NV_archivecat) )
				{ 
					// Get category ID Array
					$cats = '';
					
					foreach ($NV_archivecat as $catlist)
					{ 
						$cats = $cats.",".$catlist;
					}
				}
			
				if(empty($cats)) $cats='';
				
				$cats = lTrim($cats,',');
				$cat_isnum = str_replace(",","", $cats); // join cats to check if numeric
				
				// backwards compatible with post id
				if (is_numeric ($cat_isnum))
				{ 
					$cat_type= "cat";
				}
				// if not numeric, use category name
				else
				{
					$cat_type= "category_name";
				}
			
				if( is_home() || is_front_page() )
				{
					$paged = (get_query_var('page')) ? get_query_var('page') : 1;
				}
				else
				{
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				}
			
				// Filter Post Formats
				$filterformats = '';
				
				if( !empty( $NV_filterformats ) )
				{
					foreach( $NV_filterformats as $format )
					{
						$filterformats[] = 'post-format-'. $format;
					}
				}
			
				$args = array(
					$cat_type => $cats,
					'paged' => $paged,				
					'tax_query' => array(
						array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => $filterformats,
						'operator' => 'NOT IN'
					)
				  )
				);
				
				query_posts( $args );

				$count = 1;
		
				$NV_gridcols = ( of_get_option('arhpostcolumns') !='' ) ? of_get_option('arhpostcolumns') : '2';
				
				$NV_postlayout = ( !empty( $NV_postlayout  ) ) ? $NV_postlayout : '';
				
				if( $NV_postlayout == 'grid' )
				{
					echo '<div class="row">';
				}
			
				if ( have_posts()) :
				
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
				
				if( $NV_postlayout == 'grid' )
				{
					echo '</div>';
				}
			
			$postcount = 0; 
							
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