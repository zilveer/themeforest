<?php
/**
 * This file is part of the BTP_Framework package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 * 
 * 1. Tools
 * 2. interface BTP_Font_Engine
 * 3. class BTP_Font_Engine_Cufon
 * 4. Public API for managing available cufon fonts
 * 5. class BTP_Font_Engine_Google_API
 * 6. Public API for managing available google fonts
 *  
 * @package 			BTP_Framework
 * @subpackage 			BTP_Fonts 
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* ------------------------------------------------------------------------- */
/* ---------->>> FONT TOOLS <<<--------------------------------------------- */
/* ------------------------------------------------------------------------- */



/* Add the global font array */
global $_BTP;
$_BTP[ 'fonts' ] = array();



/**
 * Checks if a font is available
 * 
 * @param			string $id Unique identifier
 * @return			bool
 */
function btp_font_has_font( $id ) {
	global $_BTP;
	
	return isset( $_BTP[ 'fonts' ][ $id ] ) ? true : false;
}



/**
 * Removes a font
 * 
 * @param			string $id Unique identifier
 * @return			bool
 */
function btp_font_remove_font( $id ) {
	global $_BTP;
	if ( btp_has_font( $id ) ) {
		unset( $_BTP[ 'fonts' ][ $id ] );	
		
		return true;
	}
	
	return false;
}



/**
 * Returns available font choices.
 *  
 * If you want to add/delete some choices, hook into the btp_font_choices custom filter.
 * 
 * @return			array
 */
function btp_font_get_choices() {
	global $_BTP;	
	
	$result = array();
	foreach( $_BTP[ 'fonts' ] as $font_id => &$font ) {
		$result[ $font['engine'] ][ $font_id ] = $font[ 'name' ];
	}
	unset( $font );
	
	/* Apply custom filter */
	return apply_filters( 'btp_font_choices', $result ); 
}



/* ------------------------------------------------------------------------- */
/* ---------->>> FONT ENGINE INTERFACE <<<---------------------------------- */
/* ------------------------------------------------------------------------- */



/**
 * Font Engine Interface
  */
interface BTP_Font_Engine {
	
	/**
	 * Inits a font
	 * 
	 * @param 			array $def Definition
	 * @param			array $val Value
	 */
    static public function init_font( $def, $val );
}



/* ------------------------------------------------------------------------- */
/* ---------->>> CUFON FONT ENGINE <<<-------------------------------------- */
/* ------------------------------------------------------------------------- */



/**
 * Cufon Font Replacement Engine
 * 
 * @package			BTP_Framework
 * @subpackage		BTP_Fonts
 */
class BTP_Font_Engine_Cufon implements BTP_Font_Engine {
	
	/** 
	 * Initialized fonts 
	 * @var			array
	 */
	static protected $fonts = array();
	
	
	
