<?php
/**
 * This file contains all the functionality for enqueueing amd printing theme 
 * specific styles and scripts.
 *
 * @author Pexeto
 */

add_action( 'wp_enqueue_scripts', 'pexeto_register_scripts' );
add_action( 'wp_enqueue_scripts', 'pexeto_enqueue_styles' );
add_action( 'wp_head', 'pexeto_print_google_analytics', 20 );
add_action( 'wp_print_footer_scripts', 'pexeto_print_scripts' );
add_action( 'wp_footer', 'pexeto_enqueue_additional_scripts' );
add_action( 'wp_head', 'pexeto_print_additional_styles');

if ( !function_exists( 'pexeto_register_scripts' ) ) {
	/**
	 * Registers all the main scripts for the theme and calls a function
	 * to enqueue them after this.
	 */
	function pexeto_register_scripts() {
		$ver = PEXETO_VERSION;


		$jsuri=get_template_directory_uri().'/js/';

		$in_footer = true;

		wp_register_script( 'pexeto-youtube-api', 'https://www.youtube.com/iframe_api', array(), $ver, false);
		wp_register_script( 'pexeto-main', $jsuri.'main.js', array( 'jquery' ), $ver, $in_footer );
		wp_register_script( 'pexeto-portfolio-gallery', $jsuri.'portfolio-gallery.js', array( 'jquery', 'pexeto-main' ), $ver, $in_footer );
		wp_register_script( 'pexeto-masonry', $jsuri.'masonry.js', array( 'jquery' ), $ver, $in_footer );
		wp_register_script( 'pexeto-nivo', $jsuri.'nivo-slider.js', array( 'jquery' ), $ver, $in_footer );
		wp_register_script( 'pexeto-contentslider', $jsuri.'content-slider.js', array( 'jquery' ), $ver, $in_footer );
		wp_register_script( 'pexeto-thumbslider', $jsuri.'thumbnail-slider.js', array( 'jquery' ), $ver, $in_footer );

		pexeto_enqueue_scripts();

	}
}


if ( !function_exists( 'pexeto_enqueue_scripts' ) ) {
	/**
	 * Enqueues all the scripts needed for the theme depending on the current
	 * page/post type and settings.
	 */
	function pexeto_enqueue_scripts() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'underscore' );
		wp_enqueue_script( 'pexeto-main' );


		if ( is_page_template( 'template-portfolio-gallery.php' )
			|| ( is_single() && get_post_type() == PEXETO_PORTFOLIO_POST_TYPE ) ) {
			//load the scripts for the portfolio gallery template
			wp_enqueue_script( 'pexeto-portfolio-gallery' );
		}

		//GET THE SLIDER DATA
		$slider_type = pexeto_get_slider_type();


		//content slider script
		if ( $slider_type == PEXETO_CONTENTSLIDER_POSTTYPE ) {
			wp_enqueue_script( 'pexeto-youtube-api' );
			wp_enqueue_script( 'pexeto-contentslider' );
		}

		//nivo slider script
		if ( $slider_type == PEXETO_NIVOSLIDER_POSTTYPE ) {
			wp_enqueue_script( 'pexeto-nivo' );
		}

		//include the comment reply script
		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}


if(!function_exists('pexeto_enqueue_additional_scripts')){

	/**
	 * Loads the additional scripts that are needed by some of the content in
	 * the current page.
	 */
	function pexeto_enqueue_additional_scripts(){
		global $pexeto_scripts;

		if ( isset( $pexeto_scripts['nivo'] )){
			//load the nivo slider script
			wp_enqueue_script('pexeto-nivo');
		}

		if ( isset( $pexeto_scripts['masonry'] ) 
			|| isset( $pexeto_scripts['blog_masonry'] )
			|| ( is_page_template( 'template-portfolio-gallery.php' ) ) 
			|| ( get_post_type() == PEXETO_PORTFOLIO_POST_TYPE && pexeto_option( 'qg_masonry_'.PEXETO_PORTFOLIO_POST_TYPE) === true ) ) {
			//load the masonry script
			wp_enqueue_script( 'pexeto-masonry' );
		}
	}
}




if ( !function_exists( 'pexeto_enqueue_styles' ) ) {
	/**
	 * Enqueues the CSS styles for the theme.
	 */
	function pexeto_enqueue_styles() {
		$ver = PEXETO_VERSION;

		if ( pexeto_option( 'enable_google_fonts' ) ) {

			//INCLUDE THE GOOGLE FONTS
			$fonts=pexeto_option( 'google_fonts' );
			for ( $i=0; $i<sizeof( $fonts ); $i++ ) {
				wp_enqueue_style( 'pexeto-font-'.$i,  $fonts[$i]['link'] );
			}
		}

		//INCLUDE THE CSS FILES
		$cssuri = get_template_directory_uri().'/css/';
		wp_enqueue_style( 'pexeto-pretty-photo', $cssuri.'prettyPhoto.css', array(), $ver );
		wp_enqueue_style( 'pexeto-stylesheet', get_stylesheet_uri(), array(), $ver );

		wp_register_style( 'pexeto-ie8', $cssuri.'style_ie8.css', array(), $ver );
	    $GLOBALS['wp_styles']->add_data( 'pexeto-ie8', 'conditional', 'lte IE 8' );
	    wp_enqueue_style( 'pexeto-ie8' );
	}
}


if(!function_exists('pexeto_print_additional_styles')){
	/**
	 * Prints the additional styles from the options panel.
	 */
	function pexeto_print_additional_styles(){
		include(TEMPLATEPATH . '/includes/css-loader.php');
	}
}



