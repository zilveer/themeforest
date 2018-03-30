<?php

class G1_Theme_Admin {

    public function __construct() {
        add_action( 'after_setup_theme', array( $this, 'setup_hooks' ) );
    }

    public function setup_hooks() {

        // Enable editor style
        $this->setup_editor_style();

        // Improve usability
        $this->setup_usability();

	    // Default image dimensions
        global $pagenow;
        if ( isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
            add_action( 'init', array($this, 'woocommerce_image_dimensions'), 1 );
        }

        add_action( 'admin_notices', array( $this, 'admin_notices' ) );
        add_action( 'g1_gmaps_plugin_activate', array( $this, 'g1_gmaps_plugin_activate' ) );

		// G1 Gmaps plugin is activated and map was migrated
		if ( $this->is_g1_gmaps_plugin_activated() ) {
			add_action( 'load-post.php', array( $this, 'g1_gmaps_setup_meta_box' ) );
			add_action( 'load-post-new.php', array( $this, 'g1_gmaps_setup_meta_box' ) );
			add_action( 'save_post', array( $this, 'g1_gmaps_save_meta_box' ) );
		}
	}

	public function g1_gmaps_setup_meta_box () {
		add_action( 'add_meta_boxes', array( $this, 'add_g1_gmaps_meta_box' ) );
	}

	public function add_g1_gmaps_meta_box () {
        $post_types = $this->get_g1_gmaps_supported_post_types();

        foreach ( $post_types as $post_type ) {
            add_meta_box(
                'g1-gmaps-metabox', // Unique ID
                __( 'G1 Gmaps', 'g1_gmaps' ), // Title
                array( $this, 'render_g1_gmaps_meta_box' ), // Callback function
                $post_type, // Post type
                'normal', // Context
                'default' // Priority
            );
        }
	}

    public function get_g1_gmaps_supported_post_types () {
        return apply_filters( 'g1_gmaps_supported_post_types', array( 'page', 'post' ) );
    }

	public function render_g1_gmaps_meta_box ( $post ) {
		wp_nonce_field( 'g1_gmaps_meta_box', 'g1_gmaps_meta_box_nonce' );

		$theme_options = get_option(G1_Theme()->get_id());
		$meta = get_post_meta($post->ID, '_g1', true);

		$page_precontent_gmap_enabled = isset( $meta['single_element_gmap'] ) && $meta['single_element_gmap'] === 'standard';
		$global_gmap_enabled = $theme_options['ta_prefooter_gmap'] !== 'none';

		$maps = G1_GMaps()->get_map_list();
		$choices = array(
			''		=> __( 'inherit', 'g1_theme' ),
			'none'	=> __( 'none', 'g1_theme' ),
		);

		foreach ($maps['list'] as $map_id => $map_label) {
			$choices[$map_id] = $map_label;
		}

		$gmaps_metabox = get_post_meta( $post->ID, '_g1_gmaps_metabox', true );

		// default
		$precontent_map_id = $page_precontent_gmap_enabled ? G1_Theme_Admin()->get_g1_gmaps_migrated_map_id() : '';
		$prefooter_map_id = '';

		if ( ! $precontent_map_id && $global_gmap_enabled ) {
			$prefooter_map_id = G1_Theme_Admin()->get_g1_gmaps_migrated_map_id();
		}

		// from db
		if ( ! empty( $gmaps_metabox ) ) {
			$precontent_map_id = $gmaps_metabox['precontent_map_id'];
			$prefooter_map_id = $gmaps_metabox['prefooter_map_id'];
		}

		?>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Map in the precontent', 'g1_theme' ); ?></label>
					</th>
					<td>
						<select name="g1_gmaps_precontent_map_id">
							<?php foreach ( $choices as $choice_id => $choice_label ): ?>
								<option value="<?php echo esc_attr( $choice_id ) ?>" <?php selected( $precontent_map_id , $choice_id ); ?>><?php echo esc_html( $choice_label ); ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Map in the prefooter', 'g1_theme' ); ?></label>
					</th>
					<td>
						<select name="g1_gmaps_prefooter_map_id">
							<?php foreach ( $choices as $choice_id => $choice_label ): ?>
								<option value="<?php echo esc_attr( $choice_id ) ?>" <?php selected( $prefooter_map_id , $choice_id ); ?>><?php echo esc_html( $choice_label ); ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
	}

