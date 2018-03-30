<?php
/**
 * todo add filter for more field type
 * todo add display for more field type
 *
 */

class PGL_Addon_Acf {
	static $acf_fields = array();

	static function init() {
//		add_action( 'estate/search_field/after_default_fields_listing', array( "PGL_Addon_Acf", "display_searchable_fields" ) );
		add_filter( 'estate/search_field/after_default_fields_listing', array( "PGL_Addon_Acf", "display_searchable_fields" ), 10, 2 );
		//filters
		add_filter( 'estate/filter/search/meta_query', array( "PGL_Addon_Acf", "filter_meta_query" ) );
		add_filter( 'estate/single/fields', array( "PGL_Addon_Acf", "add_field_to_single_estate" ),10,2 );
		add_filter( 'estate/list/fields', array( "PGL_Addon_Acf", "add_field_to_list_display" ) );

		add_action( 'estate/widget/estate_search_form', array( 'PGL_Addon_Acf', "add_fields_to_estate_search_widget" ), 1, 2 );
		add_filter( 'estate/widget/estate_search_update', array( 'PGL_Addon_Acf', "update_estate_search_widget" ), 1, 2 );
	}

	static function info() {
		return array(
			'title' => 'ACF Addon'
		);
	}

	static function is_usable() {
		return post_type_exists( 'estate' );
	}

	/**
	 * @internal param \PGL_Options $pgl_options
	 */
	static function add_option_panel() {
		/**
		 * @var PGL_Options $pgl_options
		 */
		global $pgl_options;
		$acf = array(
			'id'         => 'acf',
			'icon'       => 'th-list',
			'title'      => __( 'ACF Integration', PGL ),
			'desc'       => __( 'You can change settings for Advanced Custom Fields plugins here ', PGL ),
			'sub_desc'   => __( 'Just a dummy description', PGL ),
			'fields'     => array(
				array(
					'id'       => 'acf_searchable_fields',
					'title'    => __( 'Searchable fields', PGL ),
					'callback' => array( 'PGL_Addon_Acf', 'acf_searchable_callback' ),
					'sub_desc' => __( 'Note : Only fields that have type of number,text,textarea,email are searchable', PGL )
				),
				array(
					'id' => 'acf_display_fields',
					'title' => __('Display on listing', PGL),
					'callback' => array( 'PGL_Addon_Acf', 'acf_searchable_callback')
				)
			)
		);



		$fs  = $pgl_options->option( 'acf_searchable_fields' );

		if ( ! empty( $fs ) && function_exists( 'get_field_object' ) ) {
			$query      = new WP_Query( array( 'post_type' => 'acf' ) );
			$temp_array = array();
			foreach ( $query->get_posts() as $group ) {
				$metas = get_post_meta( $group->ID );
				foreach ( array_keys( $metas ) as $k ) {
					if ( ! PGL_Utilities::startsWith( $k, 'field_' ) ) {
						unset( $metas[$k] );
					}
				}
				$temp_array += $metas;
			}

			foreach ( $fs as $fk ) {
				if ( isset( $temp_array[$fk] ) ) {
					$arr = unserialize( $temp_array[$fk][0] );
					switch ( $arr['type'] ) {
						case 'number':
						{
							$acf['fields'][] = array(
								'id'    => 'acf_searchable_field_' . $arr['name'],
								'title' => __( 'Configure values for ' . $arr['label'] ),
								'type'  => 'textarea',
								'desc'  => ''
							);
							break;
						}

						case 'date_picker':
						{
							$acf['fields'][] = array(
								'id'      => 'acf_searchable_field_' . $arr['name'],
								'title'   => __( 'Configure search type for ' . $arr['label'] ),
								'type'    => 'select',
								'options' => array(
									'match' => __( 'Match exactly', PGL ),
									'range' => __( 'Use range', PGL )
								)
							);
							break;
						}

						default:
							continue;
					}
				}
			}
		}
		$pgl_options->add_section( $acf );
	}

