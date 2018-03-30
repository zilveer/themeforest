<?php $max_depth=MthemeCore::getOptionValue('thread_comments_depth', '5');
if ($GLOBALS['depth'] == 1) { ?>
<div class="comment topborder clearfix">
<?php }else{ ?>
<div class="comment clearfix">
<?php }?>
	<div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
		<div class="comment-img">
			<?php echo get_avatar(get_comment_author_email() ,90); ?>
		</div>										
	</div>
	<div class="col-lg-11 col-md-10 col-sm-10 col-xs-12 comment-details clearfix">
		<div class="text-left clearfix">			
			<span class="profile-name-discussion"><?php esc_attr(comment_author()); ?></span>
			<span class="time-last-comment"><?php esc_attr(comment_time('M j, Y')); ?></span>
		</div>
		
		<div class="text-left clearfix">
			<div class="comments-text">
				<?php esc_attr(comment_text()); ?>
			</div>
			<div class="counter text-left">
				<?php esc_url(comment_reply_link(array('depth' => $GLOBALS['depth'], 'max_depth' => $max_depth))); ?>
				<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
			</div>
		</div>
	</div>
</div>
