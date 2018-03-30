<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Dfd_VC_Addons')) {
	
	// plugin class
	class Dfd_VC_Addons {
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
			$this->vc_template_dir = get_stylesheet_directory().'/inc/vc_custom/dfd_vc_addons/vc_templates/';
			$this->vc_dest_dir = get_template_directory().'/vc_templates/';
			$this->module_dir = locate_template('inc/vc_custom/dfd_vc_addons/modules/');
			$this->woo_module_dir = locate_template('/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/modules/');
			$this->params_dir = locate_template('inc/vc_custom/dfd_vc_addons/params/');
			$this->assets_js = get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/assets/min-js/';
			$this->assets_css = get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/assets/css/';
			$this->admin_js = get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/admin/js/';
			$this->admin_css = get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/admin/css/';
			$this->paths = wp_upload_dir();
			$this->paths['fonts'] 	= 'smile_fonts';
			$this->paths['fonturl'] = set_url_scheme(trailingslashit($this->paths['baseurl']).$this->paths['fonts']);
			add_action('after_setup_theme',array($this,'dfd_vc_init'));
			add_action('admin_enqueue_scripts',array($this,'admin_assets'));
			add_action('wp_enqueue_scripts',array($this,'load_assets'));
		}
		
		function dfd_vc_init() {
			$check_modules = true;
			
			if(class_exists('Ultimate_VC_Addons')) {
				$this->remove_default_addons();
				$check_modules = false;
			}
			
			foreach(glob($this->params_dir."*.php") as $param) {
				require_once($param);
			}
			
			foreach(glob($this->module_dir."*.php") as $module) {
				if(!$check_modules || substr_count($module, 'Ultimate_') == 0) {
					require_once($module);
				}
			}
			
			if(defined('WOOCOMMERCE_VERSION')) {
				if(version_compare( '2.1.0', WOOCOMMERCE_VERSION, '<' )) {
					foreach(glob($this->woo_module_dir.'*.php') as $module) {
						require_once($module);
					}
				}
			}
		}// end aio_init
		
		function admin_assets($hook) {
			if($hook == "post.php" || $hook == "post-new.php" || $hook == "edit.php"){
				wp_enqueue_style('dfd_addons_admin_css',$this->admin_css.'admin_css.css');
				/*
				wp_enqueue_style('aio-icon-manager',$this->admin_css.'icon-manager.css');
				wp_enqueue_style('ult-animate',$this->assets_css.'animate.css');
				
				wp_enqueue_style( 'crum-composer-styles', $this->admin_css . 'crum_composer_styles.css' );
				wp_enqueue_style( 'crum-composer-styles', $this->admin_css . 'chosen.min.css' );
				 */

				wp_enqueue_script('dfd_vc_damin_scripts', $this->admin_js.'vc_admin_scripts.js', array('jquery'), false, true);
				/*
				wp_enqueue_script('crum-composer-choosen', $this->admin_js.'chosen.jquery.min.js', array('jquery'), false, true);
				wp_enqueue_script('crum-composer-image-picker', $this->admin_js.'image-picker.jquery.min.js', array('jquery'), false, true);
				
				wp_enqueue_script('dfd_vc_backend_scripts', $this->admin_js.'vc_admin_js.js', array('jquery'), false, true);
				*/

				//wp_enqueue_script('vc-inline-editor',$this->assets_js.'vc-inline-editor.js',array('vc_inline_custom_view_js'),'1.5',true);

				if(wp_script_is( 'vc-frontend-editor-min-js', 'enqueued' )) {
					wp_enqueue_script('vc-inline-editor',$this->assets_js.'vc-inline-editor.min.js',array('vc-frontend-editor-min-js'),'1.5',true);
					/*
					wp_enqueue_script('js-audio');
					wp_enqueue_style('dfd_zencdn_video_css');
					wp_enqueue_script('dfd_zencdn_video_js');
					*/
				} elseif(wp_script_is( 'vc_inline_custom_view_js', 'enqueued' )) {
					wp_enqueue_script('vc-inline-editor',$this->assets_js.'vc-inline-editor.min.js',array('vc_inline_custom_view_js'),'1.5',true);
					/*
					wp_enqueue_script('js-audio');
					wp_enqueue_style('dfd_zencdn_video_css');
					wp_enqueue_script('dfd_zencdn_video_js');
					*/
				}
				
				$fonts = get_option('smile_fonts');
				if($fonts && is_array($fonts)) {
					foreach($fonts as $font => $info) {
						if(strpos($info['style'], 'http://' ) !== false) {
							wp_enqueue_style('dfd-'.$font,$info['style']);
						} else {
							wp_enqueue_style('dfd-'.$font,trailingslashit($this->paths['fonturl']).$info['style']);
						}
					}
				}
			}
		}
		
		function load_assets() {
			$fonts = get_option('smile_fonts');
			if($fonts && is_array($fonts)) {
				foreach($fonts as $font => $info)
				{
					$style_url = $info['style'];
					if(strpos($style_url, 'http://' ) !== false) {
						wp_enqueue_style('dfd-'.$font,$info['style']);
					} else {
						wp_enqueue_style('dfd-'.$font,trailingslashit($this->paths['fonturl']).$info['style']);
					}
				}
			}
		}
		
		function remove_default_addons() {
			$addons = array(
				array(
					'class' => 'AIO_Icons_Box',
					'action' => 'icon_box_init',
					'shortcode' => 'bsf-info-box',
				),
				array(
					'class' => 'Ultimate_Headings',
					'action' => 'ultimate_headings_init',
					'shortcode' => 'ultimate_heading',
				),
				array(
					'class' => 'Ultimate_Icons',
					'action' => 'ultimate_icon_init',
					'shortcode' => 'ultimate_icons',
				),
				array(
					'class' => 'Ultimate_Icons',
					'action' => 'ultimate_icon_init',
					'shortcode' => 'single_icon_shortcode',
				),
				array(
					'class' => 'AIO_Just_Icon',
					'action' => 'just_icon_init',
					'shortcode' => 'just_icon',
				),
				array(
					'class' => 'Ultimate_Carousel',
					'action' => 'init_carousel_addon',
					'shortcode' => 'ultimate_carousel',
				),
				array(
					'class' => 'Ultimate_Headings',
					'action' => 'ultimate_headings_init',
					'shortcode' => 'ultimate_heading',
				),
				array(
					'class' => 'Ultimate_Info_Banner',
					'action' => 'banner_init',
					'shortcode' => 'ultimate_info_banner',
				),
				array(
					'class' => 'AIO_Info_list',
					'action' => 'add_info_list',
					'shortcode' => 'info_list',
				),
				array(
					'class' => 'AIO_Info_list',
					'action' => 'add_info_list',
					'shortcode' => 'info_list_item',
				),
				array(
					'class' => 'Ultimate_List_Icon',
					'action' => 'list_icon_init',
					'shortcode' => 'ultimate_icon_list',
				),
				array(
					'class' => 'Ultimate_List_Icon',
					'action' => 'list_icon_init',
					'shortcode' => 'ultimate_icon_list_item',
				),
				array(
					'class' => 'Ultimate_Modals',
					'action' => 'ultimate_modal_init',
					'shortcode' => 'ultimate_modal',
				),
			);
			foreach($addons as $addon) {
				if(class_exists($addon['class'])) {
					if(isset($GLOBALS['shortcode_tags'][$addon['shortcode']][0])) {
						remove_action('init', array( $GLOBALS['shortcode_tags'][$addon['shortcode']][0], $addon['action'] ) );
						remove_shortcode($addon['shortcode']);
					}
				}
			}
		}
	}//end class
	new Dfd_VC_Addons;
	
	if(class_exists('WooCommerce')){
		require_once('dfd_woo_shortcodes/dfd_woocommerce.php');
	}
}