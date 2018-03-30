<?php

if ( ! function_exists('qode_startit_like') ) {
	/**
	 * Returns QodeStartitLike instance
	 *
	 * @return QodeStartitLike
	 */
	function qode_startit_like() {
		return QodeStartitLike::get_instance();
	}

}

function qode_startit_get_like() {

	echo wp_kses(qode_startit_like()->add_like(), array(
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

if ( ! function_exists('qode_startit_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function qode_startit_like_latest_posts() {
		return qode_startit_like()->add_like();
	}

}

if ( ! function_exists('qode_startit_like_portfolio_list') ) {
	/**
	 * Add like to portfolio project
	 *
	 * @param $portfolio_project_id
	 * @return string
	 */
	function qode_startit_like_portfolio_list($portfolio_project_id) {
		return qode_startit_like()->add_like_portfolio_list($portfolio_project_id);
	}

}