<!-- Check Authorize -->
<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if (post_password_required()){
		?> <p class="nopassword">This post is password protected. Enter the password to view comments.</p> <?php
		return;
	}
?>
<!-- Comment List -->
<?php if ( have_comments() ) : ?>
	<div id="comments" class="comment-title gdl-link-title gdl-title">
	<?php comments_number(__('No Comment','gdl_front_end'), __('One Comment','gdl_front_end'), __('% Comments','gdl_front_end') );?>
	</div>
	<ol class="comment-list">
		<?php wp_list_comments(array('callback' => 'get_comment_list')); ?>
	</ol>
	<!-- Comment Navigation -->
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<br>
		<div class="comments-navigation">
			<div class="previous"> <?php previous_comments_link('Older Comments'); ?> </div>
			<div class="next"> <?php next_comments_link('Newer Comments'); ?> </div>
		</div>
	<?php endif; ?>
<?php endif; ?>
<!-- Comment Form -->
<?php 

	// Translator words
	global $gdl_admin_translator;
	if( $gdl_admin_translator == 'enable' ){
		$translator_leave_reply = get_option(THEME_SHORT_NAME.'_translator_leave_reply', 'Leave a Reply');
	}else{
		$translator_leave_reply = __('Leave a Reply','gdl_front_end');
	}	

	$comment_form = array( 
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<div class="comment-form-author">' .
						'<input id="author" name="author" type="text" value="' .
						esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1" />' .
						'<label for="author">' . __( 'Name', 'gdl_front_end' ) . '</label> ' .
						( $req ? '<span class="required">*</span>' : '' ) .	
						'<div class="clear"></div>' .
						'</div><!-- #form-section-author .form-section -->',
			'email'  => '<div class="comment-form-email">' .
						'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2" />' .
						'<label for="email">' . __( 'Email', 'gdl_front_end' ) . '</label> ' .
						( $req ? '<span class="required">*</span>' : '' ) .
						'<div class="clear"></div>' .
						'</div><!-- #form-section-email .form-section -->',
			'url'    => '<div class="comment-form-url">' .
						'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" />' .
						'<label for="url">' . __( 'Website', 'gdl_front_end' ) . '</label>' .
						'<div class="clear"></div>' .
						'</div><!-- #form-section-url .form-section -->' ) ),
		'comment_field' => '<div class="comment-form-comment">' .
					'<textarea id="comment" name="comment" aria-required="true"></textarea>' .
					'</div><!-- #form-section-comment .form-section -->',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'title_reply' => $translator_leave_reply,
	);
	comment_form($comment_form, $post->ID); 
	
/*
$defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
    'author' => '<p class="comment-form-author">' .
                '<label for="author">' . __( 'Name' ) . '</label> ' .
                ( $req ? '<span class="required">*</span>' : '' ) .
                '<input id="author" name="author" type="text" value="' .
                esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1"' . $aria_req . ' />' .
                '</p><!-- #form-section-author .form-section -->',
    'email'  => '<p class="comment-form-email">' .
                '<label for="email">' . __( 'Email' ) . '</label> ' .
                ( $req ? '<span class="required">*</span>' : '' ) .
                '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2"' . $aria_req . ' />' .
                '</p><!-- #form-section-email .form-section -->',
    'url'    => '<p class="comment-form-url">' .
                '<label for="url">' . __( 'Website' ) . '</label>' .
                '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" />' .
                '</p><!-- #form-section-url .form-section -->' ) ),
    'comment_field' => '<p class="comment-form-comment">' .
                '<label for="comment">' . __( 'Comment' ) . '</label>' .
                '<textarea id="comment" name="comment" cols="45" rows="8" tabindex="4" aria-required="true"></textarea>' .
                '</p><!-- #form-section-comment .form-section -->',
    'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
    'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%s">%s</a>. <a href="%s" title="Log out of this account">Log out?</a></p>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ),
    'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email is <em>never</em> published nor shared.' ) . ( $req ? __( ' Required fields are marked <span class="required">*</span>' ) : '' ) . '</p>',
    'comment_notes_after' => '<dl class="form-allowed-tags"><dt>' . __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:' ) . '</dt> <dd><code>' . allowed_tags() . '</code></dd></dl>',
    'id_form' => 'commentform',
    'id_submit' => 'submit',
    'title_reply' => __( 'Leave a Reply' ),
    'title_reply_to' => __( 'Leave a Reply to %s' ),
    'cancel_reply_link' => __( 'Cancel reply' ),
    'label_submit' => __( 'Post Comment' ),
);

*/
?>
