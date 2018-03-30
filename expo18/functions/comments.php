<?php

if( !function_exists( 'om_comment' ) ) {
	
	function om_comment($comment, $args, $depth) {
		
		$GLOBALS['comment'] = $comment; ?>
		<div class="comment" id="comment-<?php comment_ID() ?>">
			<div class="comment-inner depth-<?php echo $depth; ?>" id="comment-inner-<?php comment_ID(); ?>">
				<div class="comment-avatar">
					<?php echo get_avatar( $comment->comment_author_email, 26 ); ?>
				</div>
				<div class="comment-meta">
					<span class="comment-author">
						<?php printf(__('<cite class="fn">%s</cite>','om_theme'), get_comment_author_link()) ?>
					</span>
					<span class="comment-date">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s','om_theme'), get_comment_date(),  get_comment_time()) ?></a>
						<?php edit_comment_link(__('(Edit)','om_theme'),'  ','') ?>
					</span>
				</div>
				<div class="comment-text">
					<?php if ($comment->comment_approved == '0') : ?>
					   <em><?php _e('Your comment is awaiting moderation.','om_theme') ?></em>
					   <br />
					<?php endif; ?>
				
					<?php comment_text() ?>
				</div>
				
				<div class="comment-reply">
				   <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text'=>''))) ?>
				</div>
			</div>
		<?php
	}
}

if( !function_exists( 'om_pings_list' ) ) {
	function om_pings_list($comment, $args, $depth) {
		
	  $GLOBALS['comment'] = $comment;
	  
	  ?><div id="comment-<?php comment_ID(); ?>"><?php comment_author_link();?><?php
	  
	}
}

?>