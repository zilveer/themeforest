<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$extra_class_name = '';
$uniqid = uniqid('dfd-blog-module-');

$columns = (isset($columns) && !empty($columns)) ? $columns : 3;

$data_atts .= ' data-columns="'.esc_attr($columns).'"';
$data_atts .= ' data-layout-style="masonry"';
$data_atts .= ' data-item="post"';

if(isset($items_offset)) {
	$css_rules .= '#'.esc_js($uniqid).' .dfd-blog {margin: -'.esc_js($items_offset/2).'px;}';
	$css_rules .= '#'.esc_js($uniqid).' .dfd-blog .cover {padding: '.esc_js($items_offset/2).'px;}';
}

wp_enqueue_script('isotope');
//wp_enqueue_script('dfd-isotope-blog');
if(isset($masonry_sort_panel) && $masonry_sort_panel == 'sort') {
	$sort_panel = true;
}

$extra_class_name .= 'dfd-new-isotope';

$js_scripts .= 'if(typeof $.fn.initTaxonomyIsotope !== "undefined") {
					$("#'.esc_js($uniqid).' .'.esc_js($extra_class_name).'").initTaxonomyIsotope();
				}';

?>
<div class="dfd-blog-loop dfd-blog-posts-module <?php echo esc_attr($el_class) ?>" id="<?php echo esc_attr($uniqid) ?>">
	<div class="dfd-blog-wrap">
		<?php
			if($sort_panel)
				include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/sort-panel.php'));
		?>
		
		<div class="dfd-blog dfd-blog-<?php echo esc_attr($style .' '.$extra_class_name .' '. $anim_class) ?>" <?php echo $data_atts ?>>
		<?php
		
			while ($wp_query->have_posts()) : $wp_query->the_post();
				$post_format = get_post_format();

				$avail_post_formats = array('video', 'audio', 'gallery', 'quote');

				$permalink = get_permalink();

				$excerpt = get_the_excerpt();

				if(!empty($excerpt))
					$excerpt = '<div class="entry-content"><p>'.$excerpt.'</p></div>';

				$post_class = get_post_class();

				$post_class = implode(' ', $post_class);

				$post_class .= ' dfd-title-'.$heading_position;

				$post_class .= ' '.$content_alignment;

				if($sort_panel)
					include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/article_data_atts.php'));
				?>
				<div class="<?php echo esc_attr($post_class) ?>" <?php echo $article_data_atts; ?>>
					<div class="cover">
						<?php
						if($heading_position == 'top' || $post_format == 'quote')
							include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/heading.php'));

						?>
						<div class="entry-media <?php echo esc_attr($media_class) ?>">
						<?php
							if($post_format && in_array($post_format, $avail_post_formats)) {
								get_template_part('templates/post', $post_format);
								include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/comments_likes.php'));
							} else {
								$caption = get_the_title();
								if (has_post_thumbnail()) {

									$thumb = get_post_thumbnail_id();
									$img_src = wp_get_attachment_image_src($thumb, 'full');
									$img_url = (isset($img_src[0]) && !empty($img_src[0])) ? $img_src[0] : get_template_directory_uri() . '/assets/images/no_image_resized_675-450.jpg';
									$meta = wp_get_attachment_metadata($thumb);
									if(isset($meta['image_meta']['caption']) && $meta['image_meta']['caption'] != '') {
										$caption = $meta['image_meta']['caption'];
									} else if(isset($meta['image_meta']['title']) && $meta['image_meta']['title'] != '') {
										$caption = $meta['image_meta']['title'];
									}
									
								} else {
									$img_url = get_template_directory_uri() . '/assets/images/no_image_resized_675-450.jpg';
								}
								?>
									<div class="entry-thumb">
										<img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($caption); ?>"/>
										<?php include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/comments_likes.php')); ?>
									</div>
								<?php
							}
						?>
						</div>

						<?php
						if($heading_position == 'bottom' && $post_format != 'quote')
							include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/heading.php'));

						if($enable_excerpt && $post_format != 'quote')
							echo $excerpt;

						if($read_more || $share) : ?>
							<div class="dfd-read-share clearfix">
								<?php if($read_more) : ?>
									<div class="read-more-wrap">
										<a href="<?php echo esc_url($permalink) ?>" class="more-button <?php echo esc_attr($read_more_style) ?>" title="<?php __('Read more','dfd') ?>" data-lang="en"><?php _e('More', 'dfd'); ?></a>
									</div>
								<?php endif; ?>
								<?php if($share) : ?>
									<div class="dfd-share-cover dfd-share-<?php echo esc_attr($share_style);  ?>">
										<?php get_template_part('templates/entry-meta/mini','share-blog') ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php
			endwhile;
		wp_reset_postdata();
		?>
		</div>
	</div>
</div>
