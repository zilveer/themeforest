<?php get_template_part('templates/post/content-meta'); ?>
<div class="post-content">
<?php if (ct_get_option("posts_index_show_excerpt", 1)): ?>
		<a href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>">
			<?php $quote = get_post_meta($post->ID, 'quote', true); ?>
			<?php echo do_shortcode('[blockquote author="' . get_the_title() . '"]' . $quote . '[/blockquote]')?>
		</a>
<?php endif;?>
</div>


