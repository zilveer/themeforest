<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $top_menu_class;

$header_sticky_menu_mobile = get_data('header_sticky_menu_mobile');
$header_cart_info_show_in_header = get_data('header_cart_info_show_in_header');

$nav_id = 'main-menu';
$top_menu_class = 'light';

if(has_nav_menu('mobile-menu'))
	$nav_id = 'mobile-menu';

$menu = wp_nav_menu(
	array(
		'theme_location'    => $nav_id,
		'container'         => '',
		'menu_class'        => 'mobile-menu',
		'echo'				=> false
	)
);
?>
<header class="mobile-menu<?php echo $header_sticky_menu_mobile ? ' sticky-mobile' : ''; ?>">

	<section class="mobile-logo">

		<?php get_template_part('tpls/header-logo'); ?>
		
		<?php
		if ( $header_cart_info_show_in_header ) {
			aurum_show_header_cart_icon( array( 35, 35 ) );
		}
		?>

		<div class="mobile-toggles">
			<a class="toggle-menu" href="#">
				<?php echo lab_get_svg('images/toggle-menu.svg'); ?>
				<span class="sr-only"><?php _e('Toggle Menu', 'aurum'); ?></span>
			</a>
		</div>

	</section>

	<section class="search-site<?php echo lab_get('s') ? ' is-visible' : ''; ?>">

		<?php get_template_part('tpls/header-search-form'); ?>

	</section>

	<?php echo $menu; ?>

	<?php
	if ( ! $header_cart_info_show_in_header ) {
		aurum_show_header_cart_icon();
	}
	?>

	<header class="site-header">
		<?php get_template_part('tpls/header-top-bar'); ?>
	</header>

</header>