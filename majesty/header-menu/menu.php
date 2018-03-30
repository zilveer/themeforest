<?php 
	do_action('sama_before_display_menu');
	// This is Default Menu
	global $majesty_options;

	if( ! is_404() ) {
		if( ! is_page_template( 'page-templates/page-builder.php' )  ) {
			if( $majesty_options['menu_has_trans'] ) {
				get_template_part('header-menu/header-bg');
			}
		}
	} else {
		get_template_part('header-menu/404');
	}
?>
<header id="header" class="<?php echo esc_attr($majesty_options['header_css']); ?>">
	<div class="container">
		<div class="row">           
			<div id="main-menu-trigger"><i class="fa fa-bars"></i></div>
			<div id="logo">
				<a class="big-logo" href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
					<img src="<?php echo esc_url( $majesty_options['logo-big'] ); ?>" alt="<?php bloginfo('name'); ?>">
				</a>
			   <a class="small-logo" href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
					<img src="<?php echo esc_url( $majesty_options['logo-small'] ); ?>" alt="<?php bloginfo('name'); ?>">
				</a>
			</div> <!--End #logo  -->
			
			<div class="wrap-menu-cart dark">
				<nav id="main-menu" class="dark"> <!--menu-center  -->
				  <?php
					$menu_location 	= 'top-menu';
					$menu_class 	= 'top-menu';
					if( ! empty( $majesty_options['pages_second_menu'] ) && in_array( sama_get_current_page_id(), $majesty_options['pages_second_menu'])  ) {
						$menu_location 	= 'top-menu-2';
					}
					if( ! empty( $majesty_options['pages_scroll_menu'] ) && in_array( sama_get_current_page_id(), $majesty_options['pages_scroll_menu'])  ) {
						$menu_class .= ' top-menu-scroll';
					}
					if ( function_exists( 'has_nav_menu' ) ) {
						wp_nav_menu( array( 'theme_location' => $menu_location, 'depth' => 3, 'container' => 'ul', 'menu_class' => $menu_class, 'menu_id' => 'top-menu',) );
					}
				?>
				</nav>
				<?php 
					if ( class_exists('woocommerce') && $majesty_options['display_top_cart'] ) { 
						get_template_part('header-menu/cart-icon');
					}
				?>
			</div>
		</div>
	</div>
</header>
<?php
	if( ! is_404() ) {
		if( ! is_page_template( 'page-templates/page-builder.php' )  ) {
			if( ! $majesty_options['menu_has_trans'] ) {
				get_template_part('header-menu/header-solid');
			}
		}
	}
?>

