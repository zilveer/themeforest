<?php
/**
 * Single Custom Post Type Media
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<h1 class="single-post-title entry-title"<?php wpex_schema_markup( 'heading' ); ?>><?php the_title(); ?></h1><!-- .single-post-title -->