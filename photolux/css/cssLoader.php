<?php

if(!function_exists('pexeto_print_additional_css')){
	function pexeto_print_additional_css(){

		$pexeto_css = array(
		'theme_skin'=>get_opt('_theme_skin'),
			'skin'=>get_opt('_skin'),
			'custom_color'=>get_opt('_custom_skin'),
			'pattern'=>get_opt('_pattern'),
			'custom_pattern'=>get_opt('_custom_pattern'),
			'body_color' => get_opt('_body_color'),
			'body_bg' => get_opt('_body_bg'),
			'custom_body_bg' => get_opt('_custom_body_bg'),
			'body_text_size' => get_opt('_body_text_size'),
			'logo_image' => get_opt('_logo_image'),
			'logo_width' => get_opt('_logo_width'),
			'logo_height' => get_opt('_logo_height'),
			'link_color' => get_opt('_link_color'),
			'heading_color' => get_opt('_heading_color'),
			'menu_link_color' => get_opt('_menu_link_color'),
			'secondary_color' => get_opt('_secondary_color'),
			'boxes_color' => get_opt('_boxes_color'),
			'subtitle_color' => get_opt('_subtitle_color'),
			'comments_bg' => get_opt('_comments_bg'),
			'footer_bg' => get_opt('_footer_bg'),
			'footer_text_color' => get_opt('_footer_text_color'),
			'heading_font_family'=>get_opt('_heading_font_family'),
			'body_font_family'=>get_opt('_body_font_family')
		);

		$css='<style type="text/css">';

		$pexeto_main_color=$pexeto_css['custom_color']==''?$pexeto_css['skin']:$pexeto_css['custom_color'];

		/**--------------------------------------------------------------------*
		 * SET THE BACKGROUND COLOR AND PATTERN
		 *---------------------------------------------------------------------*/

		if($pexeto_css['custom_pattern']!='' || ($pexeto_css['pattern']!='' && $pexeto_css['pattern']!='none')){
			if($pexeto_css['custom_pattern']!=''){
			$bg=$pexeto_css['custom_pattern'];
			}else{
			$bg=get_bloginfo('template_url').'/images/patterns/'.$pexeto_css['pattern'];
			}
			$css.= 'body{background-image:url('.$bg.');}';
		}

		$bgcolor=$pexeto_css['custom_body_bg']?$pexeto_css['custom_body_bg']:$pexeto_css['body_bg'];
		if($bgcolor!=''){
			$css.= 'body {background-color:#'.$bgcolor.';}';
		}

		if($pexeto_css['body_text_size']!=''){
			$css.= 'body, .sidebar,#footer ul li a,#footer{font-size:'.$pexeto_css['body_text_size'].'px;}';
		}

		if($pexeto_css['secondary_color']!=''){
			$css.= 'a.read-more, .no-caps{color:#'.$pexeto_css['secondary_color'].';}';
			$css.= '.button, #submit, input[type=submit], td#today, table#wp-calendar td:hover, table#wp-calendar td#today, table#wp-calendar td:hover a, table#wp-calendar td#today a{background-color:#'.$pexeto_css['secondary_color'].';}';
		}

		/**--------------------------------------------------------------------*
		 * SET THE LOGO
		 *---------------------------------------------------------------------*/

		if($pexeto_css['logo_width']!=''){
			$css.= '#logo-container a img{max-width:'.$pexeto_css['logo_width'].'px;}';
		}


		if($pexeto_css['logo_height']!=''){
			$css.= '#logo-container a img{max-height:'.$pexeto_css['logo_height'].'px;}';
		}

		/**--------------------------------------------------------------------*
		 * TEXT COLORS
		 *---------------------------------------------------------------------*/

		if($pexeto_css['body_color']!=''){
			$css.= 'body, .sidebar-box ul li a,#portfolio-big-pagination a,.sidebar-box h4, #slider, .no-caps, .post-date h4, .post-date span, #sidebar .widget_categories ul li a, #sidebar .widget_nav_menu ul li a, blockquote {color:#'.$pexeto_css['body_color'].';}';
		}

		if($pexeto_css['link_color']!=''){
			$css.= 'a,.post-info, .post-info a, #main-container .sidebar-box ul li a{color:#'.$pexeto_css['link_color'].';}';
		}

		if($pexeto_css['heading_color']!=''){
			$css.= 'h1,h2,h3,h4,h5,h6,.sidebar-box h4,.post h1, .blog-post h1 a, .content-box h2, #portfolio-categories ul li, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .services-box h4, #intro h1, #page-title h1, .item-desc h4 a, .item-desc h4, .sidebar-post-wrapper h6 a, table th, .tabs a, .post-title a:hover{color:#'.$pexeto_css['heading_color'].';}';
		}

		if($pexeto_css['menu_link_color']!=''){
			$css.= '#menu ul li a{color:#'.$pexeto_css['menu_link_color'].';}';
		}

		if($pexeto_css['footer_text_color']!=''){
			$css.= '#footer,#footer ul li a,#footer ul li a:hover,#footer h4, .copyrights{color:#'.$pexeto_css['footer_text_color'].';}';
		}


		/**--------------------------------------------------------------------*
		 * FONTS
		 *---------------------------------------------------------------------*/
		if($pexeto_css['heading_font_family']!=''){
			$css.= 'h1,h2,h3,h4,h5,h6,.accordion-description a,#content-container .wp-pagenavi,#portfolio-categories ul li.selected,.table-title td,.table-description strong,table th,.tabs a{font-family:'.$pexeto_css['heading_font_family'].';}';
		}

		if($pexeto_css['body_font_family']!=''){
			$css.= 'body, .content-box .post-info{font-family:'.$pexeto_css['body_font_family'].';}';
		}



		/**--------------------------------------------------------------------*
		 * ADDITIONAL STYLES
		 *---------------------------------------------------------------------*/

		if(get_opt('_additional_styles')!=''){
			$css.=get_opt('_additional_styles');
		}

		$css.='</style>';

		echo $css;
	}
}


?>