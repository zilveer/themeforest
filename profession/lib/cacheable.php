<?php

/*
 * Class Name: Cacheable
 * Class URI: http://www.sacredpixel.com
 * Description: Caches content output and write it to a file
 * Version: 1.0.1
 * Author: Alireza Hosseini
 * Author URI: http://www.sacredpixel.com
 */
 
class Cacheable
{
	public $cache_dir = './caches/'; //Directory to cache files in
	public $cache_time = 300; // Seconds to cache files
	protected $cache_file = '';
	
	protected function InitDir()
	{
		if (!is_dir($this->cache_dir))
		{
			mkdir($this->cache_dir, 0777, true);
		}
	}
	
	//Clears the cache directory
	public function Clear()
	{
		if ($handle = @opendir($this->cache_dir)) {

			while (false !== ($file = @readdir($handle))) {
				if ($file != '.' and $file != '..') {
					@unlink($this->cache_dir . $file);
				}
			}
			
			@closedir($handle);
		}
	}
	
	public function InitCache($cacheVar)
	{
		$this->cache_file = $this->cache_dir . md5($cacheVar) . '.cache';

		@clearstatcache();
		
		// Show file from cache if still valid
		if (@file_exists($this->cache_file) &&
			(time() - $this->cache_time) < @filemtime($this->cache_file)) {
		
			@readfile($this->cache_file);
			//Return true if cached file is found
			return true;
		}
		
		// If we're still here, we need to generate a cache file
		ob_start();
		
		return false;
	}
	
	public function EndCache()
	{
		// Now the script has run, generate a new cache file

		$this->InitDir();
		$fp = @fopen($this->cache_file, 'w'); 

		// save the contents of output buffer to the file
		@fwrite($fp, ob_get_contents());
		@fclose($fp); 

		ob_end_flush(); 
	}
	
	public function Abort()
	{
		ob_end_clean();
	}
}

?>