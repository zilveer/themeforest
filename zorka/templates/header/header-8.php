<?php
global $zorka_data;
$header_class = array();
$header_class[] = 'main-header';
$header_class[] = 'header-8';

if (isset($zorka_data['header-sticky']) && ($zorka_data['header-sticky'] == '0')) {
	$header_class[] = 'sticky-disable';
}

$show_site_top = isset($zorka_data['show-site-top']) ? $zorka_data['show-site-top'] : 0;

$site_top_class = array();
$site_top_class[] = 'site-top';

global $woocommerce;
?>

<header class="<?php g5plus_the_attr_value($header_class) ?>">
	<?php if ($show_site_top): ?>
		<div class="<?php g5plus_the_attr_value($site_top_class) ?>">
			<div class="container">
				<div class="site-top-left">
					<?php get_template_part('templates/header/login','link' ); ?>
				</div>
				<div class="site-top-right">
					<?php get_template_part('templates/header/my','setting' ); ?>
					<?php get_template_part('templates/header/language' ); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php get_template_part('templates/header/header','mobile' ); ?>
	<div class="header">
		<nav class="zorka-navbar" role="navigation">
			<div class="container">
				<div class="zorka-navbar-header">
					<?php get_template_part('templates/header/header','logo' ); ?>
					<div class="search-header-wrapper">
						<div class="search-header-inner">
							<?php get_template_part('templates/header/product','category' ); ?>
							<input class="seach-header-input" type="text" placeholder="<?php esc_html_e("Let's Search", 'zorka');?>" />
							<i class="fa fa-search"></i>
							<div class="search-header-result"></div>
						</div>
					</div>
					<?php get_template_part('templates/header/mini','cart' ); ?>
				</div>
			</div>
			<div class="menu-wrapper">
				<?php if (has_nav_menu('primary')) : ?>
					<?php
					wp_nav_menu( array(
						'container' => 'div',
						'container_class' => 'container',
						'theme_location' => 'primary',
						'menu_class' => 'main-menu'
					) );
					?>
				<?php endif; ?>
			</div>
		</nav>
	</div>
</header>