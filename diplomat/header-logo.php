<?php
$logo_type = TMM::get_option("logo_type");

$logo_img = TMM::get_option("logo_img");

$logo_text = esc_html(TMM::get_option("logo_text"));

if (TMM::get_option("use_logo_two_colors")){
	$logo_text = esc_html(TMM::get_option("splitted_logo_text"));
	$logo_text = explode('^', $logo_text);
	$logo_text = (isset($logo_text['1'])) ? $logo_text['0'] . '<b>' . $logo_text['1'] . '</b>' : $logo_text['0'];
}

$logo_img_attr = '';
$logo_color = '';

if( get_theme_mod('header_textcolor') ) {
	$logo_color = get_header_textcolor();
}

if( !empty($logo_color) ) {
	$logo_color = ' style="color:#'.$logo_color.';"';
}

if( get_theme_mod('header_image') && get_header_image() ) {
	$logo_img = get_header_image();
	$logo_img_attr = ' height="'. get_custom_header()->height . '" width="' . get_custom_header()->width . '"';
	$logo_type = 'image';
}

if (!$logo_type && $logo_text) {
	?>
	<div class="logo">
		<h1 class="tmm_logo">
			<a title="<?php echo esc_attr(get_bloginfo('description')); ?>" href="<?php echo esc_url(home_url()); ?>"<?php echo $logo_color; ?>><?php echo $logo_text; ?></a>
		</h1>
	</div>
	<?php
} else if ($logo_type && $logo_img) {
	?>
	<div class="logo">
		<a class="tmm_logo" title="<?php echo esc_attr(get_bloginfo('description')); ?>" href="<?php echo esc_url(home_url()); ?>">
			<img<?php echo $logo_img_attr; ?> src="<?php echo esc_url($logo_img); ?>" alt="<?php echo esc_attr(get_bloginfo('description')); ?>" />
		</a>
	</div>
	<?php
} else {
	?>
	<div class="logo">
		<h1 class="tmm_logo">
			<a title="<?php echo esc_attr(get_bloginfo('description')); ?>" href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Diplo', 'diplomat') ?><b><?php esc_html_e('mat', 'diplomat') ?></b></a>
		</h1>
	</div>
	<?php
}

