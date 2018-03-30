<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (!class_exists('DFD_Mega_menu')) {
	class DFD_Mega_menu {
		var $_options;

		public function __construct() {
			$this->_options = self::options();
			$this->_add_filters();
		}
		
		public static function options() {
			return array(
				'_dfd_mega_menu_icon'		=> array(
						'type' => 'text',
						'label' => __( 'Icon', 'dfd' ),
						'default' => '',
						'size' => 'wide',
					),
				'_dfd_mega_menu_subtitle'	=> array(
						'type' => 'text',
						'label' => __('Subtitle', 'dfd'),
						'default' => '',
						'size' => 'wide',
						'depth' => '1',
						'class' => 'dfd-hide-only-depth-0',
					),
				'_dfd_mega_menu_image'	=> array(
						'type' => 'upload',
						'label' => __('Image', 'dfd'),
						'default' => '',
						'size' => 'wide',
						'depth' => '0',
						'class' => 'dfd-show-only-depth-0',
					),
				
				'_dfd_mega_menu_bg_position'	=> array(
						'type' => 'select',
						'label' => __( 'Background position', 'dfd' ),
						'default' => 0,
						'options' => array(
								'left top' => __('Left top', 'dfd'),
								'left center' => __('Left center', 'dfd'),
								'left bottom' => __('Left bottom', 'dfd'),
								'right top' => __('Right top', 'dfd'),
								'right center' => __('Right center', 'dfd'),
								'right bottom' => __('Right bottom', 'dfd'),
								'center top' => __('Center top', 'dfd'),
								'center center' => __('Center center', 'dfd'),
								'center bottom' => __('Center bottom', 'dfd')
							),
						'size' => 'thin',
						'depth' => '0',
						'class' => 'dfd-show-only-depth-0',
					),
				'_dfd_mega_menu_bg_repeat'	=> array(
						'type' => 'select',
						'label' => __( 'Background repeat', 'dfd' ),
						'default' => 'no-repeat',
						'options' => array(
								'no-repeat' =>__( 'No-repeat', 'dfd' ),
								'repeat' =>__( 'Repeat', 'dfd' ),
								'repeat-x' =>__( 'Repeat-x', 'dfd' ),
								'repeat-y' =>__( 'Repeat-y', 'dfd' ),
							),
						'size' => 'thin',
						'depth' => '0',
						'class' => 'dfd-show-only-depth-0',
					),
				'_dfd_mega_menu_enabled'	=> array(
						'type' => 'select',
						'label' => __( 'Enable mega menu', 'dfd' ),
						'default' => 0,
						'options' => array(1=>__( 'Yes', 'dfd' ), 0=>__( 'No', 'dfd' )),
						'size' => 'thin',
						'depth' => '0',
						'class' => 'dfd-show-only-depth-0 dfd-mega-menu',
					),
				'_dfd_full_width_menu_enabled'	=> array(
						'type' => 'select',
						'label' => __( 'Enable full-width menu', 'dfd' ),
						'default' => 0,
						'options' => array(1=>__( 'Yes', 'dfd' ), 0=>__( 'No', 'dfd' )),
						'size' => 'thin',
						'depth' => '0',
						'class' => 'dfd-show-only-depth-0',
					),
				'_dfd_mega_menu_limit_columns'	=> array(
						'type' => 'select',
						'label' => __( 'Limit Max columns number', 'dfd' ),
						'default' => 0,
						'options' => array(
								''	=>	__( 'None', 'dfd' ),
								1	=>	__( 'One', 'dfd' ),
								2	=>	__( 'Two', 'dfd' ),
								3	=>	__( 'Three', 'dfd' ),
								4	=>	__( 'Four', 'dfd' ),
								5	=>	__( 'Five', 'dfd' ),
								6	=>	__( 'Six', 'dfd' ),
							),
						'size' => 'thin',
						'depth' => '0',
						'class' => 'dfd-show-only-depth-0 dfd-columns-limit',
					),
			);
		}

		private function _add_filters() {
			# Add custom options to menu
			add_filter('wp_setup_nav_menu_item', array($this, 'add_custom_options'));

			# Update custom menu options
			add_action('wp_update_nav_menu_item', array($this, 'update_custom_options'), 10, 3);

			# Set edit menu walker
			add_filter('wp_edit_nav_menu_walker', array($this, 'apply_edit_walker_class'), 10, 2);
			
			# Addition style
			//add_action('admin_enqueue_scripts', array( $this, 'add_menu_css' ));
			
			# Addition js
			//add_action('admin_head-nav-menus.php', array( $this, 'add_menu_js' ));

			# Mega menu javascript
//			add_action('admin_print_footer_scripts', array( $this, 'add_mega_menu_javascript' ), 80);
			add_action('admin_enqueue_scripts', array( $this, 'dfd_mega_menu_admin_scripts' ), 80);
		}
		
		
 
		function dfd_mega_menu_admin_scripts() {
			wp_enqueue_media();
			//$this->add_menu_css();
			wp_register_script('dfd-menu-admin-js', get_template_directory_uri().'/inc/menu/js/image-upload.js');
			wp_enqueue_script('dfd-menu-admin-js');
		}
		

		/**
		 * Register custom options and load options values
		 * 
		 * @param obj $item Menu Item
		 * @return obj Menu Item
		 */
		public function add_custom_options($item) {

			foreach($this->_options as $option => $params) {
				$item->$option = get_post_meta($item->ID, $option, true);
				if ($item->$option===false) {
					$item->$option = $params['default'];
				}
			}

			return $item;
		}

		public function update_custom_options($menu_id, $menu_item_id, $args) {
			foreach($this->_options as $option => $params) {
				$key = 'menu-item-'. $option;
				
				//$option_value = $params['default']; // ???
				$option_value = '';
				
				if (isset($_REQUEST[$key], $_REQUEST[$key][$menu_item_id])) {
					$option_value = $_REQUEST[$key][$menu_item_id];
				}
				
				update_post_meta($menu_item_id, $option, $option_value );
			}
		}

		public function apply_edit_walker_class( $walker, $menu_id ) {
			return DFD_EDIT_MENU_WALKER_CLASS;
		}
		
		public function add_menu_css() {
			$css = "
				.menu-item .dfd-show-only-depth-0 { display: none; }
				.menu-item.menu-item-depth-0 .dfd-show-only-depth-0 { display: block; }
				.menu-item .dfd-show-only-depth-1 { display: none; }
				.menu-item.menu-item-depth-1 .dfd-show-only-depth-1 { display: block; }
				.menu-item .dfd-hide-only-depth-0 { display: block; }
				.menu-item.menu-item-depth-0 .dfd-hide-only-depth-0 { display: none; }
			";
			wp_add_inline_style('wp-admin', $css);
		}
		
		public function add_menu_js() {
			$js =	'<script type="text/javascript">
						(function($) {
							"use strict";
							$(document).ready(function() {

								var menu_icon = $("input.edit-menu-item-_dfd_mega_menu_icon");

								if (0 == menu_icon.siblings("a").length && false == menu_icon.hasClass("iconname")) {
									menu_icon.addClass("iconname").after("<a href=\"#\" class=\"button crum-icon-add\">'.esc_html__('Add icon', 'dfd').'</a>");
								}

								$(".menu-item").each(function() {
									var	mega_menu = $(".dfd-mega-menu", $(this)).find("select"),
										columns_limit = $(".dfd-columns-limit");
									if(mega_menu.length > 0) {
										var showHideOption = function() {
											if(mega_menu.val() != "0")
												columns_limit.show();
											else
												columns_limit.hide();
										};

										showHideOption();

										mega_menu.on("change", showHideOption);
									}
								});
							});
						})(jQuery);
					</script>';
			
			echo $js;
		}
	}
}
