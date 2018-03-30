<?php
/**
 * Template used for header/footer builder.
 *
 * @package Total WordPress Theme
 * @subpackage Templates
 * @version 3.5.0
 */ ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?><?php wpex_schema_markup( 'html' ); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?><?php wpex_schema_markup( 'body' ); ?>>

	<div id="footer-builder" class="footer-builder clr">
		<div class="footer-builder-content clr container entry">
			<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
		</div><!-- .footer-builder-content -->
	</div><!-- .footer-builder -->

<?php wp_footer(); ?>

</body>
</html>