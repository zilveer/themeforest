<?php

if ( ! function_exists('hue_mikado_like') ) {
	/**
	 * Returns HueMikadoLike instance
	 *
	 * @return HueMikadoLike
	 */
	function hue_mikado_like() {
		return HueMikadoLike::get_instance();
	}

}

function hue_mikado_get_like() {

	echo wp_kses(hue_mikado_like()->add_like(), array(
		'span' => array(
			'class' => true,
			'aria-hidden' => true,
			'style' => true,
			'id' => true
		),
		'i' => array(
			'class' => true,
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

if ( ! function_exists('hue_mikado_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function hue_mikado_like_latest_posts() {
		return hue_mikado_like()->add_like();
	}

}

if ( ! function_exists('hue_mikado_like_portfolio_list') ) {
	/**
	 * Add like to portfolio project
	 *
	 * @param $portfolio_project_id
	 * @return string
	 */
	function hue_mikado_like_portfolio_list($portfolio_project_id) {
		return hue_mikado_like()->add_like_portfolio_list($portfolio_project_id);
	}

}