<?php

extract( shortcode_atts( array(
			'menu_location' => 'primary-menu',
			'squeeze' => 'true',
			'align' => 'left',
			'custom_header_height' => 0,
			'top_level_item_size' => 0,
			'wideness' => 'boxed',
			'show_logo' => 'true',
			'show_search' => 'true',
			'show_cart' => 'true',
			'show_wpml' => 'true',
			'show_border' => 'true',
            'show_dashboard_trigger' => 'true',
			'background_color' => '',
			'link_color' => '',
			'link_hover_color' => '',
			'border_color' => '',
			'el_class' => '',
		), $atts ) );


$output = '';
$id = Mk_Static_Files::shortcode_id();

$menu_location = $menu_location ? $menu_location : 'primary-menu';

global $mk_settings, $ken_json;

$logo_height = (!empty($mk_settings['logo']['height'])) ? $mk_settings['logo']['height'] : 50;



if(!empty($custom_header_height) && $custom_header_height != '0') {
		$header_height = $custom_header_height;
		$header_class = 'header-custom-height';
} else {
		
	if($squeeze == 'true') {
		$header_height = $logo_height/1.5 + ($mk_settings['header-padding']/2.4 * 2);
		$header_class = 'sticky-trigger-header ';
	} else {
		$header_height = $logo_height + ($mk_settings['header-padding'] * 2);
		$header_class = '';
	}
}



$output .= '<header id="mk-header" style="height:'.$header_height.'px" data-sticky-height="'.intval($header_height).'" class="mk-secondary-header secondary-header-'.$id.' show-cart-'.$show_cart.' show-search-'.$show_search.' show-logo-'.$show_logo.' show-wpml-'.$show_wpml.' show-border-'.$show_border.' show-dashboard-'.$show_dashboard_trigger.' '.$wideness.'-header header-align-'.$align.' header-structure-standard put-header-top mk-header-module '.$header_class.$el_class.'" data-header-style="block" data-header-structure="standard">';

if($wideness == 'boxed') {
	$output .= '<div class="mk-grid">';
}


ob_start();
do_action('main_navigation', $menu_location);

$output .= ob_get_contents();
ob_end_clean();


if($wideness == 'boxed') {
	$output .= '</div>';
}

if($show_dashboard_trigger == 'true') {
    if($mk_settings['side-dashboard']) :

    	if(!empty($mk_settings['side-dashboard-icon'])){
            $dashboard_icon = $mk_settings['side-dashboard-icon'];
        }else{
            $dashboard_icon = 'mk-theme-icon-dashboard2';
        }

      $output .= '<div class="dashboard-trigger desktop-mode"><i class="'.$dashboard_icon.'"></i></div>';
    endif; 
}

$output .= '</header>';

$output .= '<div class="responsive-nav-container"></div>';

$output .= '<div style="height:'.intval($header_height).'px;" class="secondary-header-space"></div>';


if ( !empty($background_color) || !empty($link_color) ) {

	Mk_Static_Files::addCSS('
	   .secondary-header-'.$id.' {
            background-color:'.$background_color.' !important;
            border-top-color:'.$border_color.' !important;
        }
        .secondary-header-'.$id.' .header-searchform-input input[type=text] {
        	background-color:'.$background_color.' !important;
        }
    ', $id);
}


    Mk_Static_Files::addCSS('
     	.secondary-header-'.$id.'.header-custom-height #mk-main-navigation > ul > li.menu-item, 
     	.secondary-header-'.$id.'.header-custom-height #mk-main-navigation > ul > li.menu-item > a, 
     	.secondary-header-'.$id.'.header-custom-height .mk-header-search,
     	.secondary-header-'.$id.'.header-custom-height .mk-header-search a, 
     	.secondary-header-'.$id.'.header-custom-height .mk-header-wpml-ls, 
     	.secondary-header-'.$id.'.header-custom-height .mk-header-wpml-ls a, 
     	.secondary-header-'.$id.'.header-custom-height .mk-cart-link, 
     	.secondary-header-'.$id.'.header-custom-height .mk-responsive-cart-link, 
     	.secondary-header-'.$id.'.header-custom-height .dashboard-trigger, 
     	.secondary-header-'.$id.'.header-custom-height .responsive-nav-link, 
     	.secondary-header-'.$id.'.header-custom-height .mk-header-social a, 
     	.secondary-header-'.$id.'.header-custom-height .mk-margin-header-burger,
     	.secondary-header-'.$id.'.header-custom-height .mk-header-logo, 
     	.secondary-header-'.$id.'.header-custom-height .mk-header-logo a {
     		height: '.$header_height.'px !important;
			line-height: '.$header_height.'px !important;
     	}

     	.secondary-header-'.$id.'.header-custom-height .mk-header-logo, 
     	.secondary-header-'.$id.'.header-custom-height .mk-header-logo a {
     		margin-top:0 !important;
     		margin-bottom:0 !important;
     	}


        .secondary-header-'.$id.' #mk-main-navigation > ul > li.menu-item > a,
        .secondary-header-'.$id.' .mk-header-search a,
        .secondary-header-'.$id.' .mk-margin-header-burger,
        .secondary-header-'.$id.' .mk-header-social a,
        .secondary-header-'.$id.' .responsive-nav-link,
        .secondary-header-'.$id.' .mk-cart-link,
        .secondary-header-'.$id.' .dashboard-trigger,
        .secondary-header-'.$id.' .mk-responsive-cart-link,
        .secondary-header-'.$id.' .mk-header-wpml-ls a,
        .secondary-header-'.$id.' .mk-header-search a
        {
        	color:'.$link_color.' !important;	
        }
    ', $id);


        if(!empty($top_level_item_size) && $top_level_item_size != '0' ) {
	        Mk_Static_Files::addCSS('
    	        .secondary-header-'.$id.' #mk-main-navigation > ul > li.menu-item > a{
    	        	font-size: '.$top_level_item_size.'px !important;
    	        }
            ', $id);
    	}

    	Mk_Static_Files::addCSS('
            .secondary-header-'.$id.' a:hover {
                color:'.$link_hover_color.' !important;
            }
            @media handheld, only screen and (max-width:'.$mk_settings['res-nav-width'].'px){
                .secondary-header-'.$id.' .mk-header-logo,
                .secondary-header-'.$id.' .mk-responsive-shopping-cart {
                    display: none !important;
                }
            }
        ', $id);



echo $output;

$ken_json[] = array(
	'name' => 'mk_header',
	'params' => array(
			'stickyHeight' => intval($header_height)
		)
);
