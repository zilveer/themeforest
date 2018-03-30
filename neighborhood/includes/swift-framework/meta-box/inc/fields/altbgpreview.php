<?php
/**
 * Alt Background Preview field class.
 */
class RWMB_Altbgpreview_Field extends RWMB_Field
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
		return '<div id="'. $field['id'] . '" class="meta-altbg-preview"><p>Alt Background Preview</p></div>';
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
