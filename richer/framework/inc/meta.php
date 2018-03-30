<?php global $options_data; ?>
<?php if($options_data['check_author'] != 0) :?>
<span class="meta meta-author">
	<i class="fa fa-user"></i><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="<?php _e('View all posts by', 'richer'); ?> <?php the_author(); ?>"><?php the_author(); ?></a>
</span>
<?php endif;?>
<?php if($options_data['check_date'] != 0) :?>
<span class="meta meta-date">
	<i class="fa fa-pencil"></i><time datetime="<?php echo date(DATE_W3C); ?>" class="updated"><?php the_time(get_option('date_format')); ?></time>
</span>
<?php endif;?>
<?php if($options_data['check_comments'] != 0) :
if ( comments_open() ) : ?>
	<span class="meta meta-comment">
		<i class="fa fa-comments"></i><?php comments_popup_link(__('No Comments', 'richer'), __('1 Comment', 'richer'), __('% Comments', 'richer'), 'comments-link', ''); ?>
	</span>
<?php endif; 
endif; ?>
<?php if($options_data['check_tags'] != 0 && get_the_tags() ) :?>
<span class="meta meta-tags">
	<i class="fa fa-tags"></i><?php the_tags('',', ', ''); ?>
</span>
<?php endif;?>
<?php if($options_data['check_categories'] != 0 && count( get_the_category() )) :?>
<span class="meta meta-category">
	<i class="fa fa-list"></i><?php the_category(',&nbsp;'); ?>
</span>
<?php endif;?>

	