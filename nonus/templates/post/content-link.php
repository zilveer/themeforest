<?php get_template_part('templates/post/content-meta'); ?>
<div class="post-content">
	<?php if (ct_get_option("posts_index_show_title", 1)): ?>
		<?php $link = get_post_meta($post->ID, 'link', true); ?>
		<h2 class="post-title">
            <a href="<?php echo $link; ?>"><?php the_title(); ?></a>
        </h2>
	<?php endif;?>

	<?php if (ct_get_option("posts_index_show_more", 1)): ?>
		<a href="<?php the_permalink()?>" class="btn post-more"><?php _e('Read More', 'ct_theme')?></a>
	<?php endif;?>
</div>