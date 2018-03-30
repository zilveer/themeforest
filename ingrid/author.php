<?php
/*
	Template for displaying post by an Author.
*/

get_header(); 

print '<section id="page" class="wrapper">
';


	$author = get_userdata(get_query_var('author'));
	
	print '
		<header class="heading">	
			<h1>'.__('AUTHOR ARCHIVES ','ingrid').'</h1>
			<h2>'. strtoupper(sprintf( __('%s','ingrid'), $author->display_name  )) .'</h2>			
		</header>	
		';
		

	


// check if page is full width or have sidebar -> check it at selected blog page.. if not set, use default widget area settings
	$blog_page_id = get_option('page_for_posts');
	$tp_pages_default_sb_widget_area = get_option('tp_pages_default_sb_widget_area');
	if(!empty($blog_page_id)){
		$curr_widget_area = get_post_meta($blog_page_id,'ub_widget_area',true);
		$GLOBALS['indexblog_id'] = $blog_page_id;
	}else{
		$curr_widget_area = '';
	}
	
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
		
				if ( $author->user_description  ){
					print '
					<article class="archive-meta archive-author">
						<p>';
						if(!empty($author->user_url)){
							print '<a href="'.$author->user_url.'" target="_blank">'.get_avatar( $author->user_email ).'</a>';
						}else{
							print get_avatar( $author->user_email );
						}
					print '
						<strong>'.$author->display_name.'</strong>
						<br /><br />'.$author->user_description.'</p>
						<hr class="hr2" />
					</article>
					';
				}		
					
	
				if ( have_posts() ){
					while ( have_posts() ) {
						the_post();

						get_template_part( 'content' );
					}
				}else{
					print '
					<article>
						<p><strong>'.__('There isn\'t any post from this author!','ingrid').'</strong></p>
					</article>';					
				}
	
		print '</section>';		
	
	}else{
	//if page has sidebar
		$tp_default_sidebar_position = get_option('tp_default_sidebar_position');
		if($tp_default_sidebar_position == 'left'){	
			//left sidebar
				get_sidebar();
				
				print '
				<section id="content" class="bloglist left-margin">
				';
				
				
				if ( $author->user_description  ){
					print '
					<article class="archive-meta archive-author">
						<p>';
						if(!empty($author->user_url)){
							print '<a href="'.$author->user_url.'" target="_blank">'.get_avatar( $author->user_email ).'</a>';
						}else{
							print get_avatar( $author->user_email );
						}
						print '
						<strong>'.$author->display_name.'</strong>
						<br /><br />'.$author->user_description.'</p>
						<hr class="hr2" />
					</article>
					';
				}		
				
				
				
				if ( have_posts() ){
					while ( have_posts() ) {
						the_post();

						get_template_part( 'content' );
					}
				}else{
					print '
					<article>
						<p><strong>'.__('There isn\'t any post from this author!','ingrid').'</strong></p>
					</article>';					
				}
		
				print '
				</section>
				';
		}else{
			//right sidebar
				print '
				<section id="content" class="bloglist">
				';
				
				if ( $author->user_description  ){
					print '
					<article class="archive-meta archive-author">
						<p>';
						if(!empty($author->user_url)){
							print '<a href="'.$author->user_url.'" target="_blank">'.get_avatar( $author->user_email ).'</a>';
						}else{
							print get_avatar( $author->user_email );
						}
						print '
						<strong>'.$author->display_name.'</strong>
						<br /><br />'.$author->user_description.'</p>
						<hr class="hr2" />
					</article>
					';
				}		
				
				
				
				if ( have_posts() ){
					while ( have_posts() ) {
						the_post();

						get_template_part( 'content' );
					}
				}else{
					print '
					<article>
						<p><strong>'.__('There isn\'t any post from this author!','ingrid').'</strong></p>
					</article>';					
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