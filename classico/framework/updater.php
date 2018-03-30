<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Theme updater class
// **********************************************************************//

if(!function_exists('_et_theme_updater')) {
	function _et_theme_updater() {
		$updater = new ET_Theme_Updater();
		$updater->init();
	}
}

class ET_Theme_Updater {

	public $theme_name = 'classico';

	public $temp_dir;

	public $temp_file;

	public $destination_dir;

	/**
	 * Base properties
	 *
	 */

	public function __construct() {

	    $uploaddir = wp_upload_dir();

		$this->temp_dir = $uploaddir['basedir'];

		$this->temp_file = $uploaddir['basedir'] . DIRECTORY_SEPARATOR . $this->theme_name;

		$this->destination_dir = get_theme_root() . DIRECTORY_SEPARATOR . $this->theme_name;

		//add_action( 'wp_ajax_et_upload_zip', array($this, 'update_theme') );

	}

	/**
	 * Init method
	 *
	 */

	public function init() {
		$this->update_theme();
		//$updater->display_form();
	}

	/**
	 * Display upload file form
	 *
	 */

	public function display_form() {

	    ?>
			<h2>Update Your Theme</h2>
            <div class="theme-updater">
                <form id="update_zip_form" action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="theme_zip" id="theme_zip">
                    <input type="submit" name="submit-update-form" class="update_theme button button-primary" value="Update theme">
                </form>
            </div>
	    <?php

	}

	/**
	 * Proccess theme update
	 *
	 */
	public function update_theme() {

		if(!isset($_POST['submit-update-form'])) {
			$this->display_form();
			return;
		}

		$file_uploaded = false;

		$temp_file_path = '';

		if(isset($_POST['uploaded_file'])) {
			$file_uploaded = $_POST['uploaded_file'];
		}

    	$folder_name = 'classico';

		$results = array(
			'upload' => array(
				'status' => false,
				'full_path' => '',
				'filename' => ''
			),
			'successes' => array(),
			'errors' => array(),
			'form' => ''
		);

		// Upload zip file

		if(!$file_uploaded) {

			$results['upload'] = $this->upload_zip();


		    if($results['upload']['status'] && $results['upload']['full_path'] != '') {

		    	$temp_file_path = $results['upload']['full_path'];

				$_POST['uploaded_file'] = $results['upload']['filename'];

		    	//$results['successes'][] = 'ZIP file uploaded successfully.';

		    } else {
				$results['errors'] = $results['upload']['errors'];
		    	$this->send_response($results);
	    		return;

		    }
		} else {
			$temp_file_path = $this->temp_dir . DIRECTORY_SEPARATOR . $file_uploaded;
		}

		$url = admin_url( 'admin.php?page=_et_theme_updater' );

		ob_start();

		$creds = request_filesystem_credentials($url, 'ftp', false, false, array('submit-update-form', 'uploaded_file'));

        $results['form'] = ob_get_contents();

        ob_end_clean();

		if ( ! WP_Filesystem($creds) || ! $creds ) {

			$this->send_response($results);

			return;
		}

		// WP_Filesystem();


		// Extract files
		
	    $unzip_result = false;

    	$unzip_result = unzip_file($temp_file_path, $this->temp_dir);

    	if($unzip_result === true) {

    		$results['successes'][] = 'File unzipped correctly';

    	} else {

    		// WP_Error
    		$results['errors'] = $unzip_result->get_error_messages();

	    	$this->send_response($results);
    		return;
    	}

		// Replace current theme files with new

    	$replace_theme_files = $mkdir_result = false;

    	//Remove current theme folder and create new empty folder
    	$this->remove_dir($this->destination_dir);

    	$mkdir_result = wp_mkdir_p($this->destination_dir);

    	if(!$mkdir_result) {
    		$results['errors'][] = 'Can not create folder in wp-content/themes. Update your theme with FTP';
    		$this->send_response($results);
    		return;
    	}

    	$replace_theme_files = copy_dir($this->temp_file, $this->destination_dir);

    	$this->remove_dir($this->temp_file); // remove temp theme folder
    	$this->remove_dir($temp_file_path); // remove zip file


    	if($replace_theme_files) {
    		$results['successes'][] = 'Theme updated';
    	} else {
    		$results['errors']= $replace_theme_files->get_error_messages();
    		$results['errors'][] = 'Files can not be replaced with new. Maybe you have uploaded wrong zip file';

    		$this->send_response($results);
    		return;
    	}

    	$this->send_response($results);

	}

