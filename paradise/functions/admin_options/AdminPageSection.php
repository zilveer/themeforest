<?php
class AdminPageSection {
	private $id, $title, $page , $desc = '';
	public $elements = array();

	public function __construct($id, $title, $desc, $page) {
		$this->id = $id;
		$this->title = $title;
		$this->page = $page;
		$this->desc = $desc;
	}

	public function add_element($element_type, $params) {
		$class_name = "Element$element_type";
		if (class_exists($class_name)) {
			$this->elements[] = new $class_name($this->page, $this->id, $params);;
		} else
			throw new Exception(sprintf(__('Class "%s" not found.'), $class_name));
	}

	public function register() {
		add_settings_section($this->id, $this->title, array(&$this, 'render'), $this->page);
		if (!empty($this->elements)) {
			foreach ($this->elements as $element) {
				$element->register();
			}
		}
	}

	public function render() {
		if (!empty($this->desc)) {
			echo "<p>{$this->desc}</p>";
		}
	}
}
?>