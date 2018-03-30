<?php

function met_su_PORTFOLIO_BLOCK_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_portfolio_block'] = array(
		'name' => __( 'Portfolio Block', 'su' ),
		'type' => 'single',
		'group' => 'met',
		'atts' => array(
			'title' => array(
				'default' => 'RECENT WORKS',
				'name' => __( 'Title', 'su' ),
			),
			'item_limit' => array(
				'default' => 10,
				'name' => __( 'Item Limit (required)', 'su' ),
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
		'function' => 'met_su_portfolio_block_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_PORTFOLIO_BLOCK_shortcode_data' );


function met_su_portfolio_block_shortcode( $atts, $content = null ) {
	extract($atts);

	if(empty($item_limit)){
		$item_limit = 10;
	}

	wp_enqueue_script('metcreative-caroufredsel');
	wp_enqueue_style('metcreative-caroufredsel');

	$widgetID = uniqid('met_portfolio_ticker_');

	$query_filter = array();
	$query_filter['post_type'] 			= 'portfolio';
	$query_filter['posts_per_page'] 	= $item_limit;

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

	$output = '<div class="row-fluid">
		<div class="span12">
			<h2 class="met_bold_one met_title_with_pager met_clear_margin_top clearfix">
				'.$title.'
				<nav class="met_recent_works_pages"></nav>
			</h2>

			<div id="'.$widgetID.'" class="met_recent_works clearfix">';

				query_posts($query_filter);
				if (have_posts()) : while (have_posts()) : the_post();

					$thumb 			= get_post_thumbnail_id(get_the_ID());
					$img_url 		= wp_get_attachment_url($thumb, 'full');
					$postThumbnail 	= aq_resize( $img_url, 270, 100, true );

					if( !$postThumbnail ) $postThumbnail = $img_url;

					$output .= '<div class="met_recent_work_item">
						<a href="'.get_permalink().'" class="met_recent_work_image"><img src="'.$postThumbnail.'" alt="'.esc_attr(get_the_title()).'"></a>
						<div class="met_recent_work_overbox met_bgcolor">
							<a href="'.get_permalink().'">
								<span class="met_color2">'.get_the_title().'</span>
								<i class="icon-plus met_color2"></i>
							</a>
						</div>
					</div>';

				endwhile; endif;

			$output .= '</div>
		</div>
	</div>

	<script>
		jQuery(window).load(function(){
			if(jQuery(\'body\').width() < 800){
				var leftUp = \'left\';
				var minItem = 1;
			}else{
				var leftUp = \'up\';
				var minItem = 3;
			}
			jQuery("#'.$widgetID.'").carouFredSel({
				responsive: true,
				pagination : {
					container		: jQuery(\'.met_recent_works_pages\'),
					anchorBuilder	: function(nr) {
						return \'<a href="#"><i class="icon-circle"></i></a>\';
					}
				},
				circular: false,
				infinite: true,
				auto: {
					play : true,
					pauseDuration: 0,
					duration: 2000
				},
				scroll: {
					duration: 400,
					wipe: true,
					pauseOnHover: true
				},
				items: {
					visible: {
						min: minItem,
						max: 3},
					height: \'auto\'
				},
				direction: leftUp,
				onCreate: function(){
					jQuery(window).trigger(\'resize\');
				}
			});
		})
	</script>';


	wp_reset_query();

	return $output;
}