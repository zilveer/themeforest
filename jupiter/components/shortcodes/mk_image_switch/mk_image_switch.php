<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$html = file_get_contents( $path . '/template.php' );
$html = phpQuery::newDocument( $html );
$id = Mk_Static_Files::shortcode_id();


$link = ( '||' === $link ) ? '' : $link;
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
	$use_link = true;
	$a_href = $link['url'];
	$a_title = $link['title'];
	$a_target = $link['target'];
	$a_rel = $link['rel'];
}

if ( $use_link ) {
	$attributes[] = 'href="' . trim( $a_href ) . '"';
	$attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
	if ( ! empty( $a_target ) ) {
		$attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
	}
	if ( ! empty( $a_rel ) ) {
		$attributes[] = 'rel="' . esc_attr( trim( $a_rel ) ) . '"';
	}
}

$first_image_id = mk_get_attachment_id_from_url($src_first);
$second_image_id = mk_get_attachment_id_from_url($src_second);

$first_image_alt = get_post_meta($first_image_id, '_wp_attachment_image_alt', true);
$second_image_alt = get_post_meta($second_image_id, '_wp_attachment_image_alt', true);

$svg = ($svg == 'true') ? ('style="max-width:'.$image_width.'px" ') : '';

// Main logic here
$image_box = pq('.mk-image-switch');
$image_container = $image_box->find('.image__container');
$image_box->attr( 'id', 'mk-image-switch-'.$id );
$image_box->addClass($el_class);

$image_box->addClass('align-'.$align);
$image_box->addClass($hover_animation.'-animation');

if ( $animation != '' ) {
	$image_box->addClass( get_viewport_animation_class($animation));
}




if ( $crop == 'true' ) {

	$cropped_first_src = Mk_Image_Resize::resize_by_url($src_first, $image_width, $image_height, $crop = true, $dummy = true);
	$cropped_second_src = Mk_Image_Resize::resize_by_url($src_second, $image_width, $image_height, $crop = true, $dummy = true);

	$image_container->append('<img alt="'.$first_image_alt.'" src="'.$cropped_first_src.'" class="first__image" />');
	$image_container->append('<img alt="'.$second_image_alt.'" src="'.$cropped_second_src.'" class="second__image" />');

}else {
	$image_container->append('<img alt="'.$first_image_alt.'" src="'.$src_first.'" class="first__image" />');
	$image_container->append('<img alt="'.$second_image_alt.'" src="'.$src_second.'" class="second__image" />');
}

if($use_link) {
	$image_container->wrap("<a ".implode( ' ', $attributes )."></a>");
}


/**
 * Collect JSON config for JS
 * ==================================================================================*/


/**
 * Custom CSS Output
 * ==================================================================================*/
$app_styles = '';
if( $margin_bottom > 0 ) {
	$app_styles .= '
		#mk-image-switch-'.$id.'{
			margin-bottom: '.$margin_bottom.'px;
		}
	';
}

if ( $crop == 'true' ) {
	$app_styles .= '
		#mk-image-switch-'.$id.'{
			height: '.$image_height.'px;
		}
		#mk-image-switch-'.$id.' .image__container {
			max-width: '.$image_width.'px;
			height: '.$image_height.'px;
		}
	';
}else {
	$image_size = getimagesize($src_first);
	$app_styles .= '
		#mk-image-switch-'.$id.'{
			height: '.$image_size[1].'px;
		}
		#mk-image-switch-'.$id.' .image__container {
			max-width: '.$image_size[0].'px;
			height: '.$image_size[1].'px;
		}
	';
}

Mk_Static_Files::addCSS($app_styles, $id);

print $html;
