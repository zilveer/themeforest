<?php

$button_color = get_post_meta( get_the_ID(), '_button_skin', true ) ? get_post_meta( get_the_ID(), '_button_skin', true ) : '';
$button_text_color = get_post_meta( get_the_ID(), '_button_text_color', true ) ? get_post_meta( get_the_ID(), '_button_text_color', true ) : 'light';

if ($view_params['featured'] == 'true') {
    
    $button_color = $button_color ? $button_color : get_post_meta(get_the_ID() , 'skin', true);
    
    if ($view_params['style'] == 'monocolor') {
        $button_color = $button_color ? $button_color : $mk_options['skin_color'];
    }
} 
else {
    
    if ($view_params['style'] == 'monocolor') {
        $button_color = $button_color ? $button_color : '#727272';
    } 
    else {
        $button_color = $button_color ? $button_color : '#969696';
    }
}

$button_text = get_post_meta( get_the_ID(), '_btn_text', true );

if(empty($button_text)) return false;

$button_style = get_post_meta( get_the_ID(), '_button_style', true );
$button_style = $button_style ? $button_style : 'flat';


$button_atts[] = 'dimension="'.$button_style.'"';
$button_atts[] = 'size="large"';
$button_atts[] = 'target="_self"';
$button_atts[] = 'align="center"';
$button_atts[] = 'button_custom_width="0"';
$button_atts[] = 'url="'.get_post_meta( get_the_ID(), '_btn_url', true ).'"';

if($button_style == 'flat') {
    
    $button_text_color = ($button_text_color == '' || $button_text_color == 'light') ? 'light' : 'dark';
    $button_atts[] = 'bg_color="'.$button_color.'"';
    $button_atts[] = 'text_color="'.$button_text_color.'"';
    $button_atts[] = 'btn_hover_bg="'.hexDarker($button_color, 7).'"';
    $button_text_color = ($button_text_color == '' || $button_text_color == 'light') ? '#ffffff' : '#585858';
    $button_atts[] = 'btn_hover_txt_color="'.hexDarker($button_text_color, 7).'"';


}else if ($button_style == 'three' || $button_style == 'two') {
    

    //$button_text_color = ($button_text_color == 'light') ? '#ffffff' : '#585858';
    $button_atts[] = 'bg_color="'.$button_color.'"';
    $button_atts[] = 'text_color="'.$button_text_color.'"';

}else if ($button_style == 'outline') {
    
    $button_text_color = ($button_text_color == 'light') ? '#ffffff' : '#585858';
    $button_atts[] = 'outline_skin="custom"';
    $button_atts[] = 'outline_active_color="'.$button_color.'"';
    $button_atts[] = 'outline_active_text_color="'.$button_color.'"';
    $button_atts[] = 'outline_hover_bg_color="'.hexDarker($button_color, 7).'"';
    $button_atts[] = 'outline_hover_color="'.hexDarker($button_text_color, 7).'"';
}

?>
<div class="pricing-button">
<?php echo do_shortcode( '[mk_button '.implode(' ', $button_atts).']'.$button_text.'[/mk_button]' ); ?>
<div class="clearboth"></div>
</div>