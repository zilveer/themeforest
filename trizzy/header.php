<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Trizzy
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<?php wp_head(); ?>
</head>

<body <?php $style = get_theme_mod( 'trizzy_layout_style', 'boxed' ); body_class($style); ?>>
	<div id="wrapper">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'trizzy' ); ?></a>


	<!-- Top Bar
	================================================== -->
	<div id="top-bar">
		<div class="container top-header-container">

			<!-- Top Bar Menu -->
			<div class="ten columns">
				<ul class="top-bar-menu">
					<?php
					if(ot_get_option( 'pp_contact_details') == 'on') {
						$email = ot_get_option( 'pp_cdetails_email');
						$phone = ot_get_option( 'pp_cdetails_phone');
						if($phone) { ?><li><i class="fa fa-phone"></i><?php echo $phone;?></li><?php }
						if($email) { ?><li><i class="fa fa-envelope"></i><a href="mailto:<?php echo esc_attr($email) ;?>"><?php echo $email;?></a></li><?php }
					} ?>
					<?php

					if (ot_get_option('pp_lang_switcher','off') == 'on' && class_exists('SitePress')): ?>
						<li>
							<div class="top-bar-dropdown">
								<span><?php echo ICL_LANGUAGE_NAME; ?></span>
								<ul class="options">
									<?php
										$languages = icl_get_languages('skip_missing=0&orderby=KEY&order=DIR');
											foreach ($languages as $lang) { ?>
												<li><a href="<?php echo $lang['url']; ?>"><?php echo $lang['native_name'];  ?></a></li>
										<?php } ?>
								 </ul>
							</div>
						</li>
					<?php endif;

					if(function_exists('get_woocommerce_currency') && ot_get_option('pp_currency_switcher','off') == 'on') :  ?>
					<li>
						<div class="top-bar-dropdown currency-change">
							<span><?php global $woocommerce_wpml; echo $woocommerce_wpml->multi_currency_support->get_client_currency(); ?></span>
								<?php do_action('currency_switcher', array(
									'format' => '<a href="#">%code%</a>',
									'switcher_style' => 'list'
								)); ?>

						</div>
					</li>
					<?php endif; ?>
				</ul>
			</div>

			<!-- Social Icons -->
			<div class="six columns">
				<?php /* get the slider array */
				$headericons = ot_get_option( 'pp_headericons', array() );
				if ( !empty( $headericons ) ) {
					echo '<ul class="social-icons">';
					foreach( $headericons as $icon ) {
						echo '<li><a class="' . $icon['icons_service'] . '" title="' . esc_attr($icon['title']) . '" href="' . esc_url($icon['icons_url']) . '"><i class="icon-' . $icon['icons_service'] . '"></i></a></li>';
					}
					echo '</ul>';
				}
				?>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>



<!-- Header
	================================================== -->
<div class="container header-container">
	<?php
	$logo_area_width = ot_get_option('pp_logo_area_width',4);
	$menu_area_width = 16 - $logo_area_width;
	?>

	<!-- Logo -->
	<div class="<?php echo trizzy_number_to_width($logo_area_width); ?> columns <?php if($logo_area_width == 16 && ot_get_option('pp_logo_center','off') == "on") { echo "center-logo"; } ?>">
		<div id="logo" <?php if(get_theme_mod('trizzy_tagline_position','next') == 'next') { echo 'class="simple-home-logo"';} ?> >
		<?php
			$logo = ot_get_option( 'pp_logo_upload' );
			if($logo) {
				if(is_front_page()){ ?>
					<h1><a class="current homepage" id="current" href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><img src="<?php echo $logo; ?>" alt="<?php esc_attr(bloginfo('name')); ?>"/></a></h1>
				<?php } else { ?>
					<h2><a class="current homepage" id="current" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo $logo; ?>" alt="<?php esc_attr(bloginfo('name')); ?>"/></a></h2>
			<?php }
			} else {
				if(is_front_page()) { ?>
					<h1><a class="current homepage" id="current" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		  <?php } else { ?>
					<h2><a class="current homepage" id="current" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
		  <?php }
			}
		?>
		<?php if(get_theme_mod('trizzy_tagline_switch','hide') == 'show') { ?><div id="<?php if(get_theme_mod('trizzy_tagline_position','next') == 'next') { echo "tagline"; } else { echo "blogdesc"; }?>"><?php bloginfo( 'description' ); ?></div><?php } ?>
		</div>
	</div>

	<!-- Additional Menu -->
	<?php if($logo_area_width != 16) {?>
		<div class="<?php echo trizzy_number_to_width($menu_area_width); ?> columns header-right">
			<div id="additional-menu">
				<?php wp_nav_menu( array(
						'theme_location' => 'shop',
						'container' => false,
						'menu_id' => 'shop-menu',
						'menu_class' => ' ',
						'fallback_cb'     => 'trizzy_shop_menu',
				)); ?>
			</div>
		</div>

		<!-- Shopping Cart -->
		<div class="<?php echo trizzy_number_to_width($menu_area_width); ?> columns  header-right">

		<?php if(ot_get_option( 'pp_woo_header_cart' ) == 'on') { get_template_part( 'inc/mini_cart'); }?>


			<?php if(ot_get_option('pp_search','on') == 'on') { ?>
			<!-- Search -->
			<nav class="top-search">
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
					<button><i class="fa fa-search"></i></button>
					<input class="search-field" type="text" name="s" placeholder="<?php _e('Search','trizzy') ?>" value=""/>
					<?php if(ot_get_option('pp_search_just_woo','off') == 'on') { ?>  <input type="hidden" name="post_type" value="product" /> <?php } ?>
				</form>
			</nav>

			<?php } ?>
		</div>
	<?php } ?>

</div>


	<!-- Navigation
	================================================== -->
	<div class="container menu-container">
		<div class="sixteen columns">

			<a href="#menu" class="menu-trigger"><i class="fa fa-bars"></i> <?php _e('Menu','trizzy'); ?></a>

			<nav id="navigation" class="<?php echo get_theme_mod( 'trizzy_menu_style', 'dark' ); ?>">
				<?php 
				if(ot_get_option('pp_disablemm','off')=='off') {
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container' => false,
						'menu_id' => 'responsive',
						'fallback_cb' => 'trizzy_fallback_menu',
						'walker' => new trizzy_megamenu_walker	
					));
				} else {
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container' => false,
						'menu_id' => 'responsive',
						'fallback_cb' => 'trizzy_fallback_menu',
						
					));
				}
				?>
			</nav>
		</div>
	</div>
