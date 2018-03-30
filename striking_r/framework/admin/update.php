<?php


function theme_update($from, $to) {
	global $wp_filesystem, $wpdb;
	

	@set_time_limit( 300 );

	$wp_version = $GLOBALS['wp_version'];

	$required_wp_version = '4.0';
	$theme_version = '1.2.8.4';

	$wp_compat     = version_compare( $wp_version, $required_wp_version, '>=' );

	if ( !$wp_compat ) {
		$wp_filesystem->delete($from, true);
		return new WP_Error( 'wordpress_not_compatible', sprintf( __('The update cannot be installed because %1$s %2$s requires Wordpress version %3$s or higher. You are running version %4$s.','theme_admin'), THEME_NAME, $theme_version, $required_wp_version, $wp_version ) );
	}

	if(version_compare(THEME_VERSION, '5.1.7', '>=' )){
		$skip_list = array('functions.php','languages');
	}else{
		$skip_list = array('languages');
	}
	$base = trailingslashit(get_template_directory());

	// Create maintenance file to signal that we are upgrading
	$maintenance_string = '<?php $upgrading = ' . time() . '; ?>';
	$maintenance_file = $to . '.maintenance';
	$wp_filesystem->delete($maintenance_file);
	$wp_filesystem->put_contents($maintenance_file, $maintenance_string, FS_CHMOD_FILE);
	// Start backup old files.
	$backuplist = _get_backup_file_list($from, $to, $base);
	$wp_filesystem->copy($from.'delete.php' , $to.'delete.php',true,FS_CHMOD_FILE);
	$_old_theme_files = include(TEMPLATEPATH . '/delete.php' );
	foreach($_old_theme_files as $index => $old_file){
		$_old_theme_files[$index] = $to.$old_file;
		if(! is_file($_old_theme_files[$index]))
			unset($_old_theme_files[$index]);
	}
	$backuplist = array_merge($backuplist, $_old_theme_files);
	// Package it to zip
	require_once(ABSPATH . 'wp-admin/includes/class-pclzip.php');
	$tempfile = wp_tempnam();
	$archive = new PclZip($tempfile);

	//$archive = new PclZip($to . 'cache/backup/'.THEME_VERSION.'_'.$theme_version.'.zip');
	if(0 == $archive->create(implode(",", $backuplist), PCLZIP_OPT_REMOVE_PATH, $base)){
		die("Error  : '".$archive->errorInfo(true)."'");
		$wp_filesystem->delete($maintenance_file);
		$wp_filesystem->delete($from, true);
		$wp_filesystem->delete($to.'delete.php');
		unlink($tempfile);
		
		return new WP_Error('backup_error', __('Backup error.','theme_admin'));
	}
	$wp_filesystem->put_contents($to . 'cache/backup/'.THEME_VERSION.'_'.$theme_version.'.zip',file_get_contents($tempfile),FS_CHMOD_FILE);
	unlink($tempfile);
	
	
	

	// Copy new versions of Theme files into place.
	$result = _copy_theme_dir($from, $to, $skip_list);

	// Handle $result error from the above blocks
	if ( is_wp_error($result) ) {
		$wp_filesystem->delete($maintenance_file);
		$wp_filesystem->delete($from, true);
		return $result;
	}

	if(!empty($_old_theme_files)){
		// Remove old files
		foreach ( $_old_theme_files as $old_file ) {
			if ( !$wp_filesystem->exists(  $old_file) )
				continue;
			if ( is_wp_error($result) )
			return $result;
			$wp_filesystem->delete($old_file, true);
		}
	}
	$wp_filesystem->delete($to . 'delete.php');

	// Remove working directory
	$wp_filesystem->delete($from, true);

	// Force refresh of update information
	if ( function_exists('delete_site_transient') )
		delete_site_transient(THEME_SLUG.'_update');

	// Remove maintenance file, we're done.
	$wp_filesystem->delete($maintenance_file);
}

function _copy_theme_file($from, $to){
	global $wp_filesystem;
	
	$to_dir = dirname($to);
	if(!$wp_filesystem->is_dir($to_dir)){
		$result = _copy_theme_file_mkdir($to_dir);
		if ( is_wp_error($result) )
			return $result;
	}
	if ( ! $wp_filesystem->copy( $from, $to, true, FS_CHMOD_FILE) )
		return new WP_Error('copy_failed', __('Could not copy file.','theme_admin'), $from);
}

