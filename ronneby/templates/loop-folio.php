<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;

$data_atts = $sort_panel_html = $page_class = $folio_css = $share_style = $folio_hover_style_class = $cover_class = $animation_data = $thumb_width = $thumb_height = '';

$options = array(
	'folio_layout_style' => 'standard',
	'folio_items_offset' => 0,
	'folio_title_color' => '',
	'folio_title_deco_bg' => '',
	'folio_title_deco_line_bg' => '',
	'folio_title_deco_shadow' => '',
	'folio_title_position' => false,
	'folio_title_decoration' => false,
	'folio_show_title' => false,
	'folio_show_subtitle' => false,
	'folio_show_meta' => false,
	'folio_show_comments' => false,
	'folio_show_likes' => false,
	'folio_show_description' => false,
	'folio_content_alignment' => false,
	'folio_sort_panel' => false,
	'folio_sort_panel_align' => false,
	'folio_show_read_more_share' => false,
	'folio_read_more_style' => false,
	'folio_share_style' => false,
	'folio_columns' => 1,
	'folio_hover_style_group' => 'custom',
	'folio_hover_appear_effect' => 'dfd-fade-out',
	'folio_hover_image_effect' => '',
	'folio_hover_main_dedcoration' => 'heading',
	'folio_hover_title_dedcoration' => 'none',
	'folio_hover_show_title' => 'on',
	'folio_hover_show_subtitle' => 'on',
	'folio_hover_show_ext_link' => 'on',
	'folio_hover_show_quick_view' => 'on',
	'folio_hover_show_lightbox' => 'on',
	'folio_hover_plus_position' => '',
	'folio_hover_plus_bg' => '',
	'folio_item_appear_effect' => '',
	'folio_comments_likes_style' => '',
	'folio_hover_style' => 'portfolio-hover-style-1',
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

$cover_class .= $options['folio_content_alignment'];

if(!empty($options['folio_item_appear_effect'])) {
	$cover_class .= ' cr-animate-gen';
	$animation_data .= 'data-animate-type="'.esc_attr($options['folio_item_appear_effect']).'"';
}

if($options['folio_title_position'] && $options['folio_title_position'] != 'under') {
	$page_class .= ' dfd-folio-title-'.$options['folio_title_position'];
}

if($options['folio_items_offset']) {
	$folio_items_offset = $options['folio_items_offset'] / 2;
	$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio.dfd-portfolio-masonry, #layout.dfd-portfolio-loop .dfd-portfolio.dfd-portfolio-fitRows {margin: -'.esc_attr($folio_items_offset).'px;}';
	$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio.dfd-portfolio-masonry  .project .cover, #layout.dfd-portfolio-loop .dfd-portfolio.dfd-portfolio-fitRows .project .cover {padding: '.esc_attr($folio_items_offset).'px;}';
	if($options['folio_title_position'] && $options['folio_title_position'] == 'front') {
		$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio .project .cover .dfd-folio-heading-wrap {left: '.esc_attr($folio_items_offset).'px; right: '.esc_attr($folio_items_offset).'px;}';
	}
}

if($options['folio_title_color'] && !empty($options['folio_title_color'])) {
	$tags_color = $tags_delim_bg = '';
	if(function_exists('dfd_hex2rgb')) {
		$tags_color .= dfd_hex2rgb($options['folio_title_color'], .5);
		$tags_delim_bg .= dfd_hex2rgb($options['folio_title_color'], .2);
		$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio .project .cover .dfd-folio-heading-wrap div.subtitle,#layout.dfd-portfolio-loop .dfd-portfolio.dfd-folio-title-deco-background .project .cover .dfd-folio-heading-wrap div.subtitle {color: '.esc_attr($tags_color).';}';
	}
	$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio .project .cover .dfd-folio-heading-wrap div.dfd-portfolio-title, #layout.dfd-portfolio-loop .dfd-portfolio.dfd-folio-title-deco-background .project .cover .dfd-folio-heading-wrap div.dfd-portfolio-title {color: '.esc_attr($options['folio_title_color']).';}';
}

if($options['folio_hover_plus_bg'] && !empty($options['folio_hover_plus_bg'])) {
	$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio .project .entry-thumb .portfolio-custom-hover .plus-link.dfd-bottom-right:before, #layout.dfd-portfolio-loop .dfd-portfolio .project .entry-thumb .portfolio-custom-hover .plus-link.dfd-top-right:before {border-right-color: '.esc_attr($options['folio_hover_plus_bg']).';}';
	$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio .project .entry-thumb .portfolio-custom-hover .plus-link.dfd-bottom-left:before, #layout.dfd-portfolio-loop .dfd-portfolio .project .entry-thumb .portfolio-custom-hover .plus-link.dfd-top-left:before {border-left-color: '.esc_attr($options['folio_hover_plus_bg']).';}';
}

if($options['folio_title_decoration'] && $options['folio_title_decoration'] != 'none') {
	$page_class .= ' dfd-folio-title-deco-'.$options['folio_title_decoration'];
	if($options['folio_title_decoration'] == 'background' && !empty($options['folio_title_deco_bg'])) {
		$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio.dfd-folio-title-deco-background .project .cover .dfd-folio-heading-wrap {background: '.esc_attr($options['folio_title_deco_bg']).';}';
	} elseif($options['folio_title_decoration'] == 'line' && !empty($options['folio_title_deco_line_bg'])) {
		$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio.dfd-folio-title-deco-line .dfd-folio-heading-wrap div.dfd-portfolio-title a:before, #layout.dfd-portfolio-loop .dfd-portfolio.dfd-folio-title-deco-line .dfd-folio-heading-wrap div.dfd-portfolio-title a:after {border-bottom-color: '.esc_attr($options['folio_title_deco_line_bg']).';}';
	} elseif($options['folio_title_decoration'] == 'shadow' && !empty($options['folio_title_deco_shadow'])) {
		$shadow_style = '0px 2px 8px 3px';
		$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio.dfd-folio-title-deco-shadow .project .cover .dfd-folio-heading-wrap {-webkit-box-shadow: '.esc_attr($shadow_style).' '.esc_attr($options['folio_title_deco_shadow']).';-moz-box-shadow: '.esc_attr($shadow_style).' '.esc_attr($options['folio_title_deco_shadow']).';-o-box-shadow: '.esc_attr($shadow_style).' '.esc_attr($options['folio_title_deco_shadow']).';box-shadow: '.esc_attr($shadow_style).' '.esc_attr($options['folio_title_deco_shadow']).';}';
	}
}

$folio_hover_style = DfdMetaBoxSettings::get('folio_hover');

if($options['folio_hover_style_group'] == 'entry') {
	if($folio_hover_style) {
		$folio_hover_style_class = $folio_hover_style;
	} else {
		$folio_hover_style_class = 'portfolio-hover-style-1';
	}
} else {
	$folio_hover_style_class = $options['folio_hover_appear_effect'];
}

if($options['folio_hover_image_effect'] == 'panr') {
	wp_enqueue_script('dfd-tween-max');
	wp_enqueue_script('dfd-panr');
}

if(in_array($options['folio_hover_appear_effect'], $non3d_hovers)) {
	$folio_hover_style_class .= ' '.$options['folio_hover_image_effect'];
}

if($options['folio_share_style']) $share_style = 'dfd-share-'.$options['folio_share_style'];

$folio_number = get_post_meta($post->ID, 'folio_works_per_page', true);
$number_per_page = ($folio_number) ? $folio_number : '16';

$folio_custom_categories = array();

$selected_custom_categories = wp_get_object_terms($post->ID, 'my-product_category');
if (!empty($selected_custom_categories) && !is_wp_error($selected_custom_categories)) {
	foreach ($selected_custom_categories as $term) {
		$folio_custom_categories[] = $term->term_id;
	}
}

//if ($folio_custom_categories) {
//	$folio_custom_categories = implode(",", $folio_custom_categories);
//}

if (is_front_page()) {
	$page = get_query_var('page');
	$paged = ($page) ? $page : 1;
} else {
	$page = get_query_var('paged');
	$paged = ($page) ? $page : 1;
}

if ($folio_custom_categories) {
	$args = array(
		'post_type' => 'my-product',
		'posts_per_page' => $number_per_page,
		'paged' => $paged,
		'tax_query' => array(
			array(
				'taxonomy' => 'my-product_category',
				'field' => 'id',
				'terms' => $folio_custom_categories,
			)
		)
	);
} else {
	$args = array(
		'post_type' => 'my-product',
		'posts_per_page' => $number_per_page,
		'paged' => $paged
	);
}
if(strcmp($options['folio_layout_style'], 'masonry') === 0 || strcmp($options['folio_layout_style'], 'fitRows') === 0) {
	wp_enqueue_script('isotope');
	//wp_enqueue_script('dfd-isotope-portfolio');
	
	$data_atts .= ' data-columns="'.esc_attr($options['folio_columns']).'"';
	$data_atts .= ' data-layout-style="'.esc_attr($options['folio_layout_style']).'"';
	$data_atts .= ' data-item="project"';
	
	$page_class .= ' dfd-new-isotope';
	
	if(strcmp($options['folio_sort_panel'],'on') === 0) {
		$taxonomy = 'my-product_category';
		if ($folio_custom_categories) {
			$categories = get_terms($taxonomy, array('include' => $folio_custom_categories));
		} else {
			$categories = get_terms($taxonomy);
		}
		$sort_panel_html .= '<div class="clearfix">';
			$sort_panel_html .= '<div class="sort-panel '.esc_attr($options['folio_sort_panel_align']).'">';
				$sort_panel_html .= '<ul class="filter">';
					$sort_panel_html .= '<li class="active"><a data-filter=".project" href="#">'. __('All', 'dfd') .'</a></li>';
					foreach ($categories as $category) {
						$sort_panel_html .= '<li><a data-filter=".project[data-category~=\'' . strtolower(preg_replace('/\s+/', '-', $category->slug)) . '\']" href="#">' . $category->name . '</a></li>';
					}
				$sort_panel_html .= '</ul>';
			$sort_panel_html .= '</div>';
		$sort_panel_html .= '</div>';
	}
}

$folio_sidebars = DfdMetaBoxSettings::compared('folio_sidebars', false);
$thumb_size = dfd_post_thumb_size($options['folio_columns'], $folio_sidebars);
$width = $thumb_size['width'];
$height = $thumb_size['height'];

if (!post_password_required(get_the_id())) :
?>
<div class="dfd-portfolio-wrap">
	<?php
	echo $sort_panel_html;
	?>
	<div id="dfd-portfolio-loop" class="dfd-portfolio dfd-portfolio-<?php echo esc_attr($options['folio_layout_style']) ?> <?php echo esc_attr($page_class) ?>" <?php echo $data_atts ?>>
		<?php
		$wp_query = new WP_Query($args);

		while ($wp_query->have_posts()) : $wp_query->the_post();

			if (has_post_thumbnail()) {
				
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_image_src($thumb, 'full'); //get img URL
				
				$img_src = $img_url;

				if(strcmp($options['folio_layout_style'], 'fitRows') === 0) {
					$img_url = dfd_aq_resize($img_url[0], $width, $height, true, true, true);
				} else {
					$ratio = $img_src[1] / $img_src[2];
					$height = $width / $ratio;
					$img_url = dfd_aq_resize($img_url[0], $width);
				}

				if(!$img_url) {
					$img_url = $img_src[0];
				}
				
				$dfd_loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $width $height'%2F%3E";
				
				$terms = get_the_terms(get_the_ID(), 'my-product_category');
				$article_tags_classes = '';

				$article_tags_classes .= 'data-category="';
				if(is_array($terms)) {
					foreach ($terms as $term) {
						$article_tags_classes .= ' ' . strtolower(preg_replace('/\s+/', '-', $term->slug)) . ' ';
					}
				}
				$article_tags_classes .= '"';
				
			?>
				<div class="project <?php echo esc_attr($folio_hover_style_class); ?>" <?php echo $article_tags_classes ?>>
					<div class="cover dfd-img-lazy-load <?php echo esc_attr($cover_class) ?>" <?php echo $animation_data; ?>>
						<div class="entry-thumb <?php echo esc_attr($options['folio_comments_likes_style']) ?>">
							<img src="<?php echo $dfd_loading_img_src; ?>" alt="<?php the_title(); ?>" data-src="<?php echo esc_url($img_url); ?>"/>
							<?php require(locate_template('templates/portfolio/'.$options['folio_hover_style_group'].'-hover.php')); ?>
							<?php if($options['folio_show_comments'] == 'on') : ?>
								<div class="post-comments-wrap">
									<?php get_template_part('templates/entry-meta/mini', 'comments-number'); ?>
								</div>
							<?php endif; ?>
							<?php if($options['folio_show_likes'] == 'on') : ?>
								<div class="post-like-wrap">
									<?php get_template_part('templates/entry-meta/mini', 'like'); ?>
								</div>
							<?php endif; ?>
						</div>
						<?php if($options['folio_show_title'] == 'on' || $options['folio_show_meta'] == 'on') : ?>
							<div class="dfd-folio-heading-wrap">

								<?php if($options['folio_show_meta'] == 'on') : ?>
									<div class="dfd-folio-categories">
										<?php get_template_part('templates/folio', 'term'); ?>
									</div>
								<?php endif; ?>
								
								<?php if($options['folio_show_title'] == 'on') : ?>
									<div class="dfd-blog-title dfd-portfolio-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
								<?php endif; ?>
								
								<?php if($options['folio_show_subtitle'] == 'on') :
									$subtitle_text = get_post_meta(get_the_id(), 'stunnig_headers_subtitle', true);
									if($subtitle_text && !empty($subtitle_text)) {
									?>
										<div class="subtitle"><?php echo $subtitle_text; ?></div>
									<?php	
									}
								?>
								<?php endif; ?>

							</div>
						<?php endif; ?>
						<?php if($options['folio_show_description'] == 'on') :
							$excerpt = get_the_excerpt();
							if(!empty($excerpt)){?>
								<div class="entry-content">
									<p><?php echo $excerpt ?></p>
								</div>
							<?php
							}
						endif; ?>
						<?php if($options['folio_show_read_more_share'] == 'on') : ?>
							<div class="dfd-read-share clearfix">
								<div class="read-more-wrap">
									<a href="<?php the_permalink(); ?>" class="more-button <?php echo esc_attr($options['folio_read_more_style']) ?>" title="<?php __('Read more','dfd') ?>" data-lang="en"><?php _e('More', 'dfd'); ?></a>
								</div>
								<div class="dfd-share-cover <?php echo esc_attr($share_style);  ?>">
									<?php get_template_part('templates/entry-meta/mini','share-blog') ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php
			}

		endwhile;
		?>
	</div>
		
	<?php if ($wp_query->max_num_pages > 1) : ?>

		<nav class="page-nav">

			<?php echo dfd_kadabra_pagination(); ?>

		</nav>

	<?php endif; ?>
	
	<?php if(!empty($folio_css)) : ?>
		<script type="text/javascript">
			(function($) {
				$('head').append('<style type="text/css"><?php echo esc_js($folio_css); ?></style>');
			})(jQuery);
		</script>
	<?php endif; ?>

	<?php wp_reset_postdata(); ?>
	<?php wp_reset_query(); ?>

</div>
<?php endif;