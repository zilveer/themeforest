<?php
/*
Template Name: Blog with full posts
*/

get_header(); 

print '<section id="page" class="wrapper">
';


//get which categories to display
	$getid = get_the_ID();
	if(!empty($getid)){
		$bc = get_post_meta(get_the_ID(), 'ub_blog_cats', true);
		if(is_array($bc)){
			$categories_to_display = implode(',',$bc);
		}
	}
	
	
	$paged = get_query_var('paged');
	if($paged == ''){ $paged = get_query_var('page'); }
	
	if(!empty($categories_to_display)){		
		$args=array(
			'post_type' => 'post',
			'paged' => $paged,
			'category_name' => $categories_to_display
		);		
	}else{
		$args=array(
			'post_type' => 'post',
			'paged' => $paged
			
		);
	}
	
	
// check if page is full width or have sidebar
	$tp_pages_default_sb_widget_area = get_option('tp_pages_default_sb_widget_area');
	$curr_widget_area = get_post_meta(get_the_ID(),'ub_widget_area',true);
	if($curr_widget_area != ''){		
		if($curr_widget_area != 'no-widget-area'){
			$GLOBALS['curr_widget_area'] = $curr_widget_area;
		}else{
			$curr_widget_area = '';
			$GLOBALS['curr_widget_area'] = '';
		}
	}elseif($tp_pages_default_sb_widget_area != ''){
		if($tp_pages_default_sb_widget_area != 'no-widget-area'){
			$curr_widget_area = $tp_pages_default_sb_widget_area;
			$GLOBALS['curr_widget_area'] = $tp_pages_default_sb_widget_area;
		}else{
			$curr_widget_area = '';
			$GLOBALS['curr_widget_area'] = '';
		}
	}


	//if no sidebar
	if($curr_widget_area == ''){
		print '
		<section id="full-width-content" class="bloglist fullposts">
		';

			
		
		// check & filter categories
			$wp_query = new WP_Query( $args );			
			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();
				
				
				get_template_part( 'content', 'fullposts' );

			}
			

				//pagination
					if(function_exists('wp_paginate')) {
						wp_paginate();		
					} 
					else{
						//display default next/prev links
						
						if($wp_query->max_num_pages > 1 ){								
							
							print '
							<div id="page_control">';
								next_posts_link('<div id="page_control-older">'.__('NEXT PAGE','ingrid').'</div>');
								previous_posts_link('<div id="page_control-newer">'.__('PREVIOUS PAGE ','ingrid').'</div>');
							print '
							</div>';
							
						}
					}			
			
			wp_reset_query();	
			wp_reset_postdata();
	
		print '</section>';		
	
	}else{
	//if page has sidebar
		$tp_default_sidebar_position = get_option('tp_default_sidebar_position');
		if($tp_default_sidebar_position == 'left'){	
			//left sidebar
				get_sidebar();
				
				print '
				<section id="content" class="left-margin bloglist fullposts">
				';
								
		
					
				
				// check & filter categories
					$wp_query = new WP_Query( $args );			
					while ( $wp_query->have_posts() ) {
						$wp_query->the_post();
						
						
						get_template_part( 'content', 'fullposts' );

					}
					

					//pagination
						if(function_exists('wp_paginate')) {
							wp_paginate();		
						} 
						else{
							//display default next/prev links
							
							if($wp_query->max_num_pages > 1 ){								
								
								print '
								<div id="page_control">';
									next_posts_link('<div id="page_control-older">'.__('NEXT PAGE','ingrid').'</div>');
									previous_posts_link('<div id="page_control-newer">'.__('PREVIOUS PAGE ','ingrid').'</div>');
								print '
								</div>';
								
							}
						}					
					
					wp_reset_query();	
					wp_reset_postdata();
				
				print '
				</section>
				';
		}else{
			//right sidebar
				print '
				<section id="content" class="bloglist fullposts">
				';
	
					
			
				// check & filter categories
					$wp_query = new WP_Query( $args );		
					while ( $wp_query->have_posts() ){
						$wp_query->the_post(); 
						
						
						get_template_part( 'content', 'fullposts' );

					}
					
									

					//pagination
						if(function_exists('wp_paginate')) {
							wp_paginate();		
						} 
						else{
							//display default next/prev links
							
							if($wp_query->max_num_pages > 1 ){								
								
								print '
								<div id="page_control">';
									next_posts_link('<div id="page_control-older">'.__('NEXT PAGE','ingrid').'</div>');
									previous_posts_link('<div id="page_control-newer">'.__('PREVIOUS PAGE ','ingrid').'</div>');
								print '
								</div>';
								
							}
						}							
					
					wp_reset_query();	
					wp_reset_postdata();
								
				print '
				</section>
				';

				get_sidebar();
		}
	}
		
		
print '
</section><!-- #page .wrapper -->
';		
 
get_footer(); 
?>