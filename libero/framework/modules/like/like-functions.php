<?php

if ( ! function_exists('libero_mikado_like') ) {
	/**
	 * Returns LiberoLike instance
	 *
	 * @return LiberoLike
	 */
	function libero_mikado_like() {
		return LiberoLike::get_instance();
	}

}

function libero_mikado_get_like() {

	echo wp_kses(libero_mikado_like()->add_like(), array(
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

if ( ! function_exists('libero_mikado_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function libero_mikado_like_latest_posts() {
		return libero_mikado_like()->add_like();
	}

}

if ( ! function_exists('libero_mikado_like_portfolio_list') ) {
	/**
	 * Add like to portfolio project
	 *
	 * @param $portfolio_project_id
	 * @return string
	 */
	function libero_mikado_like_portfolio_list($portfolio_project_id) {
		return libero_mikado_like()->add_like_portfolio_list($portfolio_project_id);
	}

}

if ( ! function_exists('libero_mikado_like_portfolio_post') ) {
    /**
     * Add like to portfolio project
     *
     * @param $portfolio_project_id
     * @return string
     */
    function libero_mikado_like_portfolio_post($portfolio_project_id) {
        return libero_mikado_like()->add_like_portfolio_post($portfolio_project_id);
    }

}