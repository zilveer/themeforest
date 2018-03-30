<?php

class PeThemeFooter {

	public $master;
	public $layout = 
		array(
			  "default" => array("span3","span3","span3","span3"),
			  "3cols" => array("span4","span4","span4"),
			  "4cols" => array("span3","span3","span3","span3"),
			  );

	public $count = 0;

	public function __construct($master) {
		$this->master =& $master;
		$this->layout = apply_filters("pe_theme_footer_layouts",$this->layout);
	}

	public function widgets() {
		$filter = array(&$this,"dynamic_sidebar_params_filter");
		add_filter("dynamic_sidebar_params",$filter);
		dynamic_sidebar("footer");
		//$this->master->sidebar->show("footer");
		remove_filter("dynamic_sidebar_params",$filter);
	}


	public function dynamic_sidebar_params_filter($params) {
		$p =& $params[0];
		$footerLayout = $this->master->options->get("footerLayout");
		$footerLayout = $footerLayout ? $footerLayout : "default";
		$classes = $this->layout[count($this->layout) > 1 ? $footerLayout : "default"];
		//$classes = $this->layout["3col"];
		$last = count($classes);
		//if ($p["name"] == "footer") {
		$class = @$classes[$this->count++ % $last];
		if ($this->count == $last) $class .= " last";
		$p["before_widget"] = "<div class=\"$class in-footer\">".$p["before_widget"];
		$p["after_widget"] .= '</div>';
		//}
		return $params;
	}


	public function wp_footer() {
		$this->master->image->stats();
		
		wp_footer();
	}
}

?>