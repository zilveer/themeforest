<?php

class SwiftPageBuilderShortcode_portfolio extends SwiftPageBuilderShortcode {

    protected function content($atts, $content = null) {

		   	$title = $width = $el_class = $filter_output = $exclude_categories = $output = $tax_terms = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	'display_type' => 'standard',
	        	'columns'		=> '4',
	        	'show_title'	=> 'yes',
	        	'show_subtitle'	=> 'yes',
	        	'show_excerpt'	=> 'no',
	        	'hover_show_excerpt' => 'no',
	        	"excerpt_length" => '20',
	        	'item_count'	=> '-1',
	        	'category'		=> '',
	        	'portfolio_filter'		=> 'yes',
	        	'pagination'	=> 'no',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	        
	        
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
	        
	        
	        /* PORTFOLIO FILTER
	        ================================================== */ 
	        if ($portfolio_filter == "yes" && $sidebars == "no-sidebars") {
	        	if ($display_type == "masonry-fw" || $display_type == "masonry-gallery-fw") {
	        	$filter_output = sf_portfolio_filter('full-width', $category);
	        	} else {
	        	$filter_output = sf_portfolio_filter('', $category);
	        	}
	        }
	        
	        
	        /* PORTFOLIO ITEMS
	        ================================================== */	        
	        $items = sf_portfolio_items($display_type, $columns, $show_title, $show_subtitle, $show_excerpt, $hover_show_excerpt, $excerpt_length, $item_count, $category, $exclude_categories, $pagination, $sidebars);
	        
	        
			/* PAGE BUILDER OUTPUT
			================================================== */ 
    		$width = spb_translateColumnWidthToSpan($width);
    		$el_class = $this->getExtraClass($el_class);
            
            $output .= "\n\t".'<div class="spb_portfolio_widget spb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="spb_wrapper portfolio-wrap">';
            $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="spb-heading"><span>'.$title.'</span></h3>' : '';
            if ($filter_output != "") {
            $output .= "\n\t\t\t".$filter_output;
            }
            $output .= "\n\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
    		if ($display_type == "masonry-fw" || $display_type == "masonry-gallery-fw") {
    			$output = $this->startRow($el_position, '', true, "full-width") . $output . $this->endRow($el_position, '', true);
    		} else {
    		    $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
    		}
            
            global $sf_include_isotope;
            $sf_include_isotope = true;
            
            global $sf_has_portfolio;
            $sf_has_portfolio = true;

            return $output;
		
    }
}

SPBMap::map( 'portfolio', array(
    "name"		=> __("Portfolio", "swift-framework-admin"),
    "base"		=> "portfolio",
    "class"		=> "spb_portfolio",
    "icon"      => "spb-icon-portfolio",
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
            "heading" => __("Display type", "swift-framework-admin"),
            "param_name" => "display_type",
            "value" => array(__('Standard', "swift-framework-admin") => "standard", __('Gallery', "swift-framework-admin") => "gallery", __('Masonry', "swift-framework-admin") => "masonry", __('Masonry Gallery', "swift-framework-admin") => "masonry-gallery", __('Masonry (Full Width)', "swift-framework-admin") => "masonry-fw", __('Masonry Gallery (Full Width)', "swift-framework-admin") => "masonry-gallery-fw"),
            "description" => __("Select the type of portfolio you'd like to show.", "swift-framework-admin")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Column count", "swift-framework-admin"),
            "param_name" => "columns",
            "value" => array("4", "3", "2"),
            "description" => __("How many portfolio columns to display.", "swift-framework-admin")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show title text", "swift-framework-admin"),
            "param_name" => "show_title",
            "value" => array(__('Yes', "swift-framework-admin") => "yes", __('No', "swift-framework-admin") => "no"),
            "description" => __("Show the item title text. (Standard/Masonry only)", "swift-framework-admin")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show subtitle text", "swift-framework-admin"),
            "param_name" => "show_subtitle",
            "value" => array(__('Yes', "swift-framework-admin") => "yes", __('No', "swift-framework-admin") => "no"),
            "description" => __("Show the item subtitle text. (Standard/Masonry only)", "swift-framework-admin")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show item excerpt", "swift-framework-admin"),
            "param_name" => "show_excerpt",
            "value" => array(__('No', "swift-framework-admin") => "no", __('Yes', "swift-framework-admin") => "yes"),
            "description" => __("Show the item excerpt text. (Standard/Masonry only)", "swift-framework-admin")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Excerpt Hover", "swift-framework-admin"),
            "param_name" => "hover_show_excerpt",
            "value" => array(__('No', "swift-framework-admin") => "no", __('Yes', "swift-framework-admin") => "yes"),
            "description" => __("Show the item excerpt on hover, instead of the arrow button. (Gallery/Masonry Gallery only)", "swift-framework-admin")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Excerpt Length", "swift-framework-admin"),
            "param_name" => "excerpt_length",
            "value" => "20",
            "description" => __("The length of the excerpt for the posts.", "swift-framework-admin")
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "swift-framework-admin"),
            "param_name" => "item_count",
            "value" => "12",
            "description" => __("The number of portfolio items to show per page. Leave blank to show ALL portfolio items.", "swift-framework-admin")
        ),
        array(
            "type" => "select-multiple",
            "heading" => __("Portfolio category", "swift-framework-admin"),
            "param_name" => "category",
            "value" => sf_get_category_list('portfolio-category'),
            "description" => __("Choose the category from which you'd like to show the portfolio items.", "swift-framework-admin")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Filter", "swift-framework-admin"),
            "param_name" => "portfolio_filter",
            "value" => array(__('Yes', "swift-framework-admin") => "yes", __('No', "swift-framework-admin") => "no"),
            "description" => __("Show the portfolio category filter above the items. NOTE: This is only available on a page with the no sidebar setup.", "swift-framework-admin")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Pagination", "swift-framework-admin"),
            "param_name" => "pagination",
            "value" => array(__('Yes', "swift-framework-admin") => "yes", __('No', "swift-framework-admin") => "no"),
            "description" => __("Show portfolio pagination.", "swift-framework-admin")
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