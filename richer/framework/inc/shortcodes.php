<?php

/*-----------------------------------------------------------------------------------*/
/*  Accordion
/*-----------------------------------------------------------------------------------*/
global $my_accordion_shortcode_count;
$my_accordion_shortcode_count = 0;

global $my_global_var;
$my_global_var = rand();
if(!function_exists('richer_accordion')){
  function richer_accordion($atts,$content) {
    extract(shortcode_atts(array(
      'open' => '1',
      'style' => 'style1'  
    ), $atts));

    // wordpress function 
    global $my_accordion_shortcode_count,$post,$my_global_var;

    $output = '<div class="accordion '.$style.'" rel="'.$open.'">';
      $output .= do_shortcode( $content );
    $output .= '</div>';

    $my_global_var++;
    return str_replace("\r\n", '',$output);
  }
}
if(!function_exists('richer_accordion_item')){
  function richer_accordion_item($atts, $content=null) {
    extract(shortcode_atts(array(
      'title' => '',
      'icon' => ''  
    ), $atts));

    if($icon != '') {
      $acc_icon_pos = 'fright';
      $icon = '<i class="icon fa '.$icon.'"></i>';
    } else {
      $acc_icon_pos = 'fleft';
      $icon = '';
    }
    
              
      $output = '<div class="acc-group"><div class="accordion-title"><div class="acc-icon '.$acc_icon_pos.'"><i class="fa fa-plus"></i></div><span>' . $icon . $title . '</span></div><div class="accordion-inner"><div class="content">' . do_shortcode($content) .'</div></div></div>';
      return $output;
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Alert
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_alert')){
  function richer_alert( $atts, $content = null) {
  extract( shortcode_atts( array(
        'type'  => 'warning',
        'close' => 'true',
        'icon' => '',
        'color' => '',
        'border_style' => '',
        'border_size' => '',
        'border_color' => '',
        'background_color' => ''
      ), $atts ) );
        
      if($close == 'false') {
        $var1 = '';
      }
      else{
        $var1 = '<span class="close fa fa-times" href="#"></span>';
      }
      if($icon != '') $icon = '<i class="fa '.$icon.'"></i>';
      if($type == 'custom') {
        if($color != '') $custom_css = 'color:'.$color.';';
        if($border_color != '') $custom_css .= 'border:'.$border_size.' '.$border_style.' '.$border_color.';';
        if($background_color != '') $custom_css .= 'background-color:'.$background_color.';';
        $custom_css = 'style="'.$custom_css.'"';
      }  else {
        $custom_css='';
      }
      return '<div class="alert-message '.$type.'" '.$custom_css.'>'.$icon . do_shortcode($content) . '' . $var1 . '<div class="clear"></div></div>';
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Br-Tag
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_br')){
  function richer_br() {
     return '<br />';
  }
}
/*-----------------------------------------------------------------------------------*/
/* Buttons 
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_buttons')){
  function richer_buttons( $atts, $content = null ) {
      extract(shortcode_atts(array(
        'link'     => '#',
        'size'     => 'medium',
        'target'   => '_self',
        'icon'     => '',
        'icon_pos' => '',
        'lightbox' => 'false', 
        'color'    => 'default',
        'style'    => 'normal',
        'align'    => ''
      ), $atts));
      if($icon != '') {
        if($icon_pos == 'left') {
          $icon_left = '<i class="fa '.$icon.' fa-left"></i>';
          $icon_right='';
        } elseif($icon_pos == 'right') {
          $icon_right = '<i class="fa '.$icon.' fa-right"></i>';
          $icon_left='';
        } else {
          $icon_right='';
          $icon_left='';
        }
      } else {
        $icon_right='';
        $icon_left='';
      }
      $center_pos_o = $center_pos_c = '';
      if($align=='center') {
        $center_pos_o = '<center>';
        $center_pos_c = '</center>';
      }
      if($lightbox == 'true') {
        $pretty = "prettyPhoto ";
        $rel = 'rel="slides[buttonlightbox]"';
      }
      else{
        $pretty = "";
        $rel = "";
      }
      
    $out = $center_pos_o.'<a href="'.$link.'" target="'.$target.'" class="button '.$pretty.' '.$color.' '.$size.' '.$style.' align'.$align.'" '.$rel.'>'.$icon_left.' ' .do_shortcode($content). ' '.$icon_right.'</a>'.$center_pos_c;
    if($align == 'right' ||  $align == 'left') {
      $out.='<div class="clearfix"></div>';
    }
      return $out;
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Icon
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_icon')){
  function richer_icon( $atts, $content = null ) {
    extract(shortcode_atts(array(
          'name' => '',
          'size' => '',
          'style' => '',
          'icon_color' => '',
          'icon_bg_color' => '',
          'icon_bor_color' => ''
      ), $atts));

    if(strrpos($name, "fa-") !== false) {
      $name='fa '.$name;
    }
    $css_style = '';
    if($icon_color != "") $css_style .= "color:".$icon_color.";";
    if($style != 'simple') {
      if($icon_bg_color != "") $css_style .= "background-color:".$icon_bg_color.";";
      if($icon_bor_color != "") $css_style .= "border-color:".$icon_bor_color.";";
    }

    $out = '<i class="icon '.$name.' '.$size.' '.$style.'" style="'.$css_style.'"></i>'; 
      
    return $out;
  }
}
/*-----------------------------------------------------------------------------------*/
/* Banner box
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_bannerbox')){
  function richer_bannerbox( $atts, $content = null) {
    extract( shortcode_atts( array(
        'bg_image'          => '',
        'bg_color'          => '',
        'bg_opacity'        => '0.8',
        'border_width'      => '1',
        'border_color'      => '',
        'border_opacity'    => '0.8',
        'outer_padding'     => '10',
        'inner_padding'     => '10',
        'min_height'        => '150',
        'text_align'        => 'center',
        'link'              => '',
        'target_blank'      => 'true'
        ), $atts ));
        $banner_link = '';
        if($bg_image != '') {
          $bg_image = sprintf( 'background-image: url(%s);', $bg_image );
        } else{
          $bg_image = "";
        }
        if($bg_color != '') {
          $bg_color_st = 'background-color: '.$bg_color.';';
          $bg_color_st .= 'background-color: rgba('.HexToRGB($bg_color).','.$bg_opacity.');';
        } else{
          $bg_color_st = "";
        }
        if($border_width > 0) {
          $border_style = 'border:'.$border_width.'px solid transparent;';
          $border_style .= 'border-color: rgba('.HexToRGB($border_color).','.$border_opacity.');';
          $border_style .= 'padding:'.$inner_padding.'px;';
        } else {
          $border_style = "";
          $border_style .= 'padding:'.$inner_padding.'px;';
        }
        $text_align = 'text-align:'.$text_align.';';
        $banner_min_height = 'min-height: ' . $min_height . 'px;';
        $banner_inner_height = $min_height - $inner_padding*2;
        $banner_inner_height = 'height: ' . $banner_inner_height . 'px;';
        $link_code = '';
        if ( $link != '') {
            if ( $target_blank == 'true') {
                $link_code = sprintf( ' onclick="window.open(\'%s\');"', $link );
            } else {
                $link_code= sprintf( ' onclick="window.location.href=\'%s\';"', $link );
            }
            $banner_link = 'banner_link';
        }
        
        $output = '<div class="banner '.$banner_link.'" style="'.$bg_image . $banner_min_height. $text_align.'padding:'.$outer_padding.'px;" '.$link_code.'>';
        $output .= '<div class="banner_border" style="'.$border_style.'">';
        $output .= '<div class="banner_bg" style="'.$bg_color_st. $banner_inner_height.'"><div>'. do_shortcode($content) .'</div></div>';
        $output .= '</div></div>';
        
        return $output;
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Clients
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_clients')){
  function richer_clients($atts, $content = null) {
    $output = '<script type="text/javascript">
              (function($){
                $(window).load(function() {
                  $("#flexslider-clients").flexslider({
                    animation: "slide",
                    smoothHeight : true,
                    directionNav: true,
                    controlNav: false,
                    touch: true,
                    itemWidth: 202,
                    itemMargin: 20,
                    minItems: 4,
                    maxItems: 5
                  });
                })})(jQuery)
            </script>';
    $output .= '<div id="flexslider-clients" class="clients"><ul class="slides">';
    $output .= do_shortcode($content);
    $output .= '</ul></div>';
  $output = wpautop($output, false);	
    return $output;
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Client
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_client')){
  function richer_client($atts, $content = null) {
    extract(shortcode_atts(array(
      'link' => '#',
      'logo_url' => ''
    ), $atts));

    $output = '<li><a href="'.$link.'" target="_blank"><img src="'.$logo_url.'" alt="" /></a></li>';
    return $output;
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Images
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_images')){
  function richer_images($atts, $content = null) {
    $output = '<script type="text/javascript">
              (function($){
                $(window).load(function() {
                $("#carousel").flexslider({
                  animation: "slide",
                  smoothHeight : false,
                  directionNav: true,
                  controlNav: false,
                  itemWidth: 258.75,
                  itemMargin: 20,
                  minItems: 2,
                  maxItems: 5
                });
              })})(jQuery);
            </script>';
    $output .= '<div id="carousel" class="flexslider-images"><ul class="slides">';
    $output .= do_shortcode($content);
    $output .= '</ul></div>';
    return $output;
  }
}
/*-----------------------------------------------------------------------------------*/
/* Images carousel
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_images_carousel')){
  function richer_images_carousel($atts, $content = null, $code) {
    wp_enqueue_script('owl-carousel');
    wp_enqueue_style('owl-carousel');
    extract(shortcode_atts(array(
      'images' => '',
      'lc_style' => 'bordered',
      'items' => '5',
      'navigation' => 'true',
      'autoplay' => 'false',
      'custom_links' => '',
      'onclick' => '',
      'target' => '_blank'
    ), $atts));

    static $carousel_id=0;
    if($lc_style == 'separated'){
      $itemsMargin = '0';
    } else {
      $itemsMargin = '24';
    }
    if($navigation == 'true') {
      $lc_style .= ' nav-enabled';
    }
    $output = '';
    if(!empty($images)){
      $output = '<script type="text/javascript">
        jQuery(document).ready(function($) {
          $("#images-carousel-'.++$carousel_id.'").owlCarousel({
              autoPlay: '.$autoplay.',
              items : '.$items.',
              itemsMargin : '.$itemsMargin.',
              itemsDesktop : [1199,4],
              itemsDesktopSmall : [979,3],
              navigation:'.$navigation.',
              navigationText:false,
              pagination:false,
              theme: "owl-images"
          });
        });
        </script>';    
      $output .= '<div id="images-carousel-'.$carousel_id.'" class="images '.$lc_style.'">';
      $images = explode( ',', $images );
      $custom_links = explode( ',', trim($custom_links) );
      $i = 0;
      $rand_id = rand(1,99);
      foreach ($images as $image_id) {
        switch ($onclick) {
          case 'link_image':
            $image_src = wp_get_attachment_image_src( $image_id, 'full' );
            $c_items[] = '<div class="item"><a href="'.$image_src[0].'" rel="prettyPhoto[group-'.$rand_id.']">'.wp_get_attachment_image( $image_id, 'span4' ).'</a></div>';
            break;
          case 'custom_link':
            if(!empty($custom_links) && isset( $custom_links[$i] ) && $custom_links[$i] != ''){
              $c_items[] = '<div class="item"><a href="'.$custom_links[$i++].'" target="'.$target.'">'.wp_get_attachment_image( $image_id, 'span4' ).'</a></div>';
            } else {
              $c_items[] = '<div class="item">'.wp_get_attachment_image( $image_id, 'span4' ).'</div>';
            }
            break;  
          default:
            $c_items[] = '<div class="item">'.wp_get_attachment_image( $image_id, 'span4' ).'</div>';
            break;
        }
      }
      $output .= implode( "\n", $c_items );
      $output .= '</div>';
      $output = wpautop($output, false);
    } 
    return $output;
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Image
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_image_item')){
  function richer_image_item($atts, $content = null) {
    extract(shortcode_atts(array(
      'lightbox' => 'yes',
      'image_url' => ''
    ), $atts));
    $prettyPhoto = '';
    if($lightbox == 'yes') {
      $link = $image_url;
      $prettyPhoto = 'prettyPhoto';
    } else {
      $link = '#';
    }
    $output = '<li>';
    $output .= '<a href="'.$link.'"  class="'.$prettyPhoto.'"><img src="'.$image_url.'" alt="" /></a>';
    $output .= '</li>';
    return $output;
  }  
}
/*-----------------------------------------------------------------------------------*/
/*  Google Font
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_calltoaction')){
  function richer_calltoaction( $atts, $content = null) {
  extract( shortcode_atts( array(
        'bg_color' => '',
        'border_color' => '',
        'border_width' => '',
        'button' => '',
        'buttonlabel' => '',
        'buttonsize' => '',
        'buttoncolor' => '',
        'buttonstyle' => '',
        'button_position' => '',
        'link' => '',
        'target_blank'  => '',
        'text_position' => '',
        'text_color' => ''
        ), $atts ) );
        $style='';
        if($target_blank=='no') {
          $target = '_self';
        } else {
          $target = '_blank';
        }
        $button_left_pos = $button_right_pos = '';
        if($bg_color != '') $style .='background-color:'.$bg_color.';';
        if($border_width != '') $style .='border:'.$border_width.'px solid transparent;';
        if($border_color != '') $style .='border-color:'.$border_color.';';
        if($text_color != '') $style .='color:'.$text_color.';';
        if($text_position != '') $style .='text-align:'.$text_position.';';
        if($button != 'no'){
          if($button_position == 'right'){
            $button_left_pos ='';
            $button_right_pos = '<div class="callout-button '.$button_position.'"><a class="button ' .$buttonsize. ' ' .$buttoncolor. ' ' .$buttonstyle. '" href="' .$link. '" target="' .$target. '">'.$buttonlabel.'</a></div>';
          } elseif($button_position == 'left') {
            $button_right_pos = '';
            $button_left_pos = '<div class="callout-button '.$button_position.'"><a class="button ' .$buttonsize. ' ' .$buttoncolor. ' ' .$buttonstyle. '" href="' .$link. '" target="' .$target. '">'.$buttonlabel.'</a></div>';
          } else {
            $button_left_pos = '';
            $button_right_pos = '<div class="callout-button '.$button_position.'"><a class="button ' .$buttonsize. ' ' .$buttoncolor. ' ' .$buttonstyle. '" href="' .$link. '" target="' .$target. '">'.$buttonlabel.'</a></div>';
          }
        }
        $output = '<div class="callout '.$button_position.'" style="'.$style.'">';
        $output .= $button_left_pos;
        $output .= '<div class="callout-content">'.do_shortcode($content).'</div>';
        $output .= $button_right_pos;
        $output .= '</div>';
        
        return $output;
  }
}
if(!function_exists('richer_box')){
  function richer_box( $atts, $content = null) {
  extract( shortcode_atts( array(
        'style' => '1'
        ), $atts ) );
        return '<div class="description clearfix style-' .$style. '">' . do_shortcode($content) . '</div>';
  }  
}
/*-----------------------------------------------------------------------------------*/
/*  Animation
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_animation')){
  function richer_animation( $atts, $content = null) {
  extract( shortcode_atts( array(
        'animation' => 'bottom-to-top'
        ), $atts ) );
        return '<div class="start_animation when_almost_visible ' .$animation. '">' . do_shortcode($content) . '</div>';
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Google Font
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_googlefont')){
  function richer_googlefont( $atts, $content = null) {
  extract( shortcode_atts( array(
          'font' => 'Swanky and Moo Moo',
          'size' => '42px',
          'margin' => '0px'
        ), $atts ) );
        
        $google = preg_replace("/ /","+",$font);
        
        return '<link href="http://fonts.googleapis.com/css?family='.$google.'" rel="stylesheet" type="text/css">
              <div class="googlefont" style="font-family:\'' .$font. '\', serif !important; font-size:' .$size. ' !important; margin: ' .$margin. ' !important;">' . do_shortcode($content) . '</div>';
  }
}
/*-----------------------------------------------------------------------------------*/
/*  HR Dividers
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_hr')){
  function richer_hr( $atts, $content = null) {
  extract( shortcode_atts( array(
        'style' => 'solid_light',
        'size' => '30'
        ), $atts ) );
        
      if($size == '') {
        $return = "";
      } else{
        $size = preg_replace('/[^0-9.]/', '', $size );
        $return = 'style="margin:'.($size/2).'px 0px !important;"';
      }
        
      return '<div class="hr ' .$style. '" ' .$return. '></div><div class="clearfix"></div>';  
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Gap Dividers
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_gap')){
  function richer_gap( $atts, $content = null) {
  extract( shortcode_atts( array(
        'height'  => '10'
        ), $atts ) );
        
        if($height == '') {
        $return = '';
      }
      else{
        $height = preg_replace('/[^0-9.]/', '', $height );
        $return = 'style="height: '.$height.'px;"';
      }
        
        return '<div class="gap" ' . $return . '></div>';
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Clear-Tag
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_clear')){
  function richer_clear() {  
      return '<div class="clearfix"></div>';  
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Code-Tag
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_code')){
  function richer_code($atts, $content) {
      $array = array (
          '[' => '&#91;', 
          ']' => '&#93;',
          '<' => '&#60;',
          '>' => '&#62;',
          '<p>' => ''
      );
      $out = strtr($content, $array);
      return "<pre>".$out."</pre>";  
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Columns
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_container')){
  function richer_container( $atts, $content = null ) {
     return '<div class="container">' . do_shortcode($content) . '</div>';
  }
}
if(!function_exists('richer_rowfluid')){
  function richer_rowfluid( $atts, $content = null ) {
     return '<div class="row-fluid">' . do_shortcode($content) . '</div>';
  }
}
if(!function_exists('richer_row')){
  function richer_row( $atts, $content = null ) {
     return '<div class="row">' . do_shortcode($content) . '</div>';
  }
}
if(!function_exists('richer_one_third')){
  function richer_one_third( $atts, $content = null ) {
     return '<div class="one_third">' . do_shortcode($content) . '</div>';
  }
}
if(!function_exists('richer_one_third_last')){
 function richer_one_third_last( $atts, $content = null ) {
     return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
  } 
}
if(!function_exists('richer_two_third')){
  function richer_two_third( $atts, $content = null ) {
     return '<div class="two_third">' . do_shortcode($content) . '</div>';
  }
}
if(!function_exists('richer_two_third_last')){
  function richer_two_third_last( $atts, $content = null ) {
    return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
  } 
}
if(!function_exists('richer_one_half')){
  function richer_one_half( $atts, $content = null ) {
     return '<div class="one_half">' . do_shortcode($content) . '</div>';
  }  
}
if(!function_exists('richer_one_half_last')){
  function richer_one_half_last( $atts, $content = null ) {
     return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
  }  
}
if(!function_exists('richer_one_fourth')){
  function richer_one_fourth( $atts, $content = null ) {
     return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
  }  
}
if(!function_exists('richer_one_fourth_last')){
  function richer_one_fourth_last( $atts, $content = null ) {
     return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
  }
}
if(!function_exists('richer_three_fourth')){
  function richer_three_fourth( $atts, $content = null ) {
     return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
  }  
}
if(!function_exists('richer_three_fourth_last')){
  function richer_three_fourth_last( $atts, $content = null ) {
    return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
  }
}
if(!function_exists('richer_one_fifth')){
  function richer_one_fifth( $atts, $content = null ) {
    return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
  } 
}
if(!function_exists('richer_one_fifth_last')){
  function richer_one_fifth_last( $atts, $content = null ) {
     return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
  }
}
if(!function_exists('richer_two_fifth')){
  function richer_two_fifth( $atts, $content = null ) {
    return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
  } 
}
if(!function_exists('richer_two_fifth_last')){
  function richer_two_fifth_last( $atts, $content = null ) {
    return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
  }  
}
if(!function_exists('richer_three_fifth')){
  function richer_three_fifth( $atts, $content = null ) {
    return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
  }
}
if(!function_exists('richer_three_fifth_last')){
  function richer_three_fifth_last( $atts, $content = null ) {
    return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
  }
}
if(!function_exists('richer_four_fifth')){
  function richer_four_fifth( $atts, $content = null ) {
    return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
  }
}
if(!function_exists('richer_four_fifth_last')){
  function richer_four_fifth_last( $atts, $content = null ) {
    return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
  }
}
if(!function_exists('richer_one_sixth')){
  function richer_one_sixth( $atts, $content = null ) {
    return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
  }
}
if(!function_exists('richer_one_sixth_last')){
  function richer_one_sixth_last( $atts, $content = null ) {
    return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
  }
}
if(!function_exists('richer_five_sixth')){
  function richer_five_sixth( $atts, $content = null ) {
    return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
  }
}
if(!function_exists('richer_five_sixth_last')){
  function richer_five_sixth_last( $atts, $content = null ) {
    return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
  }
}

// Grid Columns
if(!function_exists('richer_column')){
  function richer_column($atts, $content=null, $shortcodename ="")
  {   
    // add divs to the content
    $return = '<div class="'.$shortcodename.'">';
    $return .= do_shortcode($content);
    $return .= '</div>';

    return $return;
  }
}
/*-----------------------------------------------------------------------------------*/
/* Dropcap */
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_dropcap')){
  function richer_dropcap($atts, $content = null) {
      extract(shortcode_atts(array(
          'style'      => ''
      ), $atts));
      
      if($style == '') {
        $return = "";
      }
      else{
        $return = "dropcap-".$style;
      }
      
    $out = "<span class='dropcap ". $return ."'>" .$content. "</span>";
      return $out;
  }
}
/*-----------------------------------------------------------------------------------*/
/* Video */
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_video')){
  function richer_video($atts) {
    extract(shortcode_atts(array(
      'type'  => '',
      'id'  => '',
      'width'   => '',
      'height'  => '',
      'autoplay'  => ''
    ), $atts));
    global $options_data;
    if ($height && !$width) $width = intval($height * 16 / 9);
    if (!$height && $width) $height = intval($width * 9 / 16);
    if (!$height && !$width){
      $height = 315;
      $width = 560;
    }
    $width = preg_replace('/[^0-9.]/', '', $width );
    $height = preg_replace('/[^0-9.]/', '', $height );

    $autoplay = ($autoplay == 'yes' ? '1' : '0');
      
    if($type == "vimeo") $return = "<div class='video-embed'><div><iframe src='//player.vimeo.com/video/$id?autoplay=$autoplay&amp;title=0&amp;byline=0&amp;portrait=0&amp;color=".$options_data['color_accent']."' width='$width' height='$height' class='iframe'></iframe></div></div>";
    
    else if($type == "youtube") $return = "<div class='video-embed'><div><iframe src='//www.youtube.com/embed/$id?HD=1;rel=0;showinfo=0' width='$width' height='$height' class='iframe'></iframe></div></div>";
    
    else if($type == "dailymotion") $return ="<div class='video-embed'><div><iframe src='//www.dailymotion.com/embed/video/$id?width=$width&amp;autoPlay={$autoplay}&foreground=%23FFFFFF&highlight=%23CCCCCC&background=%23000000&logo=0&hideInfos=1' width='$width' height='$height' class='iframe'></iframe></div></div>";
      
    if (!empty($id)){
      return $return;
    }
  }
}
/*-----------------------------------------------------------------------------------*/
/* Google map */
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_map')){
  function richer_map($atts) {
    wp_enqueue_script( 'gmaps.api' );
    wp_enqueue_script( 'jquery.map' );

    extract(shortcode_atts(array(
      'address' => '',
      'type' => 'roadmap',
      'width' => '100%',
      'height' => '300px',
      'zoom' => '5',
      'scrollwheel' => 'false',
      'scale' => 'true',
      'zoom_pancontrol' => 'true',
    ), $atts));

    static $map_counter = 1;


    $addresses = explode('|', $address);

    $markers = '';
    foreach($addresses as $address_string) {
      $markers .= "{
        address: '".$address_string."',
        html: {
          content: '".$address_string."',
          popup: false
        } 
      },";  
    }

    
    $output = "<script type='text/javascript'>
    jQuery(document).ready(function($) {
      jQuery('#gmap-".$map_counter."').goMap({
        address: '".$addresses[0]."',
        zoom: ".$zoom.",
        scrollwheel: ".$scrollwheel.",
        scaleControl: ".$scale.",
        navigationControl: ".$zoom_pancontrol.",
        maptype: '".$type."',
        markers: [".$markers."]
      });
    });
    </script>";

    $output .= '<div class="shortcode-map" id="gmap-'.$map_counter.'" style="width:'.$width.';height:'.$height.';">';
    $output .= '</div>';

    $map_counter++;

    return $output;
  }
}
/*-----------------------------------------------------------------------------------*/
/* Iconbox
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_iconbox')){
  function richer_iconbox( $atts, $content = null ) {
    extract(shortcode_atts(array(
          'title' => '',
          'icon'      => '',
          'style' => '',
          'icon_color' => '',
          'icon_bg_color' => '',
          'icon_bor_color' => '#3498db',
          'text_align'  => 'left',
          'frame' =>  '',
          'iconbox_bg_color' => '',
          'url' => '',
          'target' => '_blank'
      ), $atts));

    $icon_type = '';
    $icon_style = '';

  if($iconbox_bg_color != ''){$iconbox_bg_color = 'background-color:'.$iconbox_bg_color; }  
  if($icon_color != '') {$icon_style .= 'color:'.$icon_color.';'; }
  if($icon_bg_color != '') {$icon_style .= ' background-color:'.$icon_bg_color.';'; }
  if($icon_bor_color != '') {$icon_style .= ' border-color:'.$icon_bor_color.';'; }
  if($url != '') {$url_open = '<a href="'.esc_url($url).'" target="'.$target.'">'; $url_close='</a>';} else {$url_close=''; $url_open='';}
  if($icon != '') {
    switch ($style) {
      case 'icon_with_title':
          $icon_style = 'color:'.$icon_color.';';
          $icon_type = '<div class="icon_with_title"><h3>'.$url_open.'<i class="icon fa '.$icon.'" style="'.$icon_style.'"></i>'.$title.$url_close.'</h3></div>';
        break;

      case 'mini_circle_icon_with_title':
          $icon_type = '<div class="icon_with_title"><h3>'.$url_open.'<i class="icon fa '.$icon.' circle mini" style="'.$icon_style.'"></i>'.$title.$url_close.'</h3></div>';
        break; 

      case 'top_icon_circle':
          $icon_type = '<div class="top_icon_circle aligncenter">'.$url_open.'<i class="icon fa '.$icon.' standard circle" style="'.$icon_style.'"></i>'.$url_close.'<h3>'.$title.'</h3></div>';
        break;

      case 'top_icon_circle_large':
          $icon_type = '<div class="top_icon_circle_large aligncenter">'.$url_open.'<i class="icon fa '.$icon.' large circle" style="'.$icon_style.'"></i>'.$url_close.'<h3>'.$title.'</h3></div>';
          $icon_type .= '<style type="text/css" >.iconbox:hover .top_icon_circle_large .icon:after { border-top-color:'.$icon_bor_color.' !important;}</style>';
        break;
   
      case 'top_icon_standard':
          $icon_style = 'color:'.$icon_color.';';
          $div_color = 'background-color:'.$icon_color.';';
          $icon_type = '<div class="top_icon_standard aligncenter">'.$url_open.'<i class="icon fa '.$icon.' medium simple" style="'.$icon_style.'"></i>'.$url_close.'<h3>'.$title.'</h3><span class="small_divider" style="'.$div_color.'"></span></div>';
        break;

      case 'top_icon_large':
          $icon_style = 'color:'.$icon_color.';';
          $div_color = 'background-color:'.$icon_color.';';
          $icon_type = '<div class="top_icon_standard aligncenter">'.$url_open.'<i class="icon fa '.$icon.' large simple" style="'.$icon_style.'"></i>'.$url_close.'<h3>'.$title.'</h3><span class="small_divider" style="'.$div_color.'"></span></div>';
        break;
      case 'aside_rounded_icon':
          $icon_type = '<div class="aside_rounded_icon alignleft"><i class="icon fa '.$icon.' standard rounded" style="'.$icon_style.'"></i></div><h3>'.$url_open.$title.$url_close.'</h3>';
        break; 
      case 'aside_circle_icon':
          $icon_type = '<div class="aside_circle_icon alignleft"><i class="icon fa '.$icon.' standard circle" style="'.$icon_style.'"></i></div><h3>'.$url_open.$title.$url_close.'</h3>';
        break;    
      default:
        $icon_style = 'color:'.$icon_color.';';
        $icon_type = '<div class="icon_with_title"><h3>'.$url_open.'<i class="icon fa '.$icon.'" style="'.$icon_style.'"></i>'.$title.$url_close.'</h3></div>';
        break;
    }
  } else {
    $icon_type = '<h3>'.$url_close.$title.$url_close.'</h3>';
  } 

      $out = '<div class="iconbox text_'.$text_align.' '.$frame.' '.$style.'" style="'.$iconbox_bg_color.'">'.$icon_type.'<div class="excerpt">'. do_shortcode($content) . '</div></div>';
      return $out;
  }
}

if(!function_exists('richer_iconbox_new')){
  function richer_iconbox_new( $atts, $content = null ) {
    extract(shortcode_atts(array(
          'title' => '',
          'icon'      => '',
          'iconbox_style' => '',
          'icon_style' => '',
          'icon_size' => '',
          'icon_color' => '',
          'icon_bg_color' => '',
          'icon_bor_color' => 'transparent',
          'text_align'  => 'left',
          'frame' =>  '',
          'iconbox_bg_color' => '',
          'url' => '',
          'target' => '_blank'
      ), $atts));

    $icon_type = '';
    $icon_css = '';
    $out = '';

  if($iconbox_bg_color != ''){$iconbox_bg_color = 'background-color:'.$iconbox_bg_color; }  
  if($icon_color != '') {$icon_css .= 'color:'.$icon_color.';'; }
  if($icon_bg_color != '') {$icon_css .= ' background-color:'.$icon_bg_color.';'; }
  if($icon_bor_color != '') {$icon_css .= ' border-color:'.$icon_bor_color.';'; }
  if($url != '') {$url_open = '<a href="'.esc_url($url).'" target="'.$target.'">'; $url_close='</a>';} else {$url_close=''; $url_open='';}
  if($icon != '') {
    switch ($iconbox_style) {
      case 'top_icon':
          $out = '<div class="iconbox top_icon text_'.$text_align.' '.$frame.'" style="'.$iconbox_bg_color.'">'.$url_open.'<i class="icon fa '.$icon.' '.$icon_style.' '.$icon_size.'" style="'.$icon_css.'"></i>'.$url_close.'<h3>'.$title.'</h3><div class="excerpt">'. do_shortcode($content) . '</div></div>';
        break;
      case 'aside_icon':
          $out = '<div class="iconbox aside_icon text_'.$text_align.' '.$frame.'" style="'.$iconbox_bg_color.'">'.$url_open.'<i class="icon fa '.$icon.' '.$icon_style.' '.$icon_size.'" style="'.$icon_css.'"></i>'.$url_close.'<div class="extra-wrap"><h3>'.$title.'</h3><div class="excerpt">'. do_shortcode($content) . '</div></div></div>';
        break;    
      default:
          $out = '<div class="iconbox icon_with_title-new text_'.$text_align.' '.$frame.'" style="'.$iconbox_bg_color.'"><div class="title_with_icon">'.$url_open.'<i class="icon fa '.$icon.' '.$icon_style.' '.$icon_size.'" style="'.$icon_css.'"></i>'.$url_close.'<h3>'.$title.'</h3></div><div class="excerpt">'. do_shortcode($content) . '</div></div>';
        break;
    }
  } else {
    $icon_type = '<h3>'.$url_close.$title.$url_close.'</h3>';
  } 
    return $out;
  }
}
/*-----------------------------------------------------------------------------------*/
/* Iconlist
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_iconlist')){
  function richer_iconlist( $atts, $content = null ) {
    extract(shortcode_atts(array(
      'iconcolor' => '',
      'iconsets'=> '',
      'iconbordercolor' => ''
    ), $atts));

    static $list_id = 1;
    $out = '';

    $out .= '<ul id="iconlist-'.$list_id.'" class="unstyled list list-icons">';
    $iconsets = !empty($iconsets) ? explode("\n", trim($iconsets)) : array(); 
    foreach($iconsets as $iconset) {
      $iconset = !empty($iconset) ? explode("|", trim($iconset)) : array();
      $out .= '<li>[icon name="'.$iconset[0].'" size="mini" icon_color="'.$iconcolor.'" icon_bor_color="'.$iconbordercolor.'"]'.htmlspecialchars_decode($iconset[1]).'</li>';
    }
    $out .= '</ul>';

    $out = do_shortcode($out);
    $list_id++;
    return $out;
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Lists
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_list')){
  function richer_list( $atts, $content = null ) {
    extract(shortcode_atts(array(
      'icon' => '',
      'iconcolor' => ''
    ), $atts));

    static $list_id = 1;
    $out = '';
    if($iconcolor != ''){
      $out = "<style type='text/css' >
      ul#list-".$list_id.".list li:before{color:{$iconcolor};}
      .rtl ul#list-".$list_id.".list li:after{color:{$iconcolor};}
      </style>";
    }
    if($icon != ''){
      $icon='list list-'.$icon;
    }
    $out .= str_replace('<ul>', '<ul id="list-'.$list_id.'" class="unstyled '.$icon.'">', $content);
    $out = str_replace('<li>', '<li>', $out);

    $out = do_shortcode($out);
    $list_id++;
    return $out;
  }
}
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_item')){
  function richer_item( $atts, $content = null ) {
    extract(shortcode_atts(array(
          'icon'      => ''
      ), $atts));
    $out = '<li>';
    if($icon!='') $out.='<i class="icon-'.$icon.'"></i>';
    $out .= do_shortcode($content) . '</li>';
    return $out;
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Member
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_member')){
  function richer_member( $atts, $content = null) {
  extract( shortcode_atts( array(
        'img'   => '',
        'name'  => '',
        'role'  => '',
        'member_url' => '',
        'text_align' => 'left',
        'twitter' => '',
        'facebook' => '',
        'pinterest' => '',
        'email' => '',
        'linkedin' => '',
        'youtube' => '',
        'googleplus' => '',
        'dribbble' => '',
        'xing' => '',
        'vimeo' => '',
        'github' => '',
        'tumblr' => '',
        'instagram' => '',
        'renren' => '',
        'weibo' => '',
        'flickr' => '',
        'skype' => ''
        ), $atts ) );
        
        if($img == '') {
        $return = "";
        } else{

        $img_var = wp_get_attachment_image_src($img,'span4');
        $img_src = $img_var ? $img_var[0] : $img;


        $return = "<div class='member-img'><img src='".$img_src."' alt='' /></div>";
        }
        $social_icons = '';

        if( $twitter != '' || $instagram != '' || $github != '' || $tumblr != '' || $vimeo != '' || $facebook != '' || $renren != '' || $weibo != '' || $skype != '' ||
            $flickr != '' || $pinterest != '' || $linkedin != '' || $email != '' || $youtube != '' || $googleplus != '' || $dribbble != '' || $xing != ''){
          $return5 = '<div class="member-social social-icons light "><ul class="unstyled">';
          $return6 = '</ul></div>';
          
          if($googleplus != '') {
            $social_icons .= '<li class="social-googleplus"><a href="' .esc_url($googleplus). '" target="_blank" title="Google Plus"><i class="fa fa-google-plus-square"></i></a></li>';
          }
          if($twitter != '') {
            $social_icons .= '<li class="social-twitter"><a href="' .esc_url($twitter). '" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>';
          }
          if($dribbble != '') {
            $social_icons .= '<li class="social-dribbble"><a href="' .esc_url($dribbble). '" target="_blank" title="Dribbble"><i class="fa fa-dribbble"></i></a></li>';
          }
          if($facebook != '') {
            $social_icons .= '<li class="social-facebook"><a href="' .esc_url($facebook). '" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>';
          } 
          if($linkedin != '') {
            $social_icons .= '<li class="social-linkedin"><a href="' .esc_url($linkedin). '" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>';
          }
          if($email != '') {
            $social_icons .= '<li class="social-email"><a href="mailto:'.$email.'" target="_blank" title="E-mail"><i class="fa fa-envelope"></i></a></li>';
          } 
          if($xing != '') {
            $social_icons .= '<li class="social-xing"><a href="'.esc_url($xing).'" target="_blank" title="Xing"><i class="fa fa-xing"></i></a></li>';
          }       
          if($pinterest != '') {
            $social_icons .= '<li class="social-pinterest"><a href="' .esc_url($pinterest). '" target="_blank" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>';
          }
          if($youtube != '') {
            $social_icons .= '<li class="social-youtube"><a href="' .esc_url($youtube). '" target="_blank" title="Youtube"><i class="fa fa-youtube"></i></a></li>';
          }
          if($github != '') {
            $social_icons .= '<li class="social-github"><a href="' .esc_url($github). '" target="_blank" title="Github"><i class="fa fa-github"></i></a></li>';
          }
          if($vimeo != '') {
            $social_icons .= '<li class="social-vimeo"><a href="' .esc_url($vimeo). '" target="_blank" title="Vimeo"><i class="fa fa-vimeo-square"></i></a></li>';
          }
          if($tumblr != '') {
            $social_icons .= '<li class="social-tumblr"><a href="' .esc_url($tumblr). '" target="_blank" title="Tumblr"><i class="fa fa-tumblr"></i></a></li>';
          }
          if($instagram != '') {
            $social_icons .= '<li class="social-instagram"><a href="' .esc_url($instagram). '" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>';
          }
          if($renren != '') {
            $social_icons .= '<li class="social-renren"><a href="' .esc_url($renren). '" target="_blank" title="Renren"><i class="fa fa-renren"></i></a></li>';
          }
          if($skype != '') {
            $social_icons .= '<li class="social-skype"><a href="skype:' .esc_url($skype). '" target="_blank" title="Skype"><i class="fa fa-skype"></i></a></li>';
          }
          if($weibo != '') {
            $social_icons .= '<li class="social-weibo"><a href="' .esc_url($weibo). '" target="_blank" title="Weibo"><i class="fa fa-weibo"></i></a></li>';
          }
          if($flickr != '') {
            $social_icons .= '<li class="social-flickr"><a href="' .esc_url($flickr). '" target="_blank" title="Flickr"><i class="fa sosa-flickr"></i></a></li>';
          }
        }  else {
          $social_icons = '';
          $return5 = ''; 
          $return6 = '';  
        }
        if($member_url != '') {
          $name = '<a href="'.$member_url.'">'.$name.'</a>';
        }   
        return '<div class="member" style="text-align:'.$text_align.';">' .$return.' 
          <div class="inner">
            <div class="name">' .$name. '</div>
            <div class="member-role">' .$role. '</div>
            <div class="member-description">' . do_shortcode($content) . '</div>'
            .$return5.$social_icons.$return6.
          '</div>
        </div>';
  }
}
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_progressbar')){
  function richer_progressbar( $atts, $content = null ) {
    extract(shortcode_atts(array(
          'percentage' => '0',
          'type'      => '',
          'filledcolor' => '#3597d3',
          'unfilledcolor' => '#efefef',
          'animated' => 'no',
          'striped' => ''
      ), $atts));
    // animated: yes or no
    switch ($animated) {
         case 'no':
        $bar_animated = '';
        break;
         case 'yes':
        $bar_animated = 'active';
        break;
      }
    $slim = '';
    $title_inside = '';
    $title_outside = '';
    $percentage = str_replace('%', '', $percentage);
    switch ($type) {
      case 'title-outside':
        $title_outside = '<div class="bar-title outside">'. do_shortcode($content) .'</div>';
        break;
      case 'slim-title-outside':
        $title_outside = '<div class="bar-title outside">'. do_shortcode($content) .'</div>';
        $slim = 'slim';
        break;
      default:
         $title_inside = '<div class="bar-title">'. do_shortcode($content) .'</div>';
        break;
    }
     $out = ''.$title_outside.'<div class="progressbar '.$bar_animated.' '.$slim.'" data-perc="' .$percentage. '" style="background-color:'.$unfilledcolor.'">';
     $out .='<div class="bar-percentage '.$striped.'" style="background-color:'.$filledcolor.'" data-original-title="'.$percentage.'%">'.$title_inside.'</div></div>';
      return $out;
  }
}
if(!function_exists('richer_progressbar_sets')){
  function richer_progressbar_sets( $atts, $content = null ) {
    extract(shortcode_atts(array(
          'features' => '',
          'type'      => '',
          'filledcolor' => '#3597d3',
          'unfilledcolor' => '#efefef',
          'animated' => 'no',
          'striped' => ''
      ), $atts));
    // animated: yes or no
    switch ($animated) {
         case 'no':
        $bar_animated = '';
        break;
         case 'yes':
        $bar_animated = 'active';
        break;
      }
    $slim = $out = '';
    $title_inside = '';
    $title_outside = '';
    $features = !empty($features) ? explode("\n", trim($features)) : array(); 
    foreach($features as $feature) {
      $feature_opt = !empty($feature) ? explode("|", trim($feature)) : array();
      switch ($type) {
        case 'title-outside':
          $title_outside = '<div class="bar-title outside">'. $feature_opt[1] .'</div>';
          break;
        case 'slim-title-outside':
          $title_outside = '<div class="bar-title outside">'. $feature_opt[1] .'</div>';
          $slim = 'slim';
          break;
        default:
           $title_inside = '<div class="bar-title">'. $feature_opt[1] .'</div>';
          break;
      }
      $percentage = preg_replace('/[^0-9.]/', '', $feature_opt[0]);
      $out .= ''.$title_outside.'<div class="progressbar '.$bar_animated.' '.$slim.'" data-perc="' .$percentage. '" style="background-color:'.$unfilledcolor.'">';
      $out .='<div class="bar-percentage '.$striped.'" style="background-color:'.$filledcolor.'" data-original-title="'.$percentage.'%">'.$title_inside.'</div></div>';
    }
    return $out;
  }
}
/*-----------------------------------------------------------------------------------*/
/* Counters (Circle)
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_counters_circle')){
  function richer_counters_circle($atts, $content = null) {
    $html = '<div class="counters-circle clearfix">';
    $html .= do_shortcode($content);
    $html .= '</div>';

    return $html;
  }
}
/*-----------------------------------------------------------------------------------*/
/* Circle counter */
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_counter_circle')){
  function richer_counter_circle($atts, $content = null) {
    global $options_data;
    wp_register_script('jquery.gauge', get_template_directory_uri() . '/framework/js/gauge.js', 'jquery', '1.0', TRUE);
    wp_enqueue_script( 'jquery.gauge' );
    
    extract(shortcode_atts(array(
      'filledcolor' => '',
      'unfilledcolor' => '',
      'value' => '70',
      'size' => '220'
    ), $atts));

    if(!$filledcolor) {
      $filledcolor = $options_data['color_accent'];
    }

    if(!$unfilledcolor) {
      $unfilledcolor = '#ededed';
    }
    static $counter_circle = 1;
      $out = "<script type='text/javascript'>
      jQuery(document).ready(function() {
        var opts = {
          lines: 12, // The number of lines to draw
          angle: 0.5, // The length of each line
          lineWidth: 0.05, // The line thickness
          colorStart: '{$filledcolor}',   // Colors
          colorStop: '{$filledcolor}',    // just experiment with them
          strokeColor: '{$unfilledcolor}',   // to see which ones work best for you
          shadowColor: '#ededed',
          generateGradient: false
        };
        var circle_{$counter_circle} = new Donut(document.getElementById('counter-circle-{$counter_circle}')).setOptions(opts);
        circle_{$counter_circle}.maxValue = 100; // set max gauge value
        circle_{$counter_circle}.animationSpeed = 70; // set animation speed (32 is default value)
        circle_{$counter_circle}.set({$value}); // set actual value
      });
      </script>";

    $out .= '<div class="counter-circle-wrapper">';
    $out .= '<canvas width="'.$size.'" height="'.$size.'" class="counter-circle" id="counter-circle-'.$counter_circle.'">';
    $out .= '</canvas>';
    $out .= '<div class="counter-circle-content"  style="width:'.$size.'px; height:'.$size.'px; line-height:'.$size.'px; margin-left:-'.($size/2).'px;">';
    $out .= do_shortcode($content);
    $out .= '</div>';
    $out .= '</div>';
    $counter_circle++;

    return $out;
  }
}
/*-----------------------------------------------------------------------------------*/
/* Counter box */
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_counter_box')){
  function richer_counter_box($atts, $content = null) {
    extract(shortcode_atts(array(
      'title' => '',
      'value' => '70',
      'color' => ''
    ), $atts));

    if($color != ''){
      $color='color:'.$color.';';
    }
    $out = '';
    $out .= '<div class="counter-info">';
      $out .= '<div class="counter-value">';
        $out .= '<span class="value" data-value="'.$value.'" style="'.$color.'">0</span>';
      $out .= '</div>';
      if($title != '') {
        $out .= '<div class="counter-title">';
          $out .= $title;
        $out .= '</div>';
      }
    $out .= '</div>';

    return $out;
  }
}
/*-----------------------------------------------------------------------------------*/
/* Pricing Table */
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_plan')){
  function richer_plan( $atts, $content = null ) {
      extract(shortcode_atts(array(
      'name'      => '',
      'link'      => '',
      'linkname'      => 'Select',
      'price'      => '',
      'per'      => '',
      'extra_height' => 'no',
      'color'    => '#71be3c',
      'features' => ''
      ), $atts));

      
      if($per != '') {
        $return3 = $per;
      }
      else{
        $return3 = "";
      }
      $return5 = "";
      if($color != '') {
        $return4 = "style='color:".$color.";' ";
        $return5 = "style='background-color:".$color.";' ";
      }
      else{
        $return4 = "";
        $return5 = "";
      }
      $extra='';
      if(!empty($features)){
        $output = '<ul>';
        $features = !empty($features) ? explode("\n", trim($features)) : array(); 
        foreach($features as $feature) {
          $output .= '<li>'.htmlspecialchars_decode($feature).'</li>';
        }
        $output .= '</ul>';
        $content = $output;
      }
       
    if($extra_height == 'yes') $extra = 'extra_height';
    $out = "<div class='plan'>";  
        
        if($name != '') {
          $out .="<div class='plan-head  ".$extra."' ".$return5.">".$name."</div>";
        } else {
           $out .="<div class='plan-head empty'></div>";
        }
        $out .= '<div class="border">';
        $out .="<div class='price'><div ".$return4.">".$price."<sub>".$return3."</sub></div></div>
          " .do_shortcode($content). "";
        if($link != '')  $out .="<div class='signup'><a class='button medium' ".$return5." href='".$link."'>".$linkname."<span></span></a></div>";
        $out .="</div>
      </div>";
      return $out;
  }
}
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_pricing')){
  function richer_pricing( $atts, $content = null ) {
      extract(shortcode_atts(array(
          'col'      => '',
          'style' => 'style1'
      ), $atts));
    
    $out = "<div class='pricing-table  ".$style." col-".$col."'><div class='border-m'>" .do_shortcode($content). "</div></div><div class='clearfix'></div>";
      return $out;
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Block & Pullquotes
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_blockquote')){
  function richer_blockquote( $atts, $content = null) {
  extract( shortcode_atts( array(), $atts ) );
        
    return '<blockquote><p>' . do_shortcode($content) . '</p></blockquote>';
  }
}
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_pullquote')){
  function richer_pullquote( $atts, $content = null ) {
      extract(shortcode_atts(array(
          'align' => 'left',
          'width' => '270'
      ), $atts));
      $style = '';
      if($width != '') $style = 'width:'.$width.'px;';
      return '<div class="pullquote align-'.$align.'" style="'.$style.'">' . do_shortcode($content) . '</div>';
  }
}
/*-----------------------------------------------------------------------------------*/
/* Responsive Images 
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_responsive')){
  function richer_responsive( $atts, $content = null ) {
      extract(shortcode_atts(array(), $atts));
    
    return '<span class="responsive">' . do_shortcode($content) . '</span>';
  }
}
/*-----------------------------------------------------------------------------------*/
/* Responsive Visibility 
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_responsivevisibility')){
  function richer_responsivevisibility( $atts, $content = null) {
  extract( shortcode_atts( array(
        'show' => 'desktop'
        ), $atts ) );
        return '<div class="visibility-' . $show . '">' . do_shortcode($content) . '</div>';
  }
}
/*-----------------------------------------------------------------------------------*/
/* Social Icons 
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_socials')){
  function richer_socials( $atts, $content = null) {
  extract( shortcode_atts( array(
        'twitter'   => '',
        'forrst'  => '',
        'dribbble'  => '',
        'flickr'    => '',
        'facebook'  => '',
        'skype'   => '',
        'digg'  => '',
        'google_plus'  => '',
        'linkedin'  => '',
        'vimeo'  => '',
        'instagram' => '',
        'yahoo'  => '',
        'tumblr'  => '',
        'youtube'  => '',
        'picasa'  => '',
        'deviantart'  => '',
        'behance'  => '',
        'pinterest'  => '',
        'paypal'  => '',
        'delicious'  => ''
        ), $atts ) );

        $out = '
        <div class="social-icons">
          <ul class="unstyled">';
          foreach ($atts as $key => $value) {
            switch ($key) {
              case 'twitter':
                if($twitter != "") {
                  $out .= '<li class="social-twitter"><a href="http://www.twitter.com/'.$twitter.'" target="_blank" title="'.__( 'Twitter', 'richer').'"><i class="fa fa-twitter"></i></a></li>';
                }
                break;
              case 'facebook':
                if($facebook != "") {
                  $out .= '<li class="social-facebook"><a href="'.esc_url($facebook).'" target="_blank" title="'.__( 'Facebook', 'richer').'"><i class="fa fa-facebook"></i></a></li>';
                }
              case 'forrst':
                if($forrst != "") {
                  $out .= '<li class="social-forrst"><a href="'.esc_url($forrst).'" target="_blank" title="'.__( 'Forrst', 'richer').'"><i class="fa icon-forrst"></i></a></li>';
                }
                break;
              case 'yahoo':
                if($yahoo != "") {
                  $out .= '<li class="social-yahoo"><a href="'.esc_url($yahoo).'" target="_blank" title="'.__( 'Yahoo', 'richer').'"><i class="fa fa-yahoo"></i></a></li>';
                }
                break;
              case 'vimeo':
                if($vimeo != "") {
                  $out .= '<li class="social-vimeo"><a href="'.esc_url($vimeo).'" target="_blank" title="'.__( 'Vimeo', 'richer').'"><i class="fa fa-vimeo-square"></i></a></li>';
                }
                break;
              case 'linkedin':
                if($linkedin != "") {
                  $out .= '<li class="social-linkedin"><a href="'.esc_url($linkedin).'" target="_blank" title="'.__( 'LinkedIn', 'richer').'"><i class="fa fa-linkedin"></i></a></li>';
                }
                break;
              case 'google_plus':
                if($google_plus != "") {
                  $out .= '<li class="social-googleplus"><a href="'.esc_url($google_plus).'" target="_blank" title="'.__( 'Google plus', 'richer').'"><i class="fa fa-google-plus"></i></a></li>';
                }
                break;
              case 'instagram':
                  if($instagram != '') {
                    $out .= '<li class="social-instagram"><a href="' .esc_url($instagram). '" target="_blank" title="'.__( 'Instagram', 'richer').'"><i class="fa fa-instagram"></i></a></li>';
                  }
                  break;  
              case 'digg':
                if($digg != "") {
                  $out .= '<li class="social-digg"><a href="'.esc_url($digg).'" target="_blank" title="'.__( 'Digg', 'richer').'"><i class="fa fa-digg"></i></a></li>';
                }
                break;
              case 'skype':
                if($skype != "") {
                  $out .= '<li class="social-skype"><a href="skype:'.$skype.'?call" title="'.__( 'Skype', 'richer').'"><i class="fa fa-skype"></i></a></li>';
                }
                break;
              case 'flickr':
                if($flickr != "") { 
                  $out .= '<li class="social-flickr"><a href="'.esc_url($flickr).'" target="_blank" title="'.__( 'Flickr', 'richer').'"><i class="fa sosa-flickr"></i></a></li>';
                }
                break;
              case 'dribbble':
                if($dribbble != "") {
                  $out .= '<li class="social-dribbble"><a href="'.esc_url($dribbble).'" target="_blank" title="'.__( 'Dribbble', 'richer').'"><i class="fa fa-dribbble"></i></a></li>';
                }
                break;
              case 'tumblr':
                if($tumblr != "") {
                  $out .= '<li class="social-tumblr"><a href="'.esc_url($tumblr).'" target="_blank" title="'.__( 'Tumblr', 'richer').'"><i class="fa fa-tumblr"></i></a></li>';
                }
                break;
              case 'youtube':
                if($youtube != "") {
                  $out .= '<li class="social-youtube"><a href="'.esc_url($youtube).'" target="_blank" title="'.__( 'YouTube', 'richer').'"><i class="fa fa-youtube"></i></a></li>';
                }
                break;
              case 'picasa':
                if($picasa != "") {
                  $out .= '<li class="social-picasa"><a href="'.esc_url($picasa).'" target="_blank" title="'.__( 'Picasa', 'richer').'"><i class="fa icon-picasa"></i></a></li>';
                }
                break;
              case 'deviantart':
                if($deviantart != "") {
                  $out .= '<li class="social-deviantart"><a href="'.esc_url($deviantart).'" target="_blank" title="'.__( 'DeviantArt', 'richer').'"><i class="fa fa-deviantart"></i></a></li>';
                }
                break;
              case 'behance':
                if($behance != "") {
                  $out .= '<li class="social-behance"><a href="'.esc_url($behance).'" target="_blank" title="'.__( 'Behance', 'richer').'"><i class="fa fa-behance"></i></a></li>';
                }
                break;
              case 'pinterest':
                if($pinterest != "") {
                  $out .= '<li class="social-pinterest"><a href="'.esc_url($pinterest).'" target="_blank" title="'.__( 'Pinterest', 'richer').'"><i class="fa fa-pinterest"></i></a></li>';
                }
                break;
              case 'paypal':
                if($paypal != "") {
                  $out .= '<li class="social-paypal"><a href="'.esc_url($paypal).'" target="_blank" title="'.__( 'PayPal', 'richer').'"><i class="fa icon-paypal"></i></a></li>';
                }
                break;
              case 'delicious':
                if($delicious != "") {
                  $out .= '<li class="social-delicious"><a href="'.esc_url($delicious).'" target="_blank" title="'.__( 'Delicious', 'richer').'"><i class="fa fa-delicious"></i></a></li>';
                }
                break;
              default:
                # code...
                break;
            }
          }
          $out .= '</ul>
        <div class="clear"></div></div>';
        return $out;
  }
}
/*-----------------------------------------------------------------------------------*/
/* Styled Tables
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_table')){
  function richer_table( $atts, $content = null) {
  extract( shortcode_atts( array(
        'style'   => ''
        ), $atts ) );
        if($style != '' && ($style=='1' || $style=='2' || $style=='3')) {
          $style='custom-table-'.$style;
        } else {
          $style='';
        }
        return '<div class="custom-table ' . $style . '">' . do_shortcode($content) . '</div>';
  }
}
/*-----------------------------------------------------------------------------------*/
/* Testimonial
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_testimonial')){
  function richer_testimonial( $atts, $content = null) {
  extract( shortcode_atts( array(
        'testi_slug' => '',
        'type' => '',
        'num' => '-1',
        'excerpt_count' => '18',
        'disp_as_list' => 'no'
        ), $atts ) );

        global $post;
        $args = array(
          'post_type' => 'testi',
          'posts_per_page' => $num,
          'orderby' => 'post_date',
          'order' => 'DESC',
          'name' => $testi_slug
        );
        if($testi_slug != '') $num='-1';
        $col = '';
        if($num != '-1') {
          switch ($num) {
            case '2':
              $col = 'span6';
              break;
            case '3':
              $col = 'span4';
              break;
            case '4':
              $col = 'span3';
              break;
            default:
              $col = 'span3';
              break;
          }
        }
        if($testi_slug != '' || $disp_as_list == 'yes') $col='';

        query_posts( $args );
        $output = '';
        static $testi_id=0;
        ++$testi_id;
        if(have_posts()) {
          if(($num < 0 || $num > 3) ){
            wp_enqueue_script('isotope-js');
            $output .= "<script type='text/javascript'>
            (function($){
              $(window).load(function(){
              var container = $('#testi-wrap-".$testi_id."');
              // initialize isotope
              container.isotope({
                animationEngine : 'best-available',
                  animationOptions: {
                    duration: 200,
                    easing: 'easeInOutQuad',
                    queue: false
                  }
              });
              $(window).resize(function() {
                container.isotope('reLayout');
              });
            })})(jQuery);
            </script>";
            
          }
          if($num < 0 || $num > 3) { $output .= '<div id="testi-wrap-'.$testi_id.'">';}
          while(have_posts()) {
            the_post();
            $custom = get_post_custom($post->ID);
            $testiname = $custom["richer_testi_caption"][0];
            if(isset($custom["richer_testi_url"][0])) {$testiurl = esc_url($custom["richer_testi_url"][0]);}else {$testiurl='';}
            $testiinfo = $custom["richer_testi_info"][0];

            if($testiname != '' && $type == 'thumb-side') {
              $testiname = '- '.$testiname;
            }
            if($testiurl != '') {
              $testiurl_open = '<a href="'.$testiurl.'">';
              $testiurl_close = '</a>';
            } else {
              $testiurl_open = '';
              $testiurl_close = '';
            }
            if($testiinfo != '' && $type == 'bordered-with-thumb') {
              $testiinfo = '<span>'.$testiinfo.'</span>';
            } else {
              $testiinfo = ', <span>'.$testiinfo.'</span>';
            }

            $excerpt = get_the_content();
            $attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'mini' );
            $url = $attachment_url['0'];
            $image = $url;
            switch ($type) {
              case 'thumb-side':
                $output .= '<div class="testimonial thumb-side '.$col.'">';        
                  $output .= '<div class="testimonial-author">';
                  if ( has_post_thumbnail($post->ID) ){
                    $output .= '<figure class="featured-thumbnail">';
                    $output .= $testiurl_open.'<img  src="'.$image.'" alt="'.get_the_title($post->ID).'" />'.$testiurl_close;
                    $output .= '</figure>';
                  }
                  $output .= '</div>';
                  $output .= '<div class="wrapper"><div class="excerpt">'.my_string_limit_words($excerpt,$excerpt_count).'</div>';  
                  $output .= '<div class="user">'.$testiname.$testiinfo.'</div></div><div class="clearfix"></div>';
                $output .= '</div>';
                break;
              case 'thumb-bottom':
                $output .= '<div class="testimonial thumb-bottom '.$col.'">';       
                  $output .= '<div class="excerpt">'.my_string_limit_words($excerpt,$excerpt_count).'</div>'; 
                  $output .= '<div class="testimonial-author">';
                  if ( has_post_thumbnail($post->ID) ){
                    $output .= '<figure class="featured-thumbnail">';
                    $output .= $testiurl_open.'<img  src="'.$image.'" alt="'.get_the_title($post->ID).'" />'.$testiurl_close;
                    $output .= '</figure>';
                  }
                  $output .= '</div>'; 
                  $output .= '<div class="user">'.$testiname.$testiinfo.'</div><div class="clearfix"></div>';
                $output .= '</div>';
                break;
              case 'bordered-with-thumb':
                $output .= '<div class="testimonial bordered-with-thumb '.$col.'">';
                  $output .= '<div class="inner">';       
                    $output .= '<div class="excerpt">'.my_string_limit_words($excerpt,$excerpt_count).'</div>'; 
                  $output .= '</div>';
                  $output .= '<div class="testimonial-author">';
                  if ( has_post_thumbnail($post->ID) ){
                    $output .= '<figure class="featured-thumbnail">';
                    $output .= $testiurl_open.'<img  src="'.$image.'" alt="'.get_the_title($post->ID).'" />'.$testiurl_close;
                    $output .= '</figure>';
                  }
                  $output .= '<div class="user">'.$testiname.'</div>'.$testiinfo.'<div class="clearfix"></div>';
                  $output .= '</div>';  
                $output .= '</div>';
                break;
              default:
                $output .= '<div class="testimonial default '.$col.'">';        
                  $output .= '<div class="excerpt">'.my_string_limit_words($excerpt,$excerpt_count).'</div>';  
                  $output .= '<div class="user">'.$testiurl_open.$testiname.$testiurl_close.$testiinfo.'</div>';
                $output .= '</div>';
                break;
            }
          }
          if($num < 0 || $num > 3) { $output .= '</div>'; }
        } 
        wp_reset_query();
      return $output;
  }
}
/**
 * Carousel
 *
 */
