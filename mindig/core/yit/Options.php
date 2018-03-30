<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if (!defined('YIT')) exit('Direct access forbidden.');


/**
 * Instance of the model
 *
 * @class YIT_Options
 * @package	Yithemes
 * @since 2.0.0
 * @author Your Inspiration Themes
 */
class YIT_Options extends YIT_Object {

    /**
     * Base name for the option with all options value from database
     *
     * @var string
     */
    public $options_name = 'yit-panel-options';

    /**
     * Theme Options stored within the database
     *
     * @var array
     */
    public $db_options = array();

    /**
     * Theme settings loaded from files
     *
     * @var array
     */
    protected $_panel = array();

    /**
     * Default settings for theme options
     *
     * @var array
     */
    public $default_options = array();      
    
    /**
     * Flag to know if some option is changed during the loading
     * 
     * @var bool
     */
    protected $_is_option_updated = false;

    /**
     * All default values for each option
     *
     * @var array
     */
    protected $_default_options = array();

    /**
     * Constructor
     *
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function __construct() {
        //add the theme name as suffix for theme options
        $this->options_name .= '_' . YIT_THEME_NAME;

        //init @var $db_option
        $this->db_options = $this->_set_database_options();
                                      
		// udpate the options in the DB, if they are changed during the loading
        // the scope is call the update option once and only when it really necesary, instead more time 
		add_action( 'wp_loaded',    array( $this, 'update_db_options' ) );
		add_action( 'wp_footer',    array( $this, 'update_db_options' ), 99 );   // in case, do again also in wp_footer, after templates loading 
		add_action( 'admin_footer', array( $this, 'update_db_options' ), 99 );   // or after admin page is loaded
        
        // save options of panel
        if ( ! $this->request->is_ajax ) {
            add_action( 'admin_init', array( $this, 'save_options' ) );
        }

        // AJAX
        add_action( 'wp_ajax_yit-panel-save', array( $this, 'save_options' ) );
        add_action( 'wp_ajax_yit-refresh-color', array( $this, 'refresh_colors' ) );
    }

    /**
     * Retrieve Theme Options from database or theme settings
     *
     * @return array
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    protected function _set_database_options() {
        $options = get_option( $this->options_name, array() );

        if( empty( $options ) ) {
            $options = $this->get_default_options();
            $this->_is_option_updated = true;           // update the option in the database
        }

        return $options;
    }

    /**
     * Retrieve Theme Settings
     *
     * @return array
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function get_default_options() {
        if ( ! empty( $this->_default_options ) ) return $this->_default_options;

		// get default options from database in first
		$this->_default_options = get_option( $this->options_name . '_defaults' );

		if ( $this->_default_options === false || empty( $this->_default_options ) ) {
			$this->_panel = $this->getModel('panel')->get_theme_options_from_files();

			foreach ( $this->_panel as $submenu => $tabs ) {
				foreach ( $tabs as $tab => $subtabs ) {
					foreach ( $subtabs as $options ) {
						foreach ( $options as $option ) {
							if ( ! isset( $option['id'] ) ) continue;
							$this->_default_options[ $option['id'] ] = isset( $option['std'] ) ? $option['std'] : '';
						}
					}
				}
			}
		}
    
        return $this->_default_options;
    }        

	/**
	 * Update the all array of all options in the database, if they are updated.
	 *          
	 * @return void     
     * @since 2.0.0
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
	 */      
    public function update_db_options() {        
        if ( ! $this->_is_option_updated ) { return; }

        $this->getModel('css')->save_css();
            
        update_option( $this->options_name, $this->db_options );
        $this->_is_option_updated = false;
    }

