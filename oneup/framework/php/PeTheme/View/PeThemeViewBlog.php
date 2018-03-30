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
				  "loadMore" => 
				  array(
						"label"=>__("Load More",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("When 'Paged Result' is active (and a value is set in the 'Maximum' field), enabling this option will replace the pager element with a single 'Load More' button. Once clicked, it will load new items in the background and add them to the current page.",'Pixelentity Theme/Plugin'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"no"
						)
				  );

		return $mbox;	
	}

	public function pe_theme_pager_load_more_filter($value) {
		return true;
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

			if ($loadMore = !empty($conf->settings->loadMore) && $conf->settings->loadMore === "yes") {
				add_filter("pe_theme_pager_load_more",array(&$this,"pe_theme_pager_load_more_filter"));
			}
			$bID = empty($conf->id) ? "" : sprintf('id="pe-load-more-blog-%s"',$conf->id);
			printf('<div class="%s" %s>',$boxed ? "pe-container pe-block" : "pe-block",$bID);
			$this->template(empty($settings->layout) ? "" : $settings->layout);
			printf('</div>');
			if ($loadMore) {
				remove_filter("pe_theme_pager_load_more",array(&$this,"pe_theme_pager_load_more_filter"));
			}
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
