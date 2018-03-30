<?php

if ( is_front_page() ) :

	$homeUrl = home_url( '/#start' );

else :

	$homeUrl = home_url( '/' );

endif;

?>

<div id="logo">

	<a href="<?php echo $homeUrl ?>" title="<?php esc_attr_e( get_bloginfo( 'name', 'display' ) ); ?>" >

		<h1><?php bloginfo( 'name' ); ?></h1>

	</a>
	
</div>