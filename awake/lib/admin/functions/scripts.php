<?php

/**
 *
 */
function mysite_admin_enqueue_scripts( $hook ) {
	global $wp_version;
	
	if ( in_array( $hook,  array( 'toplevel_page_mysite-options' ) ) ) {
		
		$url = THEME_URI;
		echo "<script type=\"text/javascript\">
		//<![CDATA[
			var mysiteAjaxUrl = '$url/lib/admin/ajax',
			    mysiteWpVersion = '$wp_version';
		//]]>\r</script>\r";
		
		wp_enqueue_style( MYSITE_PREFIX . '-admin', THEME_ADMIN_ASSETS_URI . '/css/admin.css', false, THEME_VERSION, 'screen' );
		wp_enqueue_style( MYSITE_PREFIX . '-admin-menu', THEME_ADMIN_ASSETS_URI . '/css/menu.css', false, THEME_VERSION, 'screen' );
		wp_enqueue_style( MYSITE_PREFIX . '-colorpicker', THEME_ADMIN_ASSETS_URI .'/js/colorpicker/css/colorpicker.css', false, THEME_VERSION, 'screen' );
		
		wp_enqueue_script( 'jquery-ui-sortable', array('jquery') );
		wp_enqueue_script( MYSITE_PREFIX . 'colorpicker-script', THEME_ADMIN_ASSETS_URI .'/js/colorpicker/js/colorpicker.js', array('jquery'), THEME_VERSION );
		wp_enqueue_script( MYSITE_PREFIX . '-colorpicker', THEME_ADMIN_ASSETS_URI .'/js/uploader/fileuploader.pack.js', array('jquery'), THEME_VERSION );
		wp_enqueue_script( MYSITE_PREFIX . '-jquery-tools', THEME_ADMIN_ASSETS_URI . '/js/jquery.tools.min.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MYSITE_PREFIX . '-admin-js', THEME_ADMIN_ASSETS_URI . '/js/admin.js', array( 'jquery' ), THEME_VERSION );
		
		wp_localize_script( MYSITE_PREFIX . '-admin-js', 'objectL10n', array(
			'resetConfirm' => __( 'This will restore all of your options to default. Are you sure?', MYSITE_ADMIN_TEXTDOMAIN ),
			'sidebarEmpty' => __( 'Please enter a name for your sidebar.', MYSITE_ADMIN_TEXTDOMAIN ),
			'sidebarDelete' => __( 'Are you sure you want to delete this sidebar?', MYSITE_ADMIN_TEXTDOMAIN ),
			'skinEmpty' => __( 'Please enter a name for your custom stylesheet in the &quot;Save Skin As&quot; field.', MYSITE_ADMIN_TEXTDOMAIN ),
			'skinOverwriteConfirm' => __( 'Are you sure you want to overwrite this stylesheet?', MYSITE_ADMIN_TEXTDOMAIN ),
			'skinDeleteConfirm' => __( 'Are you sure you want to delete this skin?', MYSITE_ADMIN_TEXTDOMAIN ),
			'skinUploading' => __( 'Uploading..', MYSITE_ADMIN_TEXTDOMAIN ),
			'skinUnziping' => __( 'Unziping..', MYSITE_ADMIN_TEXTDOMAIN ),
			'typeError' => sprintf( __( '%1$s has invalid extension. Only %2$s are allowed.', MYSITE_ADMIN_TEXTDOMAIN ), '{file}', '{extensions}' ),
			'l10n_print_after' => 'try{convertEntities(objectL10n);}catch(e){};'
		) );
	}
	
	if ( in_array( $hook,  array( 'post.php', 'post-new.php' ) ) ) {
		
		$url = THEME_URI;
		echo "<script type=\"text/javascript\">
		//<![CDATA[
			var mysiteAjaxUrl = '$url/lib/admin/ajax',
			    mysiteWpVersion = '$wp_version';
		//]]>\r</script>\r";
		
		wp_enqueue_style( MYSITE_PREFIX . '-admin', THEME_ADMIN_ASSETS_URI . '/css/admin.css', false, THEME_VERSION, 'screen' );
		wp_enqueue_style( MYSITE_PREFIX . '-colorpicker', THEME_ADMIN_ASSETS_URI .'/js/colorpicker/css/colorpicker.css', false, THEME_VERSION, 'screen' );
		
		wp_enqueue_script( MYSITE_PREFIX . 'colorpicker-script', THEME_ADMIN_ASSETS_URI .'/js/colorpicker/js/colorpicker.js', array('jquery'), THEME_VERSION );
		wp_enqueue_script( MYSITE_PREFIX . '-jquery-tools', THEME_ADMIN_ASSETS_URI . '/js/jquery.tools.min.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MYSITE_PREFIX . '-admin-js', THEME_ADMIN_ASSETS_URI . '/js/admin.js', array( 'jquery' ), THEME_VERSION );
		
		wp_localize_script( MYSITE_PREFIX . '-admin-js', 'objectL10n', array(
			'iconTbTitle' => __( 'Select a preset icon', MYSITE_ADMIN_TEXTDOMAIN ),
			'l10n_print_after' => 'try{convertEntities(objectL10n);}catch(e){};'
		) );
	}
	
}

/**
 *
 */
function mysite_admin_tinymce() {
	global $wp_version;
	
	if( version_compare( $wp_version, '3.3', '>=' ) )
		return;
	
	if( version_compare( $wp_version, '3.2', '<' ) )
		if (function_exists('wp_tiny_mce')) wp_tiny_mce();
	
	wp_enqueue_script( 'common' );
	wp_enqueue_script( 'jquery-color' );
	wp_print_scripts('editor');
	if (function_exists('add_thickbox')) add_thickbox();
	wp_print_scripts('media-upload');
	wp_admin_css();
	wp_enqueue_script('utils');
	do_action("admin_print_styles-post-php");
	do_action('admin_print_styles');
}

/**
 *
 */
function mysite_tiny_mce_before_init( $initArray ) {
	unset( $initArray['wp_fullscreen_content_css'] );
	$initArray['plugins'] = str_replace( ',wpfullscreen', '', $initArray['plugins'] );
	return $initArray;
}

/**
 *
 */
function mysite_admin_print_scripts() {
	echo "<script type=\"text/javascript\">
	//<![CDATA[
	jQuery(document).ready(function(){
		mysiteAdmin.menuSort();
	});
	//]]>\r</script>\r";
}

?>