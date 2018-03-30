<?php
/*
Plugin Name: Ultimate Addons for Visual Composer
Plugin URI: https://brainstormforce.com/demos/ultimate/
Author: Brainstorm Force
Author URI: https://www.brainstormforce.com
Version: 3.7.0
Description: Includes Visual Composer premium addon elements like Icon, Info Box, Interactive Banner, Flip Box, Info List & Counter. Best of all - provides A Font Icon Manager allowing users to upload / delete custom icon fonts. 
Text Domain: smile
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
if(!isset($dfd_ronneby['disable_ult_addons']) || $dfd_ronneby['disable_ult_addons'] != 'disable') {
	
	if(!defined('__ULTIMATE_ROOT__')){
		define('__ULTIMATE_ROOT__', dirname(__FILE__));
	}
	if(!defined('ULTIMATE_VERSION')){
		define('ULTIMATE_VERSION', '3.7.0');
	}
	if(!class_exists('Ultimate_VC_Addons')) {
		$plugin = plugin_basename(__FILE__); 
		add_filter('plugin_action_links_'.$plugin, 'ultimate_plugins_page_link' );

		function ultimate_plugins_page_link($links) { 
			$tutorial_link = '<a href="http://bsf.io/y7ajc" target="_blank">'.__('Video Tutorials', 'dfd').'</a>'; 
			$settins_link = '<a href="'.admin_url('admin.php?page=ultimate-modules').'" target="_blank">'.__('Settings', 'dfd').'</a>'; 
			array_unshift($links, $tutorial_link); 
			//array_push($links, $tutorial_link);
			array_push($links, $settins_link);
			return $links; 
		}

		function admin_notice_for_version() {
			echo '<div class="updated"><p>The <strong>Ultimate addons for Visual Composer</strong> plugin requires <strong>Visual Composer</strong> version 3.7.2 or greater.</p></div>';	
		}
		function admin_notice_for_vc_activation() {
			echo '<div class="updated"><p>The <strong>Ultimate addons for Visual Composer</strong> plugin requires <strong>Visual Composer</strong> Plugin installed and activated.</p></div>';
		}
		// plugin class
		class Ultimate_VC_Addons {
			var $paths = array();
			var $module_dir;
			var $woo_module_dir;
			var $params_dir;
			var $assets_js;
			var $assets_css;
			var $admin_js;
			var $admin_css;
			var $vc_template_dir;
			var $vc_dest_dir;
			function __construct() {
				//add_action( 'init', array($this,'init_addons'));
				register_activation_hook( __FILE__, array($this,'uvc_plugin_activate'));

				$this->vc_template_dir = get_stylesheet_directory().'/inc/vc_custom/Ultimate_VC_Addons/vc_templates/';
				$this->vc_dest_dir = get_template_directory().'/vc_templates/';
				$this->module_dir = locate_template('/inc/vc_custom/Ultimate_VC_Addons/modules/');
				$this->woo_module_dir = locate_template('/inc/vc_custom/Ultimate_VC_Addons/woocomposer/modules/');
				$this->params_dir = locate_template('/inc/vc_custom/Ultimate_VC_Addons/params/');
				$this->assets_js = get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/js/';
				$this->assets_css = get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/css/';
				$this->admin_js = get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/js/';
				$this->admin_css = get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/css/';
				$this->paths = wp_upload_dir();
				$this->paths['fonts'] 	= 'dfd_ronneby_fonts';
				$this->paths['fonturl'] = set_url_scheme(trailingslashit($this->paths['baseurl']).$this->paths['fonts']);
				add_action('after_setup_theme',array($this,'aio_init'));
				add_action('admin_enqueue_scripts',array($this,'aio_admin_scripts'));
				add_action('wp_enqueue_scripts',array($this,'aio_front_scripts'),99);
				if(!get_option('ultimate_animation')){
					update_option('ultimate_animation','disable');
				}
				//add_action('admin_init', array($this, 'aio_move_templates'));
			}// end constructor

			function uvc_plugin_activate() {
				delete_transient( 'ultimate_license_activation' );
				set_transient( "ultimate_license_activation", true, 60*60*12);
				$memory = ini_get('memory_limit');
				$allowed_memory = preg_replace("/[^0-9]/","",$memory)*1024*1024;
				$peak_memory = memory_get_peak_usage(true);
				if($allowed_memory - $peak_memory <= 14436352){
					trigger_error( 'Unfortunately, plugin could not be activated. Not enough memory available. Please contact <a href="https://www.brainstormforce.com/support/">plugin support</a>.',E_USER_ERROR );
				}
			}

			function aio_init() {
				foreach(glob($this->params_dir."/*.php") as $param) {
					require_once($param);
				}
				// activate addons one by one from modules directory
				foreach(glob($this->module_dir."/*.php") as $module) {
					require_once($module);
				}
				/*if(defined('WOOCOMMERCE_VERSION')) {
					if(version_compare( '2.1.0', WOOCOMMERCE_VERSION, '<' )) {
						foreach(glob($this->woo_module_dir.'*.php') as $module) {
							require_once($module);
						}
					} else {
						add_action( 'admin_notices', array($this, 'woocomposer_admin_notice_for_woocommerce'));
					}
				} else {
					//add_action( 'admin_notices', array($this, 'woocomposer_admin_notice_for_woocommerce'));
				}*/
			}// end aio_init
			function woocomposer_admin_notice_for_woocommerce() {
				echo '<div class="error"><p>The <strong>WooComposer </strong> plugin requires <strong>WooCommerce</strong> plugin installed and activated with version greater than 2.1.0.</p></div>';	
			}
			function aio_admin_scripts($hook) {
				// enqueue css files on backend'
				if($hook == "post.php" || $hook == "post-new.php" || $hook == "edit.php"){
					wp_enqueue_style('aio-icon-manager',$this->admin_css.'icon-manager.css');
					wp_enqueue_style('ult-animate',$this->assets_css.'animate.css');
					/* Crum composer mod. scripts / styles*/
					wp_enqueue_style( 'crum-composer-styles', $this->admin_css . 'crum_composer_styles.css' );
					wp_enqueue_style( 'crum-composer-styles', $this->admin_css . 'chosen.min.css' );

					wp_enqueue_script('crum-composer-choosen', $this->admin_js.'chosen.jquery.min.js', array('jquery'), false, true);
					wp_enqueue_script('crum-composer-image-picker', $this->admin_js.'image-picker.jquery.min.js', array('jquery'), false, true);

					wp_enqueue_script('dfd_vc_backend_scripts', $this->admin_js.'vc_admin_js.js', array('jquery'), false, true);

					if(wp_script_is( 'vc-frontend-editor-min-js', 'enqueued' )) {
						wp_enqueue_script('vc-inline-editor',$this->assets_js.'vc-inline-editor.js',array('vc-frontend-editor-min-js'),'1.5',true);
						/*
						wp_enqueue_script('js-audio');
						wp_enqueue_style('dfd_zencdn_video_css');
						wp_enqueue_script('dfd_zencdn_video_js');
						*/
					} elseif(wp_script_is( 'vc_inline_custom_view_js', 'enqueued' )) {
						wp_enqueue_script('vc-inline-editor',$this->assets_js.'vc-inline-editor.js',array('vc_inline_custom_view_js'),'1.5',true);
						/*
						wp_enqueue_script('js-audio');
						wp_enqueue_style('dfd_zencdn_video_css');
						wp_enqueue_script('dfd_zencdn_video_js');
						*/
					}

					$fonts = get_option('dfd_ronneby_fonts');
					if(is_array($fonts)) {
						foreach($fonts as $font => $info) {
							if(strpos($info['style'], 'http://' ) !== false) {
								wp_enqueue_style('bsf-'.$font,$info['style']);
							} else {
								wp_enqueue_style('bsf-'.$font,trailingslashit($this->paths['fonturl']).$info['style']);
							}
						}
					}
				}
			}// end aio_admin_scripts
			function aio_front_scripts() {
				$dependancy = array('jquery');
				// register js
				wp_register_script('ultimate-script',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/ultimate.min.js',array('jquery'), null, true);
				wp_register_script('ultimate-appear',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/jquery.appear.min.js',array('jquery'), null, true);
				wp_register_script('ultimate-custom',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/js/custom.js',array('jquery'), null, true);
				wp_register_script('ultimate-custom',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/js/custom.js',array('jquery'), null, true);

				// register css
				wp_register_style('ultimate-animate',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/animate.min.css');
				wp_register_style('ultimate-style',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/style.min.css');
				wp_register_style('ultimate-style-min',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/ultimate.min.css',array(),null);

				global $post;

				wp_enqueue_script('ultimate-script');
				if(!empty($post) && is_object($post)) {
					$post_content = $post->post_content;

					if( stripos( $post_content, '[icon_timeline') ) {
						wp_enqueue_script('masonry');
					}
					if( stripos( $post_content, '[ult_content_box') ) {
						wp_enqueue_script('ult_content_box_js');
						wp_enqueue_style('ult_content_box_css');
					}
					if( stripos( $post_content, '[ultimate_exp_section') ) {
						wp_enqueue_script('jquery_ui');
						wp_enqueue_script('jquery_ultimate_expsection');
						wp_enqueue_style('style_ultimate_expsection');
					}
					if( stripos( $post_content, '[ult_dualbutton') ) {
						wp_enqueue_script('jquery.dualbtn');
						wp_enqueue_style('ult-dualbutton');
					}
					if( stripos( $post_content, '[ult_hotspot') ) {
						wp_enqueue_script('ult_hotspot_tooltipster_js');
						wp_enqueue_script('ult_hotspot_js');
						wp_enqueue_style( 'ult_hotspot_css' );
						wp_enqueue_style( 'ult_hotspot_tooltipster_css' );
					}
					if( stripos( $post_content, '[ultimate_img_separator') ) {
						//wp_enqueue_style('ultimate-animate');
						wp_enqueue_style('ult-easy-separator-style');
						//wp_enqueue_script('ultimate-appear');
						wp_enqueue_script('ult-easy-separator-script');
						//wp_enqueue_script('ultimate-custom');
					}
				}
				wp_enqueue_style('ultimate-style-min');
				//wp_enqueue_style('ult-slick', get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/slick/slick.css', false, null);
				wp_register_script('ultimate-appear',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/jquery.appear.min.js',array('jquery'),null,true);			
				wp_register_script('ultimate-custom',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/custom.min.js',$dependancy,null,true);
				wp_register_script('ultimate-smooth-scroll',$this->assets_js.'SmoothScroll.js',array('jquery'),null,true);

				$ultimate_smooth_scroll = get_option('ultimate_smooth_scroll');
				if($ultimate_smooth_scroll == "enable") {
					wp_enqueue_script('ultimate-smooth-scroll');
				}

				if(function_exists('vc_is_editor')){
					if(vc_is_editor()){
						wp_enqueue_style('vc-fronteditor',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/vc-fronteditor.min.css');
					}
				}
				$fonts = get_option('dfd_ronneby_fonts');
				if(is_array($fonts)) {
					foreach($fonts as $font => $info)
					{
						$style_url = $info['style'];
						if(strpos($style_url, 'http://' ) !== false) {
							wp_enqueue_style('bsf-'.$font,$info['style']);
						} else {
							wp_enqueue_style('bsf-'.$font,trailingslashit($this->paths['fonturl']).$info['style']);
						}
					}
				}
			}// end aio_front_scripts
			function aio_move_templates() {
				// Make destination directory 
				if (!is_dir($this->vc_dest_dir)) { 
					wp_mkdir_p($this->vc_dest_dir);
				}
				@chmod($this->vc_dest_dir,0777);
				foreach(glob($this->vc_template_dir.'*') as $file)
				{
					$new_file = basename($file);
					@copy($file,$this->vc_dest_dir.$new_file);
				}
			}// end aio_move_templates
		}//end class
		new Ultimate_VC_Addons;
		// load admin area
		require_once('admin/admin.php');
		//$ultimate_modules = get_option('ultimate_modules');
		//if(is_plugin_active('woocommerce/woocommerce.php')){
		//	require_once('woocomposer/woocomposer.php');
		//}
	}// end class check
	/*
	* Generate RGB colors from given HEX color
	*
	* @function: ultimate_hex2rgb()
	* @Package: Ultimate Addons for Visual Compoer
	* @Since: 2.1.0
	* @param: $hex - HEX color value
	* 		  $opecaty - Opacity in float value
	* @returns: value with rgba(r,g,b,opacity);
	*/
	if(!function_exists('ultimate_hex2rgb')){
		function ultimate_hex2rgb($hex,$opacity=1) {
		   $hex = str_replace("#", "", $hex);
		   if(strlen($hex) == 3) {
			  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
			  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
			  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
		   } else {
			  $r = hexdec(substr($hex,0,2));
			  $g = hexdec(substr($hex,2,2));
			  $b = hexdec(substr($hex,4,2));
		   }
		   $rgba = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';
		   //return implode(",", $rgb); // returns the rgb values separated by commas
		   return $rgba; // returns an array with the rgb values
		}
	}
}