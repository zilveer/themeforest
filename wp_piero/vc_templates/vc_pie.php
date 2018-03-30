<?php
global $smof_data;
$title = $el_class = $value = $label_value= $units = $cl_hide_icon = $title_pie = $cl_hide_value = '';
extract(shortcode_atts(array(
    'title' => '',
    'heading_size'=>'h4',
    'title_color' => $smof_data['primary_color'],
    'desc' => '',
    'style' => '1',
    'icon' => '',
    'icon_size' => '24px',
    'pie_width' => '12',
    'icon_color' => '#888',
    'el_class' => '',
    'value' => '50',
    'units' => '',
    'color' => $smof_data['primary_color'],
    'color_bg' => '#f7f7f7',
    'label_value' => '' 
), $atts));

if($icon!=''){
    $vc_pie_chart_value = '<i class="'.esc_attr($icon).'" style="color:'.$icon_color.';font-size:'.$icon_size.';"></i>';
} else {
    $vc_pie_chart_value = '<span class="vc_pie_chart_value">'.$cl_hide_icon.'</span>';
}

wp_register_script( 'progressCircle', get_template_directory_uri().'/js/process_cycle.js' );
wp_register_script('vc_pie_custom',get_template_directory_uri().'/js/vc_pie_custom.js');
wp_enqueue_script('progressCircle');
wp_enqueue_script('vc_pie_custom');
wp_enqueue_script('waypoints');

$el_class = $this->getExtraClass( $el_class );
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_pie_chart wpb_content_element'.$el_class, $this->settings['base']);
switch ($style){
    case 1:
    $output = "\n\t".'<div class= "'.esc_attr($css_class).'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper">';
            $output .='<div class="vc_wrap_header">';
                if ($title!='') {
                    $output .= '<'.$heading_size.' class="wpb_heading wpb_pie_chart_heading" style="color:'.$title_color.';">'.$title.'</'.$heading_size.'>';
                }
            $output .='</div>';
            $output .= "\n\t\t\t".'<div class="vc_pie_wrapper" data-pie-border="'.$pie_width.'" data-pie-value="'.esc_attr($value).'" data-pie-label-value="'.esc_attr($label_value).'" data-pie-units="'.esc_attr($units).'" data-pie-color="'.esc_attr(htmlspecialchars($color)).'">';
                $output .= "\n\t\t\t".'<span class="vc_pie_chart_back" style="border-color:'.esc_attr($color_bg).';"></span>';
                $output .= $vc_pie_chart_value;
                $output .= "\n\t\t\t".'<canvas width="101" height="101"></canvas>';
                $output .= "\n\t\t\t".'</div>';
            if ($desc!='') {
                $output .= '<div class="desc">'.$desc.'</div>';
            }
            /* wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_pie_chart_heading')); */
        $output .= "\n\t\t".'</div>'.$this->endBlockComment('.wpb_wrapper');
    $output .= "\n\t".'</div>'.$this->endBlockComment('.wpb_pie_chart')."\n";
    break;
    case 2 :
    $output = "\n\t".'<div class= "'.esc_attr($css_class).'" >';
        $output .= "\n\t\t".'<div class="wpb_wrapper">';
            $output .= "\n\t\t\t".'<div class="vc_pie_wrapper" data-pie-border="'.$pie_width.'" data-pie-value="'.esc_attr($value).'" data-pie-label-value="'.esc_attr($label_value).'" data-pie-units="'.esc_attr($units).'" data-pie-color="'.esc_attr(htmlspecialchars($color)).'">';
                $output .= "\n\t\t\t".'<span class="vc_pie_chart_back"></span>';
                $output .='<div class="vc_wrap_header">';
                $output .= $vc_pie_chart_value;
                $output .='</div>';
                $output .= "\n\t\t\t".'<canvas width="101" height="101"></canvas>';
                $output .= "\n\t\t\t".'</div>';
            if ($title!='') {
                $output .= '<'.$heading_size.' class="wpb_heading wpb_pie_chart_heading" style="color:'.$title_color.';">'.$title.'</'.$heading_size.'>';
            }
            if ($desc!='') {
                $output .= '<div class="desc">'.$desc.'</div>';
            }
        $output .= "\n\t\t".'</div>'.$this->endBlockComment('.wpb_wrapper');
    $output .= "\n\t".'</div>'.$this->endBlockComment('.wpb_pie_chart')."\n";
    break;
    case 3 :
    $output = "\n\t".'<div class= "'.esc_attr($css_class).'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper">';
            $output .='<div class="vc_wrap_header">';
                if ($title!='') {
                    $output .= '<'.$heading_size.' class="wpb_heading wpb_pie_chart_heading" style="color:'.$title_color.';">'.$title.'</'.$heading_size.'>';
                }
                if ($desc!='') {
                    $output .= '<div class="desc">'.$desc.'</div>';
                }
            $output .='</div>';
            $output .= "\n\t\t\t".'<div class="vc_pie_wrapper" data-pie-border="'.$pie_width.'" data-pie-value="'.esc_attr($value).'" data-pie-label-value="'.esc_attr($label_value).'" data-pie-units="'.esc_attr($units).'" data-pie-color="'.esc_attr(htmlspecialchars($color)).'">';
                $output .= "\n\t\t\t".'<span class="vc_pie_chart_back"></span>';
                $output .= $vc_pie_chart_value;
                $output .= "\n\t\t\t".'<canvas width="101" height="101"></canvas>';
                $output .= "\n\t\t\t".'</div>';
        $output .= "\n\t\t".'</div>'.$this->endBlockComment('.wpb_wrapper');
    $output .= "\n\t".'</div>'.$this->endBlockComment('.wpb_pie_chart')."\n";
    break;
}
echo $output;