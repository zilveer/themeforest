<?php

class PeThemeViewLayoutModuleAccordionItemContainer extends PeThemeViewLayoutModuleTabsItemContainer {

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
		return __("Use this block to add more complex content to the accordion. This item basically acts as a container into which you may insert further blocks.",'Pixelentity Theme/Plugin');
	}

}

?>
