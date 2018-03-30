<?php $GLOBALS['comment'] = $comment; ?>

<?php switch( $comment->comment_type ) : case 'pingback': case 'trackback': ?>

		<li class="thb-pingback">
			<p>
				<?php _e( 'Pingback:', 'thb_text_domain'); ?> <?php comment_author_link(); ?>
				<span class="thb-edit-comment">
					<?php edit_comment_link( __( '(Edit)', 'thb_text_domain') ); ?>
				</span>
			</p>

	<?php break; case '': default: ?>
		<?php
			$thb_comment_classes = array('thb-comment');
			$args['reply_text'] = __( 'Reply', 'thb_text_domain' );
			$thb_show_avatar = get_option('show_avatars');

			if( empty($thb_show_avatar) ) {
				$thb_comment_classes[] = 'thb-avatar-disabled';
			}
		?>
		<li <?php comment_class($thb_comment_classes); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<h1 class="hidden"><?php _e( 'Comment by', 'thb_text_domain' ); ?> <?php echo get_comment_author(); ?></h1>
				<div class="comment_leftcol">
					<?php echo get_avatar( $comment, 80 ); ?>
				</div>
				<div class="comment_rightcol">
					<div class="comment_head">
						<p>
							<span class="user">
								<?php echo get_comment_author_link(); ?>
							</span>
							<?php echo get_comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
							<span class="date">
								<?php printf( __('%1$s <span>at</span> %2$s', 'thb_text_domain'), get_comment_date(),  get_comment_time() ); ?>
							</span>
						</p>
					</div>
					<div class="comment_body">
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<p>
								<em class="comment-awaiting-moderation">
									<?php _e( 'Your comment is awaiting moderation.', 'thb_text_domain'); ?>
								</em>
							</p>
						<?php endif; ?>
						<?php comment_text(); ?>
					</div>
				</div>
			</article>
		<?php break; ?>

<?php endswitch; ?>