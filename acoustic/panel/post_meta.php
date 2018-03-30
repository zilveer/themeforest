<?php
//
// Various wrapping functions for easier custom fields creation.
//

if( !function_exists('ci_prepare_metabox') ):
function ci_prepare_metabox($post_type) {
	wp_nonce_field( basename( __FILE__ ), $post_type.'_nonce' );
}
endif;

if ( !function_exists( 'ci_can_save_meta' ) ):
	function ci_can_save_meta( $post_type ) {
		global $post;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return false;
		}

		if ( isset( $_POST['post_view'] ) and $_POST['post_view'] == 'list' ) {
			return false;
		}

		if ( !isset( $_POST['post_type'] ) or $_POST['post_type'] != $post_type ) {
			return false;
		}

		if ( !isset( $_POST[$post_type . '_nonce'] ) or !wp_verify_nonce( $_POST[$post_type . '_nonce'], basename( __FILE__ ) ) ) {
			return false;
		}

		$post_type_obj = get_post_type_object( $post->post_type );
		if ( !current_user_can( $post_type_obj->cap->edit_post, $post->ID ) ) {
			return false;
		}

		return true;
	}
endif;


if( !function_exists('ci_metabox_gallery') ):
function ci_metabox_gallery( $gid = 1 ) {
	global $post;
	$post_id = $post->ID;

	ci_featgal_print_meta_html( $post_id, $gid );
}
endif;

if( !function_exists('ci_metabox_gallery_save') ):
function ci_metabox_gallery_save( $POST, $gid = 1 ) {
	global $post;
	$post_id = $post->ID;
	
	ci_featgal_update_meta($post_id, $POST, $gid);
}
endif;

if( !function_exists('ci_metabox_input') ):
function ci_metabox_input( $fieldname, $label, $params = array() ) {
	global $post;

	$defaults = array(
		'label_class' => '',
		'input_class' => 'widefat',
		'input_type'  => 'text',
		'esc_func'    => 'esc_attr',
		'before'      => '<p class="ci-field-group ci-field-input">',
		'after'       => '</p>',
		'default'     => ''
	);
	$params = wp_parse_args( $params, $defaults );
	
	$custom_keys = get_post_custom_keys($post->ID);

	if ( is_array( $custom_keys ) and in_array( $fieldname, $custom_keys ) ) {
		$value = get_post_meta( $post->ID, $fieldname, true );
		$value = call_user_func( $params['esc_func'], $value );
	} else {
		$value = $params['default'];
	}

	echo $params['before'];

	if( !empty($label) ) {
		?><label for="<?php echo esc_attr( $fieldname ); ?>" class="<?php echo esc_attr( $params['label_class'] ); ?>"><?php echo $label; ?></label><?php
	}

	?><input id="<?php echo esc_attr( $fieldname ); ?>" type="<?php echo esc_attr( $params['input_type'] ); ?>" name="<?php echo esc_attr( $fieldname ); ?>" value="<?php echo esc_attr( $value ); ?>" class="<?php echo esc_attr( $params['input_class'] ); ?>" /><?php

	echo $params['after'];

}
endif;

if( !function_exists('ci_metabox_textarea') ):
function ci_metabox_textarea( $fieldname, $label, $params = array() ) {
	global $post;

	$defaults = array(
		'label_class' => '',
		'input_class' => 'widefat',
		'esc_func'    => 'esc_textarea',
		'before'      => '<p class="ci-field-group ci-field-textarea">',
		'after'       => '</p>',
		'default'     => ''
	);
	$params = wp_parse_args( $params, $defaults );

	$custom_keys = get_post_custom_keys($post->ID);

	if ( is_array( $custom_keys ) and in_array( $fieldname, $custom_keys ) ) {
		$value = get_post_meta( $post->ID, $fieldname, true );
		$value = call_user_func( $params['esc_func'], $value );
	} else {
		$value = $params['default'];
	}

	echo $params['before'];

	if( !empty($label) ) {
		?><label for="<?php echo esc_attr( $fieldname ); ?>" class="<?php echo esc_attr( $params['label_class'] ); ?>"><?php echo $label; ?></label><?php
	}

	?><textarea id="<?php echo esc_attr( $fieldname ); ?>" name="<?php echo esc_attr( $fieldname ); ?>" class="<?php echo esc_attr( $params['input_class'] ); ?>"><?php echo esc_textarea( $value ); ?></textarea><?php

	echo $params['after'];

}
endif;

