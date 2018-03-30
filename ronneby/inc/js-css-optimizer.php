<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/* TODO: Remove WooCommerce scripts from minification queue */
class DFDJsCssOptimizer {

    private $options = null;
    private $js_printed = false;
	private $css_printed = false;
	private $option_name = 'dfd-js-css-cache';
	
	private $js_cache_dir_path;
	private $js_cache_dir_url;
	
	private $css_cache_dir_path;
	private $css_cache_dir_url;
	
	private $cache_lifetime;
	
	function __construct($args=array()) {
		$this->options = get_option($this->option_name);
		
		if (!is_array($this->options)) {
			$this->options = array(
				'combine-css' => true,
				'combine-js' => 'combine'
			);
		}
		
		$this->js_cache_dir_path = get_template_directory() . '/assets/cache/';
		$this->js_cache_dir_url = get_template_directory_uri() . '/assets/cache/';
		
		$this->css_cache_dir_path = get_template_directory() . '/assets/cache/';
		$this->css_cache_dir_url = get_template_directory_uri() . '/assets/cache/';
		
		$this->cache_lifetime = (empty($args['cache_lifetime'])) ? 1 : $args['cache_lifetime'];
		
		if (is_admin()) {
			return false;
		}
		
		if (!empty($args['js']) && $this->check_js_cache_directory()) {
			add_action('wp_print_scripts',         array($this, 'wp_print_scripts_action'), 0);
			add_action('wp_print_footer_scripts',  array($this, 'wp_print_scripts_action'), 0);
		}
        
		if (!empty($args['css']) && $this->check_css_cache_directory()) {
			add_action('wp_print_styles',         array($this, 'wp_print_styles_action'), -10000);
			add_action('wp_print_footer_scripts', array($this, 'wp_print_styles_action'), 0);
		}
		
		if (!empty($args['js']) || !empty($args['css'])) {
			add_action('wp_footer', array($this, 'footer'), 20000000);
		}
	}

    private function check_js_cache_directory() {
        if (is_writable($this->js_cache_dir_path)) {
            return true;
        } else {
            if (@mkdir($this->js_cache_dir_path, 0777)) {
                return true;
            }
        }
        return false;
    }
	
	private function check_css_cache_directory() {
        if (is_writable($this->css_cache_dir_path)) {
            return true;
        } else {
            if (@mkdir($this->css_cache_dir_path, 0777)) {
                return true;
            }
        }
        return false;
    }

    /**
     * wp_print_scripts action
     *
     * @global $wp_scripts, $auto_compress_scripts
     */
    public function wp_print_scripts_action() {
        global $wp_scripts, $auto_compress_scripts;
		if (! is_a($wp_scripts, 'WP_Scripts')) return;
		
        if (! is_array($auto_compress_scripts))
            $auto_compress_scripts = array();

        $queue = $wp_scripts->queue;
        $wp_scripts->all_deps($queue);

		foreach( $wp_scripts->to_do as $key => $handle ) {
			if ( !in_array($handle, $wp_scripts->done, true) && isset($wp_scripts->registered[$handle]) ) {

				if ( ! $wp_scripts->registered[$handle]->src ) { // Defines a group.
					$wp_scripts->done[] = $handle;
					continue;
				}

                $src      = $this->normalize_url($wp_scripts->registered[$handle]->src);
                $external = $this->is_external_url($src);
				if (!isset($group)) { $group = false; }
                
                if (!$external) {
                    
                    $_conditional = isset($wp_scripts->registered[$handle]->extra['conditional']) 
                                        ? $wp_scripts->registered[$handle]->extra['conditional'] : '';
                    
                    // Print scripts those added before
                    if ( $_conditional ) {
                        $this->print_scripts();
                    } 
                
                    $auto_compress_scripts[$handle] = array(
                                                        'src'      => $src, 
                                                        'external' => $external,
                                                        'ver'      => $wp_scripts->registered[$handle]->ver,
                                                        'args'     => $wp_scripts->registered[$handle]->args,
                                                        'extra'    => $wp_scripts->registered[$handle]->extra,
                                                        'localize' => isset($wp_scripts->registered[$handle]->extra['data']) 
                                                                        ? $wp_scripts->registered[$handle]->extra['data'] : '',
                                                    );
                                                    
                    // Print script with "conditional"
                    if ( $_conditional ) {
                        $this->print_scripts( $_conditional );
                    }
                    
                    ob_start();
                    if ( $wp_scripts->do_item( $handle, $group ) ) {
                        $wp_scripts->done[] = $handle;
                    }
                    ob_end_clean();
                }
                else {
                    // Print scripts those added before
                    $this->print_scripts();
                    
                    // Standard way
                    if ( $wp_scripts->do_item( $handle, $group ) ) {
                        $wp_scripts->done[] = $handle;
                    }
                }

				unset( $wp_scripts->to_do[$key] );
			}
		}

        // printing scripts hear or move to the bottom
        if ( $this->options['combine-js'] == 'combine' || $this->js_printed) {
            $this->print_scripts();
        }        
    }

