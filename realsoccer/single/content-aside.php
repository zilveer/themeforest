<?php
/**
 * The template for displaying posts in the Aside post format
 */
 
	if( !is_single() ){ 
		global $gdlr_post_settings;
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="gdlr-blog-content">
		<?php 
			if( is_single() || $gdlr_post_settings['excerpt'] < 0 ){
				echo gdlr_content_filter(get_the_content(__( 'Read More', 'gdlr_translate' )), true); 
			}else{
				echo gdlr_content_filter(get_the_content(__( 'Read More', 'gdlr_translate' ))); 
			}
		?>
	</div>
</article>
