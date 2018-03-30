<?php $GLOBALS['comment'] = $comment; ?>

<?php switch( $comment->comment_type ) : case 'pingback': case 'trackback': ?>

		<li class="thb-pingback">
			<p>
				<?php _e( 'Pingback:', 'thb_text_domain'); ?> <?php comment_author_link(); ?>
				<span class="thb-edit-comment">
					<?php edit_comment_link( __( '(Edit)', 'thb_text_domain') ); ?>
				</span>
			</p>
		</li>

	<?php break; case '': default: ?>
		<?php
			$comment_classes = array('thb-comment');
			$args['reply_text'] = __( 'Reply', 'thb_text_domain' );
		?>
		<li <?php comment_class($comment_classes); ?> id="li-comment-<?php comment_ID(); ?>">
			<section id="comment-<?php comment_ID(); ?>" class="comment">
				<div class="comment_leftcol">
					<?php echo get_avatar( $comment, 50 ); ?>
					<?php echo get_comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>
				<div class="comment_rightcol">
					<div class="comment_head">
						<p>
							<?php printf( __('%1$s <span>at</span> %2$s', 'thb_text_domain'), get_comment_date(),  get_comment_time() ); ?>
							<span class="user">
								<?php echo get_comment_author_link(); ?>
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
			</section>
		</li>
		<?php break; ?>

<?php endswitch; ?>