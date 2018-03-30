<?php if ( has_nav_menu( 'header' ) ) : ?>
<!-- HEADER MENU : begin -->
<nav class="header-menu">

	<button class="header-menu-toggle" type="button"><i class="fa fa-bars"></i><?php _e( 'MENU', 'beautyspot' ); ?></button>

    <?php $walker = new Lsvr_Main_Menu;
    wp_nav_menu(
        array(
            'theme_location'  => 'header',
			'container'       => '',
			'menu_id'         => 'menu-header-items',
			'menu_class'      => 'main-menu menu-items clearfix',
			'fallback_cb'     => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'walker' => $walker
		)
	); ?>

</nav>
<!-- HEADER MENU : end -->
<?php endif; ?>