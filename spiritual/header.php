<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<?php 
wp_head();
?>
</head>

<?php 
global $swm_data;

$swm_body_classes = array();

$swm_default_layout_style = get_theme_mod('swm_website_layout','wide');

if (function_exists('rwmb_meta')) {
	$swm_meta_layout_style = rwmb_meta('swm_meta_site_layout');
	if ( $swm_meta_layout_style && $swm_meta_layout_style != 'default' ) {
		$swm_default_layout_style = $swm_meta_layout_style;
	}
}

if ( get_theme_mod('swm_disable_header_auto_height_js',0 ) == 1 ) {
	$swm_body_classes[] = 'swm_disable_header_auto_height';
}

if ( $swm_default_layout_style == 'boxed' ) {
	$swm_body_classes[] = 'boxed';	
}

?>
<body <?php body_class($swm_body_classes); ?> id="page_body">

<div id="swm_main_container">
	<div class="swm_main_container_wrap">

		<div class="swm_logo_section_bg">
			<div class="logo_section_top_border"></div>
			<div class="swm_logo_section swm_container">
				<div class="logo_section">
					<?php get_template_part( 'includes/logo' ); ?>
					<div class="logo_section_toggle">
						<span class="logo_section_btn"><i class="fa fa-chevron-down"></i></span>
					</div>
					<div class="logo_section_menu">
						<?php
							if ( get_theme_mod('swm_topbar_email_phone',1) == 1 ) {
								echo swm_display_top_bar_navigation();									
							}							
						?>

						<?php
							if ( get_theme_mod('swm_topbar_cart_icon',0) == 1 ) {
								if ( class_exists( 'woocommerce' ) ) {
									swm_display_swm_woo_ajax_cart(); 
								} ?>
								<span class="cart_responsive_link">
									<a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>">
										<i class="fa fa-shopping-cart"></i><?php _e('Cart','swmtranslate'); ?>
									</a>
								</span>
							<?php	
							}
						?>

						<?php if ( get_theme_mod('swm_onoff_donate_button',1) == 1 ) { ?>

							<span class="donate_btn"><a href="<?php echo get_theme_mod('swm_donate_link'); ?>" 
							<?php
							if ( get_theme_mod('swm_donate_link_window') == 1 ) {
								echo 'target="_blank"';
							}
							?> title=""><i class="fa fa-gift"></i><?php _e('Donate','swmtranslate'); ?></a></span>

						<?php } ?>

					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>

		<div class="swm_top_menu_section <?php if ( get_theme_mod('swm_display_sticky_nav',0) == 1 ) { echo 'sticky-navigation'; } ?>">
			<div class="swm_container">
				<div class="theme_social_icons">
					<ul>
						<?php swm_display_social_media(); ?>
					</ul>
				</div>
				<nav class="swm-top-menu mobile_menu">
				<span id="mobile_nav_button" class="BtnBlack "><i class="fa fa-list-ul"></i></span>
					<?php swm_display_main_navigation(); ?>
				</nav>
				<div class="clear"></div>
			</div>
			<div class="topmenu_border"></div>
		</div>

		<?php			

		if (function_exists('rwmb_meta')) {

			if ( rwmb_meta('swm_meta_header_style') == 'revolution_slider' ) 
			{ ?>

				<div class="swm_header_slider">
					<div class="slider_wrap">
						<?php echo do_shortcode( rwmb_meta('swm_meta_rev_slider_shortcode') ); ?>
					</div>
					<div class="swm_header_border"></div>				
				</div>

				<?php
			} else if ( rwmb_meta('swm_meta_header_style') == 'google_map' ) 
			{
				
				$swm_map_header_height = (rwmb_meta('swm_meta_header_height') == '') ? '500' : rwmb_meta('swm_meta_header_height');
				$swm_map_header_height = preg_replace('/[^0-9]/','',$swm_map_header_height);

				echo '<div class="swm_google_header_map_wrap"><div class="swm_google_header_map" style="height:'.$swm_map_header_height.'px;"><iframe style="width:100%" width="" height="'.$swm_map_header_height.'" src="'.rwmb_meta('swm_header_google_map_link').'&amp;iwloc=near&amp;output=embed"></iframe></div><div class="clear"></div><div class="swm_header_border"></div></div>';
				
			} else {
				get_template_part( 'includes/image-header' );
			}	
			
		} else {
			get_template_part( 'includes/image-header' ); 			
			
		} // if header style
			
		?>

		<div class="clear"></div>		

		<div id="swm_page_container">