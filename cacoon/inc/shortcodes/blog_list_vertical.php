<?php

function met_su_BLOG_LIST_VERTICAL_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_blog_list_vertical'] = array(
		'name' => __( 'Blog List Vertical', 'su' ),
		'type' => 'single',
		'group' => 'met',
		'atts' => array(
			'widget_title' => array(
				'default' => 'Company',
				'name' => __( 'Widget Title', 'su' ),
			),
			'title_sub' => array(
				'default' => 'News',
				'name' => __( 'Title (Secondary)', 'su' ),
			),
			'item_limit' => array(
				'default' => 6,
				'name' => __( 'Item Limit (required)', 'su' ),
			),
			'excerpt_limit' => array(
				'default' => 10,
				'name' => __( 'Excerpt Word Limit', 'su' ),
			),
			'excerpt_more' => array(
				'default' => '...',
				'name' => __( 'Excerpt More Text', 'su' ),
			),
			'read_more_text' => array(
				'default' => 'read more',
				'name' => __( 'Read More Text', 'su' ),
			),
			'categories' => array(
				'default' => '',
				'name' => __( 'Category IDs (Ex: 1,2,3)', 'su' ),
			),
			'ex_categories' => array(
				'default' => '',
				'name' => __( 'Exclude Category IDs (Ex: 1,2,3)', 'su' ),
			),
			'target' => array(
				'type' => 'select',
				'values' => array(
					'0' => __( 'Left', 'su' ),
					'1' => __( 'Right', 'su' )
				),
				'default' => '0',
				'name' => __( 'Arrow Position', 'su' ),
			),
			'class' => array(
				'default' => '',
				'name' => __( 'Class', 'su' ),
				'desc' => __( 'Extra CSS class', 'su' )
			)
		),
		'desc' => '',
		'icon' => 'star',
		'function' => 'met_su_blog_list_vertical_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_BLOG_LIST_VERTICAL_shortcode_data' );


function met_su_blog_list_vertical_shortcode( $atts, $content = null ) {
	extract($atts);

	if(empty($item_limit)){
		$item_limit = 6;
	}

	$widgetID = uniqid('met_blog_vertical_list_');

	$query_filter = array();
	$query_filter['posts_per_page'] = $item_limit;

	if(!empty($categories)){
		$query_filter['category__and'] = array($categories);
	}

	if(!empty($ex_categories)){
		$category_IDs = explode(',',$ex_categories);
		$ex_category_list = '';
		foreach($category_IDs as $category_ID){
			$ex_category_list .= '-'.$category_ID.',';
		}
		$ex_category_list = substr($ex_category_list,0,-1);

		$query_filter['cat'] = $ex_category_list;
	}

	if(empty($arrow_position) OR !isset($arrow_position)){
		$arrow_position = 0;
	}

	$output = '<div class="row-fluid '.su_ecssc( $atts ).'">
		<div class="span12">
			<div id="'.$widgetID.'" class="met_cacoon_sidebar met_color2 met_bgcolor3 clearfix '.(($arrow_position=='1') ? 'met_right_triangle' : '') .'">
				'.( (!empty($widget_title)) ? '<h2 class="met_title_stack">'.$widget_title.'</h2>' : '' ).'
				'.( (!empty($widget_title)) ? '<h2 class="met_title_stack met_bold_one">'.$title_sub.'</h2>' : '' ) .'

				<div class="met_cacoon_sidebar_wrapper">';

					query_posts($query_filter);

					if (have_posts()) : while (have_posts()) : the_post();

						$post_date = get_the_date('d-F');
						$post_date = explode('-',$post_date);
						$post_day = $post_date[0];
						$post_month = $post_date[1];

					$output .= '<div class="met_cacoon_sidebar_item clearfix">
						<div class="met_dated_blog_posts">
							<span class="met_date met_color">'.$post_day.'</span>
							<span class="met_month met_color">'.$post_month.'</span>
							<article>
								<a href="'.get_permalink().'"><h3 class="met_color2">'.get_the_title().'</h3></a>
								<p>'.wp_trim_words( get_the_excerpt(),  $excerpt_limit, $excerpt_more ).'</p>
							</article>
						</div>
					</div>';
					endwhile; endif;

				$output .= '</div>
			</div>
		</div>
	</div>';

	wp_reset_query();

	return $output;
}