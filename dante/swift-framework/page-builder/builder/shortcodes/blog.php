<?php
	
	/*
	*
	*	Swift Page Builder - Blog Shortcode
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*/

	class SwiftPageBuilderShortcode_blog extends SwiftPageBuilderShortcode {
	
	    protected function content($atts, $content = null) {
				
		    $title = $width = $el_class = $output = $show_blog_aux = $exclude_categories = $blog_aux = $show_read_more = $offset = $posts_order = $content_output = $items = $item_figure = $el_position = '';
			
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	'show_blog_aux' => 'yes',
	        	"blog_type"		=> "standard",
	        	"masonry_effect_type" => "effect-1",
	        	'show_title'	=> 'yes',
	        	'show_excerpt'	=> 'yes',
	        	"show_details"	    => 'yes',
	        	"offset"		=> '0',
	        	"posts_order" => 'DESC',
	        	"excerpt_length" => '20',
	        	'show_read_more' => 'yes',
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
	        $items = sf_blog_items($blog_type, $masonry_effect_type, $show_title, $show_excerpt, $show_details, $excerpt_length, $content_output, $show_read_more, $item_count, $category, $exclude_categories, $pagination, $sidebars, $width, $offset, $posts_order);
	        
	      			
			/* FINAL OUTPUT
			================================================== */ 
 			
    		$el_class = $this->getExtraClass($el_class);
            
            $output .= "\n\t".'<div class="spb_blog_widget spb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="spb_wrapper blog-wrap">';            
            $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="spb-heading"><span>'.$title.'</span></h3>' : '';
            if ($blog_aux != "") {
            $output .= "\n\t\t\t".$blog_aux;
            }
            $output .= "\n\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    	
    		if ($blog_type == "masonry-fw") {
    			$output = $this->startRow($el_position, '', true, "full-width") . $output . $this->endRow($el_position, '', true);
    		} else {
	            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            }
            
            global $sf_has_blog, $sf_include_imagesLoaded;
            $sf_include_imagesLoaded = true;
            $sf_has_blog = true;
            
            return $output;
			
	    }
	}
	
	SPBMap::map( 'blog', array(
	    "name"		=> __("Blog", "swift-framework-admin"),
	    "base"		=> "blog",
	    "class"		=> "spb_blog",
	    "icon"      => "spb-icon-blog",
	    "params"	=> array(
	    	array(
	    	    "type" => "textfield",
	    	    "heading" => __("Widget title", "swift-framework-admin"),
	    	    "param_name" => "title",
	    	    "value" => "",
	    	    "description" => __("Heading text. Leave it empty if not needed.", "swift-framework-admin")
	    	),
	    	array(
	    	    "type" => "dropdown",
	    	    "heading" => __("Show blog aux options", "swift-framework-admin"),
	    	    "param_name" => "show_blog_aux",
	    	    "value" => array(__("Yes", "swift-framework-admin") => "yes", __("No", "swift-framework-admin") => "no"),
	    	    "description" => __("Show the blog aux options - categories/tags/search/archives/rss. NOTE: This is only available on a page with the no sidebar setup.", "swift-framework-admin")
	    	),
	    	array(
	    	    "type" => "dropdown",
	    	    "heading" => __("Blog type", "swift-framework-admin"),
	    	    "param_name" => "blog_type",
	    	    "value" => array(__('Standard', "swift-framework-admin") => "standard", __('Mini', "swift-framework-admin") => "mini", __('Masonry', "swift-framework-admin") => "masonry", __('Masonry (Full Width)', "swift-framework-admin") => "masonry-fw"),
	    	    "description" => __("Select the display type for the blog.", "swift-framework-admin")
	    	),
	    	array(
	    	    "type" => "dropdown",
	    	    "heading" => __("Masonry Animation Type", "swift-framework-admin"),
	    	    "param_name" => "masonry_effect_type",
	    	    "value" => array(
	    	    		__('Effect 1', "swift-framework-admin") => "effect-1",
	    	    		__('Effect 2', "swift-framework-admin") => "effect-2",
	    	    		__('Effect 3', "swift-framework-admin") => "effect-3",
	    	    		__('Effect 4', "swift-framework-admin") => "effect-4",
	    	    		__('Effect 5', "swift-framework-admin") => "effect-5",
	    	    		__('Effect 6', "swift-framework-admin") => "effect-6",
	    	    		__('Effect 7', "swift-framework-admin") => "effect-7",
	    	    		__('Effect 8', "swift-framework-admin") => "effect-8",
	    	    		__('No Effect', "swift-framework-admin") => "no-effect",
	    	   	),
	    	    "description" => __("If you choose the masonry blog type, you can choose the animation effect here.", "swift-framework-admin")
	    	),
	        array(
	            "type" => "textfield",
	            "class" => "",
	            "heading" => __("Number of items", "swift-framework-admin"),
	            "param_name" => "item_count",
	            "value" => "5",
	            "description" => __("The number of blog items to show per page.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "select-multiple",
	            "heading" => __("Blog category", "swift-framework-admin"),
	            "param_name" => "category",
	            "value" => sf_get_category_list('category'),
	            "description" => __("Choose the category for the blog items.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Posts offset", "swift-framework-admin"),
	            "param_name" => "offset",
	            "value" => "0",
	            "description" => __("The offset for the start of the posts that are displayed, e.g. enter 5 here to start from the 5th post.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Posts order", "swift-framework-admin"),
	            "param_name" => "posts_order",
	            "value" => array(__("Descending", "swift-framework-admin") => "DESC", __("Ascending", "swift-framework-admin") => "ASC"),
	            "description" => __("The order of the posts.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Show title text", "swift-framework-admin"),
	            "param_name" => "show_title",
	            "value" => array(__("Yes", "swift-framework-admin") => "yes", __("No", "swift-framework-admin") => "no"),
	            "description" => __("Show the item title text.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Show item excerpt", "swift-framework-admin"),
	            "param_name" => "show_excerpt",
	            "value" => array(__("Yes", "swift-framework-admin") => "yes", __("No", "swift-framework-admin") => "no"),
	            "description" => __("Show the item excerpt text.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Show item details", "swift-framework-admin"),
	            "param_name" => "show_details",
	            "value" => array(__("Yes", "swift-framework-admin") => "yes", __("No", "swift-framework-admin") => "no"),
	            "description" => __("Show the item details.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Excerpt Length", "swift-framework-admin"),
	            "param_name" => "excerpt_length",
	            "value" => "20",
	            "description" => __("The length of the excerpt for the posts.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Content Output", "swift-framework-admin"),
	            "param_name" => "content_output",
	            "value" => array(__("Excerpt", "swift-framework-admin") => "excerpt", __("Full Content", "swift-framework-admin") => "full_content"),
	            "description" => __("Choose whether to display the excerpt or the full content for the post. Full content is not available for the masonry view.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Show read more link", "swift-framework-admin"),
	            "param_name" => "show_read_more",
	            "value" => array(__("Yes", "swift-framework-admin") => "yes", __("No", "swift-framework-admin") => "no"),
	            "description" => __("Show a read more link below the excerpt.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Pagination", "swift-framework-admin"),
	            "param_name" => "pagination",
	            "value" => array(__("Infinite scroll", "swift-framework-admin") => "infinite-scroll", __("Load more (AJAX)", "swift-framework-admin") => "load-more", __("Standard", "swift-framework-admin") => "standard", __("None", "swift-framework-admin") => "none"),
	            "description" => __("Show pagination.", "swift-framework-admin")
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