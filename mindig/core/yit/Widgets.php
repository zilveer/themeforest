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
 * Fonts handler.
 *
 * It can handle Goolge Fonts and Web fonts
 *
 * @class YIT_Widgets
 * @package	Yithemes
 * @since 1.0.0
 * @author Your Inspiration Themes
 *
 */

class YIT_Widgets extends YIT_Object {

	/**
	 * @var array Widget Locations Path
	 */
	public $locations = array(
        YIT_THEME_YIT_WIDGETS_PATH,
		YIT_CORE_YIT_WIDGETS_PATH,
	);

	/**
	 * @var array A widget list to register
	 */
	public $widgets = array();

	/**
	 * @var array A widget list to unregistered
	 */
	public $unregistered_widgets = array();

	/**
	 * Constructor
     *
     * Register widget is in array $widgets. Unregister widget is in array $unregistered_widgets.
     * Define two filter:
     *
     * yit_add_widgets_path: to add a new widgets path to $locations array
     * yit_unregistered_widgets: to add a new widgets to $unregistered_widgets array
     *
     * @since 1.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
	 */
	public function __construct() {

        $locations = $this->locations;
        $this->locations = apply_filters('yit_add_widgets_path', $locations);

        $unregistered_widgets = $this->unregistered_widgets;
		$this->unregistered_widgets = apply_filters( 'yit_unregister_widgets', $unregistered_widgets );

		add_action( 'widgets_init', array( $this, 'load_widgets') );
		add_action( 'widgets_init', array( $this, 'unregister_widgets') );
    }


	/**
	 * Register Widgets
     *
     * Register the widgets from specific locations path.
     * By Default first register theme widgets and then core widgets
     *
     * @since 1.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @return void
	 *
	 */
	public function load_widgets() {
		foreach( $this->locations as $location ) {
			$path = $location . '/*.php';
			foreach( (array)glob($path) as $widget ) {

                if ( empty( $widget ) ) {
                    continue;
                }

				require_once($widget);

                $widget_class = basename($widget, '.php');

                if ( class_exists( $widget_class ) ){
                    $this->widgets[] = $widget_class;
                    register_widget( $widget_class );
                }
			}

		}

	}

	/**
	 * Unregister Widgets
     *
     * Unregister the widgets from specific locations path.
     *
     * @since 1.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @return void
	 *
	 */
	public function unregister_widgets() {

		foreach( $this->unregistered_widgets as $widget ) {
			unregister_widget($widget);
		}

	}
}
