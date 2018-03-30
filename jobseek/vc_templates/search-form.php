<?php

/* Job / Resume search form 
-------------------------------------------------------------------------------------------------------------------*/

if ( !function_exists( 'search_form' ) ) { 
    function search_form($atts, $content = null) {
 
		extract(shortcode_atts(array(
		    'location'    => '',
		    'categories'  => '',
		), $atts));

		// Column classes

		if( !empty($location) && !empty($categories) ) {
			$col_class = $btn_col_class = 'vc_col-md-3';
		} elseif( empty($location) || empty($categories) ) {
			$col_class = 'vc_col-md-5';
			$btn_col_class = 'vc_col-md-2';
		} else {
			$col_class = 'vc_col-md-8';
			$btn_col_class = 'vc_col-md-4';
		}

		// Location field

		if( !empty($location) ) {
			$location = '<div class="' . $col_class . '"><input type="text" id="search_location" name="search_location" placeholder="' . __("Location", "jobseek") . '"></div>';
		}

		// Categories dropdown

		if( !empty($categories) ) {

			$show_category_multiselect = get_option( 'job_manager_enable_default_category_multiselect', false );

			ob_start();

				?><div class="<?php echo $col_class; ?>"><?php

				if ( $show_category_multiselect ) {
					job_manager_dropdown_categories( array( 'taxonomy' => 'job_listing_category', 'hierarchical' => 1, 'name' => 'search_categories', 'orderby' => 'name', 'selected' => '', 'hide_empty' => false ) );
				} else {
					job_manager_dropdown_categories( array( 'taxonomy' => 'job_listing_category', 'hierarchical' => 1, 'show_option_all' => __( 'Any category', 'wp-job-manager' ), 'name' => 'search_categories', 'orderby' => 'name', 'selected' => '', 'multiple' => false ) );
				}

				?></div><?php

			$categories = ob_get_clean();

		}

		// Form

		$output = '<form method="GET" action="' . get_permalink(get_option('job_manager_jobs_page_id')) . '" class="vc_row job_resume_search">
			<div class="' . $col_class . '"><input type="text" id="search_keywords" name="search_keywords" placeholder="' . __("Keywords", "jobseek") . '"></div>' . $location . $categories . '<div class="' . $btn_col_class . '"><input type="submit" value="'. __("Search", "jobseek") . '"></div>
		</form>';

		return $output;

	}
}

add_shortcode('search_form', 'search_form');