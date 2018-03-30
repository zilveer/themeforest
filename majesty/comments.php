<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Majesty
 * @since Majesty 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
global $majesty_allowed_tags;
 
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'theme-majesty' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above">
				<h3 class="sr-only sr-only-focusable"><?php esc_html_e( 'Comment navigation', 'theme-majesty' ); ?></h3>
				<ul class="page-numbers-gold" >
					<li class="previous"><?php previous_comments_link( wp_kses( __( '<i class="fa fa-angle-double-left"></i> Older Comments', 'theme-majesty' ), $majesty_allowed_tags) ); ?></li>
					<li class="next"><?php next_comments_link( wp_kses( __( 'Newer Comments <i class="fa fa-angle-double-right"></i>', 'theme-majesty' ), $majesty_allowed_tags) ); ?></li>
				</ul>
			</nav>
		<?php endif; // Check for comment navigation. ?>
			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 80,
						'reply_text'  => '<i class="fa fa-reply"></i>',
					) );
				?>
			</ol><!-- .comment-list -->
			<nav id="comment-nav-after">
				<h3 class="sr-only sr-only-focusable"><?php esc_html_e( 'Comment navigation', 'theme-majesty' ); ?></h3>
				<ul class="page-numbers-gold" >
					<li class="previous"><?php previous_comments_link( wp_kses( __( '<i class="fa fa-angle-double-left"></i> Older Comments', 'theme-majesty' ), $majesty_allowed_tags) ); ?></li>
					<li class="next"><?php next_comments_link( wp_kses( __( 'Newer Comments <i class="fa fa-angle-double-right"></i>', 'theme-majesty' ), $majesty_allowed_tags) ); ?></li>
				</ul>
			</nav><!-- #comment-nav-after -->

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments alert alert-danger"><i class="fa fa-times"></i>&#160;<?php esc_html_e( 'Comments are closed.', 'theme-majesty' ); ?></p>
	<?php endif; ?>

	<?php
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$args =  array(
			'comment_field' => '<div class="comment-form-comment col-md-12"><textarea id="comment" name="comment" placeholder="'. _x( 'YOUR COMMENT', 'noun', 'theme-majesty' ) .'" aria-required="true"></textarea></div>',
			'fields'	=> apply_filters( 'comment_form_default_fields', array(
				'author' =>
					'<div class="comment-form-author col-md-4 col-sm-4 col-sx-12">
					<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					'" placeholder="'. esc_html__( 'NAME', 'theme-majesty' ) . ( $req ? ' *' : '' ) . '"' . $aria_req . ' /></div>',

				'email' =>
					'<div class="comment-form-email col-md-4 col-sm-4 col-sx-12">
					<input class="form-control" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					'" placeholder="'.  esc_html__( 'EMAIL', 'theme-majesty' ) . ( $req ? ' *' : '' ) .'"' . $aria_req . ' /></div>',

				'url' =>
					'<div class="comment-form-url col-md-4 col-sm-4 col-sx-12">
					<input class="form-control" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
					'" placeholder="'. esc_html__( 'WEBSIE', 'theme-majesty' ) .'" /></div>',
				))
		);
		comment_form( $args );
	?>
</div><!-- .comments-area -->
