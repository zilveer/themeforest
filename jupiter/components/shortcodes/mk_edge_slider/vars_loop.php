<?php

$type =  get_post_meta( $post->ID, '_edge_type', true ) ? get_post_meta( $post->ID, '_edge_type', true ) : 'image';
$animation =  get_post_meta( $post->ID, '_animation', true ) ? get_post_meta( $post->ID, '_animation', true ) : 'default_anim';
$mp4 =  get_post_meta( $post->ID, '_video_mp4', true );
$webm =  get_post_meta( $post->ID, '_video_webm', true );
$ogv =  get_post_meta( $post->ID, '_video_ogv', true );
$video_preview =  get_post_meta( $post->ID, '_video_preview', true );
$video_pattern =  get_post_meta( $post->ID, '_video_pattern', true );
$video_overlay =  get_post_meta( $post->ID, '_video_color_overlay', true );
$overlay_opacity =  get_post_meta( $post->ID, '_overlay_opacity', true ) ? get_post_meta( $post->ID, '_overlay_opacity', true ) : 0.3;

$slide_image =  get_post_meta( $post->ID, '_slide_image', true );
$slide_image_portrait =  get_post_meta( $post->ID, '_slide_image_portrait', true );
$slide_bg_color =  get_post_meta( $post->ID, '_bg_color', true );
$cover_bg =  get_post_meta( $post->ID, '_cover', true );

$content_width =  get_post_meta( $post->ID, '_content_width', true ) ? get_post_meta( $post->ID, '_content_width', true ) : 70;
$title =  get_post_meta( $post->ID, '_title', true );
$description =  get_post_meta( $post->ID, '_description', true );

$title_size           = get_post_meta($post->ID, '_title_size', true) ? ('font-size : '.(get_post_meta($post->ID, '_title_size', true)/16).'em;') : '';
$title_letter_spacing         = get_post_meta($post->ID, '_title_letter_spacing', true) ? ('letter-spacing:'.get_post_meta($post->ID, '_title_letter_spacing', true).'px;') : '';

$title_weight         = get_post_meta($post->ID, '_caption_title_weight', true) ? ('font-weight:'.get_post_meta($post->ID, '_caption_title_weight', true).';') : '';
$caption_custom_color = get_post_meta($post->ID, '_custom_caption_color', true) ? ('color:'.get_post_meta($post->ID, '_custom_caption_color', true).';') : '';

$btn_1_txt =  get_post_meta( $post->ID, '_btn_1_txt', true );
$btn_1_url =  get_post_meta( $post->ID, '_btn_1_url', true );
$btn_1_target =  get_post_meta( $post->ID, '_btn_1_target', true );
$btn_2_txt =  get_post_meta( $post->ID, '_btn_2_txt', true );
$btn_2_url =  get_post_meta( $post->ID, '_btn_2_url', true );
$btn_2_target =  get_post_meta( $post->ID, '_btn_2_target', true );

$caption_skin =  get_post_meta( $post->ID, '_caption_skin', true );

$btn_1_style =  get_post_meta( $post->ID, '_btn_1_style', true );
$btn_2_style =  get_post_meta( $post->ID, '_btn_2_style', true );

$btn_1_corner_style =  get_post_meta( $post->ID, '_btn_1_corner_style', true ) ? get_post_meta( $post->ID, '_btn_1_corner_style', true ) : 'pointed';
$btn_2_corner_style =  get_post_meta( $post->ID, '_btn_2_corner_style', true ) ? get_post_meta( $post->ID, '_btn_2_corner_style', true ) : 'pointed';

$btn_1_skin =  get_post_meta( $post->ID, '_btn_1_skin', true );
$btn_2_skin =  get_post_meta( $post->ID, '_btn_2_skin', true );
$caption_align =  get_post_meta( $post->ID, '_caption_align', true );
$header_skin_meta = get_post_meta($post->ID, '_edge_header_skin', true);
$header_skin = $header_skin_meta ? $header_skin_meta : 'dark';


if( $btn_1_style == 'flat' ) {
	if( $btn_1_skin == 'light' ) {
		$button1_bg_color = '#ffffff';
		$button1_txt_color = 'dark';

	} else if( $btn_1_skin == 'dark' ) {
		$button1_bg_color = '#252525';
		$button1_txt_color = 'light';

	} else if( $btn_1_skin == 'skin' ) {
		$button1_bg_color = $mk_options['skin_color'];
		$button1_txt_color = 'light';
	}
}

if( $btn_2_style == 'flat' ) {
	if( $btn_2_skin == 'light' ) {
		$button2_bg_color = '#ffffff';
		$button2_txt_color = 'dark';

	} else if( $btn_2_skin == 'dark' ) {
		$button2_bg_color = '#252525';
		$button2_txt_color = 'light';

	} else if( $btn_2_skin == 'skin' ) {
		$button2_bg_color = $mk_options['skin_color'];
		$button2_txt_color = 'light';
	}
}

if( $btn_1_style == 'outline' ) {
	if( $btn_1_skin == 'light' ) {
		$outline1_active_color = '#ffffff';
		$outline1_hover_color = '#252525';

	} else if( $btn_1_skin == 'dark' ) {
		$outline1_active_color = '#252525';
		$outline1_hover_color = '#ffffff';

	} else if( $btn_1_skin == 'skin' ) {
		$outline1_active_color = $mk_options['skin_color'];
		$outline1_hover_color = '#ffffff';
	}
}

