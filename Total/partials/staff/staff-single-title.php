<?php
/**
 * Staff post title
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<header id="staff-single-header" class="single-header wpex-clr">
	<h1 id="staff-single-title" class="entry-title single-post-title"><?php the_title(); ?></h1>
	<?php get_template_part( 'partials/staff/staff-single-position' ); ?>
</header><!-- #staff-single-header -->