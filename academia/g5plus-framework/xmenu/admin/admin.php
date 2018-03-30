<?php
add_action( 'admin_print_styles-nav-menus.php' , 'xmenu_admin_menu_load_assets' );
function xmenu_admin_menu_load_assets() {

	wp_enqueue_media();
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script('wp-color-picker');

	wp_enqueue_style( 'xmenu-menu-admin', G5PLUS_XMENU_URL. 'admin/assets/css/admin.css' );
	wp_enqueue_script( 'jquery.mousewheel', G5PLUS_THEME_URL . 'assets/plugins/jquery.mousewheel/jquery.mousewheel.js' , array( 'jquery' ) , G5PLUS_XMENU_VERSION , true );
	wp_enqueue_script( 'xmenu-menu-media-init', G5PLUS_XMENU_URL. 'admin/assets/js/media-init.js' , array( 'jquery' ) , G5PLUS_XMENU_VERSION , true );
	wp_enqueue_script( 'xmenu-menu-admin', G5PLUS_XMENU_URL. 'admin/assets/js/admin.js' , array( 'jquery' ) , G5PLUS_XMENU_VERSION , true );

	$xmenu_menu_data = xmenu_get_menu_items_data();
	global $xmenu_item_defaults;
	wp_localize_script( 'xmenu-menu-admin' , 'xmenu_menu_item_data' , $xmenu_menu_data );
	wp_localize_script( 'xmenu-menu-admin' , 'xmenu_menu_item_default' , $xmenu_item_defaults );
	wp_localize_script( 'xmenu-menu-admin' , 'xmenu_meta' , array(
		'ajax_url' => admin_url( 'admin-ajax.php?activate-multi=true' )
	) );
}

function xmenu_get_menu_items_data($post_status = 'any') {
	global $nav_menu_selected_id, $xmenu_item_defaults;
	$menu_items = wp_get_nav_menu_items( $nav_menu_selected_id, array( 'post_status' => $post_status ) );

	$xmenu_data = array();
	if (!$menu_items) return $xmenu_item_defaults;
	foreach ($menu_items as $key => $item) {
		$menu = array(
			'nosave-type_label' => $item->type_label,
			'nosave-type' => $item->type,
			'general-url' => $item->url,
			'general-title' => $item->title,
			'general-attr-title' => $item->attr_title,
			'general-target' => $item->target,
			'general-classes' => join(' ',$item->classes),
			'general-xfn' => $item->xfn,
			'general-description' => $item->description,
		);
		$menu_item_meta = get_post_meta( $item->ID, '_menu_item_xmenu_config', true );
		if ($menu_item_meta) {
			$menu_item_meta = json_decode($menu_item_meta, true);
			$menu = array_merge($menu_item_meta, $menu);
		}
		$xmenu_data [$item->ID] = array_merge($xmenu_item_defaults, $menu);
	}
	return $xmenu_data;
}