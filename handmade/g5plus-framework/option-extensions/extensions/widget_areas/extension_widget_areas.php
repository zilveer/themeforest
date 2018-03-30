<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     Redux_Framework
 * @subpackage  Premium Extensions
 * @author      Dovy Paukstys (dovy)
 * @version 1.0.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if( !class_exists( 'ReduxFramework_extension_widget_areas' ) ) {

    class ReduxFramework_extension_widget_areas {

      public static $version = "1.0.1";

      // Protected vars
      protected $parent;

      /**
       * Class Constructor. Defines the args for the extions class
       *
       * @since       1.0.0
       * @access      public
       * @param       array $parent Redux_Options class instance
       * @return      void
       */
      public function __construct( $parent ) {

          $this->parent = $parent;

          if ( !class_exists( 'Redux_Widget_Areas' ) ) {
      		require_once(THEME_DIR . 'g5plus-framework/option-extensions/extensions/widget_areas/class.redux_widget_areas.php');
      		new Redux_Widget_Areas($this->parent);
      	}


		    // Allow users to extend if they want
		    do_action('redux/widget_areas/'.$parent->args['opt_name'].'/construct');

      }

    } // class

} // if
