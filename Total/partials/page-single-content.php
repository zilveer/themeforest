<?php
/**
 * Page Content
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="entry clr"<?php wpex_schema_markup( 'entry_content' ); ?>>
	<?php the_content(); ?>
	<?php get_template_part( 'partials/link-pages' ); ?>
</div>