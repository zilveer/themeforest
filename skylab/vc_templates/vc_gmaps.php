<?php
$output = $title = $link = $size = $zoom = $type = $bubble = $el_class = '';
extract(shortcode_atts(array(
    'title' => '',
    'link' => 'https://maps.google.com/maps?q=New+York&hl=en&sll=40.686236,-73.995409&sspn=0.038009,0.078192',
    'size' => 200,
    'zoom' => 14,
    'type' => 'm',
    'bubble' => '',
    'el_class' => ''
), $atts));

if ( $link == '' ) { return null; }

$el_class = $this->getExtraClass($el_class);
$bubble = ($bubble!='' && $bubble!='0') ? '&amp;iwloc=near' : '';

$size = str_replace(array( 'px', ' ' ), array( '', '' ), $size);
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_gmaps_widget wpb_content_element'.$el_class, $this->settings['base']);
$output .= "\n\t".'<div class="'.$css_class.'">';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_map_heading'));
$output .= '<div class="wpb_map_wraper"><iframe width="100%" height="'.$size.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$link.'&amp;t='.$type.'&amp;z='.$zoom.'&amp;output=embed'.$bubble.'"></iframe></div>';

$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_gmaps_widget');

echo $output;