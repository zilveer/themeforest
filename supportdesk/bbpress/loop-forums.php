<?php

/**
 * Forums Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_forums_loop' ); ?>

<ul id="forums-list-<?php bbp_forum_id(); ?>" class="bbp-forums">
<?php if (is_single()) { ?>
<li class="bbp-forum-header">
		<div class="bbp-forum-title"><?php the_title(); ?></div>
        <?php if ( ! bbp_is_forum_category() ) { ?><div class="bbp-forum-content"><?php the_content(); ?></div><?php } ?>
</li>
<?php } ?>

	<li class="bbp-body">

		<?php while ( bbp_forums() ) : bbp_the_forum(); ?>

			<?php bbp_get_template_part( 'loop', 'single-forum' ); ?>

		<?php endwhile; ?>

	</li><!-- .bbp-body -->


</ul><!-- .forums-directory -->

<?php do_action( 'bbp_template_after_forums_loop' ); ?>