if(!function_exists('richer_testimonial_carousel')){
  function richer_testimonial_carousel($atts, $content = null) {
  extract(shortcode_atts(array(
          'num' => '3',
          'type' => '',
          'thumb' => 'true',        
          'excerpt_count' => '34'
      ), $atts)); 
        global $post;
        global $my_string_limit_words;
        $args = array(
          'post_type' => 'testi',
          'posts_per_page' => $num,
          'orderby' => 'post_date',
          'order' => 'DESC'
        );
        query_posts( $args );
        if(have_posts()) {
          $output = '<script type="text/javascript">
              (function($){
                $(window).load(function() {
                $("#flexslider-testimonial").flexslider({
                  animation: "slide",
                  smoothHeight : true,
                  directionNav: false,
                  controlNav: true,
                  itemMargin: 20
                });
              })})(jQuery)
            </script>';
      $output .= '<div id="flexslider-testimonial" class="flexslider">';
        $output .= '<ul class="slides">';
          while(have_posts()) {

          the_post();
          $custom = get_post_custom($post->ID);
          $testiname = $custom["richer_testi_caption"][0];
          if(isset($custom["richer_testi_url"][0])) {$testiurl = $custom["richer_testi_url"][0];}else{$testiurl='';}
          $testiinfo = $custom["richer_testi_info"][0];
          if($testiname != '' && $type == 'thumb-side') {
              $testiname = '- '.$testiname;
            }
          if($testiurl != '') {
            $testiurl_open = '<a href="'.$testiurl.'">';
            $testiurl_close = '</a>';
          } else {
            $testiurl_open = '';
            $testiurl_close = '';
          }
          if($testiinfo != '' && $type == 'bordered-with-thumb') {
              $testiinfo = '<span>'.$testiinfo.'</span>';
            } else {
              $testiinfo = ', <span>'.$testiinfo.'</span>';
            }
          $excerpt = get_the_content();
          $attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
          $url = $attachment_url['0'];
          $image = $url;

          $output .= '<li>';
          switch ($type) {
              case 'thumb-side':
                $output .= '<div class="testimonial thumb-side">';        
                  $output .= '<div class="testimonial-author">';
                  if ( has_post_thumbnail($post->ID) ){
                    $output .= $testiurl_open.'<figure class="featured-thumbnail">';
                    $output .= '<img  src="'.$image.'" alt="'.get_the_title($post->ID).'" />';
                    $output .= '</figure>'.$testiurl_close;
                  }
                  $output .= '</div>';
                  $output .= '<div class="wrapper"><div class="excerpt">'.my_string_limit_words($excerpt,$excerpt_count).'</div>';  
                  $output .= '<div class="user">'.$testiname.$testiinfo.'</div></div><div class="clearfix"></div>';
                $output .= '</div>';
                break;
              case 'thumb-bottom':
                $output .= '<div class="testimonial thumb-bottom">';       
                  $output .= '<div class="excerpt">'.my_string_limit_words($excerpt,$excerpt_count).'</div>'; 
                  $output .= '<div class="testimonial-author">';
                  if ( has_post_thumbnail($post->ID) ){
                    $output .= $testiurl_open.'<figure class="featured-thumbnail">';
                    $output .= '<img  src="'.$image.'" alt="'.get_the_title($post->ID).'" />';
                    $output .= '</figure>'.$testiurl_close;
                  }
                  $output .= '</div>'; 
                  $output .= '<div class="user">'.$testiname.$testiinfo.'</div><div class="clearfix"></div>';
                $output .= '</div>';
                break;
              case 'bordered-with-thumb':
                $output .= '<div class="testimonial bordered-with-thumb">';
                  $output .= '<div class="inner">';       
                    $output .= '<div class="excerpt">'.my_string_limit_words($excerpt,$excerpt_count).'</div>'; 
                  $output .= '</div>';
                  $output .= '<div class="testimonial-author">';
                  if ( has_post_thumbnail($post->ID) ){
                    $output .= $testiurl_open.'<figure class="featured-thumbnail">';
                    $output .= '<img  src="'.$image.'" alt="'.get_the_title($post->ID).'" />';
                    $output .= '</figure>'.$testiurl_close;
                  }
                  $output .= '<div class="user">'.$testiname.'</div>'.$testiinfo.'<div class="clearfix"></div>';
                  $output .= '</div>';  
                $output .= '</div>';
                break;
              default:
                $output .= '<div class="testimonial default">';        
                  $output .= '<div class="excerpt">'.my_string_limit_words($excerpt,$excerpt_count).'</div>';  
                  $output .= '<div class="user">'.$testiname.$testiinfo.'</div>';
                $output .= '</div>';
                break;
            }
          $output .= '</li>';
          }
        }
        $output .= '</ul>';
      $output .= '</div>';
      wp_reset_query();
      return $output;
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Latest Projects
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_portfolio')){
  function richer_portfolio($atts){
    extract(shortcode_atts(array(
          'layout' => 'grid',
          'slideshow' => 'false',
          'number_posts' => '4',
          'columns' => '4',
          'cat_slug' => '',
          'filter' => 'no',
          'filter_pos' => 'left',
          'excerpt_count' => 15,
          'show_title' => 'yes',
          'show_hover' => 'yes',
          'loadmore_btn' => 'no',
          'loadmore_btn_text' => 'Load more'

      ), $atts)); 
    global $post;
    static $folio_id=0;
    ++$folio_id;
    if ( is_front_page() ) {
      $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    } else {
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }

    $args = array(
      'post_type' => 'portfolio',
      'posts_per_page' => $number_posts,
      'paged' => $paged,
      'order'          => 'DESC',
      'orderby'        => 'date',
      'post_status'    => 'publish'
      );

    if($columns == '3'){
      $cols = 'span4';
      $item_width = '370';
    }
    elseif($columns == '2'){
      $cols = 'span6';
      $item_width = '460';
    }
    elseif($columns == '6'){
      $cols = 'span2';
      $item_width = '200';
    }
    elseif($columns == '5'){
      $cols = 'one_fifth';
      $item_width = '240';
    }
    else {
      $cols = 'span3';
      $item_width = '292';
    }
    if($cat_slug != '' && $cat_slug != 'all'){

      // string to array
      $arr = explode(',', $cat_slug);
      //var_dump($arr);
      
    $args['tax_query'][] = array(
      'taxonomy'  => 'portfolio_filter',
      'field'   => 'slug',
      'terms'   => $arr
    );
  }

  if($filter == 'yes' && $cat_slug == ''){
    wp_enqueue_script('isotope-js');
    $filter_out = "<script type='text/javascript'>
    (function($){
    $(window).load(function(){
    var container = $('#portfolio-wrap-".$folio_id."');
    // initialize isotope
    container.isotope({
      animationEngine : 'best-available',
        animationOptions: {
          duration: 200,
          easing: 'easeInOutQuad',
          queue: false
        }
    });
    $(window).resize(function() {
      container.isotope('reLayout');
    });
    
    // filter items when filter link is clicked
    $('#filters.filter-".$folio_id." a').click(function(){
      $('#filters a').removeClass('active');
      $(this).addClass('active');
      var selector = $(this).attr('data-filter');
        container.isotope({ filter: selector });
        return false;
    });
  });})(jQuery)</script>";
    $filter_out .= '<div class="container"><div class="span12"><div id="filters" class="filter-'.$folio_id.' '.$filter_pos.'">';
    $portfolio_filters = get_terms("portfolio_filter");
      if($portfolio_filters){
        $filter_out .= '<ul class="filters-list clearfix">';
          $filter_out .= '<li><a href="#" data-filter="*" class="active">'.__('All', 'richer').'</a></li>';  
          foreach($portfolio_filters as $portfolio_filter):
              $filter_out .= '<li><a href="#" data-filter=".term-'.$portfolio_filter->slug.'">'.$portfolio_filter->name.'</a></li>';
          endforeach;
        $filter_out .= '</ul>';
      }
    $filter_out .= '</div></div></div>';
  } else {
    $filter_out = '';
  }   

  $randomid = rand();
  $out = '';
  query_posts( $args );
  if($layout == 'grid-with-shadow') {
    $extra_class = 'portfolio-item-shadow';
  } else {
    $extra_class = '';
  }
  switch ($layout) {
    case 'carousel':
    case 'fullwidth-carousel':
      if($layout == 'fullwidth-carousel') {
        $maxItems = 'maxItems: 5';
        $directionNav = 'false';
      } else {
        $maxItems = 'maxItems: 4';
        $directionNav = 'true';
      }
      if( have_posts() ) {
        $out .= '<script type="text/javascript">
        (function($) {
        $(window).load(function() {
          $("#flexslider-portfolio").flexslider({
            animation: "slide",
            slideshow: '.$slideshow.',
            animationLoop:false,
            smoothHeight : true,
            directionNav: '.$directionNav.',
            controlNav: false,
            itemWidth: '.$item_width.',
            itemMargin: 0,
            minItems: 3,
            move: 1,
            '.$maxItems.'
          });
        });
})(jQuery);
        </script>';
        $out .= '<div id="flexslider-portfolio">'; 
        $out .= '<ul class="slides">';
        while ( have_posts() ) : the_post();
        $randomid = rand ();
        $out .= '<li><div class="portfolio-item no-margin">';     
        
          if ( has_post_thumbnail()) {
              $portfolio_thumbnail= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'span4' );
              $out .= '<div class="portfolio-pic">';
              $out .= '<img src="'.$portfolio_thumbnail[0].'" />';
              if($show_hover != 'no') {
                $out .= '<div class="portfolio-overlay">';
                $out .= overlay_link($randomid);
                $out .= '</div>';
              }
              $out .= '</div>';
          } else if (get_post_meta( get_the_ID(), 'richer_embed', true ) != '') {  
              if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'vimeo') {  
                  $out .= '<div id="portfolio-video"><div><iframe src="//player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="470" height="340" style="border-width:0px" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';  
              }  
              else if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'youtube') {  
                  $out .= '<div id="portfolio-video"><div><iframe width="470" height="340" src="//www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?rel=0&amp;showinfo=0&amp;modestbranding=1&amp;hd=1&amp;autohide=1&amp;color=white" style="border-width:0px" allowfullscreen></iframe></div></div>';  
              }  
              else {  
                  $out .= '<div id="portfolio-video"><div>'.get_post_meta( get_the_ID(), 'richer_embed', true ).'</div></div>';
              }  
          } else {
              $portfolio_thumbnail= wp_get_attachment_image_src( 5072, 'span4' ); 
              $out .= '<div class="portfolio-pic">';
              $out .= '<img src="'.$portfolio_thumbnail[0].'" />';
              if($show_hover != 'no') {
                $out .= '<div class="portfolio-overlay">';
                $out .= overlay_link($randomid);
                $out .= '</div>';
              }
              $out .= '</div>';
          }
            if($show_title != 'no') {
              $out .= '<div class="portfolio-title">';
              $out .= '<a href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a>'; 
              $out .= '</div>';
            }
          $out .='</div></li>';
        
      endwhile;
      
      $out .='</ul></div>';
      }
      
      break;
    case 'grid-with-excerpts':
      $no_margin = '';
      if(have_posts()){
        $out .= $filter_out;
        $out .= '<div class="row"><div id="portfolio-wrap-'.$folio_id.'">';
          while ( have_posts() ) : the_post();
          $randomid = rand();
          $terms = get_the_terms( $post->ID, 'portfolio_filter' );
          $terms_class = '';
          if($terms != '') { 
            foreach ($terms as $term) { $terms_class .='term-'.$term->slug.' '; } 
          }
          $out .= '<div class="portfolio-item '.$terms_class.$cols.' portfolio-with-excerpts">';     
          if ( has_post_thumbnail()) {
              $portfolio_thumbnail= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'span4' );
              $out .= '<div class="portfolio-pic">';
              $out .= '<img src="'.$portfolio_thumbnail[0].'" />';
              if($show_hover != 'no') {
                $out .= '<div class="portfolio-overlay">';
                $out .= overlay_link($randomid);
                $out .= '</div>';
              }
              $out .= '</div>';
          } else if (get_post_meta( get_the_ID(), 'richer_embed', true ) != '') {  
              if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'vimeo') {  
                  $out .= '<div id="portfolio-video"><div><iframe src="//player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="470" height="340" style="border-width:0px" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';  
              }  
              else if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'youtube') {  
                  $out .= '<div id="portfolio-video"><div><iframe width="470" height="340" src="//www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?rel=0&amp;showinfo=0&amp;modestbranding=1&amp;hd=1&amp;autohide=1&amp;color=white" style="border-width:0px" allowfullscreen></iframe></div></div>';  
              }  
              else {  
                  $out .= '<div id="portfolio-video"><div>'.get_post_meta( get_the_ID(), 'richer_embed', true ).'</div></div>';
              }  
          } else {
              $portfolio_thumbnail= wp_get_attachment_image_src( 5072, 'span4' ); 
              $out .= '<div class="portfolio-pic">';
              $out .= '<img src="'.$portfolio_thumbnail[0].'" />';
              if($show_hover != 'no') {
                $out .= '<div class="portfolio-overlay">';
                $out .= overlay_link($randomid);
                $out .= '</div>';
              }
              $out .= '</div>';
          }
          $out .= '<div class="portfolio-content">';
          $out .= '<a class="title" href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a>';
          $out .= my_string_limit_words(get_the_excerpt(),$excerpt_count); 
          $out .= '</div>';
          $terms = get_the_terms( $post->ID, 'portfolio_filter');
          if ( $terms && !is_wp_error( $terms ) ) {
            $terms_out = array();
            $out .= '<div class="portfolio-terms">';
            foreach ( $terms as $term )
              $terms_out[] = '<a href="' .get_term_link($term->slug, 'portfolio_filter') .'">'.$term->name.'</a>';
            $out.= join( ' ', $terms_out );
            $out .= '</div>';
          }
          $out .='</div>';
        endwhile;
        $out .= '</div>';
        if ( $loadmore_btn == 'yes' ) {
          $out .= '<div class="pagination portfolio span12 display"><a class="button default medium loadmore">'.$loadmore_btn_text.'</a><div style="display:none;">'.pagination().'</div></div>';
        }
        $out.='</div>';
      }
      break;
    case 'grid':
    case 'grid-with-margins':
    case 'grid-masonry':
      if($layout == 'grid-with-margins' || $layout == 'grid-with-shadow') {
        $no_margin = '';
      } else {
        $no_margin = 'no-margin';
      }
      if(have_posts()){
        $out .= $filter_out;
        $out .= '<div class="row '.$no_margin.'"><div id="portfolio-wrap-'.$folio_id.'">';
          while ( have_posts() ) : the_post();
          $randomid = rand();
          $terms = get_the_terms( get_the_ID(), 'portfolio_filter' );
          $terms_class = '';
          if($terms != '') { 
            foreach ($terms as $term) { $terms_class .='term-'.$term->slug.' '; } 
          }
          $out .= '<div class="'.$terms_class.$cols.' portfolio-item '.$no_margin.' '.$extra_class.'">';     
          if ( has_post_thumbnail()) {
              $portfolio_thumbnail= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'span4' );
              $out .= '<div class="portfolio-pic">';
              $out .= '<img src="'.$portfolio_thumbnail[0].'" />';
              if($show_hover != 'no') {
                $out .= '<div class="portfolio-overlay">';
                $out .= overlay_link($randomid);
                $out .= '</div>';
              }
              $out .= '</div>';
          } else if (get_post_meta( get_the_ID(), 'richer_embed', true ) != '') {  
              if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'vimeo') {  
                  $out .= '<div id="portfolio-video"><div><iframe src="//player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="470" height="340" style="border-width:0px" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';  
              }  
              else if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'youtube') {  
                  $out .= '<div id="portfolio-video"><div><iframe width="470" height="340" src="//www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?rel=0&amp;showinfo=0&amp;modestbranding=1&amp;hd=1&amp;autohide=1&amp;color=white" style="border-width:0px" allowfullscreen></iframe></div></div>';  
              }  
              else {  
                  $out .= '<div id="portfolio-video"><div>'.get_post_meta( get_the_ID(), 'richer_embed', true ).'</div></div>';
              }  
          } else {
              $portfolio_thumbnail= wp_get_attachment_image_src( 5072, 'span4' ); 
              $out .= '<div class="portfolio-pic">';
              $out .= '<img src="'.$portfolio_thumbnail[0].'" />';
              if($show_hover != 'no') {
                $out .= '<div class="portfolio-overlay">';
                $out .= overlay_link($randomid);
                $out .= '</div>';
              }
              $out .= '</div>';
          }
          if($show_title != 'no') {
              $out .= '<div class="portfolio-title">';
              $out .= '<a href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a>'; 
              $out .= '</div>';
            }
          $out .='</div>';
        endwhile;
        $out .= '</div>';
        if ( $loadmore_btn == 'yes' ) {
          $out .= '<p></p><div class="pagination portfolio span12 display"><a class="button default medium loadmore">'.$loadmore_btn_text.'</a><div style="display:none;">'.pagination().'</div></div>';
        }
        $out.='</div>';
      }
      break;
      case 'single-column':
      $out .= '<div id="portfolio-wrap">';
      $out .= $filter_out;
      while ( have_posts() ) : the_post();
        $randomid = rand();
        $terms = get_the_terms( get_the_ID(), 'portfolio_filter' );
        $terms_class = '';
        if($terms != '') { 
          foreach ($terms as $term) { $terms_class .='term-'.$term->slug.' '; } 
        }
        $out .= '<div class="'.$terms_class.' portfolio-item portfolio-item-one row">';
        $out .= '<div class="span8">';
        $images = rwmb_meta( 'richer_screenshot', 'type=image&size=span8', $post->ID);
        if(!empty($images) && get_post_meta( $post->ID, 'richer_gridlayout', true ) != "true"){ 
          $out .= "<script>
          (function($){
            $(window).load(function(){
              $('.portfolio-slider-".$randomid."').flexslider({
                animation: 'fade',
                smoothHeight: true,
                controlNav: false,
                directionNav: true,
                touch: true
              });
            });
          })(jQuery)
          </script>";  
          $out .=' <div id="portfolio-slider" class="portfolio-slider-'.$randomid.' flexslider"><ul class="slides">'; 
          foreach ( $images as $image ) {
            // Show image
            $out .= "<li><a href='". $image['full_url']. "' rel='prettyPhoto[slides".$randomid."]' class='prettyPhoto'><img src='". $image['url'] . "' />";
            if($show_hover != 'no') {
              $out .= '<div class="overlay"></div>';
            }
            $out .= '</a></li>';
          }
          $out .= "</ul></div>";
        } else if ( has_post_thumbnail()) {
          $portfolio_thumbnail= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'span8' );
          $out .= '<div class="portfolio-pic">';
          $out .= '<img src="'.$portfolio_thumbnail[0].'" />';
          if($show_hover != 'no') {
            $out .= '<div class="portfolio-overlay">';
            $out .= overlay_link($randomid);
            $out .= '</div>';
          }
          $out .= '</div>';
        } else if (get_post_meta( get_the_ID(), 'richer_embed', true ) != '') {  
          if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'vimeo') {  
              $out .= '<div id="portfolio-video"><div><iframe src="//player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="770" height="400" style="border-width:0px" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';  
          }  
          else if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'youtube') {  
              $out .= '<div id="portfolio-video"><div><iframe width="770" height="400" src="//www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?rel=0&amp;showinfo=0&amp;modestbranding=1&amp;hd=1&amp;autohide=1&amp;color=white" style="border-width:0px" allowfullscreen></iframe></div></div>';  
          }  
          else {  
              $out .= '<div id="portfolio-video"><div>'.get_post_meta( get_the_ID(), 'richer_embed', true ).'</div></div>';
          }  
        } else {
          $portfolio_thumbnail= wp_get_attachment_image_src( 5072, 'span4' ); 
          $out .= '<div class="portfolio-pic">';
          $out .= '<img src="'.$portfolio_thumbnail[0].'" />';
          if($show_hover != 'no') {
            $out .= '<div class="portfolio-overlay">';
            $out .= overlay_link($randomid);
            $out .= '</div>';
          }
          $out .= '</div>';
        }
        $out .= '</div>';
        $out .= '<div class="span4">';
        $out .= '<div class="portfolio-desc">';
          if($show_title != 'no') {
            $out .= '<h4 class="title"><a href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a></h4>'; 
          }
          $out .= '<div class="date"><span>'.get_the_time('F j, Y').'</span></div>';
          $out .= my_string_limit_words(get_the_excerpt(),$excerpt_count);
          $out .= '<div class="portfolio-tags"><strong>'.__('Tags', 'richer').': </strong>';
          $taxonomy = strip_tags( get_the_term_list($post->ID, 'portfolio_filter', '', ', ', '') ); 
          $out .= $taxonomy.'</div>';
          $out .= '<a href="'.get_permalink().'" class="button small default">'.__('View Details', 'richer').'</a>'; 
        $out .= '</div>';
        $out .= '</div>';
      $out .= '</div>';
      endwhile;
      $out .= '</div>';
      break;
      case 'grid-with-shadow':
      $no_margin = '';
      if(have_posts()){
        $out .= $filter_out;
        $out .= '<div class="row '.$no_margin.'"><div id="portfolio-wrap-'.$folio_id.'">';
          while ( have_posts() ) : the_post();
          $randomid = rand();
          $terms = get_the_terms( get_the_ID(), 'portfolio_filter' );
          $terms_class = '';
          if($terms != '') { 
            foreach ($terms as $term) { $terms_class .='term-'.$term->slug.' '; } 
          }
          $out .= '<div class="'.$terms_class.$cols.' portfolio-item '.$no_margin.' '.$extra_class.'">';     
          if ( has_post_thumbnail()) {
              $portfolio_thumbnail= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'span4' );
              $out .= '<div class="portfolio-pic">';
              $out .= '<img src="'.$portfolio_thumbnail[0].'" />';
              if($show_hover != 'no') {
                $out .= '<div class="portfolio-overlay">';
                $out .= overlay_link($randomid);
                $out .= '</div>';
              }
              $out .= '</div>';
          } else if (get_post_meta( get_the_ID(), 'richer_embed', true ) != '') {  
              if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'vimeo') {  
                  $out .= '<div id="portfolio-video"><div><iframe src="//player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="470" height="340" style="border-width:0px" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';  
              }  
              else if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'youtube') {  
                  $out .= '<div id="portfolio-video"><div><iframe width="470" height="340" src="//www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?rel=0&amp;showinfo=0&amp;modestbranding=1&amp;hd=1&amp;autohide=1&amp;color=white" style="border-width:0px" allowfullscreen></iframe></div></div>';  
              }  
              else {  
                  $out .= '<div id="portfolio-video"><div>'.get_post_meta( get_the_ID(), 'richer_embed', true ).'</div></div>';
              }  
          } else {
              $portfolio_thumbnail= wp_get_attachment_image_src( 5072, 'span4' ); 
              $out .= '<div class="portfolio-pic">';
              $out .= '<img src="'.$portfolio_thumbnail[0].'" />';
              if($show_hover != 'no') {
                $out .= '<div class="portfolio-overlay">';
                $out .= overlay_link($randomid);
                $out .= '</div>';
              }
              $out .= '</div>';
          }
          if($show_title != 'no') {
              $out .= '<div class="portfolio-title">';
              $out .= '<a href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a>'; 
              $out .= '</div>';
            }
          $out .='</div>';
        endwhile;
        $out .= '</div>';
        if ( $loadmore_btn == 'yes' ) {
          $out .= '<p></p><div class="pagination portfolio span12 display"><a class="button default medium loadmore">'.$loadmore_btn_text.'</a><div style="display:none;">'.pagination().'</div></div>';
        }
        $out.='</div>';
      }
      break;

    default:
      break;
  }
    wp_reset_query();
    return $out;
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Tabs
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_tabgroup')){
  function richer_tabgroup( $atts, $content = null, $code ) {
    $GLOBALS['tab_count'] = 0;
    $i = 1;
    $randomid = rand();
    do_shortcode( $content );

    if( is_array( $GLOBALS['tabs'] ) ){
    
      foreach( $GLOBALS['tabs'] as $tab ){  
        if( $tab['icon'] != '' ){
          $icon = '<i class="fa '.$tab['icon'].'"></i>';
        }
        else{
          $icon = '';
        }
        $tabs[] = '<li class="tab"><a href="#panel'.$randomid.$i.'"><h6>'.$icon.''.$tab['title'].'</h6></a></li>';
        $panes[] = '<div class="panel" id="panel'.$randomid.$i.'"><div class="wrapper">'.do_shortcode($tab['content']).'</div></div>';
        $i++;
        $icon = '';
      }
      $return = '<div class="tabset horizontal"><ul class="tabs">'.implode( "\n", $tabs ).'</ul>'.implode( "\n", $panes ).'</div>';
    }
    return $return;
  }
}
if(!function_exists('richer_tabgroup_vertical')){
  function richer_tabgroup_vertical( $atts, $content = null, $code ) {
    $GLOBALS['tab_count'] = 0;
    $i = 1;
    $randomid = rand();
    do_shortcode( $content );

    if( is_array( $GLOBALS['tabs'] ) ){
    
      foreach( $GLOBALS['tabs'] as $tab ){  
        if( $tab['icon'] != '' ){
          $icon = '<i class="fa '.$tab['icon'].'"></i>';
        }
        else{
          $icon = '';
        }
        $tabs[] = '<li class="tab"><a href="#panel'.$randomid.$i.'"><h6>'.$icon.''.$tab['title'].'</h6></a></li>';
        $panes[] = '<div class="panel" id="panel'.$randomid.$i.'"><div class="wrapper">'.do_shortcode($tab['content']).'</div></div>';
        $i++;
        $icon = '';
      }
      $return = '<div class="tabset vertical"><ul class="tabs">'.implode( "\n", $tabs ).'</ul>'.implode( "\n", $panes ).'</div>';
    }
    return $return;
  }
}
if(!function_exists('richer_tab')){
  function richer_tab( $atts, $content = null, $code) {
    extract(shortcode_atts(array(
        'title' => '',
        'icon'  => ''
    ), $atts));
    
    $x = $GLOBALS['tab_count'];
    $GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'icon' => $icon, 'content' =>  $content );
    $GLOBALS['tab_count']++;
  }
}


