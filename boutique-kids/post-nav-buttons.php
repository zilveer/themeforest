<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<nav id="nav-single" class="navigation  ">
	<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'boutique-kids' ); ?></h3>

	<div class="nav-previous"><?php previous_post_link( '%link', esc_html__( '< Back', 'boutique-kids' ) ); ?></div>
	<?php if ( get_previous_post_link() && get_next_post_link() ) {
		 echo '<div class="nav-sep">|</div>';
	} ?>
	<div class="nav-next"><?php next_post_link( '%link', esc_html__( 'Next >', 'boutique-kids' ) ); ?></div>
</nav><!-- #nav-single -->