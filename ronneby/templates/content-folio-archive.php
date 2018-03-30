<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (!have_posts()) :

    get_template_part('templates/post-nothins', 'found');

endif;

global $dfd_ronneby;

$data_atts = $sort_panel_html = $page_class = $folio_css = $share_style = $folio_hover_style_class = $cover_class = $animation_data = '';

$options = array(
	'archive_folio_layout_style' => 'standard',
	'archive_folio_items_offset' => 0,
	'archive_folio_title_color' => '',
	'archive_folio_title_deco_bg' => '',
	'archive_folio_title_deco_line_bg' => '',
	'archive_folio_title_deco_shadow' => '',
	'archive_folio_title_position' => false,
	'archive_folio_title_decoration' => false,
	'archive_folio_show_title' => false,
	'archive_folio_show_subtitle' => false,
	'archive_folio_show_meta' => false,
	'archive_folio_show_comments' => false,
	'archive_folio_show_likes' => false,
	'archive_folio_show_description' => false,
	'archive_folio_content_alignment' => false,
	'archive_folio_show_read_more_share' => false,
	'archive_folio_read_more_style' => false,
	'archive_folio_share_style' => false,
	'archive_folio_columns' => 1,
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

foreach($options as $option => $default) {
	if(isset($dfd_ronneby[$option]) && !empty($dfd_ronneby[$option])) {
		$options[$option] = $dfd_ronneby[$option];
	}
}

$cover_class .= $options['archive_folio_content_alignment'];

if(!empty($options['archive_folio_item_appear_effect'])) {
	$cover_class .= ' cr-animate-gen';
	$animation_data .= 'data-animate-type="'.esc_attr($options['archive_folio_item_appear_effect']).'"';
}

if($options['archive_folio_title_position'] && $options['archive_folio_title_position'] != 'under') {
	$page_class .= ' dfd-folio-title-'.$options['archive_folio_title_position'];
}

if($options['archive_folio_items_offset']) {
	$folio_items_offset = $options['archive_folio_items_offset'] / 2;
	$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio.dfd-portfolio-masonry, #layout.dfd-portfolio-loop .dfd-portfolio.dfd-portfolio-fitRows {margin: -'.esc_attr($folio_items_offset).'px;}';
	$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio.dfd-portfolio-masonry  .project .cover, #layout.dfd-portfolio-loop .dfd-portfolio.dfd-portfolio-fitRows .project .cover {padding: '.esc_attr($folio_items_offset).'px;}';
	if($options['archive_folio_title_position'] && $options['archive_folio_title_position'] == 'front') {
		$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio .project .cover .dfd-folio-heading-wrap {left: '.esc_attr($folio_items_offset).'px; right: '.esc_attr($folio_items_offset).'px;}';
	}
}

if($options['archive_folio_title_color'] && !empty($options['archive_folio_title_color'])) {
	$tags_color = $tags_delim_bg = '';
	if(function_exists('dfd_hex2rgb')) {
		$tags_color .= dfd_hex2rgb($options['archive_folio_title_color'], .5);
		$tags_delim_bg .= dfd_hex2rgb($options['archive_folio_title_color'], .2);
		$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio .project .cover .dfd-folio-heading-wrap div.subtitle,#layout.dfd-portfolio-loop .dfd-portfolio.dfd-folio-title-deco-background .project .cover .dfd-folio-heading-wrap div.subtitle {color: '.esc_attr($tags_color).';}';
	}
	$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio .project .cover .dfd-folio-heading-wrap div.dfd-portfolio-title, #layout.dfd-portfolio-loop .dfd-portfolio.dfd-folio-title-deco-background .project .cover .dfd-folio-heading-wrap div.dfd-portfolio-title {color: '.esc_attr($options['archive_folio_title_color']).';}';
}

if($options['folio_hover_plus_bg'] && !empty($options['folio_hover_plus_bg'])) {
	$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio .project .entry-thumb .portfolio-custom-hover .plus-link.dfd-bottom-right:before, #layout.dfd-portfolio-loop .dfd-portfolio .project .entry-thumb .portfolio-custom-hover .plus-link.dfd-top-right:before {border-right-color: '.esc_attr($options['folio_hover_plus_bg']).';}';
	$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio .project .entry-thumb .portfolio-custom-hover .plus-link.dfd-bottom-left:before, #layout.dfd-portfolio-loop .dfd-portfolio .project .entry-thumb .portfolio-custom-hover .plus-link.dfd-top-left:before {border-left-color: '.esc_attr($options['folio_hover_plus_bg']).';}';
}

if($options['archive_folio_title_decoration'] && $options['archive_folio_title_decoration'] != 'none') {
	$page_class .= ' dfd-folio-title-deco-'.$options['archive_folio_title_decoration'];
	if($options['archive_folio_title_decoration'] == 'background' && !empty($options['archive_folio_title_deco_bg'])) {
		$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio.dfd-folio-title-deco-background .project .cover .dfd-folio-heading-wrap {background: '.esc_attr($options['archive_folio_title_deco_bg']).';}';
	} elseif($options['archive_folio_title_decoration'] == 'line' && !empty($options['archive_folio_title_deco_line_bg'])) {
		$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio.dfd-folio-title-deco-line .dfd-folio-heading-wrap div.dfd-portfolio-title a:before, #layout.dfd-portfolio-loop .dfd-portfolio.dfd-folio-title-deco-line .dfd-folio-heading-wrap div.dfd-portfolio-title a:after {border-bottom-color: '.esc_attr($options['archive_folio_title_deco_line_bg']).';}';
	} elseif($options['archive_folio_title_decoration'] == 'shadow' && !empty($options['archive_folio_title_deco_shadow'])) {
		$shadow_style = '0px 2px 8px 3px';
		$folio_css .= '#layout.dfd-portfolio-loop .dfd-portfolio.dfd-folio-title-deco-shadow .project .cover .dfd-folio-heading-wrap {-webkit-box-shadow: '.esc_attr($shadow_style).' '.esc_attr($options['archive_folio_title_deco_shadow']).';-moz-box-shadow: '.esc_attr($shadow_style).' '.esc_attr($options['archive_folio_title_deco_shadow']).';-o-box-shadow: '.esc_attr($shadow_style).' '.esc_attr($options['archive_folio_title_deco_shadow']).';box-shadow: '.esc_attr($shadow_style).' '.esc_attr($options['archive_folio_title_deco_shadow']).';}';
	}
}

if($options['folio_hover_style_group'] == 'entry') {
	$folio_hover_style_class = $options['folio_hover_style'];
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

if($options['archive_folio_share_style']) $share_style = 'dfd-share-'.$options['archive_folio_share_style'];

if(strcmp($options['archive_folio_layout_style'], 'masonry') === 0 || strcmp($options['archive_folio_layout_style'], 'fitRows') === 0) {
	wp_enqueue_script('isotope');
	$page_class .= ' dfd-new-isotope';
	
	$data_atts .= ' data-columns="'.esc_attr($options['archive_folio_columns']).'"';
	$data_atts .= ' data-layout-style="'.esc_attr($options['archive_folio_layout_style']).'"';
	$data_atts .= ' data-item="project"';
}
if (!post_password_required(get_the_id())) :
?>
<div class="dfd-potfolio-wrap">
	
	<div class="dfd-portfolio dfd-portfolio-<?php echo esc_attr($options['archive_folio_layout_style']) ?> <?php echo esc_attr($page_class) ?>" <?php echo $data_atts ?>>
		
		<?php while (have_posts()) : the_post();

			if (has_post_thumbnail()) {
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL

				$img_src = $img_url;

				if(strcmp($options['archive_folio_layout_style'], 'fitRows') === 0) {
					$img_url = dfd_aq_resize($img_url, 900, 600, true, true, true);
				}

				if(!$img_url) {
					$img_url = $img_src;
				}
			?>
				<div class="project <?php echo esc_attr($folio_hover_style_class); ?>">
					<div class="cover <?php echo esc_attr($cover_class) ?>" <?php echo $animation_data; ?>>
						<div class="entry-thumb">
							<img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title(); ?>"/>
							<?php require(locate_template('templates/portfolio/'.$options['folio_hover_style_group'].'-hover.php')); ?>
							<?php if($options['archive_folio_show_comments'] == 'on') : ?>
								<div class="post-comments-wrap">
									<?php get_template_part('templates/entry-meta/mini', 'comments-number'); ?>
								</div>
							<?php endif; ?>
							<?php if($options['archive_folio_show_likes'] == 'on') : ?>
								<div class="post-like-wrap">
									<?php get_template_part('templates/entry-meta/mini', 'like'); ?>
								</div>
							<?php endif; ?>
						</div>
						<?php if($options['archive_folio_show_title'] == 'on' || $options['archive_folio_show_meta'] == 'on') : ?>
							<div class="dfd-folio-heading-wrap">

								<?php if($options['archive_folio_show_meta'] == 'on') : ?>
									<div class="dfd-folio-categories">
										<?php get_template_part('templates/folio', 'term'); ?>
									</div>
								<?php endif; ?>
								
								<?php if($options['archive_folio_show_title'] == 'on') : ?>
									<div class="dfd-blog-title dfd-portfolio-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
								<?php endif; ?>
								
								<?php if($options['archive_folio_show_subtitle'] == 'on') :
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
						<?php if($options['archive_folio_show_description'] == 'on') :
							$excerpt = '<p>'.get_the_excerpt().'</p>';
							?>
							<div class="entry-content">
								<?php echo $excerpt; ?>
							</div>
						<?php endif; ?>
						<?php if($options['archive_folio_show_read_more_share'] == 'on') : ?>
							<div class="dfd-read-share clearfix">
								<div class="read-more-wrap">
									<a href="<?php the_permalink(); ?>" class="more-button <?php echo esc_attr($options['archive_folio_read_more_style']) ?>" title="<?php __('Read more','dfd') ?>" data-lang="en"><?php _e('More', 'dfd'); ?></a>
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

</div>
<?php endif;