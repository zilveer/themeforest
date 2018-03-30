<?php

if ( ! function_exists( 'presscore_comments_will_be_displayed' ) ) :

	/**
	 * Check if comments will be displayed for this post.
	 *
	 * Return true if post not passwod protected or comments opened or even though one comment exisis.
	 *
	 * @return boolean;
	 */
	function presscore_comments_will_be_displayed() {
		return !( post_password_required() || ( !comments_open() && '0' == get_comments_number() ) );
	}

endif;

if ( ! function_exists( 'presscore_comment' ) ) :

	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since 1.0.0
	 */
	function presscore_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="pingback">
			<div class="pingback-content">
				<span><?php _e( 'Pingback:', 'the7mk2' ); ?></span>
				<?php comment_author_link(); ?>
				<?php edit_comment_link( __( '(Edit)', 'the7mk2' ), ' ' ); ?>
			</div>
		<?php
				break;
			default :
		?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
					<footer class="comment-meta">
						<div class="comment-author vcard">
							<?php
							$avatar = '<span class="avatar no-avatar"></span>';
							if ( dt_validate_gravatar( $comment->comment_author_email ) ) {
								$avatar = get_avatar( $comment, 60 );
							}

							$author_url = get_comment_author_url();
							if ( ! empty( $author_url ) && 'http://' !== $author_url ) {
								$avatar = '<a href="' . $author_url . '" rel="external nofollow" class="rollover" target="_blank">' . $avatar . '</a>';
							}

							// Output comment author avatar.
							echo $avatar;
							?>
							<?php printf( __( '%s <span class="says">says:</span>', 'the7mk2' ), sprintf( '<span class="comment-author-name h4-size">%s</span>', get_comment_author_link( $comment ) ) ); ?>
						</div><!-- .comment-author -->

						<div class="comment-metadata">
							<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php
									/* translators: 1: comment date, 2: comment time */
									printf( __( '%1$s at %2$s', 'the7mk2' ), get_comment_date( '', $comment ), get_comment_time() );
									?>
								</time>
							</a>
							<?php edit_comment_link( __( 'Edit', 'the7mk2' ), '(', ')' ); ?>
						</div><!-- .comment-metadata -->

						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'the7mk2' ); ?></p>
						<?php endif; ?>
					</footer><!-- .comment-meta -->

					<div class="comment-content">
						<?php comment_text(); ?>
					</div><!-- .comment-content -->

					<?php
					$icon = '<i class="fa fa-reply" aria-hidden="true"></i>&nbsp;';

					comment_reply_link(array_merge( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="reply">',
						'after'     => '</div>',
						'reply_text'    => $icon . __( 'Reply', 'the7mk2' ),
						'reply_to_text' => $icon . __( 'Reply to %s', 'the7mk2' ),
						'login_text'    => $icon . __( 'Log in to Reply', 'the7mk2' ),
					) ));
					?>
				</article><!-- .comment-body -->
		<?php
				break;
		endswitch;
	}

endif;
