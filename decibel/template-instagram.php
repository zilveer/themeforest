<?php
/**
 * Template Name: Instagram Gallery
 */
get_header();
wolf_page_before();

	if ( function_exists( 'wolf_instagram_gallery' ) ) wolf_instagram_gallery();

wolf_page_after();
get_footer();
?>
