<?php
/*
	This page displays blog posts
*/

get_header(); 

print '<section id="page" class="wrapper">
';

//get real page id
	$real_page_id = get_option('page_for_posts');
	$GLOBALS['indexblog_id'] = $real_page_id;
	
// if page template is with full width heading title
	if(get_post_meta($real_page_id, '_wp_page_template', true) == 'page-with_title.php'){
		$tp_page_title = get_post_meta($real_page_id, 'tp_page_title', true);
		$tp_page_stitle = get_post_meta($real_page_id, 'tp_page_stitle', true);
		
		print 
		'<header class="heading">	
		';
		
			if(!empty($tp_page_title)){ print '<h1>'.$tp_page_title.'</h1>'; }
			if(!empty($tp_page_stitle)){ print '<h2>'.$tp_page_stitle.'</h2>'; }
			
		print '
		</header>	
		';
	}

//get which categories to display
	if(!empty($real_page_id)){
		$bc = get_post_meta($real_page_id, 'ub_blog_cats', true);
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
	$curr_widget_area = get_post_meta($real_page_id,'ub_widget_area',true);
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
		<section id="full-width-content" class="bloglist">
		';

		
		// get content for this page if there's any
			if(!empty($real_page_id)){
				$page_data = get_page( $real_page_id ); 
				$content = $page_data->post_content;	
			}
					
			if($GLOBALS['nu_wp_version'] == '1'){										
				$content = apply_filters('the_content',$content);						
			}
					
			if(!empty($content)){
				print '
				<article>
					'.do_shortcode($content).'
				</article>';
			}
			
		
		
		// check & filter categories
			$wp_query = new WP_Query( $args );			
			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();
				
				
				get_template_part( 'content' );

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
				<section id="content" class="left-margin bloglist">
				';
								
				// get content for this page if there's any
					if(!empty($real_page_id)){
						$page_data = get_page( $real_page_id ); 
						$content = $page_data->post_content;	
					}
					
					if($GLOBALS['nu_wp_version'] == '1'){										
						$content = apply_filters('the_content',$content);						
					}
					
					if(!empty($content)){
						print '
						<article>
							'.do_shortcode($content).'
						</article>';
					}
					
				
				// check & filter categories
					$wp_query = new WP_Query( $args );			
					while ( $wp_query->have_posts() ) {
						$wp_query->the_post();
						
						
						get_template_part( 'content' );

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
				<section id="content" class="bloglist">
				';
										
				// get content for this page if there's any
					if(!empty($real_page_id)){
						$page_data = get_page( $real_page_id ); 
						$content = $page_data->post_content;	
					}
					
					if($GLOBALS['nu_wp_version'] == '1'){										
						$content = apply_filters('the_content',$content);						
					}
					
					if(!empty($content)){
						print '
						<article>
							'.do_shortcode($content).'
						</article>';
					}
					
			
				// check & filter categories
					$wp_query = new WP_Query( $args );		
					while ( $wp_query->have_posts() ){
						$wp_query->the_post(); 
						
						//get_template_part( 'content', get_post_format() );
						get_template_part( 'content' );

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