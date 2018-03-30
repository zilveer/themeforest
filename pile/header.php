<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till the main content
 *
 * @package Pile
 * @since   Pile 1.0
 */


//detect what type of content are we displaying
$schema_org = '';
if ( is_singular( 'pile_portfolio' ) ) {
	$schema_org .= ' itemscope itemtype="http://schema.org/CreativeWork"';
} elseif ( is_single() ) {
	$schema_org .= ' itemscope itemtype="http://schema.org/Article"';
} else {
	$schema_org .= ' itemscope itemtype="http://schema.org/WebPage"';
}

?><!DOCTYPE html>
<!--[if lt IE 7]>
<html class="lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); echo $schema_org; ?>> <![endif]-->
<!--[if IE 7]>
<html class="lt-ie9 lt-ie8" <?php language_attributes(); echo $schema_org; ?>> <![endif]-->
<!--[if IE 8]>
<html class="lt-ie9" <?php language_attributes(); echo $schema_org; ?>> <![endif]-->
<!--[if IE 9]>
<html class="ie9" <?php language_attributes(); echo $schema_org; ?>> <![endif]-->
<!--[if gt IE 9]><!-->
<html <?php language_attributes(); echo $schema_org; ?>> <!--<![endif]-->
<head>
	<meta http-equiv="content-type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="True">
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<![if IE]>
	<script type='text/javascript'>
		if (/*@cc_on!@*/false) var is_ie = 1;
	</script>
	<![endif]>
	<?php
	/**
	 * One does not simply remove this and walk away alive!
	 */
	wp_head(); ?>
</head>
<?php
// first let's test if we are in woocommerce
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	//we need to setup post data
	if ( is_shop() ) {

		$shop_page_id = wc_get_page_id( 'shop' );

		if ( ! empty( $shop_page_id ) && $shop_page_id != 0 ) {

			global $post;
			$post = get_post( $shop_page_id );

			setup_postdata( $post );
		}
	}
}
// Determine the necessary classes for <header>
$header_classes = '';

if ( pile_option('header_width') == 'content' ) {
	$header_width = pile_option('content_width') . 'px';
} else {
	$header_width = '100%';
	$header_classes .= ' header-padding';
}

$header_classes .= pile_option('header_position') == 'static' ? ' site-header--static' : '';
$header_classes .= pile_option('nav_header_style') == 'trigger' ? ' site-header--trigger' : '';
$header_classes .= pile_option('header_transparent') == true && ! ( class_exists( 'WooCommerce' ) && is_product() ) ? ' js-transparent-header site-header--transparent' : '';
?>

<body <?php body_class(); pile_body_attributes(); ?>>

<style>
	.site-header .panel {
		max-width: <?php echo $header_width; ?>;
	}
</style>

<div id="barba-wrapper">
<div class="barba-container">
<div class="wrap">
<header class="site-header  header-height <?php echo $header_classes; ?>">

	<div class="panel">

		<?php get_template_part( 'template-parts/branding' ); ?>

		<a class="navigation-toggle  js-nav-toggle">
			<?php if ( pile_option('nav_menu_layout') == 'text' || pile_option('nav_menu_layout') == 'text-icon' ) {
				echo '<span>'.pile_option('nav_menu_text').'</span>';
			}
			if ( pile_option('nav_menu_layout') == 'icon' || pile_option('nav_menu_layout') == 'text-icon' ) {
				echo '<i class="icon icon-bars"></i>';
			} ?>
		</a>

		<?php if ( pile_show_mini_cart() ) { ?>
		<button class="js-cart-icon cart-icon cart-icon--mobile">
			<?php get_template_part('assets/images/cart-icon-svg'); ?>
			<span><?php echo sprintf( _n( '%d', WC()->cart->get_cart_contents_count(), 'woothemes' ), WC()->cart->get_cart_contents_count() ); ?></span>
		</button>
		<?php } ?>

	</div><!-- .panel -->

	<div class="panel site-navigation">
		<div></div>
		<?php
		$args = array(
			'theme_location' => 'main_menu',
			'menu'           => '',
			'container'      => '',
			'container_id'   => '',
			'menu_class'     => 'nav  nav--main  djax-updatable',
			'menu_id'        => 'mainNav',
			'link_after'     => '<span class="sub-menu-toggle"></span>',
			'fallback_cb'    => null,
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		);
		wp_nav_menu( $args ); ?>
		<button class="nav-close-button  js-mobile-nav-close"></button>
		<div>
			<?php
			$args = array(
				'theme_location' => 'social_menu',
				'menu'           => '',
				'container'      => '',
				'container_id'   => '',
				'menu_class'     => 'nav  nav--social-icons',
				'menu_id'        => '',
				'fallback_cb'    => null,
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			);

			wp_nav_menu( $args );

			if ( pile_show_mini_cart() ) { ?>
			<button class="js-cart-icon cart-icon cart-icon--desk">
				<?php get_template_part('assets/images/cart-icon-svg'); ?>
				<span><?php echo sprintf( _n( '%d', WC()->cart->get_cart_contents_count(), 'woothemes' ), WC()->cart->get_cart_contents_count() ); ?></span>
			</button>
			<?php } ?>

		</div>
	</div><!-- .panel.site-navigation -->

</header><!-- .site-header -->

<?php if ( pile_option( 'enable_copyright_overlay' ) ) : ?>

<div class="copyright-overlay">
	<div class="copyright-overlay__container">
		<div class="copyright-overlay__content">
			<?php echo pile_option( 'copyright_overlay_text' ) ?>
		</div>
	</div>
</div>

<?php endif; ?>