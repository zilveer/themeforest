<?php thb_nav_before(); ?>

<nav id="main-nav" class="main-navigation primary">
	<h2 class="hidden"><?php _e( 'Main navigation', 'thb_text_domain' ); ?></h2>
	<?php thb_nav_start(); ?>

	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => new THB_MegaMenuWalker ) ); ?>

	<?php thb_nav_end(); ?>
</nav>

<?php thb_nav_after(); ?>