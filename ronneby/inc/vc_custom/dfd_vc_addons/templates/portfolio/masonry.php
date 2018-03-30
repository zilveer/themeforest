<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$extra_class_name = '';

$columns = (isset($columns) && !empty($columns)) ? $columns : 3;

$data_atts .= ' data-columns="'.esc_attr($columns).'"';
$data_atts .= ' data-layout-style="'.esc_attr($style).'"';
$data_atts .= ' data-item="project"';

if(isset($items_offset)) {
	$css_rules .= '#'.esc_js($uniqid).' .dfd-portfolio {margin: -'.esc_js($items_offset/2).'px;}';
	$css_rules .= '#'.esc_js($uniqid).' .dfd-portfolio .cover {padding: '.esc_js($items_offset/2).'px;}';
}

if($folio_hover_plus_bg && !empty($folio_hover_plus_bg)) {
	switch($folio_hover_plus_position) {
		case 'dfd-top-right' :
		case 'dfd-bottom-right' :
			$css_rules .= '#'.esc_attr($uniqid).' .project .entry-thumb .portfolio-custom-hover .plus-link:before {border-right-color: '.esc_attr($options['folio_hover_plus_bg']).';}';
			break;
		case 'dfd-top-left' :
		case 'dfd-bottom-left' :
			$css_rules .= '#'.esc_attr($uniqid).' .project .entry-thumb .portfolio-custom-hover .plus-link:before {border-left-color: '.esc_attr($options['folio_hover_plus_bg']).';}';
			break;
	}
}

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
wp_enqueue_script('isotope');
//wp_enqueue_script('dfd-isotope-portfolio');
if(isset($sort_panel) && $sort_panel == 'sort') {
	$sort_panel_enabled = true;
}

$extra_class_name .= 'dfd-new-isotope';

$js_scripts .= 'if(typeof $.fn.initTaxonomyIsotope !== "undefined") {
					$("#'.esc_js($uniqid).' .'.esc_js($extra_class_name).'").initTaxonomyIsotope();
				}';
?>
<div class="dfd-portfolio-loop dfd-portfolio-module <?php echo esc_attr($el_class) ?>" id="<?php echo esc_attr($uniqid) ?>">
	<div class="dfd-portfolio-wrap">
		<?php
			if($sort_panel_enabled)
				include(locate_template('inc/vc_custom/dfd_vc_addons/templates/portfolio/template_parts/sort-panel.php'));
		?>
		
		<div class="dfd-portfolio dfd-portfolio-<?php echo esc_attr($style .' '. $extra_class_name .' '. $heading_position .' '. $anim_class) ?>" <?php echo $data_atts ?>>
		<?php
		
			while ($wp_query->have_posts()) : $wp_query->the_post();

				$permalink = get_permalink();

				$excerpt = get_the_excerpt();

				if(!empty($excerpt))
					$excerpt = '<div class="entry-content"><p>'.$excerpt.'</p></div>';

				$post_class = 'project';

				$post_class .= ' '.$folio_hover_style_class;
				
				if($sort_panel_enabled)
					include(locate_template('inc/vc_custom/dfd_vc_addons/templates/portfolio/template_parts/article_data_atts.php'));
				?>
				<div class="<?php echo esc_attr($post_class) ?>" <?php echo $article_data_atts; ?>>
					<div class="cover <?php echo esc_attr($content_alignment) ?>">
						<?php

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
						} ?>
						
						<div class="entry-thumb <?php echo esc_attr($media_class) ?>">
							<img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($caption); ?>"/>
							<?php include(locate_template('inc/vc_custom/dfd_vc_addons/templates/portfolio/template_parts/comments_likes.php')); ?>
							<?php include(locate_template('templates/portfolio/custom-hover.php')); ?>
						</div>

						<?php
						include(locate_template('inc/vc_custom/dfd_vc_addons/templates/portfolio/template_parts/heading.php'));
						
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
					</div>
				</div>
			<?php
			endwhile;
		wp_reset_postdata();
		?>
		</div>
	</div>
</div>
