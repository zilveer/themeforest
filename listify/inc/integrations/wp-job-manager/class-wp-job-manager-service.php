<?php

abstract class Listify_WP_Job_Manager_Service {

	public $meta_key;
	public $meta_value;
	public $label;

	public function __construct() {
		add_action( 'listify_single_job_listing_actions_after', array( $this, 'render' ) );
	}

	public function render() {
		if ( ! $this->get_value() ) {
			return;
		}

		if ( false !== filter_var( $this->get_value(), FILTER_VALIDATE_URL ) ) {
			printf( '<a href="%s" class="button" target="_blank">%s</a>', $this->get_value(), $this->get_label() );
			return;
		}

		$frame = sprintf(
			'<div id="%1$s" class="popup">
				<h2 class="popup-title">%2$s</h2>
				%3$s
			</div>',
			$this->get_key(),
			$this->get_label(),
			$this->get_content()
		)
		;
		$button = sprintf(
			'<a href="#" class="button popup-trigger" data-mfp-src="#%1$s">%2$s</a>',
			$this->get_key(),
			$this->get_label()
		);

		echo $button . $frame;
	}

	public function get_label() {
		return esc_attr( $this->label );
	}

	public function get_key() {
		return $this->meta_key;
	}

	public function get_value( $key = false ) {
		global $post;

		if ( ! $key ) {
			$key = $this->meta_key;
		}

		$this->meta_value = $post->$key;

		// try a hidden version of the field
		if ( ! $this->meta_value ) {
			$key = '_' . $key;

			$this->meta_value = $post->$key;
		}

		return $this->meta_value;
	}

	public function get_content() {
		return $this->get_value();
	}

}