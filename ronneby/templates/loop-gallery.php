<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;

$data_atts = $dfd_gallery_css = $cover_class = $animation_data = $page_class = $thumb_width = $thumb_height = '';

$options = array(
	'dfd_gallery_layout_style' => 'standard',
	'dfd_gallery_items_offset' => 0,
	'dfd_gallery_show_comments' => false,
	'dfd_gallery_show_likes' => false,
	'dfd_gallery_show_title' => false,
	'dfd_gallery_show_subtitle' => false,
	'dfd_gallery_title_position' => false,
	'dfd_gallery_content_alignment' => 'text-center',
	'dfd_gallery_columns' => 1,
	'dfd_gallery_hover_link' => 'lightbox',
	'dfd_gallery_hover_appear_effect' => 'dfd-fade-out',
	'dfd_gallery_hover_image_effect' => '',
	'dfd_gallery_hover_main_dedcoration' => 'heading',
	'dfd_gallery_hover_title_dedcoration' => 'none',
	'dfd_gallery_hover_show_title' => 'on',
	'dfd_gallery_hover_show_subtitle' => 'on',
	'dfd_gallery_hover_plus_position' => '',
	'dfd_gallery_hover_plus_bg' => '',
	'dfd_gallery_item_appear_effect' => '',
	'dfd_gallery_comments_likes_style' => '',
);

$non3d_hovers = array(
	'dfd-fade-out',
	'dfd-fade-offset',
	'dfd-left-to-right',
	'dfd-right-to-left',
	'dfd-top-to-bottom',
	'dfd-bottom-to-top',
	'dfd-rotate-content-up'
);

foreach($options as $k => $v) {
	$options[$k] = DfdMetaBoxSettings::compared($k, $v);
}

$cover_class .= $options['dfd_gallery_content_alignment'];

if(!empty($options['dfd_gallery_item_appear_effect'])) {
	$cover_class .= ' cr-animate-gen';
	$animation_data .= 'data-animate-type="'.esc_attr($options['dfd_gallery_item_appear_effect']).'"';
}

$dfd_gallery_hover_style_class = $options['dfd_gallery_hover_appear_effect'];

if(in_array($options['dfd_gallery_hover_appear_effect'], $non3d_hovers)) {
	$dfd_gallery_hover_style_class .= ' '.$options['dfd_gallery_hover_image_effect'];
	if($options['dfd_gallery_hover_image_effect'] == 'panr') {
		wp_enqueue_script('dfd-tween-max');
		wp_enqueue_script('dfd-panr');
	}
}

if($options['dfd_gallery_hover_plus_bg'] && !empty($options['dfd_gallery_hover_plus_bg'])) {
	$dfd_gallery_css .= '#layout.dfd-gallery-loop .dfd-gallery .dfd-gallery-single-item .entry-thumb .portfolio-custom-hover .plus-link.dfd-bottom-right:before, #layout.dfd-gallery-loop .dfd-gallery .dfd-gallery-single-item .entry-thumb .portfolio-custom-hover .plus-link.dfd-top-right:before {border-right-color: '.esc_attr($options['dfd_gallery_hover_plus_bg']).';}';
	$dfd_gallery_css .= '#layout.dfd-gallery-loop .dfd-gallery .dfd-gallery-single-item .entry-thumb .portfolio-custom-hover .plus-link.dfd-bottom-left:before, #layout.dfd-gallery-loop .dfd-gallery .dfd-gallery-single-item .entry-thumb .portfolio-custom-hover .plus-link.dfd-top-left:before {border-left-color: '.esc_attr($options['dfd_gallery_hover_plus_bg']).';}';
}

if($options['dfd_gallery_items_offset']) {
	$dfd_gallery_items_offset = $options['dfd_gallery_items_offset'] / 2;
	$dfd_gallery_css .= '#layout.dfd-gallery-loop .dfd-gallery.dfd-gallery-standard, #layout.dfd-gallery-loop .dfd-gallery.dfd-gallery-masonry, #layout.dfd-gallery-loop .dfd-gallery.dfd-gallery-fitRows {margin: -'.esc_attr($dfd_gallery_items_offset).'px;}';
	$dfd_gallery_css .= '#layout.dfd-gallery-loop .dfd-gallery.dfd-gallery-standard .dfd-gallery-single-item .cover, #layout.dfd-gallery-loop .dfd-gallery.dfd-gallery-masonry .dfd-gallery-single-item .cover, #layout.dfd-gallery-loop .dfd-gallery.dfd-gallery-fitRows .dfd-gallery-single-item .cover {padding: '.esc_attr($dfd_gallery_items_offset).'px;}';
}

if(strcmp($options['dfd_gallery_layout_style'], 'masonry') === 0 || strcmp($options['dfd_gallery_layout_style'], 'fitRows') === 0) {
	wp_enqueue_script('isotope');
	//wp_enqueue_script('dfd-isotope-gallery');
	
	$data_atts .= ' data-columns="'.esc_attr($options['dfd_gallery_columns']).'"';
	$data_atts .= ' data-layout-style="'.esc_attr($options['dfd_gallery_layout_style']).'"';
	$data_atts .= ' data-item="dfd-gallery-single-item"';
	
	$page_class .= ' dfd-new-isotope';
}

$galler_number = get_post_meta($post->ID, 'dfd_gallery_works_per_page', true);
$number_per_page = ($galler_number) ? $galler_number : '16';

$galler_custom_categories = array();

