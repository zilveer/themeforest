<?php
/*
Template Name: Gallery Page
*/

get_header(); 


print '<section id="page" class="wrapper">
';


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
	<section id="full-width-content">
		<article id="post-'.get_the_ID().'">';
	
	if (have_posts()) :
		while ( have_posts() ) : the_post();
			the_content();
			wp_link_pages( array( 'before' => '<div class="page-links">' . __( '<strong>Pages:</strong>', 'ingrid' ), 'after' => '</div>' ) ); 
		endwhile;
	endif;
	
	print '
		</article>
	</section>
	';
}else{
	$tp_default_sidebar_position = get_option('tp_default_sidebar_position');
	if($tp_default_sidebar_position == 'left'){	
		//left sidebar
			get_sidebar();
			
			print '
			<section id="content" class="left-margin">
				<article id="post-'.get_the_ID().'">';
			
			if (have_posts()) :
				while ( have_posts() ) : the_post();
					the_content();
					wp_link_pages( array( 'before' => '<div class="page-links">' . __( '<strong>Pages:</strong>', 'ingrid' ), 'after' => '</div>' ) ); 
				endwhile;
			endif;
			
			print '
				</article>
			</section>
			';
	}else{
		//right sidebar
			print '
			<section id="content">
				<article id="post-'.get_the_ID().'">';
			
			if (have_posts()) :
				while ( have_posts() ) : the_post();
					the_content();
					wp_link_pages( array( 'before' => '<div class="page-links">' . __( '<strong>Pages:</strong>', 'ingrid' ), 'after' => '</div>' ) ); 
				endwhile;
			endif;
			
			print '
				</article>
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