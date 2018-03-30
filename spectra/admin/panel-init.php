<?php

/* Iclude Panel Class */
if ( ! class_exists( 'MuttleyPanel' ) ) {
	require_once( trailingslashit( get_template_directory() ) . 'admin/classes/MuttleyPanel.php' );
}

/* Create Panel */
require_once( trailingslashit( get_template_directory() ) . 'admin/panel-main.php' );

?>