<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $css_class = $el_id = $full_width = $parallax_image = $parallax = '';
$bg_styles = $inline_styles = $wrapper_class = $section_wrapper_style = $bg_layer_style = ''; // theme specific

extract(shortcode_atts(array(
    'el_class'        => '',
    'el_id'           => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'css' => '',
    /* theme custom */
    'bg_maps'         => '',
    'bg_maps_height'  => '',
    'bg_parallax'     => '',
    'inertia'         => '0.2',
    'full_width' 	  => false,
), $atts));
$parallax_image_id = '';
$parallax_image_src = '';

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

if (function_exists('get_row_css_class') && function_exists('vc_shortcode_custom_css_class')) {
	$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row '.get_row_css_class().$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);
}

// $style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
$style = $this->buildStyle('', '', '', $font_color, $padding, $margin_bottom);

$css_class .= ( $full_width == 'stretch_row_content_no_spaces' )? ' vc_row-no-padding' : '';
$css_class .= ( ! empty( $parallax ) )? ' vc_general vc_parallax vc_parallax-' . $parallax : '';
$css_class .= ( ! empty( $parallax ) && strpos( $parallax, 'fade' ) )? ' js-vc_parallax-o-fade' : '';
$css_class .= ( ! empty( $parallax ) && strpos( $parallax, 'fixed' ) )? ' js-vc_parallax-o-fixed' : '';

$css_class .= ( ! empty( $full_width ) )? '" data-vc-full-width="true" data-vc-full-width-init="false" ' : '';
$css_class .= ( $full_width == 'stretch_row_content' || $full_width == 'stretch_row_content_no_spaces' )? ' data-vc-stretch-content="true" ' : '';

// parallax bg values
$bgSpeed = 1.5;
if ( $parallax ) {
    wp_enqueue_script( 'vc_jquery_skrollr_js' );

    $css_class .= '" data-vc-parallax="' . $bgSpeed . '" ';
}
if ( strpos( $parallax, 'fade' ) ) {
    $css_class .= ' data-vc-parallax-o-fade="on" ';
}
if ( $parallax_image ) {
    $parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
    $parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
    if ( ! empty( $parallax_image_src[0] ) ) {
        $parallax_image_src = $parallax_image_src[0];
    }
    $css_class .= ' data-vc-parallax-image="' . $parallax_image_src . '';
}

// Background CSS - Parse custom styles
preg_match_all('/[*]*background[-]*[image|color|repeat|position|size]*:[^;]*;/i', $css, $background_css);
$bg_styles = (isset($background_css) && !empty($background_css)) ? str_replace("!important", "", implode('',$background_css[0])) : '';
// Margin CSS - Parse custom styles
preg_match_all('/[*]*margin[-]*[top|right|bottom|left]*:[^;]*;/i', $css, $margin_css);
$inline_styles .= (isset($margin_css) && !empty($margin_css)) ? str_replace("!important", "", implode('',$margin_css[0])) : '';
// Padding CSS - Parse custom styles
preg_match_all('/[*]*padding[-]*[top|right|bottom|left]*:[^;]*;/i', $css, $padding_css);
$inline_styles .= (isset($padding_css) && !empty($padding_css)) ? str_replace("!important", "", implode('',$padding_css[0])) : '';
// Border CSS - Parse custom styles
preg_match_all('/[*]*border[-]*[top|right|bottom|left]*:[^;]*;/i', $css, $border_css);
$inline_styles .= (isset($border_css) && !empty($border_css)) ? str_replace("!important", "", implode('',$border_css[0])) : '';

// Update default VC styles variable
if (!empty($bg_styles) || !empty($inline_styles)) {
	// Prepare the style variable	
	$style = (isset($style) && !empty($style)) ? rtrim($style, '"').' ' : 'style="';
	// Remove bg image styles from VC row
	if (!empty($bg_styles))	{
		$style .= 'background: none !important; background-image: none !important; background-color: inherit !important;';
	}
	// Add other inline styles
	$style .= $inline_styles .'"';
}

// replace default color for progress bar
if (strpos($content, 'vc_progress_bar') !== false) {
	$content = str_replace('bgcolor="wpb_button"', '', $content);
}

// Setup theme specific containers and classes
$wrapper_class = 'vc_section_wrapper';

// Parallax
if ($bg_parallax) {
	$wrapper_class .= ' parallax-section';
}

// Background images
if ($bg_color || strpos($bg_styles,'background-color:') !== false) {
	$wrapper_class  .= ' has_bg_color';
	// backwards compatibility
	if ($bg_color) { 
		$bg_layer_style .= 'background-color:'. $bg_color .';'; 
	}
}
if ($bg_image || ($pos1 = strpos($bg_styles,'background:')) !== false && ($pos2 = strpos($bg_styles,'url(')) !== false) {
	if(isset($pos1) && isset($pos2) && $pos1 !== false && $pos2 !== false) {
		$bg_styles = str_replace(substr($bg_styles, $pos1+11, $pos2-$pos1-11), '', $bg_styles);
		$bg_styles = str_replace('background:', 'background-image:', $bg_styles);
	}
}
if ($bg_image || strpos($bg_styles,'background-image:') !== false ) {
	$wrapper_class  .= ' has_bg_img';
	// backwards compatibility
	if ($bg_image) { 
		$media = wp_get_attachment_image_src($bg_image, 'full');
		if ($bg_image_repeat == 'cover') {
			$wrapper_class  .= ' cover_all';		
		} else if ($bg_image_repeat == 'no-repeat') {
			$bg_layer_style .= 'background-repeat:no-repeat;';
		} else if ($bg_image_repeat == '') {
			$bg_layer_style .= 'background-repeat:repeat;';
		}
		$bg_layer_style .= 'background-image: url('.$media[0].');';
	}

}

// Maps
if ($bg_maps) {
	$wrapper_class .= ' wpb_map-section-full';
	$height = !$bg_maps_height ? 200 : $bg_maps_height;
	$section_wrapper_style = ' style="height: '.$height.'px"';
}

// Start the output
$output .= '<section class="'.$wrapper_class.'"'.$section_wrapper_style.'>';
if ($bg_layer_style || $bg_styles) {
	$bg_styles = $bg_styles . $bg_layer_style;
	$output .= '<div class="bg-layer" style="'. $bg_styles .'" data-inertia="'. $inertia .'"></div>';
}
// Maps output
if ($bg_maps) {
    $output .= '<div class="bg-layer cover_all" style="height: '.$height.'px;"><iframe width="100%" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$bg_maps.'&amp;t=m&amp;z=14&amp;output=embed"></iframe></div>';
}

// VC default output
$element_id = empty($el_id)? '' : 'id="'.$el_id.'" ';
$output .= '<div '.$element_id.' class="'.$css_class.'"'.$style.'>';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>'.$this->endBlockComment('row');

if ( ! empty( $full_width ) ) {
   $output .= '<div class="vc_row-full-width"></div>';
}

// Finish output
$output .= '</section>';

// Print
echo $output;