<?php if( !defined('ABSPATH') ) exit;?>
<?php 
if( !class_exists( 'Mars_Documentation' ) ){
	class Mars_Documentation {
		function __construct() {
			add_action('admin_menu', array($this,'add_admin_menu'));
		}
		function add_admin_menu(){
			add_theme_page(__('Documentation','mars'), __('Documentation','mars'), 'add_users', 'documentation', array($this,'documentation'));
		}
		function documentation() {
			print '<iframe src="'.get_template_directory_uri().'/documentation/documentation.html" name="test" height="1000px" width="100%">You need a Frames Capable browser to view this content.</iframe>';
		}
	}
	new Mars_Documentation();
}