<?php
/*
* @Catalyst Header
*/
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
	<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'mthemelocal' ), max( $paged, $page ) );
	?>
</title>
<?php
wp_enqueue_style( 'Droid_Sans', 'http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold' );
wp_enqueue_style( 'Droid_Serif', 'http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic' );
$mtheme_font= of_get_option ( "heading_font" );
?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php
define('MTHEME_FONTJS', get_template_directory_uri() . '/js/font/' );
$mtheme_font= of_get_option( 'theme_font' );
$mtheme_customfont=of_get_option( 'custom_theme_font' );
switch ($mtheme_font) {
	case "pt_sans":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'PT_Sans_400_700.font.js', array( 'jquery' ), '' );
	break;
	case "raleway":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'Raleway_250.font.js', array( 'jquery' ), '' );
	break;
	case "singlet":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'Sniglet_400.font.js', array( 'jquery' ), '' );
	break;
	case "open_sans":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'Open_Sans_400-700.font.js', array( 'jquery' ), '' );
	break;
	case "pacifico":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'Pacifico_400.font.js', array( 'jquery' ), '' );
	break;
	case "indieflower":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'Indie_Flower_400.font.js', array( 'jquery' ), '' );
	break;
	case "playfair":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'Playfair_Display_400.font.js', array( 'jquery' ), '' );
	break;
	case "waitingforthesun":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'Waiting_for_the_Sunrise_300.font.js', array( 'jquery' ), '' );
	break;
	case "holtwood":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'Holtwood_One_SC_400.font.js', array( 'jquery' ), '' );
	break;
	case "cabin":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'Cabin_400_700.font.js', array( 'jquery' ), '' );
	break;
	case "artifika":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'Artifika_500.font.js', array( 'jquery' ), '' );
	break;
	case "paytone":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'Paytone_One_400.font.js', array( 'jquery' ), '' );
	break;
	case "limelight":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'Limelight_400.font.js', array( 'jquery' ), '' );
	break;
	case "quicksand":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'quicksand.js', array( 'jquery' ), '' );
	break;
	case "imperator":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'imperator_400.font.js', array( 'jquery' ), '' );
	break;
	case "titillium":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'TitilliumText14L_300_600.font.js', array( 'jquery' ), '' );
	break;
	case "vegur":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'Vegur_300-Vegur_700.font.js', array( 'jquery' ), '' );
	break;
	case "luna":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'luna_400.font.js', array( 'jquery' ), '' );
	break;
	case "greyscale":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'GreyscaleBasic.font.js', array( 'jquery' ), '' );
	break;
	case "chunkfive":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'ChunkFive_400.font.js', array( 'jquery' ), '' );
	break;
	case "sansation":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'Sansation_400-Sansation_700.font.js', array( 'jquery' ), '' );
	break;
	case "oswald":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'oswald.font.js', array( 'jquery' ), '' );
	break;
	case "segan":
	wp_enqueue_script( 'fontjs', MTHEME_FONTJS . 'Segan_300.font.js', array( 'jquery' ), '' );
	break;
	case "custom_font":
	wp_enqueue_script( 'fontjs', $mtheme_customfont, array( 'jquery' ), '' );
	break;
}
?>
<?php
wp_head();
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/dynamic_css.php"/>

	<?php
	// Activate demo panel if selected
	if ( DEMO_STATUS ) {
		include (TEMPLATEPATH . "/includes/demo_header_inits.php");
		if ( $_SESSION['demo_theme_style']=="dark") { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style_dark.css"/>
		<?php
		}
	}
	?>
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css" media="screen" />
<![endif]-->
</head>

<body <?php body_class(); ?>>
<?php
//Get the sidebar choice
global $sidebar_choice;
$sidebar_choice= get_post_meta($post->ID, MTHEME . '_sidebar_choice', true);
?>
<?php
if ( DEMO_STATUS ) {
	include ( MTHEME_INCLUDES . "demopanel/demo-panel.php" );
}
?>
<div class="container clearfix">

	<div id="header" class="clearfix">
		<div class="logo">
			<a href="<?php echo home_url(); ?>/">
				<?php
				if ( of_get_option( 'logo')<>"" ) {
					echo '<img class="logoimage" src="' . of_get_option( 'logo') .'" alt="logo" />';
				} else {
					echo '<img class="logoimage" src="'.MTHEME_PATH.'/images/logo.png" alt="logo" />';
				}
				?>
			</a>
		</div>
		
		<div class="header-choices">
			<?php
			include (MTHEME_INCLUDES . 'header-socials.php');
			?>		
			<div id="topmenu">
				<div class="homemenu">
					<?php
					if ( function_exists('wp_nav_menu') ) { 
						// If 3.0 menus exist
						include ( MTHEME_INCLUDES . 'menu/call-menu.php' );

					} else {
					?>
					<ul>
						<li>
							<a href="<?php echo home_url(); ?>/"><?php _e('Home','mthemelocal'); ?></a>
						</li>
					</ul>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<?php
		$fullwidth_head=false;
		$single_posthead= get_post_meta($post->ID, MTHEME . '_post_head_options', true);
		if (
		is_page_template('template-sidebarpage-nivo.php') || 
		is_page_template('template-fullwidth-nivo.php') || 
		is_page_template('template-sidebarpage-image.php') ||
		is_page_template('template-fullwidth-image.php') ||
		$single_posthead=="Fullwidth Image" ||
		$single_posthead == "Fullwidth Nivo Slides" ||
		$single_posthead=="Fullwidth Video" ||
		is_home() ) {
			$fullwidth_head=true; 
		}
		?>
		<?php if ( $fullwidth_head==true ) { ?>
			<div class="header-mainpage-separator"></div>
		<?php } else { ?>
			<div class="header-main-separator"></div>
		<?php } ?>
	</div>
	<?php
	if ( is_home() ) { 
	?>
	<div class="main-contents clearfix">
	<?php } else { ?>
	<div class="page-contents clearfix">
	<?php } ?>