$selected_custom_categories = wp_get_object_terms($post->ID, 'gallery_category');
if (!empty($selected_custom_categories) && !is_wp_error($selected_custom_categories)) {
	foreach ($selected_custom_categories as $term) {
		$galler_custom_categories[] = $term->term_id;
	}
}

//if ($galler_custom_categories) {
//	$galler_custom_categories = implode(",", $galler_custom_categories);
//}

if (is_front_page()) {
	$page = get_query_var('page');
	$paged = ($page) ? $page : 1;
} else {
	$page = get_query_var('paged');
	$paged = ($page) ? $page : 1;
}

if ($galler_custom_categories) {
	$args = array(
		'post_type' => 'gallery',
		'posts_per_page' => $number_per_page,
		'paged' => $paged,
		'tax_query' => array(
			array(
				'taxonomy' => 'gallery_category',
				'field' => 'id',
				'terms' => $galler_custom_categories,
			)
		)
	);
} else {
	$args = array(
		'post_type' => 'gallery',
		'posts_per_page' => $number_per_page,
		'paged' => $paged
	);
}

$folio_sidebars = DfdMetaBoxSettings::compared('dfd_gallery_single_columns', false);
$thumb_size = dfd_post_thumb_size($options['dfd_gallery_columns'], $folio_sidebars);
$width = $thumb_size['width'];
$height = $thumb_size['height'];

?>
<div class="dfd-gallery-wrap">
	<div id="dfd-gallery-loop" class="dfd-gallery dfd-gallery-<?php echo esc_attr($options['dfd_gallery_layout_style']) .' '.$page_class ?>" <?php echo $data_atts ?>>
		<?php
		$wp_query = new WP_Query($args);

		while ($wp_query->have_posts()) : $wp_query->the_post();

			$link_url = $title_html = '';
			
			$title = get_the_title();
			$subtitle = DfdMetaBoxSettings::get('stunnig_headers_subtitle');
		
			if (has_post_thumbnail()) {
				
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_image_src($thumb, 'full'); //get img URL
				
				$img_src = $img_url;

				if(strcmp($options['dfd_gallery_layout_style'], 'fitRows') === 0) {
					$img_url = dfd_aq_resize($img_url[0], $width, $height, true, true, true);
				} else {
					$ratio = $img_src[1] / $img_src[2];
					$height = $width / $ratio;
					$img_url = dfd_aq_resize($img_url[0], $width);
				}

				if(!$img_url) {
					$img_url = $img_src;
				}
				
				$dfd_loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $width $height'%2F%3E";

				include(locate_template('templates/gallery/hover-link.php'));
				
				if($options['dfd_gallery_show_title'] == 'on' || $options['dfd_gallery_show_subtitle'] == 'on') {
					$title_html .= '<div class="dfd-gallery-heading-wrap dfd-title-'.esc_attr($options['dfd_gallery_title_position']).'">';
					if($options['dfd_gallery_show_title'] == 'on') {
						$title_html .= '<div class="dfd-blog-title"><a href="'.esc_url($gallery_url).'" title="'.esc_attr($title).'">'.esc_html($title).'</a></div>';
					}
					if($options['dfd_gallery_show_subtitle'] == 'on'&& !empty($subtitle)) {
						$title_html .= '<div class="subtitle">'.esc_html($subtitle).'</div>';
					}
					$title_html .= '</div>';
				}
				
			?>
				<div class="dfd-gallery-single-item <?php echo esc_attr($dfd_gallery_hover_style_class) ?>">
					<div class="cover dfd-img-lazy-load <?php echo esc_attr($cover_class) ?>" <?php echo $animation_data ?>>
						<div class="dfd-gallery-inner-wrap">
							<?php
							if($options['dfd_gallery_title_position'] && strcmp($options['dfd_gallery_title_position'], 'top') === 0) {
								echo $title_html;
							}
							?>
							<div class="entry-thumb <?php echo esc_attr($options['dfd_gallery_comments_likes_style']) ?>">
								<img src="<?php echo $dfd_loading_img_src; ?>" alt="<?php echo esc_attr($title); ?>" data-src="<?php echo esc_url($img_url); ?>"/>
								<?php if($options['dfd_gallery_show_comments'] == 'on') : ?>
									<div class="post-comments-wrap">
										<?php get_template_part('templates/entry-meta/mini', 'comments-number'); ?>
									</div>
								<?php endif; ?>
								<?php if($options['dfd_gallery_show_likes'] == 'on') : ?>
									<div class="post-like-wrap">
										<?php get_template_part('templates/entry-meta/mini', 'like'); ?>
									</div>
								<?php endif; ?>
								<?php include(locate_template('templates/gallery/custom-hover.php')); ?>
							</div>
							<?php
							if(strcmp($options['dfd_gallery_title_position'], 'top') !== 0) {
								echo $title_html;
							}
							?>
						</div>
					</div>
				</div>
			<?php
			}

		endwhile;

		?>
		<?php if(!empty($dfd_gallery_css)) : ?>
			<script type="text/javascript">
				(function($) {
					$('head').append('<style type="text/css"><?php echo esc_js($dfd_gallery_css); ?></style>');
				})(jQuery);
			</script>
		<?php endif; ?>

	</div>

	<?php if ($wp_query->max_num_pages > 1) : ?>

		<nav class="page-nav">

			<?php echo dfd_kadabra_pagination(); ?>

		</nav>

	<?php endif; ?>

	<?php wp_reset_postdata(); ?>
	
</div>