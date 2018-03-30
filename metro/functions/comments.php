<?php

if( !function_exists( 'om_comment' ) ) {
	
	function om_comment($comment, $args, $depth) {
		global $post;
		
		$GLOBALS['comment'] = $comment; ?>
		<div class="comment<?php if($comment->user_id == $post->post_author) echo ' bypostauthor' ?>" id="comment-<?php comment_ID() ?>">
			<div class="comment-inner depth-<?php echo $depth; ?>" id="comment-inner-<?php comment_ID(); ?>">
				<div class="comment-uber-inner">
					<div class="info zero-mar">
						<div class="pic">
							<div class="pic-inner">
								<?php echo get_avatar( $comment->comment_author_email, 38 ); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="name-date">
							<div class="name"><?php printf(__('<cite class="fn">%s</cite>','om_theme'), get_comment_author_link()) ?></div>
							<div class="date"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s','om_theme'), get_comment_date(),  get_comment_time()) ?></a></div>
							<?php edit_comment_link(__('(Edit)','om_theme'),'<div class="edit">','</div>') ?>
						</div>
					</div>
					<div class="frame">
						<div class="frame-inner">
							<div class="text">
								<?php if ($comment->comment_approved == '0') : ?>
								   <em><?php _e('Your comment is awaiting moderation.','om_theme') ?></em>
								   <br />
								<?php endif; ?>
								<?php comment_text() ?>
							</div>
							<div class="reply">
								<?php
									$reply=get_comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
									$reply=preg_replace('#<a([^>]*)>([\s\S]*)</a>#','<a$1><span>$2</span></a>',$reply);
									echo $reply;
								?>
								
							</div>
						</div>
					</div>
				</div>
				
			</div>
		<?php
	}
}

if( !function_exists( 'om_pings_list' ) ) {
	function om_pings_list($comment, $args, $depth) {
		
	  $GLOBALS['comment'] = $comment;
	  
	  ?><div id="comment-<?php comment_ID(); ?>"><?php comment_author_link();
	  
	}
}

?>