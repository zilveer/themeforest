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

/**
 * Metaboxes handler. Creates and handles metaboxes.
 * 
 * @since 1.0.0
 */
class YIT_Metaboxes {
    /**
     * All registered metaboxes.
     * 
     * @var array
     * @access protected
     * @since 1.0.0
     */
    protected $_metaboxes = array();
    
    /**
     * All registered options.
     * 
     * @var array
     * @access protected
     * @since 1.0.0
     */
    protected $_options = array();
    
    /**
     * All options of the metaboxes registered on the theme.
     * 
     * @var array
     * @access protected
     * @since 1.0.0
     */
    protected $_options_options = array();
    
    /**
     * Metaboxes tabs
     * 
     * @var array
     * @access protected
     * @since 1.0.0
     */
    protected $_tabs = array();
    
    /**
     * Constructor.
     * 
     * @since 1.0.0
     */
    public function __construct() {}
	
	/**
	 * Init
	 * 
	 */
	public function init() {
        add_action( 'save_post', array( &$this, 'save_postdata' ) );
        add_action( 'add_meta_boxes', array( &$this, 'register_metaboxes' ) );
        add_action( 'admin_init', array( &$this, 'load_metaboxes' ) );
    }
    
    /**
     * Add a new metaboxes tab.
     * 
     * @param string $label
     * @return void
     * @since 1.0.0
     */
    public function create_tab( $label, $metabox_id ) {
        if( !$this->tab_exists( $label, $metabox_id ) )
            { $this->_tabs[$metabox_id][] = $label; }
    }
    
    /**
     * Check if a tab already exists
     * 
     * @param string $label
     * @return void
     * @since 1.0.0
     */
    public function tab_exists( $label, $metabox_id ) {
        if ( ! isset( $this->_tabs[$metabox_id] ) )
            { return false; }
        return in_array( $label, $this->_tabs[$metabox_id] );
    }
    
    /**
     * Register all metaboxes registered in the theme.
     *
     * @return void
     * @since 1.0.0
     */
    public function register_metaboxes() {
        foreach( $this->_metaboxes as $id => $metabox ) 
            { add_meta_box( $id, $metabox['title'], array( &$this, 'metaboxes_html' ), $metabox['post_type'], $metabox['context'], $metabox['priority'], array( 'metabox_id' => $id ) ); }
    }
    
    /**
     * Register a metabox.
     * 
     * @param string $id
     * @param string $title
     * @param string $post_type
     * @return void
     * @since 1.0.0
     */
    public function register_metabox( $id, $title, $post_type, $context = 'normal', $priority = 'high' ) {
        if( !in_array( $id, $this->_metaboxes ) ) {   
            $this->_metaboxes[$id] = array(
                'title' => $title,
                'post_type' => $post_type,
                'context' => $context,
                'priority' => $priority 
            );
        } 
    }
    
    /**
     * Add a meta box to an edit form.
     *
     * @param string $metabox_id
     * @param string $tab
     * @param string $id
     * @param string $type
     * @param array $options
     * @return void
     * @since 1.0.0
     */
    public function add_option_metabox( $metabox_id, $tab, $id, $type, $options ) {
        $this->create_tab( $tab, $metabox_id );
        
    	$this->_options[$metabox_id][$tab][$id] = array(
            'id' => $id,
    		'title' => isset( $options['title'] ) ? $options['title'] : '',
    		'type' => $type,
            'desc' => isset( $options['desc'] ) ? $options['desc'] : '',
            'name' => isset( $options['name'] ) ? $options['name'] : $id,
            'options' => isset( $options['options'] ) ? $options['options'] : '',
            'val' => isset( $options['val'] ) ? $options['val'] : '',
            'std' => isset( $options['std'] ) ? $options['std'] : ( isset( $options['val'] ) && $options['val'] ? $options['val'] : '' )
    	);
    }
    
    /**
     * Remove a meta box.
     *
     * @param string $metabox_id
     * @param string $tab
     * @param string $id
     * @return void
     * @since 1.0.0
     */
    public function remove_option_metabox( $metabox_id, $tab, $id ) {
        if( isset( $this->_options[$metabox_id][$tab][$id] ) ) {
            unset( $this->_options[$metabox_id][$tab][$id] );
        }
        
        return true;
    }
    
    /**
     * Print metaboxes tab
     * 
     * @param object $post
     * @param string $metabox_id
     * @return void
     * @since 1.0.0
     */
    public function metaboxes_html( $post, $metabox ) {
        $metabox_id = $metabox['args']['metabox_id'];
		
		$this->_options = apply_filters( 'yit_add_options_metabox', $this->_options );
        $this->_options = apply_filters( 'yit_remove_options_metabox', $this->_options );
        
        yit_get_template( 'admin/metaboxes/tab.php', array( 'tabs' => $this->_tabs[$metabox_id], 'options' => $this->_options[$metabox_id] ) );
    }
    
