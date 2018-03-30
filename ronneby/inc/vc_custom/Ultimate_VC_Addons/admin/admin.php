<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Ultimate_Admin_Area')){
	class Ultimate_Admin_Area{
		function __construct(){
			/* add admin menu */
			add_action( 'admin_menu', array($this,'register_brainstorm_menu'));
			add_action( 'network_admin_menu', array( $this, 'register_brainstorm_menu' ) );
			
			add_action('admin_enqueue_scripts', array($this, 'bsf_admin_scripts_updater'));
			
			add_action( 'wp_ajax_update_ultimate_options', array($this,'update_settings'));
			
			add_action( 'wp_ajax_update_css_options', array($this,'update_css_options'));
			
			add_filter( 'custom_menu_order', array($this,'bsf_submenu_order' ));
		}
		function bsf_admin_scripts_updater($hook){
			//if($hook == "post.php" || $hook == "post-new.php"){
				//wp_enqueue_style("ultimate-admin-style",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/css/style.css');
			//}
			wp_register_style("ultimate-admin-style",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/css/style.css');

			wp_register_style("ultimate-chosen-style",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/vc_extend/css/chosen.css');
			wp_register_script("ultimate-chosen-script",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/vc_extend/js/chosen.js');

			wp_register_script("ultimate-vc-backend-script",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/js/ultimate-vc-backend.min.js',array('jquery'),null,true);
			wp_register_style("ultimate-vc-backend-style",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/css/ultimate-vc-backend.min.css');

			//if($bsf_dev_mode === 'enable') {
				wp_enqueue_style('ultimate-admin-style');
			/*} else {
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script('ultimate-vc-backend-script');
				wp_enqueue_style('ultimate-vc-backend-style');
			}*/
		}/* end admin_scripts */
		function server_update_client_license() {
			delete_transient( 'ultimate_license_activation' );
			
			$purchase_code = $_POST['purchase_code'];
			$userid = $_POST['userid'];
			$plugin = $_POST['plugin'];
			$process = $_POST['process'];
			if($process == 'deactivate_license') {
				update_option('ultimate_license_activation', '');
			} else {
				$val = array(
					'response' => '',
					'status' => 'Activated',
					'code' => 200
				);
				update_option('ultimate_license_activation', $val);
			}
				
			echo 'Message from sujaypawar.com - ['.$process .']';
			die();
		}
		function bsf_submenu_order( $menu_ord ) {
			$currentUser = wp_get_current_user();
			if (in_array('administrator', $currentUser->roles)):
				global $submenu;
			
				if(isset($submenu['bsf-dashboard']) && !is_network_admin()){
					$arr = array();
					$arr[] = $submenu['bsf-dashboard'][0];
					//$arr[] = $submenu['bsf-dashboard'][1];
					if(isset($submenu['bsf-dashboard'][2])){
						$arr[] = $submenu['bsf-dashboard'][2];
					}
					if(isset($submenu['bsf-dashboard'][3])){
						$arr[] = $submenu['bsf-dashboard'][3];
					}
					if(is_multisite())
						unset($arr[0]);
					$submenu['bsf-dashboard'] = $arr;
				}
			
				return $menu_ord;
			endif;
		}
		function register_brainstorm_menu(){
			global $submenu;
			$page = add_menu_page(
					'Brainstorm Force', 
					'Brainstorm', 
					'administrator',
					'bsf-dashboard', 
					array($this,'load_modules'), 
					get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/img/icon-16.png', 79 );
			
			if(!is_network_admin()) :
				add_submenu_page(
					"bsf-dashboard",
					__("Scripts and styles","dfd"),
					__("Scripts and styles","dfd"),
					"administrator",
					"ultimate-modules",
					array($this,'load_modules')
				);
			endif;
					
			$currentUser = wp_get_current_user();
			if (in_array('administrator', $currentUser->roles) && !is_network_admin())
				$submenu['bsf-dashboard'][0][0] = __("Dashboard",'dfd');
		}
		function load_modules(){
			require_once('modules.php');
		}
		
		function load_dashboard(){
			require_once('dashboard.php');
		}
		function load_support(){
			require_once('support.php');
		}
		function update_settings(){
			/*
			if(isset($_POST['ultimate_row'])){
				$ultimate_row = $_POST['ultimate_row'];
			} else {
				$ultimate_row = 'disable';
			}
			$result1 = update_option('ultimate_row',$ultimate_row);
			*/
			
			if(isset($_POST['ultimate_animation'])){
				$ultimate_animation = $_POST['ultimate_animation'];
			} else {
				$ultimate_animation = 'disable';
			}
			$result2 = update_option('ultimate_animation',$ultimate_animation);
			
			if(isset($_POST['ultimate_smooth_scroll'])){
				$ultimate_smooth_scroll = $_POST['ultimate_smooth_scroll'];
			} else {
				$ultimate_smooth_scroll = 'disable';
			}
			$result3 = update_option('ultimate_smooth_scroll',$ultimate_smooth_scroll);
			
			if($result1 || $result2 || $result3 || $result4){
				echo 'success';
			} else {
				echo 'failed';
			}
			die();
		}
		
		function update_debug_settings(){
			if(isset($_POST['ultimate_video_fixer'])){
				$ultimate_video_fixer = $_POST['ultimate_video_fixer'];
			} else {
				$ultimate_video_fixer = 'disable';
			}
			$result1 = update_option('ultimate_video_fixer',$ultimate_video_fixer);
			
			if($result1){
				echo 'success';
			} else {
				echo 'failed';
			}
			
			die();
		}
		
		function update_css_options(){
			if(isset($_POST['ultimate_css'])){
				$ultimate_css = $_POST['ultimate_css'];
			} else {
				$ultimate_css = 'disable';
			}
			$result1 = update_option('ultimate_css',$ultimate_css);
			if(isset($_POST['ultimate_js'])){
				$ultimate_js = $_POST['ultimate_js'];
			} else {
				$ultimate_js = 'disable';
			}
			$result2 = update_option('ultimate_js',$ultimate_js);
			if($result1 || $result2){
				echo 'success';
			} else {
				echo 'failed';
			}
			die();
		}
	}
	new Ultimate_Admin_Area;
}