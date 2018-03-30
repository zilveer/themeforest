<?php
/**
 * Mtheme Sidebar
 *
 * Handles custom sidebars
 *
 * @class MthemeInterface
 * @author Mtheme
 */
 
class MthemeSidebar {

	/** @var array Contains module data. */
	public static $data;

	/**
	 * Adds actions and filters
     *
     * @access public
     * @return void
     */
	public static function init() {
	
		//refresh data
		self::refresh();
	
		//register sidebars
		add_action('widgets_init', array(__CLASS__, 'registerSidebars'));
		
		//add sidebar action
		add_action('wp_ajax_mtheme_sidebar_add', array(__CLASS__,'addSidebar'));		
	}
	
	/**
	 * Refreshes module data
     *
     * @access public
     * @return void
     */
	public static function refresh() {
		self::$data=(array)MthemeCore::getOption(__CLASS__);
	}
	
	/**
	 * Registers module sidebars
     *
     * @access public
     * @return void
     */
	public static function registerSidebars() {
	
		register_sidebar(array(
			'id' => 'default',
			'name' => __('Default', 'mtheme'),
			'before_widget' => MthemeCore::$components['widget_settings']['before_widget'],
			'after_widget' => MthemeCore::$components['widget_settings']['after_widget'],
			'before_title' => MthemeCore::$components['widget_settings']['before_title'],
			'after_title' => MthemeCore::$components['widget_settings']['after_title'],
		));
		
		if(is_array(self::$data)) {
			foreach(self::$data as $name=>$sidebar) {
				if(isset($sidebar['name'])) {
					$sidebar['id']=$name;
					$sidebar['before_widget']=MthemeCore::$components['widget_settings']['before_widget'];
					$sidebar['after_widget']=MthemeCore::$components['widget_settings']['after_widget'];
					$sidebar['before_title']=MthemeCore::$components['widget_settings']['before_title'];
					$sidebar['after_title']=MthemeCore::$components['widget_settings']['after_title'];
					register_sidebar($sidebar);
				}				
			}
		}
	}
	
	/**
	 * Renders module settings
     *
     * @access public
     * @return string
     */
	public static function renderSettings() {
			
		$out=MthemeInterface::renderOption(array(
			'id' => 'mtheme_sidebar_name',
			'type' => 'text',
			'after' => '<a href="#" class="mtheme-button mtheme-add-button button" data-action="mtheme_sidebar_add" data-value="mtheme_sidebar_name" data-container="mtheme_sidebar_items">'.__('Add Sidebar','mtheme').'</a>',				
			'attributes' => array(
				'placeholder' => __('Name','mtheme'),
			),
		));
		
		$out.='<div id="mtheme_sidebar_items">';
		if(is_array(self::$data)) {
			foreach(self::$data as $ID=>$sidebar) {
				$out.=self::renderSidebar(array(
					'id' => $ID,
					'name' => $sidebar['name'],					
				));
			}
		}
		$out.='</div>';
	
		return $out;
	}
	
	/**
	 * Renders module data
     *
     * @access public
     * @return string
     */
	public static function renderData() {
	
		global $post;
		
		wp_reset_query();		
		$type='pages';
		$ID=0;
		
		if(isset($post)) {
			$ID=$post->ID;
		}		
		
		if(is_category() || (is_single() && is_singular('post'))) {
			$type='categories';
			
			if(is_category()) {
				$ID=get_query_var('cat');
			} else {
				$categories=get_the_category(get_the_ID());
				if(!empty($categories)) {
					$ID=$categories[0]->term_id;
				}
			}
		}
		
		$empty=true;
		if(is_array(self::$data)) {
			foreach(self::$data as $name=>$sidebar) {
				if(isset($sidebar[$type]) && ($ID==$sidebar[$type] || (is_array($sidebar[$type]) && in_array($ID, $sidebar[$type])))) {
					$empty=false;
					if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($name));
				}
			}
		}
		
		if($empty) {
			if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('default'));
		}
	}
	
	/**
	 * Adds new sidebar
     *
     * @access public
     * @return void
     */
	public static function addSidebar() {
		if(isset($_POST['value'])) {
			$name=sanitize_text_field($_POST['value']);
			if(!empty($name)) {
				echo self::renderSidebar(array(
					'id' => 's'.uniqid(),
					'name' => $name,				
				));
			}
		}
		
		die();
	}
	
	/**
	 * Renders sidebar option
     *
     * @access public
	 * @param array $sidebar
     * @return string
     */
	public static function renderSidebar($sidebar) {
		$out='<div class="mtheme-sidebar-item mtheme-option" id="'.$sidebar['id'].'">';
		$out.='<h3 class="mtheme-sidebar-title">'.$sidebar['name'].'</h3>';
		$out.='<a href="#" class="mtheme-button mtheme-remove-button mtheme-trigger" title="'.__('Remove', 'mtheme').'" data-action="mtheme_sidebar_remove" data-element="'.$sidebar['id'].'"></a>';

		//sidebar name
		$out.=mthemeInterface::renderOption(array(
			'type' => 'hidden',
			'id' => __CLASS__.'['.$sidebar['id'].'][name]',
			'value' => $sidebar['name'],
		));		
		
		//pages list
		$pages=get_pages();
		foreach($pages as $page) {
			$items[$page->ID]=$page->post_title;
		}
		
		$out.=MthemeInterface::renderOption(array(
			'name' => __('Pages', 'mtheme'),
			'id' => __CLASS__.'['.$sidebar['id'].'][pages][]',
			'type' => 'select',
			'options' => $items,
			'attributes' => array('multiple' => 'multiple'),
			'value' => isset(self::$data[$sidebar['id']]['pages'])?self::$data[$sidebar['id']]['pages']:'',
		));
		
		//categories list
		$items=array();
		$categories=get_categories();
		foreach($categories as $category) {
			$items[$category->term_id]=$category->name;
		}
		
		$out.=MthemeInterface::renderOption(array(
			'name' => __('Categories', 'mtheme'),
			'id' => __CLASS__.'['.$sidebar['id'].'][categories][]',
			'type' => 'select',
			'options' => $items,
			'attributes' => array('multiple' => 'multiple'),
			'value' => isset(self::$data[$sidebar['id']]['categories'])?self::$data[$sidebar['id']]['categories']:'',
		));
		
		$out.='</div>';
		
		return $out;
	}
}