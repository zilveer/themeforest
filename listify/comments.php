<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Listify
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() || ( ! have_comments() && ! comments_open() ) ) {
	return;
}
?>

<div id="comments" class="comments-area widget widget-job_listing">

	<?php if ( have_comments() ) : ?>
		<?php if ( is_singular( 'job_listing' ) ) : ?>
		<h3 class="comment-sorting"><?php _e( 'Sort By', 'listify' ); ?></h3>
		<form action="#comments" method="get" class="comment-sorting-filter-form">
			<select name="sort-comments" class="comment-sorting-filter">
				<?php foreach ( Listify_Comments::get_sort_options() as $key => $label ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, isset( $_GET[ 'sort-comments' ] ) ? esc_attr( $_GET[ 'sort-comments' ] ) : null ); ?>><?php echo esc_attr( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</form>
		<?php endif; ?>

		<ol class="commentlist">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'callback'   => 'listify_comment'
				) );
			?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation">
			<h3 class="screen-reader-text"><?php _e( 'Comment navigation', 'listify' ); ?></h3>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'listify' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'listify' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'listify' ); ?></p>
	<?php endif; ?>

	<?php
		global $comments_widget_title, $comments_widget_icon, $comments_widget_before_title, $comments_widget_after_title;

		$label_submit = ( is_singular( 'job_listing' ) && get_current_user_id() != get_post()->post_author ) ? __( 'Submit Your Review', 'listify' ) : __( 'Submit Reply', 'listify' );

		$reply = isset( $_GET[ 'replytocom' ] ) ? (int) $_GET[ 'replytocom' ] : 0;

		if ( $reply ) {
			$label_submit = __( 'Publish Reply', 'listify' );
			$comments_widget_title = __( 'Leave a Reply', 'listify' );
		}

		if ( ! $comments_widget_title ) {
			$comments_widget_title = is_singular( 'job_listing' ) ? __( 'Leave a Review', 'listify' ) : __( 'Leave a Reply', 'listify' );
			$comments_widget_icon  = 'clipboard';
		}

		$comments_widget_icon = str_replace( 'ion-', '', $comments_widget_icon );

		$title = ( $comments_widget_icon ? '<span class="ion-' . $comments_widget_icon . '"></span>' : ''  ) . $comments_widget_title;

		comment_form( apply_filters( 'listify_comment_form', array(
			'title_reply' => $title,
			'title_reply_to' => $title,
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'label_submit' => $label_submit
		), get_the_ID() ) );
	?>

</div><!-- #comments -->