	/**
	 * Upload zip sent with AJAX ($_FILES)
	 *
	 * @return array
	 */
	public function upload_zip() {

	    $results = array();

	    $file_key = 'theme_zip';

		if (!empty($_FILES[$file_key])) {

		    $upload = ET_Upload::factory($this->temp_dir, '');

		    $upload->file($_FILES[$file_key]);

		    //set max. file size (in mb)
		    $upload->set_max_file_size(50);

		    //set allowed mime types
		    $upload->set_allowed_mime_types(array('application/zip', 'application/octet-stream'));

		    $results = $upload->upload();

		} else {

			$results['status'] = false;

			$results['errors'][] = 'Wrong file.';

		}

		return $results;
	}

	/**
	 * Function to remove folders and files 
	 *
	 * @param string $dir
	 */
    public function remove_dir($dir) {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file)
                if ($file != "." && $file != "..") $this->remove_dir("$dir/$file");
            rmdir($dir);
        }
        else if (file_exists($dir)) unlink($dir);
    }

	/**
	 * Send JSON response and die :(
	 *
	 * @param array $array
	 */
	public function send_response($array) {
		//pr($array);

		if(!empty($array['successes'])) {
			echo '<div class="updated">';
			foreach ($array['successes'] as $msg) {
				echo '<p>' . $msg . '</p>';
			}
			echo '</div>';
		}

		if(!empty($array['errors'])) {
			echo '<div class="error">';
			foreach ($array['errors'] as $msg) {
				echo '<p>' . $msg . '</p>';
			}
			echo '</div>';
		}

		if(!empty($array['form'])) {
			echo $array['form']; // display credentials form
		} else {
			$this->display_form(); // display file upload form
		}
	}
}


//$et_theme_updater = new ET_Theme_Updater();
//$et_theme_updater->init();



/**
 * Simple PHP upload class
 *
 * @author Aivis Silins
 */
class ET_Upload {


	/**
	 * Default directory persmissions (destination dir)
	 */
	protected $default_permissions = 750;


	/**
	 * File post array
	 *
	 * @var array
	 */
	protected $files_post = array();


	/**
	 * Destination directory
	 *
	 * @var string
	 */
	protected $destination;


	/**
	 * Fileinfo
	 *
	 * @var object
	 */
	protected $finfo;


	/**
	 * Data about file
	 *
	 * @var array
	 */
	public $file = array();


	/**
	 * Max. file size
	 *
	 * @var int
	 */
	protected $max_file_size;


	/**
	 * Allowed mime types
	 *
	 * @var array
	 */
	protected $mimes = array();


	/**
	 * External callback object
	 *
	 * @var obejct
	 */
	protected $external_callback_object;


	/**
	 * External callback methods
	 *
	 * @var array
	 */
	protected $external_callback_methods = array();


	/**
	 * Temp path
	 *
	 * @var string
	 */
	protected $tmp_name;


	/**
	 * Validation errors
	 *
	 * @var array
	 */
	protected $validation_errors = array();


	/**
	 * Filename (new)
	 *
	 * @var string
	 */
	protected $filename;


	/**
	 * Internal callbacks (filesize check, mime, etc)
	 *
	 * @var array
	 */
	private $callbacks = array();

	/**
	 * Root dir
	 *
	 * @var string
	 */
	protected $root;

