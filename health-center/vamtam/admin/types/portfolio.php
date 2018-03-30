<?php

/*
 * sets the columns when viewing slideshows in wp-admin
 */

function edit_portfolio_columns($portfolio_columns) {
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => _x('Title', 'column name', 'health-center' ),
		"portfolio_category" => __('Categories', 'health-center' ),
		"author" => __('Author', 'health-center' ),
		"date" => __('Date', 'health-center' ),
		"thumbnail" => __('Thumbnail', 'health-center' )
	);

	return $columns;
}
add_filter('manage_edit-portfolio_columns', 'edit_portfolio_columns');

function manage_portfolio_columns($column) {
	global $post;
	
	if ($post->post_type == "portfolio") {
		switch($column){
			case 'thumbnail':
				echo the_post_thumbnail('thumbnail');
			break;
			
			case "portfolio_category":
				
				$terms = get_the_terms($post->ID, 'portfolio_category');				
				if ( !empty($terms) ) {
					foreach($terms as $t)
						$output[] = "<a href='edit.php?post_type=portfolio&portfolio_category={$t->slug}'> " . esc_html(sanitize_term_field('name', $t->name, $t->term_id, 'portfolio_category', 'display')) . "</a>";
					$output = implode(', ', $output);
				} else {
					$t = get_taxonomy('portfolio_category');
					$output = "---";
				}
				
				echo $output;
			break;
		}
	}
}
add_action('manage_posts_custom_column', 'manage_portfolio_columns', 10, 2);
