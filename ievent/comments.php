<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) { ?>
		<p class="no-comments"><?php echo esc_html_e('This post is password protected. Enter the password to view comments.', 'ievent'); ?></p>
	<?php
		return;
	}
?>
<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>
	<div class="comments-container">
		<div class="jx-ievent-title-side"><h2 class="title_style_a single-page"><?php comments_number(esc_html__('No Comments', 'ievent'), esc_html__('One Comment', 'ievent'), '% '.esc_html__('Comments', 'ievent'));?></h2></div>
        <div class="comments-title"></div>
		<ol class="commentlist">
			<?php wp_list_comments('callback=jx_ievent_comment'); ?>
		</ol>
		<div class="comments-navigation">
		    <div class="alignleft"><?php previous_comments_link(); ?></div>
		    <div class="alignright"><?php next_comments_link(); ?></div>
		</div>
	</div>
<?php else : // this is displayed if there are no comments so far ?>
	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="no-comments"><?php echo esc_html_e('Comments are closed.', 'ievent'); ?></p>
	<?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
	<?php
	function modify_comment_form_fields($fields){
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$fields['author'] = '<div id="comment-input"><input type="text" name="author" id="author" value="'. esc_attr( $commenter['comment_author'] ) .'" placeholder="'. esc_html__("Name (required)", "ievent").'" size="22" tabindex="1"'. ( $req ? ' aria-required="true"' : '' ).' class="input-name" />';
		$fields['email'] = '<input type="text" name="email" id="email" value="'. esc_attr( $commenter['comment_author_email'] ) .'" placeholder="'. esc_html__("Email (required)", "ievent").'" size="22" tabindex="2"'. ( $req ? ' aria-required="true"' : '' ).' class="input-email"  />';
		$fields['url'] = '<input type="text" name="url" id="url" value="'. esc_attr( $commenter['comment_author_url'] ) .'" placeholder="'. esc_html__("Website", "ievent").'" size="22" tabindex="3" class="input-website" /></div>';
		return $fields;
	}
	add_filter('comment_form_default_fields','modify_comment_form_fields');
	$comments_args = array(
		'title_reply' =>  esc_html__("Leave A Comment", "ievent"),
		'title_reply_to' => '<div class="title"><h2>'. esc_html__("Leave A Comment", "ievent").'</h2></div>',
		'must_log_in' => '<p class="must-log-in">' .  sprintf( esc_html__( "You must be %slogged in%s to post a comment.", "ievent" ), '<a href="'.wp_login_url( apply_filters( 'the_permalink', esc_url(get_permalink()) ) ).'">', '</a>' ) . '</p>',
		'logged_in_as' => '<p class="logged-in-as">' . esc_html__( "Logged in as","ievent" ).' <a href="' .admin_url( "profile.php" ).'">'.$user_identity.'</a>. <a href="' .wp_logout_url(esc_url(get_permalink())).'" title="' . esc_html__("Log out of this account", "ievent").'">'. esc_html__("Log out &raquo;", "ievent").'</a></p>',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'comment_field' => '<div id="comment-textarea"><textarea name="comment" id="comment" cols="39" rows="4" tabindex="4" class="textarea-comment" placeholder="'. esc_html__("Comment...", "ievent").'"></textarea></div>',
		'id_submit' => 'comment-submit',
		'label_submit'=> esc_html__("Post Comment", "ievent"),
	);
	comment_form($comments_args);
	?>
<?php endif;  ?>