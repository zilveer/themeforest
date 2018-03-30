<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!has_post_format('quote')) : ?>
	<div class="entry-media <?php echo esc_attr($options['blog_comments_likes_style']) ?>">
	<?php
		switch(true) {
			case has_post_format('video'):
				get_template_part('templates/post', 'video');
				if($options['blog_show_comments'] == 'on') {
					echo '<div class="post-comments-wrap">';
						get_template_part('templates/entry-meta/mini', 'comments-number');
					echo '</div>';
				}
				if($options['blog_show_likes'] == 'on') {
					echo '<div class="post-like-wrap">';
						get_template_part('templates/entry-meta/mini', 'like');
					echo '</div>';
				}
				break;
			case has_post_format('audio'):
				get_template_part('templates/post', 'audio');
				?>
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
				<?php
				break;
			case has_post_format('gallery'):
				get_template_part('templates/post', 'gallery');
				if($options['blog_show_comments'] == 'on') {
					echo '<div class="post-comments-wrap">';
						get_template_part('templates/entry-meta/mini', 'comments-number');
					echo '</div>';
				}
				if($options['blog_show_likes'] == 'on') {
					echo '<div class="post-like-wrap">';
						get_template_part('templates/entry-meta/mini', 'like');
					echo '</div>';
				}
				break;
			default:
				require(locate_template('templates/thumbnail/post-new.php'));
		}
	?>
	</div>
<?php endif;