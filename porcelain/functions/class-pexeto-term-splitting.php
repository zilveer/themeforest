<?php

/**
 * Handles the WordPress 4.2 Term Splitting:
 * https://make.wordpress.org/core/2015/02/16/taxonomy-term-splitting-in-4-2-a-developer-guide/
 */
class PexetoTermSplitting{

	protected $custom_post_types = array(
		PEXETO_NIVOSLIDER_POSTTYPE,
		PEXETO_CONTENTSLIDER_POSTTYPE,
		PEXETO_SERVICES_POSTTYPE,
		PEXETO_TESTIMONIALS_POSTTYPE,
		PEXETO_PRICING_POSTTYPE
	);
	protected $map_option_key = 'pexeto_term_splitting';

	public function __construct(){

		add_action( 'split_shared_term', array($this, 'split_shared_term'), 10, 4 );
	}

	public function split_shared_term($old_term_id, $new_term_id, $term_taxonomy_id, $taxonomy){

		$this->add_mapping($old_term_id, $new_term_id, $term_taxonomy_id, $taxonomy);

		switch ($taxonomy) {
			case PEXETO_NIVOSLIDER_POSTTYPE.'_category':
				$this->update_header_sliders_ids($old_term_id, $new_term_id, $term_taxonomy_id, $taxonomy, PEXETO_NIVOSLIDER_POSTTYPE);
				break;

			case PEXETO_CONTENTSLIDER_POSTTYPE.'_category':
				$this->update_header_sliders_ids($old_term_id, $new_term_id, $term_taxonomy_id, $taxonomy, PEXETO_CONTENTSLIDER_POSTTYPE);
				break;

			case 'category':
				$this->update_cats_string($old_term_id, $new_term_id, 'pexeto_exclude_cats', 'template-blog.php');
				break;

			case 'portfolio_category':
				$this->update_cats_string($old_term_id, $new_term_id, 'pexeto_pg_exclude_cats', 'template-portfolio-gallery.php');
				break;
		}

		$post_type = $this->get_custom_page_post_type($taxonomy);
		if(!empty($post_type)){
			$this->update_order($old_term_id, $new_term_id, $term_taxonomy_id, $taxonomy, $post_type);
		}
		

	}

	public function get_new_term_id($term_id, $taxonomy){
		$term_id = (int)$term_id;

		if(!term_exists($term_id, $taxonomy)){
			$new_term_id = $this->get_split_term_new_id($term_id, $taxonomy);

			if(!empty($new_term_id)){
				return $new_term_id;
			}
		}
		
		return $term_id;
	}

	protected function add_mapping($old_term_id, $new_term_id, $term_taxonomy_id, $taxonomy){
		$option = get_option($this->map_option_key);

		$map = empty($option) ? array() : $option;

		$map[]=array(
			'old_term_id' => $old_term_id,
			'new_term_id' => $new_term_id,
			'term_taxonomy_id' => $term_taxonomy_id,
			'taxonomy' => $taxonomy
		);

		update_option($this->map_option_key, $map);

	}

	public function get_split_term_new_id($old_term_id, $taxonomy){
		$map = get_option($this->map_option_key);

		if(!empty($map) && is_array($map)){
			foreach ($map as $entry) {
				if($entry['old_term_id'] == $old_term_id && $entry['taxonomy'] == $taxonomy){
					return $entry['new_term_id'];
				}
			}
		}

		return null;
	}

	protected function get_custom_page_post_type($taxonomy){
		$post_type = str_replace("_category", "", $taxonomy);
		if(in_array($post_type, $this->custom_post_types)){
			return $post_type;
		}
		return null;
	}

	protected function update_order($old_term_id, $new_term_id, $term_taxonomy_id, $taxonomy, $post_type){
		//get the saved order option
		$option_key = 'pexeto_order'.$old_term_id.$post_type;
		$option = get_option($option_key);

		if(!empty($option)){
			$new_option_key = 'pexeto_order'.$new_term_id.$post_type;
			update_option($new_option_key, $option);
		}
	}

	protected function update_header_sliders_ids($old_term_id, $new_term_id, $term_taxonomy_id, $taxonomy, $post_type){
		$meta_key = 'pexeto_slider';

		$pages = get_pages(array(
			'meta_key'=>$meta_key,
			'meta_value'=>$post_type.':'.$old_term_id
			));
		
		if(sizeof($pages)>0){
			$new_meta_value = $post_type.':'.$new_term_id;
			foreach ($pages as $page) {
				update_post_meta($page->ID, $meta_key, $new_meta_value);
			}
		}
	}

	protected function update_cats_string($old_term_id, $new_term_id, $meta_key, $page_template){
		$pages = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => $page_template
		));

		if(sizeof($pages)>0){
			foreach ($pages as $page) {
				$cats_string = get_post_meta($page->ID, $meta_key, true);
				if(!empty($cats_string)){
					$cats = explode(',', $cats_string);
					$index = array_search($old_term_id, $cats);
					if($index !== false){
						$cats[$index] = $new_term_id;
						$new_cats_string = implode(',', $cats);
						update_post_meta($page->ID, $meta_key, $new_cats_string);
					}
				}
			}
		}
	}

}


$pexeto->term_splitting = new PexetoTermSplitting();

if(!function_exists('pexeto_get_actual_term_id')){
	function pexeto_get_actual_term_id($term_id, $taxonomy){
		global $pexeto;

		return $pexeto->term_splitting->get_new_term_id($term_id, $taxonomy);
	}
}