if( $btn_2_style == 'outline' ) {
	if( $btn_2_skin == 'light' ) {
		$outline2_active_color = '#ffffff';
		$outline2_hover_color = '#252525';

	} else if( $btn_2_skin == 'dark' ) {
		$outline2_active_color = '#252525';
		$outline2_hover_color = '#ffffff';

	} else if( $btn_2_skin == 'skin' ) { 
		$outline2_active_color = $mk_options['skin_color'];
		$outline2_hover_color = '#ffffff';
	}
}

$btn1_atts[] = 'dimension="'.$btn_1_style.'"';
$btn1_atts[] = 'corner_style="'.$btn_1_corner_style.'"';
$btn1_atts[] = 'size="large"';
$btn1_atts[] = 'url="'.$btn_1_url.'"';
$btn1_atts[] = 'target="'.$btn_1_target.'"';
$btn1_atts[] = 'align="none"';
$btn1_atts[] = 'margin_top="0"';
$btn1_atts[] = 'margin_bottom="0"';
$btn1_atts[] = 'button_custom_width="0"';
$btn1_atts[] = (preg_match('/#/',$btn_1_url)) ? ' el_class="mk-smooth"' : '';
if($btn_1_style == 'flat'){
   $btn1_atts[] = 'bg_color="'.$button1_bg_color.'"';
   $btn1_atts[] = 'text_color="'.$button1_txt_color.'"';
   $btn1_atts[] = 'btn_hover_bg="'.hexDarker($button1_bg_color, 7).'"';
   $button1_txt_color = ($button1_txt_color == '' || $button1_txt_color == 'light') ? '#ffffff' : '#252525';
   $btn1_atts[] = 'btn_hover_txt_color="'.hexDarker($button1_txt_color, 7).'"';
}else if($btn_1_style == 'outline') {
   if ($btn_1_skin == 'light') {
       $btn1_atts[] = 'outline_skin="light"';
   }else if ($btn_1_skin == 'dark') {
       $btn1_atts[] = 'outline_skin="dark"';
   }else if ($btn_1_skin == 'skin') {
   	$btn1_atts[] = 'outline_skin="custom"';
      $btn1_atts[] = 'outline_active_color="'.$outline1_active_color.'"';
      $btn1_atts[] = 'outline_active_text_color="'.$outline1_active_color.'"';
      $btn1_atts[] = 'outline_hover_bg_color="'.$outline1_active_color.'"';
      $btn1_atts[] = 'outline_hover_color="'.$outline1_hover_color.'"'; 
   }
}

$btn2_atts[] = 'dimension="'.$btn_2_style.'"';
$btn2_atts[] = 'corner_style="'.$btn_2_corner_style.'"';
$btn2_atts[] = 'size="large"';
$btn2_atts[] = 'url="'.$btn_2_url.'"';
$btn2_atts[] = 'target="'.$btn_2_target.'"';
$btn2_atts[] = 'align="none"';
$btn2_atts[] = 'margin_top="0"';
$btn2_atts[] = 'margin_bottom="0"';
$btn2_atts[] = 'button_custom_width="0"';
$btn2_atts[] = (preg_match('/#/',$btn_2_url)) ? ' el_class="mk-smooth"' : '';
if($btn_2_style == 'flat'){
   $btn2_atts[] = 'bg_color="'.$button2_bg_color.'"';
   $btn2_atts[] = 'text_color="'.$button2_txt_color.'"';
   $btn2_atts[] = 'btn_hover_bg="'.hexDarker($button2_bg_color, 7).'"';
   $button2_txt_color = ($button2_txt_color == '' || $button2_txt_color == 'light') ? '#ffffff' : '#252525';
   $btn2_atts[] = 'btn_hover_txt_color="'.hexDarker($button2_txt_color, 7).'"';
}else if($btn_2_style == 'outline') {
   if ($btn_2_skin == 'light') {
       $btn2_atts[] = 'outline_skin="light"';
   }else if ($btn_2_skin == 'dark') {
       $btn2_atts[] = 'outline_skin="dark"';
   }else if ($btn_2_skin == 'skin') {
       $btn2_atts[] = 'outline_skin="custom"';
       $btn2_atts[] = 'outline_active_color="'.$outline2_active_color.'"';
       $btn2_atts[] = 'outline_active_text_color="'.$outline2_active_color.'"';
       $btn2_atts[] = 'outline_hover_bg_color="'.$outline2_active_color.'"';
       $btn1_atts[] = 'outline_hover_color="'.$outline2_hover_color.'"';
   }
}


$gradient_layer_atts = array(
	'gradient_layer' => get_post_meta( $post->ID, '_gradient_layer', true ) ? get_post_meta( $post->ID, '_gradient_layer', true ) : 'false',
	'gr_start'       => get_post_meta( $post->ID, '_gr_start', true ) ? get_post_meta( $post->ID, '_gr_start', true ) : '',
    'gr_end'         => get_post_meta( $post->ID, '_gr_end', true ) ? get_post_meta( $post->ID, '_gr_end', true ) : '',
);