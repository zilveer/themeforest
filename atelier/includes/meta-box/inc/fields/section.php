<?php
/**
 * Section field class.
 */
class RWMB_Section_Field extends RWMB_Field
{
	/**
	 * Show begin HTML markup for fields
	 *
	 * @param mixed $meta
	 * @param array $field
	 *
	 * @return string
	 */
	static function begin_html( $meta, $field )
	{
		return '<h3 id="'. $field['id'] . '" class="meta-box-section">' . $field['title'] . '</h3>';
	}

	/**
	 * Show end HTML markup for fields
	 *
	 * @param mixed $meta
	 * @param array $field
	 *
	 * @return string
	 */
	static function end_html( $meta, $field )
	{
		return '';
	}
}
