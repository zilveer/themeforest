<?php
/**
 * The template for the scroll down arrow for the fullscreen header
 * @package Pile
 * @since   Pile 1.2.1
 */


if ( get_post_type() == 'page' ) {
	$header_height = get_post_meta( get_the_ID(), '_pile_page_header_height', true );
} else {
	$header_height = get_post_meta( get_the_ID(), '_pile_project_header_height', true );
}
if ( empty($header_height) ) {
	$header_height = 'full-height'; //the default
}
if ( ( pile_option( 'hero_scroll_arrow' ) ) && ( $header_height == 'full-height' ) ) :
?>
<div class="hero-scroll-down">
	<svg class="arrows" width="22px" height="16px" viewBox="0 0 22 16">
        <g id="arrow-down" transform="translate(1.000000, 1.000000)" stroke="currentColor" stroke-width="1" fill="none" fill-rule="evenodd">
            <path d="M20.1428571,0.0563380282 L10,7.94366197 L-0.142857143,0.0563380282" id="arrow-1"></path>
            <path d="M20.1428571,6.05633803 L10,13.943662 L-0.142857143,6.05633803" id="arrow-2"></path>
        </g>
	</svg>
</div>
<?php endif; ?>