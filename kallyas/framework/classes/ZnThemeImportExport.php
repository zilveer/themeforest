<?php

/**
 * Created by PhpStorm.
 * User: kos
 * Date: 6/3/2016
 * Time: 4:33 PM
 */
class ZnThemeImportExport
{
	/**
	 * Holds the ZipArchive object
	 * @var array
	 */
	var $zip;

	/**
	 * Holds the wp_upload_dir() paths
	 * @var array
	 */
	var $upload_dir_config;

	/**
	 * Holds the uploads directory url
	 * @var string
	 */
	var $upload_dir_url;

	/**
	 * Holds the uploads directory url without WWW
	 * @var string
	 */
	var $upload_dir_url_no_www;

	/**
	 * Holds the uploads directory path
	 * @var string
	 */
	var $upload_dir_path;

	/**
	 * Holds the uploads placeholder used for replacing the uploads urls
	 * @var string
	 */
	var $site_url_placeholder = 'ZN_SITE_URL_PLACEHOLDER';

	/**
	 * Holds the name of the export archive
	 * @var string
	 */
	var $export_file_name = 'theme_options_export.zip';

	// Holds the list of images to get for export
	private $_imagesList = array();


	public function __construct()
	{
		$this->upload_dir_config = wp_upload_dir();
		$this->upload_dir_path = $this->upload_dir_config['basedir'];
		$this->upload_dir_url = $this->upload_dir_config['baseurl'];
		$this->upload_dir_url_no_www = str_replace('www.', '', $this->upload_dir_url );

		add_action( 'wp_ajax_zn_theme_export', array($this, 'ajax_theme_options_export') );
		add_action( 'wp_ajax_zn_theme_export_download', array($this, 'zn_download_theme_options_archive') );
		add_action( 'wp_ajax_zn_theme_options_import', array($this, 'ajax_theme_options_import') );
	}



	/**
	 * This function is used by the theme export to replace the site url with a placeholder
	 * @internal
	 * @param mixed $arrayValue
	 * @param null  $arrayKeyIndex
	 */
	public function _replaceUrlWithPlaceholder( &$arrayValue, $arrayKeyIndex = null)
	{
		$uploadUrl = $this->upload_dir_url;
		if($uploadUrl){
			if (false !== stristr($arrayValue, $uploadUrl)){
				$t = $arrayValue = str_ireplace($uploadUrl, $this->site_url_placeholder, $arrayValue);
				array_push($this->_imagesList, $t);
			}
		}
	}

	/**
	 * This function is used by the theme import to replace the placeholder with the site url
	 * @internal
	 * @param mixed $arrayValue
	 * @param null  $arrayKeyIndex
	 */
	public function _replacePlaceholderWithUrl( &$arrayValue, $arrayKeyIndex = null)
	{
		$uploadUrl = $this->upload_dir_url;
		if($uploadUrl){
			if (false !== stristr($arrayValue, $this->site_url_placeholder)){
				$arrayValue = str_ireplace($this->site_url_placeholder, $uploadUrl, $arrayValue);
			}
		}
	}


