<?php
/**
 *
 *
 * @author  Bob Ulusoy
 * @copyright Copyright (c) Bob Ulusoy
 * @link  http://artbees.net
 * @since  Version 2.0
 * @package  MK Framework
 */



add_action( 'header_logo', 'mk_header_logo' );
add_action( 'main_navigation', 'mk_main_navigation' );
add_action( 'vertical_navigation', 'mk_vertical_navigation' );
add_action( 'header_search', 'mk_header_search' );
add_action( 'header_search_form', 'mk_header_search_form' );
add_action( 'header_social', 'mk_header_social');
add_action( 'header_toolbar_social', 'mk_header_toolbar_social');

add_action( 'header_toolbar_contact', 'mk_header_toolbar_contact');
add_action( 'header_toolbar_menu', 'mk_header_toolbar_menu');


add_action( 'side_dashboard', 'mk_side_dashboard' );
add_action( 'dashboard_trigger_link', 'mk_dashboard_trigger_link' );
add_action( 'responsive_nav_trigger_link', 'mk_responsive_nav_trigger_link' );
add_action( 'margin_style_burger_icon', 'mk_margin_style_burger_icon' );
add_action( 'vertical_header_burger_icon', 'mk_vertical_header_burger_icon' );




/*
* Create Header Logo
******/
if ( !function_exists( 'mk_header_logo' ) ) {
	function mk_header_logo() {

		global $mk_settings;

		$logo = isset($mk_settings['logo']['url']) ? $mk_settings['logo']['url'] : '';
		$logo_retina = isset($mk_settings['logo-retina']['url']) ? $mk_settings['logo-retina']['url'] : '';

		$light_logo = isset($mk_settings['logo-light']['url']) ? $mk_settings['logo-light']['url'] : '';
		$light_logo_retina = isset($mk_settings['logo-light-retina']['url']) ? $mk_settings['logo-light-retina']['url'] : '';

		$mobile_logo = isset($mk_settings['logo-light']['url']) ? $mk_settings['mobile-logo']['url'] : '';
		$mobile_logo_retina = isset($mk_settings['logo-light-retina']['url']) ? $mk_settings['mobile-logo-retina']['url'] : '';

		$post_id = global_get_post_id();

		if($post_id) {

			$enable = get_post_meta($post_id, '_custom_bg', true );

			if($enable == 'true') {
				$logo_meta = get_post_meta($post_id, 'logo', true );
				$logo_retina_meta = get_post_meta($post_id, 'logo_retina', true );
				$light_logo_meta = get_post_meta($post_id, 'light_logo', true );
				$light_retina_logo_meta = get_post_meta($post_id, 'light_logo_retina', true );
				$logo_mobile_meta = get_post_meta($post_id, 'responsive_logo', true );
				$logo_mobile_retina_meta = get_post_meta($post_id, 'responsive_logo_retina', true );

				$logo = (isset($logo_meta) && !empty($logo_meta)) ? $logo_meta : $logo;
				$logo_retina = (isset($logo_retina_meta) && !empty($logo_retina_meta)) ? $logo_retina_meta : $logo_retina;
				$light_logo = (isset($light_logo_meta) && !empty($light_logo_meta)) ? $light_logo_meta : $light_logo;
				$light_logo_retina = (isset($light_retina_logo_meta) && !empty($light_retina_logo_meta)) ? $light_retina_logo_meta : $light_logo_retina;
				$mobile_logo = (isset($logo_mobile_meta) && !empty($logo_mobile_meta)) ? $logo_mobile_meta : $mobile_logo;
				$mobile_logo = (isset($logo_mobile_meta) && !empty($logo_mobile_meta)) ? $logo_mobile_meta : $mobile_logo_retina;
			}
		}

		$mobile_logo_csss = (!empty($mobile_logo)) ? 'mobile-menu-exists' : '';

		$output = '<li class="mk-header-logo '.$mobile_logo_csss.'">';
		$output .= '<a href="'.home_url( '/' ).'" title="'.get_bloginfo( 'name' ).'">';

		if ( !empty( $logo ) ) {
			$output .= '<img alt="'.get_bloginfo( 'name' ).'" class="mk-dark-logo" src="'.$logo.'" data-retina-src="'.$logo_retina.'" />';
		} else {
			$output .= '<img alt="'.get_bloginfo( 'name' ).'" class="mk-dark-logo" src="'.THEME_IMAGES.'/ken-logo.png" data-retina-src="'.THEME_IMAGES.'/ken-logo-2x.png" />';
		}

		if ( !empty( $mobile_logo) ) {
			$output .= '<img alt="'.get_bloginfo( 'name' ).'" class="mk-mobile-logo" src="'.$mobile_logo.'" data-retina-src="'.$mobile_logo_retina.'" />';
		}

		if ( !empty( $light_logo ) ) {
			$output .= '<img alt="'.get_bloginfo( 'name' ).'" class="mk-light-logo" src="'.$light_logo.'" data-retina-src="'.$light_logo_retina.'" />';
		}


		$output .= '</a></li>';

		echo $output;

	}
}
/***************************************/














