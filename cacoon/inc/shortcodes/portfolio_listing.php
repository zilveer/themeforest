<?php

function met_su_PORTFOLIO_LISTING_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_portfolio_listing'] = array(
		'name' => __( 'Portfolio Listing', 'su' ),
		'type' => 'single',
		'group' => 'met',
		'atts' => array(
			'item_per_page' => array(
				'default' => 8,
				'name' => __( 'Item Limit (required)', 'su' ),
			),
			'layout_type' => array(
				'type' => 'select',
				'values' => array('span6' => '2 Column', 'span4' => '3 Column'),
				'default' => 'span4',
				'name' => __( 'Layout Type', 'su' ),
			),
			'show_pagination' => array(
				'type' => 'bool',
				'default' => 'yes',
				'name' => __( 'Show Pagination', 'su' ),
			),
			'categories' => array(
				'default' => '',
				'name' => __( 'Category IDs (Ex: 1,2,3)', 'su' ),
			),
			'ex_categories' => array(
				'default' => '',
				'name' => __( 'Exclude Category IDs (Ex: 1,2,3)', 'su' ),
			),
		),
		'desc' => '',
		'icon' => 'star',
		'function' => 'met_su_portfolio_listing_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_PORTFOLIO_LISTING_shortcode_data' );


function met_su_portfolio_listing_shortcode( $atts, $content = null ) {
	extract($atts);

	$widgetID = uniqid('met_portfolio_list_');

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$query_filter = array();
	$query_filter['post_type'] 			= 'portfolio';
	$query_filter['posts_per_page'] 	= $item_per_page;
	$query_filter['paged'] 				= $paged;

	if(!empty($categories)){
		$query_filter['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'id',
				'terms' => array($categories)
			)
		);

		//$query_filter['category__and'] = array($categories);
	}

	if(!empty($ex_categories)){
		$category_IDs = explode(',',$ex_categories);
		$ex_category_list = '';
		foreach($category_IDs as $category_ID){
			$ex_category_list .= $category_ID.',';
		}
		$ex_category_list = substr($ex_category_list,0,-1);

		$query_filter['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'id',
				'terms' => array($ex_category_list),
				'operator' => 'NOT IN'
			)
		);

		//$query_filter['cat'] = $ex_category_list;
	}


	$the_query = new WP_Query( $query_filter );

	$output = '<div class="row-fluid met_portfolio_row">';

		if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

		$thumbnail_id 		= get_post_thumbnail_id();
		$image_url 			= wp_get_attachment_url( $thumbnail_id,'full');

		if($layout_type == 'span4'){
			$thumbnail_url		= aq_resize($image_url,570,300,true);
		}elseif($layout_type == 'span6'){
			$thumbnail_url		= aq_resize($image_url,370,195,true);
		}

			if( !$thumbnail_url ) $thumbnail_url = $image_url;


		$ga = $vi = $fi = false;
		$content_media_option = rwmb_meta( 'met_content_media', array(), get_the_ID() );

		if($content_media_option == 'gallery'){
			$gallery_images = rwmb_meta( 'met_gallery_images', $args = array('type'=>'plupload_image','size'=>'thumbnail'), get_the_ID() );
			if(count($gallery_images) > 0){
				$ga = true;

				$gallery_first = array_shift(array_values($gallery_images));
				$gallery_keys = array_keys($gallery_images);

				wp_enqueue_style('metcreative-caroufredsel');
				wp_enqueue_script('metcreative-caroufredsel');

				wp_enqueue_style('metcreative-magnific-popup');
				wp_enqueue_script('metcreative-magnific-popup');

				$slider_option['auto_play'] = rwmb_meta( 'met_slider_auto_play', array(), get_the_ID() );
				$slider_option['duration'] = rwmb_meta( 'met_slider_auto_play_duration', array(), get_the_ID() );
				$slider_option['circular'] = rwmb_meta( 'met_slider_circular', array(), get_the_ID() );
				$slider_option['infinite'] = rwmb_meta( 'met_slider_infinite', array(), get_the_ID() );
			}
		}

		if($content_media_option == 'video'){
			$vi = true;
			$video_url = rwmb_meta( 'met_video_link', array(), get_the_ID() );
		}

		if( !$vi AND !$ga AND !empty($image_url) ){
			$fi = true;

			wp_enqueue_style('metcreative-magnific-popup');
			wp_enqueue_script('metcreative-magnific-popup');
		}

		if(!$fi){
			$thumbnail_url 	= 'http://placehold.it/570x300';
			$image_url 		= 'http://placehold.it/800x600';
		}

		$output .= '<div class="'.$layout_type.' clearfix">

			'.( ($fi) ? '
				<div class="met_portfolio_item_preview_wrap clearfix">
					<a href="'.get_permalink().'" class="met_portfolio_item_preview"><img src="'.$thumbnail_url.'" alt=""/></a>
					<div class="met_portfolio_item_overlay met_bgcolor6_trans">
						<a href="'.$image_url.'" rel="lb_'.get_the_ID().'" class="met_bgcolor met_color2 met_bgcolor_transition2"><i class="icon-camera"></i></a>
						<a href="'.get_permalink().'" class="met_bgcolor met_color2 met_bgcolor_transition2"><i class="icon-link"></i></a>
					</div>
				</div> ' : ''
			).'

			'.( ($vi) ? '
				<iframe class="met_portfolio_item_preview" src="'.video_url_to_embed($video_url).'" width="570" height="300" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			' : '' );

			if($ga):

			$output .= '
				<div class="met_portfolio_item_preview">
					<div class="met_portfolio_item_slider_wrap clearfix">
						<div id="met_portfolio_item_slider_'.get_the_ID().'" class="met_portfolio_item_slider">';

							foreach($gallery_images as $gallery_image):
								$output .= '<a href="'.$gallery_image["full_url"].'" rel="lb_'.get_the_ID().'"><img src="'.aq_resize($gallery_image["full_url"],570,300,true).'" alt="'.esc_attr(get_the_title()).'"/></a>';
							endforeach;

						$output .= '
						</div>
						<a href="#" class="met_portfolio_item_slider_nav_prev"><i class="icon-chevron-left"></i></a>
						<a href="#" class="met_portfolio_item_slider_nav_next"><i class="icon-chevron-right"></i></a>
					</div>
				</div>
				<script>
					jQuery(window).load(function(){
						jQuery("#met_portfolio_item_slider_'.get_the_ID().'").carouFredSel({
							responsive: true,
							prev: { button : function(){ return jQuery(this).parents(".met_portfolio_item_slider_wrap").find(".met_portfolio_item_slider_nav_prev") } },
							next:{ button : function(){ return jQuery(this).parents(".met_portfolio_item_slider_wrap").find(".met_portfolio_item_slider_nav_next") } },
							circular: '.$slider_option["circular"].',
							infinite: '.$slider_option["infinite"].',
							auto: { play : '.$slider_option["auto_play"].', pauseDuration: 0, duration: '.$slider_option["duration"].' },
							scroll: { items: 1, duration: 400, wipe: true },
							items: { visible: { min: 1, max: 1 }, width: 691, height: "variable" },
							width: 691, height: "variable"
						});
					});
				</script>';
			endif;

			$output .= '<div class="met_portfolio_item_details clearfix">
				<div class="met_portfolio_item_descr met_bgcolor3">
					<div class="met_color2">
						<a href="'.get_permalink().'"><h3 class="met_color2 met_bold_one met_color_transition">'.get_the_title().'</h3></a>
						<p>'.get_the_excerpt().'</p>
					</div>
				</div>
				<div class="met_portfolio_item_share met_color2 met_bgcolor">
					<span>'.__("SHARE","metcreative").'</span>
					<div class="met_portfolio_item_socials">
						<div>
							<a class="met_color2" title="'.__("Share This on Facebook","metcreative").'" target="_blank" href="http://www.facebook.com/sharer.php?u='.get_permalink().'"><i class="icon-facebook"></i></a>
							<a class="met_color2" title="'.__("Tweet This on Twitter","metcreative").'" target="_blank" href="http://twitter.com/home?status='.esc_attr(get_the_title()).' - '.get_permalink().'"><i class="icon-twitter"></i></a>
							<a class="met_color2" title="'.__("Share This on Google+","metcreative").'" target="_blank" href="https://plus.google.com/share?url='.get_permalink().'"><i class="icon-google-plus"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>';

	endwhile; endif;

	$output .= '</div>';

	if($show_pagination == 'yes' && $the_query->max_num_pages > 1):

		$output .= '<div class="pagination n_pagination">
			<ul>
				<li><?php next_posts_link(_("Older"),$the_query->max_num_pages); ?></li>
				<li><?php previous_posts_link(_("Newest"),$the_query->max_num_pages); ?></li>
			</ul>
		</div>';

	endif;


	wp_reset_postdata();
	wp_reset_query();

	return $output;
}