	function ajax_theme_options_export()
	{
		check_ajax_referer( 'zn_framework', 'zn_ajax_nonce' );

		$exportImages = false;
		if(isset($_POST['data']['export_images']) && ('true' == $_POST['data']['export_images'])){
			$exportImages = true;
		}

		if(! class_exists('ZipArchive')){
			wp_send_json_error( __( 'Error: ZipArchive class is not installed on your server.', 'zn_framework' ) );
		}

		// Create the export archive

		// Set the location where we'll save the export file
		$export_path = trailingslashit( $this->upload_dir_path ) . $this->export_file_name;

		// Create and open the archive
		$this->zip = new ZipArchive();
		$success = $this->zip->open( $export_path, ZIPARCHIVE::CREATE | ZipArchive::OVERWRITE);

		if( $success !== true ) {
			wp_send_json_error( __( 'Error: Could not create the export archive.', 'zn_framework' ) );
		}

		// Add the db options
		$dbOptions = get_option('zn_kallyas_optionsv4');

		// If we need to export images, then we need to set the placeholder
		if($exportImages){
			array_walk_recursive( $dbOptions, array($this, '_replaceUrlWithPlaceholder') );

			// Check for images
			if(! empty($this->_imagesList))
			{
				foreach($this->_imagesList as $imagePath)
				{
					// Remove the placeholder
					$imagePath = str_replace($this->site_url_placeholder, '', $imagePath);

					// Normalize path
					$imagePath = preg_replace('!\\+!', '/', $imagePath);

					// Add the image to archive
					$this->zip->addFile( $this->upload_dir_path.$imagePath, 'images'.$imagePath );
				}
			}
		}

		// Export fonts as well
		$fontsDir = ZnIconManager::get_custom_fonts();
		if(! empty($fontsDir))
		{
			$this->zip->addEmptyDir('zn_fonts');
			$fontArchives = array();
			foreach($fontsDir as $dirName => $dirInfo)
			{
				// Create an archive out of a font dir
				$fontDirPath = $dirInfo['filepath'].$dirName;
				if(is_dir($fontDirPath)){
					$fontArchivePath = $fontDirPath.'.zip';
					$files = scandir($fontDirPath);
					if(! empty($files)){
						$z = new ZipArchive();
						$z->open($fontArchivePath, ZIPARCHIVE::CREATE | ZipArchive::OVERWRITE);
						foreach($files as $filePath){
							if($filePath != '.' && $filePath != '..'){
								$z->addFile($fontDirPath.'/'.$filePath, $filePath);
							}
						}
						$z->close();
						if(is_file($fontArchivePath)) {
							$this->zip->addFile( $fontArchivePath, 'zn_fonts/'. basename($dirName).'.zip' );
							array_push($fontArchives, $fontArchivePath);
						}
					}
				}
			}
		}

		// Add the database options to the archive
		$this->zip->addFromString( 'db_options.info', serialize($dbOptions) );

		// Close the archive
		$this->zip->close();

		// Cleanup
		if(! empty($fontArchives)){
			foreach($fontArchives as $path){
				if(is_file($path)) {
					unlink( $path );
				}
			}
		}

		// Send response
		wp_send_json_success(__('Done', 'zn_framework'));
	}

