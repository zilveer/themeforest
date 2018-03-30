<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if(!class_exists('Walker_Nav_Menu_Edit')){
	require_once( ABSPATH . 'wp-admin/includes/nav-menu.php' );
}

require_once YIT_CORE_YIT_WALKER_PATH . '/Walker_Nav_Menu_Edit.php';
require_once YIT_CORE_YIT_WALKER_PATH . '/Walker_Nav_Menu.php';

/**
 * Extends functionality of WP native Nav Menu
 *
 * @class YIT_Nav_Menu
 * @package	Yithemes
 * @since 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Navmenu extends YIT_Object {

    /**
     * short description
     *
     * @var type
     */
    public $fields;


    /**
	 * Constructor
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
	 */
	public function __construct() {
        //custom nav menu fields
		$fields = array(

               'yiticon' => array(
                   'label' => 'Icon',
                   'type' => 'select-icon',
                   'width' => 'wide'
               ),

               'yitimage' => array(
                'label' => 'Image',
                   'type' => 'upload',
                   'width' => 'wide'
               ),
 /*
              /* 'yitpaddingbottom' => array(
                   'label' => 'Padding Bottom (for bigmenu)',
                   'type' => 'text',
                   'width' => 'thin',
                   'description' => ''
               ),

               'yitpaddingright' => array(
                   'label' => 'Padding Right (for bigmenu)',
                   'type' => 'text',
                   'width' => 'thin',
                   'description' => ''
               ),

               'yitcontent' => array(
                   'label' => 'Content',
                   'type' => 'textarea',
                   'width' => 'wide',
                   'description' => 'The content should contain also HTML code'
               ),*/
		);

		$this->fields = apply_filters( 'yit_add_nav_menu_fields', $fields );

        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

        add_action( 'wp_edit_nav_menu_walker', array( $this, 'walker_edit_menu' ) );

		add_filter( 'wp_setup_nav_menu_item', array( $this, 'setup_nav_menu_itemu' ) );

		add_action( 'check_admin_referer', array( $this, 'check_nav_menu_updates' ), 11, 1 );
    }

	/*
	 * Change the walker edit menu class
	 *
	 * @return void
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
	 */
	public function walker_edit_menu() {
		return 'YIT_Walker_Nav_Menu_Edit';
	}
	
    /**
	 * Filter for wp_setup_nav_menu_item
	 *
     * @param $menu_item
     * @return mixed
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
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
     * Enqueue scripts and stylesheets
     *
     *
     * @since  Version 2.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.com>
     * @return void
     */
    public function enqueue(){
        wp_enqueue_media();
        wp_enqueue_script( 'yit-panel-navmenu', YIT_CORE_ASSETS_URL . '/js/admin/panel.navmenu.min.js', array( 'jquery' ) );
        wp_enqueue_style( 'yit-font-awesome', YIT_CORE_ASSETS_URL . '/css/font-awesome.min.css', false, '', 'all' );
    }

    /**
     * Update the menu with new fields
     *
     * @param $action type
     * @return void|null
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function check_nav_menu_updates( $action ) {
	    if ( ( 'update-nav_menu' != $action ) /*or ! isset( $this->request->post('menu-locations') )*/ ) {
	        return;
	    }

        if( !empty($this->fields) ) {
            foreach( $this->fields as $field=>$data ) {
                $values = $this->request->post('menu-item-' . $field);
                foreach( (array)$values as $post_id => $value ) {
                    update_post_meta( $post_id, '_menu_item_' . $field, $value );
                }
            }
        }
	}
}
