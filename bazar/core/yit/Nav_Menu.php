<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */


if(!class_exists('Walker_Nav_Menu_Edit')){
	require_once( ABSPATH . 'wp-admin/includes/nav-menu.php' );
}

require_once YIT_CORE_PATH . '/lib/yit/Walker/Walker_Nav_Menu_Edit.php';
require_once YIT_CORE_PATH . '/lib/yit/Walker/Walker_Nav_Menu.php';
 
/**
 * Extends functionality of WP native Nav Menu
 * 
 * @since 1.0.0
 */
class YIT_Nav_Menu  {

	public $fields;



	/**
	 * Constructor
	 * 
	 */
	public function __construct() {}
	
	/**
	 * Init
	 * 
	 */       
	public function init() {
		
		//custom nav menu fields
		$fields = array(
			'yitimage' => array(
				'label' => 'Image',
				'type' => 'upload',
				'width' => 'wide'
			),
			'yitcontent' => array(
				'label' => 'Content',
				'type' => 'textarea',
				'width' => 'wide',
				'description' => 'The content should contain also HTML code'
			),
		);
		
		$this->fields = apply_filters( 'yit_add_nav_menu_fields', $fields );
		
	
        add_action( 'wp_edit_nav_menu_walker', array( &$this, 'walker_edit_menu' ) );
	   
		add_filter( 'wp_setup_nav_menu_item', array( &$this, 'setup_nav_menu_itemu' ) );

		add_action( 'check_admin_referer', array( &$this, 'check_nav_menu_updates' ), 11, 1 );

	
	}

	/*
	 * Change the walker edit menu class
	 * 
	 */
	public function walker_edit_menu( $classname ) {
		return 'YIT_Walker_Nav_Menu_Edit';
	}
	
	/**
	 * Filter for wp_setup_nav_menu_item
	 * 
	 */
	public function setup_nav_menu_itemu( $menu_item ) {
		if( !empty($this->fields) ) {
			foreach( $this->fields as $field=>$data ) {
				$menu_item->{$field} = get_post_meta( $menu_item->ID, '_menu_item_' . $field, true ) ? get_post_meta( $menu_item->ID, '_menu_item_' . $field, true ) : '';
			}
		}

		return $menu_item; 
	}
	
	/**
	 * Update the menu with new fields
	 * 
	 */
	public function check_nav_menu_updates( $action ) {
	    if ( ( 'update-nav_menu' != $action ) or ! isset( $_POST['menu-locations'] ) )
	    {
	        return;
	    }
		
		if( !empty($this->fields) ) {
			foreach( $this->fields as $field=>$data ) {
				if( isset( $_POST['menu-item-' . $field] ) ) {
					foreach( $_POST['menu-item-' . $field] as $post_id => $value ) {
						update_post_meta( $post_id, '_menu_item_' . $field, $value );
					}
				}
			}
		}
	}
}
