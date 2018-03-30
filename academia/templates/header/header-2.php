<?php
$g5plus_options = &G5Plus_Global::get_options();
$prefix = 'g5plus_';
$header_class = array('header-nav-wrapper', 'header-2');

// GET HEADER STICKY
$header_sticky = rwmb_meta($prefix . 'header_sticky');
if (($header_sticky === '') || ($header_sticky == '-1')) {
	$header_sticky = $g5plus_options['header_sticky'];
}
if ($header_sticky == '1') {
	$header_class[] = 'header-sticky';
}

// GET HEADER CONTAINER LAYOUT
$header_container_layout = rwmb_meta($prefix . 'header_container_layout');
if (($header_container_layout == '') || ($header_container_layout == '-1')) {
	$header_container_layout = $g5plus_options['header_container_layout'];
}

// GET PAGE MENU
$page_menu = rwmb_meta($prefix . 'page_menu');

?>
<div class="<?php echo join(' ', $header_class) ?>">
	<div class="<?php echo esc_attr($header_container_layout) ?>">
		<div class="header-container clearfix">
			<?php g5plus_get_template('header/header-logo' ); ?>
			<div class="header-nav-right">
				<?php g5plus_get_template('header/top-bar' ); ?>
				<div class="header-nav-above">
					<?php if (has_nav_menu('primary')) : ?>
						<div id="primary-menu" class="menu-wrapper">
							<?php
							$arg_menu = array(
								'menu_id' => 'main-menu',
								'container' => '',
								'theme_location' => 'primary',
								'menu_class' => 'main-menu ' . G5Plus_Global::get_option('sub_menu_scheme',''),
								'walker' => new XMenuWalker()
							);
							if (!empty($page_menu)) {
								$arg_menu['menu'] = $page_menu;
							}
							wp_nav_menu( $arg_menu );
							?>
						</div>
					<?php endif; ?>
					<?php g5plus_get_template('header/header-customize-nav' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>