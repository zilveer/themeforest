<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Contains various outputs wp_footer action
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.0
 * @package     artbees
 */

/**
 * Collect Shortcode dynamic styles and using javascript inject them to <head>
 */
if (!function_exists('mk_dynamic_styles')) {
    function mk_dynamic_styles() {
	global $app_dynamic_styles;
	
	$post_id = global_get_post_id();

	$saved_styles = get_post_meta($post_id, '_dynamic_styles', true);
	
	$saved_styles_build = get_post_meta($post_id, '_theme_options_build', true);
	$theme_option_build = get_option(THEME_OPTIONS_BUILD);

	$styles =  unserialize(base64_decode(get_post_meta($post_id, '_dynamic_styles', true)));

	if (empty($styles)) {
		$css = '';
		if(is_array($app_dynamic_styles) && !empty($app_dynamic_styles)) {
	        foreach ($app_dynamic_styles as $style) {
	            $css .= $style['inject'];
	        }
    	}
        $css = preg_replace('/\r|\n|\t/', '', $css);
        echo "<style type='text/css'>" . $css . "</style>";
    }

	if(empty($saved_styles) || $saved_styles_build != $theme_option_build) {
		update_post_meta($post_id, '_dynamic_styles', base64_encode(serialize(($app_dynamic_styles))));
		update_post_meta($post_id, '_theme_options_build', $theme_option_build);
	}
    }
    
    //Apply custom styles before runing other javascripts as they might be based on those styles as well. So setting priority as one!
    add_action('wp_footer', 'mk_dynamic_styles', 1);
}

/**
 * Outputs custom JS to body
 */
if (!function_exists('mk_google_analytics')) {
    function mk_google_analytics() {
        global $mk_options;
        
        if ($mk_options['analytics']) { ?>
		<script type="text/javascript">
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo stripslashes($mk_options["analytics"]); ?>', 'auto');
		ga('send', 'pageview');
		</script> 
		<?php
        }
    }
    add_action('wp_footer', 'mk_google_analytics', 110);
}

/**
 * Outputs custom JS to body
 */
if (!function_exists('mk_custom_js')) {
    function mk_custom_js() {
        global $mk_options;
        
        if ($mk_options['custom_js'])
?>
		<script type="text/javascript">
		<?php
        echo stripslashes($mk_options['custom_js']); ?>
		</script>
	<?php
    }
    add_action('wp_footer', 'mk_custom_js', 120);
}


if (!function_exists('mk_js_get')) {
    function mk_js_get() {

    	echo '<script type="text/javascript">';
        echo '	window.get = {};';
        echo '	window.get.captcha = function(enteredCaptcha) {
                  return jQuery.get(ajaxurl, { action : "mk_validate_captcha_input", captcha: enteredCaptcha });
              	};';
        echo '</script>';
    }
    add_action('wp_footer', 'mk_js_get', 121);
}