/***********************************
Create Vertical Navigation
***********************************/
if(!function_exists('mk_vertical_navigation')) {
	function mk_vertical_navigation($menu_location) {

	global $mk_settings;
	$header_style = $mk_settings['header-structure'];

	if($header_style != 'vertical') return false;

	echo wp_nav_menu( array(
		'theme_location' => $menu_location,
		'container' => false,
		'container_id' => false,
		'container_class' => false,
		'menu_class' => 'mk-vertical-menu',
		'fallback_cb' => '',
		'walker' => new header_icon_walker()
	));
	}
}






/*
* Create Header Search HTML content
******/
if ( !function_exists( 'mk_header_search' ) ) {
	function mk_header_search() {
		global $mk_settings;
		$header_location = (isset($mk_settings['header-search-location']) && !empty($mk_settings['header-search-location']) && $mk_settings['header-search-location'] == 'left') ? 'align-left' : '';
		if($mk_settings['header-search']){
			echo '<li class="mk-header-search '.$header_location.'">
				<a class="header-search-icon" href="#"><i class="mk-icon-search"></i></a>
			</li>';	
		}
	}
}
/***************************************/

/*
* Create WPML Language Selector HTML content
******/
if(defined('ICL_SITEPRESS_VERSION') && defined('ICL_LANGUAGE_CODE')) 
{
	if(!function_exists('mk_wpml_selector'))
	{
		function mk_wpml_selector() {
			$languages = icl_get_languages('skip_missing=0&orderby=id');
			$output = "";

			if(is_array($languages))
			{
				
	       		$output .= '<li class="mk-header-wpml-ls">
	       						<a class="header-wpml-icon" href="#">
	       							<i class="mk-icon-globe"></i>
	       						</a>';
				$output .= '	<ul class="language-selector-box">';
				foreach($languages as $lang)
				{
					$output .= "	<li class='language_".$lang['language_code']."'>
										<a href='".$lang['url']."'>";
					$output .= "			<span class='mk-lang-name'>".$lang['translated_name']."</span>";
					$output .= "		</a>
									</li>";
				}
				$output .= "	</ul>";
				$output .= "</li>";
			}
			
			echo $output;
		}
	}

	add_action( 'header_wpml', 'mk_wpml_selector');
}
/***************************************/




/*
* Create Header Search Form HTML content
******/
if ( !function_exists( 'mk_header_search_form' ) ) {
	function mk_header_search_form() {

	echo '<form method="get" class="header-searchform-input" action="'.home_url().'">
            <input class="search-ajax-input" type="text" value="" name="s" id="s" />
            <input value="" type="submit" />
            <a href="#" class="header-search-close"><i class="mk-icon-close"></i></a>
   		 </form>';

	}
}
/***************************************/



