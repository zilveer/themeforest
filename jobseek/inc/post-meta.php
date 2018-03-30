<div class="meta">
	<span class="author"><?php _e('by', 'jobseek');?> <?php $user_info = get_userdata( $post->post_author ); echo $user_info->display_name; ?></span>
	<?php if( is_single() && has_category() ) { ?><span class="category"><?php _e('in', 'jobseek');?> <?php the_category(', '); ?></span><?php } ?>
	<span class="date"><?php the_time( 'd/m/Y' ); ?></span>
	<?php if ( comments_open() ) { ?><span class="comments"><a href="<?php echo esc_url( get_permalink() ); ?>#comments"><?php comments_number( __('0 comments', 'comments'), __('1 comment', 'comment'), __('% comments', 'comments') ); ?></a></span><?php } ?>
</div>