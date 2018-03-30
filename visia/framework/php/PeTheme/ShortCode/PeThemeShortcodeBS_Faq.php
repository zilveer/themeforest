<?php

class PeThemeShortcodeBS_Faq extends PeThemeShortcode {

	public $instances = 0;

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "faq";
		$this->group = __("LAYOUT",'Pixelentity Theme/Plugin');
		$this->name = __("Faq",'Pixelentity Theme/Plugin');
		$this->description = __("Faq",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "title" =>
							  array(
									"label" => __("Question",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Title of the faq.",'Pixelentity Theme/Plugin'),
									"default" => "Faq Title"
									),
							  "opened" =>
							  array(
									"label" => __("Open on Page Load",'Pixelentity Theme/Plugin'),
									"type" => "RadioUI",
									"description" => __("If the FAQ item should be open by default",'Pixelentity Theme/Plugin'),
									"options" => PeGlobal::$const->data->yesno,
									"default" => "yes"
									),
							  "content" =>
							  array(
									"label" => __("Answer",'Pixelentity Theme/Plugin'),
									"type" => "TextArea",
									"description" => __("Content of the faq.",'Pixelentity Theme/Plugin'),
									"default" => "Content"
									)
							  );

	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$this->instances++;
		if (!@$title) return "";

		$content = $this->parseContent($content);
		
		$id = "faq".$this->instances."_";
		$opened = $opened == "yes";
		$html = '<div class="faq">';
		if ($opened) {
			$html .= sprintf('<div class="faq-heading"><div data-target="#%s" data-toggle="collapse">%s</div></div>',$id,$title);
			$html .= sprintf('<div class="faq-body in" id="%s"><div class="faq-inner"><p>%s</p></div></div>',$id,$content);
		} else {
			$html .= sprintf('<div class="faq-heading"><div data-target="#%s" data-toggle="collapse" class="collapsed">%s</div></div>',$id,$title);
			$html .= sprintf('<div class="faq-body collapsed collapse" id="%s"><div class="faq-inner"><p>%s</p></div></div>',$id,$content);
		}
		$html .= '</div>';

		return $html;
	}


}

?>
