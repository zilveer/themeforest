<?php
// Prevent loading this file directly
class RWMB_Head_Field extends RWMB_Field
{
	/**
	 * Show begin HTML markup for fields
	 *
	 * @param mixed  $meta
	 * @param array  $field
	 *
	 * @return string
	 */
	static function begin_html( $meta, $field )
	{
		if (isset($field['div']) && $field['div'] == 'div') {
			if (isset($field['end']) && $field['end'] == 'end') {
				return '</div>';
			}else {
				return sprintf('<div id="%s">',(isset($field['id']) && $field['id'] != ""?$field['id']:""));
			}
		}else {
			if (isset($field['end']) && $field['end'] == 'end') {
				return '</div></div>';
			}else {
				if (isset($field['name']) && $field['name'] != "") {
					return sprintf('<div class="options-group"><h4 class="vpanel-head-2" id="%s">%s</h4><div class="group-2 %s">',(isset($field['id']) && $field['id'] != ""?$field['id']:""),$field['name'],(isset($field['class']) && $field['class'] != ""?$field['class']:""));
				}else {
					return sprintf('<div class="options-group"><div class="group-2 %s">',(isset($field['class']) && $field['class'] != ""?$field['class']:""));
				}
			}
		}
	}

	/**
	 * Show end HTML markup for fields
	 *
	 * @param mixed  $meta
	 * @param array  $field
	 *
	 * @return string
	 */
	static function end_html( $meta, $field )
	{
		return '';
	}
}
