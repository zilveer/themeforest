<?php
/**
 * The template for displaying quote post format
 */
 
	if( !is_single() ){ 
		global $gdlr_post_settings;
	}

	$post_format_data = '';
	$content = trim(get_the_content(__( 'Read More', 'gdlr_translate' )));	
	if(preg_match('#^\[gdlr_quote[\s\S]+\[/gdlr_quote\]#', $content, $match)){ 
		$post_format_data = gdlr_content_filter($match[0]);
		$content = substr($content, strlen($match[0]));
	}else if(preg_match('#^<blockquote[\s\S]+</blockquote>#', $content, $match)){ 
		$post_format_data = gdlr_content_filter($match[0]);
		$content = substr($content, strlen($match[0]));
	}		
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="gdlr-blog-content">
		<div class="gdlr-top-quote">
			<?php echo $post_format_data; ?>
		</div>
		<div class="gdlr-quote-author">
		<?php 
			if( is_single() || $gdlr_post_settings['excerpt'] < 0 ){
				echo gdlr_content_filter($content, true); 
			}else{
				echo gdlr_content_filter($content); 
			}
		?>	
		</div>
	</div>
</article><!-- #post -->
