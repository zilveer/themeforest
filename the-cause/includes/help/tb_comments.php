<?php
function tb_comment_template($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment; ?>
	
<div <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="commentHolder">
        <div class="gravatar">
            <?php echo get_avatar($comment, $size = '36', $default = get_option('tb_default_avatar')); ?>
        </div>

        <div class="commentContent">
        
        	<div class="commentHeader">
            	<div>
					<strong class="author_name heading"><?php echo get_comment_author_link(); ?></strong>
                    <div class="right date"><?php echo get_comment_date() . ' at ' . get_comment_time(); ?></div>
                </div>
            </div>
            
            <div class='commentText'>
				<?php comment_text() ?>
        
                <?php if ($comment->comment_approved == '0') { ?>
                    <em>Your comment is awaiting moderation.</em>             
                <?php } ?>
        	</div>    

            
            <div class="commentMeta commentMetaData">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                <?php edit_comment_link('Edit Comment', '', '') ?>
            </div>
            
    	</div>
        
        <div class="clear"></div>
    </div>

<?php
}

function tb_force_comment_author_url($comment)
{
    $noUrl = !$comment->comment_author_url || $comment->comment_author_url == 'http://';

    if ($comment->user_id && $noUrl) {
		$commentAuthorInfo = get_userdata($comment->user_id);
        $comment->comment_author_url = home_url() . '/author/' . $commentAuthorInfo->user_login;
    }
	
    return $comment;
}

add_filter('get_comment', 'tb_force_comment_author_url');

?>