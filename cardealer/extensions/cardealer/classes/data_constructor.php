<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Cardealer_DataConstructor {

	//ajax
	public static function add_data_group() {
		//*****
		$result = array();
		$result['errors'] = array();
		$result['data'] = array();
		//*****
		$name = str_replace('-', ' ', sanitize_file_name($_REQUEST['name']));
		$data_group_index = self::sanitize_string($_REQUEST['name']);

		if (!$data_group_index) {
			$data_group_index = 'dg_' . uniqid();
		}

		if (empty($data_group_index) OR empty($name)) {
			$result['errors'] = __('Incorrect group name', 'cardealer');
			echo json_encode($result);
			exit;
		}

		$data_groups = self::get_data_groups();

		if (!empty($data_groups)) {
			if (array_key_exists($name, $data_groups)) {
				$result['errors'] = __('Such name already exists', 'cardealer');
				echo json_encode($result);
				exit;
			}
		}

		$result['data_group_index'] = $data_group_index;
		//$result['data'] = __("Group added succsessfully", 'cardealer');
		$template_data = array();
		$template_data['data_group_index'] = $data_group_index;
		$template_data['name'] = $name;
		$result['template'] = TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/data_constructor/data_groups_list_item.php', $template_data);
		$result['template_data'] = TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/data_constructor/group_data.php', array('data_group_items' => $template_data, 'data_group_index' => $data_group_index));
		echo json_encode($result);
		exit;
	}

	public static function sanitize_string($string) {
		return str_replace('-', '_', sanitize_key($string));
	}

	public static function get_group_data($data_group_index) {
		$data_groups = self::get_data_groups();
		return $data_groups[$data_group_index];
	}

	public static function get_data_groups() {
		return TMM::get_option('data_groups', TMM_APP_CARDEALER_PREFIX);
	}

	//ajax
	public static function add_item_to_data_group() {
		$data = array(
			'data_group_index' => $_REQUEST['index'],
			'itemdata' => array(
				'type' => 'checkbox'
			),
		);
		echo TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/data_constructor/data_group_item_template.php', $data);
		exit;
	}
	//ajax
	public static function add_car_opt() {
		$data = array(
			'index' => $_REQUEST['index'],
			'key' => uniqid(),
			'value' => ''
		);
		echo TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/data_constructor/opts_group_item_template.php', $data);
		exit;
	}

}
