<?php

//Get Theme Options details
$logo					=	xr_get_option('company_logo','');
$social_icons			=	json_decode(xr_get_option('social_icons',''), true);
$header_contact_info	=	xr_get_option('header_contact_info','');
$use_header_top_2		=	false;

//Add Html tags to elements
$logo_html				=	'<div class="logo-container"><a href="'.(function_exists('icl_get_home_url') ? icl_get_home_url() : get_site_url()).'"><img src="'.$logo.'" alt="'.get_bloginfo('name').'" style="max-width:'.xr_get_option('logo_width','190px').'; max-height:'.xr_get_option('logo_height','80px').'; width:100%;" /></a></div>';
$social_html			=	'<div class="header-social-container">'.do_shortcode($social_icons['shortcode']).'</div>';
$header_contact_html	=	'<div class="header-small-contact">'.$header_contact_info.'</div>';
ob_start();
do_action('icl_language_selector');
$wpml_select			=	ob_get_contents();
$wpml_select			=	'<div class="header-wpml-container">'.$wpml_select.'</div>';
ob_get_clean();

$add_woo_icon_to_menu	=	(rockthemes_woocommerce_active() && xr_get_option('add_cart_icon_to_menu', false)) ? true : false;
if($add_woo_icon_to_menu){
	add_filter( 'wp_nav_menu_items', 'rockthemes_add_cart_icon_to_menu', 10, 2);
}

$menu_shadow			=	xr_get_option('activate_menu_bottom_shadow', '1') !== '' ? quasar_image_shadow_down() : '';

/*
**	Header Models
**
**	1	-	Full width menu,	Left Logo,		Right Middle Social Icons,	Right Top Call Us,		Right Bottom WPML
**	2	-	Full width menu,	Centered Logo,	Left Bottom Social Icons,	Left Top Call Us,		Right Top WPML
**	3	-	Right menu,			Left Logo,
**	4	-	Full width menu,	Left Logo,		Right Middle Social Icons,	Right Top Call Us,		Right Bottom WPML
**
**
**
*/

