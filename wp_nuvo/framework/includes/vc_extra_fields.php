<?php
/*
 * Taxonomy checkbox list field
 */
function pro_taxonomy_settings_field($settings, $value) {
	$terms_fields = array();
	$value_arr = $value;

	if (!is_array($value_arr)) {
		$value_arr = array_map('trim', explode(',', $value_arr));
	}

	if (!empty($settings['taxonomy'])) {
		$terms = get_terms($settings['taxonomy'], 'orderby=count&hide_empty=0');

		if ($terms && !is_wp_error($terms)) {
			foreach ($terms as $term) {
				$terms_fields[] = sprintf(
						'<label><input id="%s" class="ww-check-taxonomy %s" type="checkbox" name="%s" value="%s" %s/>%s</label>', $settings['param_name'] . '-' . $term->slug, $settings['param_name'] . ' ' . $settings['type'], $settings['param_name'], $term->term_id, checked(in_array($term->term_id, $value_arr), true, false), $term->name
				);
			}
		}
	}
	$script='<sc'.'ri'.'pt type="text/javascript">
	jQuery(document).ready(function($){
	$(".wpb_el_type_pro_taxonomy .pro_taxonomy").click(
		function(e){
			var $this = $(this),
			$input = $this.parents(".wpb_el_type_pro_taxonomy").find(".pro_taxonomy_field"),
			arr = $input.val().split(",");
			if ( $this.is(":checked") ) {
				arr.push($this.val());
				var emptyKey = arr.indexOf("");
				if ( emptyKey > -1 ) {
					arr.splice(emptyKey, 1);
				}
			} else {
				var foundKey = arr.indexOf($this.val());
				if ( foundKey > -1 ) {
					arr.splice(foundKey, 1);
				}
			}
			$input.val(arr.join(","));
		});
	});
	</script>';
	return '<div class="ww-taxonomy-block">'
			. '<input type="hidden" name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-checkboxes ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" value="'.$value.'"/>'
					. '<div class="ww-taxonomy-terms">'
							. implode($terms_fields)
							. '</div>'
									. '</div>'.$script;
}
vc_add_shortcode_param('pro_taxonomy', 'pro_taxonomy_settings_field');