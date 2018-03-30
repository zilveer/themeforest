<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to wpdance_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Oswad Market
 * @since WD_Responsive
 */
?>
<?php
	global $smof_data;
?>
			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'wpdance' ); ?></p>
			</div><!-- #comments -->
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
	<?php if( absint($smof_data['wd_blog_details_commentlist']) == 1 ) : ?>
			<div class="wd_title_comment">
				<h3 class="heading-title" id="comments-title"><?php
				global $post;
				?>
				<?php
					echo stripslashes(esc_attr($smof_data['wd_blog_details_commentlabel']));
					$comment_number = get_comments_number();
					echo " (".(($comment_number < 10)?'0'.$comment_number:$comment_number).")";
				?>
				</h3>
			</div>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
						<div class="navigation">
							<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'wpdance' ) ); ?></div>
							<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'wpdance' ) ); ?></div>
						</div> <!-- .navigation -->
			<?php endif; // check for comment navigation ?>
			
			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use wpdance_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define wpdance_comment() and that will be used instead.
					 * See wpdance_comment() in wpdance/functions.php for more.
					 */
					wp_list_comments( array( 'callback' => 'theme_comment' ) );
				?>
			</ol>
			
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
						<div class="navigation">
							<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'wpdance' ) ); ?></div>
							<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'wpdance' ) ); ?></div>
						</div><!-- .navigation -->
			<?php endif; // check for comment navigation ?>
			
	<?php endif; ?>
<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'wpdance' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php wp_comment_form(); ?>

</div><!-- #comments -->
