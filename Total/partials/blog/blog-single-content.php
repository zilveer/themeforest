<?php
/**
 * Single blog post content
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="entry clr"<?php wpex_schema_markup( 'entry_content' ); ?>>
	<?php the_content(); ?>
</div><!-- .entry -->

<?php get_template_part( 'partials/link-pages' ); ?>