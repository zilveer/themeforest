<?php
/*
| -------------------------------------------------------------------
| class Dynamic_Styles
|
| Dynamic Styles Functions & Tools based on options
|
| Author: Georges Haddad
| -------------------------------------------------------------------
| */


class Dynamic_Styles {

	protected $elements = array();
	protected $google_fonts = array();
	protected $important = array();
	protected $options_name;
	protected $use_options = true;
	protected $custom_css = '';
	public $is_touch_device = false;
	  
	function __construct($option_name) {
	
		$this->options_name = $option_name;
		
		include_once(IRON_PARENT_DIR.'/includes/classes/Mobile_Detect.php');
		$detect = new Mobile_Detect;
		$this->is_touch_device = false;
		if ($detect->isMobile() || $detect->isTablet()) {
		    $this->is_touch_device = true;
		}
		
	}  
	  
	// Public Methods
	  
	public function useOptions($flag = true) {
		$this->use_options = $flag;
	}
	  
	public function set($element, $attr, $option_key, $important = false) {
			
		if($this->use_options)
			$styles[$element] = array($attr => $this->get_option($option_key));
		else
			$styles[$element] = array($attr => $option_key);	
			
		
		if($important)
			$this->setImportant($styles[$element]);
		
		$this->mergeStyles($styles);
	}

	public function setBackground($element, $option_key, $important = false) {
			
		$bg_image = $this->get_option($option_key, 'file');
		$bg_repeat = $this->get_option($option_key, 'repeat');
		$bg_size = $this->get_option($option_key, 'size');
		$bg_position = $this->get_option($option_key, 'position');
		//$bg_attach = $this->get_option($option_key, 'attachment');
		$bg_attach = 'fixed';
		$bg_color = $this->get_option($option_key, 'color');
			
		if($this->use_options) {
	
			if($this->is_touch_device && $bg_attach == 'fixed') {
				$bg_image = '';
			}
			
			$styles[$element] = array(
				'background-image' => $bg_image,
				'background-repeat' => $bg_repeat,
				'background-size' => $bg_size,
				'background-position' => $bg_position,
				'background-attachment' => $bg_attach,
				'background-color' => $bg_color
			);
		
		}else{
		
			$styles[$element] = $option_key;
		}
		
		if($important)
			$this->setImportant($styles[$element]);
			
		$this->mergeStyles($styles);
	}

	public function setBackgroundColor($element, $option_key, $important = false) {
		
		if($this->use_options) {
		
			$styles[$element] = array(
				'background-color' => $this->get_option($option_key)
			);
			
		}else{
		
			$styles[$element] = array('background-color' => $option_key);	
		}
		
		if($important)
			$this->setImportant($styles[$element]);
			
		$this->mergeStyles($styles);
	}
	
	public function setColor($element, $option_key, $important = false) {
		
		if($this->use_options) {
		
			$styles[$element] = array(
				'color' => $this->get_option($option_key)
			);
			
		}else{
		
			$styles[$element] = array('color' => $option_key);	
		}
		
		if($important)
			$this->setImportant($styles[$element]);
			
		$this->mergeStyles($styles);
	}
	
	public function setBorder($element, $option_key, $important = false) {
		
		if($this->use_options) {
		
			$styles[$element] = array(
			
				'border-top-width' => $this->get_option($option_key, 'top-width'),
				'border-top-style:' => $this->get_option($option_key, 'top-style'),
				'border-top-color' => $this->get_option($option_key, 'top-color'),
	
				'border-bottom-width' => $this->get_option($option_key, 'bottom-width'),
				'border-bottom-style:' => $this->get_option($option_key, 'bottom-style'),
				'border-bottom-color' => $this->get_option($option_key, 'bottom-color'),
				
				'border-left-width' => $this->get_option($option_key, 'left-width'),
				'border-left-style:' => $this->get_option($option_key, 'left-style'),
				'border-left-color' => $this->get_option($option_key, 'left-color'),
				
				'border-right-width' => $this->get_option($option_key, 'right-width'),
				'border-right-style:' => $this->get_option($option_key, 'right-style'),
				'border-right-color' => $this->get_option($option_key, 'right-color'),
				
				'-webkit-border-top-left-radius' => $this->get_option($option_key, 'top-left-radius'),
				'-moz-border-radius-topleft' => $this->get_option($option_key, 'top-left-radius'),
				'border-top-left-radius' => $this->get_option($option_key, 'top-left-radius'),
				
				'-webkit-border-top-right-radius' => $this->get_option($option_key, 'top-right-radius'),
				'-moz-border-radius-topright' => $this->get_option($option_key, 'top-right-radius'),
				'border-top-right-radius' => $this->get_option($option_key, 'top-right-radius'),
				
				'-webkit-border-bottom-left-radius' => $this->get_option($option_key, 'bottom-left-radius'),
				'-moz-border-radius-bottomleft' => $this->get_option($option_key, 'bottom-left-radius'),
				'border-bottom-left-radius' => $this->get_option($option_key, 'bottom-left-radius'),
				
				'-webkit-border-bottom-right-radius' => $this->get_option($option_key, 'bottom-right-radius'),
				'-moz-border-radius-bottomright' => $this->get_option($option_key, 'bottom-right-radius'),
				'border-bottom-right-radius' => $this->get_option($option_key, 'bottom-right-radius'),
	
			);
			
		}else{
			$styles[$element] = $option_key;
		}
		
		if($important)
			$this->setImportant($styles[$element]);
			
		$this->mergeStyles($styles);
	}	

