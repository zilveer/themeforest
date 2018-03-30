<?php

class PeThemeCategory {

	public $defaults;

	public function __construct() {
		$this->defaults = array(
								'show_option_all'    => __('All','Pixelentity Theme/Plugin'),
								'orderby'            => 'name',
								'order'              => 'ASC',
								'show_last_update'   => 1,
								'style'              => 'list',
								'show_count'         => 1,
								'hide_empty'         => 1,
								'use_desc_for_title' => 1,
								'child_of'           => 0,
								'feed'               => NULL,
								'feed_type'          => NULL,
								'feed_image'         => NULL,
								'exclude'            => NULL,
								'exclude_tree'       => NULL,
								'include'            => NULL,
								'hierarchical'       => false,
								'title_li'           => "",
								'show_option_none'   => __('No categories','Pixelentity Theme/Plugin'),
								'number'             => NULL,
								'echo'               => 0,
								'depth'              => -1,
								'current_category'   => 0,
								'pad_counts'         => 1,
								'taxonomy'           => 'category'
								);
	}

	public function getCategoryConf($options) {
		if (!is_array($options)) {
			return $this->defaults;
		}
		return array_merge($this->defaults,$options);
	}

	public function formatCounters($markup) {
		
		$markup = preg_replace('~</li>~', ' <span>'.wp_count_posts()->publish.'</span>', $markup,1);
		//if (!(is_category() || is_tag() || is_search())) {
		if (is_home()) {
			$markup = preg_replace('~<li>~', '<li class="current-cat">', $markup,1);
		}
		return preg_replace('~\((\d+)\)(?=\s*+<)~', '<span>$1</span>', $markup);
	}

	public function show($options) {
		echo $this->formatCounters(wp_list_categories($this->getCategoryConf($options)));
	}
}

?>