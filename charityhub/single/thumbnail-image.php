<?php
/**
 * The template for displaying image post format
 */
	global $gdlr_post_settings; 

	$post_format_data = '';
	$content = trim(get_the_content(__( 'Read More', 'gdlr_translate' )));
	if(preg_match('#^<a.+<img.+/></a>|^<img.+/>#', $content, $match)){ 
		$post_format_data = $match[0];
		$gdlr_post_settings['content'] = substr($content, strlen($match[0]));
	}else if(preg_match('#^https?://\S+#', $content, $match)){
		$post_format_data = gdlr_get_image($match[0], 'full', true);
		$gdlr_post_settings['content'] = substr($content, strlen($match[0]));					
	}else{
		$gdlr_post_settings['content'] = $content;
	}
	
	if ( !empty($post_format_data) ){
		echo '<div class="gdlr-blog-thumbnail">';
		echo $post_format_data; 
		
		if( !is_single() && is_sticky() ){
			echo '<div class="gdlr-sticky-banner">';
			echo '<i class="icon-bullhorn" ></i>';
			echo __('Sticky Post', 'gdlr_translate');
			echo '</div>';
		}					
		echo '</div>';
	} 
	?>	
