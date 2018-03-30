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
	        	"excerpt_length" => '20',
	        	'item_count'	=> '-1',
	        	'category'		=> '',
	        	"exclude_categories" => '',
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
	        	$filter_output = sf_portfolio_filter();
	        }
	        
	        
	        /* PORTFOLIO ITEMS
	        ================================================== */	        
	        $items = sf_portfolio_items($display_type, $columns, $show_title, $show_subtitle, $show_excerpt, $excerpt_length, $item_count, $category, $exclude_categories, $pagination, $sidebars);
	        
	        
			/* PAGE BUILDER OUTPUT
			================================================== */ 
    		$width = spb_translateColumnWidthToSpan($width);
    		$el_class = $this->getExtraClass($el_class);
            
            $output .= "\n\t".'<div class="spb_portfolio_widget spb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="spb_wrapper portfolio-wrap">';
            $output .= ($title != '' ) ? "\n\t\t\t".'<h4 class="spb_heading"><span>'.$title.'</span></h4>' : '';
            if ($filter_output != "") {
            $output .= "\n\t\t\t".$filter_output;
            }
            $output .= "\n\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            
            global $include_isotope, $has_portfolio;
            $include_isotope = true;
            $has_portfolio = true;

            return $output;
		
    }
}

SPBMap::map( 'portfolio', array(
    "name"		=> __("Portfolio", "swiftframework"),
    "base"		=> "portfolio",
    "class"		=> "spb_portfolio",
    "icon"      => "spb-icon-portfolio",
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
            "heading" => __("Display type", "swiftframework"),
            "param_name" => "display_type",
            "value" => array(__('Standard', "swiftframework") => "standard", __('Gallery', "swiftframework") => "gallery"),
            "description" => __("Select the type of portfolio you'd like to show.", "swiftframework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Column count", "swiftframework"),
            "param_name" => "columns",
            "value" => array("4", "3", "2", "1"),
            "description" => __("How many portfolio columns to display.", "swiftframework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show title text", "swiftframework"),
            "param_name" => "show_title",
            "value" => array(__('Yes', "swiftframework") => "yes", __('No', "swiftframework") => "no"),
            "description" => __("Show the item title text.", "swiftframework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show subtitle text", "swiftframework"),
            "param_name" => "show_subtitle",
            "value" => array(__('Yes', "swiftframework") => "yes", __('No', "swiftframework") => "no"),
            "description" => __("Show the item subtitle text.", "swiftframework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show item excerpt", "swiftframework"),
            "param_name" => "show_excerpt",
            "value" => array(__('No', "swiftframework") => "no", __('Yes', "swiftframework") => "yes"),
            "description" => __("Show the item excerpt text.", "swiftframework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Excerpt Length", "swiftframework"),
            "param_name" => "excerpt_length",
            "value" => "20",
            "description" => __("The length of the excerpt for the posts.", "swiftframework")
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "swiftframework"),
            "param_name" => "item_count",
            "value" => "12",
            "description" => __("The number of portfolio items to show per page. Leave blank to show ALL portfolio items.", "swiftframework")
        ),
        array(
            "type" => "select-multiple",
            "heading" => __("Portfolio category", "swiftframework"),
            "param_name" => "category",
            "value" => get_category_list('portfolio-category'),
            "description" => __("Choose the category from which you'd like to show the portfolio items.", "swiftframework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Filter", "swiftframework"),
            "param_name" => "portfolio_filter",
            "value" => array(__('Yes', "swiftframework") => "yes", __('No', "swiftframework") => "no"),
            "description" => __("Show the portfolio category filter above the items. NOTE: This is only available on a page with the no sidebar setup.", "swiftframework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Pagination", "swiftframework"),
            "param_name" => "pagination",
            "value" => array(__('Yes', "swiftframework") => "yes", __('No', "swiftframework") => "no"),
            "description" => __("Show portfolio pagination.", "swiftframework")
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