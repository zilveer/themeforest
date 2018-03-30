<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
if (!defined('YIT')) {exit('Direct access forbidden.');
}

/**
 * Manage the update event of the theme
 *
 * @class YIT_Update
 * @package	Yithemes
 * @since Version 2.0.0
 * @author Your Inspiration Themes
 *
 */

class YIT_Update extends YIT_Object {

	/**
	 * @var string Thename of file in the theme side
	 */
	protected $_themeFile = 'update.php';

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 * @author Antonino Scarfi <antonino.scarfi@yithemes.com>
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'trigger_update' ) );
	}

	/**
	 * Trigger the update event
	 *
	 * Check about the version saved on database and version of the theme. If the theme have a different and upper version
	 * trigger the action for update.
	 *
	 * @return void
	 * @since 2.0.0
	 * @author Antonino Scarfi <antonino.scarfi@yithemes.com>
	 */
	public function trigger_update() {
		$oldest = get_option( YIT_THEME_NAME . '_version' );
        $latest = wp_get_theme()->Version;

        if ( ! $oldest || version_compare( $latest, $oldest, '>' ) ) {
            if ( file_exists( YIT_THEME_PATH . '/' . $this->_themeFile ) ) {
				include_once YIT_THEME_PATH . '/' . $this->_themeFile;
			}

			do_action( 'yit_theme_updated' );
			do_action( 'yit_theme_updated_to_' . str_replace( '.', '_', $latest ) );
			do_action( 'yit_theme_updated_from_' . str_replace( '.', '_', $oldest ) . '_to_' . str_replace( '.', '_', $latest ) );

			update_option( YIT_THEME_NAME . '_version', $latest );
		}
	}

}