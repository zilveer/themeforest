<?php
/**
 * @package WordPress
 * @subpackage AllAround Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */
?>
<!DOCTYPE HTML>
<?php
	global $allaround_data;
	if ( $allaround_data['boxed'] == 1 ) $body_class = 'boxed'; else $body_class = 'wide';
?>
<html <?php language_attributes(); ?>>
<head>
<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php if ( $allaround_data['responsive'] == 1 ) :	?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php else : ?>
<meta name="viewport" content="width=1024, initial-scale=1.0, maximum-scale=3, user-scalable=1, target-densitydpi=device-dpi">
<?php endif; ?>
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<script type="text/javascript">
	var lessThenIe8 = false;
</script>
<?php
	if( $allaround_data['tracking-code'] != '' ) :
		echo $allaround_data['tracking-code'];
	endif;
	wp_head();
?>
<!--[if lt IE 9]>
	<link href="style_IE.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
		lessThenIe8 = true;
	</script>
<![endif]-->
</head>
<body <?php echo body_class($body_class); ?>>
	<header>
		<div class="header_wrap">
			<nav class="supheader_wrap">
				<div class="icon_wrap">
					<ul>
						<?php
							if ( $allaround_data['header-facebook'] !== '' ) echo '<li><a href="' . $allaround_data['header-facebook'] . '" class="header_socials fb" target="_blank"></a></li>';
							if ( $allaround_data['header-twitter'] !== '' ) echo '<li><a href="' . $allaround_data['header-twitter'] . '" class="header_socials tw" target="_blank"></a></li>';
							if ( $allaround_data['header-digg'] !== '' ) echo '<li><a href="' . $allaround_data['header-digg'] . '" class="header_socials digg" target="_blank"></a></li>';
							if ( $allaround_data['header-linkedin'] !== '' ) echo '<li><a href="' . $allaround_data['header-linkedin'] . '" class="header_socials in" target="_blank"></a></li>';
							if ( $allaround_data['header-rss'] !== '' ) echo '<li><a href="' . $allaround_data['header-rss'] . '" class="header_socials rss" target="_blank"></a></li>';
							if ( $allaround_data['header_google'] !== '' ) echo '<li><a href="' . $allaround_data['header_google'] . '" class="header_socials gplus" target="_blank"></a></li>';

							if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && $allaround_data['disable_cart'] == 0 ) {
								global $woocommerce;
								?>
								<li><a class="header_socials cart-style" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'allaround'); ?>"><span><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'allaround'), $woocommerce->cart->cart_contents_count);?></span></a></li>
								<li>
								<?php if ( is_user_logged_in() ) { ?>
									<a class="header_socials login-style" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','allaround'); ?>"><?php _e('My Account','allaround'); ?></a>
								<?php } 
								else { ?>
									<a class="header_socials login-style" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Log in','allaround'); ?>"><?php _e('Log in','allaround'); ?></a>
								<?php } ?>
								</li>
								<?php
								}
						?>
						</ul>
						<div class="clear"></div>
					</div><!-- header_wrapper -->
				<div class="clear"></div>
				</nav><!-- supheader_wrap -->
			<div class="header_wrapper">
				<div class="clear"></div>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $allaround_data['logo']; ?>" alt="<?php bloginfo('name'); ?>" class="logo" /></a>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $allaround_data['logo_small']; ?>" alt="<?php bloginfo('name'); ?>" class="logo_small" /></a>
				<nav class="header_menu">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => '4', 'fallback_cb' => 'wp_list_pages_custom',  'container' => false, 'menu_id' => 'allaround_menu', 'menu_class' => ''
 ) ); ?>
						<div class="clear"></div><!--clear -->
					</nav><!-- header_menu -->
					
				<div class="clear"></div><!--clear -->
		<div class="responsive_menu">
			<div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => '3', 'walker' => new Walker_Nav_Menu_Dropdown,  'container' => false, 'items_wrap'     => '<form><select onchange="if (this.value) window.location.href=this.value"><option value="' . esc_url( home_url( '/' ) ) . '">' . __('Home', 'allaround') . '</option>%3$s</select></form>', ) ); ?>
				</div>
			</div><!-- responsive_menu -->
				</div><!-- header_wrapper -->
			</div><!-- header_wrap -->
		
			<div class="clear"></div><!--clear -->
	</header>
	<div id="header-space"></div>
	<div id="header-outer" data-using-logo="1" data-logo-height="30" data-padding="" data-header-resize="1"></div><!--/header-outer-->

	<?php
		global $allaround_postmeta;
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && ( is_product() or is_product_category() or is_product_tag() ) ) $allaround_postmeta['slider'] = 0;
		if ( $allaround_postmeta['slider'] == 1) {
			if ( $allaround_postmeta['allaround_slider_type'] == 'Revolution' && $allaround_postmeta['revolution_slider'] ) {
	?>

			<div class="slider_wrapper margin-bottom24">
				<?php putRevSlider( $allaround_postmeta['revolution_slider'] ); ?>
			</div><!-- slider_wrapper -->
	<?php
			}
			elseif ( $allaround_postmeta['allaround_slider_type'] == 'iCarousel' ) {
	?>
			<div class="slider_wrapper index2 margin-bottom24">
				<?php allaround_icarousel(); ?>
			</div><!-- slider_wrapper -->
	<?php
			}
			elseif ( $allaround_postmeta['allaround_slider_type'] == '3DSlider' ) {
	?>
			<div class="slider_wrapper index3">
				<?php allaround_threedslider(); ?>
			</div>
	<?php		
			}
		}
		else {
			echo '<div class="slider_clear"></div>';
		}
	?>