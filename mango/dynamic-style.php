<style>
<?php
//Dynamic Styles Files
global $mango_settings, $post;
$id = mango_current_page_id();

//Breadcrumb styles
$wrapper =  mango_wrapper_class();
// body boxed color or image style
if( $wrapper =='boxed' || $wrapper =='boxed-long'){
    $bg_color ='';
    $bg_mode =  get_post_meta ( $id, 'mango_bg_mode', true ) ? get_post_meta ( $id, 'mango_bg_mode', true ) : '';
    if(!$bg_mode){
        $bg_mode = ( isset( $mango_settings[ 'mango_bg_mode' ] ) ) ? $mango_settings[ 'mango_bg_mode' ] : '';
    }

    if($bg_mode== 'image'){
        $bg_image =  get_post_meta ( $id, 'mango_bg_select', true ) ? get_post_meta ( $id, 'mango_bg_select', true ) : '';
        if(!$bg_image){
           $bg_image = ( isset( $mango_settings[ 'mango_bg_select' ] ) ) ? $mango_settings[ 'mango_bg_select' ] : '';
        }
    }elseif($bg_mode=='custom-image'){
      $bg_img =  get_post_meta ( $id, 'mango_bg_custom_select', true ) ? get_post_meta ( $id, 'mango_bg_custom_select', true ) : '';
        if(!$bg_img){
            $bg_image = ( isset( $mango_settings[ 'mango_bg_custom_select' ] ) ) ? $mango_settings[ 'mango_bg_custom_select' ]['background-image'] : '';
        }else{
            $img_src = wp_get_attachment_image_src( $bg_img, 'full' ) ;
            $bg_image = $img_src[0];
        }
    }

    $bg_color =  get_post_meta ( $id, 'mango_bg_color', true ) ? get_post_meta ( $id, 'mango_bg_color', true ) : '';
    if(!$bg_color){
        $bg_color = ( isset( $mango_settings[ 'mango_bg_color' ] ) ) ? $mango_settings[ 'mango_bg_color' ] : '';
    }

    $bg_repeat =  get_post_meta ( $id, 'mango_bg_repeat', true ) ? get_post_meta ( $id, 'mango_bg_repeat', true ) : '';
    if(!$bg_repeat){
        $bg_repeat = ( isset( $mango_settings[ 'mango_bg_repeat' ] ) ) ? $mango_settings[ 'mango_bg_repeat' ] : '';
    }

    $bg_position =  get_post_meta ( $id, 'mango_bg_position', true ) ? get_post_meta ( $id, 'mango_bg_position', true ) : '';
    if(!$bg_position){
        $bg_position = ( isset( $mango_settings[ 'mango_bg_position' ] ) ) ? $mango_settings[ 'mango_bg_position' ] : '';
    }

    $bg_size =  get_post_meta ( $id, 'mango_bg_size', true ) ? get_post_meta ( $id, 'mango_bg_size', true ) : '';
    if(!$bg_size){
        $bg_size = ( isset( $mango_settings[ 'mango_bg_size' ] ) ) ? $mango_settings[ 'mango_bg_size' ] : '';
    } ?>

body{
    <?php
    if($bg_image){ ?>
        background-image: url('<?php echo esc_url($bg_image); ?>');
    <?php }
    if($bg_color){?>
        background-color: <?php echo esc_attr($bg_color) ?>;
    <?php }
    if($bg_repeat){ ?>
        background-repeat: <?php echo esc_attr($bg_repeat) ?>;
    <?php }
    if($bg_size){?>
        background-size: <?php echo esc_attr($bg_size) ?>;
        -webkit-background-size:<?php echo esc_attr($bg_size) ?>;
    <?php }
    if($bg_position){?>
        background-position: <?php echo esc_attr($bg_position) ?>;
    <?php } ?>
}
<?php }

$bread_bg_type = ( get_post_meta (  $id, 'mango_bread_title_bg', true )  ) ? get_post_meta (  $id, 'mango_bread_title_bg', true ) : '';
if(!$bread_bg_type) {
    $bread_bg_type = isset( $mango_settings[ 'mango_bread_title_bg' ] ) ? $mango_settings[ 'mango_bread_title_bg' ] : '';
}

