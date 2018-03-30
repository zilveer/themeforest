<?php

add_action('admin_menu', 'pix_add_menu');
function pix_add_menu()
{
	if (function_exists('add_options_page')) {
		add_menu_page(get_option('pix_content_admin_page_title'), get_option('pix_content_admin_page_title'), 'manage_options', 'admin_interface', 'add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'admin_interface','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'admin_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'register_theme','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'import_export','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'layout_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'top_bar','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'header_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'nav_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'title_section_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'sidebar_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'footer_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'sidebar_generator','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'latest_posts_page_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'blog_pages_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'categories_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'posts_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'portfolio_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'portfolio_items','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'google_fonts','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'main_typography','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'woo_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'shop_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'products_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'custom_css_admin','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'colorbox_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'layout_colors_panel','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'main_elements_colors','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'footer_colors','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'top_sliding_colors','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'top_bar_colors','add_options');
		add_submenu_page('admin_interface', null, null, 'manage_options', 'append_scripts','add_options');
	}
}

add_action( 'admin_head', 'pix_sub_pages' );
function pix_sub_pages() {
    ?>
    <style type="text/css" media="screen">	
        #toplevel_page_admin_interface .wp-submenu {
            display: none;
        }
        #menu-posts-portfolio .icon16.icon-post:before, 
        #adminmenu .menu-icon-post#menu-posts-portfolio div.wp-menu-image:before {
        	content: '\e8ee';
        	font-family: "scicon-awesome-fontello"!important;
        	font-size: 14px!important;
        	line-height: 21px;
        }
        #menu-posts-testimonial .icon16.icon-post:before, 
        #adminmenu .menu-icon-post#menu-posts-testimonial div.wp-menu-image:before {
        	content: '\e84a';
        	font-family: "scicon-awesome-fontello"!important;
        	font-size: 14px!important;
        	line-height: 21px;
        }
    </style>
<?php }
?>