/*-----------------------------------------------------------------------------------*/
/* Toggle */
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_toggle')){
  function richer_toggle( $atts, $content = null){
    extract(shortcode_atts(array(
          'title' => '',
          'icon' => '',
          'style' => 'style1',
          'open' => "false"
      ), $atts));

    if($icon != '') {
        $icon = "<i class='icon fa ".$icon."'></i>";
        $status_icon_pos = "fright";
      }
      else{
        $icon = "";
        $status_icon_pos = 'fleft';
      }
      
      if($open == "true") {
        $open = "active";
      }
      else{
        $open = '';
      }
     return '<div class="toggle '.$style.'"><div class="toggle-title '.$open.'"><div class="status-icon '.$status_icon_pos.'"><i class="fa fa-plus"></i></div><span>'.$icon.' '.$title.'</span></div><div class="toggle-inner">'. do_shortcode($content) . '</div></div>';
  }
}

/*-----------------------------------------------------------------------------------*/
/* Tooltip */
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_tooltip')){
  function richer_tooltip( $atts, $content = null)
  {
    extract(shortcode_atts(array(
          'text' => ''
      ), $atts));
     
     return '<span class="tooltips"><a href="#" rel="tooltip" title="'.$text.'">'. do_shortcode($content) . '</a></span>';
  }
}
/*-----------------------------------------------------------------------------------*/
/* Separator */
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_separator')){
  function richer_separator( $atts, $content = null){
    extract(shortcode_atts(array(
          'headline' => 'h3',
          'title' => 'Your title here',
          'style' => 'center',
          'margin' => '30',
          'width_style' => 'short',
          'subtitle' => ''
      ), $atts));
    if($subtitle != '') {
      $subtitle = '<div class="subtitle" style="margin-top:25px;">'.wpautop(htmlspecialchars_decode($subtitle)).'</div>';
    } else {
      $subtitle = '';
    }
    return '<div class="separator_block '.$style.'" style="margin-bottom:'.$margin.'px;"><'.$headline.'>'.$title.'</'.$headline.'><div class="separator '.$width_style.'"><div class="separator_line"></div></div>'.$subtitle.'<div class="clearfix"></div></div>';
  }
}
/*-----------------------------------------------------------------------------------*/
/* Separator */
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_highlight')){
  function richer_highlight( $atts, $content){
    extract(shortcode_atts(array(
          'bg_color' => ''
      ), $atts));
    $style='';
    if($bg_color != '') {$style = 'style="background-color:'.$bg_color.';"';}
    return '<span class="highlight" '.$style.'>'.$content.'</span>';
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Video Section
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_videosection')){
  function richer_videosection( $atts, $content = null) {
  extract( shortcode_atts( array(
    'poster'    => '',
    'mp4'     => '',
    'm4v'     => '',
    'webm'      => '',
    'ogv'     => '',
    'pad_top'     => '',
    'pad_bottom'     => '',
    'text_color'     => '#ffffff',
    'overlay'   => '',
    'section_id' => ''
    ), $atts ) );

    $video_bg = '';

    if($poster != ''){
      $video_bg = 'background-image: url(' . $poster . ');';
    }
    if($overlay != '') {
      $overlay = 'background:url('.$overlay.') repeat;';
    }
    if($section_id != '') $section_id = 'id="'.$section_id.'"'; 
    if($text_color != '') {    
      $headline_color = 'section.videosection h1, section.videosection h2, section.videosection h3, section.videosection h4, section.videosection h5 {color:'.$text_color.'}';
    }  else {
      $headline_color = ''; 
    } 
      $out = '<script type="text/javascript">';
      $out .= 'jQuery(document).ready(function(){jQuery("#custom-style").append("'.$headline_color.'")});';
      $out .= '</script>';
      return $out.'
      <section '.$section_id.' class="videosection" style="padding: ' . $pad_top . 'px 0 '.$pad_bottom.'px 0; color: ' . $text_color . ';">
        <div class="container">
          <div class="row"><div class="span12">' . do_shortcode($content) . '</div></div>
        </div>
        <div class="video-wrap">
            <video width="1920" height="800" preload="auto" poster="'.$poster.'" autoplay loop="loop" muted="muted">
              <source src="' . $webm . '" type="video/webm">
              <source src="' . $mp4 . '" type="video/mp4">
              <source src="' . $m4v . '" type="video/m4v">
              <source src="' . $ogv . '" type="video/ogg">
            </video>
        </div>
        <div class="video-poster" style="' . $video_bg . '"></div>
        <div class="video-overlay" style="' . $overlay . '"></div>
      </section>';
  }
}
/*-----------------------------------------------------------------------------------*/
/* Section */
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_section')){
  function richer_section( $atts, $content = null, $tag='section'){
    extract(shortcode_atts(array(
          'bg_image' => '',
          'bg_position' => '',
          'bg_repeat' => '',
          'bg_color' => '',
          'bg_size' => '',
          'text_color' => '',
          'border_width' => '',
          'border_color' => '',
          'padding_top' => '',
          'padding_bottom' => '',
          'use_container' => 'yes',
          'parallax' => 'no',
          'section_divider' => 'none',
          'section_id' => '',
          'text_align' => ''
      ), $atts));
    $out = '';
    $headline_color = '';
    static $id;
    ++$id;
    if($section_id != '') $section_id = 'id="'.$section_id.'"';
    $border_width_bottom = $border_width;

    if($bg_image != '') {
      if($parallax == 'yes') {
        $parallax = 'background-attachment:fixed; position:static;';
      } else {
        $parallax = '';
      }
      $bg_image = 'background: url("'.$bg_image.'") '.$bg_position.' '.$bg_repeat.';'.$parallax;
    }
    static $z_ind=99;
    switch ($section_divider) {
      case 'top':
        ++$z_ind;
        $top_outer = $border_width+14;
        $divider_class = 'divider';
        $divider_css = 'section.fullwidth-'.$id.'.divider:before {border-width:'.$border_width.'px;border-left-color:'.$border_color.';border-top-color:'.$border_color.';background-color:'.$bg_color.';top:-'.$top_outer.'px;margin-left:-'.$top_outer.'px;}';
        break;
      case 'bottom':
      --$z_ind;
      $top_outer = $border_width+14;
      $divider_class = 'divider';
       $divider_css = 'section.fullwidth-'.$id.'.divider:after {border-width:'.$border_width.'px;border-right-color:'.$border_color.';border-bottom-color:'.$border_color.';background-color:'.$bg_color.';bottom:-'.$top_outer.'px;margin-left:-'.$top_outer.'px;}';
        break;
      case 'both':
        ++$z_ind;
        ++$z_ind;
        $top_outer = $border_width+14;
        $divider_class = 'divider';
        $divider_css = 'section.fullwidth-'.$id.'.divider:before {border-width:'.$border_width.'px;border-left-color:'.$border_color.';border-top-color:'.$border_color.';background-color:'.$bg_color.';top:-'.$top_outer.'px;margin-left:-'.$top_outer.'px;}';
       $divider_css .= 'section.fullwidth-'.$id.'.divider:after {border-width:'.$border_width.'px;border-right-color:'.$border_color.';border-bottom-color:'.$border_color.';background-color:'.$bg_color.';bottom:-'.$top_outer.'px;margin-left:-'.$top_outer.'px;}';
        break;
      default:
        $divider_css = '';
        $divider_class = '';
        --$z_ind;
        break;
    }
    if($bg_color != '') $bg_color = 'background-color:'.$bg_color.';';
    if($bg_size != '') $bg_size = 'background-size:'.$bg_size.';';
    if($border_width != '') $border_width = 'border-top:'.$border_width.'px solid '.$border_color.';border-bottom:'.$border_width_bottom.'px solid '.$border_color.';';
    if($padding_top != '') $padding_top = 'padding-top:'.preg_replace('/[^0-9.]/', '', $padding_top).'px;';
    if($padding_bottom != '') $padding_bottom = 'padding-bottom:'.$padding_bottom.'px;';
    if($text_color != '') {    
      $headline_color = 'section.fullwidth-'.$id.' h1, section.fullwidth-'.$id.' h2, section.fullwidth-'.$id.' h3, section.fullwidth-'.$id.' h4, section.fullwidth-'.$id.' h5, section.fullwidth-'.$id.' h6 {color:'.$text_color.'}';
      $text_color = 'color:'.$text_color.';';
    }  
    if($text_align != ''){$text_align='text-align:'.$text_align.';';} else {$text_align='';}
    $out_css = 'section.fullwidth-'.$id.'{z-index:'.$z_ind.';'.$text_align.$bg_color.$bg_image.$bg_size.$padding_top.$padding_bottom.$border_width.$text_color.'}'.$divider_css;
   
    $out .= '<script type="text/javascript">';
    $out .= 'jQuery(document).ready(function(){jQuery("#custom-style").append("'.htmlspecialchars($headline_color.$out_css).'")});';
    $out .= '</script>';
    $out .= '<section '.$section_id.' class="section-fullwidth fullwidth-'.$id.' '.$divider_class.'">';
    //$out .= $divider_top;
    if($use_container == 'no') {
      $out .= do_shortcode($content);
    } else {
      $out .= do_shortcode('[container][span12]'.$content.'[/span12][/container]');
    }
    $out .= '</section>';
    return $out;
  }
}
/*-----------------------------------------------------------------------------------*/
/* Recent Comments */
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_recent_comments')){
  function richer_recent_comments($atts, $content = null) {
      extract(shortcode_atts(array(
          'count' => '5',
          'excerpt_count' => '8'
      ), $atts));

      $args = array(
    'status' => 'approve',
    'number' => $count,
    'post_type' => 'post',
    'orderby' => 'date',
    );
    $comments = get_comments($args);

      $output = '<ul class="recent-comments">';

      foreach ($comments as $comment) {

          $output .= '<li>';
              $output .= '<span class="author">'.strip_tags($comment->comment_author).'</span> : '.my_string_limit_words(strip_tags($comment->comment_content), $excerpt_count).'';
                   $output .= '</br><span class="date">'.get_the_time('F j, Y').'</span> | <a href="'.get_permalink($comment->ID).'#comment-'.$comment->comment_ID.'" title="on '.$comment->post_title.'">'.__('Reply','richer').' </a>';
              $output .= '';
          $output .= '</li>';

      }

      $output .= '</ul>';

      return $output;
  }
}
/*-----------------------------------------------------------------------------------*/
/*  Latest Blog
/*-----------------------------------------------------------------------------------*/
if(!function_exists('richer_recentposts')){
  function richer_recentposts($atts){
    extract(shortcode_atts(array(
          'layout'      => 'grid',
          'slideshow' => 'false',
          'columns' => '3',
          'number_posts' => '3',
          'cat_slug' => '',
          'excerpt_count' => '14',
          'show_readmore' => 'yes',
          'readmore_text' => 'Continue reading',
          'orderby' => 'date',
          'order' => 'DESC',
          'show_author' => 'yes',
          'show_thumb' => 'yes',
          'pagination' => ''
      ), $atts));
      
      global $post;
      if ( is_front_page() ) {
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
      } else {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      }
      switch ($orderby) {
        case 'popular':
          $orderby = 'comment_count';
          break;
        case 'date':
          $orderby = 'date';
          break;
        case 'title':
          $orderby = 'title';
          break;
        default:
          $orderby = 'date';
          break;
      }
      $cols='';
      switch ($columns) {
        case '2':
          $cols = 'span6';
          $img_size = 'standard';
          $video_size = 'width="875" height="410"';
          $maxItems = "2";
          $itemWidth = '574';
          break;
        case '4':
          $cols = 'span3';
          $img_size = 'span4-thin';
          $video_size = 'width="470" height="240"';
          $maxItems = "4";
          $itemWidth = '270';
          break;
        default:
          $cols = 'span4';
          $maxItems = "3";
          $img_size = 'span4-thin';
          $itemWidth = '369';
          $video_size = 'width="470" height="240"';
          break;
      }
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => $number_posts,
      'paged' => $paged,
      'order'          => $order,
      'orderby'        => $orderby,
      'post_status'    => 'publish'
      );
      
      if($cat_slug != '' && $cat_slug != 'all'){
        
        // string to array
        $str = $cat_slug;
        $arr = explode(',', $str);
        //var_dump($arr);
        
      $args['tax_query'][] = array(
        'taxonomy'  => 'category',
        'field'   => 'slug',
        'terms'   => $arr
      );
    }
    static $blog_id=0;
      query_posts( $args );
      $out = '';
    if( have_posts() ) :
      switch($layout) {
        case 'grid':
        $row_count = 1;
        $out .= '<div class="row-fluid">';
        $out .= '<div id="blog_items_wrap">';
          while ( have_posts() ) : the_post();
          if($row_count > $columns) {
            $out .= '<div class="clearfix"></div>';
            $row_count = 1;
          } 
          $out .= '<div class="'.$cols.'">';
          $out .= '<div class="blog-item">';
            if($show_thumb != 'no' && has_post_thumbnail()){
              $attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $img_size );
              $src = $attachment_url['0'];
              $out .= '<figure class="thumbnail"><img src="'.$src.'" alt=""/></figure>';
            } else if ($show_thumb != 'no' && get_post_meta( get_the_ID(), 'richer_embed', true ) != '') {  
              if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'vimeo') {  
                  $out .= '<div id="blog-video"><div><iframe src="//player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" '.$video_size.' style="border-width:0px" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';  
              }  
              else if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'youtube') {  
                  $out .= '<div id="blog-video"><div><iframe '.$video_size.' src="//www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?rel=0&amp;showinfo=0&amp;modestbranding=1&amp;hd=1&amp;autohide=1&amp;color=white" style="border-width:0px" allowfullscreen></iframe></div></div>';  
              }  
              else {  
                  $out .= '<div id="blog-video"><div>'.get_post_meta( get_the_ID(), 'richer_embed', true ).'</div></div>';
              }  
          }
            if($show_author != 'no'){
              $out .= '<div class="author">';
              $out .= '<div class="author-image">'.get_avatar( get_the_author_meta('user_email'), '60', '' ).'</div>';
              $out .= '<div class="name">'.__('By','richer').' '.get_the_author().'</div>';  
              $out.= '</div>';
            }
            $out .= '<div class="blog-item-description">';
            $out .= '<h6><a href="'.get_permalink().'" title="' . get_the_title() . '">'.get_the_title() .'</a></h6>';
            $out .= '<div class="date"><span>'.get_the_time('F j, Y').'</span></div>';
            $out .= '<div class="blog-item-excerpt">'.my_string_limit_words(get_the_content(), $excerpt_count).' ';
            if($show_readmore != 'no') {
              $out .= '<a class="more" href="'. get_permalink() . '">' .$readmore_text. '</a>';
            }
            $out .= '</div>';
            $out .= '</div>';
          $out .= '</div>';
          $out .= '</div>';
          $row_count++;
          endwhile;
          $out .= '<div class="clearfix"></div>';
        $out .= '</div>';
        $out .= '</div>';
        if($pagination == 'yes') $out .= '<div id="pagination" class="clearfix">'.pagination().'</div>';
        break;
        case 'carousel':
          $out .= '<script type="text/javascript">
          (function($){
            $(window).load(function() {
              $("#flexslider-blog-'.$blog_id.'").flexslider({
                animation: "slide",
                slideshow: '.$slideshow.',
                smoothHeight : true,
                directionNav: true,
                controlNav: false,
                itemMargin: 31,
                itemWidth: '.$itemWidth.',
                minItems: 1,
                maxItems: '.$maxItems.'
              });
            });
          })(jQuery);
          </script>';
          $out.='<div id="flexslider-blog-'.$blog_id.'" class="flexslider-blog"><ul class="slides">';
            while ( have_posts() ) : the_post();
              
            $out .= '<li>';
            $out .= '<div class="blog-item">';
              if($show_thumb != 'no' && has_post_thumbnail()){
                $attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $img_size );
                $src = $attachment_url['0'];
                $out .= '<figure class="thumbnail"><img src="'.$src.'" alt=""/></figure>';
              }
              if($show_author != 'no'){
                $out .= '<div class="author">';
                $out .= '<div class="author-image">'.get_avatar( get_the_author_meta('user_email'), '60', '' ).'</div>';
                $out .= '<div class="name">'.__('By','richer').' '.get_the_author().'</div>';  
                $out.= '</div>';
              }
              $out .= '<div class="blog-item-description">';
              $out .= '<h6><a href="'.get_permalink().'" title="' . get_the_title() . '">'.get_the_title() .'</a></h6>';
              $out .= '<div class="date"><span>'.get_the_time('F j, Y').'</span></div>';
              $out .= '<div class="blog-item-excerpt">'.my_string_limit_words(get_the_content(), $excerpt_count).'. ';
              if($show_readmore != 'no') {
                $out .= '<a class="more" href="'. get_permalink() . '">' .$readmore_text. '</a>';
              }
              $out .= '</div>';
              $out .= '</div>';
            $out .= '</div>';
            $out .= '</li>';
            endwhile;
          $out .= '</ul></div>';
        break;
        case 'list':
        $out .= '<div class="blog-list">';
          while ( have_posts() ) : the_post();
          $attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'mini' );
          $url = $attachment_url['0'];
          $image = $url;
          $out .= '<div class="latest-blog-list clearfix">';
            if($show_thumb != 'no' && has_post_thumbnail()){
              $out .= '<div class="blog-list-item-img"><img src="'.$image.'" alt="'.get_the_title().'" /></div>';
            }
            $out .= '<div class="blog-list-item-description">';
            $out .= '<h6><a href="'.get_permalink().'" title="' . get_the_title() . '">'.get_the_title() .'</a></h6>';
            $out .= '<div class="date">'.get_the_time('F j, Y').'</div>';
            $out .= '<div class="blog-item-excerpt">'.my_string_limit_words(get_the_content(), $excerpt_count).'. ';
              if($show_readmore != 'no') {
                $out .= '<a class="more" href="'. get_permalink() . '">' .$readmore_text. '</a>';
              }
            $out .= '</div>';
            $out .= '</div>';
          $out .= '</div>';
          endwhile;
        $out .= '</div>';
        break;
        case 'list-with-date':
          while ( have_posts() ) : the_post();
        
          $out .= '<div class="latest-blog-list clearfix"><div class="blog-list-item-date"><h3><div class="border">'.get_the_time('d').'</div></h3><span>'.get_the_time('F').'</span></div>';
          $out .= '<div class="blog-list-item-description">';
          $out .= '<h6><a href="'.get_permalink().'" title="' . get_the_title() . '">'.get_the_title() .'</a></h6>';
          if ( comments_open() ) {
            $out .= '<div class="comments-count">';
            $out .= my_get_comments_count();
            $out .='</div>';
          }
          $out .= '<div class="blog-item-excerpt">'.my_string_limit_words(get_the_content(), $excerpt_count).'. ';
              if($show_readmore != 'no') {
                $out .= '<a class="more" href="'. get_permalink() . '">' .$readmore_text. '</a>';
              }
          $out .= '</div>';
          $out .= '</div>';
          $out .= '</div>';
          endwhile;
          $out .='<div class="clearfix"></div>';
        break;
        case 'grid-list-with-date':
        $out.='<div class="row-fluid">';
          while ( have_posts() ) : the_post();
            
          $out .= '<div class="'.$cols.'">';
          $out .= '<div class="latest-blog-list clearfix"><div class="blog-list-item-date"><h3><div class="border">'.get_the_time('d').'</div></h3><span>'.get_the_time('F').'</span></div>';
          $out .= '<div class="blog-list-item-description">';
          $out .= '<h6><a href="'.get_permalink().'" title="' . get_the_title() . '">'.get_the_title() .'</a></h6>';
          if ( comments_open() ) {
            $out .= '<div class="comments-count">';
            $out .= my_get_comments_count();
            $out .='</div>';
          }
          $out .= '<div class="blog-item-excerpt">'.my_string_limit_words(get_the_content(), $excerpt_count).'. ';
              if($show_readmore != 'no') {
                $out .= '<a class="more" href="'. get_permalink() . '">' .$readmore_text. '</a>';
              }
          $out .= '</div>';
          $out .= '</div>';
          $out .= '</div>';
          $out .= '</div>';
          endwhile;
          $out .= '<div class="clearfix"></div>';
        $out .= '</div>';
        break;
        default:
         $out.='<div class="row-fluid">';
            while ( have_posts() ) : the_post();
              
            $out .= '<div class="'.$cols.'">';
            $out .= '<div class="blog-item">';
              if($show_thumb != 'no' && has_post_thumbnail()){
                $attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $img_size );
                $src = $attachment_url['0'];
                $out .= '<figure class="thumbnail"><img src="'.$src.'" alt=""/></figure>';
              }
              if($show_author != 'no'){
                $out .= '<div class="author">';
                $out .= '<div class="author-image">'.get_avatar( get_the_author_meta('user_email'), '60', '' ).'</div>';
                $out .= '<div class="name">'.__('By','richer').' '.get_the_author().'</div>';  
                $out.= '</div>';
              }
              $out .= '<div class="blog-item-description">';
              $out .= '<h6><a href="'.get_permalink().'" title="' . get_the_title() . '">'.get_the_title() .'</a></h6>';
              $out .= '<div class="date"><span>'.get_the_time('F j, Y').'</span></div>';
              $out .= '<div class="blog-item-excerpt">'.my_string_limit_words(get_the_content(), $excerpt_count).'. ';
              if($show_readmore != 'no') {
                $out .= '<a class="more" href="'. get_permalink() . '">' .$readmore_text. '</a>';
              }
              $out .= '</div>';
              $out .= '</div>';
            $out .= '</div>';
            $out .= '</div>';
            endwhile;
            $out .= '<div class="clearfix"></div>';
          $out .= '</div>';
        break;
      }
      
       wp_reset_query();
    
    endif;
    $blog_id++;
    return $out;
  }
}
if(!function_exists('richer_soundcloud')){
  function richer_soundcloud($atts) {
      extract(shortcode_atts(array(
        'url' => '',
        'width' => '100%',
        'height' => '114',
        'comments' => 'no',
        'auto_play' => 'no',
        'color' => '#ff7700',
      ), $atts));

      if($comments == 'yes') {
        $comments = 'true';
      } else {
        $comments = 'false';
      }

      if($auto_play == 'yes') {
        $auto_play = 'true';
      } else {
        $auto_play = 'false';
      }
      $color = str_replace('#', '', $color );
      return '<iframe width="'.$width.'" height="'.$height.'" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=' . urlencode($url) . '&amp;show_comments=' . $comments . '&amp;auto_play=' . $auto_play . '&amp;color=' . $color . '"></iframe>';
  }
}
if(!function_exists('richer_twitter')){
  function richer_twitter($atts, $content = null) {
    
    global $wp_widget_factory;
      
      extract(shortcode_atts(array(
          'widget_name' => 'widget_twitter',
          'title' => '',
          'username' =>'',
          'consumerkey' => 'gOL3Q6bR1B2OCGGDutVtQ', 
          'consumersecret' => 'gvtf6wPrxUUzzRSZnVkS1r24g1fcoZfxqjAhpTC2gQ', 
          'accesstoken' => '593600638-PGezgRfHdabIX9fAxvKTlGMnC3TsZrav1mX79jqR', 
          'accesstokensecret' => 'tWpGVdpG7ICTEWsyEXg9UCZrGai3sShDi7dsfeiw',
          'cachetime' => '1',
          'tweetstoshow' =>'2'
      ), $atts));
      
      $widget_name = esc_html($widget_name);
      
      if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
          $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
          
          if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
              return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct", "richer"),'<strong>'.$class.'</strong>').'</p>';
          else:
              $class = $wp_class;
          endif;
      endif;
      
      ob_start();
      $id=rand(1,99);
      $instance['title'] = $title;
      $instance['username'] = $username;
      $instance['consumerkey'] = $consumerkey;
      $instance['consumersecret'] = $consumersecret;
      $instance['accesstoken'] = $accesstoken;
      $instance['accesstokensecret'] = $accesstokensecret;
      $instance['cachetime'] = $cachetime;
      $instance['tweetstoshow'] = $tweetstoshow;
      the_widget($widget_name, $instance, array('widget_id'=>'arbitrary-instance-'.$id,
          'before_widget' => '',
          'after_widget' => '',
          'before_title' => '<h2>',
          'after_title' => '</h2>'
      ));
      $output = ob_get_contents();
      ob_end_clean();
      return $output;
  }
}
if(!function_exists('richer_flickr')){
  function richer_flickr($atts, $content = null) {
    
    global $wp_widget_factory;
      
      extract(shortcode_atts(array(
          'widget_name' => 'widget_flickr',
          'title' => '',
          'username' =>'57866871@N03',
          'pics' =>'4',
          'pic_size' => ''
      ), $atts));
      
      $widget_name = esc_html($widget_name);
      
      if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
          $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
          
          if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
              return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct", "richer"),'<strong>'.$class.'</strong>').'</p>';
          else:
              $class = $wp_class;
          endif;
      endif;
      
      ob_start();
      $id=rand(1,99);
      switch ($pic_size) {
      case 'Square (75x75)':
        $pic_size = '1';
        break;
      case 'Thumbnail (100x75)':
        $pic_size = '2';
        break;
      case 'Large Square (150x150)':
        $pic_size = '3';
        break;
      case 'Small (240x180)':
        $pic_size = '4';
        break;
      case 'Medium (500x375)':
        $pic_size = '5';
        break;
      default:
        $pic_size = '1';
        break;
    }
      $instance['title'] = $title;
      $instance['username'] = $username;
      $instance['pics'] = $pics;
      $instance['pic_size'] = $pic_size;
      the_widget($widget_name, $instance, array('widget_id'=>'arbitrary-instance-'.$id,
          'before_widget' => '',
          'after_widget' => '',
          'before_title' => '<h2>',
          'after_title' => '</h2>'
      ));
      $output = ob_get_contents();
      ob_end_clean();
      return $output;
  }
}
if(!function_exists('richer_instagram')){
  function richer_instagram($atts, $content = null) {
    
    global $wp_widget_factory;
      
      extract(shortcode_atts(array(
          'widget_name' => 'widget_instagram',
          'title' => '',
          'userid' =>'',
          'access_token' => '', 
          'pics' => '', 
          'pics_per_row' => ''
      ), $atts));
      
      $widget_name = esc_html($widget_name);
      
      if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
          $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
          
          if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
              return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct", "richer"),'<strong>'.$class.'</strong>').'</p>';
          else:
              $class = $wp_class;
          endif;
      endif;
      
      ob_start();
      $id=rand(1,99);
      $instance['title'] = $title;
      $instance['userid'] = $userid;
      $instance['access_token'] = $access_token;
      $instance['pics'] = $pics;
      $instance['pics_per_row'] = $pics_per_row;

      the_widget($widget_name, $instance, array('widget_id'=>'arbitrary-instance-'.$id,
          'before_widget' => '',
          'after_widget' => '',
          'before_title' => '<h2>',
          'after_title' => '</h2>'
      ));
      $output = ob_get_contents();
      ob_end_clean();
      return $output;
  }
}
if(!function_exists('richer_coming_soon')){
  function richer_coming_soon($atts) {
      wp_register_script('countdown', get_template_directory_uri() . '/framework/js/countdown.js', 'jquery', '1.0', TRUE);
      wp_enqueue_script('countdown');
      extract(shortcode_atts(array(
        'date_release' => '04/01/2015',
      ), $atts));
      $out = '
      <script type="text/javascript">
      jQuery(document).ready(function(){
          jQuery(".countdown").downCount({
          date: "'.$date_release.'"
      });
      })
      </script>
      ';
      $out .= '
      <div class="row">
        <div class="countdown">
            <div class="span3">
                <div class="count-container">
                    <span class="days">267</span>
                    <p class="days_ref">Days</p>
                </div>
            </div>
            <div class="span3">
                <div class="count-container">
                    <span class="hours">12</span>
                    <p class="hours_ref">Hours</p>
                </div>
            </div>
            <div class="span3">
                <div class="count-container">
                    <span class="minutes">58</span>
                    <p class="minutes_ref">Minutes</p>
                </div>
            </div>
            <div class="span3">
                <div class="count-container">
                    <span class="seconds">45</span>
                    <p class="seconds_ref">Seconds</p>
                </div>
            </div>
        </div>
      </div>';

      return $out;
  }
}
/* ----------------------------------------------------- */
/* Pre Process Shortcodes */
/* ----------------------------------------------------- */

