<?php

/**
 * Pagination for pages of topics (when viewing a forum)
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php if ( x_bbpress_show_topic_pagination() ) : ?>

	<?php do_action( 'bbp_template_before_pagination_loop' ); ?>

	<div class="bbp-pagination x-pagination">
		<div class="bbp-pagination-links">

			<?php bbp_forum_pagination_links(); ?>

		</div>
	</div>

	<?php do_action( 'bbp_template_after_pagination_loop' ); ?>

<?php endif; ?>