	/**
	 * Implementation of BTP_Font_Engine::init_font()
	 * 
	 * @param 			array $def Definition
	 * @param 			array $val Value
	 */
	static public function init_font( $def, $val ) {
		/* Enqueue scripts only once */
		if ( !count( self::$fonts ) ) {			
			add_filter( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
			add_filter( 'wp_head', array ( __CLASS__, 'render_scripts' ) );
		}
		
		/* Add a font to the array of initialized fonts */
		self::$fonts[] = array(
			'def'	=> $def,
			'val'	=> $val,
		);
	}
		
	
	
	/**
	 * Enqueues javascripts
	 */
	static public function enqueue_scripts(){		
		/* Enqueue Cufon script */
		if ( count( self::$fonts ) ) {
			wp_enqueue_script('cufon', get_template_directory_uri().'/js/cufon/cufon-yui.js', array('jquery') );
		}
				
		/* Enqueue font scripts */
		foreach( self::$fonts as $font ) {
			wp_enqueue_script( 
				'cufon_font_' . $font[ 'val' ][ 'font' ], 
				$font[ 'def' ][ 'src' ], 
				array( 'jquery', 'cufon' )
			); 
		}
	}
		
	
	
	/**
	 * Captures scripts.
	 * 
	 * @return			string 
	 */
	function capture_scripts(){
		$out = '';
		
		foreach ( self::$fonts as $font ) {
			if ( strlen( $font[ 'val' ][ 'font' ] ) ) {							
				$out .= 'Cufon.replace( \'' . $font[ 'val' ][ 'selector' ] . '\', { hover: true, fontFamily: \'' . $font[ 'def' ][ 'name' ] . '\' } );'."\n";
			}
		}	
		
		if ( strlen( $out )) {
			$out = '<script type="text/javascript">'."\n" . '/* AUTO-GENERATED BASED ON THEME OPTIONS -------------------------------------------------- */' . "\n" . $out . '</script>' . "\n";
		}
		
		return $out;
	}	
	static public function render_scripts(){
		echo self::capture_scripts();
	}
}



/* ------------------------------------------------------------------------- */
/* ---------->>> CUFON FONT ENGINE PUBLIC API <<<--------------------------- */
/* ------------------------------------------------------------------------- */



/**
 * Adds a Cufon font
 * 
 * @param			string $id Unique identifier
 * @param 			array $args Arguments
 */
function btp_font_add_cufon_font( $id, $args = array()) {
	global $_BTP;
	$args[ 'engine' ] = 'Cufon';
	
	if ( !btp_font_has_font( $id ) ) {
		$_BTP[ 'fonts' ][ $id ] = array_merge(
			array(
				'name'		=> $id,
				'src'		=> '',
			),
			$args
		);	
	}
}



/**
 * Removes a Cufon font
 * 
 * @param			string $id Unique identifier
 */
function btp_font_remove_cufon_font( $id ) {
	btp_font_remove_font( $id );
}



/* ------------------------------------------------------------------------- */
/* ---------->>> Google API FONT ENGINE <<<--------------------------------- */
/* ------------------------------------------------------------------------- */



/**
 * Google API Font Replacement Engine
 * 
 * @package			BTP_Framework
 * @subpackage		BTP_Fonts
 */
class BTP_Font_Engine_Google_API implements BTP_Font_Engine {	
	/** 
	 * Initialized fonts 
	 * @var			array
	 */
	static protected $fonts = array();
	
	
	
	/**
	 * Implementation of BTP_Font_Engine::init_font()
	 * 
	 * @param 			array $def Definition
	 * @param 			array $val Value
	 */
	static public function init_font( $def, $val ) {
		/* Enqueue styles only once */
		if ( !count( self::$fonts ) ) {			
			add_filter( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles' ) );
			add_filter( 'btp_theme_custom_styles', array ( __CLASS__, 'add_styles' ) );
		}
		
		/* Add a font to the array of initialized fonts */
		self::$fonts[] = array(
			'def'	=> $def,
			'val'	=> $val,
		);
	}	

	
	/**
	 * Enqueues styles
	 */
	static public function enqueue_styles(){
		foreach( self::$fonts as $font ) {
			if ( !strlen( $font[ 'val' ][ 'font' ] ) ) {
				continue;
			}
			
		   	wp_register_style( 
				'google_font_' . $font[ 'val' ][ 'font' ], 
				'http://fonts.googleapis.com/css?family=' . str_replace( ' ', '+', $font[ 'def' ][ 'name' ] ),
				array(), 
				false, 
				'screen'			
			);		
	    	wp_enqueue_style( 'google_font_' . $font[ 'val' ][ 'font' ] );
		}
	}
	
	
		
	/**
	 * Captures Google Fonts Styles
	 * 
	 * @return			string
	 */
	static public function capture_styles(){
		$out = '';				
			
		foreach( self::$fonts as $font ) {
			if ( strlen( $font[ 'val' ][ 'font' ] ) ) {
				$out .=  $font[ 'val' ][ 'selector' ] . ' { font-family: ' . $font[ 'def' ][ 'name' ] . '; }' . "\n";
			} 
		}
		
		return $out;
	}
	static public function add_styles( $css ){
		$css .= self::capture_styles();
		return $css;
	}	
}



/* ------------------------------------------------------------------------- */
/* ---------->>> GOOGLE API FONT ENGINE PUBLIC API <<<---------------------- */
/* ------------------------------------------------------------------------- */



/**
 * Adds a Google Font
 * 
 * @param 			string $id Unique identifier
 * @param 			array $args Arguments
 */
function btp_font_add_google_font( $id, $args = array()) {
	global $_BTP;	
	
	$args[ 'engine' ] = 'Google_API';
	
	if ( !btp_font_has_font( $id ) ) {
		$_BTP[ 'fonts' ][ $id ] = array_merge(
			array(
				'name'		=> $id,
				'styles'	=> array(),
				'subsets'	=> array(),	
			),
			$args
		);	
	}
}



/**
 * Removes a Google font
 * 
 * @param			string $id Unique identifier
 */
function btp_font_remove_google_font( $id ) {
	btp_font_remove_font( $id );
}



/* ------------------------------------------------------------------------- */
/* ---------->>> FONTFACE FONT ENGINE <<<--------------------------------- */
/* ------------------------------------------------------------------------- */



/**
 * font-face Font Replacement Engine
 * 
 * @package			BTP_Framework
 * @subpackage		BTP_Fonts
 */
class BTP_Font_Engine_Fontface implements BTP_Font_Engine {	
	/** 
	 * Initialized fonts 
	 * @var			array
	 */
	static protected $fonts = array();
	
	
	
