<?php 
	/*
	Template Name: Splash Page - DEMO ONLY
	*/
	$directory = trailingslashit(get_template_directory_uri());
?>

<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php echo ( is_home() || is_front_page() ) ? bloginfo('name') : wp_title('| ', true, 'right'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<?php $class = ( get_option('use_preloader', 1) == 1 ) ? 'royal_loader' : ''; ?>

<body <?php body_class($class); ?>>

<div class="bg"></div>
<div id="overlay"></div>
<div id="header2">
	<img src="<?php echo $directory; ?>img/logo_splash.png" alt="" class="center">
	<p class="text-center pad15 one">
	One Page bootstrap3 WordPress Theme by <a href="http://themeforest.net/user/tommusrhodus">tommusrhodus</a>
	</p>
</div>
	
<div class="container pad45">
	<div class="row">
		<div class="col-sm-6 col-md-3">
		<a href="http://flair.wpengine.com/home/" target="_blank">
			<img src="<?php echo $directory; ?>img/1.png" alt="FLAIR">
			<p class="text-center">Pattern</p>
		</a>
	</div>
	
	<div class="col-sm-6 col-md-3">
		<a href="http://flair.wpengine.com/home-image/" target="_blank">
			<img src="<?php echo $directory; ?>img/2.png" alt="FLAIR">
			<p class="text-center">Image</p>
		</a>
	</div>
	
	<div class="col-sm-6 col-md-3">
		<a href="http://flair.wpengine.com/home-html5-video/" target="_blank">
			<img src="<?php echo $directory; ?>img/3.png" alt="FLAIR">
			<p class="text-center">HTML5 Video</p>
		</a>
	</div>
	
	<div class="col-sm-6 col-md-3">
		<a href="http://flair.wpengine.com/home-slideshow/" target="_blank">
			<img src="<?php echo $directory; ?>img/4.png" alt="FLAIR">
			<p class="text-center">Slideshow</p>
		</a>
	</div>
	
	<div class="col-sm-6 col-md-3">
		<a href="http://flair.wpengine.com/home-slider/" target="_blank">
			<img src="<?php echo $directory; ?>img/5.png" alt="FLAIR">
			<p class="text-center">Slider</p>
		</a>
		</div>
		
	<div class="col-sm-6 col-md-3">
		<a href="http://flair.wpengine.com/home-youtube/" target="_blank">
			<img src="<?php echo $directory; ?>img/6.png" alt="FLAIR">
			<p class="text-center">YouTube</p>
		</a>
	</div>

	<div class="col-sm-6 col-md-3">
		<a href="http://flair.wpengine.com/home-rain/" target="_blank">
			<img src="<?php echo $directory; ?>img/7.png" alt="FLAIR">
			<p class="text-center">Rain Effect</p>
		</a>
	</div>

	<div class="col-sm-6 col-md-3">
		<a href="http://flair.wpengine.com/home-animated/" target="_blank">
			<img src="<?php echo $directory; ?>img/8.png" alt="FLAIR">
			<p class="text-center">Animated Effect</p>
		</a>
	</div>

	<div class="col-sm-6 col-md-3 col-md-offset-3">
		<a href="http://flair.wpengine.com/home-colour/" target="_blank">
			<img src="<?php echo $directory; ?>img/9.png" alt="FLAIR">
			<p class="text-center">Colour Fade Effect</p>
		</a>
	</div>

	<div class="col-sm-6 col-md-3">
		<a href="http://flair.wpengine.com/home-shards/" target="_blank">
			 <img src="<?php echo $directory; ?>img/10.png" alt="FLAIR">
			<p class="text-center">Shards</p>
		</a>
	</div>
	</div>
</div>
<div class="pad45"></div>

<?php wp_footer(); ?>
</body>
</html>