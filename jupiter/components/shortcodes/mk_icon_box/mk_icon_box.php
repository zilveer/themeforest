<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();


$svg_icon = Mk_SVG_Icons::get_svg_icon_by_class_name(false, $icon);
$backward_icon = empty($svg_icon) ? str_replace('mk-', '', $icon) : '';

// Main Wrapper classes
$classes[] = $el_class;
$classes[] = $visibility;
$classes[] = $style.'-style';
$classes[] = get_viewport_animation_class($animation);
$classes[] = $el_class;


$atts = array(
    "icon" => $svg_icon,
    "backward_icon" => $backward_icon,
    "read_more_url" => $read_more_url,
    "title" => $title,
    "content" => $content,
    "read_more_url" => $read_more_url,
    "read_more_txt" => $read_more_txt,
    "circled" => $circled,
    "icon_size" => $icon_size,
    "rounded_circle" => $rounded_circle,
    "icon_location" => $icon_location
    );

?>

<div id="box-icon-<?php echo $id; ?>" class="mk-box-icon <?php echo implode(' ', $classes); ?> clearfix">

    <?php echo mk_get_shortcode_view('mk_icon_box', 'styles/' . $style, true, $atts); ?>

    <div class="clearboth"></div>
</div>




<?php 
$app_styles = '#box-icon-'.$id.' {margin-bottom:'.$margin.'px;}';
$app_styles .= '#box-icon-'.$id.' .icon-box-title {font-size:'.$text_size.'px;font-weight:'.$font_weight.';}';


$app_styles .= !empty( $txt_color ) ? ( '#box-icon-'.$id.' p{color:'.$txt_color.';}' ) : '';
$app_styles .= !empty( $txt_link_color ) ? ( '#box-icon-'.$id.' p a{color:'.$txt_link_color.';}' ) : '';
$app_styles .= !empty( $title_color ) ? ( '#box-icon-'.$id.' h4, #box-icon-'.$id.' h4 a {color:'.$title_color.'!important;}' ) : '';


switch ($style) {
    case 'boxed':
            $border_css =  !empty( $icon_circle_border_color ) ? ( 'border:1px solid '.$icon_circle_border_color.';' ) : '';
            $app_styles .= '#box-icon-'.$id.' .mk-main-ico {'.$border_css.'background-color:'.$icon_circle_color.';color:'.$icon_color.';}';        
        break;
    case 'simple_minimal':
        if ( $circled == 'true' ) {
            $border_css =  !empty( $icon_circle_border_color ) ? ( 'border:1px solid '.$icon_circle_border_color.';' ) : '';
            $app_styles .= '#box-icon-'.$id.' .mk-main-ico {'.$border_css.'color:'.$icon_color.';background-color:'.$icon_circle_color.'}';        
        } else {
            $app_styles .= '#box-icon-'.$id.' .mk-main-ico {color:'.$icon_color.'}';        
        }
        break;    
    case 'simple_ultimate' :
        
        $border_color = '';
        if($rounded_circle == 'true' && ($icon_size == 'small' || $icon_size == 'medium')) {
            $border_color = 'border-color:'.$icon_color;
        }
        $app_styles .= '#box-icon-'.$id.' .mk-main-ico {'.$border_color.';color:'.$icon_color.';}';        
    
        break;    
    
}



Mk_Static_Files::addCSS($app_styles, $id);