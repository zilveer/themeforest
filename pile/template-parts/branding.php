<?php
/**
 * The template for the branding of the header area (logo, site title, etc).
 *
 * @package Pile
 * @since   Pile 1.0
 */
?>
<a class="logo" href="<?php echo home_url(); ?>" title="<?php wp_title() ?>" rel="home">
<?php
$light_logo_image_src = pile_image_src( 'main_logo_light' );
$dark_logo_image_src = pile_image_src( 'main_logo_dark' );

if ( ! empty( $light_logo_image_src ) || ! empty( $dark_logo_image_src ) ) {
	if ( ! empty( $light_logo_image_src ) ) { ?>
		<img class="logo__img  logo__img--light" src="<?php echo $light_logo_image_src ?>" rel="logo" alt="<?php echo get_bloginfo( 'name' ) ?>"/>
	<?php }
	if ( ! empty( $dark_logo_image_src ) ) { ?>
		<img class="logo__img  logo__img--dark" src="<?php echo $dark_logo_image_src ?>" rel="logo" alt="<?php echo get_bloginfo( 'name' ) ?>"/>
	<?php }
} else { ?>
	<h1 class="logo__text"><?php echo get_bloginfo( 'name' ); ?></h1>
<?php } ?>
</a>