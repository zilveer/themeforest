<!doctype html>
<?php $theme_settings = sleek_theme_settings(); ?>

<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>">

<link href="<?php echo $theme_settings->general['favicon'] ?>" rel="shortcut icon">
<link href="<?php echo $theme_settings->general['touch'] ?>" rel="apple-touch-icon-precomposed">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">

<?php wp_head(); ?>

<?php
	if( !empty( $theme_settings->advanced['custom_css'] ) ){
		echo '<style>' . $theme_settings->advanced['custom_css'] . '</style>';
	}
?>

</head>



<body <?php body_class(); ?>>
<div class="sleek-loader sleek-loader--body"></div>



<!-- header -->
<header id="header" class="header <?php echo( $theme_settings->style['bg']['bg_header_dark'] ? 'dark-mode' : ''); ?>">
	<div class="header__overflow js-nano js-nano-header">

		<div class="nano-content">

			<div class="header__inwrap">

				<!-- logo -->
				<a class="header__logo" title="<?php echo get_bloginfo('name'); ?>" href="<?php echo home_url(); ?>">
					<img src="<?php echo( $theme_settings->general['logo'] ); ?>" alt="Logo"/>
				</a>
				<!-- /logo -->

				<!-- nav -->
				<nav class="header__nav">
					<?php sleek_nav_menu_header(); ?>
				</nav>
				<!-- /nav -->



				<?php
					if($theme_settings->general['header_search']){
						echo '<div class="separator separator--small separator--center"></div>';
						get_template_part('searchform');
					}
				?>



				<!-- Footer -->
				<div class="header__footer js-header-footer">

					<?php
						// Footer Widget Area
						if( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-area') );

						// Copyright
						if( $theme_settings->general['copyright'] ){
							echo '<div class="copyright">';
							echo $theme_settings->general['copyright'];
							echo '</div>';
						}
					?>

				</div>

			</div>
			<!-- /.header__inwrap -->

		</div>
	</div> <!-- /.header__overflow -->

	<a href="#" title="Show/Hide Header" class="header__toggle visible-touchscreen js-touchscreen-header-toggle"><div></div></a>

</header>
<!-- /header -->
