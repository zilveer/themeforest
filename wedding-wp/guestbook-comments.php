<?php if ( 'open' == $post->comment_status ) : ?>

	<div id="guest-comments">
		<div class="guest-respond">
			<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
				<p id="login-req"><?php printf(__('You must be <a href="%s" title="Log in">logged in</a> to post in the Guestbook.', 'shape'), get_option('siteurl') . '/wp-login.php?redirect_to=' . get_permalink() ) ?></p>
			<?php else : ?>
				<?php
					$req = get_option('require_name_email');
					comment_form(array(
						'title_reply' => '',
						'title_reply_to' => '',
						'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), wp_get_current_user()->display_name, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
						'fields' => array(
							'author' => '<div class="one_half">' . '<label for="author">' . __('Name:', 'WEBNUS_TEXT_DOMAIN') . '</label>' . ( $req ? ' <span class="required">*</span>' : '' ) .
							'<input id="author" name="author" type="text" required="required" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="'.esc_attr( __('John Smith', 'WEBNUS_TEXT_DOMAIN') ).'" /></div>',
							'email'  => '<div class="one_half column-last"><label for="email">' . __('Email:', 'WEBNUS_TEXT_DOMAIN') . '</label> ' . ( $req ? ' <span class="required">*</span>' : '' ) . '<span class="comment-note">' . __( 'Your email address will not be published.', 'WEBNUS_TEXT_DOMAIN') . '</span>'.
								'<input id="email" name="email" type="email" required="required" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" placeholder="email@example.com" /></div>',
						),
						'comment_field' => '<div class=""><label for="comment">' . __( 'Note:', 'WEBNUS_TEXT_DOMAIN' ) . '</label><textarea id="comment" name="comment" required="required" aria-required="true" placeholder="'.esc_attr( __('write your special wishes', 'WEBNUS_TEXT_DOMAIN') ).'" rows="2"></textarea></div>',
						'comment_notes_before' => '',
						'comment_notes_after' => '',
						'label_submit' => __('Add note', 'WEBNUS_TEXT_DOMAIN'),
					));
				?>

			<?php endif /* if ( get_option('comment_registration') && !$user_ID ) */ ?>
		</div><!-- .respond-box -->

		<?php
			$req = get_option('require_name_email'); // Checks if fields are required.
			if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) ) {
				die ( 'Please do not load this page directly. Thanks!' );
			}

			if ( ! empty($post->post_password) ):
				if ( post_password_required() ) :
		?>
					</div><!-- #comments -->

	<?php
					return;
				endif;
			endif;
	?>

	<?php if ( have_comments() ) : ?>
			<div id="comments-list" class="guestbook-comments">
				<ol>

					<?php wp_list_comments(array(
	'walker'            => null,
	'max_depth'         => '0',
	'style'             => 'ul',
	'type'              => 'comment',
	'page'              => '',
	'per_page'          => '',
	'avatar_size'       => 0,
	'reverse_top_level' => null,
	'reverse_children'  => '',
)); ?>
				</ol>
			</div><!-- #comments-list .comments -->
	<?php endif /* if ( $comments ) */ ?>

	<?php
		$comment_pages = paginate_comments_links(array(
			'echo' => false,
			'prev_text'    => __('«', 'WEBNUS_TEXT_DOMAIN'),
			'next_text'    => __('»', 'WEBNUS_TEXT_DOMAIN'),
		));

		if(!empty($comment_pages)):
	?>
		<div class="wp-pagenavi comment-paging"><?php echo $comment_pages ?></div>
	<?php endif ?>
</div><!-- #comments -->

<?php endif /* if ( 'open' == $post->comment_status ) */ ?>
