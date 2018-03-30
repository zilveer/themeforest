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

	<?php wpex_hook_header_before(); ?>

	<header id="site-header" class="<?php echo wpex_header_classes(); ?>"<?php wpex_schema_markup( 'header' ); ?>>

		<?php wpex_hook_header_top(); ?>

		<div id="site-header-inner" class="container clr">

			<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>

		</div><!-- #site-header-inner -->

		<?php wpex_hook_header_bottom(); ?>

	</header><!-- #header -->

	<?php wpex_hook_header_after(); ?>

<?php wp_footer(); ?>

</body>
</html>