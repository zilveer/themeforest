<?php
/**
 * The Header for Organique Theme
 *
 * @package Organique
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-touch">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!--  = Google Fonts =  -->
	<script type="text/javascript">
		WebFontConfig = {
			google: { families: [ 'Arvo:700:latin', 'Open+Sans:400,600,700:latin' ] }
		};
		(function() {
			var wf = document.createElement('script');
			wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
				'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
			wf.type = 'text/javascript';
			wf.async = 'true';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(wf, s);
		})();
	</script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

	<!-- W3TC-include-js-head -->
	<?php wp_head(); ?>
	<!-- W3TC-include-css -->
</head>

<body <?php body_class( 'yes' === get_theme_mod( 'boxed' ) ? 'boxed' : '' ); ?>>
	<!-- W3TC-include-js-body-start -->

	<div class="top<?php echo get_theme_mod( 'fixed_static_nav', 'static' ) === 'fixed' ? '  js--fixed-header-offset' : ''; ?>">
		<div class="container">
			<div class="row">
				<div class="col-xs-12  col-sm-6">
					<div class="top__slogan">
						<?php echo html_entity_decode( get_bloginfo ( 'description' ), ENT_COMPAT | ENT_HTML5 );  ?><br />
					</div>
				</div>
				<div class="col-xs-12  col-sm-6">
					<div class="top__menu">
						<?php
							if ( has_nav_menu( 'top-bar-menu' ) ) {
								wp_nav_menu( array(
									'theme_location' => 'top-bar-menu',
									'container' => false,
									'menu_class' => 'nav  nav-pills'
								) );
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<header class="header<?php echo get_theme_mod( 'fixed_static_nav', 'static' ) === 'fixed' ? '  js--navbar' : ''; ?>">
		<div class="container">
			<div class="row">
				<div class="col-xs-10  col-md-3  reset-min-height">
					<div class="header-logo">
						<a class="brand" href="<?php echo home_url(); ?>">
						<?php
							$logo = esc_url( get_theme_mod( 'logo_img', get_template_directory_uri() . '/assets/images/logo.png' ) );
							if ( ! empty( $logo ) ) :
						?>
							<img src="<?php echo $logo; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
						<?php
							else :
						?>
							<h1><?php bloginfo( 'name' ); ?></h1>
						<?php
							endif;
						?>
						</a>
					</div>
				</div>
				<div class="col-xs-2  visible-sm  visible-xs">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle  collapsed" data-toggle="collapse" data-target="#collapsible-navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
				</div>
				<div class="col-xs-12  col-md-<?php echo is_woocommerce_active() ? '7' : '9'; ?>">
					<nav class="navbar  navbar-default" role="navigation">
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse  navbar-collapse" id="collapsible-navbar">
							<?php
								if ( has_nav_menu( 'main-menu' ) ) {
									wp_nav_menu( array(
										'theme_location' => 'main-menu',
										'container' => false,
										'menu_class' => 'nav  navbar-nav  js-dropdown'
									) );
								} else {
									printf( __( 'Define your main menu in WP Admin %1$s Appearance %1$s Menus', 'organique_wp' ), '<i class="glyphicon glyphicon-chevron-right"></i>' );
								}
							?>
							<ul class="nav navbar-nav">
								<li class="hidden-xs  hidden-sm">
									<a href="#" class="js--toggle-search-mode"><span class="glyphicon  glyphicon-search  glyphicon-search--nav"></span></a>
								</li>
							</ul>
							<!-- search for mobile devices -->
							<form role="search" method="get" class="visible-xs  visible-sm  mobile-navbar-form" action="<?php echo home_url( '/' ); ?>">
								<div class="input-group">
									<input type="text" class="form-control" name="s" placeholder="Search">
									<span class="input-group-addon">
										<button type="submit" class="mobile-navbar-form__appended-btn"><span class="glyphicon  glyphicon-search  glyphicon-search--nav"></span></button>
									</span>
								</div>
								<?php if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) : ?>
								<input type="hidden" name="post_type" value="product">
								<?php endif ?>
							</form>
							<?php if ( is_woocommerce_active() ): ?>
							<div class="mobile-cart  visible-xs  visible-sm  push-down-15">
								<span class="header-cart__text--price"><span class="header-cart__text"><?php _e( 'CART', 'organique_wp' ); ?></span> <span class="header-cart__text"><?php _e( 'CART', 'organique_wp' ); ?></span> <?php echo WC()->cart->get_cart_subtotal(); ?></span>
								<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="header-cart__items">
									<span class="header-cart__items-num"><?php echo WC()->cart->cart_contents_count; ?></span>
								</a>
							</div>
							<?php endif ?>
						</div><!-- /.navbar-collapse -->
					</nav>
				</div>
				<div class="col-xs-12  col-md-2  hidden-sm  hidden-xs">
				<?php
					if ( is_woocommerce_active() ) :
				?>

					<!-- Cart in header -->
					<?php echo organique_add_to_cart_dropdown(); ?>

				<?php
					endif;
				?>
			</div>
		</div>
	</div>

	<!--Search open pannel-->
	<div class="search-panel">
		<div class="container">
			<div class="row">
				<div class="col-sm-11">
					<form role="search" method="get" class="search-panel__form" action="<?php echo home_url( '/' ); ?>">
						<span class="sr-only"><?php _e( 'Search for:', 'organique_wp' ); ?></span>
						<button type="submit"><span class="glyphicon  glyphicon-search"></span></button>
						<input type="text" name="s" value="<?php echo empty( $_GET['s'] ) ? '' : esc_html( $_GET['s'] ); ?>" class="form-control  js--search-panel-text" placeholder="<?php _e( 'Enter your search keyword', 'organique_wp' ); ?>">
					</form>
				</div>
				<div class="col-sm-1">
					<div class="search-panel__close  pull-right">
						<a href="#" class="js--toggle-search-mode"><span class="glyphicon  glyphicon-circle  glyphicon-remove"></span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<?php get_template_part( 'content', 'breadcrumbs' ); ?>