	static function acf_searchable_callback( $field, $value ) {
		/**
		 * @var PGL_Options $pgl_options
		 */
		global $pgl_options;
		if ( class_exists( 'acf' ) ) {
			$acf        = new acf_field_group();
			$acf_groups = array_unique( apply_filters( 'acf/location/match_field_groups', array(), array( 'post_type' => 'estate' ) ) );

			if ( ! empty( $acf_groups ) ) {
				foreach ( $acf_groups as $group_id ) {
					$fields = $acf->get_fields( array(), $group_id );
                    //error_log(print_r($fields, true));
					if ( ! empty( $fields ) ) {
						$group = get_post( $group_id );
						echo '<h4>' . get_the_title( $group ) . '</h4>';
						if ( ! is_array( $value ) )
							$value = array();
						$searchable_type = array( 'text', 'number', 'email', 'textarea', 'date_picker', 'select' ); //specify types that are searchable
						foreach ( $fields as $f ) {
							if ( ! in_array( $f['type'], $searchable_type ) )
								continue;
							echo "<div style='margin-top:10px'><label class='switch_wrap'><input type='checkbox' name='" . $pgl_options->THEME_OPTION . "[{$field['id']}][]" . "' value='{$f['key']}' " . ( in_array( $f['key'], $value ) ? 'checked="checked"' : '' ) . " /><div class='switch'><span class='bullet'></span></div> {$f['label']} </label></div>";
						}
					}
				}
			}
		}
	}

	static function filter_meta_query( $conditions = array() ) {
		/**
		 * @var PGL_Options $pgl_options
		 */
		global $pgl_options;
		$searchable_fields = $pgl_options->option( 'acf_searchable_fields' );
		if ( ! empty( $searchable_fields ) && function_exists( 'get_field_object' ) ) {
			$filterable = apply_filters( 'PGL/Addon/ACF/filterable', array( 'text', 'textarea', 'select', 'number', 'date_picker' ) );
			foreach ( $searchable_fields as $field_key ) {
				$field = get_field_object( $field_key );
				if ( ! in_array( $field['type'], $filterable ) || ! is_callable( array( 'PGL_Addon_Acf', 'filter_' . $field['type'] . '_field' ) ) ) {
					continue;
				}

				call_user_func_array( array( 'PGL_Addon_Acf', 'filter_' . $field['type'] . '_field' ), array( &$conditions, $field ) );
			}
		}
		return $conditions;
	}

	static function filter_text_field( &$conditions = array(), $field ) {
		$filter_key = 'acf_' . $field['name'];
		if ( isset( $_GET[$filter_key] ) && $_GET[$filter_key] ) {
			$conditions[] = array(
				'key'     => $field['name'],
				'value'   => $_GET[$filter_key],
				'compare' => 'LIKE',
			);
		}
	}

