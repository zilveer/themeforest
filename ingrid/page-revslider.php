<?php
/*
Template Name: Page - Revolution Slider
*/


get_header(); 



// revolution slider	
	$tp_page_revslider_id = get_post_meta($post->ID, 'tp_page_revslider_id', true);		
	$tp_page_revslider_nosep = get_post_meta($post->ID, 'tp_page_revslider_nosep', true);		
	
	if(function_exists('putRevSlider') && !empty($tp_page_revslider_id)){		
		putRevSlider($tp_page_revslider_id);		
	}else{
		$errmsg = print '<h3>Please install revolution slider plugin first!</h3>';
	}
	
	if(empty($tp_page_revslider_nosep)){
		print '<div id="revslider-tpborder"></div>';
	}


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
	
		if(!empty($errmsg)){print $errmsg;}
	
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