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
 * Manage Theme Updates.
 * 
 * @since 1.0.0
 */
class YIT_Notifier {
	
	/**
	 * The time interval for the remote XML cache in the database 
	 * (86400 seconds = 24 hours)
	 * 
	 * @var int
	 */
	protected $_interval = 86400;       

    /**
     * @var string The XML
     */
    protected $_xml = '';

	/**
	 * Constructor
	 */
	public function __construct() {}
	
	/**
	 * Init
	 * 
	 */
	public function init() {       

        $this->_xml = $this->get_latest_theme_version();
        
        if ( ! is_object( $this->_xml ) ) {
            return;
        }
        
        if( defined( 'YIT_SHOW_UPDATES' ) && YIT_SHOW_UPDATES ) {
            add_action('admin_menu', array( &$this, 'update_notifier_menu'));
            add_filter('yit_admin_tree', array( &$this, 'update_theme_options_menu'));
        }                

        // Communications
        add_action( 'admin_notices', array( $this, 'communications' ) );
        add_action( 'admin_head', array( $this, 'dismiss' ) );
        add_action( 'switch_theme', array( $this, 'update_dismiss' ) );
	}
	
	/**
	 * Get the remote XML file contents and return its data (Version and Changelog)
	 * Uses the cached version if available and inside the time interval defined
	 * 
	 * @param $interval int
	 * @return XML object
	 */
	public function get_latest_theme_version() {
        if ( ! function_exists('simplexml_load_string') ) {
            return false;
        }

	    $interval = $this->_interval;
	    $notifier_file_url = YIT_THEME_NOTIFIER_URL; 
	    $db_cache_field = 'yit-notifier-cache_' . get_template();
	    $db_cache_field_last_updated = 'yit-notifier-cache-last-updated_' . get_template();
	    $last = get_option( $db_cache_field_last_updated );
	    $now = time();
	    // check the cache
	    if ( !$last || (( $now - $last ) > $interval) ) {
	        // cache doesn't exist, or is old, so refresh it
// 	        if( function_exists('curl_init') ) { // if cURL is available, use it...
// 	            $ch = curl_init($notifier_file_url);
// 	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 	            curl_setopt($ch, CURLOPT_HEADER, 0);
// 	            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
// 	            $cache = curl_exec($ch);
// 	            curl_close($ch);
// 	        } else {
// 	            $cache = @file_get_contents($notifier_file_url); // ...if not, use the common file_get_contents()
// 	        }
            $remote_get = wp_remote_get( $notifier_file_url );
	        $cache = wp_remote_retrieve_body( $remote_get );
	        
	        if ($cache) {           
	            // we got good results  
	            update_option( $db_cache_field, $cache );
	            update_option( $db_cache_field_last_updated, time() );
	        } 
	        // read from the cache file
	        $notifier_data = get_option( $db_cache_field );
	    }
	    else {
	        // cache file is fresh enough, so read from it
	        $notifier_data = get_option( $db_cache_field );
	    }
	    
	    // Let's see if the $xml data was returned as we expected it to.
	    // If it didn't, use the default 1.0.0 as the latest version so that we don't have problems when the remote server hosting the XML file is down
	    if( strpos((string)$notifier_data, '<notifier>') === false ) {
	        $notifier_data = file_get_contents( YIT_CORE_TEMPLATES_DIR . '/admin/notifier/default.xml' );
	    }
	    
	    // Load the remote XML data into a variable and return it
	    $xml = @simplexml_load_string($notifier_data); 
	    
	    return $xml;
	}
	
	
	/**
	 * Adds an update notification to the WordPress Dashboard menu
	 * if the theme is not updated
	 * 
	 */
	public function update_notifier_menu() {
		$config = YIT_Config::load();
		  
        if( !$this->isUpdated() ) { // Compare current theme version with the remote XML version
            add_dashboard_page( YIT_THEME_NAME . ' Theme Updates', $config['theme']['name'] . ' <span class="update-plugins count-1"><span class="update-count">1</span></span>', 'administrator', 'theme-update-notifier', array( $this, 'display_page' ) );
		}
	}