	/**
	 * Return upload object
	 *
	 * $destination		= 'path/to/your/file/destination/folder';
	 *
	 * @param string $destination
	 * @param string $root
	 * @return Upload
	 */
	public static function factory($destination, $root = false) {

		return new ET_Upload($destination, $root);

	}


	/**
	 *  Define ROOT constant and set & create destination path
	 *
	 * @param string $destination
	 * @param string $root
	 */
	public function __construct($destination, $root = false) {

		if ($root) {

			$this->root = $root;

		}

		// set & create destination path
		if (!$this->set_destination($destination)) {

			throw new Exception('Upload: Can\'t create destination. '.$this->root . $this->destination);

		}

		//create finfo object
		$this->finfo = new finfo();

	}

	/**
	 * Set target filename
	 *
	 * @param string $filename
	 */
	public function set_filename($filename) {

		$this->filename = $filename;

	}

	/**
	 * Check & Save file
	 *
	 * Return data about current upload
	 *
	 * @return array
	 */
	public function upload($filename = '') {

		if ($this->check()) {

			$this->save();

		}

		// return state data
		return $this->get_state();

	}


	/**
	 * Save file on server
	 *
	 * Return state data
	 *
	 * @return array
	 */
	public function save() {

		$this->save_file();

		return $this->get_state();

	}


	/**
	 * Validate file (execute callbacks)
	 *
	 * Returns TRUE if validation successful
	 *
	 * @return bool
	 */
	public function check() {

		//execute callbacks (check filesize, mime, also external callbacks
		$this->validate();

		//add error messages
		$this->file['errors'] = $this->get_errors();

		//change file validation status
		$this->file['status'] = empty($this->validation_errors);

		return $this->file['status'];

	}


	/**
	 * Get current state data
	 *
	 * @return array
	 */
	public function get_state() {

		return $this->file;

	}


	/**
	 * Save file on server
	 */
	protected function save_file() {

		//create & set new filename
		if(empty($this->filename)){
			$this->create_new_filename();
		}

		//set filename
		$this->file['filename']	= $this->filename;

		//set full path

		$this->file['full_path'] = $this->root . $this->destination . $this->filename;
        $this->file['path'] = $this->destination . $this->filename;

		$status = move_uploaded_file($this->tmp_name, $this->file['full_path']);

		//checks whether upload successful
		if (!$status) {
			throw new Exception('Upload: Can\'t upload file.');
		}

		//done
		$this->file['status']	= true;

	}


	/**
	 * Set data about file
	 */
	protected function set_file_data() {

		$file_size = $this->get_file_size();

		$this->file = array(
			'status'				=> false,
			'destination'			=> $this->destination,
			'size_in_bytes'			=> $file_size,
			'size_in_mb'			=> $this->bytes_to_mb($file_size),
			'mime'					=> $this->get_file_mime(),
			'original_filename'		=> $this->file_post['name'],
			'tmp_name'				=> $this->file_post['tmp_name'],
			'post_data'				=> $this->file_post,
		);

	}

	/**
	 * Set validation error
	 *
	 * @param string $message
	 */
	public function set_error($message) {

		$this->validation_errors[] = $message;

	}


	/**
	 * Return validation errors
	 *
	 * @return array
	 */
	public function get_errors() {

		return $this->validation_errors;

	}


	/**
	 * Set external callback methods
	 *
	 * @param object $instance_of_callback_object
	 * @param array $callback_methods
	 */
	public function callbacks($instance_of_callback_object, $callback_methods) {

		if (empty($instance_of_callback_object)) {

			throw new Exception('Upload: $instance_of_callback_object can\'t be empty.');

		}

		if (!is_array($callback_methods)) {

			throw new Exception('Upload: $callback_methods data type need to be array.');

		}

		$this->external_callback_object	 = $instance_of_callback_object;
		$this->external_callback_methods = $callback_methods;

	}