	public function g1_gmaps_save_meta_box ( $post_id ) {
		if ( ! isset( $_POST['post_type'] ) ) {
			return;
		}

		$post_type = $_POST['post_type'];

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check the user's permissions.
		if ( 'page' == $post_type ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		// save map meta boxes
		if ( in_array( $post_type, $this->get_g1_gmaps_supported_post_types() ) ) {
			$data_to_save = array();

			// Validate meta boxes nonces
			$meta_box = 'g1_gmaps_meta_box';
			$nonce_name =  'g1_gmaps_meta_box_nonce';

			// Check if our nonce is set.
			if ( ! isset( $_POST[$nonce_name] ) ) {
				return $post_id;
			}

			$nonce = $_POST[$nonce_name];

			// Verify that the nonce is valid.
			if ( ! wp_verify_nonce( $nonce, $meta_box ) ) {
				return $post_id;
			}

			if ( isset( $_POST['g1_gmaps_precontent_map_id'] ) ) {
				$data_to_save['precontent_map_id'] = sanitize_text_field($_POST['g1_gmaps_precontent_map_id']);
			}

			if ( isset( $_POST['g1_gmaps_prefooter_map_id'] ) ) {
				$data_to_save['prefooter_map_id'] = sanitize_text_field($_POST['g1_gmaps_prefooter_map_id']);
			}

			// Update the meta field in the database.
			update_post_meta( $post_id, '_g1_gmaps_metabox', $data_to_save );
		}
	}

	public function get_g1_gmaps_migrated_map_id () {
		if ( ! $this->is_g1_gmaps_plugin_activated() ) {
			return false;
		}

		return get_option('g1_gmaps_migrated_map_id', false);
	}

	public function is_g1_gmaps_plugin_activated () {
		return is_plugin_active('g1-gmaps/g1-gmaps.php');
	}

	public function g1_gmaps_plugin_activate () {
		$migrated_map_id = get_option('g1_gmaps_migrated_map_id', false);

		if ($migrated_map_id) {
			return;
		}

		$options = get_option(G1_Theme()->get_id());

		$color = $options['map_color'];									// hex or empty string
		$invert_lightness = $options['map_invert_lightness'] === '1';	// bool
		$type = $options['map_type'];									// roadmap | satellite | hybrid | terrain
		$center_lat = $options['map_latitude'];
		$center_long = $options['map_longitude'];
		$zoom = (int)$options['map_zoom'];								// int
		$marker = $options['map_marker'];								// none | standard | open-bubble
		$marker_icon = $options['map_marker_icon'];						// image path
		$marker_content = $options['map_marker_content'];
		$marker_icon_id = null;

		if ($marker_icon) {
			$marker_icon_id = $this->get_image_id( $marker_icon );
		}

		// create new map
		$defaults = G1_GMaps()->get_default_map_config();

		$config = array(
			'width' 					=> '',
			'height' 					=> '380',
			'full_width' 				=> 'standard',
			'parallax'					=> 'standard',
			'street_view_control'  		=> 'none',
			'overview_control'     		=> 'none',
			'scroll_wheel_to_zoom' 		=> 'none',
			'double_click_to_zoom' 		=> 'standard',
			'draggable'            		=> 'standard',
			'type_control'         		=> 'horizontal',
			'pan_control'          		=> 'standard',
			'scale_control'        		=> 'none',
			'zoom_control'         		=> 'small',
		);

		if ($center_lat) {
			$config['lat'] = $center_lat;
		}

		if ($center_long) {
			$config['long'] = $center_long;
		}

		if ($zoom) {
			$config['zoom'] = $zoom;
		}

		if ($type) {
			$config['type'] = $type;
		}

		if ($invert_lightness) {
			$config['invert_lightness'] = 'standard';
		}

		if ($color) {
			$c = new G1_Color($color);

			$config['color_hue'] = $c->get_hue();
			$config['color_saturation'] = $c->get_saturation() * 2 - 100;
			$config['color_lightness'] = $c->get_lightness() * 2 - 100;

			$config['custom_colors'] = 'standard';
		} else {
			$config['custom_colors'] = 'none';
		}

		$config = wp_parse_args( $config, $defaults );

		$post = array(
			'post_title' => 'Old map',
			'post_status' => 'publish',
			'post_type' => G1_GMaps()->get_post_type()
		);

		$post_id = wp_insert_post($post);

		if ($post_id > 0) {
			$data_to_save = array();

			foreach ($config as $option_name => $option_value) {
				$data_to_save[ 'map_' . $option_name ] = $option_value;
			}

			update_post_meta( $post_id, '_g1_gmap_lat', $data_to_save['map_lat'] );
			update_post_meta( $post_id, '_g1_gmap_long', $data_to_save['map_long'] );
			update_post_meta( $post_id, '_g1_gmap', $data_to_save );

			// create marker
			if ($marker !== 'none') {
				$marker_id = wp_insert_post(array(
					'post_status' => 'publish',
					'post_type' => G1_GMaps()->get_map_marker_post_type()
				));

				if ($marker_id > 0) {
					$marker_data_to_save = G1_GMaps()->get_default_map_marker_config();

					$marker_data_to_save['lat'] = $data_to_save['map_lat'];
					$marker_data_to_save['long'] = $data_to_save['map_long'];
					$marker_data_to_save['label'] = 'Marker';

					if ($marker_icon_id) {
						$marker_data_to_save['icon_id'] = $marker_icon_id;
						$marker_data_to_save['icon_path'] = $marker_icon;
					}

					$marker_data_to_save['info'] = $marker_content;
					$marker_data_to_save['info_state'] = $marker === 'open-bubble' ? 'standard' : 'none';
					$marker_data_to_save['visibility'] = 'standard';

					update_post_meta( $marker_id, '_g1_gmap_id', $post_id );
					update_post_meta( $marker_id, '_g1_gmap_marker_lat', $marker_data_to_save['lat'] );
					update_post_meta( $marker_id, '_g1_gmap_marker_long', $marker_data_to_save['long'] );
					update_post_meta( $marker_id, '_g1_gmap_marker', $marker_data_to_save );
				}
			}

			update_option('g1_gmaps_migrated_map_id', $post_id);

			$global_map_enabled = $options['ta_prefooter_gmap'] === 'standard';

			// if map was enabled, we need to set it to new created map
			if ($global_map_enabled) {
				$options['ta_prefooter_gmap'] = $post_id;
				update_option(G1_Theme()->get_id(), $options);
			}
		}
	}

	private function get_image_id ( $image_url ) {
		global $wpdb;

		$prefix = $wpdb->prefix;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $image_url ));

