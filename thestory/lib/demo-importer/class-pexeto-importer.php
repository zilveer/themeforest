<?php 

/**
 * Extends the WP_Import class to implement some custom data importing, such as
 * options import, colors import and widgets import.
 */
class PexetoImport extends WP_Import{

	/**
	 * Imports the theme options.
	 * @param  string $file        the path of the file containing the serialized
	 * options data
	 * @param  string $options_key the key used to save the options in the database
	 * @return bool       true when the options are imported and false when
	 * the options are not imported
	 */
	public function import_options($file, $options_key){
		if(file_exists($file)){
			$options_string = file_get_contents($file);
			$options = unserialize($options_string);

			//set the maga menu mapping
			if(!empty($options['items_mega_menu'])){
				$map = $this->processed_menu_items;

				$new_items = array();
				foreach ($options['items_mega_menu'] as $menu_item_id) {
					if(isset($map[$menu_item_id])){
						$new_items[]=$map[$menu_item_id];
					}
				}
				if(!empty($new_items)){
					$options['items_mega_menu'] = $new_items;
				}
			}

			//replace the icons URLs
			if(!empty($options['sociable_icons'])){
				foreach ($options['sociable_icons'] as &$icon) {
					$icon_parts = explode('/', $icon['icon_url']);
					$icon_name = end($icon_parts);
					$icon['icon_url'] = get_template_directory_uri().'/images/icons/'.$icon_name;
				}
			}

			update_option($options_key, $options);
			return true;
		}

		return false;
	}

	/**
	 * Imports the color options.
	 * @param  string $file the filepath containg the serialized color options
	 * @return bool       true when the options are imported and false when
	 * the options are not imported
	 */
	public function import_colors($file){
		if(file_exists($file)){
			$color_string = file_get_contents($file);
			$options = unserialize($color_string);

			if(!empty($options)){
				foreach ($options as $key => $value) {
					set_theme_mod( $key, $value );
				}
			}
			return true;
		}
		return false;
	}


	/**
	 * Imports the widget settings.
	 * @param  string $file path of file containing a serialized and base64
	 * encoded widget data
	 * @return bool       true when the options are imported and false when
	 * the options are not imported
	 */
	public function import_widgets($file){
		if(file_exists($file)){
			$widget_string = file_get_contents($file);
			// echo $widget_string;
			$widgets = unserialize(base64_decode($widget_string));

			if(isset($widgets['options']) && isset($widgets['sidebars'])){
				//save the options
				foreach ($widgets['options'] as $key => $value) {
					update_option($key, unserialize($value));
				}

				update_option('sidebars_widgets', $widgets['sidebars']);
				return true;

			}
			return false;
		}
		return false;
	}

	/**
	 * Sets a front page by page slug.
	 * @param string $slug the slug of the page to set as a front page
	 */
	public function set_front_page($slug){
		$page = get_page_by_path($slug);
		if(!empty($page) && isset($page->ID)){
			update_option('show_on_front', 'page');
			update_option('page_on_front', $page->ID);
			return true;
		}
		return false;
	}


	/**
	 * Sets the menus for the theme.
	 * @param array $menu_settings array containing the menu settings to apply
	 */
	public function set_menus($menu_settings){
		$menu_locations = get_theme_mod( 'nav_menu_locations' );
		if(empty($menu_locations)){
			$menu_locations = array();
		}
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		foreach ($menu_settings as $key => $value) {
			foreach ($menus as $menu_el) {

				if($menu_el->slug==$value){
					$menu_locations[$key]=intval($menu_el->term_id);
					break;
				}
				
			}
		}
		set_theme_mod('nav_menu_locations', $menu_locations);
	}

	/**
	 * Sets term mapping from the old category IDs to the new category IDs
	 * for some of the elements that depend on the selected category ID.
	 * @param array $map_widgets an array with the widgets that need to have
	 * category mapping.
	 */
	public function set_term_mapping($map_widgets){
		$map = $this->processed_terms;

		$this->set_gallery_cat_mapping($map);
		$this->set_slider_mapping($map);
		$this->set_widget_mapping($map, $map_widgets);
	}

	/**
	 * Sets category mapping from the old category IDs to the new category IDs
	 * in the gallary pages when they are set to include/exclude a specific
	 * set of categories.
	 * @param array $map an array containing a map from the old IDs to the new IDs
	 */
	private function set_gallery_cat_mapping($map){
		$pages = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => 'template-portfolio-gallery.php'
		));

		if(!empty($pages)){
			foreach ($pages as $page) {
				$cat_str = get_post_meta($page->ID, 'pexeto_pg_filter_cats_cats', true);
				if(!empty($cat_str)){
					$cats = explode(',', $cat_str);
					$new_cats = array();
					foreach ($cats as $cat) {
						$cat = intval($cat);
						if(isset($map[$cat])){
							$new_cats[]=$map[$cat];
						}
					}

					if(sizeof($cats)==sizeof($new_cats)){
						//update the category IDs
						update_post_meta($page->ID, 'pexeto_pg_filter_cats_cats', implode(',', $new_cats));
					}else{
						//not all of the categories have been mapped, set the filter to exlude so that the page can be loaded
						update_post_meta($page->ID, 'pexeto_pg_filter_cats_type', 'exclude');
					}
				}
			}
		}
	}

	/**
	 * Sets category mapping from the old category IDs to the new category IDs
	 * in the content slider pages when they are set to show a specific slider.
	 * @param array $map an array containing a map from the old IDs to the new IDs
	 */
	private function set_slider_mapping($map){
		$pages_ids = get_all_page_ids();
		foreach ($pages_ids as $page_id) {
			$slider = get_post_meta($page_id, 'pexeto_slider', true);
			if(strpos($slider, 'pexcontentslider')!==false){
				$slider_vars = explode(':', $slider);
				if(isset($slider_vars[1])){
					$slider_id = intval($slider_vars[1]);
					if(isset($map[$slider_id])){
						$new_slider_id = $map[$slider_id];
						update_post_meta($page_id, 'pexeto_slider', 'pexcontentslider:'.$new_slider_id);
					}
				}
			}
		}
	}

	/**
	 * Sets category mapping from the old category IDs to the new category IDs
	 * in the widgets when they are set to include/exclude a specific
	 * set of categories.
	 * @param array $map an array containing a map from the old IDs to the new IDs
	 */
	private function set_widget_mapping($map, $map_widgets){
		foreach ($map_widgets as $widget_id) {
			$widget_settings = get_option($widget_id);

			if(!empty($widget_settings) && is_array($widget_settings)){
				foreach ($widget_settings as &$widget) {
					if(!empty($widget['category']) && isset($map[$widget['category']])){
						$widget['category'] = $map[$widget['category']];
					}
				}
			}

			update_option($widget_id, $widget_settings);
			unset($widget);
		}
		
	}

}


?>