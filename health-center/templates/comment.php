<li id="comment-<?php comment_ID() ?>" <?php comment_class( 'clearfix' . ( $args['has_children'] ? 'has-children' : '' ) ) ?>>
	<div class="comment-author">
		<?php echo get_avatar( get_comment_author_email(), 73 ); ?>
	</div>
	<div class="comment-content">
		<div class="comment-meta">
			<h4 class="comment-author-link"><?php comment_author_link(); ?></h4>
			<h6 title="<?php comment_time(); ?>" class="comment-time"><?php comment_date(); ?></h6>
			<?php edit_comment_link( sprintf( '[%s]', __( 'Edit', 'health-center' ) ) ) ?>
			<?php
				if ( $args['type'] == 'all' || get_comment_type() == 'comment' ) :
					comment_reply_link( array_merge( $args, array(
					'reply_text' => __( 'Reply','default' ),
					'login_text' => __( 'Log in to reply.','default' ),
					'depth' => $depth,
					'before' => '<h6 class="comment-reply-link">',
					'after' => '</h6>'
					) ) );
				endif;
			?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) _e( "\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'shape' ) ?>
		<?php comment_text() ?>
	</div>