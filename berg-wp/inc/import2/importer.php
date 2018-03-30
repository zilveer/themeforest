<?php
if (!function_exists ('add_action')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');

	exit();
}

// require_once(ABSPATH . '/wp-load.php');
require_once(ABSPATH . '/wp-admin/includes/media.php');
require_once(ABSPATH . '/wp-admin/includes/file.php');
require_once(ABSPATH . '/wp-admin/includes/image.php');

class Demo_Importer {

	public $message = "";
	public $attachments = false;
	public $imagesURL = "";

	public function show_import() {
	?>
	<form method="post" action="" id="importContentForm">
		<table class="form-table">
			<tbody>
				<tr class="form-field">
					<td scope="row" colspan="2">
						<div class="import_load">
							<span>
							<h4>This import will replace all your content with our. It will <span style="text-decoration: underline">delete all posts/pages/menus</span> and then import it from demo.</h4>
							</span>
							<span><?php _e('The import process may take some time. Please be patient.', 'BERG'); ?> </span>
							<br /><br/>
						</div>
					</td>
				</tr>
				<tr class="form-field" valign="top">
					<th><label for="import_demo">Demo Site</label></th>
					<td>
						<select name="import_demo" id="import_demo">
							<option value="demo1">Demo 1</option>
							<option value="demo2" selected>Demo 2 - v2</option>
						</select>
						<br/>
					</td>
				</tr>
				<tr class="form-field">
					<td scope="row" colspan="2">
						<div class="import_load">
							<br/>
							<div class="html5-progress-bar">
								<div class="progress-bar-wrapper">
									<progress id="progressbar" value="0" max="100"></progress>
								</div>
								<div class="progress-value">0%</div>
								<div class="progress-bar-message">
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr class="form-field">
					<td colspan="2">
						<br/>
						<input type="submit" class="button button-primary" value="Import" name="import" id="import_demo_data" />
					</td>
				</tr>

			</tbody>
		</table>
	</form>

	<script type="text/javascript">
		jQuery(document).ready(function() {

			jQuery(document).on('click', '#import_demo_data', function(e) {
				e.preventDefault();

				if (confirm('Make sure you activated recommended plugins! Are you sure, you want to import Demo Data now ? ')) {
					jQuery('#redux_ajax_overlay').show(0);
					jQuery('.import_load').css('display','block');

					var progressbar = jQuery('#progressbar');
					var import_demo = 'demo2';
					import_demo = document.getElementById('import_demo').value;
					jQuery('.progress-value').html((50) + '%');
					progressbar.val(50);
					jQuery.ajax({
						type: 'POST',
						url: ajaxurl,
						data: {
							action: 'yopress_import',
							demo: import_demo
						},
						success: function(data, textStatus, XMLHttpRequest) {
							jQuery('.progress-value').html((75) + '%');
							progressbar.val(75);
							setTimeout(function(){
								jQuery('.progress-bar-message').html('<div class="alert alert-success">Import is completed.</div>');
								jQuery('.progress-value').html((100) + '%');
								progressbar.val(100);
								document.location.reload();
							}, 3000);

						},
						error: function(MLHttpRequest, textStatus, errorThrown){
						}
					});
				}

				return false;
			});
		});
	</script>
	<?php
	}

