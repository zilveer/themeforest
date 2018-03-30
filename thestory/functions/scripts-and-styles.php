<?php
/**
 * This file contains all the functionality for enqueueing amd printing theme 
 * specific styles and scripts.
 *
 * @author Pexeto
 */

require_once('class-pexeto-custom-css-generator.php');

add_action( 'wp_head', 'pexeto_print_google_analytics', 20 );
add_action( 'wp_print_footer_scripts', 'pexeto_print_scripts' );




if(!function_exists('pexeto_print_options_styles')){
	function pexeto_print_options_styles(){
		$css = PexetoCustomCssGenerator::get_colors_css();
		$css.= PexetoCustomCssGenerator::get_logo_css();
		$css.= PexetoCustomCssGenerator::get_fonts_css();
		$css.= PexetoCustomCssGenerator::get_header_size_css();
		if(pexeto_option('layout')=='boxed' && !is_page_template('template-fullscreen-slider.php')){
			$css.= PexetoCustomCssGenerator::get_bg_image_css();
		}
		$css.= PexetoCustomCssGenerator::get_general_css();
		$css.= PexetoCustomCssGenerator::get_additional_css();

		wp_add_inline_style( 'pexeto-stylesheet', $css );
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

		if (PEXETO_WOOCOMMERCE_ACTIVE){
			$enable_lightbox = get_option('woocommerce_enable_lightbox')=='no'?'false':'true';
			$js .= 'PEXETO.woocommerce.init('.$enable_lightbox.');';
		}

		//blog masonry
		if ( isset( $pexeto_scripts['blog_masonry'] ) && $pexeto_scripts['blog_masonry']==true ) {
			$js .= 'PEXETO.init.blogMasonry('.$pexeto_scripts['blog_masonry_cols'].');';
		}

		//nivo slider
		$js .= pexeto_get_init_nivo_scripts();

		//content slider
		if ( isset( $pexeto_scripts['contentslider'] ) ) {
			foreach ($pexeto_scripts['contentslider'] as $cs_script) {
				$js .= '$("'.$cs_script['selector'].'").pexetoContentSlider('.json_encode( $cs_script['options'] ).');';
			}
		}

		//zoom slider
		if ( isset( $pexeto_scripts['thumbslider'] ) && isset( $pexeto_scripts['thumbslider']['selector'] ) ) {
			$js .= '$("'.$pexeto_scripts['thumbslider']['selector'].'").pexetoThumbnailSlider('.json_encode( $pexeto_scripts['thumbslider']['options'] ).');';
		}

		//portfolio gallery
		if ( isset( $pexeto_scripts['portfolio-gallery'] ) && isset( $pexeto_scripts['portfolio-gallery']['selector'] ) ) {
			$js .= '$("'.$pexeto_scripts['portfolio-gallery']['selector'].'").pexetoGallery('.json_encode( $pexeto_scripts['portfolio-gallery']['options'] ).');';
		}


		if(is_page_template('template-fullscreen-slider.php' )){
			$args = array(
				'animateElements' => pexeto_option('fullpage_animate'),
				'autoplay' => $pexeto_scripts['fullpage']['autoplay'],
				'autoplayInterval' => $pexeto_scripts['fullpage']['interval'],
			);
			if(isset($pexeto_scripts['fullpage']['horizontal'])){
				$args['horizontalAutoplay']=$pexeto_scripts['fullpage']['horizontal'];
			}

			$js.='new PEXETO.Fullpage(".section", '.json_encode($args).').init();';
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



