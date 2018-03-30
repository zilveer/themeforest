<?php

/**
 * Single Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<div class="container">
	<div class="col-md-8">
		<div id="bbpress-forums">

			<?php do_action( 'bbp_template_before_single_topic' ); ?>

			<?php if ( post_password_required() ) : ?>

				<?php bbp_get_template_part( 'form', 'protected' ); ?>

			<?php else : ?>

				<?php if ( bbp_has_replies() && is_user_logged_in() ) : ?>

					<?php bbp_get_template_part( 'loop',       'replies' ); ?>

					<?php bbp_get_template_part( 'pagination', 'replies' ); ?>

					<?php bbp_get_template_part( 'form', 'reply' ); ?>

				<?php else : ?>

					<?php bbp_get_template_part('content', 'single-topic-lead'); ?>

				<?php endif; ?>

			<?php endif; ?>

			<?php do_action( 'bbp_template_after_single_topic' ); ?>

		</div>
	</div>
	<div class="col-md-4">
		<?php dynamic_sidebar( 'Right Sidebar' ); ?>
	</div>
</div>
