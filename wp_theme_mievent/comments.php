<?php if(have_comments() || comments_open()) { ?>
<?php if(comments_open()) { ?>
<div class="post-comments clearfix">
	<div class="col-lg-12">
		<h4 class="add-comment-head h4-24"><?php _e('add a new comment','mtheme'); ?></h4>	
		<div class="comment-form clearfix">
			<?php comment_form(); ?>
		</div>
	</div>
</div>
<?php } ?>		
<?php if(have_comments()) { ?>
<div class="post-comments clearfix">
	<div class="col-lg-12">
		<h4 class="read-comment-head h4-24"><span><?php echo get_comments_number( get_the_ID() ); ?></span>  <?php _e('Comments','mtheme'); ?></h4>
		<div class="comments-listing bottomborder clearfix">
			<?php
				wp_list_comments(array(
					'per_page' => -1,
					'avatar_size' => 75,
					'type' => 'comment',
					'callback'=>array('MthemeInterface', 'renderComment')
				));
			?>
		</div>	
	</div>
</div>
<?php } ?>
<?php } ?>