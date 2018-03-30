<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Manage the Dyanimc CSS useful for the theme.      
 * 
 * All rules will be added with the method ->add( $rule, $args );
 *  
 * Then, all css generated will be saved in cache/custom.css, only when is called the
 * method ->save_css();     
 * 
 * @since 1.0.0
 */
class YIT_Css {
    /**
     * All rules to save in file css
     * 
     * @var array
     * @access protected
     * @since 1.0.0
     */
    protected $_rules = array();
    
    /**
     * Filename where to save the custom css
     * 
     * @var string
     * @access protected
     * @since 1.0.0
     */
    protected $_customFilename = 'custom.css';
    
    /**
     * Filename where to save the custom css
     * 
     * @var string
     * @access protected
     * @since 1.0.0
     */
    protected $_styleFilename = 'style.css';

    /**
     * String to save internal stylesheets content
     * 
     * @var string
     * @access protected
     * @since 1.0.0
     */
    protected $_style = '';

    /**
     * All stylesheets to enqueue
     * 
     * @var array
     * @access protected
     * @since 1.0.0
     */
    protected $_stylesheets = array();

    /**
     * Init of class
     * 
     * @since 1.0.0
     */
    public function init() {
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue' ), 15 );
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_custom' ), 16 );
		add_action( 'init', array( &$this, 'custom_file_exists' ) );
    }
    
	/**
	 * Return the custom.css filename including the id of the site 
	 * if the site is in a Network
	 * 
	 * @return string
	 * @since 1.0.0
	 */
	protected function _getCustomFilename() {
		global $wpdb;
		$index = $wpdb->blogid != 0 ? '-' . $wpdb->blogid : '';
		return str_replace( '.css', $index . '.css', $this->_customFilename );
	}
	 
	/**
	 * Generate custom.css file if it doesn't exist
	 * 
	 * @return bool
	 * @since 1.0.0
	 */
	public function custom_file_exists() {
		$file = yit_get_model( 'cache' )->locate_file( $this->_getCustomFilename() );
		
		if( !file_exists($file) ) {
			return $this->save_css();
		} else {
			return true;
		}
	}
	
	/**
	 * Enqueue custom.css file 
	 * 
	 * @return void
	 * @since 1.0.0
	 */
	public function enqueue_custom() {
		if( $this->custom_file_exists() ) {
            wp_enqueue_style( 'cache-custom', yit_remove_protocol_url( yit_get_model( 'cache' )->locate_url( $this->_getCustomFilename() ), array(), false, 'all' ) );
		}
	}
	
    /**
     * Save the file with all css
     * 
     * @return bool
     * @since 1.0.0
     */
    public function save_css() {
        global $wpdb;
        
        $css = array();
        
        // collect all css rules
        do_action( 'yit_save_css' );
        
        foreach ( $this->_rules as $rule => $args ) {
            $args_css = array();
            foreach ( $args as $arg => $value ) {
                //if ( $value == '' ) continue;
                $args_css[] = $arg . ': ' . $value . ';';   
            }
            $css[] = $rule . ' { ' . implode( ' ', $args_css ) . ' }';
        }
        
        $css = apply_filters( 'yit_custom_style', implode( "\n", $css ) );
        
        // save the css in the file
        $index = $wpdb->blogid != 0 ? '-' . $wpdb->blogid : '';
        return yit_file_put_contents( yit_get_model( 'cache' )->locate_file( str_replace( '.css', $index . '.css', $this->_customFilename ) ), $css );
    }
    
    /**
     * Add the rule css
     * 
     * @param string $rule
     * @param array $args
     * @return bool
     * @since 1.0.0
     */
    public function add( $rule, $args = array() ) {         
        if ( isset( $this->_rules[ $rule ] ) ) {
            $this->_rules[ $rule ] = array_merge( $this->_rules[ $rule ], $args );
        } else {
            $this->_rules[ $rule ] = $args;
        }
    }
    
