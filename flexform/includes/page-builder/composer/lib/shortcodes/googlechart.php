<?php

class WPBakeryShortCode_googlechart extends WPBakeryShortCode {

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
        $width = wpb_translateColumnWidthToSpan($width);
                
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
        

        $output .= "\n\t".'<div class="wpb_codesnippet_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading wpb_codesnippet_heading"><span>'.$title.'</span></h3></div>' : '';
        $output .= "\n\t\t\t" . $chart_url;
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

WPBMap::map( 'googlechart', array(
    "name"		=> __("Google Chart", "js_composer"),
    "base"		=> "googlechart",
    "class"		=> "wpb_googlechart",
    "icon"      => "icon-wpb-chart",
    "params"	=> array(
	    array(
	        "type" => "textfield",
	        "heading" => __("Widget title", "js_composer"),
	        "param_name" => "title",
	        "value" => "",
	        "description" => __("Heading text. Leave it empty if not needed.", "js_composer")
	    ),
	    array(
	        "type" => "textfield",
	        "heading" => __("Chart title", "js_composer"),
	        "param_name" => "chart_title",
	        "value" => "",
	        "description" => __("Chart title text. Leave it empty if not needed.", "js_composer")
	    ),
	    array(
	        "type" => "dropdown",
	        "heading" => __("Chart type", "js_composer"),
	        "param_name" => "type",
	        "value" => array(__('Line', "js_composer") => "line", __('Pie', "js_composer") => "pie", __('Pie 2D', "js_composer") => "pie2d", __('XY Line', "js_composer") => "xyline", __('Scatter', "js_composer") => "scatter"),
	        "description" => __("Choose the type of chart you'd like to display.", "js_composer")
	    ),
	    array(
	        "type" => "textfield",
	        "heading" => __("Chart labels", "js_composer"),
	        "param_name" => "labels",
	        "value" => "",
	        "description" => __("Enter the chart labels here, e.g. First+Label|Second+Label|Third+Label|Fourth+Label", "js_composer")
	    ),
	    array(
	        "type" => "textfield",
	        "heading" => __("Chart data", "js_composer"),
	        "param_name" => "data",
	        "value" => "",
	        "description" => __("Enter the chart data here, e.g. 41.12,32.35,21.52,5.01", "js_composer")
	    ),
	    array(
	        "type" => "textfield",
	        "heading" => __("Chart data colours", "js_composer"),
	        "param_name" => "data_colours",
	        "value" => "",
	        "description" => __("Enter the chart data colours here (hex without the #), e.g. D73030,329E4A,415FB4,DFD32F", "js_composer")
	    ),
	    array(
	        "type" => "textfield",
	        "heading" => __("Advanced chart data", "js_composer"),
	        "param_name" => "advanced_data",
	        "value" => "",
	        "description" => __("Enter the any advanced chart data here", "js_composer")
	    ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
    )
) );

?>