	/**
	 * Implementation of BTP_Font_Engine::init_font()
	 * 
	 * @param 			array $def Definition
	 * @param 			array $val Value
	 */
	static public function init_font( $def, $val ) {
		/* Enqueue styles only once */
		if ( !count( self::$fonts ) ) {
			add_filter( 'btp_theme_custom_styles', array ( __CLASS__, 'add_styles' ) );
		}
		
		/* Add a font to the array of initialized fonts */
		self::$fonts[] = array(
			'def'	=> $def,
			'val'	=> $val,
		);
	}	
	
		
	/**
	 * Captures font-face Styles
	 * 
	 * @return			string
	 */
	static public function capture_styles(){
		$out = '';

        foreach( self::$fonts as $font ) {
            if ( strlen( $font[ 'val' ][ 'font' ] ) ) {
                $out .=  $font[ 'val' ][ 'selector' ] . ' { font-family: ' . $font[ 'def' ][ 'name' ] . '; }' . "\n";
            }

            if ( strlen( $out ) ) {
                $out = 	'@font-face {' . "\n" .
                    'font-family: ' . $font[ 'def' ][ 'name' ] . ';' . "\n" .
                    'src: url(\'' . $font[ 'def' ][ 'eot' ] . '\');' . "\n" .
                    'src: url(\'' . $font[ 'def' ][ 'eot' ] . '?#iefix\') format(\'embedded-opentype\'),' . "\n" .
                    'url(\'' . $font[ 'def' ][ 'woff' ] . '\') format(\'woff\'),' . "\n" .
                    'url(\'' . $font[ 'def' ][ 'ttf' ] . '\') format(\'truetype\'),' . "\n" .
                    'url(\'' . $font[ 'def' ][ 'svg' ] . '#' . $font[ 'def' ][ 'name' ] . '\') format(\'svg\');'. "\n" .
                    '}' . "\n" .
                    $out;
            }
        }

        return $out;
	}
	static public function add_styles( $css ){
		$css .= self::capture_styles();
		return $css;
	}	
}



/* ------------------------------------------------------------------------- */
/* ---------->>> FONTFACE FONT ENGINE PUBLIC API <<<---------------------- */
/* ------------------------------------------------------------------------- */



/**
 * Adds a font-face Font
 * 
 * @param 			string $id Unique identifier
 * @param 			array $args Arguments
 */
function btp_font_add_fontface_font( $id, $args = array()) {
	global $_BTP;	
	
	$args[ 'engine' ] = 'Fontface';
	
	if ( !btp_font_has_font( $id ) ) {
		$_BTP[ 'fonts' ][ $id ] = array_merge(
			array(
				'name'		=> $id,
				'eot'		=> '',
				'woff'		=> '',
				'ttf'		=> '',
				'svg'		=> '',
			),
			$args
		);	
	}
}



/**
 * Removes a font-face font
 * 
 * @param			string $id Unique identifier
 */
function btp_font_remove_fontface_font( $id ) {
	btp_font_remove_font( $id );
}
?>