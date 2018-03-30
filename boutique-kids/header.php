<?php
/**
 * Header file for theme
 *
 * @package WordPress
 * @subpackage boutique
 * @since boutique 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<?php
		if ( get_theme_mod( 'responsive_enabled', 1 ) ) { ?>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php } ?>
		<link rel="profile" href="http://gmpg.org/xfn/11"/>
		<link rel="pingback" href="<?php esc_url( get_bloginfo( 'pingback_url' ) ); ?>"/>
		<?php
		wp_head();
		?>
		<!--[if lte IE 9]>
		<link href="<?php echo get_template_directory_uri();?>/style.ie.css" rel="stylesheet" type="text/css"/>
		<![endif]-->
	</head>
<body <?php body_class(); ?>>
<div id="holder">
	<div id="wrapper">
		<?php
		// "header_boxes" displays the nice hanging widgets along the top of the page.
		do_action('widget_area_manager_hook','header_boxes');
		?>
		<!-- header area and logo -->
		<div id="header_wrap">
			<div id="mobile_menu_toggle"></div>
			<div id="header">
				<div id="logo">
					<a href="<?php echo get_home_url(); ?>"><?php
						// either image or text.
						$image_url = get_theme_mod('logo_header_image', get_template_directory_uri().'/images/logo.png');
						$logo_text = boutique_get_theme_mod('logo_header_text', 'Boutique Kids');
						if($image_url){
							$image = '<img id="site-logo" src="%s" alt="%s" style="width:%s;" />';
							printf(
								$image,
								$image_url,
								get_bloginfo('name'),
								get_theme_mod('logo_header_image_width','126').'px'
							);
						}
						if(get_theme_mod('logo_show_text',1)){
							echo '<span>'.$logo_text.'</span>';
						}
						?></a>
				</div>
			</div>
			<?php
			if(class_exists('Woocommerce',false)){
				global $woocommerce; ?>
				<a href="<?php echo esc_attr($woocommerce->cart->get_cart_url()); ?>" id="mobile_cart"><span><?php echo trim($woocommerce->cart->cart_contents_count);?></span></a>
			<?php } ?>
		</div>
		<!-- / header area and logo -->
	<!-- menu and menu buttons -->
	<div id="menu_wrap">
		<div id="menu_container" class="<?php echo get_theme_mod('header_menu_buttons',0) ? '' : 'without_buttons';?>">
			<?php
			wp_nav_menu(  array( 'theme_location' => 'primary' ));
			?>
		</div>
		<div id="menu_buttons">
			<div>
				<ul>
					<?php if(function_exists('icl_get_languages')){ ?>
						<li id="menu_language_switcher">
							<?php $languages = icl_get_languages('skip_missing=0&orderby=code');
							if(!empty($languages)){
								foreach($languages as $l){
									echo '<a href="'.$l['url'].'" class="'.($l['active'] ? 'active-language':'').'">';
									echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
									echo '</a>';
								}
							} ?>
						</li>
					<?php } ?>
					<li><a href="#" class="icon_search"><?php _e('Search','boutique-kids');?></a>
						<ul><li>
								<form method="GET">
									<input type="text" name="s" value="<?php echo htmlspecialchars(isset($_REQUEST['s'])?$_REQUEST['s']:'');?>" placeholder="<?php _e('Search','boutique-kids');?>"/> <input type="submit" name="go" value="<?php _e('Search','boutique-kids');?>"/>
								</form>
							</li></ul></li>
					<!-- <li><a href="#" class="icon_email"><?php _e('Email','boutique-kids');?></a></li> -->
					<?php
					if(class_exists('Woocommerce',false)){
						global $woocommerce; ?>
						<li><a href="<?php echo esc_attr($woocommerce->cart->get_cart_url()); ?>" class="icon_shopcart"><?php _e('View Cart','boutique-kids');?></a></li>
						<li><a href="<?php echo esc_attr($woocommerce->cart->get_cart_url()); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'boutique-kids'), $woocommerce->cart->cart_contents_count);?> - <?php echo trim($woocommerce->cart->get_cart_total()); ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<!-- / menu and menu buttons -->

	<div id="inner_content">
		<div id="inner_wrapper">

		<?php
		// "content_top" starts the <div> tags to display the main content with an optional sidebar.
		do_action('widget_area_manager_hook','content_top');
		?>