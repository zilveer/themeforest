<?php

require_once( locate_template( 'assets/framework/wp/options/custom-functions.php' ) );
require_once( locate_template( 'assets/framework/wp/options/init-admin.php' ) );
require_once( locate_template( 'assets/framework/wp/widgets/widgets.php' ) );
require_once( locate_template( 'assets/framework/wp/posts/ishyo-meta-box.php' ) );

if ( is_admin() ){
	require_once( locate_template( 'assets/framework/wp/posts/custom-meta-boxes.php' ) );
}

require_once( locate_template( 'assets/framework/wp/posts/seo-meta-boxes.php' ) );
require_once( locate_template( 'assets/framework/wp/shortcodes/shortcodes.php' ) );