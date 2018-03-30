<?php

if ( ! function_exists('flow_elated_like') ) {
	/**
	 * Returns FlowLike instance
	 *
	 * @return FlowLike
	 */
	function flow_elated_like() {
		return FlowLike::get_instance();
	}

}

function flow_elated_get_like() {

	echo wp_kses(flow_elated_like()->add_like(), array(
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

if ( ! function_exists('flow_elated_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function flow_elated_like_latest_posts() {
		return flow_elated_like()->add_like();
	}

}