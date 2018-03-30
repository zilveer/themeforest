<?php
/*
Template Name: Page - Full Width Slider
*/


get_header(); 



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


// full width slider
	$tp_page_fwslider_nocurvy = get_post_meta($post->ID, 'tp_page_fwslider_nocurvy', true);		
	
		
	
	print '
	<div id="tp-fw-slider"'; if(!empty($tp_page_fwslider_nocurvy)){print ' class="nocurvy"';} print '>
		<div class="tp-fws-image">
		';
			//load images			
			
			$tp_page_fwslider_images = get_post_meta($post->ID, 'tp_page_fwslider_images', true);		
			if(!empty($tp_page_fwslider_images)){
				$arrfwi = explode(',',$tp_page_fwslider_images);
				 //TRAVEL THE WORLD AND THE 7 SEAS..."
				foreach($arrfwi as $fwi){
					//caption?
					$expimg = explode('|',$fwi);
					if(!empty($expimg[1])){
						print '<div class="tp-fws-layers" data-caption="'.$expimg[1].'" style="background-image: url(\''.$expimg[0].'\')"></div>';
					}else{
						print '<div class="tp-fws-layers" style="background-image: url(\''.$fwi.'\')"></div>';
					}
				}				
			}
			
		print '
		</div>		';
		if(empty($tp_page_fwslider_nocurvy)){
			print '
			<div class="tp-fws-caption"></div>
			<div class="tp-fws-bottom"></div>
			';
		}else{
			print '
			<div class="tp-fws-caption captionb"></div>
			';
		}
		print '
		<a href="#" id="arrow-left"><img src="'.get_bloginfo('template_url').'/images/tp_fw_left.png" alt="left arrow" /></a>
		<a href="#" id="arrow-right"><img src="'.get_bloginfo('template_url').'/images/tp_fw_right.png" alt="right arrow" /></a>
	</div>';

	//fw slider options
	$tp_page_fwslider_pause = get_post_meta($post->ID, 'tp_page_fwslider_pause', true);		
	$tp_page_fwslider_speed = get_post_meta($post->ID, 'tp_page_fwslider_speed', true);	
	print '<script type="text/javascript">
	var tp_page_fwslider_pause = '.$tp_page_fwslider_pause.';
	var tp_page_fwslider_speed = '.$tp_page_fwslider_speed.';
	</script>';
	

print '<section id="page" class="wrapper">
';
	
	
	
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