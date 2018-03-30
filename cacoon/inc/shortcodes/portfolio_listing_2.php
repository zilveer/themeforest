<?php

function met_su_PORTFOLIO_LISTING2_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_portfolio_listing2'] = array(
		'name' => __( 'Portfolio Listing 2', 'su' ),
		'type' => 'single',
		'group' => 'met',
		'atts' => array(
			'item_per_page' => array(
				'default' => 8,
				'name' => __( 'Item Limit (required)', 'su' ),
			),
			'layout_type' => array(
				'type' => 'select',
				'values' => array('1' => 'Layout 1', '2' => 'Layout 2'),
				'default' => '1',
				'name' => __( 'Layout Type', 'su' ),
			),
			'effect_type' => array(
				'type' => 'select',
				'values' => array('1'=>'Effect 1','2'=>'Effect 2','3'=>'Effect 3','4'=>'Effect 4','5'=>'Effect 5','r'=>'Random'),
				'default' => '1',
				'name' => __( 'Effect Type', 'su' ),
			),
			'show_pagination' => array(
				'type' => 'bool',
				'default' => 'yes',
				'name' => __( 'Show Pagination', 'su' ),
			),
			'show_categories' => array(
				'type' => 'bool',
				'default' => 'yes',
				'name' => __( 'Category Filter Bar', 'su' ),
			),
		),
		'desc' => '',
		'icon' => 'star',
		'function' => 'met_su_portfolio_listing2_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_PORTFOLIO_LISTING2_shortcode_data' );


