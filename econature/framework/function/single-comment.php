<?php 
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.0.0
 * 
 * Custom Single Comment Template
 * Created by CMSMasters
 * 
 */


function mytheme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="alignleft">
				<?php echo get_avatar($comment->comment_author_email, 100, get_option('avatar_default')) . "\n"; ?>
				<?php edit_comment_link(__('Edit', 'cmsmasters'), '', ''); ?>
			</div>
			<div class="comment-content">
				<?php 
				comment_reply_link(array_merge($args, array( 
					'depth' => $depth, 
					'max_depth' => $args['max_depth'], 
					'reply_text' => __('Reply', 'cmsmasters') 
				)));
				
				echo '<abbr class="published" title="' . get_comment_time('M d, Y') . ', ' . get_comment_time('g:i a') . '">' . 
					__('on', 'cmsmasters') . ' ' . get_comment_time('M d, Y') . ', ' . get_comment_time('g:i a') . 
				'</abbr>';
				?>
				<h2 class="fn"><?php echo get_comment_author_link(); ?></h2>
				<div class="cl"></div>
				<?php 
					comment_text();
					
					if ($comment->comment_approved == '0') {
						echo '<p>' . 
							'<em>' . __('Your comment is awaiting moderation.', 'cmsmasters') . '</em>' . 
						'</p>';
					}
				?>
			</div>
			<div class="cl"></div>
        </div>
    <?php 
}

