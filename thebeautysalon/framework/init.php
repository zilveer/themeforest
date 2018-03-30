<?php
/** Elderberry Initializer
  *
  * This file is used to initialize various bits and pieces
  * of the framework.
  *
  * @package Elderberry
  *
  */

include( 'configuration/config.php' );
$eb_options = get_option( EB_OPTION_NAME );


include( EB_PATH .'/eb_helpers.php' );
include( 'configuration/defaults.php' );
include( EB_PATH .'/EB_Framework.class.php' );
include( EB_PATH .'/EB_Controls.class.php' );
include( EB_PATH .'/EB_Widgets.class.php' );
include( EB_PATH .'/EB_Shortcodes.class.php' );
include( EB_PATH .'/EB_Styler.class.php' );
include( EB_PATH .'/EB_Blueprint.class.php' );

include( EB_PATH .'/EB_Products.class.php' );

include( 'configuration/helpers.php' );
include( 'configuration/widgets.php' );
include( 'configuration/post_types.php' );
include( 'configuration/taxonomies.php' );
include( 'configuration/metaboxes.php' );
include( 'configuration/shortcodes.php' );
include( 'configuration/controls.php' );
include( 'configuration/pages.php' );


?>