		if ( !empty($attachment) ) {
			return $attachment[0];
		}

		return null;
	}

    public function woocommerce_image_dimensions() {
        $catalog = array(
            'width'     => '239',       // px
            'height'    => '319',       // px
            'crop'              => 1            // true
        );

        $single = array(
            'width'     => '482',       // px
            'height'    => '643',       // px
            'crop'              => 1            // true
        );

        $thumbnail = array(
            'width'     => '55',        // px
            'height'    => '73',        // px
            'crop'              => 0            // false
        );

        // Update image sizes
        update_option( 'shop_catalog_image_size', $catalog );
        update_option( 'shop_single_image_size', $single );
        update_option( 'shop_thumbnail_image_size', $thumbnail );
    }

    public function setup_editor_style() {
        add_theme_support( 'editor_style' );
        add_editor_style();
    }

    public function setup_usability() {
        add_filter( 'manage_posts_columns',         array( $this, 'add_id_column') );
        add_action( 'manage_posts_custom_column',   array( $this, 'render_id_column') );
    }

    public function admin_notices () {
        global $pagenow;

        if ( $pagenow == 'options-reading.php' ) {
            $notice_template = 'To set up your <strong>%s</strong> go to the <a href="%s">%s</a>.';

            $notice1 = sprintf( __( $notice_template, 'g1_theme' ), 'Front page', '/wp-admin/themes.php?page=g1_theme_options', 'Appearance > Theme Options > Pages');
            $notice2 = sprintf( __( $notice_template, 'g1_theme' ), 'Posts page', '/wp-admin/themes.php?page=g1_theme_options', 'Appearance > Theme Options > Posts > Posts Archive Page');

            if ( strlen($notice1) > 0 && strlen($notice2) > 0 ) {
                echo '<div class="updated">';
                echo '<p>'. $notice1 .'</p>';
                echo '<p>'. $notice2 .'</p>';
                echo '</div>';
            }
        }
    }

    public function add_id_column( $columns ) {
        $new_columns = array();

        foreach ( $columns as $k => $v ) {
            $new_columns[ $k ] = $v;
            if ( 'cb' == $k ) {
                $new_columns[ 'id' ] = 'ID';
            }
        }

        return $new_columns;
    }


    public function render_id_column( $name ) {
        global $post;

        if ( 'id' === $name ) {
            echo $post->ID;
        }
    }
}
/**
 * Quasi-singleton for our theme
 *
 * @return G1_Theme_Admin
 */
