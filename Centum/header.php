<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Centum
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">

<!-- Header
================================================== -->

<!-- 960 Container -->
<div class="container ie-dropdown-fix">
<?php
	$logo_area_width = ot_get_option('logo_area_width',8);
	$menu_area_width = 16 - $logo_area_width;
?>
<!-- Header -->
	<div id="header" class="<?php if($logo_area_width == 16 && ot_get_option('pp_logo_center','off') == "on") { echo "center-logo"; } ?>">
		
		<!-- Logo -->
		<div class="<?php echo incr_number_to_width($logo_area_width); ?> logo-area columns">
			<div id="logo">
				<?php  $logo = ot_get_option( 'logo_upload' );
				if($logo) { ?>
					<?php if(is_front_page()){ ?>
					<a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
						<img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>"/>
					</a>
					<?php } else { ?>
					<a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
						<img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>"/>
					</a>
					<?php } ?>

				<?php } else { ?>
					<?php if(is_front_page()) { ?>
						<h1 class="logo">
							<a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
						</h1>
					<?php } else { ?>
						<h2 class="logo">
							<a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
						</h2>
					<?php } ?>
				<?php } ?>
				<?php if(get_theme_mod('centum_tagline_switch','show') == 'show') { ?><div id="tagline"><?php echo get_bloginfo ( 'description' ); ?></div><?php } ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php if($menu_area_width != 0){ ?>
		<!-- Social / Contact -->
		<div class="<?php echo incr_number_to_width($menu_area_width); ?> header-details columns">

			<?php /* get the slider array */
				$footericons = ot_get_option( 'headericons', array() );
				if ( !empty( $footericons ) ) {
					echo '<ul class="social-icons">';
					foreach( $footericons as $icon ) {
						echo '<li><a target="_blank" class="'.$icon['icons_service'] .'" title="' . $icon['title'] . '" href="' . $icon['icons_url'] . '"><i class="icon-' . $icon['icons_service'] . '"></i></a></li>';
					}
					echo '</ul>';
				}
			?>
			<?php if(ot_get_option('centum_wpml_switcher') == "yes")  do_action('icl_language_selector'); ?>

			<div class="clear"></div>
			<?php
			if(ot_get_option( 'centum_contact_details') == 'yes') {
				$email = ot_get_option( 'centum_cdetails_email');
				$phone = ot_get_option( 'centum_cdetails_phone');
			?>
			<!-- Contact Details -->
			<div id="contact-details">
				<ul>
					<?php if($email) { ?><li><i class="fa fa-envelope"></i><a href="mailto:<?php echo $email ;?>"><?php echo $email ;?></a></li><?php } ?>
					<?php if($phone) { ?><li><i class="fa fa-phone"></i><?php echo $phone ;?></li><?php } ?>
				</ul>
			</div>
			<?php } ?>
			
		</div>
		<?php } ?>

	</div>
	<!-- Header / End -->

<!-- Navigation -->
	<div class="sixteen columns">

		<div id="navigation">
			<?php
					$menu = wp_nav_menu(
						array(
							'theme_location' => 'mainmenu',
							'echo' => 0,
							'menu_class' => 'dropmenu main-menu',
							'container_id' => 'mainmenu-cont',
							)
						);

					$menu = str_replace("\n", "", $menu);
					$menu = str_replace("\r", "", $menu);
					echo $menu; ?>
			<?php
				wp_nav_menu(array(
					'theme_location' => 'mainmenu',
					'walker'         => new Walker_Nav_Menu_Dropdown(),
					'items_wrap'     => '<select class="selectnav"><option value="/">'.__('Select Page','centum').'</option>%3$s</select>',
					'container' => false,
					'menu_class' => 'selectnav',
					'fallback_cb' => false
					)); ?>

			<!-- Search Form -->

		</div>
		<div class="clear"></div>

	</div>
	<!-- Navigation / End -->
</div>
<!-- 960 Container / End -->