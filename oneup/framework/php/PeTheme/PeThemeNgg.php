<?php

class PeThemeNgg {

	protected $master;
	protected $options;

	public function __construct(&$master) {
		$this->master =& $master;
	}

	public function customOptions() {

		if (isset(PeGlobal::$config["image-sizes"]["medium"])) {
			list($width,$height,$crop) = PeGlobal::$config["image-sizes"]["medium"];
		} else {
			$width = get_option("medium_size_w");
			$height = get_option("medium_size_h");
		}

		$options = 
			array(
				  "irWidth" => $width,
				  "irHeight" => $height,
				  "irURL" => "custom",
				  "enableIR" => "1",
				  "galHiddenImg" => 1,
				  "galAjaxNav" => 1,
				  "thumbEffect" => "custom",
				  "thumbCode" => "class=\"influx-over\" data-gallery=\"%GALLERY_NAME%\" data-target=\"prettyphoto\"",
				  "galColumns" => $this->master->options->get("nggColumns"),
				  "galImages" => 30,
				  "thumbwidth" => $width,
				  "thumbheight" => $height,
				  "peOverwrite" => true
				  );
		return $options;
	}

	public function instantiate() {
		
		$this->options = nggGallery::get_option('ngg_options');
		$this->overwriteNggConf();

		add_filter('ngg_show_gallery_content',array(&$this,"ngg_show_gallery_content"));
		add_filter('ngg_show_imagebrowser_content',array(&$this,"ngg_show_imagebrowser_content"));
		add_filter('ngg_show_album_content',array(&$this,"ngg_show_album_content"));
		add_filter('ngg_show_slideshow_content',array(&$this,"ngg_show_slideshow_content"),10,4);
		add_filter('ngg_show_slideshow_widget_content',array(&$this,"ngg_show_slideshow_widget_content"),10,4);
		add_filter('ngg_slideshow_size',array(&$this,"ngg_slideshow_size"));
		add_filter('wptouch_user_agents',array(&$this,"wptouch_user_agents"));

	}

	public function overwriteNggConf() {
		if (!isset($this->options["peOverwrite"]) || $this->options["galColumns"] != $this->master->options->get("nggColumns")) {
			$merged = array_merge($this->options,$this->customOptions());
			// override options here
			global $ngg;
			update_option('ngg_options', $merged);
			$this->options =& $merged;
			$ngg->load_options();
		}		
	}

	public function arrows_filter($out) {
		return strtr($out, array("&#9668;"=>"&larr;","&#9658;"=>"&rarr;"));
	}

	public function ngg_show_gallery_content($out) {
		//$col = min(3,max(1,intval($this->options["galColumns"])));
		$col = min(3,max(1,intval($this->master->options->get("nggColumns"))));
		$out = preg_replace('/<div class="slideshowlink">.+<\/div>/isU',"",$out);
		$out = preg_replace('/class="ngg-gallery-thumbnail-box"( style="[^"]+")?/','class="ngg-gallery-thumbnail-box col-'.$col.'"',$out);
		$out = strtr($out, array('<a href="'=>'<a class="influx-over" href="'));
		return $this->arrows_filter($out);
	}

	public function ngg_show_imagebrowser_content($out) {
		return $this->arrows_filter($out);
	}

	public function ngg_show_album_content($out) {
		$out = preg_replace('/<div class="ngg-thumbnail">(.+)<a/isU','<div class="ngg-thumbnail">\\1<a class="influx-over"',$out);
		return $this->arrows_filter($out);
	}

	public function ngg_show_slideshow_content($out,$galleryID,$width,$height) {
		return $this->slideshow($galleryID,"content");
	}

	public function ngg_show_slideshow_widget_content($out,$galleryID,$width,$height) {
		return $this->slideshow($galleryID,"widget");
	}


	public function slideshow($galleryID,$type) {
		if (!$galleryID) return "";
		$fade = $type == "widget" ? 'data-fade="enabled"' : "";
		$picturelist = nggdb::get_gallery($galleryID, $this->options['galSort'], $this->options['galSortDir']);
		$html = '<div class="sliderWrap"><div class="slider" data-delay="3" data-pause="enabled" '.$fade.'>';
		$blank = PE_THEME_URL."/img/blank.png";
		$first = true;
		foreach ($picturelist as $p) {
			if ($first) {
				$src = $p->thumbURL;
				$data = "";
				$first = false;
			} else {
				$src = $blank;
				$data = $p->thumbURL;
			}
			$html .= <<<EOL
<a data-target="prettyphoto" href="{$p->imageURL}" title="{$p->title}"><img src="$src" data-src="$data" alt="{$p->title}"/></a>
EOL;
		}

        $html .= "</div></div>";
		return $html;
	}

	public function ngg_slideshow_size($size) {
		return isset(PeGlobal::$config["image-sizes"]["medium"]) ? PeGlobal::$config["image-sizes"]["medium"] : $size;
		
	}

	public function wptouch_user_agents($agents) {
		return array();
	}

}

?>
