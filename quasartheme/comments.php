<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments and the comment
 * form. The actual display of comments is handled by a callback 
 *
 * @package WordPress
 * @subpackage Quasar
 * @since Quasar 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'quasar' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h4>

		<ol class="comment-list">
			<?php
			wp_list_comments(array('style'=>'ol','avatar_size'=>80,'type'=>'comment','callback'=>'rockthemes_comment'));
			?>
		</ol><!-- .comment-list -->

		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation row" role="navigation">
			<div class="nav-previous large-6 columns"><?php previous_comments_link( __( '<i class="fa fa-angle-double-left"></i> Older Comments', 'quasar' ) ); ?></div>
			<div class="nav-next large-6 columns"><?php next_comments_link( __( 'Newer Comments <i class="fa fa-angle-double-right"></i>', 'quasar' ) ); ?></div>
		</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.' , 'quasar' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form( array( 'format' => 'html5' ) ); ?>

</div><!-- #comments -->