global $shortcode_tags;

add_shortcode('recentposts', 'richer_recentposts');
add_shortcode('accordion', 'richer_accordion');
add_shortcode('accordion_item', 'richer_accordion_item');
add_shortcode('alert', 'richer_alert');
add_shortcode('button', 'richer_buttons');
add_shortcode('map', 'richer_map');
add_shortcode('calltoaction', 'richer_calltoaction');
add_shortcode('box', 'richer_box');
add_shortcode('client', 'richer_client');
add_shortcode('clients', 'richer_clients');
add_shortcode('image_item', 'richer_image_item');
add_shortcode('images', 'richer_images');
add_shortcode('images_carousel', 'richer_images_carousel');
add_shortcode('googlefont', 'richer_googlefont');
add_shortcode('br', 'richer_br');
add_shortcode('clearfix', 'richer_clear');
add_shortcode('code', 'richer_code');
add_shortcode('gap', 'richer_gap');
add_shortcode('hr', 'richer_hr');
add_shortcode('section', 'richer_section');
add_shortcode('videosection', 'richer_videosection');
add_shortcode('container', 'richer_container');
add_shortcode('row_fluid', 'richer_rowfluid');
add_shortcode('rowfluid', 'richer_rowfluid');
add_shortcode('row', 'richer_row');
add_shortcode('span1', 'richer_column');
add_shortcode('span2', 'richer_column');
add_shortcode('span3', 'richer_column');
add_shortcode('span4', 'richer_column');
add_shortcode('span5', 'richer_column');
add_shortcode('span6', 'richer_column');
add_shortcode('span7', 'richer_column');
add_shortcode('span8', 'richer_column');
add_shortcode('span9', 'richer_column');
add_shortcode('span10', 'richer_column');
add_shortcode('span11', 'richer_column');
add_shortcode('span12', 'richer_column');
add_shortcode('one_third', 'richer_one_third');
add_shortcode('one_third_last', 'richer_one_third_last');
add_shortcode('two_third', 'richer_two_third');
add_shortcode('two_third_last', 'richer_two_third_last');
add_shortcode('one_half', 'richer_one_half');
add_shortcode('one_half_last', 'richer_one_half_last');
add_shortcode('one_fourth', 'richer_one_fourth');
add_shortcode('one_fourth_last', 'richer_one_fourth_last');
add_shortcode('three_fourth', 'richer_three_fourth');
add_shortcode('three_fourth_last', 'richer_three_fourth_last');
add_shortcode('one_fifth', 'richer_one_fifth');
add_shortcode('one_fifth_last', 'richer_one_fifth_last');
add_shortcode('two_fifth', 'richer_two_fifth');
add_shortcode('two_fifth_last', 'richer_two_fifth_last');
add_shortcode('three_fifth', 'richer_three_fifth');
add_shortcode('three_fifth_last', 'richer_three_fifth_last');
add_shortcode('four_fifth', 'richer_four_fifth');
add_shortcode('four_fifth_last', 'richer_four_fifth_last');
add_shortcode('one_sixth', 'richer_one_sixth');
add_shortcode('one_sixth_last', 'richer_one_sixth_last');
add_shortcode('five_sixth', 'richer_five_sixth');
add_shortcode('five_sixth_last', 'richer_five_sixth_last');
add_shortcode('dropcap', 'richer_dropcap');
add_shortcode('video_embed', 'richer_video');
add_shortcode('soundcloud', 'richer_soundcloud');
add_shortcode('iconbox', 'richer_iconbox');
add_shortcode('iconbox_new', 'richer_iconbox_new');
add_shortcode('iconlist', 'richer_iconlist');
add_shortcode('icon', 'richer_icon');
add_shortcode('list', 'richer_list');
add_shortcode('list_item', 'richer_item');
add_shortcode('member', 'richer_member');
add_shortcode('progressbar', 'richer_progressbar');
add_shortcode('counters_circle', 'richer_counters_circle');
add_shortcode('circle_counter', 'richer_counter_circle');
add_shortcode('counter_box', 'richer_counter_box');
add_shortcode('plan', 'richer_plan');
add_shortcode('pricing-table', 'richer_pricing');
add_shortcode('blockquote', 'richer_blockquote');
add_shortcode('pullquote', 'richer_pullquote');
add_shortcode('responsive', 'richer_responsive');
add_shortcode('visibility', 'richer_responsivevisibility');
add_shortcode('socials', 'richer_socials');
add_shortcode('table', 'richer_table');
add_shortcode('testimonial', 'richer_testimonial');
add_shortcode('testimonial_carousel', 'richer_testimonial_carousel');
add_shortcode('portfolio', 'richer_portfolio');
add_shortcode('toggle', 'richer_toggle');
add_shortcode('tooltip', 'richer_tooltip');
add_shortcode('highlight', 'richer_highlight');
add_shortcode('separator', 'richer_separator');
add_shortcode('asw_separator', 'richer_separator');
add_shortcode('tabgroup', 'richer_tabgroup' );
add_shortcode('tabgroup_vertical', 'richer_tabgroup_vertical' );
add_shortcode('tab', 'richer_tab' );
add_shortcode('recent_comments', 'richer_recent_comments');
add_shortcode('bannerbox', 'richer_bannerbox');
add_shortcode('animation', 'richer_animation');
add_shortcode('twitter','richer_twitter');
add_shortcode('flickr','richer_flickr');
add_shortcode('instagram','richer_instagram');
add_shortcode('coming_soon', 'richer_coming_soon');
add_shortcode('progressbar_sets','richer_progressbar_sets');

