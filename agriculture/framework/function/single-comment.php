<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
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
			<div class="cmsms_comment_info">
				<?php 
				echo '<abbr class="published" title="' . get_comment_time('F d, Y') . ' at ' . get_comment_time('g:i a') . '">' . "\n\t\t\t\t\t\t" . 
					get_comment_time('F d, Y') . ' at ' . get_comment_time('g:i a') . 
				'</abbr>' . "\r" . 
				'<h6>' . get_comment_author_link() . '</h6>';
				?>
			</div>
			<div class="alignleft">
				<?php echo get_avatar($comment->comment_author_email, '70', get_option('avatar_default')) . "\n"; ?>
			</div>
			<div class="comment-content">
				<?php 
					comment_text();
					
					if ($comment->comment_approved == '0') {
						echo '<p>' . 
							'<em>' . __('Your comment is awaiting moderation.', 'cmsmasters') . '</em>' . 
						'</p>';
					}
					
					echo '<div class="cl"></div>';
					
					comment_reply_link(array_merge($args, array( 
						'depth' => $depth, 
						'max_depth' => $args['max_depth'], 
						'reply_text' => __('Reply', 'cmsmasters')
					)));
					
					edit_comment_link(__('Edit', 'cmsmasters'), '', '');
				?>
			</div>
        </div>
    <?php 
}

