<?php

class SwiftPageBuilderShortcode_jobs extends SwiftPageBuilderShortcode {

    public function content( $atts, $content = null ) {

        $title = $order = $items = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
           	'item_count'	=> '-1',
           	'order'	=> '',
        	'category'		=> '',
        	'pagination'	=> 'no',
            'el_class' => '',
            'el_position' => '',
            'width' => '1/2'
        ), $atts));

        $output = '';
        
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
        	'posts_per_page' => $item_count
        	);
        	    		
        $jobs = new WP_Query( $jobs_args );
                
        $items .= '<ul class="jobs clearfix">';
        
        // JOBS LOOP
        
        while ( $jobs->have_posts() ) : $jobs->the_post();
        	
        	$job_title = get_the_title();
        	$job_text = get_the_content();
        	
        	$items .= '<li class="job">';
        	$items .= '<h3>'.$job_title.'</h3>';
        	$items .= '<div class="job-text">'.do_shortcode($job_text).'</div>'; 
        	$items .= '</li>';
        	        
        endwhile;
        
        wp_reset_postdata();
        		
        $items .= '</ul>';
        
        
        // PAGINATION
        
       if ($pagination == "yes") {
       
       	$items .= '<div class="pagination-wrap">';
       	
       	$items .= pagenavi($jobs);
       						
       	$items .= '</div>';
       
       }    

        $el_class = $this->getExtraClass($el_class);
        $width = spb_translateColumnWidthToSpan($width);
        
        $output .= "\n\t".'<div class="spb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="spb_wrapper jobs-wrap">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<h4 class="spb_heading spb_text_heading"><span>'.$title.'</span></h4>' : '';
        $output .= "\n\t\t\t". $items;
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

SPBMap::map( 'jobs', array(
    "name"		=> __("Jobs", "swiftframework"),
    "base"		=> "jobs",
    "class"		=> "",
    "icon"      => "spb-icon-jobs",
    "wrapper_class" => "clearfix",
    "controls"	=> "full",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Widget title", "swiftframework"),
    	    "param_name" => "title",
    	    "value" => "",
    	    "description" => __("Heading text. Leave it empty if not needed.", "swiftframework")
    	),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "swiftframework"),
            "param_name" => "item_count",
            "value" => "6",
            "description" => __("The number of jobs to show per page. Leave blank to show ALL jobs.", "swiftframework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Jobs Order", "swiftframework"),
            "param_name" => "order",
            "value" => array(__('Random', "swiftframework") => "rand", __('Latest', "swiftframework") => "date"),
            "description" => __("Choose the order of the jobs.", "swiftframework")
        ),
        array(
            "type" => "select-multiple",
            "heading" => __("Jobs category", "swiftframework"),
            "param_name" => "category",
            "value" => get_category_list('jobs-category'),
            "description" => __("Choose the category for the jobs.", "swiftframework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Pagination", "swiftframework"),
            "param_name" => "pagination",
            "value" => array(__('No', "swiftframework") => "no", __('Yes', "swiftframework") => "yes"),
            "description" => __("Show jobs pagination.", "swiftframework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "swiftframework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swiftframework")
        )
    )
) );

?>