// Backup current registered shortcodes and clear them all out
$orig_shortcode_tags = $shortcode_tags;
// Put the original shortcodes back
$shortcode_tags = $orig_shortcode_tags;


add_filter( 'widget_text', 'shortcode_unautop', 7);
add_filter( 'widget_text', 'do_shortcode', 7);
add_filter( 'the_content', 'do_shortcode', 120);

// Remove Empty Paragraphs
add_filter("the_content", "the_content_filter");
if(!function_exists('the_content_filter')){
  function the_content_filter($content) {
    // array of custom shortcodes requiring the fix 
    $block = join("|",array('recentposts','accordion','accordion_item','alert','button','map','calltoaction','box','client','clients','image_item','images','googlefont','br','clearfix','code','gap','hr','section','videosection','container','row_fluid','rowfluid','row','span1','span2','span3','span4','span5','span6','span7','span8','span9','span10','span11','span12','one_third','one_third_last','two_third','two_third_last','one_half','one_half_last','one_fourth','one_fourth_last','three_fourth','three_fourth_last','one_fifth','one_fifth_last','two_fifth','two_fifth_last','three_fifth','three_fifth_last','four_fifth','four_fifth_last','one_sixth','one_sixth_last','five_sixth','five_sixth_last','dropcap','video_embed','soundcloud','iconbox','iconbox_new','iconlist','icon','list','list_item','member','progressbar','counters_circle','circle_counter','counter_box','plan','pricing-table','blockquote','pullquote','responsive','visibility','socials','table','testimonial','testimonial_carousel','portfolio','toggle','tooltip','highlight','separator','asw_separator','tabgroup','tabgroup_vertical','tab','recent_comments','bannerbox','animation','twitter','flickr','coming_soon','progressbar_sets'));
    
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']',
  ']<br>' => ']',	
  '<br>[' => '[',
        '<p></p>' => '',
        '<p><script' => '<script',
        '<p><style' => '<style',
        '</style></p>' => '</style>',
        '</script><br />' => '</script>',
        '</script></p>' => '</script>'

    );
    $content = strtr($content, $array);
    // opening tag
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content); 
    // closing tag
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
    return $rep;
   
  }
}

remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'custom_gallery');
if(!function_exists('custom_gallery')){
  function custom_gallery($attr) {
  $post = get_post();

    static $instance = 0;
    $instance++;

    if ( ! empty( $attr['ids'] ) ) {
      // 'ids' is explicitly ordered, unless you specify otherwise.
      if ( empty( $attr['orderby'] ) )
        $attr['orderby'] = 'post__in';
      $attr['include'] = $attr['ids'];
    }

    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_gallery', '', $attr);
    if ( $output != '' )
      return $output;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
      $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
      if ( !$attr['orderby'] )
        unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
      'order'      => 'ASC',
      'orderby'    => 'menu_order ID',
      'id'         => $post ? $post->ID : 0,
      'itemtag'    => 'dl',
      'icontag'    => 'dt',
      'captiontag' => 'dd',
      'columns'    => 3,
      'size'       => 'thumbnail',
      'include'    => '',
      'exclude'    => '',
      'link'       => ''
    ), $attr, 'gallery'));

    $id = intval($id);
    if ( 'RAND' == $order )
      $orderby = 'none';

    if ( !empty($include) ) {
      $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

      $attachments = array();
      foreach ( $_attachments as $key => $val ) {
        $attachments[$val->ID] = $_attachments[$key];
      }
    } elseif ( !empty($exclude) ) {
      $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
      $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
      return '';

    if ( is_feed() ) {
      $output = "\n";
      foreach ( $attachments as $att_id => $attachment )
        $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
      return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $icontag = tag_escape($icontag);
    $valid_tags = wp_kses_allowed_html( 'post' );
    if ( ! isset( $valid_tags[ $itemtag ] ) )
      $itemtag = 'dl';
    if ( ! isset( $valid_tags[ $captiontag ] ) )
      $captiontag = 'dd';
    if ( ! isset( $valid_tags[ $icontag ] ) )
      $icontag = 'dt';

    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $gallery_style = $gallery_div = '';
    if ( apply_filters( 'use_default_gallery_style', true ) )
      $gallery_style = "
      <style type='text/css' >
        #{$selector} .gallery-item {
          float: {$float};
          margin-top: 10px;
          text-align: center;
          width: {$itemwidth}%;
        }
        #{$selector} img {
          border: 2px solid #cfcfcf;
        }
        /* see gallery_shortcode() in wp-includes/media.php */
      </style>";
    $size_class = sanitize_html_class( $size );
    $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
      if ( ! empty( $link ) && 'file' === $link ){
        $full_img = wp_get_attachment_image_src( $id, 'full', false );
        $image_output = '<a href="'.$full_img[0].'" rel="prettyPhoto['.$selector.']">'.wp_get_attachment_image( $id, $size, false ).'</a>';
     } elseif ( ! empty( $link ) && 'none' === $link )
        $image_output = wp_get_attachment_image( $id, $size, false );
      else
        $image_output = wp_get_attachment_link( $id, $size, true, false );

      $image_meta  = wp_get_attachment_metadata( $id );

      $orientation = '';
      if ( isset( $image_meta['height'], $image_meta['width'] ) )
        $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

      $output .= "<{$itemtag} class='gallery-item'>";
      $output .= "
        <{$icontag} class='gallery-icon {$orientation}'>
          $image_output
        </{$icontag}>";
      if ( $captiontag && trim($attachment->post_excerpt) ) {
        $output .= "
          <{$captiontag} class='wp-caption-text gallery-caption'>
          " . wptexturize($attachment->post_excerpt) . "
          </{$captiontag}>";
      }
      $output .= "</{$itemtag}>";
      if ( $columns > 0 && ++$i % $columns == 0 )
        $output .= '<br style="clear: both" />';
    }

    $output .= "
        <br style='clear: both;' />
      </div>\n";

    return $output;
  }
}
?>