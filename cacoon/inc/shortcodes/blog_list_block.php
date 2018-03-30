<?php

function met_su_BLOG_LIST_BLOCK_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_blog_list_block'] = array(
		'name' => __( 'Blog List Block', 'su' ),
		'type' => 'single',
		'group' => 'met',
		'atts' => array(
			'widget_title' => array(
				'default' => 'Latest Posts',
				'name' => __( 'Widget Title', 'su' ),
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
			'class' => array(
				'default' => '',
				'name' => __( 'Class', 'su' ),
				'desc' => __( 'Extra CSS class', 'su' )
			)
		),
		'desc' => '',
		'icon' => 'star',
		'function' => 'met_su_blog_list_block_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_BLOG_LIST_BLOCK_shortcode_data' );


function met_su_blog_list_block_shortcode( $atts, $content = null ) {
	extract($atts);

	if(empty($item_limit)){
		$item_limit = 6;
	}

	$widgetID = uniqid('met_blog_list_');

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

	$output = '<div class="row-fluid'.su_ecssc( $atts ).'">';

		query_posts($query_filter);
		$i = 0;
		if (have_posts()) : while (have_posts()) : the_post();

			$post_date = get_the_date('d-F');
			$post_date = explode('-',$post_date);
			$post_day = $post_date[0];
			$post_month = $post_date[1];

			$output .= '<div class="span2">
				<div class="met_dated_blog_posts">
					<span class="met_date">'.$post_day.'</span>
					<span class="met_month">'.$post_month.'</span>
					<article>
						<h3>'.get_the_title().'</h3>
						<p>'.wp_trim_words( get_the_excerpt(),  $excerpt_limit, $excerpt_more ).'</p>
						<a href="'.get_permalink( get_the_ID() ).'" class="met_read_more met_color">'.$read_more_text.'</a>
					</article>
				</div>
			</div>';

			$i++; if($i % 6 == 0):
				$output .= '<div style="width: 100%; height: 1px; float: left;"></div>';
			endif;
		endwhile; endif;

	$output .= '</div>';
	wp_reset_query();

	return $output;
}