	static function filter_number_field( &$conditions = array(), $field ) {
		$filter_key = 'acf_' . $field['name'];
		if ( isset( $_GET[$filter_key] ) && $_GET[$filter_key] ) {
			$conditions[] = array(
				'key'     => $field['name'],
				'value'   => $_GET[$filter_key],
				'compare' => '>=',
				'type'    => 'numeric',
			);
		}
	}
    static function filter_select_field( &$conditions = array(), $field ) {
        $filter_key = 'acf_' . $field['name'];
        if ( isset( $_GET[$filter_key] ) && $_GET[$filter_key] ) {
            $conditions[] = array(
                'key'     => $field['name'],
                'value'   => $_GET[$filter_key],
                'compare' => '='
            );
        }
    }
	static function filter_date_picker_field( &$conditions = array(), $field ) {
		global $pgl_options;
		$search_type = $pgl_options->option( 'acf_searchable_field_' . $field['name'] );
		if ( is_null( $search_type ) ) {
			$search_type = 'match';
		}

		switch ( $search_type ) {
			case 'match':
			{
				$filter_key = 'acf_' . $field['name'];
				if ( isset( $_GET[$filter_key] ) && $_GET[$filter_key] ) {
					$conditions[] = array(
						'key'     => $field['name'],
						'value'   => $_GET[$filter_key],
						'compare' => '=',
						'type'    => 'numeric',
					);
				}
			}
				break;

			case 'range':
			{

				$filter_key_from = 'acf_' . $field['name'] . '_from';
				if ( isset( $_GET[$filter_key_from] ) && $_GET[$filter_key_from] ) {
					$conditions[] = array(
						'key'     => $field['name'],
						'value'   => $_GET[$filter_key_from],
						'compare' => '>=',
						'type'    => 'numeric',
					);
				}

				$filter_key_to = 'acf_' . $field['name'] . '_to';
				if ( isset( $_GET[$filter_key_to] ) && $_GET[$filter_key_to] ) {
					$conditions[] = array(
						'key'     => $field['name'],
						'value'   => $_GET[$filter_key_to],
						'compare' => '<=',
						'type'    => 'numeric',
					);
				}
			}
				break;

			default:
				break;
		}
	}

	static function display_searchable_fields( $html_array = array(), $caller = 'search_form', $wrap = TRUE, $wrap_size = 3 ) {
		/**
		 * @var PGL_Options $pgl_options
		 */
		global $pgl_options;
		$searchable_fields = $pgl_options->option( 'acf_searchable_fields' );
		if ( ! empty( $searchable_fields ) && function_exists( 'get_field_object' ) ) {
			$displayable = apply_filters( 'PGL/Addons/ACF/displayable_fields', array( 'text', 'number', 'select', 'date_picker' ) );
			foreach ( $searchable_fields as $field_key ) {
				$field = get_field_object( $field_key );
				if ( ! in_array( $field['type'], $displayable ) || ! is_callable( array( "PGL_Addon_Acf", 'display_' . $field['type'] . '_search_field' ) ) ) {
					continue;
				}

				$field_array = call_user_func_array( array( 'PGL_Addon_Acf', 'display_' . $field['type'] . '_search_field' ), array( $field ) );
				if ( $caller != 'search_form' ) {
					$wrap = FALSE;
				}
				if ( $wrap ) {
					foreach ( array_keys( $field_array ) as $k ) {
						$field_array[$k] = '<div class="col-md-' . $wrap_size . ' col-sm-' . $wrap_size . '">' . $field_array[$k] . '</div>';
					}
				}
				$html_array = array_merge( $html_array, $field_array );
			}
		}
		return $html_array;
	}

