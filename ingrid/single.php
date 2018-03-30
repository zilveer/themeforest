<?php
/*
	Template for displaying all single posts.
*/


get_header();



print '<section id="page" class="wrapper">
';


	$tp_posts_default_sb_widget_area = get_option('tp_posts_default_sb_widget_area');
	$curr_widget_area = get_post_meta(get_the_ID(),'ub_widget_area',true);
	if($curr_widget_area != ''){		
		if($curr_widget_area != 'no-widget-area'){
			$GLOBALS['curr_widget_area'] = $curr_widget_area;
		}else{
			$curr_widget_area = '';
			$GLOBALS['curr_widget_area'] = '';
		}
	}elseif($tp_posts_default_sb_widget_area != ''){
		if($tp_posts_default_sb_widget_area != 'no-widget-area'){
			$curr_widget_area = $tp_posts_default_sb_widget_area;
			$GLOBALS['curr_widget_area'] = $tp_posts_default_sb_widget_area;
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
		
				if ( have_posts() ){
					while ( have_posts() ) {
						the_post();

						get_template_part( 'content', 'single' );
					}
				}
	
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
				
				if ( have_posts() ){
					while ( have_posts() ) {
						the_post();

						get_template_part( 'content', 'single' );
					}
				}
		
				print '
				</section>
				';
		}else{
			//right sidebar
				print '
				<section id="content">
				';
				
				
				if ( have_posts() ){
					while ( have_posts() ) {
						the_post();

						get_template_part( 'content', 'single' );
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