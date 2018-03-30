<?php

class PeThemeViewLayoutModuleCallToAction extends PeThemeViewLayoutModule {

	public function name() {
		return __("Call to Action",'Pixelentity Theme/Plugin');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Call to Action",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "content" =>
				  array(
						"label" => __("Content",'Pixelentity Theme/Plugin'),
						"type" => "Editor",
						"description" => __("Content",'Pixelentity Theme/Plugin'),
						"default" => __('<h5>This is an action block, a kick-ass invitation to do something. <a href="#">Go Now <i class="icon-right-open-mini"></i></a></h5>','Pixelentity Theme/Plugin')
						)
				  );
		
	}

	public function blockClass() {
		return "nomargin";
	}

	public function template() {
		peTheme()->get_template_part("viewmodule","calltoaction");
	}

	public function tooltip() {
		return __("Use this block to add a call to action banner to your layout. This banner consists of text content, such as a tagline, with an optional action button.",'Pixelentity Theme/Plugin');
	}


}

?>
