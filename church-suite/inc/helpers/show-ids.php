<?php
/*
 * Based on Plugin: 99 Robots Show IDs - http://99robots.com/wpsite-show-ids
*/

// Hooks + Filters
add_action( 'admin_head', array('WPSiteShowIDs', 'add_css'));

// For Post Management
add_filter( 'manage_posts_columns', array('WPSiteShowIDs', 'add_column') );
add_action( 'manage_posts_custom_column', array('WPSiteShowIDs', 'add_value'), 10, 2 );

// For Page Management
add_filter( 'manage_pages_columns', array('WPSiteShowIDs', 'add_column') );
add_action( 'manage_pages_custom_column', array('WPSiteShowIDs', 'add_value'), 10, 2 );

// For Media Management
add_filter( 'manage_media_columns', array('WPSiteShowIDs', 'add_column') );
add_action( 'manage_media_custom_column', array('WPSiteShowIDs', 'add_value'), 10, 2 );

// For Link Management
add_filter( 'manage_link-manager_columns', array('WPSiteShowIDs', 'add_column') );
add_action( 'manage_link_custom_column', array('WPSiteShowIDs', 'add_value'), 10, 2 );

// For Category Management
add_action( 'manage_edit-link-categories_columns', array('WPSiteShowIDs', 'add_column') );
add_filter( 'manage_link_categories_custom_column', array('WPSiteShowIDs', 'add_return_value'), 10, 3 );

// For Taxonmies
foreach ( get_taxonomies() as $taxonomy ) {
	if (isset($taxonomy)) {
		add_action("manage_edit-" . $taxonomy . "_columns", array('WPSiteShowIDs', 'add_column'));
		add_filter("manage_" . $taxonomy . "_custom_column", array('WPSiteShowIDs', 'add_return_value'), 10, 3);
	}
}

// For User Management
add_action( 'manage_users_columns', array('WPSiteShowIDs', 'add_column') );
add_filter( 'manage_users_custom_column', array('WPSiteShowIDs', 'add_return_value'), 10, 3 );

// For Comment Management
add_action( 'manage_edit-comments_columns', array('WPSiteShowIDs', 'add_column') );
add_action( 'manage_comments_custom_column', array('WPSiteShowIDs', 'add_value'), 10, 2 );

add_action('admin_init', array('WPSiteShowIDs', 'custom_objects'));

class WPSiteShowIDs {
	static function custom_objects() {

		// For Custom Taxonomies
		foreach ( get_taxonomies(array('public'   => true, '_builtin' => false ), 'names') as $custom_taxonomy ) {
			if (isset($custom_taxonomy)) {
				add_action("manage_edit-" . $custom_taxonomy . "_columns", array('WPSiteShowIDs', 'add_column'));
				add_filter("manage_" . $custom_taxonomy . "_custom_column", array('WPSiteShowIDs', 'add_return_value'), 10, 3);
			}
		}

		// For Custom Post Types
		foreach (get_post_types(array('public'   => true, '_builtin' => false ), 'names') as $post_type) {
			if (isset($post_type)) {
				add_action("manage_edit-". $post_type . "_columns", array('WPSiteShowIDs', 'add_column'));
				add_filter("manage_". $post_type . "_custom_column", array('WPSiteShowIDs', 'add_return_value'), 10, 3);
			}
		}
	}

	static function add_css() {
		?>
		<style type="text/css">
			#wpsite-show-ids {width: 50px;}
		</style>
		<?php
	}

	static function add_column($cols) {
		$cols['wpsite-show-ids'] = 'ID';
		return $cols;
	}

	static function add_value($column_name, $id) {
		if ( $column_name == 'wpsite-show-ids' ) {
			echo $id;
		}
	}

	static function add_return_value($value, $column_name, $id) {
		if ( $column_name == 'wpsite-show-ids' ) {
			$value = $id;
		}
		return $value;
	}
}