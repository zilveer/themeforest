<?php


add_action( 'admin_enqueue_scripts', 'lp_admin_enqueue' );

function lp_admin_enqueue( $hook ) {
	global $post;

	//enqueue styles and scripts
	wp_enqueue_style( 'lp-admin-css', LANDINGPAGES_URLPATH . 'css/admin-style.css' );

	//jquery cookie
	wp_dequeue_script( 'jquery-cookie' );
	wp_enqueue_script( 'jquery-cookie', LANDINGPAGES_URLPATH . 'js/jquery.cookie.js' );

	//jpicker - color picker
	wp_enqueue_script( 'jpicker', LANDINGPAGES_URLPATH . 'js/jpicker/jpicker-1.1.6.min.js' );
	wp_localize_script( 'jpicker', 'jpicker', array( 'thispath' => LANDINGPAGES_URLPATH.'js/jpicker/images/' ) );
	wp_enqueue_style( 'jpicker-css', LANDINGPAGES_URLPATH . 'js/jpicker/css/jPicker-1.1.6.min.css' );
	wp_enqueue_style( 'jpicker-css', LANDINGPAGES_URLPATH . 'js/jpicker/css/jPicker.css' );

	//Tool tip script
	wp_dequeue_script( 'jquery-qtip' );
	wp_enqueue_script( 'jquery-qtip', LANDINGPAGES_URLPATH . 'js/jquery-qtip/jquery.qtip.min.js' );
	wp_enqueue_script( 'load-qtip', LANDINGPAGES_URLPATH . 'js/jquery-qtip/load.qtip.js' );

	//Tool tip css
	wp_enqueue_style( 'qtip-css', LANDINGPAGES_URLPATH . 'css/jquery.qtip.min.css' );

	//easyXDM - for store rendering
	if ( isset( $_GET['page'] ) && ( ( $_GET['page'] == 'lp_store' ) || ( $_GET['page'] == 'lp_addons' ) ) ) {
		wp_dequeue_script( 'easyXDM' );
		wp_enqueue_script( 'easyXDM', LANDINGPAGES_URLPATH . 'js/easyXDM.debug.js' );
	}


	//Admin enqueue - Landing Page CPT only
	if ( isset( $post ) && 'landing-page' == $post->post_type ) {
		wp_enqueue_script( 'lp-post-edit-ui', LANDINGPAGES_URLPATH . 'js/admin.post-edit.js' );

		//admin.metaboxes.js - Template Selector - Media Uploader
		wp_enqueue_script( 'lp-js-metaboxes', LANDINGPAGES_URLPATH . 'js/admin.metaboxes.js' );

		$template_data = lp_get_template_data();
		$template_data = json_encode( $template_data );

		$template = get_post_meta( $post->ID, 'lp-selected-template', true );
		$template = strtolower( $template );

		$params = array( 'selected_template'=>$template, 'templates'=>$template_data );
		wp_localize_script( 'lp-js-metaboxes', 'data', $params );
		wp_enqueue_script( 'lp-js-isotope', LANDINGPAGES_URLPATH . 'js/isotope/jquery.isotope.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_style( 'lp-css-isotope', LANDINGPAGES_URLPATH . 'js/isotope/css/style.css' );

		// Admin UI for add new landing page
		if ( $hook == 'post-new.php' && ( isset( $_GET['post_type'] ) && ( $_GET['post_type'] == 'landing-page' ) ) ) {
			// Create New Landing Jquery UI
			wp_enqueue_script( 'lp-js-create-new-lander', LANDINGPAGES_URLPATH . 'js/admin.post-new.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'lp-css-post-new', LANDINGPAGES_URLPATH . 'css/admin-post-new.css' );
		}

		// Admin UI for normal page editing
		if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
			// Conditional TINYMCE for landing pages
			wp_dequeue_script( 'jquery-tinymce' );
			wp_enqueue_script( 'jquery-tinymce', LANDINGPAGES_URLPATH . 'js/tiny_mce/jquery.tinymce.js' );


			// jquery datepicker
			wp_enqueue_script( 'jquery-datepicker', LANDINGPAGES_URLPATH . 'js/jquery-datepicker/jquery.timepicker.min.js' );
			wp_enqueue_script( 'jquery-datepicker-functions', LANDINGPAGES_URLPATH . 'js/jquery-datepicker/picker_functions.js' );
			wp_enqueue_script( 'jquery-datepicker-base', LANDINGPAGES_URLPATH . 'js/jquery-datepicker/lib/base.js' );
			wp_enqueue_script( 'jquery-datepicker-datepair', LANDINGPAGES_URLPATH . 'js/jquery-datepicker/lib/datepair.js' );
			wp_localize_script( 'jquery-datepicker', 'jquery_datepicker', array( 'thispath' => LANDINGPAGES_URLPATH.'js/jquery-datepicker/' ) );
			wp_enqueue_style( 'jquery-timepicker-css', LANDINGPAGES_URLPATH . 'js/jquery-datepicker/jquery.timepicker.css' );
			wp_enqueue_style( 'jquery-datepicker-base.css', LANDINGPAGES_URLPATH . 'js/jquery-datepicker/lib/base.css' );
		}
	}
}


function lp_get_template_data_cats( $array ) {
	foreach ( $array as $key=>$val ) {
		$cat_value = $val['category'];
		$name = str_replace( array( '-', '_' ), ' ', $cat_value );
		$name = ucwords( $name );
		if ( !isset( $template_cats[$cat_value] ) ) {
			$template_cats[$cat_value]['count'] = 1;
			$template_cats[$cat_value]['value'] = $cat_value;
			//$template_cats[$cat_value]['label'] = "$name (".$template_cats[$cat_value]['count'].")";
			$template_cats[$cat_value]['label'] = "$name";
		}
		else {
			$template_cats[$cat_value]['count']++;
			//$template_cats[$cat_value]['label'] = "$name (".$template_cats[$cat_value]['count'].")";
			$template_cats[$cat_value]['label'] = "$name";
			$template_cats[$cat_value]['value'] = $cat_value;
		}
	}
	//print_r($template_cats);exit;

	return $template_cats;
}

function lp_list_feature( $label, $url=null ) {
	return array(
		"label" => $label,
		"url" => $url
	);
}

function lp_generate_meta() {
	global $lp_data;
	//print_r($lp_data);exit;
	foreach ( $lp_data as $key=>$array ) {
		if ( $key!='lp'&&substr( $key, 0, 4 )!='ext-' ) {
			$template_name = ucwords( str_replace( '-', ' ', $key ) );
			$id = strtolower( str_replace( ' ', '-', $key ) );
			//echo $key."<br>";
			add_meta_box(
				"lp_{$id}_custom_meta_box", // $id
				__( "<small>Template Options:</small>", "ch" ),
				'lp_show_metabox', // $callback
				'landing-page', // post-type
				'normal', // $context
				'default', // $priority
				array( 'key'=>$key )
			); //callback args
		}
	}
	foreach ( $lp_data as $key=>$array ) {
		if ( substr( $key, 0, 4 )=='ext-' ) {
			$id = strtolower( str_replace( ' ', '-', $key ) );
			$name = ucwords( str_replace( array( '-', 'ext ' ), ' ', $key ) );
			//echo $key."<br>";
			add_meta_box(
				"lp_{$id}_custom_meta_box", // $id
				$name . __( " Extension Options", "ch" ),
				'lp_show_metabox', // $callback
				'landing-page', // post-type
				'normal', // $context
				'default', // $priority
				array( 'key'=>$key )
			); //callback args
		}
	}

}

// The Callback
function lp_show_metabox( $post, $key ) {
	global $lp_data;
	$key = $key['args']['key'];
	$lp_custom_fields = $lp_data[$key]['options'];
	lp_render_metabox( $key, $lp_custom_fields, $post );
}

add_action( 'save_post', 'lp_save_meta' );
function lp_save_meta( $post_id ) {
	global $lp_data;
	global $post;

	if ( !isset( $post )||isset( $_POST['split_test'] ) )
		return;
	if ( $post->post_type=='revision' ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ||$_POST['post_type']=='revision' ) {
		return;
	}

	if ( $post->post_type=='landing-page' ) {
		//print_r($lp_data);exit;
		//echo $_POST['lp-selected-template'];
		foreach ( $lp_data as $key=>$data ) {
			if ( $key=='lp' ) {
				// verify nonce
				if ( !wp_verify_nonce( $_POST["lp_{$key}_custom_fields_nonce"], 'lp-nonce' ) ) {
					return $post_id;
				}

				$lp_custom_fields = $lp_data[$key]['options'];

				foreach ( $lp_custom_fields as $field ) {
					$old = get_post_meta( $post_id, $field['id'], true );
					$new = $_POST[$field['id']];

					if ( isset( $new ) && $new != $old ) {
						update_post_meta( $post_id, $field['id'], $new );
					} elseif ( '' == $new && $old ) {
						delete_post_meta( $post_id, $field['id'], $old );
					}
				}
			}
			else if ( $_POST['lp-selected-template']==$key||substr( $key, 0, 4 )=='ext-' ) {

					$lp_custom_fields = $lp_data[$key]['options'];

					// verify nonce
					if ( !wp_verify_nonce( $_POST["lp_{$key}_custom_fields_nonce"], 'lp-nonce' ) ) {
						return $post_id;
					}

					// loop through fields and save the data
					foreach ( $lp_custom_fields as $field ) {
						//echo $key.":".$field['id'];

						if ( $field['type'] == 'tax_select' ) continue;
						$old = get_post_meta( $post_id, $field['id'], true );
						$new = $_POST[$field['id']];
						//echo "$old:".$new."<br>";

						if ( isset( $new ) && $new != $old ) {
							update_post_meta( $post_id, $field['id'], $new );
						} elseif ( '' == $new && $old ) {
							delete_post_meta( $post_id, $field['id'], $old );
						}
					} // end foreach
					//exit;
				}
		}
		//exit;
		// save taxonomies
		$post = get_post( $post_id );
		//$category = $_POST['landing_page_category'];
		//wp_set_object_terms( $post_id, $category, 'landing_page_category' );
	}
}

add_action( 'wp_trash_post', 'lp_trash_lander' );
function lp_trash_lander( $post_id ) {
	global $lp_data;
	global $post;

	if ( !isset( $post )||isset( $_POST['split_test'] ) )
		return;
	if ( $post->post_type=='revision' ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ||$_POST['post_type']=='revision' ) {
		return;
	}

	if ( $post->post_type=='landing-page' ) {

		$lp_id = $post->ID;

		$args=array(
			'post_type' => 'landing-page-group',
			'post_satus'=>'publish'
		);

		$my_query = null;
		$my_query = new WP_Query( $args );

		if ( $my_query->have_posts() ) {
			$i=1;
			while ( $my_query->have_posts() ) : $my_query->the_post();
			$group_id = get_the_ID();
			$group_data = get_the_content();
			$group_data = json_decode( $group_data, true );

			$lp_ids = array();
			foreach ( $group_data as $key=>$value ) {
				$lp_ids[] = $key;
			}

			if ( in_array( $lp_id, $lp_ids ) ) {
				unset( $group_data[$lp_id] );
				//echo 1; exit;
				$this_data = json_encode( $group_data );
				//print_r($this_data);
				$new_post = array(
					'ID' => $group_id,
					'post_title' => get_the_title(),
					'post_content' => $this_data,
					'post_status' => 'publish',
					'post_date' => date( 'Y-m-d H:i:s' ),
					'post_author' => 1,
					'post_type' => 'landing-page-group'
				);
				//print_r($new_post);
				$post_id = wp_update_post( $new_post );
			}
			endwhile;
		}
	}
}

function lp_add_option( $key, $type, $id, $default=null, $label=null, $description=null, $options=null ) {
	switch ( $type ) {
	case "colorpicker":
		return array(
			'label' => $label,
			'desc'  => $description,
			'id'    => $key.'-'.$id,
			'type'  => 'colorpicker',
			'default'  => $default
		);
		break;
	case "text":
		return array(
			'label' => $label,
			'desc'  => $description,
			'id'    => $key.'-'.$id,
			'type'  => 'text',
			'default'  => $default
		);
		break;
	case "textarea":
		return array(
			'label' => $label,
			'desc'  => $description,
			'id'    => $key.'-'.$id,
			'type'  => 'textarea',
			'default'  => $default
		);
		break;
	case "wysiwyg":
		return array(
			'label' => $label,
			'desc'  => $description,
			'id'    => $key.'-'.$id,
			'type'  => 'wysiwyg',
			'default'  => $default
		);
		break;
	case "media":
		return array(
			'label' => $label,
			'desc'  => $description,
			'id'    => $key.'-'.$id,
			'type'  => 'media',
			'default'  => $default
		);
		break;
	case "checkbox":
		return array(
			'label' => $label,
			'desc'  => $description,
			'id'    => $key.'-'.$id,
			'type'  => 'checkbox',
			'default'  => $default,
			'options' => $options
		);
		break;
	case "radio":
		return array(
			'label' => $label,
			'desc'  => $description,
			'id'    => $key.'-'.$id,
			'type'  => 'radio',
			'default'  => $default,
			'options' => $options
		);
		break;
	case "dropdown":
		return array(
			'label' => $label,
			'desc'  => $description,
			'id'    => $key.'-'.$id,
			'type'  => 'dropdown',
			'default'  => $default,
			'options' => $options
		);
		break;
	case "datepicker":
		return array(
			'label' => $label,
			'desc'  => $description,
			'id'    => $key.'-'.$id,
			'type'  => 'datepicker',
			'default'  => $default
		);
		break;
	}
}

function lp_render_metabox( $key, $custom_fields, $post ) {
	// Use nonce for verification
	echo "<input type='hidden' name='lp_{$key}_custom_fields_nonce' value='".wp_create_nonce( 'lp-nonce' )."' />";

	// Begin the field table and loop
	echo '<table class="form-table" >';
	//print_r($custom_fields);exit;
	foreach ( $custom_fields as $field ) {
		$raw_option_id = str_replace( $key . "-", "", $field['id'] );
		$label_class = $raw_option_id . "-label";
		// get value of this field if it exists for this post
		$meta = get_post_meta( $post->ID, $field['id'], true );

		if ( ( !isset( $meta )&&isset( $field['default'] ) )||isset( $meta )&&empty( $meta )&&isset( $field['default'] )&&$meta!==0 ) {
			$meta = $field['default'];
		}

		// begin a table row with
		echo '<tr class="'.$field['id'].' '.$raw_option_id.'">
				<th class="landing-page-table-header '.$label_class.'"><label for="'.$field['id'].'">'.$field['label'].'</label></th>
				<td>';
		switch ( $field['type'] ) {
			// text
		case 'colorpicker':
			if ( !$meta ) {
				$meta = $field['default'];
			}
			echo '<input type="text" class="jpicker" style="background-color:#'.$meta.'" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="5" />
								<div class="lp_tooltip tool_color" title="'.$field['desc'].'"></div>';
			break;
		case 'datepicker':
			echo '<div class="jquery-date-picker" id="date-picking">
						<span class="datepair" data-language="javascript">
									Date: <input type="text" id="date-picker-'.$key.'" class="date start" /></span>
									Time: <input id="time-picker-'.$key.'" type="text" class="time time-picker" />
									<input type="hidden" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" class="new-date" value="" >
									<p class="description">'.$field['desc'].'</p>
							</div>';
			break;
		case 'text':
			echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<div class="lp_tooltip" title="'.$field['desc'].'"></div>';
			break;
			// textarea
		case 'textarea':
			echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="106" rows="6" style="width: 75%;">'.$meta.'</textarea>
								<div class="lp_tooltip tool_textarea" title="'.$field['desc'].'"></div>';
			break;
			// wysiwyg
		case 'wysiwyg':
			wp_editor( $meta, $field['id'], $settings = array() );
			echo '<p class="description">'.$field['desc'].'</p>';
			break;
			// media
		case 'media':
			//echo 1; exit;
			echo '<label for="upload_image">';
			echo '<input name="'.$field['id'].'"  id="'.$field['id'].'" type="text" size="36" name="upload_image" value="'.$meta.'" />';
			echo '<input class="upload_image_button" id="uploader_'.$field['id'].'" type="button" value="Upload Image" />';
			echo '<p class="description">'.$field['desc'].'</p>';
			break;
			// checkbox
		case 'checkbox':
			$i = 1;
			echo "<table class='lp_check_box_table'>";
			if ( !isset( $meta ) ) {$meta=array();}
			elseif ( !is_array( $meta ) ) {
				$meta = array( $meta );
			}
			foreach ( $field['options'] as $value=>$label ) {
				if ( $i==5||$i==1 ) {
					echo "<tr>";
					$i=1;
				}
				echo '<td><input type="checkbox" name="'.$field['id'].'[]" id="'.$field['id'].'" value="'.$value.'" ', in_array( $value, $meta ) ? ' checked="checked"' : '', '/>';
				echo '<label for="'.$value.'">&nbsp;&nbsp;'.$label.'</label></td>';
				if ( $i==4 ) {
					echo "</tr>";
				}
				$i++;
			}
			echo "</table>";
			echo '<div class="lp_tooltip tool_checkbox" title="'.$field['desc'].'"></div>';
			break;
			// radio
		case 'radio':
			foreach ( $field['options'] as $value=>$label ) {
				//echo $meta.":".$field['id'];
				//echo "<br>";
				echo '<input type="radio" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$value.'" ', $meta==$value ? ' checked="checked"' : '', '/>';
				echo '<label for="'.$value.'">&nbsp;&nbsp;'.$label.'</label> &nbsp;&nbsp;&nbsp;&nbsp;';
			}
			echo '<div class="lp_tooltip" title="'.$field['desc'].'"></div>';
			break;
			// select
		case 'dropdown':
			echo '<select name="'.$field['id'].'" id="'.$field['id'].'" class="'.$raw_option_id.'">';
			foreach ( $field['options'] as $value=>$label ) {
				echo '<option', $meta == $value ? ' selected="selected"' : '', ' value="'.$value.'">'.$label.'</option>';
			}
			echo '</select><div class="lp_tooltip" title="'.$field['desc'].'"></div>';
			break;



		} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}

function lp_render_global_settings( $key, $custom_fields, $active_tab ) {

	//Check if active tab
	if ( $key==$active_tab ) {
		$display = 'block';
	}
	else {
		$display = 'none';
	}

	// Use nonce for verification
	echo "<input type='hidden' name='lp_{$key}_custom_fields_nonce' value='".wp_create_nonce( 'lp-nonce' )."' />";

	// Begin the field table and loop
	echo '<table class="lp-tab-display" id="'.$key.'" style="display:'.$display.'">';
	//print_r($custom_fields);exit;
	foreach ( $custom_fields as $field ) {
		//echo $field['type'];exit;
		// get value of this field if it exists for this post
		if ( isset( $field['default'] ) ) {
			$default = $field['default'];
		}
		else {
			$default = null;
		}

		$option = get_option( $field['id'], $default );

		// begin a table row with
		echo '<tr>
				<th class="lp-gs-th" valign="top" style="font-weight:300px;"><small>'.$field['label'].':</small></th>
				<td>';
		switch ( $field['type'] ) {
			// text
		case 'colorpicker':
			if ( !$option ) {
				$option = $field['default'];
			}
			echo '<input type="text" class="jpicker" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$option.'" size="5" />
								<div class="lp_tooltip tool_color" title="'.$field['desc'].'"></div>';
			break;
		case 'datepicker':
			echo '<input id="datepicker-example2" class="Zebra_DatePicker_Icon" type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$option.'" size="8" />
								<div class="lp_tooltip tool_date" title="'.$field['desc'].'"></div><p class="description">'.$field['desc'].'</p>';
			break;
		case 'text':
			echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$option.'" size="30" />
								<div class="lp_tooltip tool_text" title="'.$field['desc'].'"></div>';
			break;
			// textarea
		case 'textarea':
			echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="106" rows="6">'.$option.'</textarea>
								<div class="lp_tooltip tool_textarea" title="'.$field['desc'].'"></div>';
			break;
			// wysiwyg
		case 'wysiwyg':
			wp_editor( $option, $field['id'], $settings = array() );
			echo '<span class="description">'.$field['desc'].'</span><br><br>';
			break;
			// media
		case 'media':
			//echo 1; exit;
			echo '<label for="upload_image">';
			echo '<input name="'.$field['id'].'"  id="'.$field['id'].'" type="text" size="36" name="upload_image" value="'.$option.'" />';
			echo '<input class="upload_image_button" id="uploader_'.$field['id'].'" type="button" value="Upload Image" />';
			echo '<br /><div class="lp_tooltip tool_media" title="'.$field['desc'].'"></div>';
			break;
			// checkbox
		case 'checkbox':
			$i = 1;
			echo "<table>";
			if ( !isset( $option ) ) {$option=array();}
			elseif ( !is_array( $option ) ) {
				$option = array( $option );
			}
			foreach ( $field['options'] as $value=>$label ) {
				if ( $i==5||$i==1 ) {
					echo "<tr>";
					$i=1;
				}
				echo '<td><input type="checkbox" name="'.$field['id'].'[]" id="'.$field['id'].'" value="'.$value.'" ', in_array( $value, $option ) ? ' checked="checked"' : '', '/>';
				echo '<label for="'.$value.'">&nbsp;&nbsp;'.$label.'</label></td>';
				if ( $i==4 ) {
					echo "</tr>";
				}
				$i++;
			}
			echo "</table>";
			echo '<br><div class="lp_tooltip tool_checkbox" title="'.$field['desc'].'"></div><p class="description">'.$field['desc'].'</p>';
			break;
			// radio
		case 'radio':
			foreach ( $field['options'] as $value=>$label ) {
				//echo $meta.":".$field['id'];
				//echo "<br>";
				echo '<input type="radio" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$value.'" ', $option==$value ? ' checked="checked"' : '', '/>';
				echo '<label for="'.$value.'">&nbsp;&nbsp;'.$label.'</label> &nbsp;&nbsp;&nbsp;&nbsp;';
			}
			echo '<div class="lp_tooltip tool_radio" title="'.$field['desc'].'"></div>';
			break;
			// select
		case 'dropdown':
			echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
			foreach ( $field['options'] as $value=>$label ) {
				echo '<option', $option == $value ? ' selected="selected"' : '', ' value="'.$value.'">'.$label.'</option>';
			}
			echo '</select><br /><div class="lp_tooltip tool_dropdown" title="'.$field['desc'].'"></div>';
			break;



		} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}


//generates drop down select of landing pages
function lp_generate_drowndown( $select_id, $post_type, $selected = 0, $width = 400, $height = 230, $font_size = 13, $multiple=true ) {
	$post_type_object = get_post_type_object( $post_type );
	$label = $post_type_object->label;

	if ( $multiple==true ) {
		$multiple = "multiple='multiple'";
	}
	else {
		$multiple = "";
	}

	$posts = get_posts( array( 'post_type'=> $post_type, 'post_status'=> 'publish', 'suppress_filters' => false, 'posts_per_page'=>-1 ) );
	echo '<select name="'. $select_id .'" id="'.$select_id.'" class="lp-multiple-select" style="width:'.$width.'px;height:'.$height.'px;font-size:'.$font_size.'px;"  '.$multiple.'>';
	foreach ( $posts as $post ) {
		echo '<option value="', $post->ID, '"', $selected == $post->ID ? ' selected="selected"' : '', '>', $post->post_title, '</option>';
	}
	echo '</select>';
}



function lp_ready_screenshot_url( $link, $datetime ) {
	return $link.'?dt='.$datetime;
}


function lp_display_success( $message ) {
	echo "<br><br><center>";
	echo "<font color='green'><i>".$message."</i></font>";
	echo "</center>";
}


function lp_make_percent( $rate, $return = false ) {
	//echo "1{$rate}2";exit;
	//yes, we know this is not a true filter
	if ( is_numeric( $rate ) ) {
		$percent = $rate * ( 100 );
		$percent = number_format( $percent, 1 );
		if ( $return ) { return $percent."%"; } else { echo $percent."%"; }
	}
	else {
		if ( $return ) { return $rate; } else { echo $rate; }
	}
}

function lp_wpseo_priority() { return 'low';}
add_filter( 'wpseo_metabox_prio', 'lp_wpseo_priority' );
add_action( 'in_admin_header', 'lp_in_admin_header' );
function lp_in_admin_header() {
	global $wp_meta_boxes;
	//unset( $wp_meta_boxes[get_current_screen()->id]['normal']['core']['postcustom'] );
}

?>
