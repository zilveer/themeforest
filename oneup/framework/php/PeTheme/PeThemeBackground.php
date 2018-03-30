<?php

class PeThemeBackground {

	public $master;
	public $conf = false;

	public function __construct($master) {
		$this->master =& $master;
	}

	public function getDefault() {
		$all = $this->master->options->all();
		$options = new StdClass();
		foreach ($all as $key => $value) {
			if (strpos($key,"background_") === 0) {
				$options->{str_replace("background_","",$key)} = $value;
			}
		}
		return $options;
	}


	public function conf() {
		if ($this->conf) return $this->conf;
		$meta =& $this->master->content->meta();
		$defOptions = $this->getDefault();
	
		$background = (is_single() || is_page()) && $meta && isset($meta->background) ? $meta->background : $defOptions;
		
		$background->type = isset($background->type) ? $background->type : "none";
		if ($background->type == "default") $background =& $defOptions;
		if ($background->type == "none") return false;
		$background->resource = isset($background->resource) ? $background->resource : "image";
		$background->image = $background->resource == "image" && isset($background->image) ? $background->image : false;
		if ($background->type == "image" && !$background->image) return false;
		$background->images = false;
		if ($background->image) {
			if ($background->type == "bw") $background->image = $this->master->image->bw($background->image);
		} else if ($background->resource == "gallery") {
			$gallery = isset($background->gallery) ? $background->gallery : "";
			if ($gallery && $images = $this->master->gallery->images($gallery)) {
				if ($background->type == "bw") $images = array_map(array(&$this->master->image,"bw"),$images);
				$background->images = esc_attr(str_replace('\\/','/',json_encode($images)));
			}
		}
		$background->overlay = isset($background->overlay) && $background->overlay == "yes";
		$background->overlayImage = isset($background->overlayImage) ? $background->overlayImage : "";
		$this->conf =& $background;
		return $background;
	}


}

?>