<?php
$g5plus_options = &G5Plus_Global::get_options();
$prefix = 'g5plus_';

$mobile_logo_height = rwmb_meta($prefix . 'mobile_logo_height');
if ($mobile_logo_height === '') {
	if (isset($g5plus_options['mobile_logo_height']) && isset($g5plus_options['mobile_logo_height']['height']) && ! empty($g5plus_options['mobile_logo_height']['height'])) {
		$mobile_logo_height = $g5plus_options['mobile_logo_height']['height'];
	}
}
$mobile_logo_height = str_replace('px' , '', $mobile_logo_height);
if ($mobile_logo_height != '') {
	$mobile_logo_height .= 'px';
}

$mobile_logo = g5plus_get_logo_url('mobile_logo');
$mobile_logo_retina = g5plus_get_logo_url('mobile_logo_retina');

?>
<div class="header-logo-mobile">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
		<img class="<?php echo !empty($mobile_logo_retina) ? 'has-retina' : '' ?>" <?php echo ($mobile_logo_height == '' ? '' : 'style="height:' . esc_attr($mobile_logo_height) .'"') ?> src="<?php echo esc_url($mobile_logo); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
		<?php if (!empty($mobile_logo_retina)): ?>
			<img class="retina-logo" <?php echo ($mobile_logo_height == '' ? '' : 'style="height:' . esc_attr($mobile_logo_height) .'"') ?> src="<?php echo esc_url($mobile_logo_retina); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
		<?php endif;?>
	</a>
</div>