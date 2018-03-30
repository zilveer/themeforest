<?php
/**
 * This file contains the comments functionality.
 * @author Pexeto
 */


/**
 * Displays a single comment.
 */
function pexetotheme_comment($comment, $args, $depth) {
	?>
<li <?php comment_class(); ?>>
	<div class="comment-container">
		<div class="coment-box">
			<div class="comment-autor"><?php echo get_avatar($comment,$size='80',$default='' ); ?>
				<p class="coment-autor-name"><?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?></p>
			</div>
			<div class="comment-text"><?php comment_text(); ?></div>
			<div class="comment-date post-info">
				<div class="alignleft no-caps"><?php printf(__('%1$s'), get_comment_date(get_option('date_format'))); ?> &nbsp; /</div>
		
				<div class="reply">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => 4, 'reply_text'=>pex_text('_reply_text'))));
					?></div>
					
					
			</div>
		
		</div>
	</div>
</li>
	<?php
}