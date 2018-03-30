<?php

	if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die ( esc_html__( 'This page cannot be opened directly!', 'blade' ) );
	}

	if ( post_password_required() ) {
?>
		<div class="help">
			<p class="no-comments"><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'blade' ); ?></p>
		</div>
<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>

	<!-- Comments -->
	<div id="grve-comments" class="grve-singular-section grve-smallwidth clearfix">
		<div class="grve-container grve-padding-top-md grve-padding-bottom-md grve-border grve-border-top">
			<div class="grve-comments-header">
				<h6 class="grve-comments-number grve-text-dark">
				<?php comments_number( esc_html__( 'no comments', 'blade' ), esc_html__( '1 comment', 'blade' ), '% ' . esc_html__( 'comments', 'blade' ) ); ?>
				</h6>
				<nav class="grve-comment-nav grve-small-text">
					<ul>
				  		<li><?php previous_comments_link(); ?></li>
				  		<li><?php next_comments_link(); ?></li>
				 	</ul>
				</nav>
			</div>
			<ul>
			<?php wp_list_comments( 'type=comment&callback=blade_grve_comments' ); ?>
			</ul>
		</div>
	</div>
	<!-- End Comments -->

<?php endif; ?>


<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

	<div id="grve-comments" class="grve-singular-section clearfix">
		<div class="grve-container grve-padding-top-md grve-padding-bottom-md grve-border grve-border-top">
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'blade' ); ?></p>
		</div>
	</div>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );

		$args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'grve-comment-submit-button',
			'title_reply'       => esc_html__( 'Leave a Reply', 'blade' ),
			'title_reply_to'    => esc_html__( 'Leave a Reply to', 'blade' ) . ' %s',
			'cancel_reply_link' => esc_html__( 'Cancel Reply', 'blade' ),
			'label_submit'      => esc_html__( 'Submit Comment', 'blade' ),
			'submit_button'     => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',

			'comment_field' =>
				'<div class="grve-form-textarea grve-border">'.
				'<textarea style="resize:none;" id="comment" name="comment" placeholder="' . esc_attr__( 'Your Comment Here...', 'blade' ) . '" cols="45" rows="15" aria-required="true">' .
				'</textarea></div>',

			'must_log_in' =>
				'<p class="must-log-in">' . esc_html__( 'You must be', 'blade' ) .
				'<a href="' .  wp_login_url( get_permalink() ) . '">' . esc_html__( 'logged in', 'blade' ) . '</a> ' . esc_html__( 'to post a comment.', 'blade' ) . '</p>',

			'logged_in_as' =>
				'<div class="logged-in-as grve-small-text">' .  esc_html__('Logged in as','blade') .
				'<a href="' . admin_url( 'profile.php' ) . '"> ' . $user_identity . '</a>. ' .
				'<a href="' . wp_logout_url( get_permalink() ) . '" title="' . esc_attr__( 'Log out of this account', 'blade' ) . '"> ' . esc_html__( 'Log out', 'blade' ) . '</a></div>',

			'comment_notes_before' => '',
			'comment_notes_after' => '' ,

			'fields' => apply_filters(
				'comment_form_default_fields',
				array(
					'author' =>
						'<div class="grve-form-input grve-border">' .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' .
						' placeholder="' . esc_attr__( 'Name', 'blade' ) . ' ' . ( $req ? esc_attr__( '(required)', 'blade' ) : '' ) . '" />' .
						'</div>',

					'email' =>
						'<div class="grve-form-input grve-border">' .
						'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' .
						' placeholder="' . esc_attr__( 'E-mail', 'blade' ) . ' ' . ( $req ? esc_attr__( '(required)', 'blade' ) : '' ) . '" />' .
						'</div>',

					'url' =>
						'<div class="grve-form-input grve-border">' .
						'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"' .
						' placeholder="' . esc_attr__( 'Website', 'blade' )  . '" />' .
						'</div>',
					)
				),
		);
?>
		<div id="grve-comment-form" class="grve-singular-section grve-smallwidth clearfix">
			<div class="grve-container grve-padding-top-md grve-padding-bottom-md">

			<?php
				//Use comment_form() with no parameters if you want the default form instead.
				comment_form( $args );
			?>
			</div>
		</div>


<?php endif;

//Omit closing PHP tag to avoid accidental whitespace output errors.