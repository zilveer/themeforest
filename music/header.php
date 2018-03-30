<?php
/**
 * The Header for our theme.
 */
  $settings = get_option( "ntl_theme_settings" );
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title(); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" /> 
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/musicstyles/musicplayer.css" />
<link class="schanger" rel="stylesheet"  href="<?php echo get_template_directory_uri(); ?>/styles/<?php echo $settings['ntl_theme_bg']; ?>.css" type="text/css" />
<script type="text/javascript">
	var CromaplaySettings = {
 			color 		: "<?php echo $settings['ntl_theme_color']; ?>",
        	swfPath 	: "<?php echo get_template_directory_uri(); ?>/js",
        	swfPathalt 	: "<?php echo get_template_directory_uri(); ?>/js/alt",
        	colorscheme : "<?php echo $settings['ntl_theme_bg']; ?>"
 		};
 </script>

<?php
if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
wp_enqueue_script( 'jquery' );
?>

<?php
wp_head();
?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.backstretch.min.js"></script>
<?php if ($settings['ntl_disable_audio'] != 'off') { ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/m-app.js"></script>
<?php } ?>

</head>


<body <?php body_class(); ?> >
		
	<!-- Adding the background image -->
	<?php echo cp_get_bgimg(); ?>
	
	
	<!-- Adding the menu & logo -->
	<div class="mainlogo timerhide">
		<div class="container clear">
			<div id="access" role="navigation">
			<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) );  ?>
			</div>
			<a class="logo" href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img class="logoimg" src="<?php echo $settings['ntl_theme_logo']; ?>"></a>	
		</div>	
	</div>	
	
	
	
	<!-- Getting the slideshow above the menu -->
	
	<?php if ($settings['ntl_slide_type'] == 'content') { ?>
	<!-- Netlabs functions for adding the slideshow -->
	<?php if (is_home()){ ?>
	<div class="container clear slidecontainer">
			<?php lets_get_slideshow(); ?>
			
	</div>
	<?php } } ?>