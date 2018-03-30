<?php
// Do not delete these sympathiques
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="no-comments"><?php _e('This post is password protected. Enter the password to view comments.', 'vivaco'); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>

		<ol class="commentlist">
			<?php wp_list_comments('type=comment&avatar_size=60&callback=startuply_comment'); ?>
		</ol>

		<div class="comments-navigation">
			<div class="align-left"><?php previous_comments_link(); ?></div>
			<div class="align-right"><?php next_comments_link(); ?></div>
		</div>

<?php else : // no comments yet ?>
	<div id="comments">
	<?php if ('open' == $post->comment_status) : ?>
		<p><?php _e('Comments open', 'vivaco'); ?></p>

	 <?php else : ?>
		<!-- [comments are closed, and no comments] -->
		<p><?php _e('Comments are closed.', 'vivaco'); ?></p>

	<?php endif; ?>
	</div>
<?php endif; ?>


<?php

$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

comment_form(array(

	'fields' => apply_filters( 'comment_form_default_fields', array(

		'comment_notes_after' => '',
		'author' => '<div class="col-md-4"><div class="comment-form-author"><fieldset><input id="author" name="author" type="text" placeholder="'.__( 'Name', 'vivaco' ). ( $req ? ' *' : '' ).'" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></fieldset></div></div>',
		'email' => '<div class="col-md-4"><div class="comment-form-email"><fieldset><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="'. __( 'Email', 'vivaco' ) . ( $req ? ' *' : '' ) .'" ' . $aria_req . ' /></fieldset></div></div>',
		'url' => '<div class="col-md-4"><div class="comment-form-url"><fieldset><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="'.__( 'Website', 'vivaco' ).'"  /></fieldset></div></div>'

	)),

	'comment_notes_before' => '',
	'comment_notes_after' => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'vivaco' ), ' <span>' . allowed_tags() . '</span>' ) . '</p>',
	'title_reply' => __( '<span class="base_clr_txt title-reply">Leave</span> a reply', 'vivaco' ),
	'title_reply_to' => __( 'Leave a  reply', 'vivaco' ),
	'cancel_reply_link' => __( 'Cancel reply', 'vivaco' ),
	'comment_field' => '<div class="col-md-12"><div class="comment-form-comment"><fieldset>' . '<textarea id="comment" placeholder="' . __( 'Your reply', 'vivaco' ) . ( $req ? ' *' : '' ) . '" name="comment" cols="45" rows="8" aria-required="true"></textarea></fieldset></div></div>',
	'label_submit' => __( 'submit', 'vivaco' ),
	'id_submit' => 'submit_my_comment'

));
?>
