<?php
global $options_data;
$disable_caret = ($options_data['sidenav_disable_caret'] != 1) ? 'show-indicator' : '';
$sidenav_type = isset($options_data['select_sidenav']) ? $options_data['select_sidenav'] : 'hide';
$sidenav_textalign = isset($options_data['select_sidenav_textalign']) ? $options_data['select_sidenav_textalign'] : 'left';
switch($sidenav_type){
	case 'static':
		echo '<aside class="side-navigation side-navigation-'.$sidenav_type.' text-'.$sidenav_textalign.'">',
			'<div class="logo">';
				if($options_data['media_logo'] != "") {
					echo '<h1><a href="'.esc_url(home_url()).'"><img src="'.esc_attr($options_data['media_logo']).'" alt="'.get_bloginfo('name').'" class="logo_standard" /></a></h1>';
				} else {
					echo '<h1><a class="logo_text" href="'.esc_url(home_url()).'">'.get_bloginfo('name').'</a></h1>';
					if(get_bloginfo('description') != '' && $options_data['check_tagline'] != 1) echo '<span class="site-description">'.get_bloginfo('description').'</span>';
				}
			echo '</div>';
			wp_nav_menu(array('theme_location' => 'aside_navigation', 'menu_id' => 'side-nav', 'menu_class'=>'menu sf-vertical '.$disable_caret, 'fallback_cb' => false));
		echo '<div class="socials-block">';
			get_template_part('socials');
			echo apply_filters('richer_text_translate', 'textarea_copyright', $options_data['textarea_copyright']);
		echo '</div>';
		echo '</aside>';
		echo '<div class="side-navigation-overlay"></div>',
		'<aside class="side-navigation side-navigation-toggle show-on-mobile text-'.$sidenav_textalign.'">',
			'<a href="#" class="toggleMenu"><i class="fa fa-bars"></i></a>';
			wp_nav_menu(array('theme_location' => 'aside_navigation', 'container_class'=>'navbar-menu', 'menu_id' => 'side-nav-toggle', 'menu_class'=>'menu', 'fallback_cb' => false));
		echo '</aside>';
	break;
	case 'toggle':
		echo '<div class="side-navigation-overlay"></div><aside class="side-navigation side-navigation-'.$sidenav_type.' text-'.$sidenav_textalign.'">',
			'<div class="logo">';
				if(isset($options_data['square_media_logo']) && $options_data['square_media_logo'] != "") {
					echo '<h1><a href="'.esc_url(home_url()).'"><img src="'.esc_attr($options_data['square_media_logo']).'" alt="'.get_bloginfo('name').'" class="logo_standard" /></a></h1>';
				} else {
					$logo_title = get_bloginfo('name');
					echo '<h1 class="text"><a class="logo_text" href="'.esc_url(home_url()).'">'.$logo_title[0].'</a></h1>';
				}
			echo '</div>';
			echo '<a href="#" class="toggleMenu"><i class="fa fa-bars"></i></a>';
			wp_nav_menu(array('theme_location' => 'aside_navigation', 'container_class'=>'navbar-menu', 'menu_id' => 'side-nav-toggle', 'menu_class'=>'menu', 'fallback_cb' => false));
		echo '</aside>';
	break;
	default:
	break;
}
