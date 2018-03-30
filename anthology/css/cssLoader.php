<?php header("Content-type: text/css; charset: UTF-8");
require_once( '../../../../wp-load.php' );

$pexeto_css = array(
	'skin'=>get_opt('_skin'),
	'custom_color'=>get_opt('_custom_skin'),
	'pattern'=>get_opt('_pattern'),
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
	'footer_lines_color' => get_opt('_footer_lines_color')
);


$pexeto_main_color=$pexeto_css['custom_color']==''?$pexeto_css['skin']:$pexeto_css['custom_color'];

if($pexeto_main_color!=''){
	echo '#slider-container, #page-title{background-color:#'.$pexeto_main_color.';}';
}

if($pexeto_css['pattern']!='' && $pexeto_css['pattern']!='none'){
	echo '#slider-container, #page-title{background-image:url('.get_bloginfo('template_url').'/images/patterns/'.$pexeto_css['pattern'].');}';
}

if($pexeto_css['body_color']!=''){
	echo 'body, .sidebar-box ul li a,#portfolio-big-pagination a{color:#'.$pexeto_css['body_color'].';}';
}

if($pexeto_css['body_bg']!=''){
	echo 'body,#menu ul ul li,img.shadow-frame, .blog-post-img img{background-color:#'.$pexeto_css['body_bg'].';}';
}

if($pexeto_css['body_text_size']!=''){
	echo 'body, .sidebar,#footer ul li a,#footer{font-size:'.$pexeto_css['body_text_size'].'px;}';
}

if($pexeto_css['logo_image']!=''){
	echo '#logo-container a{background-image:url('.$pexeto_css['logo_image'].');}';
}

if($pexeto_css['logo_width']!=''){
	echo '#logo-container a{width:'.$pexeto_css['logo_width'].'px;}';
}

if($pexeto_css['logo_height']!=''){
	echo '#logo-container a{height:'.$pexeto_css['logo_height'].'px;}';
}

if($pexeto_css['link_color']!=''){
	echo 'a,.post-info{color:#'.$pexeto_css['link_color'].';}';
}

if($pexeto_css['heading_color']!=''){
	echo 'h1,h2,h3,h4,h5,h6,.sidebar-box h4,.services-box h4 span,.blog-post h1, .blog-post h1 a,.portfolio-sidebar h4{color:#'.$pexeto_css['heading_color'].';}';
}

if($pexeto_css['menu_link_color']!=''){
	echo '#menu ul li a{color:#'.$pexeto_css['menu_link_color'].';}';
}

if($pexeto_css['menu_link_hover']!=''){
	echo '#menu ul li a:hover{color:#'.$pexeto_css['menu_link_hover'].';}';
}

if($pexeto_css['boxes_color']!=''){
	echo '.services-box, .pricing-box, .services-box span, .pricing-box span{background-color:#'.$pexeto_css['boxes_color'].';}';
}

if($pexeto_css['subtitle_color']!=''){
	echo '#page-title h6{color:#'.$pexeto_css['subtitle_color'].';}';
}

if($pexeto_css['comments_bg']!=''){
	echo '.commentContainer{background-color:#'.$pexeto_css['comments_bg'].';}';
}

if($pexeto_css['footer_bg']!=''){
	echo '#footer-container {background-color:#'.$pexeto_css['footer_bg'].';}';
}

if($pexeto_css['footer_text_color']!=''){
	echo '#footer,#footer ul li a,#footer ul li a:hover,#footer h4{color:#'.$pexeto_css['footer_text_color'].';}';
}

if($pexeto_css['footer_lines_color']!=''){
	echo '#footer-line{background-color:#'.$pexeto_css['footer_lines_color'].';}';
	echo '#footer .double-hr,#footer ul li a,#footer-line{border-color:#'.$pexeto_css['footer_lines_color'].';}';
}



//print the additional styles
if(get_opt('_additional_styles')!=''){
	echo(get_opt('_additional_styles'));
}
?>