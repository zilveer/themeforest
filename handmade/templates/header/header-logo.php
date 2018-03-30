<?php
global $g5plus_options, $g5plus_header_layout;

$prefix = 'g5plus_';
$logo_meta_id = rwmb_meta($prefix . 'custom_logo');
$logo_meta = rwmb_meta($prefix . 'custom_logo', 'type=image_advanced');
$logo_url = '';
if ($logo_meta !== array() && isset($logo_meta[$logo_meta_id]) && isset($logo_meta[$logo_meta_id]['full_url'])) {
	$logo_url = $logo_meta[$logo_meta_id]['full_url'];
}

if ($logo_url === '') {
	$logo_url = THEME_URL . 'assets/images/theme-options/logo.png';

	if (isset($g5plus_options['logo']['url']) && !empty($g5plus_options['logo']['url'])) {
		$logo_url = $g5plus_options['logo']['url'];
	}
}

$logo_sticky = '';

if (!in_array($g5plus_header_layout, array('header-2', 'header-4', 'header-5', 'header-6', 'header-7'))) {
	$logo_sticky_meta_id = rwmb_meta($prefix . 'sticky_logo');
	$logo_sticky_meta = rwmb_meta($prefix . 'sticky_logo', 'type=image_advanced');

	$logo_sticky = '';
	if ($logo_sticky_meta !== array() && isset($logo_sticky_meta[$logo_sticky_meta_id]) && isset($logo_sticky_meta[$logo_sticky_meta_id]['full_url'])) {
		$logo_sticky = $logo_sticky_meta[$logo_sticky_meta_id]['full_url'];
	}
	if (empty($logo_sticky)) {
		if (isset($g5plus_options['sticky_logo']) && isset($g5plus_options['sticky_logo']['url'])) {
			$logo_sticky = $g5plus_options['sticky_logo']['url'];
		}
		else if (isset($g5plus_options['logo']) && isset($g5plus_options['logo']['url'])) {
			$logo_sticky = $g5plus_options['logo']['url'];
		}
	}
}

$header_logo_class = array('header-logo');
if (!empty($logo_sticky) && ($logo_sticky != $logo_url)) {
	$header_logo_class[] = 'has-logo-sticky';
}

// Logo Height
$logo_height = rwmb_meta($prefix . 'logo_height');
if ($logo_height == '') {
	if (isset($g5plus_options['logo_height']) && isset($g5plus_options['logo_height']['height']) && ! empty($g5plus_options['logo_height']['height'])) {
		$logo_height = $g5plus_options['logo_height']['height'];
	}
}
$logo_height = str_replace('px' , '', $logo_height);
if ($logo_height != '') {
	$logo_height .= 'px';
}
?>
<div class="<?php echo join(' ', $header_logo_class) ?>">
	<a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
		<img <?php echo ($logo_height == '' ? '' : 'style="height:' . esc_attr($logo_height) .'"') ?> src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
	</a>
</div>
<?php if (!empty($logo_sticky) && ($logo_sticky != $logo_url)): ?>
	<div class="logo-sticky">
		<a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
			<img src="<?php echo esc_url($logo_sticky); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
		</a>
	</div>
<?php endif;?>