    /**
     * Save the options in the database
     *
     * Get the options send by the theme options form and then save the options value
     * in the database.
     *
     *
     * @param mixed $save_data
     *
     * @return mixed
     * @since  2.0.0
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
     */
    public function save_options( $save_data = null ) {
        if ( ( $this->request->post('action') != 'yit-panel-save' || ! $this->request->verify_nonce('yit_panel') ) && $this->request->post('action') != 'yit_restore_backup' ) {
            return;
        }

        if( $this->request->post('action') == 'yit-panel-save' ){
            $post_data = $this->request->post('yit_panel_option');
        }else{
            $post_data = $save_data;
        }

        /* Change Skin */
        if(  isset( $post_data['general-skin'] ) && ( ( defined('YIT_DEV') && ! YIT_DEV ) || ! defined( 'YIT_DEV' ) ) ) {
            unset( $post_data['general-skin'] );
        }

        /* Change Theme Options Value */
        if ( empty( $this->_panel ) ) {
            $this->_panel = $this->getModel('panel')->get_theme_options_from_files();
        }

        $page_options = ! $this->request->post('yit-subpage') ? $this->_panel[ 'theme-options' ] : $this->_panel[ $this->request->post('yit-subpage') ];

        foreach ( $page_options as $tab => $subtabs ) {

            foreach ( $subtabs as $options ) {
                foreach ( $options as $option ) {

                    // must be process the saving also when there are the ID and the TYPE set for this option
                    if ( ! ( isset( $option['id'] ) && isset( $option['type'] ) ) ) continue;

                    // the option types that are one checkbox
                    $checkbox_type = array( 'checkbox', 'onoff' );
                    $multicheck_type = array( 'cat', 'pag', 'checklist' );

                    // if there isn't this option in the form data sent and it's not a checkbox, can't process this option
                    if ( ! in_array( $option['type'], $checkbox_type )
                         && ! in_array( $option['type'], $multicheck_type )
                         && ! isset( $post_data[ $option['id'] ] )
                       ) {
                        continue;
                    }

                    // if the option is a checkbox and the data it's not sent in the form data, it means that the checkbox is not checked
                    if ( in_array( $option['type'], $checkbox_type ) && ! isset( $post_data[ $option['id'] ] ) ) {
                        $post_data[ $option['id'] ] = 'no';
                    }

                    // for the types "cat" and "pag", if there are
                    if ( in_array( $option['type'], $multicheck_type ) && ! isset( $post_data[ $option['id'] ] ) ) {
                        $post_data[ $option['id'] ] = array();
                    }

                    // get the value from the POST data, after having done all controls
                    $value = $post_data[ $option['id'] ];

                    // validation
                    if ( isset( $option['validate'] ) ) {
                        if ( is_array( $option['validate'] ) )
                            $validate_filters = $option['validate'];
                        else
                            $validate_filters = array( $option['validate'] );

                        foreach ( $validate_filters as $filter ) {
                            switch ( $filter ) {

                                case 'yit_avoid_duplicate' :
                                    $value = yit_avoid_duplicate( $value, $this->get_option( $option['id'] ) );
                                    break;

                                default :
                                    $value = call_user_func( $filter, $value );
                                    break;

                            }
                        }
                    }

                    // check if is defined the "data" index, with 'array-merge', that add the value in an array
                    if ( isset( $option['data'] ) && 'array-merge' == $option['data'] ) {
                        if ( empty( $value ) ) continue;

                        $existing_array = $this->get_option( $option['id'], array() );
                        if ( ! is_array( $existing_array ) || empty( $existing_array ) ) {
                            $value = array( $value );
                        } else {
                            $value = array_merge( array( $value ), $existing_array );
                        }
                    }

                    // Update the option in the database
                    $this->update_option( $option['id'], $value );
                }
            }
        }

        // Add a CSS Rule to an array ready to write on dynamics.css file
        $this->getModel('css')->save_css();

        // add the feedback message
        if( $this->request->post('action') == 'yit-panel-save' ) {
            $this->getModel('message')->addMessage( __( 'Options Saved!', 'yit' ), 'updated', 'panel' );
            // if AJAX, print the message and die
            if ( $this->request->is_ajax ) {
                $this->update_db_options();
                $this->getModel('message')->printMessages();
                die();
            }
        } elseif( $this->request->post('action') == 'yit_restore_backup' ){
            $this->update_db_options();
            return true;
        }
    }

    /**
     * Refresh all options linked to the main option for the main color of the theme
     *
     * @return mixed
     * @since  2.0.0
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
     */
    public function refresh_colors() {

        if ( ! $this->request->verify_nonce('refresh-color') ) {
            die();
        }

        $changed = array();

        // vars
        $field_id = $this->request->post('field_id');
        $color    = $this->request->post('color');

        // changed the main option
        $val = $this->get_option( $field_id );
        $val['color'] = $color;
        $this->update_option( $field_id, $val );
        $panel_options = $this->getModel('panel')->get_theme_options_from_files();

        foreach ( $panel_options as $page => $tabs ) {
            if( ! is_array( $tabs ) ) { continue; }
            foreach ( $tabs as $tab => $subtabs ) {
                if( ! is_array( $subtabs ) ) { continue; }
                foreach ( $subtabs as $subtab => $options ) {
                    if( ! is_array( $options ) ) { continue; }
                    foreach ( $options as $option ) {

                        // must be process the saving also when there are the ID and the TYPE set for this option
                        if ( ! isset( $option['id'] ) || ! isset( $option['linked_to'] ) ) {
                            continue;
                        }

                        if ( isset( $option['variations'] ) && is_array( $option['linked_to'] ) ) {

                            foreach ( $option['linked_to'] as $variation => $variation_field_id ) {
                                if ( $variation_field_id != $field_id ) {
                                    continue;
                                }

                                $val = $this->get_option( $option['id'] );
                                $val['color'][ $variation ] = $color;
                                $this->update_option( $option['id'], $val );

                                $changed[ $option['id'] . '-' . $variation ] = $color;
                            }

                        } else {
                            if ( $option['linked_to'] != $field_id ) {
                                continue;
                            }

                            $val = $this->get_option( $option['id'] );
                            $val['color'] = $color;
                            $this->update_option( $option['id'], $val );

                            $changed[ $option['id'] ] = $color;

                        }

                    }
                }
            }
        }

        // save to database
        $this->update_db_options();

        if ( empty( $changed ) ) {
            die();
        }

        echo json_encode( $changed );
        die();
    }

