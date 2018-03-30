<?php

class DF_Tabs {

	static $shortcodeCount;
	static $shortcodeData;
	static $currentTab;

	/**
	 * init function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	static function init() {

		add_shortcode( 'tab', array(__CLASS__, 'tab_shortcode' ) );
		add_shortcode( 'tabs', array(__CLASS__, 'tabs_shortcode' ) );

		self::$shortcodeCount = 0;
		
	}
	
	/**
	 * tab_shortcode function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $atts
	 * @param mixed $content
	 * @return void
	 */
	public static  function tab_shortcode( $atts, $content ) {
		extract(shortcode_atts(array('title' => null,), $atts) );

		self::$shortcodeData[  self::$currentTab ][] = array( 'title' => $title);
		self::$shortcodeCount++;
		if(self::$shortcodeCount=="1") {
			$class = ' class="active"';
		} else { 
			$class = false;
		}
		$id = ' id="tabs_'.self::$shortcodeCount.'"';
		return '<div'.$class.$id.'>'.do_shortcode(wpautop($content)).'</div>';
		
	}
	
	
	/**
	 * tabs_shortcode function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $atts
	 * @param mixed $content
	 * @return void
	 */
	public static function tabs_shortcode( $atts, $content ) {
		$tabContent = do_shortcode( $content );

		$return='<div class="tab_content">';
			$return.='<ul class="clearfix">';
				$counter = 1;
				foreach( self::$shortcodeData[self::$currentTab] as $val ):
					if($counter=="0") {
						$class = ' class="active"';
					} else { 
						$class = false;
					}
					$return.='<li'.$class.'><a href="#tabs_'.$counter.'">'.$val['title'].'</a></li>'; 
				$counter++;
				endforeach;
			$return.='</ul>';
			$return.= $tabContent;
		$return.='</div>';
		self::$shortcodeData = array();
		return $return;
	}
	

}
// lets play
DF_Tabs::init();
?>