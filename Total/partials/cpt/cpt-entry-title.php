<?php
/**
 * Custom Post Type Entry Title
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<header class="cpt-entry-header wpex-clr">
	<h2 class="cpt-entry-title entry-title">
		<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h2><!-- .cpt-entry-title -->
</header><!-- .cpt-entry-header -->