<?php

class PeThemeViewLayoutModuleAccordionItem extends PeThemeViewLayoutModuleTabsItem {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Item",'Pixelentity Theme/Plugin')
				  );
	}


	public function type() {
		return "Accordion";
	}

	public function group() {
		return "accordion";
	}

	public function tooltip() {
		return __("Use this block to add simple text content to the accordion.",'Pixelentity Theme/Plugin');
	}

}

?>
