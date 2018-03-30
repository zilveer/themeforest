<?php

class PeThemeConst {
	
	protected $cache;

	public function __get($what) {
		if (!isset($this->cache[$what])) {
			$className = "PeThemeConstant".ucfirst($what);
			//$className = "PeThemeConstant".ucfirst(strtolower($what));
			$this->cache[$what] = new $className();
		}
		return $this->cache[$what];
	}

}

?>