if( !function_exists('ci_metabox_dropdown') ):
function ci_metabox_dropdown( $fieldname, $options, $label, $params = array() ) {
	global $post;
	$options = (array)$options;

	$defaults = array(
		'before'  => '<p class="ci-field-group ci-field-dropdown">',
		'after'   => '</p>',
		'default' => ''
	);
	$params = wp_parse_args( $params, $defaults );

	$custom_keys = get_post_custom_keys($post->ID);

	if ( is_array( $custom_keys ) and in_array( $fieldname, $custom_keys ) ) {
		$value = get_post_meta( $post->ID, $fieldname, true );
	} else {
		$value = $params['default'];
	}

	echo $params['before'];

	if( !empty($label) ) {
		?><label for="<?php echo esc_attr($fieldname); ?>"><?php echo $label; ?></label><br><?php
	}

	?>
		<select id="<?php echo esc_attr( $fieldname ); ?>" name="<?php echo esc_attr( $fieldname ); ?>">
			<?php foreach($options as $opt_val => $opt_label): ?>
				<option value="<?php echo esc_attr( $opt_val ); ?>" <?php selected( $value, $opt_val ); ?>><?php echo esc_html( $opt_label ); ?></option>
			<?php endforeach; ?>
		</select>
	<?php

	echo $params['after'];
}
endif;

if( !function_exists('ci_metabox_radio') ):
// $fieldname is the actual name="" attribute common to all radios in the group.
// $optionname is the id of the radio, so that the label can be associated with it.
function ci_metabox_radio( $fieldname, $optionname, $optionval, $label, $params = array() ) {
	global $post;

	$defaults = array(
		'before'  => '<p class="ci-field-group ci-field-radio">',
		'after'   => '</p>',
		'default' => ''
	);
	$params = wp_parse_args( $params, $defaults );

	$custom_keys = get_post_custom_keys($post->ID);

	if ( is_array( $custom_keys ) and in_array( $fieldname, $custom_keys ) ) {
		$value = get_post_meta( $post->ID, $fieldname, true );
	} else {
		$value = $params['default'];
	}

	echo $params['before'];
	?>
		<input type="radio" class="radio" id="<?php echo esc_attr($optionname); ?>" name="<?php echo esc_attr($fieldname); ?>" value="<?php echo esc_attr($optionval); ?>" <?php checked($value, $optionval); ?> />
		<label for="<?php echo esc_attr($optionname); ?>" class="radio"><?php echo $label; ?></label>
	<?php
	echo $params['after'];
}
endif;

if( !function_exists('ci_metabox_checkbox') ):
function ci_metabox_checkbox( $fieldname, $value, $label, $params = array() ) {
	global $post;

	$defaults = array(
		'before'  => '<p class="ci-field-group ci-field-checkbox">',
		'after'   => '</p>',
		'default' => ''
	);
	$params = wp_parse_args( $params, $defaults );

	$custom_keys = get_post_custom_keys($post->ID);

	if ( is_array( $custom_keys ) and in_array( $fieldname, $custom_keys ) ) {
		$checked = get_post_meta( $post->ID, $fieldname, true );
	} else {
		$checked = $params['default'];
	}

	echo $params['before'];
	?>
		<input type="checkbox" id="<?php echo esc_attr($fieldname); ?>" class="check" name="<?php echo esc_attr($fieldname); ?>" value="<?php echo esc_attr($value); ?>" <?php checked($checked, $value); ?> />
		<label for="<?php echo esc_attr($fieldname); ?>"><?php echo $label; ?></label>
	<?php
	echo $params['after'];
}
endif;


