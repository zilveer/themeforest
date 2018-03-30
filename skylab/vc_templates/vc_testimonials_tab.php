<?php
$output = $image = $img_size = $name = $title = '';

extract(shortcode_atts(array(
	'image' => '',
	'img_size' => 'thumbnail',
	'title' => '',
	//'content' => $content,
	'name' => '',
	'title' => '',
	'title_color' => '',
), $atts));

$img_id = preg_replace('/[^\d]/', '', $image);
$img = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => $img_size ));
if ( $img == NULL ) $img['thumbnail'] = '';
$separator = '';
if ( $img !== NULL ) {
	$separator = ', ';
} else {
	$separator = '<br>';
}

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $this->settings['base']);
$output .= "\n\t\t\t" . '<li class="'.$css_class.'">';
    $output .= "\n\t\t\t\t" . '<div class="testimonial-wrapper">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div>';
		
        $output .= '<div class="testimonial-image-wrapper clearfix">';
            //$output .= ' <em></em>';
		    $output .= $img['thumbnail'];
			if ( $title_color == NULL )
			$output .= '<div class="testimonial-name-title-wrapper">';
			else
			$output .= '<div class="testimonial-name-title-wrapper" style="color: '.$title_color.';">';
				if ( $title_color == NULL )
					$output .= '<h3 class="testimonial-name">' . $name . '</h3>'. $separator;
				else
					$output .= '<h3 class="testimonial-name" style="color: '.$title_color.';">' . $name . '</h3>'. $separator;
				$output .= ' <span class="testimonial-title">' . $title . '</span>';
			$output .= ' </div>';
		$output .= ' </div>';
    $output .= "\n\t\t\t" . '</li> ' . $this->endBlockComment('li') . "\n";

echo $output;