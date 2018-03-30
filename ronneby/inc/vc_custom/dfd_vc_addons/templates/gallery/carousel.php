<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$columns_masonry = (isset($columns_masonry) && !empty($columns_masonry)) ? $columns_masonry : 3;

$data_atts .= ' data-columns="'.esc_attr($columns_masonry).'"';
$data_atts .= ' data-layout-style="'.esc_attr($style).'"';

if(isset($items_offset)) {
	$css_rules .= '#'.esc_js($uniqid).' .dfd-gallery {margin: -'.esc_js($items_offset/2).'px;}';
	$css_rules .= '#'.esc_js($uniqid).' .dfd-gallery .cover {padding: '.esc_js($items_offset/2).'px;}';
}

$js_scripts .= 'if(typeof jQuery.fn.initPostsCarousel !== "undefined") {
					jQuery("#'.esc_js($uniqid).' .dfd-gallery").initPostsCarousel();
				}';
/*
if(isset($image_mask_background) && !empty($image_mask_background)) {
	if($image_mask_background == 'color') {
		if(isset($image_mask_color) && !empty($image_mask_color)) {
			$css_rules .= '#'.esc_attr($uniqid).'.dfd-portfolio-module.dfd-portfolio-loop.style_01 .project .entry-thumb .portfolio-custom-hover {background: '.esc_attr($image_mask_color).';}';
		}
	} elseif($image_mask_background == 'gradient') {
		if(isset($image_mask_color) && !empty($image_mask_color)) {
			$css_rules .= '#'.esc_attr($uniqid).'.dfd-portfolio-module.dfd-portfolio-loop.style_01 .project .entry-thumb .portfolio-custom-hover {background: transparent;}';
			$css_rules .= '#'.esc_attr($uniqid).'.dfd-portfolio-module.dfd-portfolio-loop.style_01 .project .entry-thumb .portfolio-custom-hover:before {content: "";display: block;position: absolute;top: 0;bottom: 0;left: 0;right: 0; '.esc_attr($image_mask_gradient).'}';
		}
	}
	if(isset($folio_hover_text_color) && !empty($folio_hover_text_color)) {
		$css_rules .= '#'.esc_attr($uniqid).'.dfd-portfolio-module.dfd-portfolio-loop.style_01 .project .entry-thumb .portfolio-custom-hover .dfd-dotted-link > span:before,
						#'.esc_attr($uniqid).'.dfd-portfolio-module.dfd-portfolio-loop.style_01 .project .entry-thumb .portfolio-custom-hover .dfd-dotted-link > span:after {background: '.esc_attr($folio_hover_text_color).'}';
	}
}
*/

?>
<div class="dfd-gallery-loop dfd-gallery-module <?php echo esc_attr($el_class) ?>" id="<?php echo esc_attr($uniqid) ?>">
	<div class="dfd-gallery-wrap">
		
		<div class="dfd-gallery dfd-gallery-<?php echo esc_attr($style .' '. $anim_class) ?>" <?php echo $data_atts ?>>
		<?php
		
			while ($wp_query->have_posts()) : $wp_query->the_post();
			
				$title = get_the_title();	
				$subtitle = DfdMetaBoxSettings::get('stunnig_headers_subtitle');

				$permalink = get_permalink();

				$post_class = 'dfd-gallery-single-item';

				$post_class .= ' '.$dfd_gallery_hover_style_class;
				
				?>
				<div class="<?php echo esc_attr($post_class) ?>" <?php echo $article_data_atts; ?>>
					<div class="cover <?php echo esc_attr($content_alignment) ?>">
						<div class="dfd-gallery-inner-wrap">
							<?php
							if(isset($title_position) && $title_position == 'top')
								include(locate_template('inc/vc_custom/dfd_vc_addons/templates/gallery/template_parts/heading.php'));

							$caption = get_the_title();
							if (has_post_thumbnail()) {

								$thumb = get_post_thumbnail_id();
								$img_url = wp_get_attachment_url($thumb);
								
								if(!isset($image_width) || empty($image_width))
									$image_width = 900;
								
								if(!isset($image_height) || empty($image_height))
									$image_height = 600;
								
								$img_src = $img_url;
								
								$img_url = dfd_aq_resize($img_src, $image_width, $image_height, true, true, true);
								
								if(!$img_url)
									$img_url = $img_src;

								include(locate_template('templates/gallery/hover-link.php'));

							} else {
								$img_url = get_template_directory_uri() . '/assets/images/no_image_resized_675-450.jpg';
							} ?>

							<div class="entry-thumb <?php echo esc_attr($media_class) ?>">
								<img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($caption); ?>"/>
								<?php include(locate_template('inc/vc_custom/dfd_vc_addons/templates/gallery/template_parts/comments_likes.php')); ?>
								<?php include(locate_template('templates/gallery/custom-hover.php')); ?>
							</div>

							<?php
							if(isset($title_position) && $title_position == 'bottom')
								include(locate_template('inc/vc_custom/dfd_vc_addons/templates/gallery/template_parts/heading.php'));

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
				</div>
			<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</div>
