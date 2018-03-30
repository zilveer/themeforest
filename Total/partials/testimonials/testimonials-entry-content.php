<?php
/**
 * Outputs the testimonial entry content
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="testimonial-entry-content clr">
	<span class="testimonial-caret"></span>
	<?php if ( wpex_get_mod( 'testimonial_entry_title', false ) ) : ?>
		<h2 class="testimonial-entry-title entry-title clr"><?php the_title(); ?></h2>
	<?php endif; ?>
	<div class="testimonial-entry-text"<?php wpex_schema_markup( 'entry_content' ); ?>><?php the_content(); ?></div>
</div>