	public function import($file) {
		global $wpdb;

		$file_content = "";
		$file_for_import = get_template_directory() . '/inc/import2/files/' . $file;
		
		if (file_exists($file_for_import)) {
			$file_content = $this->yopress_file_contents($file_for_import);
		} else {
			$this->message = __("File doesn't exist", 'BERG');
		}

		if ($file_content) {
			$prefix = $wpdb->prefix;
			$site_url = site_url();

			$theme_name = get_template_directory_uri();
			$themeName = explode('/', $theme_name);
			$theme_name = $themeName[count($themeName)-1];

			if (substr($site_url, -1) != '/') {
				$site_url = $site_url . "/";
			}

			// yopress
			if (is_child_theme()) {
				$file_content = str_replace('[::theme_mods::]', 'theme_mods_berg-wp-child', $file_content);
			} else {
				$file_content = str_replace('[::theme_mods::]', 'theme_mods_berg-wp', $file_content);
			}

			// replace database prefix
			$file_content = str_replace('[::prefix::]', $prefix, $file_content);
			// replace site url
			$file_content = str_replace('[::site_url::]', $site_url, $file_content);
			//replace year and month

			$file_content = str_replace('[::year::]', date('Y'), $file_content);
			$file_content = str_replace('[::month::]', date('m'), $file_content);

			$file_content = str_replace('[::theme_name::]', $theme_name, $file_content);

			$dbhost = DB_HOST;
			$dbport = 3306;

			if (strstr($dbhost, '.sock', true)) {
				//localhost:/tmp/mysql5d.sock
				$s = explode(':', $dbhost);
				$dbhost = $s[0];
				$socket = $s[1];
				$link = mysqli_connect($dbhost, DB_USER, DB_PASSWORD, DB_NAME, 3306, $socket);
			} else {
				$parts = explode(":", $dbhost);

				if (isset($parts[0])) {
					$dbhost = $parts[0];	
				} else {
					$dbhost = DB_HOST;
				}
				
				if (isset($parts[1])) {
					$dbport = intval($parts[1]);
				} else {
					$dbport = 3306;
				}

				$link = mysqli_connect($dbhost, DB_USER, DB_PASSWORD, DB_NAME, $dbport);
			}

			/* check connection */
			if (mysqli_connect_errno()) {
			    printf("Connect failed: %s\n", mysqli_connect_error());
			    exit();
			}

			/* execute multi query */
			if (mysqli_multi_query($link, $file_content)) {
				 echo "Success\n\n";
				 echo "$file_content";
			} else {
				 echo "Fail";
			}





			$imageSizes = array('1000x600', '1024x682', '1440x900', '150x150', '300x199', '300x300', '400x400', '500x500', '90x90');

			// check if file exists

			for ($i=1;$i<=5;$i++) {

				$remoteURL = $this->imagesURL .'bergdemo'. $i . '.jpg';
				$uploadDir = wp_upload_dir();

				$localImgPath = $uploadDir['path'] . '/bergdemo' . $i . '.jpg';

				$sizes = array(
					array('width'=>1000, 'height'=>600, 'crop'=>true),
					array('width'=>1000, 'height'=>400, 'crop'=>true),
					array('width'=>1024, 'height'=>682, 'crop'=>true),
					array('width'=>1440, 'height'=>900, 'crop'=>true),
					array('width'=>150, 'height'=>150, 'crop'=>true),
					array('width'=>300, 'height'=>199, 'crop'=>true),
					array('width'=>300, 'height'=>300, 'crop'=>true),
					array('width'=>400, 'height'=>400, 'crop'=>true),
					array('width'=>500, 'height'=>300, 'crop'=>true),
					array('width'=>90, 'height'=>90, 'crop'=>true),
				);

				if (!file_exists($localImgPath)) {
					if (file_put_contents($localImgPath, file_get_contents($remoteURL))) {

						$image = wp_get_image_editor($localImgPath);

						if (!is_wp_error($image)) {
							$image->multi_resize($sizes);
						} else {
							echo "is_wp_error!";
						}

						echo "file put content ok $localImgPath";
					} else {
						echo "error file_put_contents $localImgPath";
					}
				}
			}
		}
	}

	public function import_redux($file) {
		$file_content = "";
		$file_for_import = get_template_directory() . '/inc/import2/files/' . $file;
		
		if (file_exists($file_for_import)) {
			$file_content = $this->yopress_file_contents($file_for_import);
		} else {
			$this->message = __("File doesn't exist", 'BERG');
		}
		if ($file_content) {
			$file_content = json_decode($file_content, true);
			update_option('redux', $file_content, 'yes');
			update_option('redux-migrate', 'yes', 'yes');
		}
	}

	public function file_options($file) {
		$file_content = "";
		$file_for_import = get_template_directory() . '/inc/import2/files/' . $file;

		if (file_exists($file_for_import)) {
			$file_content = $this->yopress_file_contents($file_for_import);
		} else {
			$this->message = __("File doesn't exist", 'BERG');
		}

		if ($file_content) {
			$unserialized_content = unserialize(base64_decode($file_content));

			if ($unserialized_content) {
				return $unserialized_content;
			}
		}

		return false;
	}

	function yopress_file_contents($path) {
		$yopress_content = '';

		if (function_exists('realpath')) {
			$filepath = realpath($path);
		}
			
		if (!$filepath || !@is_file($filepath)) {
			return '';
		}

		if (ini_get('allow_url_fopen')) {
			$yopress_file_method = 'fopen';
		} else {
			$yopress_file_method = 'file_get_contents';
		}

		if ($yopress_file_method == 'fopen') {
			$yopress_handle = fopen($filepath, 'rb');

			if ($yopress_handle !== false) {
				while (!feof($yopress_handle)) {
					$yopress_content .= fread($yopress_handle, 8192);
				}

				fclose($yopress_handle);
			}

			return $yopress_content;
		} else {
			return file_get_contents($filepath);
		}
	}

}

?>