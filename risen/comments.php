<?php
/**
 * Display Comments and Form
 */
 
// If comments are closed and non were made, just hide the whole comment section
if ( ! have_comments() && ! comments_open() ) {
	return;
}
 
?>

<!-- Comments Start -->
								
<section id="comments">

	<?php
	// show message if post is password protected
	if ( post_password_required() ) :
	?>
	
		<p class="nopassword">
			<?php _e( 'This post is password protected. Enter the password to view any comments.', 'risen' ); ?>
		</p>
	
	<?php
	// post is not password protected; show comments
	else :
	?>

		<h1 id="comments-title">
			<?php
			printf(
				_n( 'One Comment', '%1$s Comments', get_comments_number(), 'risen' ), // title for 1 comment, title for 2+ comments
				number_format_i18n( get_comments_number() ) // count
			);
			?>
		</h1>

		<?php
		// list comments
		if ( have_comments() ) :
		?>

			<!-- Comment List Start -->
			
			<ol class="comment-list">
				<?php
				wp_list_comments( array(
					'callback' => 'risen_comment_list' // see includes/comments.php
				) );
				?>
			</ol>
			
			<!-- Comment List End -->

			<?php
			// comment navigation
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			?>
			<nav class="nav-left-right" id="comment-nav">
				<div class="nav-left"><?php next_comments_link( __( '<span>&larr;</span> Newer Comments', 'risen' ) ); ?></div>
				<div class="nav-right"><?php previous_comments_link( __( 'Older Comments <span>&rarr;</span>', 'risen' ) ); ?></div>
				<div class="clear"></div>
			</nav>
			<?php endif; ?>
	
		<?php endif; ?>

		<?php 
		// Comment Form
		if ( comments_open() ) : // Show contact form if comments are not closed
			$args = array(
				'title_reply'			=> __( 'Add a Comment', 'risen' ),
				'title_reply_to'		=> __( 'Add a Reply to %s', 'risen' ),
				'cancel_reply_link'		=> __( 'Cancel', 'risen' ),
				'label_submit'			=> __( 'Add Comment', 'risen' )
			);
			comment_form( $args );
		else :
		?>
		<p id="comments-closed">
			<?php _e( 'Commenting has been turned off for this post.', 'risen' ); // Show message if comments closed ?>
		</p>
		<?php endif; ?>

	<?php endif; ?>

</section>

<!-- Comments End -->