function _copy_theme_file_mkdir($dir){
	global $wp_filesystem;
	$parent_dir = dirname($dir);
	if(!$wp_filesystem->is_dir($parent_dir)){
		$result = _copy_theme_file_mkdir($parent_dir);
		if ( is_wp_error($result) )
			return $result;
	}
	if ( !$wp_filesystem->mkdir($dir, FS_CHMOD_DIR) )
		return new WP_Error('mkdir_failed', __('Could not create directory.','theme_admin'), $dir);
}

/**
 * Copies a directory from one location to another via the WordPress Filesystem Abstraction.
 * Assumes that WP_Filesystem() has already been called and setup.
 *
 * This is a temporary function for the 3.1 -> 3.2 upgrade only and will be removed in 3.3
 *
 * @ignore
 * @since 3.2.0
 * @see copy_dir()
 *
 * @param string $from source directory
 * @param string $to destination directory
 * @param array $skip_list a list of files/folders to skip copying
 * @return mixed WP_Error on failure, True on success.
 */
function _copy_theme_dir($from, $to, $skip_list = array() ) {
	global $wp_filesystem;

	$dirlist = $wp_filesystem->dirlist($from);

	$from = trailingslashit($from);
	$to = trailingslashit($to);

	$skip_regex = '';
	foreach ( (array)$skip_list as $key => $skip_file )
		$skip_regex .= preg_quote($skip_file, '!') . '|';

	if ( !empty($skip_regex) )
		$skip_regex = '!(' . rtrim($skip_regex, '|') . ')$!i';

	foreach ( (array) $dirlist as $filename => $fileinfo ) {
		if ( !empty($skip_regex) )
			if ( preg_match($skip_regex, $from . $filename) )
				continue;

		if ( 'f' == $fileinfo['type'] ) {
			if ( ! $wp_filesystem->copy($from . $filename, $to . $filename, true, FS_CHMOD_FILE) ) {
				// If copy failed, chmod file to 0644 and try again.
				$wp_filesystem->chmod($to . $filename, 0644);
				if ( ! $wp_filesystem->copy($from . $filename, $to . $filename, true, FS_CHMOD_FILE) )
					return new WP_Error('copy_failed', __('Could not copy file.','theme_admin'), $to . $filename);
			}
		} elseif ( 'd' == $fileinfo['type'] ) {
			if ( !$wp_filesystem->is_dir($to . $filename) ) {
				if ( !$wp_filesystem->mkdir($to . $filename, FS_CHMOD_DIR) )
					return new WP_Error('mkdir_failed', __('Could not create directory.','theme_admin'), $to . $filename);
			}
			$result = _copy_theme_dir($from . $filename, $to . $filename, $skip_list);
			if ( is_wp_error($result) )
				return $result;
		}
	}
	return true;
}

function _get_backup_file_list($from, $to,$base, $skip_list = array() ) {
	$backuplist = array();
	global $wp_filesystem;

	$dirlist = $wp_filesystem->dirlist($from);

	$from = trailingslashit($from);
	$to = trailingslashit($to);
	$base = trailingslashit($base);


	$skip_regex = '';
	foreach ( (array)$skip_list as $key => $skip_file )
		$skip_regex .= preg_quote($skip_file, '!') . '|';

	if ( !empty($skip_regex) )
		$skip_regex = '!(' . rtrim($skip_regex, '|') . ')$!i';

	foreach ( (array) $dirlist as $filename => $fileinfo ) {
		if ( !empty($skip_regex) )
			if ( preg_match($skip_regex, $from . $filename) )
				continue;

		if ( 'f' == $fileinfo['type'] ) {
			if ( !$wp_filesystem->exists($to.$filename) )
				continue;
			$backuplist[] =  $base.$filename;
		} elseif ( 'd' == $fileinfo['type'] ) {
			if ( !$wp_filesystem->is_dir($to . $filename) ) 
				continue;
			$backuplist = array_merge($backuplist, _get_backup_file_list($from . $filename, $to . $filename, $base.$filename, $skip_list));
		}
	}

	return $backuplist;
}
