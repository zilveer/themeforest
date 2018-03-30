<?php

class WPBakeryShortCode_tweets_slider extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        $title = $order = $text_size = $items = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
        	'twitter_username' => '',
        	'text_size' => 'normal',
           	'item_count'	=> '6',
           	'animation'		=> 'fade',
           	'autoplay'		=> 'yes',
            'el_class' => '',
            'alt_background'	=> 'none',
            'el_position' => '',
            'width' => '1/1'
        ), $atts));

        $output = '';
        
        if ($autoplay == "yes") {
        $items .= '<div class="flexslider tweets-slider content-slider" data-animation="'.$animation.'" data-autoplay="yes"><ul class="slides">';
        } else {
        $items .= '<div class="flexslider tweets-slider content-slider" data-animation="'.$animation.'" data-autoplay="no"><ul class="slides">';
        }
        
        $items .= latestTweet($item_count, $twitter_username, true);
        
        wp_reset_postdata();
        		
        $items .= '</ul></div>';
       	       				        
        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);

        $el_class .= ' testimonial';
        
        if ($alt_background == "none") {
		$output .= "\n\t".'<div class="wpb_tweets_slider_widget wpb_content_element '.$width.$el_class.'">';
        } else {
        $output .= "\n\t".'<div class="wpb_tweets_slider_widget wpb_content_element alt-bg '.$alt_background.' '.$width.$el_class.'">';            
        }
        $output .= "\n\t\t".'<div class="wpb_wrapper slider-wrap text-'.$text_size.'">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading">'.$title.'</h3></div>' : '';
        $output .= "\n\t\t\t".$items;
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        
        global $include_carousel;
        $include_carousel = true;
        
        return $output;
    }
}

WPBMap::map( 'tweets_slider', array(
    "name"		=> __("Tweets Slider", "js_composer"),
    "base"		=> "tweets_slider",
    "class"		=> "wpb_tweets_slider wpb_slider",
    "icon"      => "icon-wpb-tweets_slider",
    "wrapper_class" => "clearfix",
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
            "heading" => __("Twitter username", "js_composer"),
            "param_name" => "twitter_username",
            "value" => "",
            "description" => __("The twitter username you'd like to show the latest tweet for. Make sure to not include the @.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Text size", "js_composer"),
            "param_name" => "text_size",
            "value" => array(__('Normal', "js_composer") => "normal", __('Large', "js_composer") => "large"),
            "description" => __("Choose the size of the text.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of tweets", "js_composer"),
            "param_name" => "item_count",
            "value" => "6",
            "description" => __("The number of tweets to show.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Slider animation", "js_composer"),
            "param_name" => "animation",
            "value" => array(__('Fade', "js_composer") => "fade", __('Slide', "js_composer") => "slide"),
            "description" => __("Choose the animation for the slider.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Slider autoplay", "js_composer"),
            "param_name" => "autoplay",
            "value" => array(__('Yes', "js_composer") => "yes", __('No', "js_composer") => "no"),
            "description" => __("Select if you want the slider to autoplay or not.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show alt background", "js_composer"),
            "param_name" => "alt_background",
            "value" => array(__("None", "js_composer") => "none", __("Alt 1", "js_composer") => "alt-one", __("Alt 2", "js_composer") => "alt-two", __("Alt 3", "js_composer") => "alt-three", __("Alt 4", "js_composer") => "alt-four", __("Alt 5", "js_composer") => "alt-five", __("Alt 6", "js_composer") => "alt-six", __("Alt 7", "js_composer") => "alt-seven", __("Alt 8", "js_composer") => "alt-eight", __("Alt 9", "js_composer") => "alt-nine", __("Alt 10", "js_composer") => "alt-ten"),
            "description" => __("Show an alternative background around the asset. These can all be set in Flexform Options > Asset Background Options.", "js_composer")
        ),
        array(
            "type" => "altbg_preview",
            "heading" => __("Alt Background Preview", "js_composer"),
            "param_name" => "altbg_preview",
            "value" => "",
            "description" => __("", "js_composer")
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