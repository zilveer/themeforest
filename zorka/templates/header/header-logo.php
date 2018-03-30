<?php
	global $zorka_data;
	$header_layout = get_post_meta(get_the_ID(),'header-layout',true);
	if (!isset($header_layout) || $header_layout == 'none' || $header_layout == '') {
		$header_layout =  $zorka_data['header-layout'];
	}

	$logo_url = '';
	if (isset($zorka_data['site-logo'])) {
		$logo_url = $zorka_data['site-logo'];
	}

	if ((($header_layout == '4') || ($header_layout == '8')) && isset($zorka_data['site-logo-white'])) {
		$logo_url = $zorka_data['site-logo-white'];
	}

?>
<div class="header-logo">
	<a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
		<img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
	</a>
</div>