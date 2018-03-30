<?php header("Content-type: text/css; charset: UTF-8"); 

require_once( '../../../../wp-load.php' );

$pexeto_css = array(
	'skin'=>get_opt('_skin'),
	'custom_color'=>get_opt('_custom_skin'),
	'pattern'=>get_opt('_pattern'),
'custom_pattern'=>get_opt('_custom_pattern'),
	'body_color' => get_opt('_body_color'),
	'body_bg' => get_opt('_body_bg'),
	'body_text_size' => get_opt('_body_text_size'),
	'logo_image' => get_opt('_logo_image'),
	'logo_width' => get_opt('_logo_width'),
	'logo_height' => get_opt('_logo_height'),
	'link_color' => get_opt('_link_color'),
	'heading_color' => get_opt('_heading_color'),
	'menu_link_color' => get_opt('_menu_link_color'),
	'menu_link_hover' => get_opt('_menu_link_hover'),
	'boxes_color' => get_opt('_boxes_color'),
	'subtitle_color' => get_opt('_subtitle_color'),
	'comments_bg' => get_opt('_comments_bg'),
	'footer_bg' => get_opt('_footer_bg'),
	'footer_text_color' => get_opt('_footer_text_color'),
	'footer_lines_color' => get_opt('_footer_lines_color'),
	'subtitle_bg' => get_opt('_subtitle_bg'),
	'copyright_bg' => get_opt('_copyright_bg'),
	'copyright_text' => get_opt('_copyright_text'),
	'border_color' => get_opt('_border_color')
);


$pexeto_main_color=$pexeto_css['custom_color']==''?$pexeto_css['skin']:$pexeto_css['custom_color'];

/**--------------------------------------------------------------------*
 * SET THE BACKGROUND COLOR AND PATTERN
 *---------------------------------------------------------------------*/

if($pexeto_main_color!=''){
	echo '#header, #menu ul ul li, #portfolio-pagination ul li .navbg{background-color:#'.$pexeto_main_color.';}';
}

if($pexeto_css['custom_pattern']!='' || ($pexeto_css['pattern']!='' && $pexeto_css['pattern']!='none')){
	if($pexeto_css['custom_pattern']!=''){
	echo '#header-bg{background-image:url("'.$pexeto_css['custom_pattern'].'");}';
	}elseif($pexeto_css['pattern']!='none'){
	echo '#header-bg{background-image:url("'.get_bloginfo('template_url').'/images/patterns/'.$pexeto_css['pattern'].'");}';
	}else{
	echo '#header-bg{background-image:none;}';
	}
}

if($pexeto_css['body_color']!=''){
	echo 'body, .sidebar-box ul li a,#portfolio-big-pagination a,.sidebar-box h4 {color:#'.$pexeto_css['body_color'].';}';
}

if($pexeto_css['body_bg']!=''){
	echo 'img.img-frame, img.attachment-post_box_img, .img-frame img, .img-wrapper, .blog-post-img img, body{background-color:#'.$pexeto_css['body_bg'].';}';
}

if($pexeto_css['body_text_size']!=''){
	echo 'body, .sidebar,#footer ul li a,#footer{font-size:'.$pexeto_css['body_text_size'].'px;}';
}

/**--------------------------------------------------------------------*
 * SET THE LOGO
 *---------------------------------------------------------------------*/

if($pexeto_css['logo_image']!=''){
	echo '#logo-container a{background-image:url('.$pexeto_css['logo_image'].');}';
}

if($pexeto_css['logo_width']!=''){
	echo '#logo-container a{width:'.$pexeto_css['logo_width'].'px;}';
}

if($pexeto_css['logo_height']!=''){
	echo '#logo-container a, #logo-spacer{height:'.$pexeto_css['logo_height'].'px;}';
	echo '#logo-spacer{height:'.($pexeto_css['logo_height']+17).'px;}';
}

/**--------------------------------------------------------------------*
 * TEXT COLORS
 *---------------------------------------------------------------------*/

if($pexeto_css['link_color']!=''){
	echo 'a,.post-info, .post-info a{color:#'.$pexeto_css['link_color'].';}';
}

if($pexeto_css['heading_color']!=''){
	echo 'h1,h2,h3,h4,h5,h6,.sidebar-box h4,.services-box h4 span,.blog-post h1, .blog-post h1 a,.portfolio-sidebar h4, #portfolio-categories ul li, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .services-box h4, .intro-text{color:#'.$pexeto_css['heading_color'].';}';
}

if($pexeto_css['menu_link_color']!=''){
	echo '#menu ul li a{color:#'.$pexeto_css['menu_link_color'].';}';
}

if($pexeto_css['menu_link_hover']!=''){
	echo '#menu ul li a:hover{color:#'.$pexeto_css['menu_link_hover'].';}';
}

if($pexeto_css['subtitle_color']!=''){
	echo '#page-title, #content-slider, #content-slider h2{color:#'.$pexeto_css['subtitle_color'].';}';
}

if($pexeto_css['footer_text_color']!=''){
	echo '#footer,#footer ul li a,#footer ul li a:hover,#footer h4{color:#'.$pexeto_css['footer_text_color'].';}';
}

if($pexeto_css['copyright_text']!=''){
	echo '#copyrights h5, #copyrights h5 a {color:#'.$pexeto_css['copyright_text'].';}';
}

/**--------------------------------------------------------------------*
 * BACKGROUNDS
 *---------------------------------------------------------------------*/

if($pexeto_css['comments_bg']!=''){
	echo '.comment-container{background-color:#'.$pexeto_css['comments_bg'].';}';
}

if($pexeto_css['footer_bg']!=''){
	echo '#footer-container {background-color:#'.$pexeto_css['footer_bg'].';}';
}

if($pexeto_css['border_color']!=''){
	echo 'hr, ul.blogroll li, .sidebar-box h4, .sidebar-box ul li, .post-info, img.img-frame, img.attachment-post_box_img, #portfolio-categories,.blog-post, .comment-container {border-color:#'.$pexeto_css['border_color'].';}';
}


if($pexeto_css['copyright_bg']!=''){
	echo '#copyrights {background-color:#'.$pexeto_css['copyright_bg'].';}';
}

if($pexeto_css['footer_lines_color']!=''){
	echo '#footer-line{background-color:#'.$pexeto_css['footer_lines_color'].';}';
	echo '#footer .double-hr,#footer ul li a, #footer ul li,#footer-line, .footer-border{border-color:#'.$pexeto_css['footer_lines_color'].';}';
}


/**--------------------------------------------------------------------*
 * ADDITIONAL STYLES
 *---------------------------------------------------------------------*/

if(get_opt('_additional_styles')!=''){
	echo(get_opt('_additional_styles'));
}
?>