<?php
$output = $el_class = '';
extract(shortcode_atts(array(
	'fullwidth' => 'false',
	'id' => '',
	'padding' =>0,
	'attached' => 'false',
	'visibility' => '',
	'equal_height' => '',
	'content_placement' => '',
	'css' => '',
    'el_class' => '',
), $atts));

$fullwidth_start = $output = $fullwidth_end = '';

wp_enqueue_script( 'wpb_composer_front_js' );

$padding_css = ($attached == 'true') ? ' add-padding-'.$padding : '';

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = ' vc_row-o-equal-height';
}


if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = ' vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = ' vc_row-flex';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );


$id = $id ? (' id="'.$id.'" ') : '';

if($fullwidth == 'true') {
	global $post;
	$page_layout = get_post_meta( $post->ID, '_layout', true );
	$fullwidth_start = '</div></div></div>';
	if(is_singular('post')) {
		$fullwidth_start .= '</div>';
	}
	$fullwidth_end = '<div class="mk-main-wrapper-holder"><div class="theme-page-wrapper '.$page_layout.'-layout mk-grid vc_row-fluid no-padding"><div class="theme-content no-padding">';
	if(is_singular('post')) {
		$fullwidth_end .= '<div class="single-content">';
	}
}

$output .= $fullwidth_start . '<div'.$id.' class="'.esc_attr( trim( $css_class ) ).' '.$visibility.' mk-fullwidth-'.$fullwidth.$padding_css .' attched-'.$attached.'">';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>'.$fullwidth_end . $this->endBlockComment('row');
echo $output;