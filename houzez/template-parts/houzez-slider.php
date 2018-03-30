<?php
/**
 * Houzez Slider
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 21/12/15
 * Time: 1:36 PM
 */
global $post;
$slider_type = get_post_meta( $post->ID, 'fave_slider_type', true );

if( $slider_type == 'property_slider' ) {
    get_template_part( 'template-parts/property', 'slider' );
} else {
    return;
}
?>