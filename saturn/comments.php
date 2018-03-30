<?php 
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
	<h2 class="comments-title">
		<?php
			printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'saturn' ),
				number_format_i18n( get_comments_number() ), get_the_title() );
		?>	
	</h2>
	
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'saturn' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'saturn' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'saturn' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>	
	
	<ol class="comment-list">
		<?php
			$comments_args = array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 64,
			);
			wp_list_comments( apply_filters( 'saturn_wp_list_comments_args' , $comments_args) );
		?>
	</ol>
	
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'saturn' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'saturn' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'saturn' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>
	
	<?php if ( ! comments_open() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'saturn' ); ?></p>
	<?php endif; ?>
	
	<?php endif; // have_comments?>
	<?php comment_form(); ?>
</div>