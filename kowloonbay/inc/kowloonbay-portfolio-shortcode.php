<?php

/* KowloonBay Portfolio: shortcodes */
add_shortcode('portfolio', 'kowloonbay_portfolio_shortcode');

function kowloonbay_portfolio_shortcode($attr)
{
	$portfolio_no = isset($attr['no']) ? $attr['no'] : '';
	if ($portfolio_no === '') $portfolio_no = 1;
	$portfolio_no = (int)$portfolio_no;

	// get values from theme options
	global $kowloonbay_redux_opts;
	$portfolio_layout = $kowloonbay_redux_opts['portfolio_layout'];
	$portfolio_masonry_base_col_grid = $kowloonbay_redux_opts['portfolio_masonry_base_col_grid'];
	$portfolio_cat_all_icon = $kowloonbay_redux_opts['portfolio_cat_all_icon'];
	$portfolio_cat_all_label = $kowloonbay_redux_opts['portfolio_cat_all_label'];
	$portfolio_boxed = $kowloonbay_redux_opts['portfolio_boxed'];
	$portfolio_hide_cat_icon = $kowloonbay_redux_opts['portfolio_hide_cat_icon'];
	$portfolio_ordering = $kowloonbay_redux_opts['portfolio_ordering'];

	// portfolio query vars
	$masonry = 0;
	$portfolio_masonry = get_query_var('portfolio_masonry');
	if ($portfolio_masonry === '' && $portfolio_layout === 'm') $masonry = 1;
	if ($portfolio_masonry !== '' && $portfolio_masonry !== '0') $masonry = 1;

	$col = (int)get_query_var('portfolio_col');
	if ($col<1 || $col>4){
		$col = 1;
		if ($portfolio_layout === '2') $col = 2;
		if ($portfolio_layout === '3') $col = 3;
		if ($portfolio_layout === '4') $col = 4;
		if ($masonry) $col = (int)$portfolio_masonry_base_col_grid;
	}

	$boxed = (int)get_query_var('portfolio_boxed');
	if ($boxed === 0 && $portfolio_boxed === '1') $boxed = 1;

	$colClass = '';
	switch ($col) {
		case 2:
			$colClass = 'two-cols';
			break;
		case 3:
			$colClass = 'three-cols';
			break;
		case 4:
			$colClass = 'four-cols';
			break;
		default:
			$colClass = '';
			break;
	}

	// get all portfolio categories
	$parent_cat = get_terms('kowloonbay_portfolio_cat', array('hide_empty' => 0, 'slug' => 'portfolio-'.$portfolio_no));
	$parent_cat = reset($parent_cat);
	// var_dump($parent_cat);
	$cats = get_terms('kowloonbay_portfolio_cat', array('hide_empty' => 0, 'orderby' => 'slug', 'parent' => $parent_cat->term_id));
	// var_dump($cats);
	foreach ($cats as $i => $c) {
		if ($c->slug === 'hidden-from-navigation') unset($cats[$i]);
	}
	$html = '<div class="portfolio-cats text-center small-text title-style clearfix wow-array">';

	$catStyle = 'style="width:'. floor(10000 / (sizeof($cats) + 1)) / 100 .'%"';

	// prepend category "all"
	$html .= '<div '. $catStyle .' ><a href="#" data-filter="*" class="current fa-custom-hover-effect">';

	if ($portfolio_hide_cat_icon === '0'){
		$html .= '<i class="fa '. esc_attr($portfolio_cat_all_icon) .' fa-custom-lg fa-custom-block"></i>';
		if (filter_var($portfolio_cat_all_icon, FILTER_VALIDATE_URL)){
			$html .= '<img src="'. esc_url($portfolio_cat_all_icon) .'" alt="">';
		}
	}
	$html .= esc_html($portfolio_cat_all_label).'</a></div>';

	foreach ($cats as $i => $c) {
		$html .= '<div '. $catStyle .' >';
		$html .= '<a href="#" data-filter=".cat-' . esc_attr($c->slug) . '" class="fa-custom-hover-effect">';

		if ($portfolio_hide_cat_icon === '0'){
			$html .= '<i class="fa '. esc_attr($c->description) .' fa-custom-lg fa-custom-block"></i>';
			if (filter_var($c->description, FILTER_VALIDATE_URL)){
				$html .= '<img src="'. esc_url($c->description) .'" alt="">';
			}
		}

		$html .= esc_html($c->name);
		$html .= '</a>';
		$html .= '</div>';
	}

	$html .= '</div>';

	// retrieve items from archive page
	$html .= '<ul class="portfolio-list jscroll-to-add '
			. esc_attr( $boxed === 1 ? '' : 'no-page-padding' )
			. ' ' . esc_attr($colClass) .'">';

	$posts_per_page = kowloonbay_portfolio_posts_per_page();
	$portfolio_paged = max(1, get_query_var('portfolio_paged'));
	$kowloonbay_portfolio_item_query = array(
		'posts_per_page'	=> $posts_per_page,
		'post_type'			=> 'kowloonbay_portfolio',
		'order'				=> $portfolio_ordering,
		'orderby'			=> 'menu_order date',
		'paged'				=> $portfolio_paged,
	);
	if ($portfolio_no > 0){
		$kowloonbay_portfolio_item_query['meta_key'] = 'kowloonbay_portfolio_assignment';
		$kowloonbay_portfolio_item_query['meta_value'] = $portfolio_no;
	}
	
	$kowloonbay_portfolio_items = new WP_Query( $kowloonbay_portfolio_item_query );

	if ($kowloonbay_portfolio_items->have_posts()):
		while($kowloonbay_portfolio_items->have_posts()):
			$kowloonbay_portfolio_items->the_post();
			$post_id = get_the_id();
			$kowloonbay_portfolio_cover_img = rwmb_meta( 'kowloonbay_portfolio_cover_img',array('type'=>'image_advanced') );
			$kowloonbay_portfolio_cover_img = reset($kowloonbay_portfolio_cover_img);
			$kowloonbay_portfolio_cat = get_the_terms( $post_id, 'kowloonbay_portfolio_cat' );
			if ($kowloonbay_portfolio_cat === false) $kowloonbay_portfolio_cat = array();

			$permalink = get_permalink($post_id);
			$kowloonbay_portfolio_masonry_width = rwmb_meta( 'kowloonbay_portfolio_masonry_width');
			$kowloonbay_portfolio_masonry_height = rwmb_meta( 'kowloonbay_portfolio_masonry_height');

			$masonry_width_class = '';
			$masonry_height_class = 'height-1x';
			if ($masonry !== 0){
				switch ($kowloonbay_portfolio_masonry_width) {
					case '2x':
						if ($col === 2){
							$masonry_width_class = 'full-width';
						} elseif ($col === 3){
							$masonry_width_class = 'width-two-thirds';
						} elseif ($col === 4){
							$masonry_width_class = 'width-two-fourths';
						}
						break;
					case '3x':
						if ($col === 2){
							// exceeds full width; do nothing
						} elseif ($col === 3){
							$masonry_width_class = 'full-width';
						} elseif ($col === 4){
							$masonry_width_class = 'width-three-fourths';
						}
						break;
					case '4x':
						if ($col === 2){
							// exceeds full width; do nothing
						} elseif ($col === 3){
							// exceeds full width; do nothing
						} elseif ($col === 4){
							$masonry_width_class = 'full-width';
						}
						break;
				}
				switch ($kowloonbay_portfolio_masonry_height) {
					case '1.5x':
						$masonry_height_class = 'height-1-plus-half-x';
						break;
					case '2x':
						$masonry_height_class = 'height-2x';
						break;
					case '3x':
						$masonry_height_class = 'height-3x';
						break;
				}
			}

			$kowloonbay_portfolio_layout = rwmb_meta( 'kowloonbay_portfolio_layout');
			$kowloonbay_portfolio_slider_pos = rwmb_meta( 'kowloonbay_portfolio_slider_pos');
			$mfpAtts = '';
			if ($kowloonbay_portfolio_slider_pos === 'lightbox'){
				if ($kowloonbay_portfolio_layout === 'image_slider'){
					$slider_images = rwmb_meta( 'kowloonbay_portfolio_slider_images', array('type'=>'image_advanced') );
					foreach ($slider_images as $img){
						$mfpAtts .= esc_url($img['full_url']).',';
					}
				} else if ($kowloonbay_portfolio_layout === 'video_slider'){
					$slider_videos = rwmb_meta( 'kowloonbay_portfolio_slider_videos', array('type'=>'text') );
					foreach ($slider_videos as $video){
						$mfpAtts .= esc_url($video).',';
					}
				}
			}
			
			$html .= '<li class="hover-effect-move-right'. esc_attr(kowloonbay_portfolio_cat_attr($kowloonbay_portfolio_cat)) .' '. esc_attr($masonry_height_class) .' '. esc_attr($masonry_width_class) .'">';
				$html .= '<div class="img-bg-cover">';
					$html .= '<img src="' . esc_url($kowloonbay_portfolio_cover_img['full_url']) . '" alt="">';
				$html .= '</div>';
				$html .= '<div class="caption">';
					$html .= '<div class="v-centered-container">';
						$html .= '<div class="v-centered">	';
							$html .= '<h2>'. esc_html(get_the_title()) . '</h2>';
							$html .= '<p>' . esc_html(kowloonbay_portfolio_cat_names($kowloonbay_portfolio_cat)) . '</p>';
						$html .= '</div>';
					$html .= '</div>';
					$html .= '<a href="' . esc_url($permalink) . '" ';

					if ($kowloonbay_portfolio_slider_pos === 'lightbox'){
						if ($kowloonbay_portfolio_layout === 'image_slider'){
							$html .= 'class="mfpGalleryImgs" data-mfp-imgs="'. esc_attr($mfpAtts) .'"';
						} else if ($kowloonbay_portfolio_layout === 'video_slider'){
							$html .= 'class="mfpGalleryVideos" data-mfp-videos="'. esc_attr($mfpAtts) .'"';
						}
					}

					$html .= '>View More</a>';

				$html .= '</div>';
			$html .= '</li>';

		endwhile;
	endif;




	$html .= '</ul>';
	$html .= '<div class="infinite-scroll">';
	if ($kowloonbay_portfolio_items->max_num_pages > 1){
		// for infinite scroll
		$nextArchivePageLink = add_query_arg('portfolio_paged', $portfolio_paged + 1);
		$html .= '<a class="jscroll-next jscroll-to-add" href="'. esc_url($nextArchivePageLink) .'">Load More</a>';
	}
	$html .= '</div>';

	wp_reset_postdata();

	return $html;
}