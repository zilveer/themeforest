<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
//*******
add_action('wp_head', array('TMM_Ext_Demo', 'wp_head'), 1001);
add_action('admin_head', array('TMM_Ext_Demo', 'admin_head'), 1001);

//AJAX
add_action('wp_ajax_app_demo_create_theme_scheme', array('TMM_Ext_Demo', 'create_theme_scheme'));
add_action('wp_ajax_app_demo_upload_theme_scheme', array('TMM_Ext_Demo', 'upload_theme_scheme'));
add_action('wp_ajax_app_demo_delete_theme_scheme', array('TMM_Ext_Demo', 'delete_theme_scheme'));
add_action('wp_ajax_app_demo_edit_theme_scheme', array('TMM_Ext_Demo', 'edit_theme_scheme'));

//01-10-2013
class TMM_Ext_Demo {

	public static $css_files = array();

	public static function get_application_path() {
		return TMM_EXT_PATH . '/skin_composer';
	}

	public static function get_application_uri() {
		return TMM_EXT_URI . '/skin_composer';
	}

	public static function admin_head() {
		wp_enqueue_script('tmm_ext_demo_js', TMM_EXT_URI . '/skin_composer/js/admin.js', array('jquery'));
	}

	public static function wp_head() {

		if (!TMM::get_option('show_style_switcher')) {
			return;
		}
		wp_enqueue_script('tmm_ext_demo_js', TMM_EXT_URI . '/skin_composer/js/front.js', array('jquery'));
		wp_enqueue_style('tmm_ext_demo_css', TMM_EXT_URI . '/skin_composer/css/styles.css');
		?>
		<script type="text/javascript">
		<?php $data = self::get_theme_schemes(); ?>

			var tmm_demo_styles_list = {
		<?php if (!empty($data)): ?>
			<?php foreach ($data as $key => $value) : ?>
				<?php
				if ($key > 0) {
					echo ',';
				}
				?>
				<?php echo $key ?> : {
					className:'style_<?php echo $key ?>',
					css_file_link : '<?php echo TMM_Helper::get_upload_folder_uri() . 'theme_schemes/' . strtolower($value['key']) . '.css' ?>',
					icon_type : 'color',
					color : '<?php echo $value['color'] ?>',
					image_file : '',
					}
			<?php endforeach; ?>
		<?php endif; ?>
			};
		</script>

		<?php
	}

	private static function get_upload_folder() {
		$upload_folder = TMM_Helper::get_upload_folder();
		$upload_folder.="theme_schemes/";
		return $upload_folder;
	}

	//return schemes list $key=>$name
	public static function get_theme_schemes() {

		$upload_folder = self::get_upload_folder();

		//***
		if (!is_dir($upload_folder)) {
			return array();
		}
		//***

		$results = array();
		$handler = opendir($upload_folder);
		while ($file = readdir($handler)) {
			if ($file != "." AND $file != "..") {
				$ext = pathinfo($upload_folder . $file, PATHINFO_EXTENSION);
				if ($ext == 'data') {
					$content = file_get_contents($upload_folder . $file);
					if (empty($content)) {
						continue;
					}
					@$content = unserialize($content);
					if (is_array($content)) {
						$results[] = $content;
					}
				}
			}
		}
		//***
		sort($results, SORT_REGULAR);
		return $results;
	}

	//ajax
	public static function create_theme_scheme() {
		$upload_folder = TMM_Helper::get_upload_folder();
		$upload_folder.= "/";
		if (!file_exists($upload_folder)) {
			mkdir($upload_folder, 0775);
		}

		$upload_folder.="theme_schemes";
		if (!file_exists($upload_folder)) {
			mkdir($upload_folder, 0775);
		}
		//***
		$name = strtolower(sanitize_file_name($_REQUEST['name']));
		if (empty($name)) {
			exit;
		}

		//copy file style.css and rename it to $name.css
		copy(TMM_THEME_PATH . '/css/styles.css', $upload_folder . '/' . $name . '.css');
		//create file with js presets
		file_put_contents($upload_folder . '/' . $name . '.js', serialize($_REQUEST['js_data']));
		//scheme data
		$scheme_data = array(
			'key' => $name,
			'name' => $_REQUEST['name'],
			'color' => $_REQUEST['color'],
		);
		file_put_contents($upload_folder . '/' . $name . '.data', serialize($scheme_data));

		//***
		echo $name;
		exit;
	}

	public static function edit_theme_scheme() {
		$upload_folder = self::get_upload_folder();
		//copy(TMM_THEME_PATH . '/css/style.css', $upload_folder . $_REQUEST['key'] . '.css');
		file_put_contents($upload_folder . '/' . $_REQUEST['key'] . '.js', serialize($_REQUEST['js_data']));
		//scheme data
		if (!empty($_REQUEST['color'])) {
			$scheme_data = array(
				'key' => $_REQUEST['key'],
				'name' => (!empty($_REQUEST['new_name']) ? $_REQUEST['new_name'] : $_REQUEST['name']),
				'color' => $_REQUEST['color'],
			);
			file_put_contents($upload_folder . '/' . $_REQUEST['key'] . '.data', serialize($scheme_data));
		}

		exit;
	}

	//ajax
	public static function upload_theme_scheme() {
		$key = $_REQUEST['key'];

		if (empty($key)) {
			exit;
		}

		//***
		$upload_folder = self::get_upload_folder();
		$content = file_get_contents($upload_folder . $key . '.js');
		$content = unserialize($content);
		if (is_array($content)) {
			echo json_encode($content);
		}

		exit;
	}

	//ajax
	public static function delete_theme_scheme() {
		$upload_folder = self::get_upload_folder();
		unlink($upload_folder . '/' . $_REQUEST['key'] . '.css');
		unlink($upload_folder . '/' . $_REQUEST['key'] . '.js');
		unlink($upload_folder . '/' . $_REQUEST['key'] . '.data');
		exit;
	}

}

