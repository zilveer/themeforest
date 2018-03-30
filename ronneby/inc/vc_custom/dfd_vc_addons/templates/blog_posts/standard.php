<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$extra_class_name = '';
$uniqid = uniqid('dfd-blog-module-');

$columns = (isset($columns) && !empty($columns)) ? $columns : 3;
$layout_type_grid_carousel = (isset($layout_type_grid_carousel) && !empty($layout_type_grid_carousel)) ? $layout_type_grid_carousel : 'standard';

$data_atts .= ' data-columns="'.esc_attr($columns).'"';
$data_atts .= ' data-layout-style="'.esc_attr($layout_type_grid_carousel).'"';
$data_atts .= ' data-item="post"';

if($layout_type_grid_carousel == 'carousel'){
	if(isset($enabled_autoslideshow) && !empty($enabled_autoslideshow)) {
		$data_atts .= ' data-enable_slideshow="'.$enabled_autoslideshow.'"';
		if(isset($carousel_slideshow_speed) && !empty($carousel_slideshow_speed)) {
			$data_atts .= ' data-slideshow_speed="'.$carousel_slideshow_speed.'"';
		}
	}
	
	$js_scripts .= 'if(typeof $.fn.initPostsCarousel !== "undefined") {
						$("#'.esc_js($uniqid).' .dfd-blog-carousel").initPostsCarousel();
					}';
}

if(isset($items_offset)) {
	$css_rules .= '#'.$uniqid.' .dfd-blog {margin: -'.esc_attr($items_offset/2).'px;}';
	$css_rules .= '#'.$uniqid.' .dfd-blog .cover {padding: '.esc_attr($items_offset/2).'px;}';
}

if($layout_type_grid_carousel == 'fitRows') {
	wp_enqueue_script('isotope');
	//wp_enqueue_script('dfd-isotope-blog');
	
	if(isset($grid_sort_panel) && $grid_sort_panel == 'sort') {
		$sort_panel = true;
	}
	
	$extra_class_name .= 'dfd-new-isotope';
	
	$js_scripts .= 'if(typeof jQuery.fn.initTaxonomyIsotope !== "undefined") {
						jQuery("#'.esc_js($uniqid).' .'.esc_js($extra_class_name).'").initTaxonomyIsotope();
					}';
}
?>
<div class="dfd-blog-loop dfd-blog-posts-module <?php echo esc_attr($el_class) ?>" id="<?php echo esc_attr($uniqid) ?>">
	<div class="dfd-blog-wrap">
		<?php
			if($sort_panel)
				include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/sort-panel.php'));
		?>
		<div class="dfd-blog dfd-blog-<?php echo esc_attr($layout_type_grid_carousel .' '.$extra_class_name .' '. $anim_class) ?>" <?php echo $data_atts ?>>
		<?php
			while ($wp_query->have_posts()) : $wp_query->the_post();

				$permalink = get_permalink();

				$excerpt = get_the_excerpt();

				if(!empty($excerpt))
					$excerpt = '<div class="entry-content '.esc_attr($content_alignment).'"><p>'.$excerpt.'</p></div>';

				$post_class = get_post_class();

				$post_class = implode(' ', $post_class);

				$post_class .= ' '.$content_alignment;
				
				if($sort_panel)
					include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/article_data_atts.php'));
				?>
				<div class="<?php echo esc_attr($post_class) ?>" <?php echo $article_data_atts; ?>>
					<div class="cover">
						<?php
						if (has_post_thumbnail()) {
							$thumb = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL

							$img_src = $img_url;

							if(!isset($image_width) || empty($image_width))
								$image_width = 900;

							if(!isset($image_height) || empty($image_height))
								$image_height = 600;

							$img_url = dfd_aq_resize($img_url, $image_width, $image_height, true, true, true);

							if(!$img_url) {
								$img_url = $img_src;
							}
							?>
							<div class="entry-media <?php echo esc_attr($media_class) ?>">
								<div class="entry-thumb">
									<img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title(); ?>"/>
									<?php include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/comments_likes.php')); ?>

								</div>
								<?php include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/heading.php')); ?>
							</div>
							<?php

							if($enable_excerpt)
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
						<?php } ?>
					</div>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
		?>
		</div>
	</div>
</div>