/*
* Create Header Dashboard trigger link Form HTML content. Please note that this link will appear in reposnive mode.
******/
if ( !function_exists( 'mk_dashboard_trigger_link' ) ) {
	function mk_dashboard_trigger_link() {
		global $mk_settings;

		if(!empty($mk_settings['side-dashboard-icon'])){
			$dashboard_icon = $mk_settings['side-dashboard-icon'];
		}else{
			$dashboard_icon = 'mk-theme-icon-dashboard2';
		}

		if($mk_settings['header-structure'] == 'vertical') return false;

		echo '<li class="dashboard-trigger res-mode"><i class="'.$dashboard_icon.'"></i></li>';

	}
}
/***************************************/


/*
* Create Responsive Navigation trigger link Form HTML content. Please note that this link will appear in reposnive mode.
******/
if ( !function_exists( 'mk_responsive_nav_trigger_link' ) ) {
	function mk_responsive_nav_trigger_link() {

		echo '<li class="responsive-nav-link">
			<div class="mk-burger-icon">
	              <div class="burger-icon-1"></div>
	              <div class="burger-icon-2"></div>
	              <div class="burger-icon-3"></div>
            	</div>
		</li>';

	}
}
/***************************************/





/*
* Header Section Social Networks
******/
if ( !function_exists( 'mk_header_social' ) ) {
	function mk_header_social($location) {
		global $mk_settings;

		if($mk_settings['header-social-select'] == 'disabled') return false;
		if($mk_settings['header-social-select'] == 'header_toolbar') return false;

		$output = '';

		if($location == 'outside-grid') {
			$output .= '<div class="mk-header-social '.$location.'">';
		} else {
			$output .= '<li class="mk-header-social '.$location.'">';	
		}	
		
		

		if(!empty($mk_settings['header-social-facebook'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-facebook'].'"><i class="mk-icon-facebook"></i></a>';
		}
		if(!empty($mk_settings['header-social-twitter'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-twitter'].'"><i class="mk-icon-twitter"></i></a>';
		}
		if(!empty($mk_settings['header-social-google-plus'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-google-plus'].'"><i class="mk-icon-google-plus"></i></a>';
		}
		if(!empty($mk_settings['header-social-rss'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-rss'].'"><i class="mk-icon-rss"></i></a>';
		}
		if(!empty($mk_settings['header-social-pinterest'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-pinterest'].'"><i class="mk-icon-pinterest"></i></a>';
		}
		if(!empty($mk_settings['header-social-instagram'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-instagram'].'"><i class="mk-icon-instagram"></i></a>';
		}
		if(!empty($mk_settings['header-social-dribbble'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-dribbble'].'"><i class="mk-icon-dribbble"></i></a>';
		}
		if(!empty($mk_settings['header-social-linkedin'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-linkedin'].'"><i class="mk-icon-linkedin"></i></a>';
		}
		if(!empty($mk_settings['header-social-tumblr'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-tumblr'].'"><i class="mk-icon-tumblr"></i></a>';
		}
		if(!empty($mk_settings['header-social-youtube'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-youtube'].'"><i class="mk-icon-youtube"></i></a>';
		}
		if(!empty($mk_settings['header-social-vimeo'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-vimeo'].'"><i class="mk-theme-icon-social-vimeo"></i></a>';
		}
		if(!empty($mk_settings['header-social-spotify'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-spotify'].'"><i class="mk-theme-icon-social-spotify"></i></a>';
		}

		if(!empty($mk_settings['header-social-weibo'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-weibo'].'"><i class="mk-theme-icon-weibo"></i></a>';
		}
		if(!empty($mk_settings['header-social-wechat'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-wechat'].'"><i class="mk-theme-icon-wechat"></i></a>';
		}
		if(!empty($mk_settings['header-social-renren'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-renren'].'"><i class="mk-theme-icon-renren"></i></a>';
		}
		if(!empty($mk_settings['header-social-imdb'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-imdb'].'"><i class="mk-theme-icon-imdb"></i></a>';
		}
		if(!empty($mk_settings['header-social-vkcom'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-vkcom'].'"><i class="mk-theme-icon-vk"></i></a>';
		}
		if(!empty($mk_settings['header-social-qzone'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-qzone'].'"><i class="mk-theme-icon-qzone"></i></a>';
		}
		if(!empty($mk_settings['header-social-whatsapp'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-whatsapp'].'"><i class="mk-theme-icon-whatsapp"></i></a>';
		}
		if(!empty($mk_settings['header-social-behance'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-behance'].'"><i class="mk-theme-icon-behance"></i></a>';
		}

		if($location == 'outside-grid') {
			$output .= '</div>';	
		} else {
			$output .= '</li>';
		}
		

		echo $output;
	}
}






/*
* Header Structure margin burger icon
******/
if ( !function_exists( 'mk_margin_style_burger_icon' ) ) {
	function mk_margin_style_burger_icon() {

		global $mk_settings; 

		if($mk_settings['header-structure'] != 'margin') return false;

		echo '<div class="mk-margin-header-burger">
				<div class="mk-burger-icon">
	              <div class="burger-icon-1"></div>
	              <div class="burger-icon-2"></div>
	              <div class="burger-icon-3"></div>
            	</div>
              </div>';

	}
}
/***************************************/



/*
* Header Structure Vertical burger icon
******/
if ( !function_exists( 'mk_vertical_header_burger_icon' ) ) {
	function mk_vertical_header_burger_icon() {

		global $mk_settings; 

		

		if($mk_settings['header-structure'] == 'vertical' && $mk_settings['vertical-header-state'] == 'condensed') {

				echo '<li class="mk-vertical-header-burger">
						<div class="mk-burger-icon">
			              <div class="burger-icon-1"></div>
			              <div class="burger-icon-2"></div>
			              <div class="burger-icon-3"></div>
		            	</div>
		              </li>';
          }

	}
}
/***************************************/







/*
* Create Main Navigation
******/
if ( !function_exists( 'mk_main_navigation' ) ) {
	function mk_main_navigation($menu_location) {

		global $mk_settings;
		$header_style = $mk_settings['header-structure'];

		if($header_style == 'vertical') return false;

		$output = '<nav id="mk-main-navigation" '.get_schema_markup('nav').'>';

		$output .= wp_nav_menu( array(
				'theme_location' => $menu_location,
				'container' => false,
				'container_id' => false,
				'container_class' => false,
				'menu_class' => 'main-navigation-ul',
				'echo' => false,
				'fallback_cb' => 'link_to_menu_editor',
				'walker' => new mk_custom_walker
			) );

		$output .= '</nav>';
		
		if($mk_settings['header-search']) {
			ob_start();
			do_action( 'header_search_form' );
			$output .= ob_get_contents();
			ob_end_clean();
		}

		echo $output;

	}
}
/***************************************/




/*
* Fallback menu
******/
if ( !function_exists( 'link_to_menu_editor' ) ) {
	function link_to_menu_editor( $args ) {
		global $mk_settings;

	    extract( $args );

	    $link = '';

	    if ( FALSE !== stripos( $items_wrap, '<ul' )
	        or FALSE !== stripos( $items_wrap, '<ol' )
	    )
	    {
	        $link = "<li class='menu-item'>$link</li>";
	    }

	    if($mk_settings['side-dashboard']) {
			ob_start();
			do_action( 'dashboard_trigger_link' );
			$link .= ob_get_contents();
			ob_end_clean();
		}

	    ob_start();
		do_action( 'header_logo' );
		$link .= ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'header_search' );
		$link .= ob_get_contents();
		ob_end_clean();


	    $output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
	    if ( ! empty ( $container ) )
	    {
	        $output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
	    }

	    if ( $echo )
	    {
	        echo $output;
	    }

	    return $output;
	}
}




/*
* Append Header elements to Main Navigation list items.
******/
if ( !function_exists( 'add_first_nav_item' ) ) {
	function add_first_nav_item( $items, $args ) {
		global $mk_settings;



		$output = '';

		if ( !is_admin() && ($args->theme_location == 'primary-menu' || $args->theme_location == 'second-menu' || $args->theme_location == 'third-menu' || $args->theme_location == 'fourth-menu' || $args->theme_location == 'fifth-menu' || $args->theme_location == 'sixth-menu' || $args->theme_location == 'seventh-menu') ) {

			ob_start();
			do_action( 'responsive_nav_trigger_link' );
			$output .= ob_get_contents();
			ob_end_clean();

			if($mk_settings['side-dashboard']) {
				ob_start();
				do_action( 'dashboard_trigger_link' );
				$output .= ob_get_contents();
				ob_end_clean();
			}

			ob_start();
			do_action( 'margin_style_burger_icon' );
			$output .= ob_get_contents();
			ob_end_clean();

			ob_start();
			do_action( 'vertical_header_burger_icon' );
			$output .= ob_get_contents();
			ob_end_clean();


			
				ob_start();
				do_action( 'header_logo' );
				$output .= ob_get_contents();
				ob_end_clean();

			$output .= $items;


			if ( class_exists( 'woocommerce' ) ) {
				if($mk_settings['checkout-box']) {
					ob_start();
					do_action( 'header_checkout' );
					$output .= ob_get_contents();
					ob_end_clean();
				}
			}

			if($mk_settings['header-search']) {
				ob_start();
				do_action( 'header_search' );
				$output .= ob_get_contents();
				ob_end_clean();
			}

			if($mk_settings['header-wpml']) {
				ob_start();
				do_action( 'header_wpml' );
				$output .= ob_get_contents();
				ob_end_clean();
			}


			ob_start();
			do_action('header_social', 'inside-grid');
			$output .= ob_get_contents();
			ob_end_clean();


		} else {
			$output .= $items;
		}
		return $output;
	}
	add_filter( 'wp_nav_menu_items', 'add_first_nav_item', 10, 2 );
}
/***************************************/








/*
* Create Side Dashboard
******/
if ( !function_exists( 'mk_side_dashboard' ) ) {
	function mk_side_dashboard() {
		global $mk_settings;

	if($mk_settings['side-dashboard'] && $mk_settings['header-structure'] != 'vertical') {
		$output = '';
		$margin_style = $mk_settings['header-structure'] == 'margin' ? 'header-margin-style' : '';
		$output .= '<div class="mk-side-dashboard '.$margin_style.'">';
		//$output .= '<span class="mk-sidedasboard-close"><i class="mk-icon-close"></i></span>';
		ob_start();
		dynamic_sidebar('Side Dashboard');
		$output .= ob_get_contents();
		ob_end_clean();

		$output .= '</div>';

		echo $output;
	}

	}
}
/***************************************/





/*
* Header Toolbar Contact
******/
if ( !function_exists( 'mk_header_toolbar_contact' ) ) {
	function mk_header_toolbar_contact() {
	global $mk_settings;

		if ( !empty( $mk_settings['header-toolbar-phone'] ) ) {
			echo '<span class="header-toolbar-contact"><i class="'.$mk_settings['header-toolbar-phone-icon'].'"></i>'.stripslashes( $mk_settings['header-toolbar-phone'] ).'</span>';
		}
		if ( !empty( $mk_settings['header-toolbar-email'] ) ) {
			echo '<span class="header-toolbar-contact"><i class="'.$mk_settings['header-toolbar-email-icon'].'"></i><a href="mailto:'.antispambot( $mk_settings['header-toolbar-email'] ).'">'.antispambot( $mk_settings['header-toolbar-email'] ).'</a></span>';
		}

	}
}
/***************************************/

/*
* Header Toolbar Menu
******/
if ( !function_exists( 'mk_header_toolbar_menu' ) ) {
	function mk_header_toolbar_menu() {
	global $mk_settings;
		echo "<div class='toolbar-nav'>";
		echo wp_nav_menu( array(
			'container' => false,
			'menu'	=> ''.$mk_settings['toolbar-custom-menu'].'',
			'container_id' => false,
			'container_class' => false,
			'menu_class' => 'mk-toolbar-menu',
			'fallback_cb' => '',
			'walker' => new header_icon_walker()
		));
		echo "</div>";
	}
}
/***************************************/



/*
* Header Toolbar Social Networks
******/
if ( !function_exists( 'mk_header_toolbar_social' ) ) {
	function mk_header_toolbar_social() {
		global $mk_settings;

		if($mk_settings['header-social-select'] == 'disabled') return false;
		if($mk_settings['header-social-select'] == 'header_section') return false;

		$output = '';

		$output .= '<li class="mk-header-toolbar-social">';
		

		if(!empty($mk_settings['header-social-facebook'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-facebook'].'"><i class="mk-icon-facebook"></i></a>';
		}
		if(!empty($mk_settings['header-social-twitter'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-twitter'].'"><i class="mk-icon-twitter"></i></a>';
		}
		if(!empty($mk_settings['header-social-google-plus'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-google-plus'].'"><i class="mk-icon-google-plus"></i></a>';
		}
		if(!empty($mk_settings['header-social-rss'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-rss'].'"><i class="mk-icon-rss"></i></a>';
		}
		if(!empty($mk_settings['header-social-pinterest'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-pinterest'].'"><i class="mk-icon-pinterest"></i></a>';
		}
		if(!empty($mk_settings['header-social-instagram'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-instagram'].'"><i class="mk-icon-instagram"></i></a>';
		}
		if(!empty($mk_settings['header-social-dribbble'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-dribbble'].'"><i class="mk-icon-dribbble"></i></a>';
		}
		if(!empty($mk_settings['header-social-linkedin'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-linkedin'].'"><i class="mk-icon-linkedin"></i></a>';
		}
		if(!empty($mk_settings['header-social-tumblr'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-tumblr'].'"><i class="mk-icon-tumblr"></i></a>';
		}
		if(!empty($mk_settings['header-social-youtube'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-youtube'].'"><i class="mk-icon-youtube"></i></a>';
		}

		if(!empty($mk_settings['header-social-vimeo'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-vimeo'].'"><i class="mk-theme-icon-social-vimeo"></i></a>';
		}
		if(!empty($mk_settings['header-social-spotify'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-spotify'].'"><i class="mk-theme-icon-social-spotify"></i></a>';
		}

		if(!empty($mk_settings['header-social-weibo'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-weibo'].'"><i class="mk-theme-icon-weibo"></i></a>';
		}
		if(!empty($mk_settings['header-social-wechat'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-wechat'].'"><i class="mk-theme-icon-wechat"></i></a>';
		}
		if(!empty($mk_settings['header-social-renren'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-renren'].'"><i class="mk-theme-icon-renren"></i></a>';
		}
		if(!empty($mk_settings['header-social-imdb'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-imdb'].'"><i class="mk-theme-icon-imdb"></i></a>';
		}
		if(!empty($mk_settings['header-social-vkcom'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-vkcom'].'"><i class="mk-theme-icon-vk"></i></a>';
		}
		if(!empty($mk_settings['header-social-qzone'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-qzone'].'"><i class="mk-theme-icon-qzone"></i></a>';
		}
		if(!empty($mk_settings['header-social-whatsapp'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-whatsapp'].'"><i class="mk-theme-icon-whatsapp"></i></a>';
		}
		if(!empty($mk_settings['header-social-behance'])) {
			$output .= '<a target="_blank" href="'.$mk_settings['header-social-behance'].'"><i class="mk-theme-icon-behance"></i></a>';
		}

		$output .= '</li>';
		

		echo $output;
	}
}
