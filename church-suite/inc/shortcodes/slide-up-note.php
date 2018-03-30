<?php function webnus_slideup( $attributes, $content = null ) {
	extract(shortcode_atts(array(
		'title'=>'',
		'slideup_content'=>'',
		'title_color'=>'#f67c7d',
	), $attributes));
	ob_start();
	$content = str_replace(array('<p>','</p>'),'',$content);
	echo '<article class="slideup-note"><h4 style="background-color:'.$title_color.'">'.$title.'</h4><p>'.$slideup_content.'</p></article>';
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
 }
add_shortcode('slideup', 'webnus_slideup'); ?>