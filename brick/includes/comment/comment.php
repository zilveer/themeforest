<?php

if (!function_exists('qode_comment')) {
function qode_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; 

	global $qode_options, $post;
	$title_tag="h5";

	if(isset($qode_options['blog_single_title_tags'])){
		$title_tag = $qode_options['blog_single_title_tags'];
	}
	$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
	//get correct heading value
	$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : 'h5';

	$is_pingback_comment = $comment->comment_type == 'pingback';
	$is_author_comment  = $post->post_author == $comment->user_id;

	$comment_class = 'comment clearfix';

	if($is_author_comment) {
		$comment_class .= ' post_author_comment';
	}

	if($is_pingback_comment) {
		$comment_class .= ' pingback-comment';
	}

	?>

	<li>
		<div class="<?php echo esc_attr($comment_class); ?>">
			<?php if(!$is_pingback_comment) { ?>
				<div class="image"> <?php echo qode_kses_img(get_avatar($comment, 102)); ?> </div>
			<?php } ?>
			<div class="text">
				<div class="comment_info">
					<<?php echo esc_attr($title_tag);?> class="name">
						<?php if($is_pingback_comment) { _e('Pingback:', 'qode'); } ?>
						<?php echo wp_kses_post(get_comment_author_link()); ?>
						<?php if($is_author_comment) { ?>
							<i class="fa fa-user post-author-comment-icon"></i>
						<?php } ?>
					</<?php echo esc_attr($title_tag); ?>>
					<?php
						comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']) ) );
						edit_comment_link();
					?>
				</div>
				<?php if(!$is_pingback_comment) { ?>
					<div class="text_holder" id="comment-<?php echo comment_ID(); ?>">
						<?php comment_text(); ?>
					</div>
					<span class="comment_date"><?php comment_time(get_option('date_format')); ?> <?php _e('at', 'qode'); ?> <?php comment_time(get_option('time_format')); ?></span>
				<?php } ?>
			</div>
		</div>
	<?php //li tag will be closed by WordPress after looping through child elements ?>

	<?php
	}
}
?>