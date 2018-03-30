<?php

class PeThemeShortcodeService extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "service";
		$this->group = __("CONTENT",'Pixelentity Theme/Plugin');
		$this->name = __("Service",'Pixelentity Theme/Plugin');
		$this->description = __("Service",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "id" =>
							  array(
									"label" => __("Service",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select a service to show.",'Pixelentity Theme/Plugin'),
									"options" => peTheme()->service->option(),
									"default" => ""
									)
							  );

		// add block level cleaning
		peTheme()->shortcode->blockLevel[] = $this->trigger;

	}


	public function output($atts,$content=null,$code="") {
		
		$content =& peTheme()->content;

		if ($content->customLoop("service",1,null,array("post__in" => array($atts["id"])))) {
			ob_start();
			while ($content->looping()) {
				get_template_part("shortcode","service");
			}
			$html =& ob_get_contents();
			ob_end_clean();
			$content->resetLoop();
		} else {
			$html = "";
		}

		return $html;

	}


}

?>
