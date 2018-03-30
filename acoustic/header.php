<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
	================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<!-- Mobile Specific Metas 
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<?php wp_head(); ?>

</head>

<body <?php body_class(ci_setting('ci_stylesheet')); ?>>
<?php do_action('after_open_body_tag'); ?>

<?php get_template_part('inc_mobile_bar'); ?>

<header class="row header">

	<div class="six columns logo-container">
		<?php ci_e_logo('<h1>', '</h1>'); ?>
	</div>
	
	<div class="six columns socials-top">
		<?php dynamic_sidebar('top-social-sidebar'); ?>
	</div>
	
	<nav class="twelve columns navigation top-navigation">
		<?php 
			if(has_nav_menu('ci_main_menu'))
				wp_nav_menu( array(
					'theme_location' => 'ci_main_menu',
					'fallback_cb'    => '',
					'container'      => '',
					'menu_id'        => 'navigation',
					'menu_class'     => 'nav sf-menu'
				));
			else
				wp_page_menu();
		?>
	</nav>
	
</header><!-- /header -->