    /**
     * Add the rule by option. You can pass an option args and the method will
     * automatically add the css in the system.     
     * 
     * @param array $option
     * @param mixed $value
     * @return bool
     * @since 1.0.0
     */
    public function add_by_option( $option, $value ) {
		if ( ! isset( $option['style'] ) ) 
            { return; }                           
        
        // used to store the properties of the rules
        $args = array();
        
        if( $option['id'] == 'header-height' && $value != $option['std'] ) {            
            $this->add( $option['style']['selectors'], array( 'height' => "{$value}px" ) ); 
        } elseif ( $option['type'] == 'colorpicker' ) {  
            
			$properties = explode( ',', $option['style']['properties'] );     
			
            if ( isset( $option['opacity'] ) && $value[0] == '#' ) {
                $value = yit_get_model('colors')->hex2rgb( $value ); 
                $value = "rgba( $value[0], $value[1], $value[2], $option[opacity] )";           
            }

			foreach( $properties as $property ) {      
				$args[ $property ] = $value;
			}
			
			$this->add( $option['style']['selectors'], $args ); 
			
		} elseif ( $option['type'] == 'bgpreview') {
		    $this->add( $option['style']['selectors'], array( 'background' => "{$value['color']} url('{$value['image']}')" ) );
		
        } elseif ( $option['type'] == 'typography' ) {
            if ( isset( $value['size'] ) && isset( $value['unit'] ) ) 
                { $args['font-size'] = $value['size'] . $value['unit']; }
                                
            if ( isset( $value['family'] ) ) {
            	if( strpos( $value['family'], ',' ) ) {
	            	$args['font-family'] = stripslashes( preg_replace( '/:[0-9a-z]+/', '', $value['family'] ) ); 
            	} else {
	            	$args['font-family'] = "'" . stripslashes( preg_replace( '/:[0-9a-z]+/', '', $value['family'] ) ) . "', sans-serif"; 
            	}
			}
                                             
            if ( isset( $value['color'] ) ) 
                { $args['color'] = $value['color']; }         
			
            if ( isset( $option['opacity'] ) && $value['color'][0] == '#' ) {
                $value['color'] = yit_get_model('colors')->hex2rgb( $value['color'] ); 
                $value['color'] = "rgba( $value[color][0], $value[color][1], $value[color][2], $option[opacity] )";           
            }
                                         
            if ( isset( $value['style'] ) ) {
                switch ( $value['style'] ) { 
                    case 'bold' :
                        $args['font-style']  = 'normal';
                        $args['font-weight'] = '700';  
                        break;
                    case 'extra-bold' :
                        $args['font-style']  = 'normal';
                        $args['font-weight'] = '800';  
                        break;  
                    case 'italic' :
                        $args['font-style']  = 'italic';
                        $args['font-weight'] = 'normal'; 
                        break;        
                    case 'bold-italic' :
                        $args['font-style']  = 'italic';
                        $args['font-weight'] = '700';   
                        break;            
                    case 'regular' :
                        $args['font-style']  = 'normal';
                        $args['font-weight'] = '400';   
                        break;
                }
            }
            
            $this->add( $option['style']['selectors'], $args );

        } elseif ( $option['type'] == 'upload' && $value ) {
            $this->add( $option['style']['selectors'], array( $option['style']['properties'] => "url('$value')" ) );
        } elseif ( $option['type'] == 'number' ) {
            $this->add( $option['style']['selectors'], array( $option['style']['properties'] => "{$value}px" ) );

        } elseif ( $option['type'] == 'select' ) {
		    $this->add( $option['style']['selectors'], array( $option['style']['properties'] => "$value" ) );		
        } 
    }
    
    /**
     * Remove a rule css
     * 
     * @param string $rule
     * @param array $args
     * @return bool
     * @since 1.0.0
     */
    public function remove( $rule, $args = array() ) {
        if ( ! isset( $this->_rules[ $rule ] ) )
            { return; }
        
        if ( ! empty( $args ) ) {
            foreach ( $args as $arg ) {
                if ( ! isset( $this->_rules[ $rule ][ $arg ] ) )
                    { continue; }
                
                unset( $this->_rules[ $rule ][ $arg ] );
            }
            return;
        }
        
        unset( $this->_rules[ $rule ] );
        return;
    }

	
	/**
	 * Add the stylesheet into the class
	 * 
	 * @param int $priority
	 * @param string $handle
	 * @param string|boolean $src
	 * @param array $deps
	 * @param string|boolean $ver
	 * @param string $media
	 * @param bool $exclude
	 * 
	 * @return void
	 * @since 1.0.0
	 * 
	 */
    public function add_stylesheet( $priority = 0, $handle, $src = false, $deps = array(), $ver = false, $media = 'all', $exclude = false ) {
    	$this->_stylesheets[] = array(
    		'type'     => ( $src && strpos($src, get_template_directory_uri()) !== false ) ? 'yit' : 'external',
			'priority' => $priority,
			'handle'   => $handle,
			'src'      => $src,
			'deps'     => $deps,
			'ver'      => $ver,
			'media'    => $media,
			'exclude'  => $exclude
		);
    }
    
