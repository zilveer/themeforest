<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to dd_theme_comment() which is
 * located in the inc/functions.php file.
 */
?>

<?php
	// No entry
	if ( post_password_required() )
		return;
?>

	<div class="separator-medium"></div>
	
	<?php if ( have_comments() ) : ?>

		<div class="section-title-2">
			<?php echo get_comments_number(); ?> <?php _e( 'Comments for :', 'dd_string' ); ?> <span><?php the_title(); ?></span>
		</div><!-- #page-title -->

	<?php endif; ?>

	<section id="comments">

		<?php if ( have_comments() ) : ?>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
					<h1 class="assistive-text"><?php _e( 'Comment navigation', 'dd_string' ); ?></h1>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'dd_string' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'dd_string' ) ); ?></div>
				</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
			<?php endif; // check for comment navigation ?>

			<ol class="comments clean-list">
				<?php wp_list_comments( array( 'callback' => 'dd_theme_comment' ) ); ?>
			</ol><!-- .commentlist -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
					<h1 class="assistive-text"><?php _e( 'Comment navigation', 'dd_string' ); ?></h1>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'dd_string' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'dd_string' ) ); ?></div>
				</nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
			<?php endif; // check for comment navigation ?>

		<?php else : ?>

			<p class="align-center"><?php _e( 'There are no comments published yet.', 'dd_string' ); ?></p>
			<div class="separator-small"></div>

		<?php endif ; // end if have_comments() ?>

		<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
				<p class="nocomments"><?php _e( 'Comments are closed.', 'dd_string' ); ?></p>
		<?php endif; ?>

	</section><!-- #comments -->

	<?php
		comment_form( array(
			'label_submit' => __( 'SUBMIT YOUR COMMENT', 'dd_string' ), 
			'cancel_reply_link' => 'cancel',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'title_reply' => __( 'Leave a Comment', 'dd_string' ),
			'title_reply_to' => __( 'Reply to %s.', 'dd_string'),
			'comment_field' => '<div class="comment-form-comment"><textarea id="comment" name="comment" placeholder="' . __( 'Comment', 'dd_string' ) . '" aria-required="true"></textarea></div>',
			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<div class="comment-form-name"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . __( 'Name', 'dd_string' ) . ' *" aria-required="true" /></div>',
				'email' => '<div class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . __( 'Email', 'dd_string' ) . ' *" aria-required="true" /></div>',
				'url' => '<div class="comment-form-website"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . __( 'Website', 'dd_string' ) . '" /></div>' 
			)),
		)); 
	?>
