<?php
	
	/*
	*
	*	Swift Page Builder - Blog Shortcode
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/

	class SwiftPageBuilderShortcode_blog extends SwiftPageBuilderShortcode {
	
	    protected function content($atts, $content = null) {
				
		    $title = $width = $el_class = $output = $show_blog_aux = $exclude_categories = $blog_aux = $show_read_more = $content_output = $items = $item_figure = $el_position = '';
			
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	'show_blog_aux' => 'yes',
	        	"blog_type"		=> "standard",
	        	'show_title'	=> 'yes',
	        	'show_excerpt'	=> 'yes',
	        	"show_details"	    => 'yes',
	        	"excerpt_length" => '20',
	        	'show_read_more' => 'no',
	        	"item_count"	=> '5',
	        	"category"		=> '',
	        	"exclude_categories" => '',
	        	"pagination" 	=> "no",
	        	"content_output" => 'excerpt',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));

	        
	        $width = spb_translateColumnWidthToSpan($width);
	        
	        
	        /* SIDEBAR CONFIG
	        ================================================== */ 
	        $sidebar_config = sf_get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
	        
	        $sidebars = '';
	        if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
	        $sidebars = 'one-sidebar';
	        } else if ($sidebar_config == "both-sidebars") {
	        $sidebars = 'both-sidebars';
	        } else {
	        $sidebars = 'no-sidebars';
	        }
	        
	        
	        /* BLOG AUX
	        ================================================== */ 
	        if ($show_blog_aux == "yes" && $sidebars == "no-sidebars") {
	        	$blog_aux = sf_blog_aux($width);
	        }
	        
	        
	        /* BLOG ITEMS
	        ================================================== */ 
	        $items = sf_blog_items($blog_type, $show_title, $show_excerpt, $show_details, $excerpt_length, $content_output, $show_read_more, $item_count, $category, $exclude_categories, $pagination, $sidebars, $width);
	        
	      			
			/* FINAL OUTPUT
			================================================== */ 
 			
    		$el_class = $this->getExtraClass($el_class);
            
            $output .= "\n\t".'<div class="spb_blog_widget spb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="spb_wrapper blog-wrap">';            
            $output .= ($title != '' ) ? "\n\t\t\t".'<h4 class="spb_heading"><span>'.$title.'</span></h4>' : '';
            if ($blog_aux != "") {
            $output .= "\n\t\t\t".$blog_aux;
            }
            $output .= "\n\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            
            if ($blog_type == "masonry") {
            global $include_isotope;
            $include_isotope = true;
            }
            
            global $has_blog;
            $has_blog = true;
            
            return $output;
			
	    }
	}
	
	SPBMap::map( 'blog', array(
	    "name"		=> __("Blog", "swiftframework"),
	    "base"		=> "blog",
	    "class"		=> "spb_blog",
	    "icon"      => "spb-icon-blog",
	    "params"	=> array(
	    	array(
	    	    "type" => "textfield",
	    	    "heading" => __("Widget title", "swiftframework"),
	    	    "param_name" => "title",
	    	    "value" => "",
	    	    "description" => __("Heading text. Leave it empty if not needed.", "swiftframework")
	    	),
	    	array(
	    	    "type" => "dropdown",
	    	    "heading" => __("Show blog aux options", "swiftframework"),
	    	    "param_name" => "show_blog_aux",
	    	    "value" => array(__("Yes", "swiftframework") => "yes", __("No", "swiftframework") => "no"),
	    	    "description" => __("Show the blog aux options - categories/tags/search/archives/rss. NOTE: This is only available on a page with the no sidebar setup.", "swiftframework")
	    	),
	    	array(
	    	    "type" => "dropdown",
	    	    "heading" => __("Blog type", "swiftframework"),
	    	    "param_name" => "blog_type",
	    	    "value" => array(__('Standard', "swiftframework") => "standard", __('Mini', "swiftframework") => "mini", __('Masonry', "swiftframework") => "masonry"),
	    	    "description" => __("Select the display type for the blog.", "swiftframework")
	    	),
	        array(
	            "type" => "textfield",
	            "class" => "",
	            "heading" => __("Number of items", "swiftframework"),
	            "param_name" => "item_count",
	            "value" => "5",
	            "description" => __("The number of blog items to show per page.", "swiftframework")
	        ),
	        array(
	            "type" => "select-multiple",
	            "heading" => __("Blog category", "swiftframework"),
	            "param_name" => "category",
	            "value" => get_category_list('category'),
	            "description" => __("Choose the category for the blog items.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Show title text", "swiftframework"),
	            "param_name" => "show_title",
	            "value" => array(__("Yes", "swiftframework") => "yes", __("No", "swiftframework") => "no"),
	            "description" => __("Show the item title text.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Show item excerpt", "swiftframework"),
	            "param_name" => "show_excerpt",
	            "value" => array(__("Yes", "swiftframework") => "yes", __("No", "swiftframework") => "no"),
	            "description" => __("Show the item excerpt text.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Show item details", "swiftframework"),
	            "param_name" => "show_details",
	            "value" => array(__("Yes", "swiftframework") => "yes", __("No", "swiftframework") => "no"),
	            "description" => __("Show the item details.", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Excerpt Length", "swiftframework"),
	            "param_name" => "excerpt_length",
	            "value" => "20",
	            "description" => __("The length of the excerpt for the posts.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Content Output", "swiftframework"),
	            "param_name" => "content_output",
	            "value" => array(__("Excerpt", "swiftframework") => "excerpt", __("Full Content", "swiftframework") => "full_content"),
	            "description" => __("Choose whether to display the excerpt or the full content for the post. Full content is not available for the masonry view.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Show read more link", "swiftframework"),
	            "param_name" => "show_read_more",
	            "value" => array(__("No", "swiftframework") => "no", __("Yes", "swiftframework") => "yes"),
	            "description" => __("Show a read more link below the excerpt.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Pagination", "swiftframework"),
	            "param_name" => "pagination",
	            "value" => array(__("Yes", "swiftframework") => "yes", __("No", "swiftframework") => "no"),
	            "description" => __("Show pagination.", "swiftframework")
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