if( !function_exists('ci_metabox_open_tab') ):
function ci_metabox_open_tab( $title ) {
	?>
	<div class="ci-cf-section">
		<?php if ( ! empty( $title ) ): ?>
			<h3 class="ci-cf-title"><?php echo esc_html($title); ?></h3>
		<?php endif; ?>
		<div class="ci-cf-inside">
	<?php
}
endif;

if( !function_exists('ci_metabox_close_tab') ):
function ci_metabox_close_tab() {
	?>
		</div>
	</div>
	<?php
}
endif;



if( !function_exists('ci_metabox_open_collapsible') ):
function ci_metabox_open_collapsible( $title ) {
	?>
	<div class="postbox" style="margin-top:20px">
		<div class="handlediv" title="<?php esc_attr_e('Click to toggle', 'ci_theme'); ?>"><br></div>
		<h3 class="hndle"><?php echo esc_html($title); ?></h3>
		<div class="inside">
	<?php
}
endif;

if( !function_exists('ci_metabox_close_collapsible') ):
function ci_metabox_close_collapsible() {
	?>
		</div>
	</div>
	<?php
}
endif;

if( !function_exists('ci_metabox_guide') ):
function ci_metabox_guide( $strings, $params = array() ) {
	$defaults = array(
		'type'        => 'auto', // auto, p, ol, ul
		'before'      => '',
		'before_each' => '',
		'after'       => '',
		'after_each'  => '',
	);
	$params = wp_parse_args( $params, $defaults );

	if ( empty( $strings ) ) {
		return;
	}

	if ( $params['type'] == 'auto' ) {
		if ( is_array( $strings ) && count( $strings ) > 1 ) {
			$params['type'] = 'ol';
		} else {
			$params['type'] = 'p';
		}
	}

	if ( is_string( $strings ) ) {
		$strings = array( $strings );
	}

	if ( $params['type'] == 'p' ) {
		$params['before_each'] = '<p class="ci-cf-guide">';
		$params['after_each']  = '</p>';
	} elseif ( $params['type'] == 'ol' ) {
		$params['before']      = '<ol class="ci-cf-guide">';
		$params['before_each'] = '<li>';
		$params['after']       = '</ol>';
		$params['after_each']  = '</li>';
	} elseif ( $params['type'] == 'ul' ) {
		$params['before']      = '<ul class="ci-cf-guide">';
		$params['before_each'] = '<li>';
		$params['after']       = '</ul>';
		$params['after_each']  = '</li>';
	}

	echo $params['before'];
	foreach ( $strings as $string ) {
		echo $params['before_each'] . $string . $params['after_each'];
	}
	echo $params['after'];
}
endif;


if( !function_exists('ci_bind_metabox_to_page_template') ):
function ci_bind_metabox_to_page_template( $metabox_id, $template_file, $js_var ) {
	if ( is_array( $template_file ) ) {
		$template_file = implode( "', '", $template_file );
	}

	$js = <<<ENDJS
	var template_box = $('#page_template');
	if(template_box.length > 0) {

		var {$js_var} = $('#{$metabox_id}');
		var {$js_var}_template = ['{$template_file}'];

		{$js_var}.hide();
		//if( template_box.val() == {$js_var}_template)
		if( $.inArray( template_box.val(), {$js_var}_template ) > -1 ) {
			{$js_var}.show();
		}

		template_box.change(function(){
			//if( template_box.val() == {$js_var}_template)
			if( $.inArray( template_box.val(), {$js_var}_template ) > -1 ) {
				{$js_var}.show();
				if ( typeof google === 'object' && typeof google.maps === 'object' ) {
					if ( {$js_var}.find( '.gllpLatlonPicker' ).length > 0 ) {
						google.maps.event.trigger( window, 'resize', {} );
					}
				}
			} else {
				{$js_var}.hide();
			}
					
		});
		
	}
ENDJS;

	ci_add_inline_js($js, sanitize_key('metabox_template_'.$metabox_id.'_'.$template_file));
}
endif;
