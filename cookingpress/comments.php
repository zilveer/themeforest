<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to cookingpress_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package CookingPress
 */

	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;
	?>



	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
	<section id="comments" class="comments-sec">
		<h3 class="comments-title">
			<span><?php
				printf(_n('One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'cookingpress'), number_format_i18n(get_comments_number()), '' . get_the_title() . '');
			?></span>
		</h3>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'cookingpress' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'cookingpress' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'cookingpress' ) ); ?></div>
		</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
	<?php endif; // check for comment navigation ?>

	<ol class="commentlist">
		<?php
		/* Loop through and list the comments. Tell wp_list_comments()
		 * to use nevia_comment() to format the comments.
		 * If you want to overload this in a child theme then you can
		 * define nevia_comment() and that will be used instead.
		 * See nevia_comment() in inc/template-tags.php for more.
		 */
		wp_list_comments( array( 'callback' => 'cookingpress_comment' ) );
		?>
	</ol><!-- .commentlist -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
				<h1 class="assistive-text"><?php _e( 'Comment navigation', 'cookingpress' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'cookingpress' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'cookingpress' ) ); ?></div>
			</nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

	</section>

<?php endif; // have_comments() ?>

<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
<p class="nocomments"><?php _e( 'Comments are closed.', 'cookingpress' ); ?></p>
<?php endif; ?>

<?php


comment_form(); ?>





