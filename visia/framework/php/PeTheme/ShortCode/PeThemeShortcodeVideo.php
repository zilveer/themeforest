<?php

class PeThemeShortcodeVideo extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "video";
		$this->group = __("MEDIA",'Pixelentity Theme/Plugin');
		$this->name = __("Video",'Pixelentity Theme/Plugin');
		$this->description = __("Video",'Pixelentity Theme/Plugin');
		$this->fields = PeGlobal::$const->video->metabox["content"];
	}

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.metabox.video.js",array('pe_theme_metabox'),"pe_theme_metabox_video");
		wp_enqueue_script("pe_theme_metabox_video");
	}

	protected function script() {
		$html = <<<EOT
<script type="text/javascript">
jQuery("#{$this->trigger}").peMetaboxVideo({tag:"{$this->trigger}",id:"{$this->trigger}"});
</script>
EOT;
		echo $html;
	}

	public function render() {
		parent::render();
		$this->script();
	}

	public function output($atts,$content=null,$code="") {
		extract($atts,EXTR_PREFIX_ALL,"sc");
		if (!isset($sc_url)) return "";
		$attr = "href=\"$sc_url\"";
		if (isset($sc_poster)) $attr .= " data-poster=\"$sc_poster\"";
		if (isset($sc_formats)) $attr .= " data-formats=\"$sc_formats\"";

		$html = "<a class=\"influx-video\" $attr></a>";
		return $html;
	}


}

?>
