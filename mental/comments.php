<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

if ( post_password_required() ) { return; }
?>

<div class="comments" id="comments">
	<?php if (post_password_required()) : ?>
	<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'mental' ); ?></p>
</div>

<?php return;
endif; ?>

<?php if ( have_comments() ) : ?>

	<h3 class="cm-block-title"><?php comments_number(); ?></h3>
	<ul>
		<?php wp_list_comments( 'type=comment&callback=mental_comments' ); // Custom callback in includes/comments.php ?>
	</ul>

	<?php paginate_comments_links(); ?>

<?php elseif ( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

	<p><?php _e( 'Comments are closed here.', 'mental' ); ?></p>

<?php endif; ?>

</div> <!-- comments -->

<?php mental_comment_form(); ?>