if ( !function_exists( 'pexeto_print_scripts' ) ) {
	/**
	 * Prints all the main initialization scripts.
	 */
	function pexeto_print_scripts() {
		global $pexeto_scripts;

		$logo_height=pexeto_option( 'logo_height' )||116;
		$disable_right_click=pexeto_option( 'disable_click' )==true?'true':'false';
		$sticky_header = pexeto_option('sticky_header')==true?'true':'false';

		$js = '<script type="text/javascript">';
		$js .= 'var PEXETO = PEXETO || {};';
		$js .= 'PEXETO.ajaxurl="'.admin_url( 'admin-ajax.php' ).'";';
		$js .= 'PEXETO.lightboxOptions = '.json_encode( pexeto_get_lightbox_options() ).';';
		$js .= 'PEXETO.disableRightClick='.$disable_right_click.';';
		$js .= 'PEXETO.stickyHeader='.$sticky_header.';';
		$js .= 'jQuery(document).ready(function($){
					PEXETO.init.initSite();';

		//print the additional initializations
		//masonry
		if ( isset( $pexeto_scripts['masonry'] ) && $pexeto_scripts['masonry']==true && isset( $pexeto_scripts['masonry_sel'] ) ) {
			$js .= 'new PEXETO.utils.resizableImageGallery("'.$pexeto_scripts['masonry_sel'].'", {resizable:false}).init();';
		}

		//blog masonry
		if ( isset( $pexeto_scripts['blog_masonry'] ) && $pexeto_scripts['blog_masonry']==true ) {
			$js .= 'PEXETO.init.blogMasonry('.$pexeto_scripts['blog_masonry_cols'].');';
		}

		//nivo slider
		$js .= pexeto_get_init_nivo_scripts();

		//content slider
		if ( isset( $pexeto_scripts['contentslider'] ) && isset( $pexeto_scripts['contentslider']['selector'] ) ) {
			$js .= '$("'.$pexeto_scripts['contentslider']['selector'].'").pexetoContentSlider('.json_encode( $pexeto_scripts['contentslider']['options'] ).');';
		}

		//zoom slider
		if ( isset( $pexeto_scripts['thumbslider'] ) && isset( $pexeto_scripts['thumbslider']['selector'] ) ) {
			$js .= '$("'.$pexeto_scripts['thumbslider']['selector'].'").pexetoThumbnailSlider('.json_encode( $pexeto_scripts['thumbslider']['options'] ).');';
		}

		//portfolio gallery
		if ( isset( $pexeto_scripts['portfolio-gallery'] ) && isset( $pexeto_scripts['portfolio-gallery']['selector'] ) ) {
			$js .= '$("'.$pexeto_scripts['portfolio-gallery']['selector'].'").pexetoGallery('.json_encode( $pexeto_scripts['portfolio-gallery']['options'] ).');';
		}

		//init contact form
		$js .= pexeto_get_init_contact_script();

		$js .= '});</script>';

		echo $js;
	}
}

if(!function_exists('pexeto_print_google_analytics')){
	function pexeto_print_google_analytics(){
		//print Google Analytics code
		if(pexeto_option('analytics')){
			echo(pexeto_option('analytics')); 
		}
	}
}

if ( !function_exists( 'pexeto_get_init_contact_script' ) ) {

	/**
	 * Generates the initialization JavaScript for the contact form functionality.
	 *
	 * @return string the script code
	 */
	function pexeto_get_init_contact_script() {
		$js = '';
		$contact_options=array(
			'wrongCaptchaText' => __( 'The text you have entered did not match the text on the image. Please try again.', 'pexeto' ),
			'failText' => __( 'An error occurred. Message not sent.', 'pexeto' ),
			'validationErrorText' => __( 'Please complete all the fields correctly', 'pexeto' ),
			'messageSentText' => __( 'Message sent', 'pexeto' )
		);

		if ( pexeto_option( 'captcha' ) ) {
			$contact_options['captcha']=true;
		}

		$js.='$(".pexeto-contact-form").each(function(){
			$(this).pexetoContactForm('.json_encode( $contact_options ).');
		});';

		return $js;
	}
}

if ( !function_exists( 'pexeto_print_captcha_options_script' ) ) {

	/**
	 * Prints the reCAPTCHA settings in a JavaScript code.
	 */
	function pexeto_print_captcha_options_script() {
		if ( pexeto_option( 'captcha' ) ) {
			$contact_options['captcha']=true;

			$recaptcha_options = array(
				'theme' => 'custom',
				'custom_theme_widget'=> 'recaptcha_widget',
				'tabindex' => 4
			);

			echo '<script type="text/javascript">var RecaptchaOptions = '
				.json_encode( $recaptcha_options ).';</script>';
		}
	}
}


if ( !function_exists( 'pexeto_get_init_nivo_scripts' ) ) {

	/**
	 * Generates all the initialization JavaScript code for the loaded Nivo
	 * sliders.
	 *
	 * @return string the script code
	 */
	function pexeto_get_init_nivo_scripts() {
		global $pexeto_scripts;
		$init_js='';

		if ( isset( $pexeto_scripts['nivo'] ) && sizeof( $pexeto_scripts['nivo'] )>0 ) {
			foreach ( $pexeto_scripts['nivo'] as $nivo_script ) {
				$init_js.= 'PEXETO.init.nivoSlider($("'.$nivo_script['selector'].'"), '
					.json_encode( $nivo_script['options'] ).');';
			}
		}

		return $init_js;
	}
}