$current_model	= (int) xr_get_option('header_model', 1);
$header_return = '';
switch($current_model){
	
	//1	-	Full width menu,	Left Logo,		Right Bottom Social Icons,	Right Top Call Us
	case 1:
	
	//Include special search box to the menu
	if(xr_get_option('add_search_box_to_menu', true)){
		add_filter( 'wp_nav_menu_items', 'quasar_add_search_to_menu', 11, 2 );
	}
	
	$header_return .= '
	<div class="header-top-1 header-model-1">
		<div class="row">
			<div class="large-4 columns centered-text-responsive">'.$logo_html.'</div>
			<div class="large-8 columns centered-text-responsive right-text">
				<div class="row">
					<div class="large-12 columns">'.$header_contact_html.'</div>
					<div class="large-12 columns">'.$social_html.'</div>
					<div class="large-12 columns">'.$wpml_select.'</div>
				</div>
			</div>
		</div>
	</div>
	';
	
	$header_return .= '
	<div id="main-nav-bg" class="nav-box">
		<div class="row">
			<div class="large-12 columns quasar-nav-fixed-ready">
				'.quasar_get_nav_menu(false).'
			</div>
		</div><!-- Clear any unwanted alignment from menu-->
	</div>
	<div class="nav-shadow-container">
		'.$menu_shadow.'
	</div>';
	break;
	

	//2	-	Full width menu,	Centered Logo,	
	case 2:
	//Include special search box to the menu
	if(xr_get_option('add_search_box_to_menu', true)){
		add_filter( 'wp_nav_menu_items', 'quasar_add_search_to_menu', 11, 2 );
	}
	$header_return .= '
	<div class="header-top-1 header-model-2">
		<div class="row">
			<div class="large-4 columns centered-text-responsive">
				<div class="row">
					<div class="large-12 columns">'.$header_contact_html.'</div>
				</div>
			</div>
			<div class="large-4 columns centered-text-responsive center-text">'.$logo_html.'</div>
			<div class="large-4 columns centered-text-responsive right-text">
				<div class="row">
					<div class="large-12 columns">'.$social_html.'</div>
					<div class="large-12 columns">'.$wpml_select.'</div>
				</div>
			</div>
		</div>
	</div>
	';
	
	$header_return .= '
	<div id="main-nav-bg" class="nav-box nav-centered">
		<div class="row">
			<div class="large-12 columns">
				<div class="menu-center-column">
					'.quasar_get_nav_menu(false).'
				</div>
			</div>
		</div><!-- Clear any unwanted alignment from menu-->
	</div>
	<div class="nav-shadow-container">
		'.$menu_shadow.'
	</div>';
	break;
	
	
	//1	-	Full width menu,	Left Logo,		Right Bottom Social Icons,	Right Top Call Us
	case 3:
	//Include special search box to the menu
	if(xr_get_option('add_search_box_to_menu', true)){
		add_filter( 'wp_nav_menu_items', 'quasar_add_search_to_menu', 11, 2 );
	}
	$header_return .= '
	<div class="header-top-1 header-model-3">
		<div class="row nav-relative-container">
			<div class="large-3 columns centered-text-responsive">'.$logo_html.'</div>
			<div class="large-9 columns right-text centered-text-responsive">
				<div class="row">
					<div class="large-12 columns"><br/>'.$social_html.'</div>
					<div class="large-12 columns centered-text-responsive right-text">
						<div id="main-nav-bg" class="nav-right">
							'.quasar_get_nav_menu(false).'
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="nav-shadow-container">
		'.$menu_shadow.'
	</div>';
	break;
	
	
	//4	-	Full width menu,	Left Logo,		Right Bottom Social Icons,	Right Top Call Us
	case 4:
	
	//Activate Header Top
	$use_header_top_2 = true;
	
	//Include special search box to the menu
	if(xr_get_option('add_search_box_to_menu', true)){
		add_filter( 'wp_nav_menu_items', 'quasar_add_search_to_menu', 11, 2 );
	}
	
	$header_return .= '
	<div class="header-top-1 header-model-4">
		<div class="row">
			<div class="large-4 columns centered-text-responsive">'.$logo_html.'</div>
			<div class="large-8 columns centered-text-responsive right-text">
				<div class="row">
					<div class="large-12 columns">'.$social_html.'</div>
					<div class="large-12 columns">'.$wpml_select.'</div>
				</div>
			</div>
		</div>
	</div>
	';
	
	$header_return .= '
	<div id="main-nav-bg" class="nav-box">
		<div class="row">
			<div class="large-12 columns quasar-nav-fixed-ready">
				'.quasar_get_nav_menu(false).'
			</div>
		</div><!-- Clear any unwanted alignment from menu-->
	</div>
	<div class="nav-shadow-container">
		'.$menu_shadow.'
	</div>';
	break;
	

	//5	-	Full width menu,	Centered Logo,	
	case 5:
	
	//Activate Header Top
	$use_header_top_2 = true;
	
	//Include special search box to the menu
	if(xr_get_option('add_search_box_to_menu', true)){
		add_filter( 'wp_nav_menu_items', 'quasar_add_search_to_menu', 11, 2 );
	}

	$header_return .= '
	<div class="header-top-1 header-model-5">
		<div class="row">
			<div class="large-4 columns centered-text-responsive">
				<div class="row">
					<div class="large-12 columns">'.$social_html.'</div>
				</div>
			</div>
			<div class="large-4 columns centered-text-responsive">'.$logo_html.'</div>
			<div class="large-4 columns centered-text-responsive right-text">
				<div class="row">
					<div class="large-12 columns">'.$wpml_select.'</div>
				</div>
			</div>
		</div>
	</div>
	';
	
	$header_return .= '
	<div id="main-nav-bg" class="nav-box nav-centered">
		<div class="row">
			<div class="large-12 columns">
				<div class="menu-center-column">
					'.quasar_get_nav_menu(false).'
				</div>
			</div>
		</div><!-- Clear any unwanted alignment from menu-->
	</div>
	<div class="nav-shadow-container">
		'.$menu_shadow.'
	</div>';
	break;
	
	
	//6	-	Full width menu,	Left Logo,		Right Bottom Social Icons,	Right Top Call Us
	case 6:
	
	//Activate Header Top
	$use_header_top_2 = true;
	
	//Include special search box to the menu
	if(xr_get_option('add_search_box_to_menu', true)){
		add_filter( 'wp_nav_menu_items', 'quasar_add_search_to_menu', 11, 2 );
	}

	$header_return .= '
	<div class="header-top-1 header-model-6">
		<div class="row nav-relative-container">
			<div class="large-3 columns centered-text-responsive">'.$logo_html.'</div>
			<div class="large-9 columns right-text centered-text-responsive">
				<div class="row">
					<div class="large-12 columns"><br/>'.$social_html.'</div>
					<div class="large-12 columns centered-text-responsive right-text">
						<div id="main-nav-bg" class="nav-right">
							'.quasar_get_nav_menu(false).'
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="nav-shadow-container">
		'.$menu_shadow.'
	</div>';
	break;
	
	case 7:
	
	//Activate Header Top
	$use_header_top_2 = true;
	
	//Include special search box to the menu
	if(xr_get_option('add_search_box_to_menu', true)){
		add_filter( 'wp_nav_menu_items', 'quasar_add_search_to_menu', 11, 2 );
	}
		
	$header_return .= '
	<div id="main-nav-bg" class="nav-box nav-margin-vertical header-model-7">
		<div class="row">
			<div class="large-3 columns centered-text-responsive">'.$logo_html.'</div>
			<div class="large-9 columns quasar-nav-fixed-ready">
				<div class="nav-right-desktop">
					'.quasar_get_nav_menu(false).'
				</div>
			</div>
		</div><!-- Clear any unwanted alignment from menu-->
	</div>
	<div class="nav-shadow-container">
		'.$menu_shadow.'
	</div>';

	break;
	
}

if($use_header_top_2){
					
	switch($current_model):
					
	case 7 :
	?>
    
	<div class="header-top-2">
		<div class="row">
        	<div class="large-12 columns">
                <div class="row">
					<div class="large-6 columns header-top-2-font-size header-social-line-height centered-text-responsive"><?php echo $header_contact_info; ?></div>
					<div class="large-6 columns right-text centered-text-responsive header-top-2-responsive-inline-block social-no-margin"><?php echo $social_html; ?></div>
                </div>
            </div>
		</div>
	</div>
	
	<?php
	break;
					
	default :
	?>
    
	<div class="header-top-2">
		<div class="row">
        	<div class="large-12 columns">
                <div class="row">
					<div class="large-6 columns header-top-2-font-size centered-text-responsive"><?php echo $header_contact_info; ?></div>
					<div class="large-6 columns right-text centered-text-responsive header-top-2-responsive-inline-block"><?php if(dynamic_sidebar('Header Top Right')); ?></div>
                </div>
            </div>
		</div>
	</div>
	
	<?php
	break;
					
	endswitch;
					
}
echo $header_return;

?>