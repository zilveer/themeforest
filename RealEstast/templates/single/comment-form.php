<?php if ( comments_open( get_the_ID() ) ) : ?>
	<?php do_action( 'comment_form_before' ); ?>
	<div class="form-cm">
		<div class="content-form-cm">
			<h4 id="reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?>
				<small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small>
			</h4>
			<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) : ?>
				<?php echo $args['must_log_in']; ?>
				<?php do_action( 'comment_form_must_log_in_after' ); ?>
			<?php else : ?>
				<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
						<?php do_action( 'comment_form_top' );
						if (is_user_logged_in()) {
							echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
							do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
						} else {
							echo $args['comment_notes_before'];
							do_action( 'comment_form_before_fields' );?>
							<div class="row">
								<?php echo apply_filters( "comment_form_field_author", $args['fields']['author'] ) . "\n";?>
								<?php echo apply_filters( "comment_form_field_author", $args['fields']['email'] ) . "\n";?>
							</div>
							<?php echo apply_filters( "comment_form_field_url", $args['fields']['url'] ) . "\n";?>
							<?php
							do_action( 'comment_form_after_fields' );
						}
						echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
						echo $args['comment_notes_after']; ?>
					<p class="form-submit">
						<input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" class="button-cm" />
						<?php comment_id_fields( get_the_ID() ); ?>
					</p>
					<?php do_action( 'comment_form', get_the_ID() ); ?>
				</form>
			<?php endif; ?>
		</div>
	</div><!-- #respond -->
	<?php do_action( 'comment_form_after' ); ?>
<?php else : ?>
	<?php do_action('comment_form_comments_closed'); ?>
<?php endif; ?>