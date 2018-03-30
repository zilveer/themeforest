<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (has_post_thumbnail()) {
	$thumb = get_post_thumbnail_id();
	$img_src = wp_get_attachment_url($thumb, 'full'); //get img URL
	$img_url = dfd_aq_resize($img_src, 1280, 450, true, true, true); //get img URL
	if(!$img_url) {
		$img_url = $img_src;
	}
} else {
	$img_url = get_stylesheet_directory_uri().'/assets/images/no_image_resized_795-350.jpg';
}

$trimmed_content = '';
if ($enable_description) {
	$content = get_the_excerpt();
	$trimmed_content = wp_trim_words($content, $limit_words, '');
}
?>

<div class="item">
	<div class="entry-thumb">
		<img src="<?php echo esc_url($img_url); ?>" alt="">
		<?php if ($enable_title): ?>
			<div class="news-slider-entry-hover">
				<h3 class="widget-title">
					<?php if ($enable_link) { ?>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<?php
					} else {
						the_title();
					}
					?>
				</h3>
				<?php get_template_part('templates/entry-meta', 'post-bottom'); ?>
				<?php if($enable_description && !empty($trimmed_content)) : ?>
					<div class="entry-content">
						<p><?php echo $trimmed_content; ?></p>
						<a href="<?php the_permalink()?>" class="more-button dfd-animate-first-last" title="<?php the_title(); ?>"><span class="dfd-first"><?php _e('More', 'dfd'); ?></span><span class="dfd-last"><?php _e('More', 'dfd'); ?></span></a>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	</div>
</div>