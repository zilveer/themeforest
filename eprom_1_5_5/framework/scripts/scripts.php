<?php

/* Theme Scripts
 ------------------------------------------------------------------------*/
function r_theme_scripts() {
	
	global $r_option;
	
	if (!is_admin() && !is_login_page() && isset($r_option['theme_name'])) {
		
		/* ---- Styles ---- */

		/* Replace default woocommerce style */
		if ( class_exists( 'woocommerce' ) ) {
			wp_dequeue_style( 'woocommerce_frontend_styles' );
			wp_enqueue_style( 'woocommerce_responsive_frontend_styles',  THEME_URI . '/styles/woocommerce.css', false, THEME_VERSION, 'screen' );
		}

		/* Theme Styles */
		wp_enqueue_style('skin', SKIN_CSS_URI, false, THEME_VERSION, 'screen');
		wp_enqueue_style('style', get_bloginfo('stylesheet_url'), false, THEME_VERSION, 'screen');
      	

      	/* Icomoon */
      	wp_enqueue_style('icomoon', THEME_URI . '/styles/icomoon/icomoon.css', false, THEME_VERSION, 'screen');

		/* Media queries */
		if (isset($r_option['responsive']) && $r_option['responsive'] == 'on')
		wp_enqueue_style('media-queries', THEME_URI . '/styles/media-queries.css', false, THEME_VERSION, 'screen');
		else
		wp_enqueue_style('fixed-content', THEME_URI . '/styles/fixed-content.css', false, THEME_VERSION, 'screen');

      /* ---- Javascripts ---- */

		/* HTML5 for IE8 */
		wp_enqueue_script('html5', THEME_SCRIPTS_URI . '/html5.min.js', array('jquery'), '1.0.0');
		wp_enqueue_script('selectivizr-and-extra-selectors', THEME_SCRIPTS_URI . '/selectivizr-and-extra-selectors.min.js', array('jquery'), '1.0.2');

		/* Modernizr */
		if ($r_option['js_modernizr'] == 'on')
			wp_enqueue_script('js-modernizr', THEME_SCRIPTS_URI . '/modernizr.custom.js', false, false, true);
		
		/* jQuery Easing */
		if ($r_option['js_jquery_easing'] == 'on')
			wp_enqueue_script('jquery-easing', THEME_SCRIPTS_URI . '/jquery.easing-1.3.min.js', false, false, true);
		
		/* Soundmanager */
		if ($r_option['js_soundmanager'] == 'on') {
			wp_enqueue_script('js-mplayer', THEME_SCRIPTS_URI . '/jquery.mplayer.min.js', false, false, true);
		}
		$volume = '80';
		if (isset($r_option['volume'])) $volume = $r_option['volume'];
		
		/* Nivo Slider */
		if ($r_option['js_nivo_slider'] == 'on')
			wp_enqueue_script('js-nivo-slider', THEME_SCRIPTS_URI . '/jquery.nivo.slider.pack.js', false, false, true );
		
		/* Thumb slider */
		wp_enqueue_script('js-thumbslider', THEME_SCRIPTS_URI . '/jquery.thumbslider.min.js', false, false, true );

		/* Toptip */
		wp_enqueue_script('js-toptip', THEME_SCRIPTS_URI . '/jquery.toptip.min.js', false, false, true );

		/* Respond */
		if ($r_option['js_respond'] == 'on' && isset($r_option['responsive']) && $r_option['responsive'] == 'on')
			wp_enqueue_script('js-respond', THEME_SCRIPTS_URI . '/respond.min.js', false, false, true );

		/* Touchswipe */
		if ($r_option['js_touchswipe'] == 'on')
			wp_enqueue_script('js-touchswipe', THEME_SCRIPTS_URI . '/jquery.touchSwipe-1.2.5.min.js', false, false, true );

		/* Fitvideos */
		if ($r_option['js_fitvids'] == 'on')
			wp_enqueue_script('js-fitvids', THEME_SCRIPTS_URI . '/jquery.fitvids.js', false, false, true );

		/* Countdown */
		if ($r_option['js_countdown'] == 'on')
			wp_enqueue_script('js-countdown', THEME_SCRIPTS_URI . '/jquery.countdown.js', false, false, true );

		/* Isotope */
		if ($r_option['js_isotope'] == 'on')
			wp_enqueue_script('js-isotope', THEME_SCRIPTS_URI . '/jquery.isotope.min.js', false, false, true );

		/* Sharrre */
		if ($r_option['js_sharrre'] == 'on')
			wp_enqueue_script('js-sharrre', THEME_SCRIPTS_URI . '/jquery.sharrre.min.js', false, false, true );

		/* Google maps */
		if ($r_option['js_gmaps'] == 'on') {
			if ( isset($r_option['google_maps_key' ]) && $r_option['google_maps_key' ] !== '' ) {
					$map_key = '?key=' . $r_option['google_maps_key' ];
				} else {
					$map_key = '?v=3';
				}
		  		wp_enqueue_script('js-gmaps-api','https://maps.googleapis.com/maps/api/js' . $map_key, array('jquery'), '1.0.0' );
		  		wp_enqueue_script('js-gmap', THEME_SCRIPTS_URI . '/jquery.gmap.min.js', false, false, true );
		}

		/* Lazy load */
		if ($r_option['js_lazyload'] == 'on') {
			wp_enqueue_script('js-lazyload', THEME_SCRIPTS_URI . '/jquery.lazyload.min.js', false, false, true );
		}

		/* Fancybox */
		if ($r_option['js_fancybox'] == 'on') {
			wp_enqueue_style('fancybox_style', THEME_SCRIPTS_URI . '/fancybox/css/fancybox.min.css', false, '1.3.4', 'screen');
			wp_enqueue_script('fancybox', THEME_SCRIPTS_URI . '/fancybox/jquery.fancybox-1.3.4.pack.js', false, false, true);
		}

		/* ---- Fonts ---- */

		/* Cufon Fonts */
		if ($r_option['use_cufon_fonts'] == 'on') {
			wp_enqueue_script('cufon', THEME_SCRIPTS_URI . '/cufon-yui.js', array('jquery'));
			
			$cufon_fonts = explode('|', $r_option['cufon_fonts']);
			if (is_array($cufon_fonts)) {
				foreach($cufon_fonts as $i => $font) {
                    wp_enqueue_script('cufon-font-' . $i, THEME_URI . '/styles/cufon_fonts/' . $font, array('jquery'));
				}
			}
			
		}

		/* ---- Custom Scripts ---- */

		/* Custom scripts */
		wp_enqueue_script('custom', THEME_SCRIPTS_URI . '/custom.js', false, false, true);
		$js_variables = array(
			'debug'         => THEME_DEBUG,
			'swf_path'      => THEME_SCRIPTS_URI . '/soundmanager2/swf',
			'sm_path'       => THEME_SCRIPTS_URI . '/soundmanager2',
			'volume'        => $volume,
			'top_button'    => $r_option['top_button'],
			'theme_uri'     => home_url(),
			'navigate_text' => __('Navigate...', SHORT_NAME),
			'skin_img_path' => SKIN_IMG_URI,
			'sticky_header' => $r_option['sticky_header']
		);
		wp_localize_script('custom', 'theme_vars', $js_variables);

		/* Contact form */
		wp_localize_script('custom', 'ajax_action', array('ajaxurl' => admin_url('admin-ajax.php'), 'ajax_nonce' => wp_create_nonce('ajax-nonce')));

		/* ---- Customize ---- */

		/* Custom Style */
		if (isset($r_option['use_custom_css']) && $r_option['use_custom_css'] == 'on')
            wp_enqueue_style('custom-style', THEME_URI . '/includes/custom_css.php', false, '1.0.0', 'screen');

		/* ---- Child Theme ---- */
		
		/* Child CSS */
		if (isset($r_option['custom_css']) && $r_option['custom_css'] != '')
            wp_enqueue_style('child-style', THEME_URI . '/includes/child_css.php', false, THEME_VERSION, 'screen');
			
		/* Child JS */
		if (isset($r_option['custom_js']) && $r_option['custom_js'] != '')
            wp_enqueue_script('child-js', THEME_URI . '/includes/child_js.php', false, false, true);
		
	}
}
add_action('wp_print_styles', 'r_theme_scripts');

/* Cufon Fonts */
function cufon_code() {
	global $r_option;
	if (isset($r_option['use_cufon_fonts']) && $r_option['use_cufon_fonts'] == 'on') {
		echo "<script type='text/javascript'>\n /* <![CDATA[ */\n";
		echo "jQuery.noConflict();\n";
		echo "jQuery(document).ready(function () {\n";
		echo $r_option['cufon_code'];
		echo "\n})\n";
		echo "/* ]]> */\n";
		echo "</script>\n";
	}
}

add_action('wp_head', 'cufon_code');

/* Google Fonts */
function google_fonts() {
	global $r_option;
	if (isset($r_option['use_google_fonts']) && $r_option['use_google_fonts'] == 'on') {
	    if (isset($r_option['google_fonts'])) {
		    foreach ($r_option['google_fonts'] as $font) {
				echo $font['font_link']. "\n";
			}
			if (isset($r_option['google_code'])) {
			   echo '<style type="text/css" media="screen">' . "\n";
			   echo $r_option['google_code'];
			   echo '</style>' . "\n";
			}
		}
	}
}

add_action('wp_head', 'google_fonts');
?>