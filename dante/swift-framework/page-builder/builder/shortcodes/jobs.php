<?php

class SwiftPageBuilderShortcode_spb_jobs extends SwiftPageBuilderShortcode {

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
        	$job_date = get_the_date();
        	$job_text = get_the_excerpt();
        	
        	$job_image = get_post_thumbnail_id();	
        	$job_image_url = wp_get_attachment_url( $job_image,'full' );
        	$image = sf_aq_resize( $job_image_url, 90, NULL, true, false);
        	$image_alt = esc_attr( sf_get_post_meta($job_image, '_wp_attachment_image_alt', true) );
        				        	
        	$items .= '<li class="job">';

			if ($image) {
			$items .= '<img itemprop="image" src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$image_alt.'" />';
			$items .= '<div class="job-details has-job-image">';
			} else {
			$items .= '<div class="job-details">';
			}
        	$items .= '<span class="job-date">'.$job_date.'</span>';
        	$items .= '<h5>'.$job_title.'</h5>';
        	$items .= '<div class="job-text">'.do_shortcode($job_text).'</div>';
        	$items .= '<a href="'.get_permalink().'" class="read-more">'.__("Learn more", "swiftframework").'</a>'; 
        	$items .= '</div>';
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
        $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="spb-heading"><span>'.$title.'</span></h3>' : '';
        $output .= "\n\t\t\t". $items;
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

SPBMap::map( 'spb_jobs', array(
    "name"		=> __("Jobs", "swift-framework-admin"),
    "base"		=> "spb_jobs",
    "class"		=> "",
    "icon"      => "spb-icon-jobs",
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
            "class" => "",
            "heading" => __("Number of items", "swift-framework-admin"),
            "param_name" => "item_count",
            "value" => "6",
            "description" => __("The number of jobs to show per page. Leave blank to show ALL jobs.", "swift-framework-admin")
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
            "heading" => __("Pagination", "swift-framework-admin"),
            "param_name" => "pagination",
            "value" => array(__('No', "swift-framework-admin") => "no", __('Yes', "swift-framework-admin") => "yes"),
            "description" => __("Show jobs pagination.", "swift-framework-admin")
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