<?php

class PeThemeMedia {

	public $master;
	public $width;
	public $height;

	public function __construct($master) {
		$this->master =& $master;
		$this->width = new PeThemeMediaStack;
		$this->height = new PeThemeMediaStack;
	}

	public function __get($what) {
		$prop = $what === "w" ? "width" : "height";
		return $this->$prop->last();
	}

	public function w($w) {
		return $this->width->save($w);
	}

	public function h($w) {
		return $this->height->save($w);
	}


}

class PeThemeMediaStack {
	private $stack = Array();

	public function save($v) {
		$this->stack[] = $v;
		return $this;
	}

	public function restore() {
		array_pop($this->stack);
	}

	public function last($def = null) {
		$last = count($this->stack)-1;
		return $last >= 0 ? $this->stack[$last] : $def;
	}

	
}

?>