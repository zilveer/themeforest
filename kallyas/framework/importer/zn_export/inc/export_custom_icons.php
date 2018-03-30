<?php if(! defined('ABSPATH')){ return; }
if(!defined('ABSPATH')) {
	die("Don't call this file directly.");
}

if ( ! class_exists( 'ZnCustomIconsExport' ) ) {
	class ZnCustomIconsExport
	{

		private $file_name = 'custom_icons.txt';

		function __construct(){
		}

		function render_page() {
		}

		function do_deploy(){


		}

		function do_export(){

			$filename = 'all_custom_icons.zip';
//
//			header( 'Content-Description: File Transfer' );
//			header( 'Content-Disposition: attachment; filename=' . $filename );
//			header( 'Content-Type: application/zip; charset=' . get_option( 'blog_charset' ), true );

			$this->create_icon_zips( $filename );

			die();
		}

		function create_icon_zips( $archive_file_name ){

			$upload_dir = wp_upload_dir();
			$icons_folders = $upload_dir['basedir']. DIRECTORY_SEPARATOR . 'zn_fonts';

			$tmp_icons_folders = array();

			$main_zip = new ZipArchive();
			$main_zip_file_path = $upload_dir['basedir'] . DIRECTORY_SEPARATOR  . $archive_file_name;
			$main_zip->open($main_zip_file_path, ZIPARCHIVE::CREATE );

			$dirs = array_filter(glob($icons_folders.'/*'), 'is_dir');

			foreach( $dirs as $dir ){
				$files = new RecursiveIteratorIterator(
					new RecursiveDirectoryIterator($dir),
					RecursiveIteratorIterator::LEAVES_ONLY
				);

				$icon_name = basename($dir);
				$file_path = $upload_dir['basedir'] . DIRECTORY_SEPARATOR  . $icon_name.'.zip';
				$zip = new ZipArchive();
				$zip->open($file_path, ZIPARCHIVE::CREATE );
				foreach ($files as $name => $file)
				{
					// Skip directories (they would be added automatically)
					if (!$file->isDir())
					{
						// Get real and relative path for current file
						$filePath = $file->getRealPath();
						$relativePath = substr($filePath, strlen($icons_folders) + 1);

						// Add current file to archive
						$zip->addFile($filePath, $relativePath);
					}
				}
				$zip->close();
				$tmp_icons_folders[] = $file_path;
				$main_zip->addFile($file_path, $icon_name.'.zip');

			}
			$main_zip->close();
			header("Content-type: application/zip");
			header("Content-Disposition: attachment; filename=$archive_file_name");
			header("Pragma: no-cache");
			header("Expires: 0");
			readfile("$main_zip_file_path");
			unlink($main_zip_file_path);

			foreach( $tmp_icons_folders as $tmp_zip ){
				unlink($tmp_zip);
			}
			exit;
		}

	}
	
}


?>
