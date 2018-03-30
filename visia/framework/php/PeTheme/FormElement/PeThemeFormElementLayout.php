<?php

class PeThemeFormElementLayout extends PeThemeFormElement {

	public function registerAssets() {
		parent::registerAssets();

		// prototype.js alters JSON2 behaviour, it shouldn't be loaded in our admin page anyway but
		// if other plugins are forcing it in all wordpress admin pages, we get rid of it here.
		wp_deregister_script("prototype");

		if (version_compare($GLOBALS["wp_version"], '3.5-RC1', '<' ) ) {
			// for wordpress < 3.5, the bundled jquery ui is not able to handle correctly the nested sortables
			// so we load a newer version in noconflict mode and only use for our layout builder
			PeThemeAsset::addScript("framework/js/admin/3.5/jquery.js",array(),"pe_theme_35_jquery");
			PeThemeAsset::addScript("framework/js/admin/3.5/jquery-ui-1.9.2.custom.min.js",array("pe_theme_35_jquery"),"pe_theme_35_ui");
			PeThemeAsset::addScript("framework/js/admin/3.5/noconflict.js",array("pe_theme_35_ui"),"pe_theme_35");

			wp_enqueue_script("pe_theme_35");
		}

		PeThemeAsset::addStyle("framework/css/jquery.theme.field.layout.css",array("pe_theme_admin"),"pe_theme_field_layout");
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.layout.js",array("pe_theme_utils","jquery-ui-sortable","pe_theme_tooltip","json2"),"pe_theme_field_layout");

		wp_enqueue_style("pe_theme_field_layout");
		wp_enqueue_script("pe_theme_field_layout");
		$views = array();

		// modules
		foreach (peTheme()->view->views() as $view) {
			if ($view->capability("layout")) {
				$view->registerAssets();
				$views[] = $view;
			}
		}

		foreach ($views as $view) {
			$view->requireAssets();
		}

	}

	protected function addTemplateValues(&$data) {
		parent::addTemplateValues($data);

		$blocks = isset($this->data["value"]) ? $this->data["value"] : false;

		if (!$blocks && is_array($data["[DEFAULT]"])) {
			$blocks = $data["[DEFAULT]"];
		}
		$buffer =& $data["[BLOCKS]"];
		$buffer = "";
		if ($blocks && is_array($blocks) && count($blocks) > 0) {
			$buffer = esc_attr(json_encode($blocks));
		}

		$views = $this->data["views"];

		$buffer =& $data["[MODULES]"];
		$buffer = "";

		if (!empty($views)) {
			foreach ($views as $s => $section) {
				foreach($section as $idx => $view) {
					$cssClass = $view->cssClass();
					$buffer .= sprintf(
									   '<div id="pe_module_%s" class="pe_module type_%s group_%s"><h3>%s<span class="help" title="%s">?</span></h3><div>%s</div></div>',
									   $view->option(),
									   $cssClass,
									   $view->group(),									   
									   $view->name(),
									   $view->tooltip(),
									   $s
									   );
				}
			}
		}

	}

	protected function template() {

		$buttonLabel = __("Add New Block",'Pixelentity Theme/Plugin');
		$cancelLabel = __('Close Blocks','Pixelentity Theme/Plugin');

		$html = <<<EOT
<div class="option" id="[ID]" data-prefix="[NAME]" data-blocks="[BLOCKS]">
	<div class="section">
		<div class="pe_layout_builder">
			<ul class="pe_block_container">
				<li class="pe_layout_modules">
					<div>
					[MODULES]
					</div>
				</li>				
			</ul>
			<div class="buttons">
				<input class="button addblock" type="button" value="$buttonLabel" data-add="$buttonLabel" data-cancel="$cancelLabel"/>
			</div>
		</div>
		
	</div>
</div>
<script>
	(window.jqpe35 || jQuery)("#[ID]").peFieldLayout();
</script>
EOT;
		return $html;
	}
	
	

}

?>