	function ajax_theme_options_import()
	{
		check_ajax_referer( 'zn_framework', 'zn_ajax_nonce' );

		if(! isset($_POST['data'])){
			wp_send_json_error(__('Error: Invalid Request.', 'zn_framework'));
		}
		if(! isset($_POST['data']['url']) || empty($_POST['data']['url'])){
			wp_send_json_error(__('Error: Invalid Request. URL is missing.', 'zn_framework'));
		}

		// Copy the archive to the uploads directory
		$fileUrl = esc_url($_POST['data']['url']);

		// Get the uploads directory path
		$uploadDir = trailingslashit( $this->upload_dir_path );

		// Copy the archive
		$archiveTempPath = $uploadDir.'kallyas-theme-options.zip';
		$copied = copy($fileUrl, $archiveTempPath);
		if(false === $copied){
			wp_send_json_error(__('An error occurred while trying to copy the archive file.', 'zn_framework'));
		}

		// Open the archive
		$zip = new ZipArchive();
		$opened = $zip->open($archiveTempPath);
		if(false === $opened){
			wp_send_json_error(__('An error occurred while trying to open the archive file.', 'zn_framework'));
		}

		// Extract archive to a temp directory
		$tmpDir = $uploadDir.'kallyas-theme-options';
		$zip->extractTo($tmpDir);
		$zip->close();

		// Check the tmp directory
		if(! is_dir($tmpDir)){
			wp_send_json_error(__('An error occurred while trying to open the temporary directory.', 'zn_framework'));
		}

		// Setup paths
		$imagesDir = $tmpDir.'/images/';
		$fontsDir = $tmpDir.'/zn_fonts/';
		$dbOptionsFile = $tmpDir.'/db_options.info';
		$files = null;

		// Copy images if any
		if(is_dir($imagesDir))
		{
			$files = scandir($imagesDir);
			if($files)
			{
				// Set the list of special directories to ignore
				$ignore = array('.', '..');
				foreach($files as $entry)
				{
					if(in_array($entry, $ignore)){
						continue;
					}
					$this->recursiveFileCopy($imagesDir.$entry, $uploadDir.$entry);
				}
			}
		}

		// Copy fonts if any
		if(is_dir($fontsDir))
		{
			$files = scandir($fontsDir);
			if($files)
			{
				// Set the list of special directories to ignore
				$ignore = array('.', '..');
				foreach($files as $entry)
				{
					if(in_array($entry, $ignore)){
						continue;
					}
					// Import all fonts found
					$znIconMgr = new ZnIconManager();
					$fontArchivePath = $fontsDir.$entry;
					$fontArchiveTitle = basename($entry, '.zip');
					$znIconMgr->do_icon_install($fontArchivePath, $fontArchiveTitle);
				}
			}
		}

		// Update options
		$dbOptions = file_get_contents($dbOptionsFile);
		if(! empty($dbOptions)) {
			$data = maybe_unserialize($dbOptions);
			if(! empty($data) && is_array($data)) {
				// Replace placeholder with the site url
				array_walk_recursive( $data, array($this, '_replacePlaceholderWithUrl') );
				// Save option in database
				delete_option('zn_kallyas_optionsv4');
				add_option( 'zn_kallyas_optionsv4', $data );
			}
		}

		//#!++ Cleanup
		// Remove temp archive
		@unlink($archiveTempPath);
		// Delete the temp directory and its subdirectories/files
		if(class_exists('RecursiveDirectoryIterator')) {
			$it    = new RecursiveDirectoryIterator( $tmpDir, RecursiveDirectoryIterator::SKIP_DOTS );
			$files = new RecursiveIteratorIterator( $it, RecursiveIteratorIterator::CHILD_FIRST );
			if ( $files ) {
				foreach ( $files as $file ) {
					$fp = $file->getRealPath();
					if ( $file->isDir() ) {
						rmdir( $fp );
					}
					else {
						unlink( $fp );
					}
				}
			}
			rmdir( $tmpDir );
		}
		//#!-- Cleanup

		wp_send_json_success(__('Theme options imported successfully.', 'zn_framework'));
	}

	/**
	 * This function will start the download for the exported archive
	 * @internal
	 */
	public function zn_download_theme_options_archive()
	{
		check_ajax_referer( 'zn_framework', 'nonce' );

		$export_file = trailingslashit( $this->upload_dir_path ) . $this->export_file_name;
		if(! is_file($export_file)){
			wp_send_json_error(__('Error: Could not locate the export archive', 'zn_framework'));
		}
		if(! headers_sent()) {
			header( "Content-type: application/zip" );
			header( "Content-Disposition: attachment; filename=" . $this->export_file_name );
			header( "Pragma: no-cache" );
			header( "Expires: 0" );
		}
		readfile($export_file);

		// Delete file after sending it to user
		@unlink($export_file);

		wp_send_json_success(__('Done', 'zn_framework'));
	}

	/**
	 * This function will recursively create the directory structure in the $destination directory while extracting
	 * the information from the $source directory. Used by the import system.
	 *
	 * @param $source
	 * @param $destination
	 */
	public function recursiveFileCopy( $source, $destination )
	{
		$dir = opendir($source);
		@mkdir($destination);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($source . '/' . $file) ) {
					$this->recursiveFileCopy($source . '/' . $file, $destination . '/' . $file);
				}
				else {
					copy($source . '/' . $file, $destination . '/' . $file);
				}
			}
		}
		closedir($dir);
	}
}
new ZnThemeImportExport();
