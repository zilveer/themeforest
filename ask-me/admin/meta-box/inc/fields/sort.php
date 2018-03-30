<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Sort_Field' ) )
{
	class RWMB_Sort_Field extends RWMB_Field
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
			$meta = (array) $meta;
			$output = '<ul id="'.$field['id'].'" class="sort-sections">';
				$sort_sections = $meta[0];
				if (empty($sort_sections) || count($sort_sections) <> count($field['options'])) {
					$sort_sections = $field['options'];
				}else {
					if (isset($field['merge']) && !empty($field['merge']) && is_array($field['merge'])) {
						foreach ($field['merge'] as $key_merge => $value_merge) {
							$sort_sections = (!in_array($value_merge,$sort_sections)?array_merge($sort_sections,array($value_merge)):$sort_sections);
						}
					}
				}
				
				$array_not_found = $field['options'];
				foreach ($array_not_found as $key_not => $value_not) {
					if (!in_array($value_not,$sort_sections)) {
						array_push($sort_sections,$value_not);
					}
				}
				
				if (isset($sort_sections) && is_array($sort_sections)) {
					foreach ($sort_sections as $key => $value_for) {
						if (empty($value_for["value"]) && empty($value_for["name"])) {
							unset($sort_sections[$key]);
						}
					}
				}
				
				$i = 0;
				if (isset($sort_sections) && is_array($sort_sections)) {
					foreach ($sort_sections as $key => $value_for) {
						$i++;
						$output .= '<li id="'.esc_attr($value_for["value"]).'" class="ui-state-default">
							<div class="widget-head"><span>'.esc_attr($value_for["name"]).'</span></div>';
							foreach ($value_for as $key_a => $value_a) {
								$output .= '<input name="'.esc_attr( $field['id'] . '['.esc_attr($i).']['.$key_a.']' ).'" value="'.esc_attr($value_for[$key_a]).'" type="hidden">';
							}
						$output .= '</li>';
					}
				}
			$output .= '</ul>';
			
			return $output;
		}
		
		/**
		 * Get meta value
		 * If field is cloneable, value is saved as a single entry in DB
		 * Otherwise value is saved as multiple entries (for backward compatibility)
		 *
		 * @see "save" method for better understanding
		 *
		 * TODO: A good way to ALWAYS save values in single entry in DB, while maintaining backward compatibility
		 *
		 * @param $post_id
		 * @param $saved
		 * @param $field
		 *
		 * @return array
		 */
		static function meta( $post_id, $saved, $field )
		{
			$meta = get_post_meta( $post_id, $field['id'], $field['clone'] );
			$meta = ( !$saved && '' === $meta || array() === $meta ) ? $field['std'] : $meta;
			$meta = $meta;
			
			return $meta;
		}

		/**
		 * Normalize parameters for field
		 *
		 * @param array $field
		 *
		 * @return array
		 */
		static function normalize_field( $field )
		{
			$field['multiple']   = true;
			$field['field_name'] = $field['id'];
			if ( !$field['clone'] )
				$field['field_name'] .= '[]';
			return $field;
		}
	}
}
