<?php
/*
Template Name: Featured plus Fullwidth
*/
$featured_slide_type= of_get_option( 'featured_slide_type');
//echo $featured_slide_type;
if ( DEMO_STATUS ) { 
	if ( isset( $_GET['demo_featured'] ) ) $_SESSION['demo_featured']=$_GET['demo_featured'];
	if ( isset($_SESSION['demo_featured'] )) $featured_slide_type = $_SESSION['demo_featured'];
}

wp_enqueue_script( 'mainpage-loader-init', MTHEME_JS . '/mainpage-loader-init.js', array('jquery'),null, false );

if ( of_get_option ('section_featured_status') ) {
	Switch ( $featured_slide_type ) {
		case "accordion" :
			wp_enqueue_script( 'kwicks', MTHEME_JS . '/kwicks/jquery.kwicks-1.5.1.pack.js?1.0', array('jquery') , '' );
			wp_enqueue_script( 'kwicks_init', MTHEME_JS . '/kwicks/kwicks-custom.js?1.0', array('kwicks') , '' );
			wp_enqueue_style( 'kwicks_style', MTHEME_ROOT . '/css/kwicks.css', false, 'screen' );
			break;
		case "showcase" :
			wp_enqueue_script( 'awshowcase-init', MTHEME_JS . '/awshowcase/aw-showcase-init.js', array('jquery'),null, false );
			wp_enqueue_script( 'awshowcase-js', MTHEME_JS . '/awshowcase/jquery.aw-showcase.min.js', array('jquery'),null, false );
			wp_enqueue_style( 'css_awshowcase', MTHEME_ROOT . '/css/awshowcase.css', false, 'screen' );
			break;
		case "nivoslides" :
			break;
		case "video" :
			break;
	}
}
get_header();
?>

		<?php
		// Get the featured style
		if ( of_get_option ('section_featured_status')) {
			Switch ( $featured_slide_type ) {
				case "accordion" :
					include ( TEMPLATEPATH . '/includes/featured/accordion.php');
					break;
				case "showcase" :
					include ( TEMPLATEPATH . '/includes/featured/awshowcase.php');
					break;
				case "nivoslides" :
					include ( TEMPLATEPATH . '/includes/featured/nivo-slider.php');
					break;
				case "video" :
					include ( TEMPLATEPATH . '/includes/featured/static-video.php');
					break;
				case "image" :
					include ( TEMPLATEPATH . '/includes/featured/static-image.php');
					break;
			}
		} else {
		echo '<div class="clearfix"></div>';
		}
		?>
<?php wp_reset_query(); ?> 

<div class="main-entry-content-wrapper">
	<div class="fullpage-contents-wrap">
	<?php
	/* Run the loop to output the page.
	 * called loop-page.php
	 */
	get_template_part( 'loop', 'page' );
	?>
	</div>
</div>
<?php get_footer(); ?>