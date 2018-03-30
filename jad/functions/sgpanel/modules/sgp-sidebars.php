<?php

/* Load Default Sidebars List */
require_once SG_TEMPLATEPATH . '/functions/apperance/sidebars.php';

class SGP_Sidebars_Module {

	const moduleName = 'Sidebars';

	protected static $instance;

	protected static $_params = array(
		'show_default_sidebars' => TRUE,
		'show_user_sidebars' => TRUE,
	);

	private function __construct() {}
	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SGP_Sidebars_Module;
		}
		return self::$instance;
	}

	public function inited()
	{
		return TRUE;
	}

	public function setVars($post_data)
	{
		if (isset($post_data['sgp_sidebars'])) {
			$sidebars = array();
			$post_sidebars = (empty($post_data['sgp_sidebars_name'])) ? array() : $post_data['sgp_sidebars_name'];
			foreach ($post_sidebars as $num => $name) {
				if (!empty($name)) {
					$name = trim($name);
					$id = str_replace(' ', '_', strtolower($name));
					$sidebars[$id] = array(
						'name' => $name,
						'desc' => $post_data['sgp_sidebars_desc'][$num],
						'pos' => $post_data['sgp_sidebars_pos'][$num],
					);
				}
			}
			if (empty($sidebars)) {
				delete_option(SG_SLUG . 'sgp_' . self::moduleName);
			} else {
				update_option(SG_SLUG . 'sgp_' . self::moduleName, $sidebars);
			}
		}

		return TRUE;
	}

	public function resetVars()
	{
		return TRUE;
	}

	public function getAdminContent($params, $defaults)
	{
		$params = array_merge(self::$_params, is_array($params) ? $params : array());
		$dsb = sg_get_default_sidebars();
		$sb = self::getVars();
		$pos = sg_get_sidebars_positions();

		$c = '<div class="sgp-content sgp-sidebars">';
			$c .= '<table>';
				$c .= '<tr>';
					$c .= '<th class="sgp-sb-name">' . __('Name', SG_TDN) . '</th><th class="sgp-sb-pos">' . __('Position', SG_TDN) . '</th><th class="sgp-sb-desc">' . __('Description', SG_TDN) . '</th><th class="sgp-sb-act"></th>';
				$c .= '</tr>';

		if ($params['show_default_sidebars']) {
			foreach ($dsb as $id => $p) {
				$c .= '<tr>';
					$c .= '<td class="sgp-sb-name">' . $p['name'] . '</td>';
					$c .= '<td class="sgp-sb-pos">' . $pos[$p['pos']] . '</td>';
					$c .= '<td>' . $p['desc'] . '</td>';
					$c .= '<td></td>';
				$c .= '</tr>';
			}
		}

		if ($params['show_user_sidebars']) {
			$i = 0;
			$o = '';
			foreach ($pos as $id => $desc) {
				$o .= '<option value="' . $id . '">' . $desc . '</option>';
			}
			foreach ($sb as $id => $p) {
				$c .= '<tr>';
					$c .= '<td class="sgp-sb-name">' . $p['name'] . SG_Form::hidden('sgp_sidebars_name[' . $i . ']', $p['name']) . '</td>';
					$c .= '<td class="sgp-sb-pos">' . $pos[$p['pos']] . SG_Form::hidden('sgp_sidebars_pos[' . $i . ']', $p['pos']) . '</td>';
					$c .= '<td>' . SG_Form::input('sgp_sidebars_desc[' . $i++ . ']', $p['desc']) . '</td>';
					$c .= '<td><a href="#" class="button sgp-sb-rm">-</a></td>';
				$c .= '</tr>';
			}
				$c .= '<tr><td style="text-align:center;">';
					$c .= '<a href="#" class="button sgp-sb-add">+</a>' . SG_Form::hidden('sgp_sidebars', $i);
					$c .= SG_Form::hidden('sgp_sidebars_options', $o);
				$c .= '</td><td colspan="2"></td></tr>';
		}

			$c .= '</table>';
		$c .= '</div>';

		return $c;
	}

	public static function getVars()
	{
		$sidebars = get_option(SG_SLUG . 'sgp_' . self::moduleName);
		if (!empty($sidebars)) return $sidebars;

		return array();
	}

}