    /**
     * wp_print_styles action
     *
     * @global $wp_styles, $auto_compress_styles
     */
    public function wp_print_styles_action() {
        if (is_admin()) return;
		
        global $wp_styles, $auto_compress_styles;
		if (! is_object($wp_styles)) return;
			
        if (! is_array($auto_compress_styles))
            $auto_compress_styles = array();
		
        $queue = $wp_styles->queue;
        $wp_styles->all_deps($queue);

		foreach( $wp_styles->to_do as $key => $handle ) {

			if ( !in_array($handle, $wp_styles->done, true) && isset($wp_styles->registered[$handle]) ) {

				if ( ! $wp_styles->registered[$handle]->src ) { // Defines a group.
					$wp_styles->done[] = $handle;
					continue;
				}

                $src      = $this->normalize_url($wp_styles->registered[$handle]->src);
                $media    = ($wp_styles->registered[$handle]->args ? $wp_styles->registered[$handle]->args : 'all');
                $external = $this->is_external_url($src);
				if (!isset($group)) { $group = false; }
				
				if (strpos($src, get_template_directory_uri() . '/assets/css/') === false) {
					continue;
				}

                if (!$external) {
                    unset($wp_styles->to_do[$key]);
                    
                    $conditional = 'no-conditional';
                    if (isset($wp_styles->registered[$handle]->extra) 
                        && isset($wp_styles->registered[$handle]->extra['conditional'])) {
                        $conditional = $wp_styles->registered[$handle]->extra['conditional'];
                    }
                        
                    $auto_compress_styles[$media][$conditional][$handle] = array(
                                                                'src'      => $src, 
                                                                'media'    => $media, 
                                                                'external' => $external,
                                                                'ver'      => $wp_styles->registered[$handle]->ver,
                                                                'args'     => $wp_styles->registered[$handle]->args,
                                                                'extra'    => $wp_styles->registered[$handle]->extra,
                                                            );

                    ob_start();
                    if ( $wp_styles->do_item( $handle, $group ) ) {
                        $wp_styles->done[] = $handle;
                    }
                    ob_end_clean();
                }
                else {
                    // printing scripts
                    $this->print_styles();
                    
                    if ( $wp_styles->do_item( $handle, $group ) ) {
                        $wp_styles->done[] = $handle;
                    }
                }

				unset( $wp_styles->to_do[$key] );
			}
		}
        
		// printing CSS
		if ($this->css_printed || $this->options['combine-css']) {
			 $this->print_styles();
		}
    }
	
	private function normalize_url($url) {
    
        if (substr($url, 0, 2) == '//') {
            if (isset($_SERVER['HTTPS']) )
                $url = 'https:' . $url;
            else
                $url = 'http:' . $url;
        }	    
        
        if (substr($url, 0, 1) == '/') {
            $url = site_url($url);
        }	
        
        return $url;
    }
    
	private function is_external_url($url) {
        
        if (substr($url, 0, 4) != 'http') {
            $url = site_url($url);
            return false;
        }
        else {
            $home = home_url();
            if (substr($url, 0, strlen($home)) == $home) {
                return false;
            }
            else return true;
        }
    }

	private function save_options() {
        update_option($this->option_name, $this->options);
    }
    
	private function print_styles() {
		global $auto_compress_styles;
		
		if(is_array($auto_compress_styles)) {
        
        // TODO: Check ordering
			foreach ($auto_compress_styles as $media => $conditionals) {
				foreach ($conditionals as $conditional => $scripts) {
					if ($conditional == 'no-conditional') {
						$conditional = false;
					}
					$this->print_styles_by_media($scripts, $media, $conditional);
				}
			}
		
		}
        $auto_compress_styles = array();
	}
    
