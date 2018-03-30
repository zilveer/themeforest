<?php

class SwiftPageBuilderShortcode_jobs_overview extends SwiftPageBuilderShortcode {

    public function content( $atts, $content = null ) {

        $title = $job_text = $order = $view_all_link = $output = $items = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
        	'job_text' => '',
           	'item_count'	=> '-1',
           	'order'	=> '',
        	'category'		=> '',
        	'view_all_link'	=> '',
            'el_class' => '',
            'el_position' => '',
            'width' => '1/2'
        ), $atts));
        
       	// CATEGORY SLUG MODIFICATION
       	if ($category == "All") {$category = "all";}
        if ($category == "all") {$category = '';}
        $category_slug = str_replace('_', '-', $category);
        
        // JOBS QUERY SETUP
        
        global $post, $wp_query;
        
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            		
        $jobs_args = array(
        	'orderby' => $order,
        	'post_type' => 'jobs',
        	'post_status' => 'publish',
        	'paged' => $paged,
        	'jobs-category' => $category_slug,
        	'posts_per_page' => $item_count,
        	'no_found_rows' => 1
        	);
        	    		
        $jobs = new WP_Query( $jobs_args );
        
        $count = 0;
        
        $items .= '<ul class="jobs-overview clearfix">';
        
        // JOBS LOOP
        
        while ( $jobs->have_posts() ) : $jobs->the_post();
        	
        	$job_title = get_the_title();
        	$job_permalink = get_permalink();
        	
        	$items .= '<li class="job"><a href="'.$job_permalink.'">'.$job_title.'</a></li>'; 
        	
        	$count++;
        
        endwhile;
        
        wp_reset_postdata();
        		
        $items .= '</ul>';
        
        
        if ($view_all_link == "yes") {
        	$options = get_option('sf_dante_options');
        	$jobs_page = __($options['jobs_page'], 'swiftframework');
        	if ($jobs_page) {
        	$jobs_page_title = get_page_by_path( $jobs_page );
        		if (isset($jobs_page_title)) {
        			$jobs_page_id = $jobs_page_title->ID;   
        		}
        	}
        	if ($jobs_page && isset($jobs_page_title)) {
	        	$items .= '<a href="'.get_permalink($jobs_page_id).'" class="read-more">'.__("View all vacancies", "swiftframework").' ['.$current_jobs.']</a>';
        	}
        }
        
        $el_class = $this->getExtraClass($el_class);
        $width = spb_translateColumnWidthToSpan($width);

        $output .= "\n\t".'<div class="spb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="spb_wrapper jobs-wrap">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="spb-heading">'.$title.'</h3>' : '';
        $output .= "\n\t\t\t"."<p>".$job_text."</p>";
        $output .= "\n\t\t\t". $items;
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

SPBMap::map( 'jobs_overview', array(
    "name"		=> __("Jobs Overview", "swift-framework-admin"),
    "base"		=> "jobs_overview",
    "class"		=> "",
    "icon"      => "spb-icon-jobs-overview",
    "wrapper_class" => "clearfix",
    "controls"	=> "full",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Widget title", "swift-framework-admin"),
    	    "param_name" => "title",
    	    "value" => "",
    	    "description" => __("Heading text. Leave it empty if not needed.", "swift-framework-admin")
    	),
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Intro Text", "swift-framework-admin"),
    	    "param_name" => "job_text",
    	    "value" => __("", "swift-framework-admin"),
    	    "description" => __("Enter the intro text for the jobs overview.", "swift-framework-admin")
    	),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "swift-framework-admin"),
            "param_name" => "item_count",
            "value" => "3",
            "description" => __("The number of jobs to show in the overview list. Leave blank to show ALL jobs.", "swift-framework-admin")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Jobs Order", "swift-framework-admin"),
            "param_name" => "order",
            "value" => array(__('Random', "swift-framework-admin") => "rand", __('Latest', "swift-framework-admin") => "date"),
            "description" => __("Choose the order of the jobs.", "swift-framework-admin")
        ),
        array(
            "type" => "select-multiple",
            "heading" => __("Jobs category", "swift-framework-admin"),
            "param_name" => "category",
            "value" => sf_get_category_list('jobs-category'),
            "description" => __("Choose the category for the jobs.", "swift-framework-admin")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("View all link", "swift-framework-admin"),
            "param_name" => "view_all_link",
            "value" => array(__('Yes', "swift-framework-admin") => "yes", __('No', "swift-framework-admin") => "no"),
            "description" => __("Show the view all jobs link. Make sure you have selected the page within theme options for this to work.", "swift-framework-admin")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "swift-framework-admin"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift-framework-admin")
        )
    )
) );

?>