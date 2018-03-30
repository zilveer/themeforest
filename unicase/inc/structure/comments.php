<?php
/**
 * Template functions used for the site comments.
 *
 * @package unicase
 */

if ( ! function_exists( 'unicase_display_comments' ) ) {
	/**
	 * Unicase display comments
	 * @since  1.0.0
	 */
	function unicase_display_comments() {
		// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' != get_comments_number() ) :
			comments_template();
		endif;
	}
}

if ( ! function_exists( 'unicase_comment' ) ) {
	/**
	 * Unicase comment template
	 * @since 1.0.0
	 */
	function unicase_comment( $comment, $args, $depth ) {
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
			<div class="media">		
				<div class="gravatar-wrapper media-left">
					<?php echo get_avatar( $comment, 70 ); ?>			
				</div>

				<div class="comment-body media-body">
					<div class="comment-meta commentmetadata">
						<div class="comment-author vcard">
							<?php printf( '<cite class="fn media-heading">%s</cite>', get_comment_author_link() ); ?>
						</div>
						<?php if ( '0' == $comment->comment_approved ) : ?>
							<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'unicase' ); ?></em>
							<br />
						<?php endif; ?>
						
						<div class="date-reply">
							<a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>" class="comment-date">
								<?php echo '<time>' . get_comment_date() . '</time>'; ?>
							</a>
							<div class="reply">
							   <?php edit_comment_link( esc_html__( 'Edit', 'unicase' ), '  ', '' ); ?>
							   <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>				
							</div>
						</div>
					</div>
					
					<?php if ( 'div' != $args['style'] ) : ?>
					<div id="div-comment-<?php comment_ID() ?>" class="comment-content">
					<?php endif; ?>
	        
	        		<?php comment_text(); ?>

	        		<?php if ( 'div' != $args['style'] ) : ?>
					</div>
					<?php endif; ?>
		
				</div><!-- /.comment-body -->
			</div><!-- /.media -->	
	<?php
	}
}

if ( ! function_exists( 'unicase_pings' ) ) {
	/**
	 * Unicase comment template
	 * @since 1.0.0
	 */
	function unicase_pings( $comment, $args, $depth ) {
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
			<div class="comment-body">
				<div class="comment-meta commentmetadata">
					<div class="comment-author vcard">
						<?php printf( '<cite class="fn media-heading">%s</cite>', get_comment_author_link() ); ?>
					</div>
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'unicase' ); ?></em>
						<br />
					<?php endif; ?>
					
					<div class="date-reply">
						<a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>" class="comment-date">
							<?php echo '<time>' . get_comment_date() . '</time>'; ?>
						</a>
						<div class="reply">
						   <?php edit_comment_link( esc_html__( 'Edit', 'unicase' ), '  ', '' ); ?>
						   <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>				
						</div>
					</div>
				</div>
				
				<?php if ( 'div' != $args['style'] ) : ?>
				<div id="div-comment-<?php comment_ID() ?>" class="comment-content">
				<?php endif; ?>
        
        		<?php comment_text(); ?>

        		<?php if ( 'div' != $args['style'] ) : ?>
				</div>
				<?php endif; ?>
	
			</div><!-- /.comment-body -->
	<?php
	}
}