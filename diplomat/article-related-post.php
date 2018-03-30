<?php
if (!defined('ABSPATH')) exit();

$posts_count = count($wp_query->posts);
$last_col_class = '';

if ($posts_count < 4 && $wp_query->posts[$posts_count-1]->ID === $post->ID ) {
	$last_col_class = ' end';
}

$post_types = array(
	'audio',
	'video',
	'gallery',
);

$post_pod_type = get_post_format();
$post_type_values = get_post_meta($post->ID, 'post_type_values', true);

if (!in_array($post_pod_type, $post_types)) {
	$template = 'default';
} else {
	$template = $post_pod_type;
}

$image_size = '150*120';
$video_width = 150;
$video_height = 120;
$image_placeholder = true;
?>

<div class="large-3 columns<?php echo esc_attr($last_col_class); ?>">
	<article class="post related">

		<?php
		if ($post_pod_type !== 'quote') {
			include(locate_template('article-'.$template.'.php'));
		}
		?>

		<header class="entry-header">
			<h4 class="entry-title">
				<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a>
			</h4>
		</header>

		<footer class="entry-footer">
			<?php if (TMM::get_option('blog_listing_show_date') !== '0') { ?>
				<span class="posted-on"><a href="<?php echo esc_url(TMM_Helper::get_post_date_link(get_the_date('d.m.Y'))); ?>"><?php echo get_the_date('M d, Y') ?></a></span>
			<?php } ?>
			<?php  if (TMM::get_option('blog_listing_show_comments') !== '0') { ?>
				<span class="comments-link"><a href="<?php echo esc_url(get_permalink()); ?>#comments"><?php echo get_comments_number(); ?></a></span>
			<?php } ?>
		</footer>
	</article>
</div>