$bread_border_color = ( get_post_meta (  $id, 'mango_bread_title_border_color', true ) ) ? get_post_meta (  $id, 'mango_bread_title_border_color', true ) : '';
if(!$bread_border_color) {
    $bread_border_color = isset( $mango_settings[ 'mango_bread_title_border_color' ] ) ? $mango_settings[ 'mango_bread_title_border_color' ] : '';
}
$bread_text_color = ( get_post_meta (  $id, 'mango_bread_title_color', true ) ) ? get_post_meta (  $id, 'mango_bread_title_color', true ) : '';
if(!$bread_text_color) {
    $bread_text_color = isset( $mango_settings[ 'mango_bread_title_color' ] ) ? $mango_settings[ 'mango_bread_title_color' ] : '';
}
$bread_bg_color = '';
$bread_img_src = array();
//mango_bread_title_color
if($bread_bg_type=='bg-color'){
    $bread_bg_color = ( get_post_meta (  $id, 'mango_bread_title_bg_color', true )  ) ? get_post_meta (  $id, 'mango_bread_title_bg_color', true ) : '';
    if(!$bread_bg_color) {
        $bread_bg_color = isset( $mango_settings[ 'mango_bread_title_bg_color' ] ) ? $mango_settings[ 'mango_bread_title_bg_color' ] : '';
    }
}else{
     $bread_bg_img = ( get_post_meta (  $id, 'mango_bread_title_image', true ) ) ? get_post_meta (  $id, 'mango_bread_title_image', true ) : '';
        if($bread_bg_img) {
            $bread_img_src = wp_get_attachment_image_src( $bread_bg_img, 'full' ) ;
        }else{
            $bread_img_src[0] = esc_url($mango_settings['mango_bread_title_image']['url']);
        }
} ?>

div.page-header{
    <?php if($bread_border_color){ ?>
        border-color:<?php echo esc_attr($bread_border_color) ?>;
    <?php } ?>
    <?php if(!empty($bread_img_src)){ ?>
        background-image:url('<?php echo esc_url($bread_img_src[0]) ?>');
    <?php } ?>
    <?php if($bread_bg_color){ ?>
        background-color:<?php echo esc_attr($bread_bg_color) ?>;
    <?php } ?>
}

div.page-header .bigger, div.page-header .breadcrumb{
    <?php if($bread_text_color){ ?>
        color: <?php echo esc_attr($bread_text_color); ?>
    <?php } ?>
}

<?php   //popup styles
$enable_popup = 'off';
    $enable_popup = ( get_post_meta (  $id, 'mango_popup_e_d', true ) ) ? get_post_meta (  $id, 'mango_popup_e_d', true ) : '';
    if($enable_popup=='on'){
      $bg_img_popup =  get_post_meta ( $id, 'mango_popup_image', true ) ? get_post_meta ( $id, 'mango_popup_image', true ) : '';
      if($bg_img_popup){
        $img_src = wp_get_attachment_image_src( $bg_img_popup, 'full' ) ;
        $bg_img_popup = $img_src[0];
      }
      $bg_color_popup =  get_post_meta ( $id, 'mango_popup_bg_color', true ) ? get_post_meta ( $id, 'mango_popup_bg_color', true ) : '';
      $bg_repeat_popup =  get_post_meta ( $id, 'mango_popup_bg_repeat', true ) ? get_post_meta ( $id, 'mango_popup_bg_repeat', true ) : '';
      $bg_pos_popup =  get_post_meta ( $id, 'mango_popup_bg_position', true ) ? get_post_meta ( $id, 'mango_popup_bg_position', true ) : '';
      $bg_size_popup =  get_post_meta ( $id, 'mango_popup_bg_size', true ) ? get_post_meta ( $id, 'mango_popup_bg_size', true ) : '';
    ?>
.newsletter-popup {
    <?php if($bg_img_popup){ ?>
        background-image:url("<?php echo esc_url($bg_img_popup); ?>") !important;
    <?php } ?>
    <?php if($bg_color_popup){ ?>
        background-color: <?php echo esc_attr($bg_color_popup); ?> !important;
    <?php } ?>
    <?php if($bg_repeat_popup){ ?>
        background-repeat: <?php echo esc_attr($bg_repeat_popup); ?> !important;
    <?php } ?>
    <?php if($bg_pos_popup){ ?>
        background-position: <?php echo esc_attr($bg_pos_popup); ?> !important;
    <?php } ?>
    <?php if($bg_size_popup){ ?>
        background-size: <?php echo esc_attr($bg_size_popup); ?>;
        -moz-background-size: <?php echo esc_attr($bg_size_popup); ?>;
        -o-background-size: <?php echo esc_attr($bg_size_popup); ?>;
        -webkit-background-size: <?php echo esc_attr($bg_size_popup); ?>;
    <?php } ?>
}
<?php } ?>
<?php
if(is_page_template("templates/coming_soon.php")){
    $coming_soon_bg = get_post_meta($id, 'mango_coming_soon_bg_image', true);
    if($coming_soon_bg){
        $img_src = wp_get_attachment_image_src( $coming_soon_bg, 'full' ) ;
    ?>
#coming-soon.coming-soonbg{
    background-image: url("<?php echo esc_url($img_src[0]);  ?>");
}
<?php } } ?>
 
    body>header{
    <?php
    $header_bg_img_src = '';
    $side_header_bg= get_post_meta($id, 'mango_side_header_bg', true);
    if($side_header_bg){
        $header_bg_img_src = wp_get_attachment_image_src( $side_header_bg, 'full' ) ; ?>
        background-image: url("<?php echo esc_url($header_bg_img_src[0]);?>");
    <?php }?>
    }
</style>