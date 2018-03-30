<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$format = get_post_format();
if (false === $format) {
    $format = 'standard';
}

global $save_image_ratio, $dfd_ronneby;
?>
<article class="post hnews hentry small-news post post-<?php the_ID(); ?> <?php echo 'format-' . $format ?>">
	<?php if(isset($dfd_ronneby['post_header']) && $dfd_ronneby['post_header']) : ?>
		<div class="clearfix">
			<?php if(!has_post_format('quote')) : ?>
				<div class="dfd-blog-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
				<?php get_template_part('templates/entry-meta', 'post-bottom'); ?>
			<?php endif; ?> 
		</div>
	<?php endif; ?>
	<div class="entry-media">
	<?php
		switch(true) {
			case has_post_format('video'):
				get_template_part('templates/post', 'video');
				break;
			case has_post_format('audio'):
				get_template_part('templates/post', 'audio');
				break;
			case has_post_format('gallery'):
				get_template_part('templates/post', 'gallery');
				break;
			case has_post_format('quote'):
				get_template_part('templates/post', 'quote');
				break;
			default:
				get_template_part('templates/thumbnail/post');
				if (has_post_thumbnail()) {
					if (!isset($dfd_ronneby['thumb_image_crop']) || !$dfd_ronneby['thumb_image_crop']) {
						$image_crop = true;
					} else {
						$image_crop = $dfd_ronneby['thumb_image_crop'];
					}
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url($thumb, 'large'); //get img URL

					$height = null;

				if (is_page_template('tmp-posts-masonry-2-side.php')){
						if (!$save_image_ratio) {
							$height = 270;
						}
				    $article_image = dfd_aq_resize($img_url, 407, $height, $image_crop, true, true);
					if(!$article_image) {
						$article_image = $img_url;
					}
				} elseif (is_page_template('tmp-posts-masonry-2.php')){
						if (!$save_image_ratio) {
							$height = 320;
						}
				    $article_image = dfd_aq_resize($img_url, 567, $height, $image_crop, true, true);
					if(!$article_image) {
						$article_image = $img_url;
					}
				} else {
						if (!$save_image_ratio) {
							$height = 270;
						}
				    $article_image = dfd_aq_resize($img_url, 407, $height, $image_crop, true, true);
					if(!$article_image) {
						$article_image = $img_url;
					}
				}
			}
		}
	?>
	</div>
	<?php if(!has_post_format('quote')) : ?>
		<div class="clearfix">
			<div class="entry-content grid">
				<?php $dfd_post_content = get_the_excerpt(); ?>
				<?php echo !empty($dfd_post_content) ? '<p>'.$dfd_post_content.'</p>' : ''; ?>
				<?php $read_more_style = (isset($dfd_ronneby['style_hover_read_more']) && !empty($dfd_ronneby['style_hover_read_more'])) ? $dfd_ronneby['style_hover_read_more'] : 'chaffle'; ?>
				<a href="<?php echo the_permalink(); ?>" title="<?php the_title(); ?>" class="more-button <?php echo esc_attr($read_more_style); ?> left" data-lang="en"><?php _e('Continue', 'dfd'); ?></a>
				<div class="entry-meta right">
					<?php get_template_part('templates/entry-meta/mini', 'comments'); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</article>
