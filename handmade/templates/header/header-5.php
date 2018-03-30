<?php
global $g5plus_options;

$prefix = 'g5plus_';

$header_class = array('main-header', 'header-5', 'header-desktop-wrapper');

$header_layout_float = rwmb_meta($prefix . 'header_layout_float');
if (($header_layout_float === '') || ($header_layout_float == '-1')) {
	$header_layout_float = $g5plus_options['header_layout_float'];
}
if ($header_layout_float == '1') {
	$header_class[] = 'header-float';
}

$header_nav_wrapper = array('header-nav-wrapper');

$header_sticky = rwmb_meta($prefix . 'header_sticky');
if (($header_sticky === '') || ($header_sticky == '-1')) {
	$header_sticky = $g5plus_options['header_sticky'];
}
if ($header_sticky == '1') {
	$header_nav_wrapper[] = 'header-sticky';

	$header_sticky_scheme = rwmb_meta($prefix . 'header_sticky_scheme');
	if (($header_sticky_scheme == '') || ($header_sticky_scheme == '-1')) {
		$header_sticky_scheme = isset($g5plus_options['header_sticky_scheme']) ? $g5plus_options['header_sticky_scheme'] : 'inherit';
	}
	$header_nav_wrapper[] = 'sticky-scheme-' . $header_sticky_scheme;
}

$header_nav_separate = rwmb_meta($prefix . 'header_nav_separate');
if (($header_nav_separate == '') || ($header_nav_separate == '-1')) {
	$header_nav_separate = isset($g5plus_options['header_nav_separate']) && !empty($g5plus_options['header_nav_separate'])
		? $g5plus_options['header_nav_separate'] : '0';
}

$header_nav_hover = rwmb_meta($prefix . 'header_nav_hover');
if (($header_nav_hover == '') || ($header_nav_hover == '-1')) {
	$header_nav_hover = isset($g5plus_options['header_nav_hover']) && !empty($g5plus_options['header_nav_hover'])
		? $g5plus_options['header_nav_hover'] : 'nav-hover-primary';
}
$header_nav_wrapper[] = $header_nav_hover;

$page_menu = rwmb_meta($prefix . 'page_menu');

$header_nav_inner_class = array('container');
$header_nav_layout = rwmb_meta($prefix . 'header_nav_layout');
if (($header_nav_layout == '-1') || ($header_nav_layout === '')) {
	$header_nav_layout = isset($g5plus_options['header_nav_layout']) ? $g5plus_options['header_nav_layout'] : '';
}
if ($header_nav_layout == 'nav-fullwith') {
	$header_nav_wrapper[] = $header_nav_layout;
}
?>
<header id="header" class="<?php echo join(' ', $header_class) ?>">
	<div class="<?php echo join(' ', $header_nav_wrapper) ?>">
		<div class="container">
			<div class="header-wrapper">
				<div class="header-left">
					<?php g5plus_get_template('header/header-logo' ); ?>
				</div>
				<div class="header-right">
					<?php if (has_nav_menu('primary')) : ?>
						<div id="primary-menu" class="menu-wrapper">
							<?php
							$arg_menu = array(
								'menu_id' => 'main-menu',
								'container' => '',
								'theme_location' => 'primary',
								'menu_class' => 'main-menu' . ($header_nav_separate == '1' ? ' nav-separate' : ''),
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
</header>