	static function display_text_search_field( $field, $caller = 'search_form' ) {
		$html = array();
		switch ( $caller ) {
			case 'search_form':
			{
				$value = '';
				$name  = 'acf_' . $field['name'];
				if ( isset( $_GET[$name] ) && ! empty( $_GET[$name] ) ) {
					$value = $_GET[$name];
				}
				$html[] = '
					<input class="form-control" type="text" name="acf_' . $field['name'] . '" id="acf_' . $field['name'] . '" value="' . $value . '" placeholder="' . __( 'Search for ' . $field['label'], PGL ) . '" />
				';
				break;
			}

			case 'widget':
			{
				break;
			}
		}
		return apply_filters( 'PGL/Addon/ACF/display_text_search_field', $html );
	}
    static function display_select_search_field( $field, $caller = 'search_form' ) {
        $html = array();
        switch ( $caller ) {
            case 'search_form':
            {
                $value = '';
                $name  = 'acf_' . $field['name'];
                if ( isset( $_GET[$name] ) && ! empty( $_GET[$name] ) ) {
                    $value = $_GET[$name];
                }
                $choices = $field['choices'];
                $html[] = '<select class="form-control" type="text" name="acf_' . $field['name'] . '" id="acf_' . $field['name'] . '">';
                $html[] .= '<option value="">'.$field['label'].'</option>';
                foreach($choices as $k=>$v){
                    $html[] .= '<option value="'.$k.'"'.(($k==$value)?' selected':'').'>'.$v.'</option>';
                }
                $html[] .= '</select>';
                break;
            }

            case 'widget':
            {
                break;
            }
        }
        return apply_filters( 'PGL/Addon/ACF/display_select_search_field', $html );
    }
	static function display_number_search_field( $field, $caller = 'search_form' ) {
		$html = array();
		/**
		 * @var PGL_Options $pgl_options
		 */
		global $pgl_options;
		switch ( $caller ) {
			case 'search_form':
			{
				$cvalue = '';
				$name   = 'acf_' . $field['name'];
				if ( isset( $_GET[$name] ) && $_GET[$name] ) {
					$cvalue = $_GET[$name];
				}
				$values      = $pgl_options->option( 'acf_searchable_field_' . $field['name'] );
				$html_option = '';
				if ( $values ) {
					$values = explode( ';', $values );
					foreach ( $values as $v ) {
						$html_option .= '<option value="' . $v . '" ' . ( $v == $cvalue ? 'selected' : '' ) . '>' . $v . '</option>';
					}

					//todo add filter here
					$html[] = '
					<select name="' . $name . '" id="' . $name . '" class="form-control">
					<option value="" selected>' . __( 'Search for ' . $field['label'] ) . '</option>
					' . $html_option . '
					</select>';
				}

				break;
			}

			case 'widget':
			{
				break;
			}
		}
		return apply_filters( 'PGL/Addon/ACF/display_number_search_field', $html );
	}

	static function display_date_picker_search_field( $field, $caller = 'search_form' ) {
		$html = array();
		global $pgl_options;
		switch ( $caller ) {
			case 'search_form':
			{
				wp_enqueue_script( 'jquery-ui-datepicker' );
				wp_enqueue_style( 'jquery-ui-css', 'http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css' );
				wp_enqueue_script( 'jquery-datepicker-invoke', PGL_URI_JS . 'jquery-datepicker-custom.js', array( 'jquery', 'jquery-ui-datepicker' ), FALSE, TRUE );
				$search_type = $pgl_options->option( 'acf_searchable_field_' . $field['name'] );
				switch ( $search_type ) {
					case 'match':
					{
						$value = '';
						$name  = 'acf_' . $field['name'];
						if ( isset( $_GET[$name] ) && $_GET[$name] ) {
							$value = $_GET[$name];
						}

						$html[] = '
						<input class="keywordfind datepicker_display form-control" type="text" value="' . $value . '" placeholder="' . __( 'Search for ' . $field['label'], PGL ) . '" data-target=".dp-target" />
						<input type="hidden" name="' . $name . '" id="' . $name . '" value="" class="dp-target" />
					';
						break;
					}

					case 'range':
					{
						$value_from = $value_to = '';
						$name_from  = 'acf_' . $field['name'] . '_from';
						$name_to    = 'acf_' . $field['name'] . '_to';
						if ( isset( $_GET[$name_from] ) && $_GET[$name_from] ) {
							$value_from = $_GET[$name_from];
						}

						if ( isset( $_GET[$name_to] ) && $_GET[$name_to] ) {
							$value_to = $_GET[$name_to];
						}

						$html[] = '
						<input class="keywordfind datepicker_display form-control" type="text" value="' . ( $value_from ? date( 'm/d/Y', strtotime( $value_from ) ) : '' ) . '" placeholder="' . __( $field['label'] . ' from', PGL ) . '" data-target=".dp-target-from" />
						<input type="hidden" name="' . $name_from . '" id="' . $name_from . '" value="' . $value_from . '" class="dp-target-from" />
					';
						$html[] = '

						<input class="keywordfind datepicker_display form-control" type="text" value="' . ( $value_to ? date( 'm/d/Y', strtotime( $value_to ) ) : '' ) . '" placeholder="' . __( $field['label'] . ' to', PGL ) . '" data-target=".dp-target-to" />
						<input type="hidden" name="' . $name_to . '" id="' . $name_to . '" value="' . $value_to . '" class="dp-target-to" />

					';
					}
				}
				break;
			}
		}

		return apply_filters( 'PGL/Addon/ACF/display_date_picker_search_field', $html );
	}

