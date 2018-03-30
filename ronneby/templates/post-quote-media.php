<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="entry-media <?php echo esc_attr($options['blog_comments_likes_style']) ?>">
	<?php get_template_part('templates/post', 'quote'); ?>
	<?php if($options['blog_show_comments'] == 'on') : ?>
		<div class="post-comments-wrap">
			<?php get_template_part('templates/entry-meta/mini', 'comments-number'); ?>
		</div>
	<?php endif; ?>
	<?php if($options['blog_show_likes'] == 'on') : ?>
		<div class="post-like-wrap">
			<?php get_template_part('templates/entry-meta/mini', 'like'); ?>
		</div>
	<?php endif; ?>
</div>