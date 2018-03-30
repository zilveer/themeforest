<?php
/**
 * Mtheme Shortcode
 *
 * Handles custom shortcodes
 *
 * @class MthemeShortcode
 * @author Mtheme
 */
 
class MthemeShortcode {

	/** @var array Contains module data. */
	public static $data;

	/**
	 * Adds actions and filters
     *
     * @access public
     * @return void
     */
	public static function init() {
	
		//require shortcodes
		require_once(MTHEME_PATH.'shortcodes.php');
	
		//refresh module data
		self::refresh();
	
		//init tinymce plugin
		add_action('admin_init', array( __CLASS__, 'initInterface' ));
		
		//init js scripts
		add_action('admin_enqueue_scripts', array( __CLASS__, 'initScripts'));
		
		//add shortcode filters
		add_filter('the_content', array( __CLASS__, 'filterShortcodes'));
		add_filter('widget_text', 'do_shortcode');
		add_filter('the_excerpt', 'do_shortcode');
	}
	
	/**
	 * Refreshes module data
     *
     * @access public
     * @return void
     */
	public static function refresh() {
		if(isset($_GET['shortcode'])) {
			foreach(MthemeCore::$components['shortcodes'] as $shortcode) {
				if($shortcode['id']==$_GET['shortcode']) {
					self::$data=$shortcode;
				}
			}
		}
	}
	
	/**
	 * Inits module scripts
     *
     * @access public
     * @return void
     */
	public static function initScripts() {
		$out='<script type="text/javascript">';
		$out.='mthemeURI="'.MTHEME_URI.'";';
		$out.='mthemeTitle="'.__('Insert Shortcode', 'mtheme').'";';
		$out.='mthemeShortcodes={';
		
		foreach(MthemeCore::$components['shortcodes'] as $shortcode) {
			$out.=$shortcode['id'].':"'.$shortcode['name'].'",';
		}
		
		$out.='}';	
		$out.='</script>';
		
		echo mtheme_html($out);
	}
	
	/**
	 * Inits module interface
     *
     * @access public
     * @return void
     */
	public static function initInterface() {
		add_filter('mce_external_plugins', array(__CLASS__, 'addPlugin'));
		add_filter('mce_buttons', array(__CLASS__, 'addButton'));
	}
	
	/**
	 * Adds tinymce plugin
     *
     * @access public
	 * @param array $plugins
     * @return array
     */
	public static function addPlugin($plugins) {
		$plugins['mtheme_shortcode'] = MTHEME_URI.'assets/js/mtheme.shortcode.js';
		return $plugins;
	}
	
	/**
	 * Adds tinymce button
     *
     * @access public
	 * @param array $buttons
     * @return array
     */
	public static function addButton($buttons) {
		array_push($buttons, '|', 'mtheme_shortcode');
		return $buttons;
	}
	
	/**
	 * Renders module settings
     *
     * @access public
     * @return string
     */
	public static function renderSettings() {
		$out='<table><tbody>';
		
		//render options
		if(isset(self::$data['options'])) {	
			$option['value']='';
			if(isset($option['default'])) {
				$option['value']=$option['default'];
			}
			
			foreach(self::$data['options'] as $option) {
				$out.='<tr>';
				$out.='<th><h4 class="mtheme-shortcode-title">'.$option['name'].'</h4></th>';				
				$out.='<td>'.MthemeInterface::renderOption($option).'</td>';				
				$out.='</tr>';
			}			
		}
		
		//render clone
		if(isset(self::$data['clone'])) {
			$ID='a'.uniqid();
			
			$out.='<tr><td colspan="2"><div class="mtheme-shortcode-pane"><div class="mtheme-shortcode-clone" id="'.$ID.'">';
			$out.='<div class="mtheme-shortcode-pattern hidden">'.self::$data['clone']['shortcode'].'</div>';
			$out.='<div class="mtheme-shortcode-value hidden"></div>';
			$out.='<a href="#" class="mtheme-button mtheme-remove-button mtheme-trigger" data-element="'.$ID.'" title="'.__('Remove', 'mtheme').'"></a>';
			$out.='<a href="#" class="mtheme-button mtheme-clone-button mtheme-trigger" data-element="'.$ID.'" data-value="'.$ID.'" title="'.__('Add', 'mtheme').'"></a>';
				
			foreach(self::$data['clone']['options'] as $option) {
				$out.=MthemeInterface::renderOption($option);
			}			
			
			$out.='</div></div></td></tr>';
		}
		
		$out.='<tr><th></th><td><div class="mtheme-option mtheme-submit"><input type="submit" class="mtheme-button" value="'.__('Insert Shortcode','mtheme').'" /></div></td></tr>';
		$out.='</tbody></table>';
		$out.='<div class="mtheme-shortcode-pattern hidden">'.self::$data['shortcode'].'</div>';
		$out.='<div class="mtheme-shortcode-value hidden"></div>';
		
		return $out;
	}
	
	/**
	 * Filters shortcodes markup
     *
     * @access public
     * @return void
     */
	public static function filterShortcodes($content) {
		$shortcodes=implode('|', array(
			'section',
			'container',
			'row',
			'content',
			'one_col',
			'two_col',
			'three_col',
			'four_col',
			'five_col',
			'six_col',
			'seven_col',
			'eight_col',
			'nine_col',
			'ten_col',
			'eleven_col',
			'fullwidth',
			'button',
			'tabs',
			'tab',
			'toggles',
			'toggle',
			'accordions',
			'accordion',
			'list',
			'item',
			'alert',
			'fancy-title',
			'modal',
			'event_intro',
			'event_brochure',
			'event_registration_form',
			'event_features',
			'features',
			'event_video',
			'ThreeDImageSlider',
			'event_notify_form',
			'speakers',
			'event_speakers',
			'sponsors',
			'event_sponsors',
			'packages',
			'event_packages',
			'schedules',
			'event_schedules',
			'footer_contact',
			'hero_background',
		));

		$filtered=preg_replace("/(<p>)?\[($shortcodes)(\s[^\]]+)?\](<\/p>)?/", "[$2$3]", $content);
		$filtered=preg_replace("/(<p>)?\[\/($shortcodes)](<\/p>)?/", "[/$2]", $filtered);
 
		return $filtered;
	}
}