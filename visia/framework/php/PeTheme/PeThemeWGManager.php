<?php

class PeThemeWGManager {

	protected $master;
	protected $reqFields;

	public function __construct(&$master) {
		$this->master =& $master;
	}

	public function add() {
		$widgets =& PeGlobal::$config["widgets"];

		if (is_array($widgets) && count($widgets) > 0) {
			foreach ($widgets as $widget) {
				register_widget("PeThemeWidget$widget");
			}
		}
	}

	public function admin_enqueue_scripts() {
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.widgets.js",array("jquery","pe_theme_tooltip"),"pe_theme_admin_widgets");
		wp_enqueue_script("pe_theme_admin_widgets");
	}


	public function admin() {
		add_action("admin_enqueue_scripts",array(&$this,"admin_enqueue_scripts"));

		$widgets =& PeGlobal::$config["widgets"];

		if (is_array($widgets) && count($widgets) > 0) {
			$seen = array();
			foreach ($widgets as $widget) {
				$class = "PeThemeWidget$widget";
				$wg = new $class();

				// include widget assets
				$wg->registerAssets();

				// include fields assets
				if (isset($wg->fields)) {
					foreach ($wg->fields as $name => $data) {
						$class = "PeThemeFormElement".$data["type"];
						if (!isset($seen[$class])) {
							$seen[$class] = true;
							$field = new $class("widget",$name,$data);
							$field->registerAssets();
						}
					}
				}

			}
		}
	}

}

?>
