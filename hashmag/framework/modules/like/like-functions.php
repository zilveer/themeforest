<?php

if ( ! function_exists('hashmag_mikado_like') ) {
	/**
	 * Returns HashmagMikadoLike instance
	 *
	 * @return HashmagMikadoLike
	 */
	function hashmag_mikado_like() {
		return HashmagMikadoLike::get_instance();
	}

}

function hashmag_mikado_get_like() {

	echo wp_kses(hashmag_mikado_like()->add_like(), array(
		'span' => array(
			'class' => true,
			'aria-hidden' => true,
			'style' => true,
			'id' => true
		),
		'a' => array(
			'href' => true,
			'class' => true,
			'id' => true,
			'title' => true,
			'style' => true
		)
	));
}

if ( ! function_exists('hashmag_mikado_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function hashmag_mikado_like_latest_posts() {
		return hashmag_mikado_like()->add_like();
	}

}

if ( ! function_exists('hashmag_mikado_like_portfolio_list') ) {
	/**
	 * Add like to portfolio project
	 *
	 * @param $portfolio_project_id
	 * @return string
	 */
	function hashmag_mikado_like_portfolio_list($portfolio_project_id) {
		return hashmag_mikado_like()->add_like_portfolio_list($portfolio_project_id);
	}

}