<?php
/**
 *  
 *  This function is the function that iterates over each comment entry and displays it.
 *  Actually its not really a loop but a function called by the iterating wordpress class
 *  
 */
 
function avia_inc_custom_comments($comment, $args, $depth) 
{
	$GLOBALS['comment'] = $comment; 
	
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	
		<div id="comment-<?php comment_ID(); ?>">
			<div class="gravatar">
				<?php 
				//display the gravatar
				echo get_avatar($comment,'36'); ?>
			</div>
			
			<!-- display the comment -->
			<div class='comment_content'>
			
			<?php printf(__('<cite class="author_name heading">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
			<?php edit_comment_link(__('(Edit)'),'  ','') ?>
			
			<!-- display the comment metadata like time and date-->
			<div class="comment-meta commentmetadata">
			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a>
			</div>
			
			<!-- display the comment text -->
			<div class='comment_text entry-content'>
			<?php comment_text(); ?>
			<?php if ($comment->comment_approved == '0') : ?>
			<em><?php _e('Your comment is awaiting moderation.','avia_framework') ?></em>
			<?php endif; ?>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
			
		</div>
	</div>
<?php
}
