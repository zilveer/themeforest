<?php
/**
 * The template for displaying the footer widget areas.
 * @package Pile
 * @since   Pile 1.0
 */
?>
<footer class="site-footer  wrapper">
	<div class="content-width">

		<?php get_template_part( 'sidebar-footer' ); ?>

		<div class="footer-meta">
			<div class="copyright-area">
				<?php $copyright_text = pile_option( 'copyright_text' );
				if ( ! empty( $copyright_text ) ) { ?>
					<div class="copyright-text"><?php echo do_shortcode( $copyright_text ) ?></div>
				<?php } ?>
				<?php
				$args = array(
					'theme_location' => 'footer_menu',
					'container'      => '',
					'menu_class'     => 'nav  nav--footer',
					'depth'          => 1,
					'fallback_cb'    => null,
					'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				);
				wp_nav_menu( $args );
				?>
			</div>
		</div>
	</div><!-- .copyright-area -->
</footer><!-- .site-footer -->
</div>

<?php
	$border_color = pile_get_the_hero_background_color();
	$logo_progress = pile_option( 'logo_progress' );

	if ( empty($border_color) ) {
		$border_color = '#333';
	}

	if ( ! empty( $logo_progress ) ) {
		$logo = wp_get_attachment_image_src( $logo_progress );
		$logo_markup = '<img class="logo__img" width="' . $logo[1] . '" height="' . $logo[2] . '" src="' . $logo[0] . '" />';
	} else {
		$logo_markup = '<h1 class="logo__text">' . get_bloginfo( 'name' ) . '</h1>';
	}

	$logo_markup = '<div class="logo">' . $logo_markup . '</div>';
?>

<?php wp_footer(); ?>

</div>
</div>

<div class="cart-widget">
	<div class="widget_shopping_cart_content"></div>
</div>

<div class="pile-item-border js-border" <?php if ( ! is_customize_preview() ) echo 'style="border-color:' . $border_color . '; background: ' . $border_color . ';"' ?>>
	<div class="border-logo-bgscale">
		<div class="border-logo-background">
			<div class="border-logo-fill"></div>
			<?php echo $logo_markup; ?>
		</div>
	</div>
	<div class="border-logo"><?php echo $logo_markup; ?></div>
</div>

</body>
</html>