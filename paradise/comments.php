<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to custom_theme_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Paradise
 */
?>

<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', TEMPLATENAME ); ?></p>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
				<!-- Start Commentlist -->
				<h3><?php _e('Discussion', TEMPLATENAME); ?>&nbsp;-&nbsp;<?php printf( _n( 'One Comment', '%s Comments', get_comments_number(), TEMPLATENAME ), number_format_i18n( get_comments_number() ) );
				?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<!-- Start Commentlist Navigation -->
				<div class="comments-navigation">
					<div class="comments-nav-previous"><?php previous_comments_link( __( 'Older Comments', TEMPLATENAME ) ); ?></div>
					<div class="comments-nav-next"><?php next_comments_link( __( 'Newer Comments', TEMPLATENAME ) ); ?></div>
				</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

				<ul id="commentlist">
					<?php
						/* Loop through and list the comments. Tell wp_list_comments()
						 * to use custom_theme_comment() to format the comments.
						 * If you want to overload this in a child theme then you can
						 * define custom_theme_comment() and that will be used instead.
						 * See custom_theme_comment() in photo_con/functions.php for more.
						 */
						wp_list_comments(array('callback' => 'custom_theme_comment'));
					?>
				</ul>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<!-- Start Commentlist Navigation -->
				<div class="comments-navigation">
					<div class="comments-nav-previous"><?php previous_comments_link( __( 'Older Comments', TEMPLATENAME ) ); ?></div>
					<div class="comments-nav-next"><?php next_comments_link( __( 'Newer Comments', TEMPLATENAME ) ); ?></div>
				</div> <!-- .navigation -->
				<hr />
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
				<p class="nocomments"><?php _e( 'Comments are closed.', TEMPLATENAME ); ?></p>
				<hr />
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

				<!-- Start Commentform -->
<?php comment_form(array(
	'title_reply' => __('leave a comment', TEMPLATENAME),
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'label_submit'         => __( 'Submit Comment' ),
	'comment_field'        => '<p><label for="your_message">' . __('Your Message:', TEMPLATENAME) . '</label><textarea id="your_message" cols="15" rows="7" name="comment"></textarea></p>',
)); ?>
