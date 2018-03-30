<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div class="wrapper">
 *
 * @package Evential
 * @subpackage Evential
 * @since Evential 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<!-- fav -->
	<link rel="shortcut icon" href="<?php
		global $tlazya_evential;
		if (isset($tlazya_evential['fav_url']['url']) && $tlazya_evential['fav_url']['url'] != '') {
			echo esc_url($tlazya_evential['fav_url']['url']);
		}
	?>">
	<script type="text/javascript">
		var theme_url = '<?php get_template_directory_uri(); ?>';
		var home_url = '<?php home_url('/'); ?>';
		var nav_url = '<?php echo esc_url(home_url('/')); ?>'
	</script>
	<?php 
		global $tlazya_evential;
		if(isset($tlazya_evential['custom_css']) && $tlazya_evential['custom_css'] != '' ) {
			echo '<style>'.$tlazya_evential['custom_css'].'</style>';
		} 
	?>    
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!-- PRELOADING  -->
	<div id="preload">
		<div class="preload">
			<div class="loader">
			</div>
		</div>
	</div> 
	<!-- NAVIGATION -->
	<nav class="navbar navbar-fixed-top navbar-custom" role="navigation">
	  <!-- We use the fluid option here to avoid overriding the fixed width of a normal container within the narrow content columns. -->
		<div class="container">
			<div data-scroll-header class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo home_url(); ?>">
					<?php 
						global $tlazya_evential; 
						if (isset($tlazya_evential['logo_url']['url']) && $tlazya_evential['logo_url']['url'] != '' ) { ?>
						<img class="site-logo" src="<?php echo esc_url($tlazya_evential['logo_url']['url']); ?>" alt="logo" />
						<?php 
						} 
						else { ?>
							<img class="site-logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="">
						<?php
						} 
					?>
				</a>
			</div>
			<div class="collapse navbar-collapse" id="nav">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav navbar-nav navbar-right uppercase','walker' => new eventialControllerExtensionNavWalker() ) ); ?>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>