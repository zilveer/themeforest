<?php

if ( ! function_exists('suprema_qodef_like') ) {
	/**
	 * Returns SupremaQodefLike instance
	 *
	 * @return SupremaQodefLike
	 */
	function suprema_qodef_like() {
		return SupremaQodefLike::get_instance();
	}

}

function suprema_qodef_get_like() {

	echo wp_kses(suprema_qodef_like()->add_like(), array(
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

if ( ! function_exists('suprema_qodef_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function suprema_qodef_like_latest_posts() {
		return suprema_qodef_like()->add_like();
	}

}

if ( ! function_exists('suprema_qodef_like_portfolio_list') ) {
	/**
	 * Add like to portfolio project
	 *
	 * @param $portfolio_project_id
	 * @return string
	 */
	function suprema_qodef_like_portfolio_list($portfolio_project_id) {
		return suprema_qodef_like()->add_like_portfolio_list($portfolio_project_id);
	}

}