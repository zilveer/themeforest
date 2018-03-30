<?php if ( has_nav_menu( 'footer' ) ) : ?>
<!-- FOOTER MENU : begin -->
<nav class="footer-menu">

    <?php wp_nav_menu(
        array(
            'theme_location'  => 'footer',
			'container'       => '',
			'menu_id'         => 'menu-footer-items',
			'menu_class'      => 'footer-menu menu-items',
			'fallback_cb'     => '',
            'link_before'     => '<span>',
            'link_after'      => '</span>',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>'
		)
	); ?>

</nav>
<!-- FOOTER MENU : end -->
<?php endif; ?>