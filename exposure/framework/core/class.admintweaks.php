<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Admin UI tweaks class.
 *
 * This class is entitled to manage the theme administration interface tweaks.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_AdminTweaks') ) {
	class THB_AdminTweaks {

		/**
		 * Constructor
		 * 
		 */
		public function __construct()
		{
			add_action( 'admin_init', array($this, 'registerListTableTweaks') );
			add_filter( 'media_upload_tabs', array($this, 'removeMediaLibraryTab') );
			add_action( 'login_head', array($this, 'customLoginLogo') );


			add_action( 'wp_before_admin_bar_render', array($this, 'adminBarRender') );
		}

		public function adminBarRender()
		{
			global $wp_admin_bar;

			$thb_theme = thb_theme();
			$main_page = $thb_theme->getAdmin()->getMainPage();

			if( current_user_can($main_page->getCapability()) ) {
				$wp_admin_bar->add_menu(array(
					'parent' => false,
					'id' => $main_page->getSlug(),
					'title' => $main_page->getTitle(),
					'href' => thb_system_admin_url($main_page->getSlug())
				));
			}
		}

		/**
		 * Add a custom login logo.
		 * 
		 * @return void
		 */
		public function customLoginLogo()
		{
			$login_logo = thb_get_option('login_logo');

			if( empty($login_logo) || $login_logo['id'] == '' ) {
				return;
			}

			$url = thb_image_get_size($login_logo['id'], 'full');

			$dimensions = @getimagesize($url);
			$background_size = 'auto';

			if( 0 >= $dimensions[1] ) {
				$background_size = '';
				$height = 67;
			}
			else {
				// $ratio = intval($dimensions[0]) / intval($dimensions[1]);
				// $height = 328 * (1 / $ratio);
				$height = intval($dimensions[1]);
			}

			echo '<style type="text/css">
				.login h1 a { 
					width: 328px;
					height: ' . intval($height) . 'px;
					margin: 0 auto;
					background-size: ' . $background_size . ';
					background-image: url("'. $url .'") !important;
				}
			</style>';
		}

		/**
		 * Add an Id column to list tables
		 *
		 * @param array $defaults The list table columns.
		 * @return void
		 */
		public function listTableAddIdColumn( $defaults )
		{
			$link = 'Id';
			$insertAt = 1;

			$defaults = array_slice($defaults, 0, $insertAt, true) +
			    array('id' => $link) +
			    array_slice($defaults, $insertAt, count($defaults)-$insertAt, true);

			return $defaults;
		}

		/**
		 * Populate the content of the custom created columns.
		 * 
		 * @param string $column_name The column name.
		 * @param int $res_ID The resource Id.
		 * @return void
		 */
		public function listTableColumnContent( $column_name, $res_ID )
		{
			if ($column_name == 'id') {
				echo $res_ID;
			}
		}

		/**
		 * Populate the content of the custom created columns for taxonomies
		 * list tables.
		 * 
		 * @param string $blog_ID Blog id (left empty).
		 * @param string $column_name The column name.
		 * @param int $res_ID The resource Id.
		 * @return void
		 */
		public function listTableTaxonomyColumnContent($blog_ID, $column_name, $res_ID)
		{
			$this->listTableColumnContent($column_name, $res_ID);
		}

		/**
		 * Register the list tables tweaks.
		 * 
		 * @return void
		 */
		public function registerListTableTweaks()
		{
			// Adding an Id column to post types
			add_filter('manage_pages_columns', array($this, 'listTableAddIdColumn'));  
			add_filter('manage_posts_columns', array($this, 'listTableAddIdColumn'));  
			add_filter('manage_edit-post_columns' , array($this, 'listTableAddIdColumn'));
			add_action('manage_pages_custom_column', array($this, 'listTableColumnContent'), 10, 2); 
			add_action('manage_posts_custom_column', array($this, 'listTableColumnContent'), 10, 2);

			// Adding an Id column to taxonomies entries tables
			$thb_theme = thb_theme();
			$taxonomies = $thb_theme->getRegisteredTaxonomies();

			foreach( $taxonomies as $taxonomy ) {
				add_filter('manage_edit-'.$taxonomy.'_columns', array($this, 'listTableAddIdColumn'));
				add_action('manage_'.$taxonomy.'_custom_column', array($this, 'listTableTaxonomyColumnContent'), 10, 3);
			}
		}

		/**
		 * Remove the File URL Media Library tab.
		 * 
		 * @param array $tabs The Media Library tabs.
		 * @return array
		 */
		public function removeMediaLibraryTab( $tabs )
		{
			unset($tabs['type_url']);
			return $tabs;
		}

	}
}