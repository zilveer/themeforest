<?php
$output = $el_class = $el_id = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'bk_type' =>'',
    'bk_color' =>'',
    'bk_pattern' => '',
    'bk_image' => '',
    'align' => '',
    'text_color' => '',
    'parallax' => '',
    'bk_image' => '',
    'margin_type' => '',
    'el_id' => '',
    'css_delay' => '',
    'css_animation' => '',
), $atts));

//wp_enqueue_style( 'js_composer_front' );
//wp_enqueue_script( 'wpb_composer_front_js' );
//wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row '.get_row_css_class().$el_class, $this->settings['base']);
$css_class .= $this->getCSSAnimation( $css_animation );

 //PIRENKO
//CLASSES
global $retina_device;
$prk_css_classes="";
if ($bk_type=="full_width")
    $prk_css_classes="prk_full_width prk_section";
else
    $prk_css_classes="prk_section centered columns";
if ($margin_type!="")
    $prk_css_classes.=" unmargined";

//INLINE STYLES
$custom_style='style="';
if ($bk_color!="")
    $custom_style.="background-color:".$bk_color.";";
 if ($bk_pattern!="") {
    if ($retina_device=="prk_retina")
    {
        $path_parts = pathinfo(get_template_directory_uri()."/images/patterns/".$bk_pattern);
        $vt_image = vt_resize( '', get_template_directory_uri() . "/images/patterns/".$path_parts['filename']."_@2X.".$path_parts['extension'] , 2000, 2000, false );
        //CHECK IF RETINA PATTERN EXISTS
        if (isset($vt_image['not_found']) && $vt_image['not_found']!="true") {
            $half_width=$vt_image['width']/2;
        $custom_style .="background: url(" . get_template_directory_uri() . "/images/patterns/".$path_parts['filename']."_@2X.".$path_parts['extension']."); background-attachment: fixed;background-repeat:repeat;
        background-size:".$half_width."px auto;
        }";
        }
        else 
        {
            $custom_style.="background:url(".get_template_directory_uri() . "/images/patterns/".$bk_pattern.");background-attachment: fixed;background-repeat:repeat;";
        }
    }
    else 
    {
        $custom_style.="background:url(".get_template_directory_uri() . "/images/patterns/".$bk_pattern.");background-attachment: fixed;background-repeat:repeat;";
    }
}
$parallax_code='';
if ($bk_image!="") {
    $prk_css_classes.=" prk_cover_back";
    $image_attributes = wp_get_attachment_image_src( $bk_image,'full' );
    $custom_style.="background-image:url(".$image_attributes[0].");";
    if (isset($parallax))
    {
        if ($parallax=="fixed")
            $prk_css_classes.=" fixed";
        if ($parallax=="parallel")
        {
            $parallax_code=' data-bottom-top="background-position: 50% 0px;" data-top-bottom="background-position: 50% -350px;"';
                $prk_css_classes.=" astro_with_parallax";
        }
    }
}
if ($text_color!="")
    $custom_style.="color:".$text_color.";";
if ($align!="")
    $custom_style.="text-align:".strtolower($align).";";
if ($custom_style!='style="')
    $custom_style.='"';
else
    $custom_style="";

//ID SUPPORT
if (isset( $el_id ) && ! empty( $el_id )) {
    $row_id=esc_attr($el_id);
}
else {
    $row_id='astro-'.rand(1, 1000).'';
}

//DELAY SUPPORT
if (isset($atts['css_delay'])) {
    $prk_css_classes.=' delay-'.$atts['css_delay'];
}

if ($bk_type=="full_width") {
    $output .= '<div id="'.$row_id.'" class="'.$css_class.' '.$prk_css_classes.'" '.$custom_style.$parallax_code.'>';
        $output .= '<div class="prk_inner_block columns centered">';
            $output .= wpb_js_remove_wpautop($content);
        $output .= '</div>';
    $output .= '</div>'.$this->endBlockComment('row');
}
else {
    $output .= '<div id="'.$row_id.'" class="row extra_size">';
        $output .= '<div class="prk_inner_block '.$css_class.' '.$prk_css_classes.'" '.$custom_style.$parallax_code.'>';
            $output .= '<div class="centered">';
                $output .= wpb_js_remove_wpautop($content);
            $output .= '</div>';
        $output .= '</div>'.$this->endBlockComment('row');
    $output .= '</div>';
}
$output .='<div class="clearfix"></div>';
echo $output;