	static function add_field_to_single_estate( $html, $col = 6 ) {
		global $post;
		if ( function_exists( 'get_field_objects' ) ) {
			$field_objects = get_field_objects( $post->ID );
			if ( $field_objects ) {
				foreach ( $field_objects as $field_object ) {
					if ( ! empty( $field_object['value'] ) ) {
						$html .= '<div class="col-md-'.$col.' col-sm-'.$col.'"><span class="line-top">' . $field_object['label'] . "<span>" . $field_object['value'] . "</span></span></div>";
					}
				}
			}
		}
		return $html;
	}

	static function add_field_to_list_display( $html, $col = 12 ) {
		global $post;
		global $pgl_options;

		if($display_fields = $pgl_options->option('acf_display_fields')){
            if ( function_exists( 'get_field_objects' ) ) {
                $field_objects = get_field_objects( $post->ID );
                if ( $field_objects ) {
                    foreach ( $field_objects as $field_object ) {
                        if ( in_array($field_object['key'], $display_fields) &&  ! empty( $field_object['value'] ) ) {
                            $html .= '<div class="col-md-'.$col.' col-sm-'.$col.'"><span class="line-top">' . $field_object['label'] . "<span>" . $field_object['value'] . "</span></span></div>";
                        }
                    }
                }
            }
        }
		return $html;
	}

	/**
	 * @param WP_Widget $widget
	 * @param array     $instance
	 */
	static function add_fields_to_estate_search_widget( $widget, $instance ) {
		global $pgl_options;
		if ( ! isset( $instance['acf_fields'] ) ) {
			$instance['acf_fields'] = array();
		}
		$searchable_fields = $pgl_options->option( 'acf_searchable_fields' );
		if ( empty( $searchable_fields ) )
			return;
		echo '<h4> ACF fields </h4>';
		$acf_fields = self::get_all_acf_fields();
		foreach ( $searchable_fields as $sf ) {
			if ( isset( $acf_fields[$sf] ) ) {
				$info = unserialize( $acf_fields[$sf][0] );
				?>
				<label for="<?php echo esc_attr( $widget->get_field_id( 'acf_field_' . $info['name'] ) ) ?>">
					<input type="checkbox" name="<?php echo $widget->get_field_name( 'acf_fields' ) ?>[]" id="<?php echo $widget->get_field_id( 'acf_field_' . $info['name'] ) ?>" value="<?php echo $info['name']; ?>" <?php if ( in_array( $info['name'], $instance['acf_fields'] ) ) echo 'checked'; ?>/> &nbsp; <?php echo $info['label']; ?>
				</label>
			<?php
			}
		}
	}

	static function get_all_acf_fields() {
		if ( empty ( self::$acf_fields ) ) {
			$query      = new WP_Query( array( 'post_type' => 'acf' ) );
			$temp_array = array();
			foreach ( $query->get_posts() as $group ) {
				$group_meta = get_post_meta( $group->ID );
				foreach ( array_keys( $group_meta ) as $k ) {
					if ( ! PGL_Utilities::startsWith( $k, 'field_' ) ) {
						unset( $group_meta[$k] );
					}
				}
				$temp_array += $group_meta;
			}
			self::$acf_fields = $temp_array;
		}
		return self::$acf_fields;
	}

	static function update_estate_search_widget( $old, $new ) {
		$old['acf_fields'] = $new['acf_fields'];
		return $old;
	}
}
?>