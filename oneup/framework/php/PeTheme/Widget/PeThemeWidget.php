<?php

class PeThemeWidget extends WP_Widget {

	public $name = "";
	public $trigger = "";
	public $description = "";
	public $wclass = "";
	public $w_args;


	public $control = array('width' => 380);

	public function __construct() {
		$options["classname"] = $this->wclass ? $this->wclass : strtolower(get_class($this));
		$options["description"] = $this->description;
		parent::__construct(false, $this->name,$options,$this->control);
	}

	public function registerAssets() {
	}

	public function form($instance) {
		if (isset($this->fields)) {
			echo '<div class="pe_theme"><div class="pe_theme_wrap"><div class="contents clearfix"><div class="block ui-tabs ui-widget ui-widget-content ui-corner-all clearfix">';
			foreach ($this->fields as $name => $data) {
				$class = "PeThemeFormElement".$data["type"];
				$fname = $this->get_field_name($name);
				if (isset($instance[$name])) {	
					$data["value"] = $instance[$name];
				}
				$field = new $class("",$fname,$data);
				$field->render();			
			}
			echo '</div></div></div></div>';

		}
	}

	public function update($new_instance,$old_instance) {
		return array_merge($old_instance,$new_instance);
	}

	public function getContent(&$instance) {
		return "";
	}

	public function clean($instance) {
		extract($instance);

		if (isset($title)) {
			$title = apply_filters('widget_title',$title,$instance,$this->id_base);
			$instance["title"] = $title;
		}

		return $instance;
	}


	public function widget($args,$instance) {
		$this->w_args =& $args;

		$instance = $this->clean($instance);

		echo $args["before_widget"];
		echo $this->getContent($instance);
		echo $args["after_widget"];
		
	}



}
?>