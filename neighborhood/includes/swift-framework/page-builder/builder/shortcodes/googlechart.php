<?php

class SwiftPageBuilderShortcode_googlechart extends SwiftPageBuilderShortcode {

    public function content( $atts, $content = null ) {

        $title = $chart_title = $chart_url = $type = $advanced_data = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
        	'type'	=> 'pie',
        	'labels'	=> '',
        	'data'		=> '',
        	'size'		=> '600x250',
        	'data_colours'	=> '',
            'el_class' => '',
            'el_position' => '',
            'width' => '1'
        ), $atts));

        $output = '';

        $el_class = $this->getExtraClass($el_class);
        $width = spb_translateColumnWidthToSpan($width);
                
		switch ($type) {
			case 'line' :
				$type = 'lc';
				break;
			case 'xyline' :
				$type = 'lxy';
				break;
			case 'sparkline' :
				$type = 'ls';
				break;
			case 'meter' :
				$type = 'gom';
				break;
			case 'scatter' :
				$type = 's';
				break;
			case 'venn' :
				$type = 'v';
				break;
			case 'pie' :
				$type = 'p3';
				break;
			case 'pie2d' :
				$type = 'p';
				break;
			default :
				break;
		}
        
           $attributes = '';
           $attributes .= '&chd=t:'.$data.'';
           if ($title) {$attributes .= '&chtt='.$chart_title.'';}
           if ($labels) {$attributes .= '&chl='.$labels.'';}
           $attributes .= '&chs='.$size.'';
           $attributes .= '&chf=bg,s,65432100';
           if ($data_colours) {$attributes .= '&chco='.$data_colours.'';}
           if ($advanced_data) {$attributes .= $advanced_data;}
        
           $chart_url = '<img class="googlechart" title="'.$title.'" src="http://chart.apis.google.com/chart?cht='.$type.''.$attributes.'" alt="'.$title.'" />';
        

        $output .= "\n\t".'<div class="spb_codesnippet_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="spb_wrapper">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<h4 class="spb_heading spb_codesnippet_heading"><span>'.$title.'</span></h4>' : '';
        $output .= "\n\t\t\t" . $chart_url;
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

SPBMap::map( 'googlechart', array(
    "name"		=> __("Google Chart", "swiftframework"),
    "base"		=> "googlechart",
    "class"		=> "spb_googlechart",
    "icon"      => "spb-icon-chart",
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
	        "heading" => __("Chart title", "swiftframework"),
	        "param_name" => "chart_title",
	        "value" => "",
	        "description" => __("Chart title text. Leave it empty if not needed.", "swiftframework")
	    ),
	    array(
	        "type" => "dropdown",
	        "heading" => __("Chart type", "swiftframework"),
	        "param_name" => "type",
	        "value" => array(__('Line', "swiftframework") => "line", __('Pie', "swiftframework") => "pie", __('Pie 2D', "swiftframework") => "pie2d", __('XY Line', "swiftframework") => "xyline", __('Scatter', "swiftframework") => "scatter"),
	        "description" => __("Choose the type of chart you'd like to display.", "swiftframework")
	    ),
	    array(
	        "type" => "textfield",
	        "heading" => __("Chart labels", "swiftframework"),
	        "param_name" => "labels",
	        "value" => "",
	        "description" => __("Enter the chart labels here, e.g. First+Label|Second+Label|Third+Label|Fourth+Label", "swiftframework")
	    ),
	    array(
	        "type" => "textfield",
	        "heading" => __("Chart data", "swiftframework"),
	        "param_name" => "data",
	        "value" => "",
	        "description" => __("Enter the chart data here, e.g. 41.12,32.35,21.52,5.01", "swiftframework")
	    ),
	    array(
	        "type" => "textfield",
	        "heading" => __("Chart data colours", "swiftframework"),
	        "param_name" => "data_colours",
	        "value" => "",
	        "description" => __("Enter the chart data colours here (hex without the #), e.g. D73030,329E4A,415FB4,DFD32F", "swiftframework")
	    ),
	    array(
	        "type" => "textfield",
	        "heading" => __("Advanced chart data", "swiftframework"),
	        "param_name" => "advanced_data",
	        "value" => "",
	        "description" => __("Enter the any advanced chart data here", "swiftframework")
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