<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Images_Field' ) )
{
	class RWMB_Images_Field extends RWMB_Field
	{
		/**
		 * Get field HTML
		 *
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $meta, $field )
		{
			$html = array();		
			$tpl = '<div class="of-radio-img-div">
				<input type="radio" class="rwmb-radio of-radio-img-radio" name="%s" value="%s"%s>
				<div class="of-radio-img-label">%s</div>
				<img src="%s" alt="%s" class="of-radio-img-img%s" onclick="document.getElementById(\'%s_%s\');"%s%s>
			</div>';

			foreach ( $field['options'] as $value => $label )
			{
				$html[] = sprintf(
					$tpl,
					$field['field_name'],//input name
					$value,//input value
					checked( $value, $meta, false ),
					$value,//div value
					$label,//img src
					$label,//img alt
					(( $value != '' && ($value == $meta) )?" of-radio-img-selected":""),
					$field['id'],//img id
					$value,//img value
					(isset($field['width']) && $field['width'] != ""?" width='".$field['width']."'":""),//img width
					(isset($field['height']) && $field['height'] != ""?" height='".$field['height']."'":"")//img height
				);
			}

			return implode( ' ', $html );
		}
	}
}
