<?php
$g5plus_options = &G5Plus_Global::get_options();
$prefix = 'g5plus_';

$header_class = array('main-header');

// GET HEADER BOXED
$header_boxed = rwmb_meta($prefix . 'header_boxed');
if (($header_boxed == '') || ($header_boxed == '-1')) {
	$header_boxed = $g5plus_options['header_boxed'];
}
if ($header_boxed == '1') {
	$header_class[] = 'header-boxed';
}

// SET HEADER FLOAT CLASS
if (G5Plus_Global::get_header_layout() == 'header-2') {
	$header_class[] = 'header-float';
}

$header_layout = G5Plus_Global::get_header_layout();
if(is_404()){
	$header_layout = $g5plus_options['header_404_layout'];
}
?>
<header id="main-header-wrapper" class="<?php echo join(' ', $header_class); ?>">
	<?php if ($header_layout == 'header-1'): ?>
		<?php g5plus_get_template('header/top-bar' ); ?>
	<?php endif;?>
	<?php g5plus_get_template('header/' . $header_layout ); ?>
	<?php if ($header_layout == 'header-3'): ?>
		<?php g5plus_get_template('header/top-bar' ); ?>
	<?php endif;?>
</header>