<?php
/**
 * Single Portfolio Template - This is the template for the single portfolio item content.
 */
get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		$subtitle=get_post_meta($post->ID, 'subtitle_value', true);
		$slider='none';
		$layout=get_opt('_portfolio_layout');
		$sidebar=get_opt('_portfolio_sidebar');
		$preview=get_post_meta($post->ID, 'preview_value', true);
		
		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true ); 
		
		if(get_post_meta($post->ID, 'show_title_value', true)!='hide'){ ?>
	  	<h1 class="page-heading"><?php the_title(); ?></h1><hr/><br />	
	  	<?php }
	  	
		if(get_post_meta($post->ID, 'show_preview_value', true)!='hide'){ ?>
			<img class="img-frame" alt="" src="<?php echo PEXETO_TIMTHUMB_URL.'?src='.$preview.'&amp;w=577&amp;zc=1&amp;q=80'; ?>" />
		<?php }
		
		
		the_content();
	}
}

if(get_opt('_portfolio_comments')=='on'){  
	comments_template();  
} 
	 
//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>

