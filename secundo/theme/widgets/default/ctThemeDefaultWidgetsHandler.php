<?php

/**
 * Changes how default widgets render
 */
class ctThemeDefaultWidgetsHandler {

	/**
	 * Connects filters
	 */
	public function __construct() {
		add_filter('widget_title', array($this, 'filterWidgetTitle'));
		add_filter('widget_links_args', array($this, 'filterWidgetLinksArgs'));
	}

	/**
	 * Filters widgets titles
	 * @param string $title
	 * @return string
	 */
	public function filterWidgetTitle($title) {
		return '<span>' . $title .'</span>';
	}

	/**
	 * Filters additional links
	 * @param array $args
	 */
	public function filterWidgetLinksArgs($args){
		$args['title_before'] ='<h3><span>';
		$args['title_after'] ='</span></h3>';
		return $args;
	}
}

if (!is_admin()) {
	new ctThemeDefaultWidgetsHandler();
}
