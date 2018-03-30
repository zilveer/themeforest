<?php
/**
 * This file contains the comments functionality.
 * @author Pexeto
 */


if(!function_exists('pexeto_comments')){
	/**
	 * Displays a single comment.
	 */
	function pexeto_comments($comment, $args, $depth) {
		?>
	<li <?php comment_class(); ?>>
		<div class="comment-container" id="comment-<?php comment_ID() ?>">
			<div class="comment-box">
				<div class="comment-info">
					<?php if($comment->comment_type=='pingback'){ ?>
						<span class="ping-title"><?php _e('Pingback:', 'pexeto'); ?> </span>
					<?php } ?>
					<span class="coment-autor-name"><?php printf('<cite class="fn">%s</cite>', get_comment_author_link()) ?></span>
					<span class="comment-date"><?php echo get_comment_date(get_option('date_format')); ?> &nbsp;  </span>
			
					<span class="reply">
						<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'reply_text'=>__( 'Reply', 'pexeto' ).' &rarr;')));?></span>
				</div>	
				<div class="clear"></div>	
				<div class="comment-wrapper">
				<div class="comment-autor"><?php echo get_avatar($comment,$size='80',$default='' ); ?></div>
					<?php if($comment->comment_type!='pingback'){ ?>
						<div class="comment-text"><?php comment_text(); ?></div>
					<?php } ?>
					
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php
	}
}