<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();

$title_color = $title_color ? ('color:'.$title_color.';') : '';
$text_color = $text_color ? ('color:'.$text_color.';') : '';
$title_font_weight = $title_font_weight ? ('font-weight:'.$title_font_weight.';') : '';
$title_text_size = $title_text_size ? ('font-size:'.$title_text_size.'px;') : '';
$btn_background_color = $btn_background_color ? ('background-color:'.$btn_background_color.';') : '';
$btn_text_color = $btn_text_color ? ('color:'.$btn_text_color.';') : '';
$btn_hover_background_color = $btn_hover_background_color ? ('background-color:'.$btn_hover_background_color.';') : '';

Mk_Static_Files::addCSS('
#imagebox-item-'.$id.' .item-wrapper{'.($background_color ? ('background-color:'.$background_color.';') : '').'}  
#imagebox-item-'.$id.' .item-title h5{'.$title_color.$title_font_weight.$title_text_size.'}  
#imagebox-item-'.$id.' .item-content, #imagebox-item-'.$id.' .item-content p {'.$text_color.'}
#imagebox-item-'.$id.' .item-button a {'.$btn_background_color.$btn_text_color.'}
#imagebox-item-'.$id.' .item-button a:hover{'.$btn_hover_background_color.'}', $id);


// swiper-slide mk-slider-slide

  

?>

<div class="">
  <div id="imagebox-item-<?php echo $id; ?>" class="mk-imagebox-item <?php echo  $el_class.' '.$icon_type . '-type'; ?>">
    <div class="item-holder">
      <div class="item-wrapper">
          <?php 
          echo mk_get_shortcode_view('mk_imagebox_item', 'components/video', true, ['image_padding' => $image_padding, 'icon_type' => $icon_type, 'preview_image' => $preview_image, 'mp4' => $mp4, 'webm' => $webm, 'ogv' => $ogv]);  
          echo mk_get_shortcode_view('mk_imagebox_item', 'components/image', true, ['image_padding' => $image_padding, 'icon_type' => $icon_type, 'item_image' => $item_image, 'item_title' => $item_title]);   
          echo mk_get_shortcode_view('mk_imagebox_item', 'components/title', true, ['item_title' => $item_title]);  
          echo mk_get_shortcode_view('mk_imagebox_item', 'components/content', true, ['content' => $content]);
          echo mk_get_shortcode_view('mk_imagebox_item', 'components/button', true, ['btn_url' => $btn_url, 'btn_text' => $btn_text]);
          ?>
      </div>
    </div>
  </div>
</div>


