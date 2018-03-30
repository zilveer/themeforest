<?php

class PeThemeEditor {

	protected $master;
	protected $instantiated = false;

	public function __construct(&$master) {
		$this->master =& $master;
	}

	public function registerAssets() {
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.editor.js",array("jquery","pe_theme_utils"),"pe_theme_editor");
		wp_enqueue_script("pe_theme_editor");
	}

	public function instantiate() {
		if ($this->instantiated) return;
		if (is_admin()) {
			$this->instantiated = true;
			$this->registerAssets();
			add_action('edit_page_form',array(&$this,'editor'));
			add_action('edit_form_advanced',array(&$this,'editor'));
			$this->master->shortcode->admin();
		}
	}

	public function editor() {
		wp_editor("","pe_theme_embedded_editor");
		echo $this->post();
	}

	protected function post() {
		$buttonText = __("SAVE AND CLOSE",'Pixelentity Theme/Plugin');
		$html = <<< EOT
				<div style="text-align: center; margin-top: 30px">
					<input id="peEdit_insert_" class="button save-options" type="submit" name="submit" value="{$buttonText}">
				</div>
EOT;

		return $html;
	}

}

?>
