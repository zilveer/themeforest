<?php
/**
 */

class WPBakeryShortCode_VC_Video extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {
        $title = $link = $size = $el_position = $full_width = $width = $el_class = '';
        extract(shortcode_atts(array(
            'title' => '',
            'link' => '',
            'size' => ( isset($content_width) ) ? $content_width : 500,
            'el_position' => '',
            'width' => '1/1',
            'full_width' => 'no',
            'el_class' => ''
        ), $atts));
        $output = '';

        if ( $link == '' ) { return null; }
        $video_h = '';
        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);
        $size = str_replace(array( 'px', ' ' ), array( '', '' ), $size);
        $size = explode("x", $size);
        $video_w = $size[0];
        if ( count($size) > 1 ) {
            $video_h = ' height="'.$size[1].'"';
        }

        global $wp_embed;
        $embed = $wp_embed->run_shortcode('[embed width="'.$video_w.'"'.$video_h.']'.$link.'[/embed]');
		
		if ($full_width == "yes") {
        $output .= "\n\t".'<div class="wpb_video_widget full-width wpb_content_element '.$width.$el_class.'">';
		} else {
        $output .= "\n\t".'<div class="wpb_video_widget wpb_content_element '.$width.$el_class.'">';
		}
		
        $output .= "\n\t\t".'<div class="wpb_wrapper">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="wpb_heading wpb_video_heading">'.$title.'</h3>' : '';
        $output .= $embed;
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}
class WPBakeryShortCode_VC_Gmaps extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {

        $title = $address = $size = $zoom = $pin_image = $type = $el_position = $width = $el_class = '';
        extract(shortcode_atts(array(
            'title' => '',
            'full_width' => '',
            'address' => '',
            'size' => 200,
            'zoom' => 14,
            'pin_image' => '',
            'type' => 'm',
            'el_position' => '',
            'width' => '1/1',
            'el_class' => ''
        ), $atts));
        $output = '';

        if ( $address == '' ) { return null; }

        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);
		
        $size = str_replace(array( 'px', ' ' ), array( '', '' ), $size);
        
        $img_url = wp_get_attachment_image_src($pin_image, 'full');
		
		if ($full_width == "yes") {
		$output .= "\n\t".'<div class="wpb_gmaps_widget full-width wpb_content_element '.$width.$el_class.'">';
		} else {
		$output .= "\n\t".'<div class="wpb_gmaps_widget wpb_content_element '.$width.$el_class.'">';	          
		} 
        $output .= "\n\t\t".'<div class="wpb_wrapper">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="wpb_heading wpb_video_heading">'.$title.'</h3>' : '';
        
        $output .= '<div class="wpb_map_wraper"><div class="map-canvas" style="width:100%;height:'.$size.'px;" data-address="'.$address.'" data-zoom="'.$zoom.'" data-maptype="'.$type.'" data-pinimage="'.$img_url[0].'"></div></div>';
        
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        
        global $include_maps;
        $include_maps = true;
        
        return $output;
    }
}