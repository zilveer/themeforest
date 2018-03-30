<?php
/**
 * Class responsible for loading framework files
 */

class ctFilesLoader {


	/**
	 * Main theme name dir
	 * @var string
	 */

	protected $mainThemeName;

	/**
	 * Child theme template
	 * @var string
	 */

	protected $childThemeName;

	/**
	 * Child theme?
	 * @var bool
	 */

	protected $isChildTheme;

	/**
	 * Create file loader
	 */
	public function __construct() {
		//get basic data
		$e = wp_get_theme();
		$this->mainThemeName = $e->get_template();
		$this->childThemeName = $e->get_stylesheet();

		$this->isChildTheme = is_child_theme();
	}


	/**
	 * Returns files from pattern
	 * @param string $dir
	 * @param string $pattern
	 * @param bool $checkChildTheme
	 * @see glob
	 * @return array
	 */

	public function getFilesByPattern($dir, $pattern = '*.php', $checkChildTheme = true) {
		$dir = untrailingslashit($dir);

		$r = glob($dir . '/' . $pattern);
		if ($r === false) {
			return array();
		}

		//we should merge it with child theme files
		if ($checkChildTheme && $this->isChildTheme) {
			$childDir = $this->changeDirFromParentToChild($dir);
			if ($dirs = glob($childDir . '/' . $pattern)) {

				$children = array_flip($dirs);

				foreach ($r as $key => $mainDir) {
					$c = $this->changeDirFromParentToChild($mainDir);
					//we have this file in child theme
					if (isset($children[$c])) {
						$r[$key] = $c;
						unset($children[$c]);
					}
				}

				//add additional child files
				foreach ($children as $path => $a) {
					$r[] = $path;
				}
			}
		}

		return $r;
	}

	/**
	 * Includes files by pattern
	 * @param string $dir
	 * @param string $pattern
	 * @param bool $checkChildTheme
	 */

	public function includeOnceByPattern($dir, $pattern = '*.php', $checkChildTheme = true) {
		$files = $this->getFilesByPattern($dir, $pattern, $checkChildTheme);

		foreach ($files as $f) {
			include_once $f;
		}
	}

	/**
	 * Tries to include a file
	 * @param $file
	 * @param bool $checkChildTheme
	 * @return bool
	 */

	public function tryIncludeOnce($file, $checkChildTheme = true) {
		$path = $this->getFilePath($file, $checkChildTheme);

		if (file_exists($path)) {
			include_once $path;
			return true;
		}

		return false;
	}

	/**
	 * Changes file to child theme file if required
	 * @param string $file
	 * @param bool $checkChildTheme
	 * @return mixed
	 */

	protected function normalizeFile($file, $checkChildTheme = true) {
		if ($checkChildTheme && $this->isChildTheme) {
			$f = $this->changeDirFromParentToChild($file);
			if (file_exists($f)) {
				$file = $f;
			}
		}
		return $file;
	}

	/**
	 * Include single file
	 * @param string $file
	 * @param bool $checkChildTheme
	 */

	public function includeOnce($file, $checkChildTheme = true) {
		include_once $this->normalizeFile($file, $checkChildTheme);
	}


	/**
	 * Include files
	 * @param $file
	 * @param bool $checkChildTheme
	 */

	public function includeIt($file, $checkChildTheme = true) {
		include $this->normalizeFile($file, $checkChildTheme);
	}

	/**
	 * Require once file
	 * @param string $file
	 * @param bool $checkChildTheme
	 */

	public function requireOnce($file, $checkChildTheme = true) {
		require_once $this->normalizeFile($file, $checkChildTheme);
	}


	/**
	 * Loads single file
	 * @param string $file
	 * @param bool $checkChildTheme
	 * @return string
	 */

	public function getFilePath($file, $checkChildTheme = true) {
		if ($checkChildTheme && $this->isChildTheme) {
			$c = $this->changeDirFromParentToChild($file);
			if (file_exists($c)) {
				$file = $c;
			}
		}

		return $file;
	}


	/**
	 * Changes dir from parent to children
	 * @param string $dir
	 * @return mixed
	 */

	protected function changeDirFromParentToChild($dir) {
		return str_replace('/themes/' . $this->mainThemeName . '/', '/themes/' . $this->childThemeName . '/', $dir);
	}
}