<?php
if ( is_page_template( 'template/template-splash.php' ) ) {
	$css_class = 'header-section slpash-header';
} else {
	$css_class = 'header-section not-splash-header';
}

global $current_user;
wp_get_current_user();
$userID  =  $current_user->ID;
$user_custom_picture =  get_the_author_meta( 'fave_author_custom_picture' , $userID );
$header_layout = houzez_option('header_1_width');
if( empty($header_layout) ) { $header_layout = 'container'; }

$main_menu_sticky = houzez_option('main-menu-sticky');
$header_1_menu_align = houzez_option('header_1_menu_align');
$top_bar = houzez_option('top_bar');

if( $top_bar != 0 ) {
	get_template_part('inc/header/top', 'bar');
}
$menu_righ_no_user = '';
$header_login = houzez_option('header_login');
if( $header_1_menu_align == 'nav-right' && $header_login != 'yes' ) {
	$menu_righ_no_user = 'menu-right-no-user';
}
?>

<!--start section header-->
<header id="header-section" data-sticky="<?php echo esc_attr( $main_menu_sticky ); ?>" class="houzez-header-main <?php echo esc_attr( $css_class ).' '.esc_attr( $header_1_menu_align ).' '.esc_attr($menu_righ_no_user); ?> hidden-sm hidden-xs">
	<div class="<?php echo esc_attr( $header_layout ); ?>">
		<div class="header-left">

			<div class="logo logo-desktop">
				<?php get_template_part('inc/header/logo'); ?>
			</div>


			<nav class="navi main-nav">
				<?php
				// Pages Menu
				if ( has_nav_menu( 'main-menu' ) ) :
					wp_nav_menu( array (
						'theme_location' => 'main-menu',
						'container' => '',
						'container_class' => '',
						'menu_class' => '',
						'menu_id' => 'main-nav',
						'depth' => 4
					));
				endif;
				?>
			</nav>
		</div>
		<?php if( class_exists('Houzez_login_register') ): ?>
			<?php if( houzez_option('header_login') != 'no' ): ?>
				<div class="header-right">
					<?php get_template_part('inc/header/login', 'nav'); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</header>
<!--end section header-->

<?php get_template_part( 'inc/header/mobile-header' ); ?>
