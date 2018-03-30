<?php

class PeThemeViewBlog extends PeThemeView {

	public function name() {
		return __("Blog",'Pixelentity Theme/Plugin');
	}

	public function short() {
		return __("Blog",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Blog",'Pixelentity Theme/Plugin');
	}
   
	public function supports($type) {
		return !in_array($type,array('gallery','layout'));
	}

	public function capability($cap) {
		return false;
	}

	public function mbox() {
		$mbox = parent::mbox();

		$mbox["content"] = 
			array(
				  "layout" =>
				  array(
						"label"=>__("Layout",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("Select the required post layout.",'Pixelentity Theme/Plugin'),
						"options" => PeGlobal::$config["blog"],
						"default"=>""
						),
				  "media" => 
				  array(
						"label"=>__("Show Media",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("Specify if the post's image/video/gallery media is displayed.",'Pixelentity Theme/Plugin'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"yes"
						),
				  "pager" => 
				  array(
						"label"=>__("Paged Result",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("Display a pager when more posts are found than specified in the 'Maximum' field. ",'Pixelentity Theme/Plugin'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"yes"
						),
				  );

		return $mbox;	
	}

	public function output($conf = null) {

		$t =& peTheme();

		if (empty($conf)) {
			$conf = $t->meta->getDefaultMboxValues(array("settings" => $this->mbox()));
			$conf->id = "";
		}
		
		parent::output($conf);

		$content =& $t->content;
		$settings =& $conf->settings;

		$custom = !empty($conf->data);
		$loop = $custom ? $t->data->customLoop($conf->data) : $t->content->have_posts();

		if ($loop) {
			$t->template->data($conf);

			$boxed = empty($conf->settings->layout) || $conf->settings->layout === "boxed";
			printf('<div class="%s">',$boxed ? "pe-container pe-block" : "pe-block");
			$this->template(empty($settings->layout) ? "" : $settings->layout);
			printf('</div>');

			if ($custom) {
				// if custom, reset the loop
				$content->resetLoop();
			}
		} else {
			$this->template("empty");
		}
	}

	public function template($type = "") {
		peTheme()->get_template_part("loop",$type);
	}
}

?>
