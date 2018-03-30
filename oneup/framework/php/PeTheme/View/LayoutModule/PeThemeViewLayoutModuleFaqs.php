<?php

class PeThemeViewLayoutModuleFaqs extends PeThemeViewLayoutModuleTabs {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("FAQs",'Pixelentity Theme/Plugin')
				  );
	}

	public function name() {
		return __("FAQs",'Pixelentity Theme/Plugin');
	}

	public function allowed() {
		return "faqs";
	}

	public function create() {
		return "FaqsItem";
	}

	public function prefix() {
		return "faqs";
	}

	public function tooltip() {
		return __("Use this block to add a collapsable toggle to your content. This component is usually used for Frequently asked questions and consists of a clickable heading with a collapsable body content area. Clicking on this heading will reveal the toggle item's content, if currently collapsed, or likewise if the toggle's content is currently showing, clicking the heading will hide it.",'Pixelentity Theme/Plugin');
	}

}

?>