    /**
     * Save the post data of metaboxes.
     *
     * @param int $post_id The id of post
     * @return mixed
     * @since 1.0.0
     */
    public function save_postdata( $post_id ) {
    	if ( isset( $_POST['yit_metaboxes_nonce'] ) AND !wp_verify_nonce( $_POST['yit_metaboxes_nonce'], 'metaboxes-fields-nonce' ) ) { 
    		return $post_id;
        }
        
    	//if ( ! isset( $_POST['yit_metaboxes'] ) ) { 
    	//	return $post_id;
        //}
    	
    	if ( ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) { 
    		return $post_id;                 
        };
    	
        if( isset( $_POST['post_type'] ) )
            { $post_type = $_POST['post_type']; }
        else
            { return $post_id; }
        
    	if ( 'page' == $post_type ) {
    		if ( !current_user_can( 'edit_page', $post_id ) ) {
    		  return $post_id;
            }
    	} else {
    		if ( !current_user_can( 'edit_post', $post_id ) ) {
    		  return $post_id;
            }
    	}
		
		$this->_options = apply_filters( 'yit_add_options_metabox', $this->_options );
        $this->_options = apply_filters( 'yit_remove_options_metabox', $this->_options );
        
        foreach( $this->_options as $metabox_id => $tabs ) {
            foreach( $tabs as $tab => $options ) {
                foreach( $options as $option ) {
                    if( isset( $_POST['yit_metaboxes'][$option['name']] ) ) {
                        add_post_meta( $post_id, $option['name'], $_POST['yit_metaboxes'][$option['name']], true ) || update_post_meta( $post_id, $option['name'], $_POST['yit_metaboxes'][$option['name']] );
                    } elseif( in_array($option['type'], array('onoff', 'checkbox'))) {
                        add_post_meta( $post_id, $option['name'], '0', true ) || update_post_meta( $post_id, $option['name'], '0' );
					} else {
                        delete_post_meta( $post_id, $option['name'] );
                    }
                }
            }
        }
    	
    	return;
    }
    
    /**
     * Load metaboxes registriation
     * 
     * @return void
     * @since 1.0.0
     */
    public function load_metaboxes() {
        //Load core metaboxes registration
        require_once YIT_CORE_PATH . '/metaboxes.php';
    }
}

if( !function_exists( 'yit_register_metabox' ) ) {
    /**
     * Register a metabox.
     * 
     * @param string $id
     * @param string $title
     * @param string $post_type
     * @return void
     * @since 1.0.0
     */
    function yit_register_metabox( $id, $title, $post_type, $context = 'normal', $priority = 'high' ) {
        $metabox = yit_get_model( 'metaboxes' );
        $metabox->register_metabox( $id, $title, $post_type, $context, $priority );
    }
}

if( !function_exists( 'yit_add_option_metabox' ) ) {
    /**
     * Add a meta box to an edit form.
     *
     * @param string $metabox_id
     * @param string $tab
     * @param string $id
     * @param string $type
     * @param array $options
     * @return void
     * @since 1.0.0
     */
    function yit_add_option_metabox( $metabox_id, $tab, $id, $type, $options ) {
        $metabox = yit_get_model( 'metaboxes' );
        $metabox->add_option_metabox( $metabox_id, $tab, $id, $type, $options );    
    }
}

if( !function_exists( 'yit_remove_option_metabox' ) ) {
    /**
     * Remove a meta box to an edit form.
     *
     * @param string $metabox_id
     * @param string $tab
     * @param string $id
     * @param string $type
     * @param array $options
     * @return void
     * @since 1.0.0
     */
    function yit_remove_option_metabox( $metabox_id, $tab, $id ) {
        $metabox = yit_get_model( 'metaboxes' );
        $metabox->remove_option_metabox( $metabox_id, $tab, $id );    
    }
}

if( !function_exists( 'yit_create_metaboxes_tab' ) ) {
    /**
     * Add a new metaboxes tab.
     * 
     * @param string $label
     * @return void
     * @since 1.0.0
     */
    function yit_create_metaboxes_tab( $label ) {
        $metabox = yit_get_model( 'metaboxes' );
        $metabox->create_tab( $label );
    }
}

if( !function_exists( 'yit_metaboxes_sep' ) ) {
    /**
     * Add the separator between metaboxes
     * 
     * @param string $metabox_id
     * @param string $tab
     * @return void
     * @since 1.0.0
     */
    function yit_metaboxes_sep( $metabox_id, $tab ) {
        $metabox = yit_get_model( 'metaboxes' );
        $metabox->add_option_metabox( $metabox_id, $tab, microtime(), 'sep', array() );
    }
}

if( !function_exists( 'yit_option_metabox_name') ) {
    /**
     * Correctly print the name of a metabox. It can handle array names.
     * 
     * @param string $name
     * @return void
     * @since 1.0.0
     */
    function yit_option_metabox_name( $name ) {
        $db_name = apply_filters( 'yit_metaboxes_option_main_name', 'yit_metaboxes' );
        $return = $db_name . '[';
        
        if( !strpos( $name, '[' ) ) {
            return $return . $name . ']';
        }
        
        $return .= substr( $name, 0, strpos( $name, '[' ) );
        $return .= ']';
        $return .= substr( $name, strpos( $name, '[' ) );
        
        return $return;
    }
}

if( !function_exists( 'yit_get_post_meta' ) ) {
    /**
     * Retrieve the value of a metabox, also if it is an array.
     * 
     * @param int $id
     * @param string $meta
     * @return mixed
     * @since 1.0.0
     */
    function yit_get_post_meta( $id, $meta ) {
        if( !strpos( $meta, '[' ) ) {
            return get_post_meta( $id, $meta, true );
        }
        
        $sub_meta = explode( '[', $meta );
        
        $meta = get_post_meta( $id, $meta, true );
        for( $i = 0; $i < count( $sub_meta ); $i++ ) {
            $meta = $meta[ rtrim( $sub_meta[$i], ']') ];   
        }
        
        return $meta;
    }
}