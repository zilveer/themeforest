<?php if(! defined('ABSPATH')){ return; }
if(!defined('ABSPATH')) {
	die("Don't call this file directly.");
}

if ( ! class_exists( 'ZnMediaExporter' ) ) {
	class ZnMediaExporter
	{
		function __construct(){
		}

		function render_page() {

			//echo count( $this->get_images() );

		?>
	
<!-- 				<div class="wp-filter">
					<div class="actions">
						<h4>Options : </h4>
						<label class="action"> 
							<input name="replace_images" checked type="checkbox" value="true"/>
							Replace images url ?
						</label>
					</div>
				</div> -->

				
		<?php
		}

		function do_deploy(){
			$upload_dir = wp_upload_dir();
			$images = $this->get_images();
			//add each files of $file_name array to archive
			foreach( $images as $file )
			{

				$image_path = get_attached_file( $file->ID, true );
				$image_path = realpath($image_path);
				$name = str_replace( 'wp-content' , 'zn-content' , $image_path );
	
				$new_file_path = pathinfo( $name );

				if (!file_exists($new_file_path['dirname'])) {
					mkdir($new_file_path['dirname'], 0777, true);
				}

				copy($image_path, $name);

			}
		}

		function do_export(){

			$filename = 'all_images.zip';

			header( 'Content-Description: File Transfer' );
			header( 'Content-Disposition: attachment; filename=' . $filename );
			header( 'Content-Type: application/zip; charset=' . get_option( 'blog_charset' ), true );

			$images = $this->get_images();

			if ( empty( $images ) ) { return; }

			$this->zipFilesAndDownload( $images, $filename );

			die();
		}

		function get_images(){
			$args = array(
				'post_type' => 'attachment',
				'numberposts' => -1,
				'post_status' => null, // Can be set to null
				'post_parent' => null, // any parent
				'order'	=> 'ASC'
			);

			return get_posts($args);
		}

		function generate_image( $src ){

			// Don't do anything if this is not an image
			if( ! list($width, $height) = getimagesize($src)) return false;

			$type = strtolower(substr(strrchr($src,"."),1));
			if($type == 'jpeg') { $type = 'jpg'; }

			switch($type){
				case 'bmp': $img = imagecreatefromwbmp($src); break;
				case 'gif': $img = imagecreatefromgif($src); break;
				case 'jpg': $img = imagecreatefromjpeg($src); break;
				case 'png': $img = imagecreatefrompng($src); break;
				default : return "Unsupported picture type!";
			}

			// Return if no image
			if( empty( $img ) ) { return false; }

			// We have an image,let's apply a filter
		//	imagefilter( $img, IMG_FILTER_GAUSSIAN_BLUR );
			imagefilter( $img, IMG_FILTER_PIXELATE, 10, true );

			$new = imagecreatetruecolor($width, $height);

			// preserve transparency
			if($type == "gif" or $type == "png"){
				imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
				imagealphablending($new, false);
				imagesavealpha($new, true);
			}

			imagecopyresampled( $new, $img, 0, 0, $x, 0, $width, $height, $width, $height );

			ob_start();
				switch( $type ){
					case 'bmp': imagewbmp($new); break;
					case 'gif': imagegif($new); break;
					case 'jpg': imagejpeg($new); break;
					case 'png': imagepng($new); break;
				}
			$stringdata = ob_get_clean();

			// Free memory
			imagedestroy($img);
			imagedestroy($new);
			
			if( ! empty( $stringdata ) ){
				return $stringdata;
			}
			else {
				return false;
			}
			
		}

		function zipFilesAndDownload( $files, $archive_file_name )
		{
			$upload_dir = wp_upload_dir();

			$file_path = $upload_dir['basedir'] . DIRECTORY_SEPARATOR  . $archive_file_name;
			$zip = new ZipArchive();
			//create the file and throw the error if unsuccessful
			if ($zip->open($file_path, ZIPARCHIVE::CREATE )!==TRUE) {
				die("cannot open <$archive_file_name>\n");
			}
			//add each files of $file_name array to archive
			foreach( $files as $file )
			{

				$image_path = get_attached_file( $file->ID );
				$name = str_replace( trailingslashit( $upload_dir['basedir']) , '' , $image_path );
				$name = 'zn-content' .DIRECTORY_SEPARATOR .'uploads' . DIRECTORY_SEPARATOR . $name;
				
				// Check and Get the modified image
				// $resampled_image = $this->generate_image( $image_path );

				// if( ! empty( $resampled_image ) ) {
				// 	$zip->addFromString( $name, $resampled_image );
				// }
				// else {
					$zip->addFile( $image_path, $name );
				// }

			   

			}
			$zip->close();
			//then send the headers to foce download the zip file
			header("Content-type: application/zip"); 
			header("Content-Disposition: attachment; filename=$archive_file_name"); 
			header("Pragma: no-cache"); 
			header("Expires: 0"); 
			readfile("$file_path");
			unlink($file_path); 
			exit;
		}

	}
	
}


?>
