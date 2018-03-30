<?php
/**
 * The template for displaying the footer widget areas.
 * @package Heap
 * @since   Heap 1.0
 **/ ?>
</section><!-- .content -->
<footer class="site-footer">
	<h2 class="accessibility"><?php __( 'Footer', 'heap' ) ?></h2>

	<?php get_template_part( 'sidebar-footer' ); ?>

	<div class="footer-menu">
		<nav class="navigation  navigation--footer">
			<?php
			echo wp_nav_menu( array (
				'theme_location'  => 'footer_menu',
				'menu'            => '',
				'container'       => '',
				'container_id'    => '',
				'menu_class'      => 'footer-menu',
				'fallback_cb'     => false,
				'menu_id'         => '',
				'depth'			  => 1,
				'items_wrap'      => '<ul id="%1$s" class="%2$s  nav  nav--main">%3$s</ul>',
			) ); ?>
		</nav>
	</div>
	<div class="copyright-text">
		<span><?php echo heap_option( 'copyright_text' ) ?></span>
	</div>
</footer><!-- .site-footer -->
</div><!-- .container -->
</div><!-- .wrapper -->
<?php wp_footer(); ?>

</body>
</html>