<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package cshero
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

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
        <div class="st-comments-wrap clearfix">
            <h4 class="comments-title">
                <span><?php comments_number(__('Comments',THEMENAME),__('1 Comments',THEMENAME),__('% Comments',THEMENAME)); ?></span>
            </h4>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-above" class="comment-navigation col-xs-12 col-sm-12 col-md-12 col-lg-12" role="navigation">
                <h1 class="screen-reader-text"><?php __( 'Comment navigation',THEMENAME); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments',THEMENAME) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;',THEMENAME) ); ?></div>
            </nav><!-- #comment-nav-above -->
            <?php endif; // check for comment navigation ?>

            <ol class="comment-list">
                <?php
                    wp_list_comments( array(
                        'style'      => 'ol',
                        'short_ping' => true,
                        'avatar_size' => 140,
                        'callback' => 'cshero_custom_form'
                    ) );
                ?>
            </ol><!-- .comment-list -->

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-below" class="comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php __( 'Comment navigation',THEMENAME); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments',THEMENAME) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;',THEMENAME) ); ?></div>
            </nav><!-- #comment-nav-below -->
            <?php endif; // check for comment navigation ?>
        </div>
	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php __( 'Comments are closed.',THEMENAME); ?></p>
	<?php endif; ?>

	<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name__mail' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'submit',
			'title_reply'       => __( 'Post a comment',THEMENAME),
			'title_reply_to'    => __( 'Leave a Reply to %s',THEMENAME),
			'cancel_reply_link' => __( 'Cancel Reply',THEMENAME),
			'label_submit'      => __( 'Submit',THEMENAME),

			'comment_field' =>  '<div class="row"><div class="comment-form-comment col-xs-12 col-sm-12 col-md-12 col-lg-12"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="'.__('Write your comment here.',THEMENAME).'" aria-required="true">' .
			'</textarea></div></div>',
			'comment_notes_before' => '',
			'fields' => apply_filters( 'comment_form_default_fields', array(

					'author' =>
					'<div class="row"><div class="comment-form-author col-xs-12 col-sm-12 col-md-6 col-lg-6">'.
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					'" size="30"' . $aria_req . ' placeholder="'.__('Name (Required)',THEMENAME).'"/></div>',

					'email' =>
					'<div class="comment-form-email col-xs-12 col-sm-12 col-md-6 col-lg-6">'.
					'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					'" size="30"' . $aria_req . ' placeholder="'.__('E-mail (Required)',THEMENAME).'"/></div></div>',

					'url' =>
					'<div class="row"><div class="comment-form-url col-xs-12 col-sm-12 col-md-12 col-lg-12">'.
					'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
					'" size="30" placeholder="'.__('Website',THEMENAME).'"/></div></div>'
			)
			),
	);
	comment_form($args);
	?>

</div><!-- #comments -->