	public function setBorderColor($element, $option_key, $important = false) {
		
		if($this->use_options) {
		
			$styles[$element] = array(
				'border-color' => $this->get_option($option_key)
			);
			
		}else{
		
			$styles[$element] = array('border-color' => $option_key);	
		}
		
		if($important)
			$this->setImportant($styles[$element]);
			
		$this->mergeStyles($styles);
	}
		
	public function setFont($element, $option_key, $important = false) {
		
		if($this->use_options) {
		
		
			$font = $this->get_option($option_key, 'font');
			$font_family = $this->get_option($option_key, 'font_readable');
			
			$fonts = array();
			if(!empty($font) && is_string($font_family) && strpos($font, "_safe_") === false) {
	
				$fonts[md5($font_family)] = $font_family;
			}
		
			$this->mergeFonts($fonts);
			
			$styles[$element] = array(
				
				'font-family' => $this->get_option($option_key, 'font_readable'),
				'font-weight' => $this->get_option($option_key, 'weight'),
				'font-style' => $this->get_option($option_key, 'style'),
				'font-size' => $this->get_option($option_key, 'size'),
				'line-height' => $this->get_option($option_key, 'height'),
				'text-align' => $this->get_option($option_key, 'align'),
				'text-transform' => $this->get_option($option_key, 'transform'),
				'color' => $this->get_option($option_key, 'color'),
				'background-color' => $this->get_option($option_key, 'bgcolor')
			);	
		
		}else{
			$styles[$element] = $option_key;
		}
		
		if($important)
			$this->setImportant($styles[$element]);
		
		$this->mergeStyles($styles);
		
		
	}
	
	public function setCustomCss($css) {
		
		$this->custom_css .= $css;
	}
	
	function hex2rgb($hex) {
	
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);

	   return $rgb; // returns an array with the rgb values
	}
		
	public function get_option($id, $key = null) {
	
		$options = get_option($this->options_name);

		$value = "";
		if(@!empty($options[$id]))
			$value = $options[$id];
		
		if($key && is_array($value) && !empty($value["$key"]))
			$value = $value[$key];
	
		return $value;			
	}
				
	public function render() {

		$this->importGoogleFonts();
		
		$css = "";
		foreach($this->elements as $elem => $styles) {
			$element_css = $elem." { "."\r\n";
			$count = 0;
			foreach($styles as $attr => $value) {
			
				if($value && !empty($value) && $value != '' && !is_array($value)) {
				
					if($attr == 'background' || $attr == 'background-image')
						$value = 'url('.$value.')';
					
					/*
					$important = "";
					if(isset($this->important[$attr]))
						$important = "!important";
					*/
							
					$element_css .= "\t".$attr.": ".$value."".$important.";\r\n";
					
					$count++;
				}
			}
			$element_css .= "}"."\r\n";
			
			if($count > 0)
				$css .= $element_css;
		}
		
		$css .= $this->custom_css;
		
		echo $css;
		
	}
	
	
	// Protected Methods
		
	protected function importGoogleFonts() {

		foreach($this->google_fonts as $font) {
			
			echo "@import url(https://fonts.googleapis.com/css?family=".urlencode($font).");";

		}
		if(count($this->google_fonts > 0))
			echo "\r\n";
	}
	
	protected function mergeStyles($styles) {
		
		$this->elements = array_merge_recursive(
			$this->elements,
			$styles
		);
	}

	protected function mergeFonts($fonts) {
		
		$this->google_fonts = array_merge(
			$this->google_fonts,
			$fonts
		);
	}
	
	protected function setImportant(&$styles) {
		
		foreach($styles as $attr => $style) {
		
/*
			if($style != "")
				$this->important[$attr] = true;
*/
			
		}		
	}

            
}
