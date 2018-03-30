<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Wish
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="blog-comments animated" data-animation="fadeInUp" data-animation-delay="100">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h1 class="comments-title colored-text">
			<?php
				printf(
					esc_html( _nx( '%2$s', '%2$s', get_comments_number(), 'comments title', 'wish' ) ),
					'<i class="fa fa-comments-o"></i>' . number_format_i18n( get_comments_number() ),
					'<i class="fa fa-comment-o"></i><span>' .  esc_html__('User Comments','wish').'</span>'
				);
			?>
		</h1>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'wish' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'wish' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ul class="media-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ul',
					'short_ping' => true,
					'callback' => 'wish_comment',
					'avatar_size'  => 80,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wish' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'wish' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'wish' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'wish' ); ?></p>
	<?php endif; ?>

	<?php
	
echo '<div class="leave-a-reply animated" data-animation="fadeInUp" data-animation-delay="100">
<div class="blog-form">';
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$fields =  array(
    'author' => '<div class="col-md-6"><input id="author"  placeholder="'.esc_html__('Name','wish').'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
    'email'  => '<div class="col-md-6"><input id="email" name="email" placeholder="'.esc_html__('Email','wish').'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
		
);
	$comments_args = array(
    'fields' =>  $fields,
	'title_reply' => '<h1><i class="fa fa-reply"></i> '.esc_html__('Leave a Reply','wish').'</h1>',
	'label_submit' => 'COMMENT',
	'comment_notes_before' => '',
	'class_submit' => 'button_comment',
	'comment_notes_after' => '',
	'comment_notes_after' => '',
  'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'wish' ),
  'cancel_reply_link' => esc_html__( 'Cancel Reply', 'wish' ),
	'comment_field' => '<div class="col-md-12"><textarea name="comment" cols="1" rows="3" placeholder="'.esc_html__('Message','wish').'"></textarea></div>'
);
	comment_form($comments_args);

echo '</div>
</div>';
 ?>

</div><!-- #comments -->
