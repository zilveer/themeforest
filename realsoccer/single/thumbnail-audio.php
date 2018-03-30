<?php
/**
 * The template for displaying audio post format
 */
	global $gdlr_post_settings; 
	
	$post_format_data = '';
	$content = trim(get_the_content(__('Read More', 'gdlr_translate')));		
	if(preg_match('#^https?://\S+#', $content, $match)){ 				
		$post_format_data = do_shortcode('[audio src="' . $match[0] . '" ][/audio]');
		$gdlr_post_settings['content'] = substr($content, strlen($match[0]));					
	}else if(preg_match('#^\[audio\s.+\[/audio\]#', $content, $match)){ 
		$post_format_data = do_shortcode($match[0]);
		$gdlr_post_settings['content'] = substr($content, strlen($match[0]));
	}else{
		$gdlr_post_settings['content'] = $content;
	}	

	if ( !empty($post_format_data) ){
		echo '<div class="gdlr-blog-thumbnail gdlr-audio">' . $post_format_data . '</div>';
	} 
			
			
?>	