    private function print_scripts( $conditional = false ) {
        global $auto_compress_scripts;
        if (! is_array($auto_compress_scripts) || ! count($auto_compress_scripts))
            return;

        $home = get_option('siteurl').'/';
        if (empty($this->options['cache-js']) || !is_array($this->options['cache-js']))
            $this->options['cache-js'] = array();

		$handles = array_keys($auto_compress_scripts);
		$handles = implode(', ', $handles);
		$localize_js = '';

		// Calc "modified tag"
		$fileId = 0;
		foreach ($auto_compress_scripts as $handle => $script) {
			if (! $script['external']) {
				$path = $this->get_path_by_url($script['src'], $home);
				$fileId += @filemtime($path);
			}
			else {
				$fileId += $script['ver'].$script['src'];
			}

			if (! empty($script['localize'])) {
				$localize_js .= "/* $handle */\n" . $script['localize'] . "\n";
			}
		}			

		$cache_name = md5(md5($handles).$fileId);
		$cache_file_path = $this->js_cache_dir_path . $cache_name . '.js';
		$cache_file_url = $this->js_cache_dir_url . $cache_name . '.js';

		// Find a cache
		if ($this->get_cache($cache_name, $cache_file_path, 'js')) {

			// Include script 
			$this->print_js_script_tag($cache_file_url, $conditional, true, $localize_js);

			$auto_compress_scripts = array();
			return;
		}

		// Build cache
		$scripts_text = '';
		foreach ($auto_compress_scripts as $handle => $script) {
			$src = html_entity_decode($script['src']);
			$scripts_text .= "/* $handle: ($src) */\n";

			// Get script contents
			$_remote_get = wp_remote_get($this->add_url_param($src, 'v', rand(1, 9999999)));
			if (! is_wp_error($_remote_get) && $_remote_get['response']['code'] == 200) {
				$contents = $_remote_get['body'];
				$contents = $contents.";\n\n";
				$scripts_text .= $contents;
			}
			else {
				$scripts_text .= "/*\nError loading script content: $src\n";
				if (! is_wp_error($_remote_get)) 
					$scripts_text .= "HTTP Code: {$_remote_get['response']['code']} ({$_remote_get['response']['message']})\n*/\n\n"; ///************************
			}
		}
		$scripts_text = "/*\nCache: ".$handles."\n*/\n" . $scripts_text;

		// Save cache
		$this->save_cache($cache_file_path, $scripts_text, $cache_name, $fileId, 'js');

		// Include script 
		$this->print_js_script_tag($cache_file_url, $conditional, false, $localize_js);

		$auto_compress_scripts = array();
    }
	
	private function get_path_by_url($url, $home) {
		$path = ABSPATH . str_replace($home, '', $url);
		$_p = strpos($path, '?');
		if ($_p !== false) {
			$path = substr($path, 0, $_p);
		}
		return $path;
	}
    
    private function save_cache($cache_file_path, $cache, $cache_name, $fileId, $type) {
        $this->save_script($cache_file_path, $cache);
        $this->options['cache-'.$type][$cache_name] = $fileId;
        $this->save_options();
    }   
    
    private function get_cache($cache_name, $cache_file_path, $type) {
        return (!empty($this->options['cache-'.$type][$cache_name]) && is_readable($cache_file_path));
    }

    private function print_js_script_tag($url, $conditional, $is_cache, $localize = '', $error_message = '') {
        
        if ($localize) {
            echo "<script type='text/javascript'>\n/* <![CDATA[ */\n$localize\n/* ]]> */\n</script>\n";
        }
            
        if ($conditional) {
            echo "<!--[if " . $conditional . "]>\n";        
        }
        
        echo '<script type="text/javascript" src="' . $url . '">' . ($is_cache ? '/*Cache!*/' : '') . $error_message . '</script>' . "\n";

        if ($conditional) {
            echo "<![endif]-->" . "\n";
        }
    }    
    
    private function print_css_link_tag($url, $media, $conditional, $is_cache) {
        if ($conditional)
            echo "<!--[if " . $conditional . "]>\n";
              
        echo '<link rel="stylesheet" href="' . $url . '" type="text/css" media="' . $media . '" />' . (($is_cache && ! $conditional) ? ' <!-- Cache! -->' : '') . "\n";
        
        if ($conditional) 
            echo "<![endif]-->" . (($is_cache && $conditional) ? ' <!-- Cache! -->' : '') . "\n";
    }
	