    /**
     * Get a specific option value from the database
     *
     * @param string      $id      string
     * @param bool|string $default  string
     *
     * @return mixed
     * @since  2.0.0
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
     */
    public function get_option( $id, $default = false )            
    {                                                                               
        global $post, $wp_query;
        
        $post_meta = '';
        
            if ( isset( $wp_query->is_posts_page ) && $wp_query->is_posts_page ) $post_id = get_option('page_for_posts');
        elseif ( is_shop_installed() && ( is_shop() || is_product_category() || is_product_tag() ) ) $post_id = wc_get_page_id( 'shop' );
        elseif ( isset( $post->ID ) ) $post_id = $post->ID;
        else $post_id = 0;

        // get eventual custom field hidden from the post, that have the same ID
        if ( $post_id != 0 ) {
        	$post_meta = get_post_meta( $post_id, '_' . $id, true );
        }

        // get eventual custom field from the post, that have the same ID
        if ( $post_id != 0 && empty( $post_meta ) ) {
        	$post_meta = get_post_meta( $post_id, $id, true );
        }

        // return custom field, if it exists
        if ( ! in_array( $post_meta, array( '', 'default' ) ) ) {    // the only way to check, because with ! empty( $post_meta ) doesn't get the value "0" from the custom field
        	$val = stripslashes_deep( $post_meta );
        
        // otherwise return the value from database, if it exists    
        } elseif ( isset( $this->db_options[ $id ] ) && in_array( $post_meta, array( '', 'default' ) ) ) {
            $val = stripslashes_deep( $this->db_options[ $id ] );
        
        // else return the default value from the options array, if it's not defined a default value in method parameter
        } elseif ( ! $default ) {
            $defaults = $this->get_default_options(); 
            if ( ! isset( $defaults[$id] ) ) {
                $val = null;
            } else {
                $this->update_option( $id, $defaults[$id] );
                $val = stripslashes_deep( $defaults[$id] );
            }
        
        // else return the default value from the method parameter
        } else {
            $val = stripslashes_deep( $default );
        }

        return apply_filters( 'yit_get_option', $val, $id, $default );
    }  

	/**
	 * Delete an option
	 *                  
     * @param $id string The ID of option to delete   
	 * @return void     
     * @since 2.0.0
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
	 */        
    public function delete_option( $id ) {                
        if ( isset( $this->db_options[ $id ] ) )
            { unset( $this->db_options[ $id ] ); }
        
        $this->_is_option_updated = true;
    }

    /**
     * Reset options to default
     *
     * @return bool
     * @since 2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function reset_options() {
		delete_option( $this->getModel( 'options' )->options_name . '_defaults' );
        return update_option( $this->options_name, $this->get_default_options() );
    }

    /**
     * Update an option
     *
     * Save the value of the option in the property $db_options and then set the
     * $_is_option_updated to TRUE to save the value in the database in the specific hooks
     *
     * @param      $id        string The ID of option to update
     * @param      $new_value mixed The value to save in the option
     * @param bool $hard_save
     *
     * @return null
     * @since  2.0.0
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
     */
    public function update_option( $id, $new_value, $hard_save = false ) {                             
        $this->db_options[ $id ] = $new_value;
                                               
        $this->_is_option_updated = true;          
        
        if ( $hard_save ) {
            $this->update_db_options();
            return;
        }
    }

    /**
     * Get an option db from prefix
     *
     * @param $prefix
     * @return array|mixed
     * @since 1.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function get_options_from_prefix( $prefix ) {
        if( !$prefix ) return array();

        global $wpdb;

        $options =  $wpdb->get_col( $wpdb->prepare( "SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE %s", '{$prefix}%' ) );
        $return = array();

        foreach( $options as $option ) {
            $return[$option] = get_option( $option );
        }

        return $return;
    }
}

/**
 * Get the option value from the database
 *
 * @param             $id      string
 * @param bool|string $default string (default false)
 *
 * @return mixed
 * @since 1.0.0
 */
function yit_get_option( $id, $default = false ) {
    return YIT_Registry::get_instance()->options->get_option( $id, $default );
}

/**
 * Update an option value in the database
 *
 * @param $id string
 * @param $new_value string
 * @param $hard_save (default false)
 * @return mixed
 * @since 1.0.0
 */
function yit_update_option( $id, $new_value, $hard_save = false ) {
    YIT_Registry::get_instance()->options->update_option( $id, $new_value, $hard_save );
}

/**
 * Delete an option value from the database
 *
 * @param $id string
 * @return null
 * @since 1.0.0
 */
function yit_delete_option( $id ) {
    YIT_Registry::get_instance()->options->delete_option( $id );
}