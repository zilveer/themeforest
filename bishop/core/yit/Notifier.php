<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Manage theme update
 *
 * Notify a new update is available for theme
 *
 * @class YIT_Notifier
 * @package	Yithemes
 * @since 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Notifier extends YIT_Submenu{

    /**
	 * Time interval
	 *
	 * @var int The time interval for the remote XML cache in the database. Default value is 86400 seconds (86400 seconds = 24 hours = 24 hours * 60 minutes/hours * 60 seconds/minutes).
	 *
	 */
	protected $_interval = 86400;

    /**
     * @var string The XML
     */
    protected $_xml = '';

	/**
	 * Constructor
     * @since 2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
	 */
	public function __construct() {

        $this->_xml = $this->get_latest_theme_version();

        if ( ! is_object( $this->_xml ) ) {
            return;
        }

        // Updates
        if( defined( 'YIT_SHOW_UPDATES' ) && YIT_SHOW_UPDATES ) {
            add_action('admin_menu', array( $this, 'update_notifier_menu'));
            add_filter('admin_menu', array( $this, 'update_theme_options_menu'));
        }

        // Communications
        add_action( 'admin_notices', array( $this, 'communications' ) );
        add_action( 'admin_head', array( $this, 'dismiss' ) );
        add_action( 'switch_theme', array( $this, 'update_dismiss' ) );

    }


    /**
	 * Find th Last Theme Version
     *
     * Get the remote XML file contents and return its data (Version and Changelog)
	 * Uses the cached version if available and inside the time interval defined
	 *
     * @return SimpleXMLElement object
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
	 */
	public function get_latest_theme_version() {
        if ( ! function_exists('simplexml_load_string') ) {
            return false;
        }

	    $notifier_file_url = YIT_THEME_NOTIFIER_URL;
	    $db_cache_field = 'yit-notifier-cache_' . YIT_THEME_NAME;
	    $db_cache_field_last_updated = 'yit-notifier-cache-last-updated_' . YIT_THEME_NAME;
	    $last = get_option( $db_cache_field_last_updated );
	    $now = time();
	    // check the cache
	    if ( !$last || (( $now - $last ) > $this->_interval) ) {

            $request = wp_remote_get( $notifier_file_url );
	        $cache = wp_remote_retrieve_body( $request );

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
	        $notifier_data = file_get_contents( YIT_CORE_TEMPLATES_PATH . '/admin/notifier/default.xml' );
	    }

	    // Load the remote XML data into a variable and return it
	    $xml = @simplexml_load_string($notifier_data);

	    return $xml;
	}

    /**
     * Notification to WP Dashboard
     *
	 * Adds an update notification to the WordPress Dashboard menu
	 * if the theme is not updated
     *
     * @return void
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
	 */
	public function update_notifier_menu() {
        $theme = wp_get_theme();
        if( !$this->is_updated() ) { // Compare current theme version with the remote XML version
            add_dashboard_page( YIT_THEME_NAME . ' Theme Updates', $theme->Name . ' <span class="update-plugins count-1"><span class="update-count">1</span></span>', 'administrator', 'theme-update-notifier', array( $this, 'display_page' ) );
		}
	}

     /**
     * Get the array with the options for the notifications page
     *
     * @param array $items An array with the option to add the notification page to WP Dashboard
     * @return array
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
	 */
	public function update_theme_options_menu( $items ) {
        if( !$this->is_updated() ) {

            add_submenu_page(
                'yit_panel',
                'Update Theme',
                'Update Theme <span class="update-plugins count-1"><span class="update-count">1</span></span>',
                'manage_options',
                'yit_panel_update',
                array( $this, 'display_page' )
            );
		}
        return $items;
	}

    /**
	 * Check if the theme needs to be updated
     *
	 * @return bool
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
	 */
	public function is_updated() {
        $theme = wp_get_theme();
        $version = $theme->Version;

        return !version_compare($this->_xml->latest, $version, '>');
	}


	/**
	 * Update Page
     *
     * Print the update page on Wordpress Dashboard
	 *
	 * @return void
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
	 */
	public function display_page() {
        $theme = wp_get_theme();

		yit_get_template( 'admin/notifier/notifier.php', array('theme' => $theme, 'xml' => $this->_xml) );
	}

    /**
     * Show a notice with some communications sent from XML
     *
     * @return void
     * @since 1.0.0
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
     */
    public function communications() {
        if ( get_user_meta( get_current_user_id(), 'yit_communication_dismissed_notice_' . $this->_xml->dashboard['id'], true ) || ! isset( $this->_xml->dashboard ) ) {
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
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
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
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
     */
    public function update_dismiss() {

        delete_user_meta( get_current_user_id(), 'yit_communication_dismissed_notice_' . $this->_xml->dashboard['id'] );

    }

}