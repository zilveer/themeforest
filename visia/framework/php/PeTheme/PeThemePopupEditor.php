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
			add_action('wp_ajax_pe_theme_load_editor',array(&$this,'ajax_load_editor'));
			add_action('admin_footer',array(&$this,'admin_footer'));
			$this->master->shortcode->admin();
		}
	}

	public function admin_footer() {
		echo $this->pre();
		wp_editor("","pe_theme_embedded_editor");
		echo $this->post();
	}



	public function ajax_load_editor() {
		wp_editor("","pe_theme_embedded_editor");
		die();
	}

	protected function pre() {
		$html = <<< EOT
<div id="pe_theme_embedded_editor_popup" class="ui-tabs ui-widget ui-widget-content ui-corner-all clearfix" style="display:none">
EOT;

		return $html;
	}

	protected function post() {
		$buttonText = __("SAVE AND CLOSE",'Pixelentity Theme/Plugin');
		$html = <<< EOT
		<div class="pe_theme">
			<div class="pe_theme_wrap">
				<!--info bar top-->
				<div class="contents clearfix">
					<input id="peEdit_insert_" class="button save-options" type="submit" name="submit" value="{$buttonText}">
				</div>
			</div>
		</div>
</div>
EOT;

		return $html;
	}

}

?>
