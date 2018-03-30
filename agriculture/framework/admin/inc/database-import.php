<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Create Tables in WordPress Database
 * Created by CMSMasters
 * 
 */


global $wpdb;


if ($wpdb->get_var('SHOW TABLES LIKE "' . $wpdb->prefix . CMSMS_SHORTNAME . '_likes"') != $wpdb->prefix . CMSMS_SHORTNAME . '_likes') {
	$table = $wpdb->prefix . CMSMS_SHORTNAME . '_likes';
	
	$create_query = "CREATE TABLE $table (
		id INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
		time TIMESTAMP NOT NULL,
		post_id int(9) NOT NULL,
		ip VARCHAR(15) NOT NULL,
		UNIQUE KEY id (id)
	) DEFAULT CHARSET = utf8;";
	
	$wpdb->query($create_query);
}


wp_redirect(admin_url('admin.php?page=cmsms-settings&upgraded=true'));

