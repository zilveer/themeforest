<?php

if ( barcelona_get_option( 'show_comments' ) != 'on' || post_password_required() || ( ! have_comments() && ! comments_open() ) ) {
	return;
}

if ( barcelona_get_option( 'disqus_comments' ) != 'on' ) {

	$barcelona_commenter = wp_get_current_commenter();
	$barcelona_user = wp_get_current_user();
	$barcelona_user_identity = $barcelona_user->exists() ? $barcelona_user->display_name : '';

	$barcelona_req      = get_option( 'require_name_email' );
	$barcelona_html_req = ( $barcelona_req ? ' required="required"' : '' );
	$barcelona_aria_req = ( ( $barcelona_req && ! empty( $barcelona_html_req ) ) ? ' aria-required="true"' : '' );

	$barcelona_hide_avatars = ( get_option( 'show_avatars' ) == '1' ) ? '' : ' hide-avatars';

	?>
	<div id="comments">

		<?php if ( have_comments() ): ?>

		<h2 class="comments-title">
			<?php comments_number( esc_html__( 'No Comments', 'barcelona' ), esc_html__( 'One Comment', 'barcelona' ), esc_html( _n( '% Comment', '% Comments', number_format_i18n( get_comments_number() ), 'barcelona' ) ) ); ?>
		</h2>

		<?php barcelona_comments_nav( 'top' ); ?>

		<div class="comments-list<?php echo esc_attr( $barcelona_hide_avatars ); ?>">
			<?php

			wp_list_comments(
				array(
					'type'          => 'comment',
					'callback'      => 'barcelona_comments_cb',
					'avatar_size'   => 100,
					'style'         => 'div',
					'max_depth'     => '2'
				)
			);

			?>
		</div>

		<?php barcelona_comments_nav( 'bottom' ); ?>

		<?php endif; ?>

		<?php if ( comments_open() ): ?>
		<div class="comment-form-row row">
		<?php

			$barcelona_wp_kses_allowable_html = array(
				'a' => array(
					'href' => array(),
					'title' => array()
				)
			);

			comment_form(
				array(
					'title_reply'           => esc_html__( 'Leave a Reply', 'barcelona' ),
					'title_reply_to'        => esc_html__( 'Leave a Reply to %s', 'barcelona' ),
					'logged_in_as'          => '<div class="col-md-12"><p class="form-before-text">'. sprintf( wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'barcelona' ), $barcelona_wp_kses_allowable_html ), get_edit_user_link(), $barcelona_user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) .'</p></div>',
					'cancel_reply_link'     => esc_html__( 'Cancel Reply', 'barcelona' ),
					'label_submit'          => esc_html__( 'Post Comment', 'barcelona' ),
					'class_submit'          => 'btn btn-red-2 btn-submit-comment',
					'comment_notes_after'   => '',
					'comment_notes_before'  => '',
					'must_log_in'           => '<div class="col-md-12"><p class="form-before-text alert alert-danger">' . sprintf( wp_kses( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'barcelona' ), $barcelona_wp_kses_allowable_html ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p></div>',
					'comment_field'         => '<div class="col-sm-12"><div class="form-group comment-form-comment"><textarea id="comment" class="form-control" name="comment" rows="10" placeholder="'. esc_html_x( 'Comment', 'noun', 'barcelona' ) .' *" required="required"></textarea></div></div>',
					'submit_field'          => '<div class="col-sm-12"><div class="form-group form-submit">%1$s %2$s</div></div>',
					'submit_button'         => '<button type="submit" name="%1$s" id="%2$s" class="%3$s">%4$s</button>',
					'format'                => 'html5',
					'fields' => array(
						'author'    => '<div class="col-sm-6"><div class="form-group comment-form-author"><input id="author" class="form-control" type="text" name="author" placeholder="'. esc_html__( 'Name', 'barcelona' ) . ( $barcelona_req ? ' *' : '' ) .'" value="' . esc_attr( $barcelona_commenter['comment_author'] ) . '" size="30"'. $barcelona_aria_req . $barcelona_html_req .'></div></div>',
						'email'     => '<div class="col-sm-6"><div class="form-group comment-form-email"><input id="email" class="form-control" type="email" name="email" placeholder="'. esc_html__( 'Email', 'barcelona' ) . ( $barcelona_req ? ' *' : '' ) .'" value="' . esc_attr( $barcelona_commenter['comment_author_email'] ) . '" size="30"'. $barcelona_aria_req . $barcelona_html_req .'></div></div>',
						//'url'       => '<div class="col-sm-12"><div class="form-group comment-form-url"><input id="url" class="form-control" type="url" name="url" placeholder="'. esc_html__( 'Website', 'barcelona' ) .'" value="' . esc_attr( $barcelona_commenter['comment_author_url'] ) . '" size="30"></div></div>'
					)
				)
			);

		?>
		</div><!-- .comment-form-row -->
		<?php endif; ?>

	</div><!-- #comments -->
<?php
} else {

	$barcelona_disqus_sitename = barcelona_get_option( 'disqus_sitename' );

	if ( preg_match( '#^([a-z]+)\.disqus\.com$#', $barcelona_disqus_sitename ) ) {

		$barcelona_disqus_sitename = str_replace( '.disqus.com', '', $barcelona_disqus_sitename );

		?>
		<div id="disqus_thread"></div>
		<script>
			var disqus_config = function () {
				this.page.url = '<?php echo esc_url( get_the_permalink() ); ?>';
				this.page.identifier = '<?php echo esc_html( get_the_title() ); ?>';
			};
			(function () {
				var d = document, s = d.createElement('script');
				s.src = '//<?php echo sanitize_title_with_dashes( $barcelona_disqus_sitename ); ?>.disqus.com/embed.js';
				s.setAttribute('data-timestamp', +new Date());
				(d.head || d.body).appendChild(s);
			})();
		</script>
		<?php

	}

} ?>