function G1_Theme_Admin() {
    static $instance;

    if ( !isset( $instance ) ) {
        $instance = new G1_Theme_Admin();
    }

    return $instance;
}
// Fire in the hole :)
G1_Theme_Admin();



/**
 * Adding our custom fields to the $form_fields array
 *
 * @param array $form_fields
 * @param object $attachment
 * @return array
 */
function g1_attachment_image_fields_to_edit( $form_fields, $attachment ) {

    if ( substr( $attachment->post_mime_type, 0, 5 ) == 'image' ){
        $form_fields[ 'type' ] = array(
            'label' => __( 'Type', 'g1_theme' ),
            'input' => 'html',
            'helps' => __( 'Specify how the media should be treated', 'g1_theme' ),
        );

        // attachment type
        $types = array(
            ''          => 'regular attachment',
            'exclude'   => __('exclude from mediabox', 'g1_theme'),
        );

        $value = get_post_meta( $attachment->ID, '_g1_type', true);

        $html = '<select style="width:100%; max-width:100%;" name="attachments[' . $attachment->ID . '][type]" id="attachments[' . $attachment->ID .'][type]">';
        foreach( $types as $option => $label ) {
            if( $value === $option )
                $html .= '<option selected="selected" value="' . esc_attr( $option ) . '">' . esc_html( $label ) . '</option>';
            else
                $html .= '<option value="' . esc_attr( $option ) . '">' . esc_html( $label ) . '</option>';
        }
        $html .= '</select>';

        $form_fields['type'][ 'html' ] = $html;
    }

    return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'g1_attachment_image_fields_to_edit', null, 2 );




/**
 * @param array $post
 * @param array $attachment
 * @return array
 */
function g1_attachment_image_fields_to_save( $post, $attachment ) {
    if ( isset( $attachment[ 'alt_link' ] ) ){
        update_post_meta( $post[ 'ID' ], '_g1_alt_link', $attachment[ 'alt_link' ] );
    }

    if ( isset( $attachment[ 'alt_linking' ] ) ){
        update_post_meta( $post[ 'ID' ], '_g1_alt_linking', $attachment[ 'alt_linking' ] );
    }

    if ( isset( $attachment[ 'type' ] ) ){
        update_post_meta( $post[ 'ID' ], '_g1_type', $attachment[ 'type' ] );
    }

    return $post;
}
add_filter( 'attachment_fields_to_save', 'g1_attachment_image_fields_to_save', null, 2 );




function g1_mediabox_get_help() {
    $out = '';

    $out .= '<p>' . __( 'A media box is a part of a template, that displays entry attachments.', 'g1_theme' ) . '</p>';
    $out .= '<p>' . __( 'The <strong>list</strong> displays image &amp; audio attachments.', 'g1_theme' ) . '</p>';
    $out .= '<p>' . __( 'The <strong>slider</strong> displays only image attachments.', 'g1_theme' ) . '</p>';
    $out .= '<p>' . __( 'The <strong>featured media</strong> displays featured image.', 'g1_theme' ) . '</p>';
    $out .= '<p>' . __( 'The <strong>none</strong> displays nothing.', 'g1_theme' ) . '</p>';

    return apply_filters( 'g1_mediabox_help', $out );
}
