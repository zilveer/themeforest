<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to morphis_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Morphis
 * 
 */
?>
	<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'morphis' ); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<hr />
		<h3 id="comments-title">
			<?php
				printf( _n( 'One response', '%1$s responses', get_comments_number(), 'morphis' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>		
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'morphis' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'morphis' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'morphis' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ul id="comment-list" class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use morphis_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define morphis_comment() and that will be used instead.
				 * See morphis_comment() in morphis/functions.php for more.
				 */
				wp_list_comments( array( 'callback' => 'morphis_comment' ) );
			?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'morphis' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'morphis' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'morphis' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'morphis' ); ?></p>
	<?php endif; ?>
	<hr />
	<?php $args = array(
	    'title_reply' => __( 'Leave a Reply', 'morphis' ),
	    'title_reply_to' => __( 'Leave a Reply to %s', 'morphis' ),
	    'cancel_reply_link' => __( 'click here to cancel.', 'morphis' ),
	    'label_submit' => __( 'Submit Comment', 'morphis' ),
		'comment_field' => '<textarea name="comment" rows="9" cols="10" id="comment" required></textarea>',
		'fields' =>  
			array(
				'author' => '<div class="clearfix">
								<input name="author" id="comment-name" type="text" value="' . __( 'Name (required)', 'morphis' ) . '" onfocus="if(this.value==\'' . __( 'Name (required)', 'morphis' ) . '\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\'' . __( 'Name (required)', 'morphis' ) . '\';" required />								
							</div>',
				'email'  =>	'<div>
								<input name="email" id="comment-email" type="email" value="' . __( 'Email (required)', 'morphis' ) . '" onfocus="if(this.value==\'' . __( 'Email (required)', 'morphis' ) . '\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\'' . __( 'Email (required)', 'morphis' ) . '\';" required />								
							</div>',
				'url' => '<div>
							<input name="url" id="comment-url" type="text" value="' . __( 'Website', 'morphis' ) . '" onfocus="if(this.value==\'' . __( 'Website', 'morphis' ) . '\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\'' . __( 'Website', 'morphis' ) . '\';" />							
						</div>'				
			)		,
			'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="10" aria-required="true"></textarea></p>',
				'comment_notes_before' => '',
				'comment_notes_after' => ''
		);
	
      comment_form($args);
	
	  ?>

</div><!-- #comments -->
