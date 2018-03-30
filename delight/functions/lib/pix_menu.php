<?php
function pix_add_menu()
{
	global $themename;
	
	
	global $current_user;
	get_currentuserinfo();
	if ($current_user->display_name == 'pix_test' || $current_user->display_name == 'manu_test') {
		add_menu_page($themename, $themename, 'subscriber', 'admin_general', 'admin_general', get_template_directory_uri().'/functions/images/blank.gif');
	} else {
		add_menu_page($themename, $themename, 'administrator', 'admin_general', 'admin_general', get_template_directory_uri().'/functions/images/blank.gif');
	}
}

add_action('admin_menu', 'pix_add_menu');



add_action( 'admin_head', 'pix_icons' );
function pix_icons() {
    ?>
    <style type="text/css" media="screen">
        #menu-posts-portfolio .wp-menu-image {
            background: url(<?php echo get_template_directory_uri(); ?>/functions/images/images-stack.png) no-repeat 6px -17px !important;
        }
        #menu-posts-portfolio .wp-menu-image:before {
        	content: ''!important;
        	display: none!important;
        }
		#menu-posts-portfolio:hover .wp-menu-image, #menu-posts-portfolio.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
		
		/*****************************/
		
        #toplevel_page_admin_general .wp-menu-image {
            background: url(<?php echo get_template_directory_uri() ?>/images/delight-icon.png) no-repeat 6px -27px !important;
        }
		#toplevel_page_admin_general:hover .wp-menu-image, #toplevel_page_admin_general.current .wp-menu-image {
            background-position:6px 1px!important;
        }
		
		/*****************************/
		
    </style>
<?php }
?>