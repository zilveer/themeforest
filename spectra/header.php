<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			header.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */
?><!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> 
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<?php global $spectra_opts, $post, $wp_query; ?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php 
		$favicon = $spectra_opts->get_option( 'favicon' );
		$favicon = $spectra_opts->get_image( $favicon );
	?>
	<?php if ( $favicon ) : ?>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url( $favicon ) ?>">
	<link rel="apple-touch-icon" href="<?php echo esc_url( $favicon ) ?>"/>
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<?php 
	$intro_type_class = '';
	$page_id = '0';

	if ( isset( $wp_query ) && isset( $post ) ) {
		$page_id = $wp_query->post->ID;
	   	$intro_type_class = get_post_meta( $wp_query->post->ID, '_intro_type', true );
		if ( $intro_type_class === 'gmap' ) {
			$intro_type_class = 'intro-light';
	   	}
   	}
?>
<body <?php body_class( esc_attr( $intro_type_class ) ) ?> data-page_id="<?php echo esc_attr( $page_id ) ?>" data-wp_title="<?php esc_attr( wp_title( '|', true, 'right' ) ) ?>">
<!--[if lte IE 8]>
<div id="ie-message"><p><?php _e('You are using Internet Explorer 8.0 or older to view this site. Your browser doesn\'t display modern web sites properly. Please upgrade to a newer browser to fully enjoy the web. <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx">Upgrade your browser</a>', SPECTRA_THEME); ?></p></div>
<script>
	jQuery(document).ready(function($) {
		jQuery( '#site, #slidebar' ).hide();
	});
</script
<![endif]-->

<?php 
	// Show or hide navigation on intro section
	$show_nav = $spectra_opts->get_option( 'show_navigation' );
	if ( ! $show_nav || $show_nav == 'off' ) {
		$show_nav = 'hide-navigation';
	} else {
		$show_nav = 'show-navigation';
	}

 ?>

<div id="site" class="site <?php echo esc_attr( $show_nav ) ?>">

	<!-- ############################# THEME HEADER ############################# -->
	<header id="header" class="sticky <?php echo esc_attr( $show_nav ); ?>">

		<!-- ############ Search ############ -->
		<div id="search-wrap">
			<?php get_search_form(); ?>
			<span class="close-search"></span>
		</div>
		<!-- /search -->

		<!-- Navigation container -->
	   	<div class="nav-container">

		   	<!-- ############ Logo ############ -->
		   	<a href="<?php echo esc_url( home_url() ) ?>/#site" id="logo" data-offset="-65">
		   		<?php
		   			// Get Theme Logo
		   			$logo = $spectra_opts->get_option( 'logo' );
		   			$logo = $spectra_opts->get_image( $logo );
		   		?>
		   		<?php if ( $logo ) : ?>
		   			<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( __( 'Logo Image', SPECTRA_THEME ) ); ?>">
		   		<?php endif; ?>
		   	</a>
		   	<!-- /logo -->

		   	<!-- ############ Icon navigation ############ -->
			<nav id="icon-nav">
				<ul>
					<li><a href="#site" id="nav-up" class="smooth-scroll" data-offset="-65"><span class="icon icon-arrow-up"></span></a></li>
					<li><a href="#" id="nav-search"><span class="icon icon-search"></span></a></li>
					<?php if ( $spectra_opts->get_option( 'slide_sidebar' ) && $spectra_opts->get_option( 'slide_sidebar' ) == 'on' ) : ?><li><a href="#" id="nav-slidebar"><span class="icon icon-lightning"></span></a></li><?php endif; ?>
					<?php if ( class_exists( 'WooCommerce' ) ) : ?>
                    <?php 
                        global $woocommerce;
                        $count = $woocommerce->cart->cart_contents_count;
                    ?>
                    <li><a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_shop_page_id' ) ) ) ?>" id="shop-link"><span class="icon icon-cart"></span><?php if ( $count > 0 ) { echo "<span class='shop-items-count'>$count</span>"; } ?></a></li>
                <?php endif ?>

					<li><a href="#" id="nav-slidemenu"><span class="icon icon-menu2"></span></a></li>
				</ul>
			</nav>
			<!-- /icon navigation -->

			<!-- ############ Navigation ############ -->
			<?php
				$defaults = array(
					'theme_location'  => 'primary',
					'menu'            => '',
					'container'       => false,
					'container_class' => '',
					'menu_class'      => 'menu',
					'fallback_cb'     => 'wp_page_menu',
					'depth'           => 3
				);				
			?>
			<nav id="nav" class="one-page-nav">
				<?php 
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( $defaults );
					} else {
						__( 'The main menu has not selected location or does not exist. Go to Wordpress > Appearance > Menus and set your menu.', SPECTRA_THEME );
					}
				?>
			</nav>
			<!-- /navigation -->

	   	</div>
	   	<!-- /navigation container -->
	</header>
	<!-- /header -->

	<!-- ############################# Responsive Navigation ############################# -->
	<div id="slidemenu">
		<header>
			<a href="#" id="slidemenu-close"><?php _e( 'CLOSE', SPECTRA_THEME ) ?> <span class="icon icon-close"></span></a>
		</header>
		<div id="slidemenu-content" class="clearfix">
			<div>
				<!-- RESPONSIVE NAVIGATION HERE -->
			</div>
		</div>

	</div>	
	<div id="slidemenu-layer"></div>

	<!-- ############################# AJAX CONTAINER ############################# -->
	<div id="ajax-container">
		<div id="ajax-content">