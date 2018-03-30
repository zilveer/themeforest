<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	

		<title><?php wp_title( '-', true, 'right' ); ?> <?php bloginfo( 'name' ); ?></title>

		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>?v=<?php echo op_theme_version; ?>">


		<?php if ( $i = op_theme_opt( 'bookmark-icon' ) ) : ?>
		
			<link rel="shortcut icon" href="<?php echo reset( wp_get_attachment_image_src( $i, 'full' ) ) ?>">
		
		<?php endif; ?>

		
		<?php if ( $i = op_theme_opt( 'apple-touch-icon' ) ) : ?>

			<link rel="apple-touch-icon-precomposed" href="<?php echo reset( wp_get_attachment_image_src( $i, 'full' ) ) ?>">
		
		<?php endif; ?>	


		<?php get_template_part( 'css' ); ?>	

		<?php wp_head(); ?>

	</head>

	<body id="start" <?php body_class(); ?>>