    /**
	 * Enqueue stylesheets with wp_enqueue_style
	 * 
	 * @return void
	 * @since 1.0.0
	 */
	public function enqueue() {
		usort( $this->_stylesheets, array( $this, 'sortByPriority' ) );
		
		$excludedStylesheets = array();
		
		foreach( $this->_stylesheets as $s ) {
			extract($s);
			
			if( $type == 'external' ) {
				wp_enqueue_style( $handle, $src, $deps, $ver, $media );
			} elseif( $type == 'yit' ) {
				if( !$exclude && ($media == 'all' || $media == 'screen') ) {
					//wp_enqueue_style( $handle, $src, $deps, $ver, $media );
					$filename = str_replace( get_template_directory_uri(), get_template_directory(), $src);
					$style = "";
					if( file_exists( $filename ) ) {
						$style = file_get_contents($filename);
					}
					$this->_style .= "/* {$handle} - {$src} */\n" . $this->replacePath($src, $style) . "\n\n";
				} elseif( !$exclude ) {
					wp_enqueue_style( $handle, $src, $deps, $ver, $media );
				} else {
					$excludedStylesheets[] = $s;
				}
			}
		}
		
        //save the css in the file using cache
        $cache = yit_get_model('cache');
		                   
        global $wpdb;             
        $index = $wpdb->blogid != 0 ? '-' . $wpdb->blogid : '';
        $this->_styleFilename = str_replace( '.css', $index . '.css', $this->_styleFilename );

        if( apply_filters( 'yit_cache_is_expired', ( defined('YIT_DEBUG') && YIT_DEBUG ) || $cache->is_expired( $this->_styleFilename) ) ) {
 			$cache->save( $this->_styleFilename, $this->_style );    
 		}

        $config = YIT_Config::load();

        wp_enqueue_style( "styles-minified", yit_remove_protocol_url( yit_get_model( 'cache' )->locate_url( yit_remove_protocol_url( $this->_styleFilename ) ) ) , array() , $config['theme']['version'] );

		//include the excluded stylesheets above
		foreach( $excludedStylesheets as $s ) {
			extract($s);
			wp_enqueue_style( $handle, yit_remove_protocol_url($src), $deps, $ver, $media );
		}
	}

	/** 
	 * Sort stylesheets by priority
	 * 
	 * @param int $a
	 * @param int $b
	 * 
	 * @return bool
	 * @since 1.0.0
	 */
	protected function sortByPriority($a, $b) {
		return $a['priority'] - $b['priority'];
	}
	
	/** 
	 * Compress stylesheet removing comments, tabs, spaces, newlines, etc.
	 * 
	 * @param string $buffer
	 * 
	 * @return string
	 * @since 1.0.0
	 */
    function compress($buffer) {
	    /* remove comments */
	    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	    /* remove tabs, spaces, newlines, etc. */
	    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	    return $buffer;
    }
	

    /**
	 * Fix image paths in css.
	 *
	 * @param string $fileContent Css string
	 * @param string $file File incl path to calculate relative paths from.
	 * @return string
	 */
    function replacePath( $file, $fileContent )
    {
        if ( preg_match_all( "/url\(\s*[\'|\"]?([A-Za-z0-9_\-\/\.\\%?&#]+)[\'|\"]?\s*\)/ix", $fileContent, $urlMatches ) )
        {
           $urlMatches = array_unique( $urlMatches[1] );
           $cssPathArray = explode( '/', $file );
           // Pop the css file name
           array_pop( $cssPathArray );
           $cssPathCount = count( $cssPathArray );
           foreach ( $urlMatches as $match )
           {                                        
               $match = str_replace( '\\', '/', $match );
               $relativeCount = substr_count( $match, '../' );
               // Replace path if it is realtive
               if ( $match[0] !== '/' and strpos( $match, 'http:' ) === false )
               {                                                                               
                   $cssPathSlice = $relativeCount === 0 ? $cssPathArray : array_slice( $cssPathArray , 0, $cssPathCount - $relativeCount );
                   $newMatchPath = ""; //self::getWwwDir(); 
                   if ( !empty( $cssPathSlice ) )
                   {
                       $newMatchPath .= implode( '/', $cssPathSlice ) . '/';
                   }
                   $newMatchPath .= str_replace( '../', '', $match );         
                   $newMatchPath_parsed = parse_url( $newMatchPath );
                   $newMatchPath = str_replace( "$newMatchPath_parsed[scheme]://$newMatchPath_parsed[host]", '', $newMatchPath );
                   $fileContent = str_replace( $match, $newMatchPath, $fileContent );
               }
           }
        }
        return $this->compress($fileContent);
    }

}

if ( ! function_exists( 'yit_save_css' ) ) {
    /**
     * Save the file with all css
     * 
     * @return bool
     * @since 1.0.0
     */
    function yit_save_css() {
        yit_get_model('css')->save_css();
    }
}

if ( ! function_exists( 'yit_add_css' ) ) {
    /**
     * Add the rule css
     * 
     * @return null
     * @since 1.0.0
     */
    function yit_add_css( $rule, $args = array() ) {
        yit_get_model('css')->add( $rule, $args );
    }
}

if ( ! function_exists( 'yit_add_css_by_option' ) ) {
    /**
     * Add the rule css
     * 
     * @return null
     * @since 1.0.0
     */
    function yit_add_css_by_option( $option, $value ) {
        yit_get_model('css')->add_by_option( $option, $value );
    }
}

if( ! function_exists( 'yit_wp_enqueue_style' ) ) {
	/**
	 * A safe way to add/enqueue a CSS style file to the wordpress 
	 * generated page.
	 * 
	 * @param int $priority
	 * @param string $handle
	 * @param string|boolean $src
	 * @param array $deps
	 * @param string|boolean $ver
	 * @param string $media
	 * 
	 * @return void
	 * @since 1.0.0
	 */
	function yit_wp_enqueue_style( $priority = 0, $handle, $src = false, $deps = array(), $ver = false, $media = 'all', $exclude = false ) {
		yit_get_model('css')->add_stylesheet( $priority, $handle, $src, $deps, $ver, $media, $exclude );
	}
}