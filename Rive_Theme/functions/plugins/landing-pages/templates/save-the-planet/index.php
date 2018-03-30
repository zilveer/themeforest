<?php
/*****************************************/
// Template Title:  Save the Planet Template
/*****************************************/

/* Include Shareme Library */
include_once LANDINGPAGES_PATH.'libraries/library.shareme.php';

/* Declare Template Key */
$key  = lp_get_parent_directory( dirname( __FILE__ ) );
$path = LANDINGPAGES_URLPATH.'templates/'.$key.'/';
$url  = plugins_url();
/* Define Landing Pages's custom pre-load hook for 3rd party plugin integration */
lp_init();

/* Load $post data */
if ( have_posts() ) : while ( have_posts() ) : the_post();

	/* Pre-load meta data into variables */
	$text_1                 = lp_get_value( $post, $key, 'text-1' );
	$text_2                 = lp_get_value( $post, $key, 'text-2' );
	$text_3                 = lp_get_value( $post, $key, 'text-3' );
	$text_4                 = lp_get_value( $post, $key, 'text-4' );
	$text_5_1               = lp_get_value( $post, $key, 'text-5-1' );
	$text_5_2               = lp_get_value( $post, $key, 'text-5-2' );
	$text_5_3               = lp_get_value( $post, $key, 'text-5-3' );
	$help_us_text           = lp_get_value( $post, $key, 'help-us-text' );
	$website_url            = lp_get_value( $post, $key, 'website-url' );
	$text_color             = lp_get_value( $post, $key, 'text-color' );
	$submit_button_color    = lp_get_value( $post, $key, 'submit-button-color' );
	$submit_button_bg_color = lp_get_value( $post, $key, 'submit-button-bg-color' );
	$planet_image           = lp_get_value( $post, $key, 'planet-image' );
	$bg_image               = lp_get_value( $post, $key, 'bg-image' );
	$music_on               = lp_get_value( $post, $key, 'music-on' );
	$bg_music               = lp_get_value( $post, $key, 'bg-music' );
	$bg_color               = lp_get_value( $post, $key, 'bg-color' );
	$social_display         = lp_get_value( $post, $key, 'display-social' );

	// Convert Hex to RGB Value for submit button
	function lp_Hex_2_RGB( $hex ) {
		$hex   = ereg_replace( "#", "", $hex );
		$color = array();

		if ( strlen( $hex ) == 3 ) {
			$color['r'] = hexdec( substr( $hex, 0, 1 ) . $r );
			$color['g'] = hexdec( substr( $hex, 1, 1 ) . $g );
			$color['b'] = hexdec( substr( $hex, 2, 1 ) . $b );
		} else if ( strlen( $hex ) == 6 ) {
			$color['r'] = hexdec( substr( $hex, 0, 2 ) );
			$color['g'] = hexdec( substr( $hex, 2, 2 ) );
			$color['b'] = hexdec( substr( $hex, 4, 2 ) );
		}

		return $color;
	}
	$RBG_array = lp_Hex_2_RGB( $submit_button_color );
	$red       = $RBG_array['r'];
	$green     = $RBG_array["g"];
	$blue      = $RBG_array["b"];
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="ie6"> <![endif]-->
<!--[if IE 7]>         <html class="ie7"> <![endif]-->
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html>         <!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<title><?php wp_title(); ?></title>
		<?php // Load Regular WP Head
			lp_head(); // Load Custom Landing Page Specific Header Items
		?>
		<!-- Our CSS stylesheet file -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?php echo $path; ?>assets/css/styles.css" />
		<style type="text/css">
			<?php if ( $bg_image != '' ) { ?>
				body {
					background: url(<?php echo $bg_image; ?>) repeat top left !important;
				}
			<?php }
			if ( $planet_image != '' ) { ?>
				.sp-globe {
					background: transparent url(<?php echo $planet_image; ?>) no-repeat top left !important;
				}
			<?php }
			if ( $text_color != '' ) {
				echo 'body {
					background-color: #' . $bg_color . ';
				}';
			}

			if ( $text_color != '' ) {
				echo "
					h1.main {
						color: #" . $text_color . ";
					}
					@-webkit-keyframes blurFadeInOut{
						0%{
							opacity: 0;
							text-shadow: 0px 0px 40px #" . $text_color . ";
							-webkit-transform: scale(1.3);
						}
						20%,75%{
							opacity: 1;
							text-shadow: 0px 0px 1px #" . $text_color . ";
							-webkit-transform: scale(1);
						}
						100%{
							opacity: 0;
							text-shadow: 0px 0px 50px #" . $text_color . ";
							-webkit-transform: scale(0);
						}
					}
					@-webkit-keyframes blurFadeIn{
						0%{
							opacity: 0;
							text-shadow: 0px 0px 40px #" . $text_color . ";
							-webkit-transform: scale(1.3);
						}
						50%{
							opacity: 0.5;
							text-shadow: 0px 0px 10px #" . $text_color . ";
							-webkit-transform: scale(1.1);
						}
						100%{
							opacity: 1;
							text-shadow: 0px 0px 1px #" . $text_color . ";
							-webkit-transform: scale(1);
						}
					}
					@-moz-keyframes blurFadeInOut{
						0%{
							opacity: 0;
							text-shadow: 0px 0px 40px #" . $text_color . ";
							-moz-transform: scale(1.3);
						}
						20%,75%{
							opacity: 1;
							text-shadow: 0px 0px 1px #" . $text_color . ";
							-moz-transform: scale(1);
						}
						100%{
							opacity: 0;
							text-shadow: 0px 0px 50px #" . $text_color . ";
							-moz-transform: scale(0);
						}
					}
					@-moz-keyframes blurFadeIn{
						0%{
							opacity: 0;
							text-shadow: 0px 0px 40px #" . $text_color . ";
							-moz-transform: scale(1.3);
						}
						100%{
							opacity: 1;
							text-shadow: 0px 0px 1px #" . $text_color . ";
							-moz-transform: scale(1);
						}
					}
					@keyframes blurFadeInOut{
						0%{
							opacity: 0;
							text-shadow: 0px 0px 40px #" . $text_color . ";
							transform: scale(1.3);
						}
						20%,75%{
							opacity: 1;
							text-shadow: 0px 0px 1px #" . $text_color . ";
							transform: scale(1);
						}
						100%{
							opacity: 0;
							text-shadow: 0px 0px 50px #" . $text_color . ";
							transform: scale(0);
						}
					}
					@keyframes blurFadeIn{
						0%{
							opacity: 0;
							text-shadow: 0px 0px 40px #" . $text_color . ";
							transform: scale(1.3);
						}
						50%{
							opacity: 0.5;
							text-shadow: 0px 0px 10px #" . $text_color . ";
							transform: scale(1.1);
						}
						100%{
							opacity: 1;
							text-shadow: 0px 0px 1px #" . $text_color . ";
							transform: scale(1);
						}
					}
					.sp-container h2.frame-5 {
						text-shadow: 0px 0px 1px #" . $text_color . ";
					}
					.sp-container h2.frame-5 span {
						text-shadow: 0px 0px 1px #" . $text_color . ";
					}";
				}
				if ( $submit_button_color != "" ) {
					echo "
					.sp-circle-link { color: #" . $submit_button_color . "; }";
				}
				if ( $submit_button_bg_color != "" ) {
					echo "
					.sp-circle-link { background: #" . $submit_button_bg_color . "; }";
				}
			?>
		</style>
		<?php wp_head(); ?>
	</head>
	<body <?php lp_body_class();?>>
		<div class="container">
			<h1 class="main"><?php wp_title( '' ); ?></h1>
			<div class="sp-container">
				<div class="sp-content" id="lp_container">
					<div class="sp-globe"></div>
					<h2 class="frame-1"><?php echo $text_1; ?></h2>
					<h2 class="frame-2"><?php echo $text_2; ?></h2>
					<h2 class="frame-3"><?php echo $text_3; ?></h2>
					<h2 class="frame-4"><?php echo $text_4; ?></h2>
					<h2 class="frame-5"><span><?php echo $text_5_1; ?></span> <span><?php echo $text_5_2; ?></span> <span><?php echo $text_5_3; ?></span></h2>
					<a class="sp-circle-link" href="<?php echo $website_url; ?>"><?php echo $help_us_text; ?></a>
				</div>
			</div>
			<?php if ( $music_on === 'on' && !empty($bg_music) ) { ?>
			<audio autoplay loop>
				<source src="<?php echo $bg_music; ?>">
			</audio>
			<?php } ?>
			<?php /*lp_conversion_area();*/ /* Print out form content */ ?>
		</div>
		<div id="page-wrapper">
		  <?php if ( $social_display === '1' ) { // Show Social Media Icons ?>
				<footer>
				<?php lp_social_media(); // print out social media buttons ?>
					<style type="text/css">
						#lp-social-buttons {
							text-align: center;
							width: 100%;
							background: #fff;
						}
						.sharrre .googleplus {
							width: 90px !important;
						}
						.sharrre .pinterest {
							width: 75px !important;
						}
						.twitter {
							width: 111px;
						}
						.sharrre .button {
							width: 106px;
						}
						.linkedin {
							margin-right: -14px;
						}
					</style>
				</footer>
		   <?php } ?>
		<?php
		endwhile;
		endif;
		lp_footer();
		wp_footer();
		?>
		</div>
	</body>
</html>