    /*
     * Print CSS
     */
    function print_styles_by_media($scripts, $media, $conditional) {
        global $auto_compress_styles;
        if (! is_array($scripts) || ! count($scripts))
            return false;

        $home = get_option('siteurl').'/';
        if (empty($this->options['cache-css']) || !is_array($this->options['cache-css']))
            $this->options['cache-css'] = array();

		$handles = array_keys($scripts);
		$handles = implode(', ', $handles);

		// Calc "modified tag"
		$fileId = 0;
		foreach ($scripts as $handle => $script) {
			if (! $script['external']) {
				$path = $this->get_path_by_url($script['src'], $home);
				$fileId += @filemtime($path);
			}
			else {
				$fileId .= '-'.$script['ver'];
			}
		}
		if (empty($fileId)) 
			$fileId = 'nover';

		$cache_name = md5(md5($handles).$fileId);
		$cache_file_path = $this->css_cache_dir_path . $cache_name . '.css';
		$cache_file_url = $this->css_cache_dir_url . $cache_name . '.css';

		// Find a cache
		if ($this->get_cache($cache_name, $cache_file_path, 'css')) {

			// Include script 
			$this->print_css_link_tag($cache_file_url, $media, $conditional, true);

			$scripts = array();
			return true;
		}

		// Build cache
		$scripts_text = '';
		foreach ($scripts as $handle => $script) {
			$src = html_entity_decode($script['src']);
			$scripts_text .= "/* $handle: ($src) */\n";

			// Get script contents
			$_remote_get = wp_remote_get($this->add_url_param($src, 'v', rand(1, 9999999)));
			if (! is_wp_error($_remote_get) && $_remote_get['response']['code'] == 200) {
				$content = $_remote_get['body'];
				$scripts_text .= $content . "\n";                    
			}
			else {
				if (! is_wp_error($_remote_get)) 
					$error_message = "/* Error loading script content: $src; HTTP Code: {$_remote_get['response']['code']} ({$_remote_get['response']['message']}) */";
				else
					$error_message = "/* Error loading script content: $src */";

				$scripts_text .= "$error_message\n";
				$scripts_text .= "@import url('" . $src . "'); \n\n";
			}
		}
		$scripts_text = "/*\nCache: ".$handles."\n*/\n" . $scripts_text;

		// Save cache
		$this->save_cache($cache_file_path, $scripts_text, $cache_name, $fileId, 'css');

		// Include script 
		$this->print_css_link_tag($cache_file_url, $media, $conditional, false);
        
        return true;
    }
	
    private function add_url_param($url, $name, $val) {
        if (strpos($url, '?') === false)
			return $url."?$name=$val";
			
		return $url."&$name=$val";
    }

    private function save_script($filename, $content) {
        if (is_writable(dirname($filename))) {
			$this->remove_files(dirname($filename));
            $fhandle = @fopen($filename, 'w+');
            if ($fhandle) fwrite($fhandle, $content, strlen($content));
        }
        return false;
    }
	
	private function remove_files($dir) {
		$files = glob($dir.'/*.*');
		
		$old_options = $this->options;
		
		if (!empty($files)) {
			foreach ($files as $file) {
				if (strpos($file, 'index.html') !== false || filemtime($file) > strtotime('-'.$this->cache_lifetime.' Days')) {
					continue;
				}
				
				$basename = basename($file);
				$f_basename = explode('.', $basename);
				$file_name = array_shift($f_basename);
				
				if (isset($this->options['cache-css'][$file_name])) {
					unset($this->options['cache-css'][$file_name]);
				}
				if (isset($this->options['cache-js'][$file_name])) {
					unset($this->options['cache-js'][$file_name]);
				}
				
				@unlink($file);
			}
			
			if ($old_options != $this->options) {
				$this->save_options();
			}
		}
	}

    public function footer() {
        if ($this->options['combine-js']) {
            $this->js_printed = true;
            $this->print_scripts();
        }

        if ($this->options['combine-css']) {
            $this->css_printed = true;
            $this->print_styles();
        }
    }
}

function dfd_run_js_css_optimizer() {
	global $dfd_ronneby;
	$js_optimizer = (isset($dfd_ronneby['js_script_optimizer']) && $dfd_ronneby['js_script_optimizer']) ? $dfd_ronneby['js_script_optimizer'] : false;
	$css_optimizer = (isset($dfd_ronneby['css_script_optimizer']) && $dfd_ronneby['css_script_optimizer']) ? $dfd_ronneby['css_script_optimizer'] : false;
	$time = isset($dfd_ronneby['time_script_optimizer']) ? $dfd_ronneby['time_script_optimizer'] : 0;
	$time = (intval($time) === 0) ? 1 : $time;
	
	$args = array('js' => false, 'css' => false, 'cache_lifetime' => $time);
	
	if (strcmp($js_optimizer, '1') === 0) {
		$args['js'] = true;
	}
	
	if (strcmp($css_optimizer, '1') === 0) {
		$args['css'] = true;
	}
	
	new DFDJsCssOptimizer($args);
}

add_action('init', 'dfd_run_js_css_optimizer');