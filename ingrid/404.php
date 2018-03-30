<?php
/*
	Template for displaying 404 page.
*/
$post = (object) 'ciao';

get_header(); 



print '<section id="page" class="wrapper">
';

	print '
		<header class="heading">	
			<h1>'.__('PAGE NOT FOUND','ingrid').'</h1>
			<h2>'.__('ERROR #404','ingrid').'</h2>			
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
		<section id="full-width-content">
		';	
		
		
					print '
					<article>
						<p><strong>'. __( 'The requested page doesn\'t exist!', 'ingrid' ).'</strong><br /><br /></p>
					</article>';					
				
	
		print '</section>';		
	
	}else{
	//if page has sidebar
		$tp_default_sidebar_position = get_option('tp_default_sidebar_position');
		if($tp_default_sidebar_position == 'left'){	
			//left sidebar
				get_sidebar();
				
				print '
				<section id="content" class="left-margin">
				';
				
			
					print '
					<article>
						<p><strong>'. __( 'The requested page doesn\'t exist!', 'ingrid' ).'</strong><br /><br /></p>
					</article>';					
				
		
				print '
				</section>
				';
		}else{
			//right sidebar
				print '
				<section id="content">
				';
				
					print '
					<article>
						<p><strong>'. __( 'The requested page doesn\'t exist!', 'ingrid' ).'</strong><br /><br /></p>
					</article>';					
				
				
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