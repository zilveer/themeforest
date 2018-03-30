<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not open this page directly.');

if (post_password_required())
	return;
?>
<div class="comments-post">
	<div class="comments margint10 clearfix">
		<div class="comments-blog-post-top clearfix">
			<div class="com-title pos-center">
				<div class="title margint60 marginb30">
					<h4 id="comments">
						<?php comments_popup_link( __('NO COMMENT','2035Themes-fm'), __('1 COMMENT','2035Themes-fm'), __('% COMMENTS','2035Themes-fm'), 'smooth', __('COMMENTS ARE OFF THIS POST','2035Themes-fm')); ?>
					</h4>
					<div class="leave-reply-link"><?php if(comments_open() && !post_password_required()){ ?><a href="#respond" class="smooth"><?php echo __("Leave a Reply","2035Themes-fm"); ?></a><?php } ?></div>
				</div>
			</div>
		</div>
		<ol class="comment-list clearfix">
			<?php wp_list_comments(
			array( 
			'callback' => 'theme2035_comment'
			)); ?>
		</ol>
		<?php if ( get_option( 'page_comments' ) && get_comment_pages_count() > 1 ) : ?>
		<div class="clearfix">
			<div class="nav-previous margint10 pull-left"><?php previous_comments_link( __( '&larr; Older Comments', '2035Themes-fm' ) ); ?></div>
			<div class="nav-next margint10 pull-right"><?php next_comments_link( __( 'Newer Comments &rarr;', '2035Themes-fm' ) ); ?></div>
		</div>
		<?php endif; ?>
	</div>
</div>

<?php if(comments_open() && !post_password_required()){   ?>
<div class="comments-post">
	<?php if ( ! comments_open() && get_comments_number() ) : ?>
	<p class="no-comments"><?php __( 'Comments are closed.' , '2035Themes-fm' ); ?></p>
	<?php endif;  ?>
	<?php if ( comments_open() ) : ?>
	<div class="comment-styles">
		<div id="respond-wrap">
			<?php 
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? " aria-required='true'" : '' );
				$fields =  array(
					'author' => '<p class="comment-form-author"><input placeholder=" '. __("Name","2035Themes-fm") . ( $req ? '*' : '' ) .' " id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
					'email' => '<p class="comment-form-email"><input placeholder=" '. __("E-Mail","2035Themes-fm"). ( $req ? '*' : '' ) .'" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
					'url' => '<p class="comment-form-url"><label for="url"></label><input placeholder=" '. __("Web Site","2035Themes-fm") .'" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'
				);
				$comments_args = array(
				    'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
				    'logged_in_as'		   => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', '2035Themes-fm' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				    'title_reply'          => '' ,
				    'title_reply_to'       => __( 'Leave a reply to %s', '2035Themes-fm' ),
				    'cancel_reply_link'    => __( 'Click here to cancel the reply', '2035Themes-fm' ),
				    'label_submit'         => __( 'Post comment', '2035Themes-fm' ),
				    'comment_field'		   => '<p class="comment-form-comment"><textarea placeholder=" '. __("COMMENT","2035Themes-fm") .'" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
				    'must_log_in'		   => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', '2035Themes-fm' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
					'comment_notes_after'  => '',
					'label_submit'      	=> __('SUBMIT','2035Themes-fm'),
				);
			?>
			<?php comment_form($comments_args); ?>
		</div>
	</div>
</div>
<?php endif; ?>
<?php } ?>
