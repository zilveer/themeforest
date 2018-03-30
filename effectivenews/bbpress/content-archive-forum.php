<?php

/**
 * Archive Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="bbpress-forums">
<div class="base-box">
	<?php if ( bbp_allow_search() ) : ?>
		<div class="bbp-search-form">
			<?php bbp_get_template_part( 'form', 'search' ); ?>
		</div>

	<?php endif; ?>
	<h1 class="page-title"><?php echo bbp_title('', ''); ?></h1>
	<?php bbp_forum_subscription_link(); ?>

	<?php do_action( 'bbp_template_before_forums_index' ); ?>

	<?php if ( bbp_has_forums() ) : ?>

		<?php bbp_get_template_part( 'loop',     'forums'    ); ?>

	<?php else : ?>

		<?php bbp_get_template_part( 'feedback', 'no-forums' ); ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_forums_index' ); ?>
</div>
</div>