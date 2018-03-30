<?php
/**
 * Template Name: Page Template with Revolution Slider
 *
 * A custom page template with Revolution Slider
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage trizzy
 * @since trizzy 1.0
 */

get_header();


$slider = get_post_meta($post->ID, 'pp_page_layer', true);
if($slider) {
        echo '<div class="container fullwidth-element home-slider">';    putRevSlider($slider); echo "</div>";
}


while ( have_posts() ) : the_post();
$layout  = get_post_meta($post->ID, 'pp_sidebar_layout', true);

switch ($layout) {
    case 'full-width':
        get_template_part( 'content', 'page' );
        break;
    case 'left-sidebar':
        get_template_part( 'content', 'pageleft' );
        break;
    case 'right-sidebar':
        get_template_part( 'content', 'pageright' );
        break;
    default:
        get_template_part( 'content', 'page' );
        break;
}

endwhile; // end of the loop.

get_footer(); ?>