	/**
	 * Execute callbacks
	 */
	protected function validate() {

		//get curent errors
		$errors = $this->get_errors();

		if (empty($errors)) {

			//set data about current file
			$this->set_file_data();

			//execute internal callbacks
			$this->execute_callbacks($this->callbacks, $this);

			//execute external callbacks
			$this->execute_callbacks($this->external_callback_methods, $this->external_callback_object);

		}

	}


	/**
	 * Execute callbacks
	 */
	protected function execute_callbacks($callbacks, $object) {

		foreach($callbacks as $method) {

			$object->$method($this);

		}

	}


	/**
	 * File mime type validation callback
	 *
	 * @param obejct $object
	 */
	protected function check_mime_type($object) {

		if (!empty($object->mimes)) {

			if (!in_array($object->file['mime'], $object->mimes)) {

				$object->set_error('Mime type not allowed.');

			}

		}

	}


	/**
	 * Set allowed mime types
	 *
	 * @param array $mimes
	 */
	public function set_allowed_mime_types($mimes) {

		$this->mimes		= $mimes;

		//if mime types is set -> set callback
		$this->callbacks[]	= 'check_mime_type';

	}


	/**
	 * File size validation callback
	 *
	 * @param object $object
	 */
	protected function check_file_size($object) {

		if (!empty($object->max_file_size)) {

			$file_size_in_mb = $this->bytes_to_mb($object->file['size_in_bytes']);

			if ($object->max_file_size <= $file_size_in_mb) {

				$object->set_error('File is too big.');

			}

		}

	}


	/**
	 * Set max. file size
	 *
	 * @param int $size
	 */
	public function set_max_file_size($size) {

		$this->max_file_size	= $size;

		//if max file size is set -> set callback
		$this->callbacks[]	= 'check_file_size';

	}


	/**
	 * Set File array to object
	 *
	 * @param array $file
	 */
	public function file($file) {

		$this->set_file_array($file);

	}


	/**
	 * Set file array
	 *
	 * @param array $file
	 */
	protected function set_file_array($file) {

		//checks whether file array is valid
		if (!$this->check_file_array($file)) {

			//file not selected or some bigger problems (broken files array)
			$this->set_error('Please select file.');

		}

		//set file data
		$this->file_post = $file;

		//set tmp path
		$this->tmp_name  = $file['tmp_name'];

	}


	/**
	 * Checks whether Files post array is valid
	 *
	 * @return bool
	 */
	protected function check_file_array($file) {

		return isset($file['error'])
			&& !empty($file['name'])
			&& !empty($file['type'])
			&& !empty($file['tmp_name'])
			&& !empty($file['size']);

	}


	/**
	 * Get file mime type
	 *
	 * @return string
	 */
	protected function get_file_mime() {

		return $this->finfo->file($this->tmp_name, FILEINFO_MIME_TYPE);

	}


	/**
	 * Get file size
	 *
	 * @return int
	 */
	protected function get_file_size() {

		return filesize($this->tmp_name);

	}


	/**
	 * Set destination path (return TRUE on success)
	 *
	 * @param string $destination
	 * @return bool
	 */
	protected function set_destination($destination) {

		$this->destination = $destination . DIRECTORY_SEPARATOR;

		return $this->destination_exist() ?: $this->create_destination();

	}


	/**
	 * Checks whether destination folder exists
	 *
	 * @return bool
	 */
	protected function destination_exist() {

		return is_writable($this->destination);

	}


	/**
	 * Create path to destination
	 *
	 * @param string $dir
	 * @return bool
	 */
	protected function create_destination() {

		return mkdir($this->root . $this->destination, $this->default_permissions, true);

	}


	/**
	 * Set unique filename
	 *
	 * @return string
	 */
	protected function create_new_filename() {

		$filename = sha1(mt_rand(1, 9999) . $this->destination . uniqid()) . $this->file_post['name'];
		$this->set_filename($filename);

	}


	/**
	 * Convert bytes to mb.
	 *
	 * @param int $bytes
	 * @return int
	 */
	protected function bytes_to_mb($bytes) {

		return round(($bytes / 1048576), 2);

	}


} // end of Upload