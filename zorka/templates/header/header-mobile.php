<?php
global $zorka_data;
$logo_url = '';
if (isset($zorka_data['site-logo'])) {
	$logo_url = $zorka_data['site-logo'];
}

?>
<div class="header-mobile">
	<div class="header-logo">
		<a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
			<img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
		</a>
	</div>
</div>