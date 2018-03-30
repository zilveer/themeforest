<ul class="post-meta">
	<li class="post-meta-date"><strong><?php echo get_the_date(); ?></strong></li>
	<li class="post-meta-auth"><?php the_author(); ?></li>
	<?php if ( comments_open() ) { ?>
	<li class="post-comments-link"><?php comments_popup_link( __('Leave a Comment (0)', 'bw_themes'), __('Leave a Comment (1)', 'bw_themes'), __('Leave a Comment', 'bw_themes').'(%)', '', ''); ?></li>
	<?php } else { ?>
	<li class="post-comments-link"><?php _e('Comments are closed', 'bw_themes');?></li>
	<?php } ?>
	<li class="post-meta-readmore"><a href="<?php echo get_permalink(); ?>"><?php _e('Read More', 'bw_themes');?></a></li>
</ul>