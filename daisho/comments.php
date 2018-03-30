<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area clearfix">

	<?php if ( have_comments() ) { ?>
		<div class="comments-title clearfix">
			<h2><?php printf( _n( 'One Comment', '%s Comments', get_comments_number(), 'flowthemes' ), number_format_i18n( get_comments_number() ) ); ?></h2>
			<a href="#commentform"><?php _e( 'Post Comment', 'flowthemes' ); ?></a>
		</div>
		
		<ol class="comment-list">
			<?php wp_list_comments( array( 'style' => 'ol', 'short_ping' => true, 'avatar_size' => 74 ) ); ?>
		</ol>
		
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav class="comment-navigation clearfix" role="navigation">
				<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'flowthemes' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'flowthemes' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'flowthemes' ) ); ?></div>
			</nav>
		<?php } ?>

		<?php if ( ! comments_open() && get_comments_number() ) { ?>
			<p class="comments-closed"><?php _e( 'Comments are closed.' , 'flowthemes' ); ?></p>
		<?php } ?>

	<?php } else { ?>
		<?php if ( $post->comment_status == 'open' ) { ?>
			<div class="no-comments"><?php _e( 'There are no comments yet, add one below.', 'flowthemes' ); ?></div>
		<?php } ?>
	<?php } ?>

	<?php comment_form(); ?>
	
</div>