function met_su_portfolio_listing2_shortcode( $atts, $content = null ) {
	extract($atts);

	wp_enqueue_script('metcreative-isotope');

	$gallery_id = uniqid('gal_');

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$the_query = new WP_Query( 'post_type=portfolio&posts_per_page='.$item_per_page.'&paged='.$paged );

	$portfolioFilters = '';

	if($show_categories):
		$portfolioFilters = '<div class="clearfix"><ul id="'.$gallery_id.'_filters" class="met_filters met_bgcolor2 pull-right">';

		$args = array( 'orderby' => 'name', 'order' => 'ASC', 'taxonomy' => 'portfolio_category' );
		$categories = get_categories($args);
		foreach($categories as $category) {
			$portfolioFilters .= '<li><a href="#" data-filter=".'.$category->slug.'">'.$category->name.'</a></li>';
		}

		$portfolioFilters .= '<li><a href="#" data-filter="*" class="met_color3">show all</a></li>
		</ul></div>';
	endif;


	if($layout_type == '1'):
		$output = '<div class="row-fluid">
			<div class="span12">';

				$output .= $portfolioFilters;

				$output .= '<div id="'.$gallery_id.'" class="met_portfolio_list_4_columns">';
					if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

						$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
						if ( $terms && ! is_wp_error( $terms ) ){
							$portfolioCats = array();
							$portfolioCatSlugs = array();

							foreach ( $terms as $term ) {
								$portfolioCats[] = $term->name;
								$portfolioCatSlugs[] = $term->slug;
							}

							$portfolioCatList = join(", ", $portfolioCats );
							$portfolioSlugList = join(" ", $portfolioCatSlugs );
						}

						$thumbnail_id = get_post_thumbnail_id();
						$image_url = wp_get_attachment_url( $thumbnail_id,'full');
						$image_url	= aq_resize($image_url,275,275,true);

						$ga = $vi = false;
						$content_media_option = rwmb_meta( 'met_content_media', array(), get_the_ID() );
						if($content_media_option == 'gallery'){
							$gallery_images = rwmb_meta( 'met_gallery_images', $args = array('type'=>'plupload_image','size'=>'thumbnail'), get_the_ID() );
							if(count($gallery_images) > 0){
								$ga = true;

								$gallery_first = array_shift(array_values($gallery_images));
								$gallery_keys = array_keys($gallery_images);

								wp_enqueue_style('metcreative-magnific-popup');
								wp_enqueue_script('metcreative-magnific-popup');
							}
						}

						if($content_media_option == 'video'){
							$vi = true;
							$video_url = rwmb_meta( 'met_video_link', array(), get_the_ID() );
							wp_enqueue_style('metcreative-magnific-popup');
							wp_enqueue_script('metcreative-magnific-popup');
						}

						if($effect_type == 'r'){
							$effect_type_result = mt_rand(1,5);
						}else{
							$effect_type_result = $effect_type;
						}

						$output .= '<div class="met_portfolio_item met_portfolio_effect_'.$effect_type_result.' '.$portfolioSlugList.'">

							<div class="met_portfolio_item_image_wrap">
								<a href="'.get_permalink().'" class="met_portfolio_item_image_container"><img src="'.$image_url.'" alt="'.esc_attr(get_the_title()).'"></a>

								<div class="met_portfolio_item_mask met_bgcolor">
									<span class="met_portfolio_item_mask_first_title met_color2">'.get_the_title().'</span>
									<span class="met_portfolio_item_mask_second_title met_color2">'.get_the_excerpt().'</span>

										<span class="met_portfolio_item_mask_link">
											<a href="'.get_permalink().'" class="icon-link icon-large met_tipsy_west" title="'.__('Details','metcreative').'"></a>';

											if( $ga ):
												$output .= '<a href="'.$gallery_first["full_url"].'" rel="prettyPhoto['.get_the_ID().']" class="icon-picture icon-large met_tipsy_west" title=""></a>';
											endif;

											if( $vi ):
												$output .= '<a href="'.$video_url.'" rel="videoPretty" class="icon-play-circle icon-large met_tipsy_west" title="'.__('Watch the Video','metcreative').'"></a>';
											endif;
							$output .= '</span>
								</div>
							</div>

							<a href="'.get_permalink().'" class="met_recent_work_double_title">
								<h3 class="met_color_transition">'.get_the_title().'</h3>
							</a>';

							if( $ga ):
								$output .= '<div class="met_portfolio_item_gallery">';
									unset($gallery_images[$gallery_keys[0]]); foreach($gallery_images as $gallery_image):
									$output .= '<a href="'.$gallery_image["full_url"].'" rel="prettyPhoto['.get_the_ID().']"></a>';
									endforeach;
							$output .= '</div>';
							endif;

							$output .= '</div>';

					endwhile; endif;
		$output .= '</div>
			</div>
		</div>';

	endif;

	if($layout_type == '2'):

		$output .= '<div class="row-fluid">
			<div class="span12">';

				$output .= $portfolioFilters;

				$output .= '
				<div class="met_mason_portfolio_wrap clearfix">
					<div class="met_mason_portfolio clearfix">';

						$item_count = 1; if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
							$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
							if ( $terms && ! is_wp_error( $terms ) ){
								$portfolioCats = array();
								$portfolioCatSlugs = array();

								foreach ( $terms as $term ) {
									$portfolioCats[] = $term->name;
									$portfolioCatSlugs[] = $term->slug;
								}

								$portfolioCatList = join(", ", $portfolioCats );
								$portfolioSlugList = join(" ", $portfolioCatSlugs );
							}

							$thumbnail_id = get_post_thumbnail_id();
							$image_url = wp_get_attachment_url( $thumbnail_id,'full');

							if( $item_count == 5 ){
								$image_url	= aq_resize($image_url,560,310,true);
							}elseif( $item_count == 6 ){
								$image_url	= aq_resize($image_url,260,310,true);
							}elseif( $item_count == 7 OR $item_count == 8 ){
								$image_url	= aq_resize($image_url,260,135,true);
							}else{
								$image_url	= aq_resize($image_url,260,260,true);
							}



							$ga = $vi = false;
							$content_media_option = rwmb_meta( 'met_content_media', array(), get_the_ID() );
							if($content_media_option == 'gallery'){
								$gallery_images = rwmb_meta( 'met_gallery_images', $args = array('type'=>'plupload_image','size'=>'thumbnail'), get_the_ID() );
								if(count($gallery_images) > 0){
									$ga = true;

									$gallery_first = array_shift(array_values($gallery_images));
									$gallery_keys = array_keys($gallery_images);

									wp_enqueue_style('metcreative-magnific-popup');
									wp_enqueue_script('metcreative-magnific-popup');
								}
							}

							if($content_media_option == 'video'){
								$vi = true;
								$video_url = rwmb_meta( 'met_video_link', array(), get_the_ID() );
								wp_enqueue_style('metcreative-magnific-popup');
								wp_enqueue_script('metcreative-magnific-popup');
							}

							$item_icon = '';
							$item_icon = rwmb_meta( 'met_portfolio_icon', array(), get_the_ID() );
							$portfolio_sub_title = rwmb_meta( 'met_portfolio_sub_title', array(), get_the_ID() );

							$item_count++;

							$output .= '
							<div class="met_mason_portfolio_item '.$portfolioSlugList.'">

								<a href="'.get_permalink().'" class="met_mason_portfolio_item_pic"><img src="'.$image_url.'" alt="'.esc_attr(get_the_title()).'" /></a>
								<div class="met_mason_portfolio_item_overlap">
									<a href="'.get_permalink().'"><h4>'.get_the_title().'</h4></a>

									<div class="met_mason_portfolio_miscs clearfix">';

										if( $ga ):
											$output .= '<a href="'.$gallery_first["full_url"].'" rel="lb['.get_the_ID().']"><i class="icon-search"></i></a>';
										endif;

										if( $vi ):
											$output .= '<a href="'.$video_url.'" rel="mpv['.get_the_ID().']"><i class="icon-facetime-video"></i></a>';
										endif;

										$output .= '<a href="'.get_permalink().'"><i class="icon-link"></i></a>
									</div>
								</div>';

								if( $ga ):
									$output .= '
									<div class="met_portfolio_item_gallery">';
										unset($gallery_images[$gallery_keys[0]]); foreach($gallery_images as $gallery_image):
											$output .= '<a href="'.$gallery_image["full_url"].'" rel="lb['.get_the_ID().']"></a>';
										endforeach;
									$output .='
									</div>';
								endif;
							$output .= '
							</div>';

						endwhile; endif;
					$output .= '
					</div>
				</div>
			</div>
		</div>
		';
	endif;

	if($show_pagination == 'yes' && $the_query->max_num_pages > 1):

		$output .= '
		<div class="pagination n_pagination">
			<ul>
				<li>'.next_posts_link(_("Older"),$the_query->max_num_pages).'</li>
				<li>'.previous_posts_link(_("Newest"),$the_query->max_num_pages).'</li>
			</ul>
		</div>';

	endif;


	wp_reset_postdata();
	wp_reset_query();

	return $output;
}