	/**
	 * Adds an update notification to the WordPress Dashboard menu
	 * if the theme is not updated
	 * 
	 */
	public function update_theme_options_menu( $items ) {
        if( !$this->isUpdated() ) {
        	return array_merge( $items, array( 
				'update' => array(
					'parent_slug' => 'yit_panel',
					'page_title'  => 'Update Theme',
					'menu_title'  => 'Update Theme <span class="update-plugins count-1"><span class="update-count">1</span></span>',
					'capability'  => 'administrator',
					'menu_slug'   => 'yit_panel_update',
					'function'    => 'display_page',
					'deps'
				)
			));
		} else {
			return $items;
		}
	}
	
	/** 
	 * Returns if the theme needs to be updated
	 * 
	 * @return bool
	 */
	public function isUpdated() {	        
		$config = YIT_Config::load();
		$version = $config['theme']['version'];

        return !version_compare($this->_xml->latest, $version, '>');
	}  
	
	
	/**
	 * Return changelog
	 * 
	 * @return string
	 */
	public function getXml() {
		$db_cache_field = 'yit-notifier-cache_' . get_template();
		$xml = @simplexml_load_string(get_option( $db_cache_field )); 
        
		return $xml;
	}       
	
	
	/**
	 * Print the update page
	 * 
	 * @return void
     * @since 1.0.0
	 */
	public function display_page() {
		$config = YIT_Config::load();
		$name = $config['theme']['name']; 
		yit_get_template( 'admin/panel/notifier.php', $config['theme'] );
	}        

    /**
     * Show a notice with some communications sent from XML
     *
     * @return void
     * @since 1.0.0
     * @author Antonino Scarf� <antonino.scarfi@yithemes.com>
     */
    public function communications() {
        if ( ! isset( $this->_xml->dashboard ) || get_user_meta( get_current_user_id(), 'yit_communication_dismissed_notice_' . $this->_xml->dashboard['id'], true ) ) {
            return;
        }

        global $current_screen;

        ob_start(); ?>

            <?php echo $this->_xml->dashboard ?>

            <p class="action_links">
                <strong>
                    <a class="dismiss-notice" href="<?php echo esc_url( add_query_arg( 'yit-communication-dismiss', (string) $this->_xml->dashboard['id'] ) ) ?>" target="_parent">Dismiss this notice</a>
                </strong>
            </p>

        <?php

        add_settings_error( 'yit-communication', 'yit-communication', ob_get_clean(), 'updated' );

        /** Admin options pages already output settings_errors, so this is to avoid duplication */
        if ( 'options-general' !== $current_screen->parent_base ) {
            settings_errors( 'yit-communication' );
        }
    }

    /**
     * Add dismissable admin notices.
     *
     * Appends a link to the admin nag messages. If clicked, the admin notice disappears and no longer is visible to users.
     *
     * @return void
     * @since 1.0.0
     * @author Antonino Scarf� <antonino.scarfi@yithemes.com>
     */
    public function dismiss() {
    
        if ( isset( $_GET['yit-communication-dismiss'] ) )
            update_user_meta( get_current_user_id(), 'yit_communication_dismissed_notice_' . $_GET['yit-communication-dismiss'], 1 );

    }

    /**
     * Delete dismissable nag option when theme is switched.
     *
     * This ensures that the user is again reminded via nag of required
     * and/or recommended plugins if they re-activate the theme.
     *
     * @return void
     * @since 1.0.0
     * @author Antonino Scarf� <antonino.scarfi@yithemes.com>
     */
    public function update_dismiss() {
        if ( ! isset( $this->_xml->dashboard['id'] ) ) return;

        delete_user_meta( get_current_user_id(), 'yit_communication_dismissed_notice_' . $this->_xml->dashboard['id'] );

    }
}