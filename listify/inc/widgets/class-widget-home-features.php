<?php
/**
 * Home: Features
 *
 * @since Listify 1.0.0
 */
class Listify_Widget_Features extends Listify_Widget {

	public $run = false;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_description = __( 'Display top features about your site', 'listify' );
		$this->widget_id          = 'listify_widget_features';
		$this->widget_name        = __( 'Listify - Page: Features', 'listify' );
		$this->control_ops        = array(
			'width' => 400
		);
		$this->settings           = array(
			'title' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title:', 'listify' )
			),
			'description' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Description:', 'listify' )
			),
			'text-align' => array(
				'type'  => 'select',
				'std'   => 'center',
				'label' => __( 'Text Align:', 'listify' ),
				'options' => array(
					'left' => __( 'Left', 'listify' ),
					'center' => __( 'Center', 'listify' ),
					'right' => __( 'Right', 'listify' )
				)
			),
			'features' => array(
				'type' => 'features',
				'std'  => array(),
				'label' => ''
			)
		);
		parent::__construct();

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'listify_widget_type_features', array( $this, 'output' ), 10, 4 );
		add_action( 'listify_widget_update_type_features', array( $this, '_update' ), 10, 3 );

		add_filter( 'listify_feature_description', 'wptexturize'        );
		add_filter( 'listify_feature_description', 'convert_smilies'    );
		add_filter( 'listify_feature_description', 'convert_chars'      );
		add_filter( 'listify_feature_description', 'wpautop'            );
		add_filter( 'listify_feature_description', 'shortcode_unautop'  );
		add_filter( 'listify_feature_description', 'prepend_attachment' );
        add_filter( 'listify_feature_description', 'do_shortcode'       );
	}

	public function admin_enqueue_scripts() {
		global $pagenow;

		if ( ! in_array( $pagenow, array( 'widgets.php', 'customize.php' ) ) ) {
			return;
		}

		wp_enqueue_media();
		wp_enqueue_script( 'listify-admin-widget-features', get_template_directory_uri() . '/js/admin/widget-features.js', array( 'underscore', 'backbone', 'jquery', 'jquery-ui-sortable' ) );
		wp_enqueue_script( 'app-image-widget-admin', get_template_directory_uri() . '/js/source/app-image-widget-admin.js', array( 'jquery' ), '', true );

		wp_localize_script( 'listify-features-widget', 'cFeaturesGallery', array(
			'title' => __( 'Choose Image', 'listify' ),
			'button' => __( 'Use Image', 'listify' )
		) );
	}

	public function _update( $new_instance, $key, $setting ) {
		$_features = array();

		if ( empty( $new_instance ) ) {
			return $new_instance;
		}

		$new_instance = array_values( $new_instance );

		return $new_instance;
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		$features = isset( $instance[ 'features' ] ) ? $instance[ 'features' ] : array();

		if ( empty( $features ) ) {
			return;
		}

		$title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );
		$description = isset( $instance[ 'description' ] ) ? esc_attr( $instance[ 'description' ] ) : false;
		$align = isset( $instance[ 'text-align' ] ) ? esc_attr( $instance[ 'text-align' ] ) : 'center';
		$count = count( $features );

		$args[ 'after_title' ] = '<h2 class="home-widget-description">' . $description . '</h2>' . $args[ 'after_title' ];

		ob_start();

		echo $args[ 'before_widget' ];

		if ( $title ) {
			echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
		}
?>

		<div class="home-features-wrapper row" data-columns>

		<?php
			foreach ( $features as $feature ) {
				if ( is_object( $feature ) ) {
					$feature = json_decode( json_encode( $feature ), true );
				}

				$title = isset( $feature[ 'title' ] ) ? esc_attr( $feature[ 'title' ] ) : null;
				$description = isset( $feature[ 'description' ] ) ? apply_filters( 'listify_feature_description',
				$feature[ 'description' ] ) : null;
				$media = esc_url( $feature[ 'media' ] );

				$feature = compact( 'title', 'description', 'media' );

				include( locate_template( array( 'content-home-feature.php', false ) ) );
			}
		?>

		</div>
		<style>
			#<?php echo $this->id; ?> .home-feature {
				text-align: <?php echo esc_attr( $align ); ?>;
			}
		</style>

		<?php
		echo $args[ 'after_widget' ];

		$content = ob_get_clean();

		echo apply_filters( $this->widget_id, $content );

		$this->cache_widget( $args, $content );
	}

	public function output($widget, $key, $setting, $instance) {
		$features = isset( $instance[ $key ] ) ? $instance[ $key ] : $setting[ 'std' ];
 	?>
		
		<div id="features-<?php echo $widget->id; ?>">
			<p><a href="#" class="button-add-feature button button-secondary"><?php _e( 'Add Feature', 'listify' ); ?></a></p>
		</div>
		
		<script id="tmpl-feature" type="text/template">
			<a href="#" class="button-remove-feature">&nbsp;</a>

			<p>
				<label><?php _e( 'Title:', 'listify' ); ?></label>
				<input name="<?php echo $this->get_field_name( $key ); ?>[<%= order %>][title]" type="text" value="<%= title %>" class="widefat" />
			</p>

			<p>
				<label><?php _e( 'Media:', 'listify' ); ?></label>
				<input type="text" class="widefat" name="<?php echo $this->get_field_name( $key ); ?>[<%= order %>][media]" value="<%= media %>" placeholder="http://" />
			</p>

			<p>
				<label><?php _e( 'Description:', 'listify' ); ?></label>
				<textarea name="<?php echo $this->get_field_name( $key ); ?>[<%= order %>][description]" rows="3" class="widefat"><%= description %></textarea>
			</p>
		</script>

		<script>
			jQuery(document).ready(function($) {
				window.featuresWidget( '#features-<?php echo $widget->id; ?>', <?php echo json_encode( (array) $features ); ?> );
			});
		</script>

		<style>
			.feature {
				border: 1px solid #ddd;
				margin-bottom: 1em;
				padding: 0.5em 1em;
				background: #fff;
				cursor: move;
				position: relative;
			}

			.button-remove-feature {
				position: absolute;
				top: 5px;
				right: 5px;
				text-decoration: none;
			}

			.button-remove-feature:before {
				background: 0 0;
				color: #BBB;
				content: '\f153';
				display: block!important;
				font: 400 13px/1 dashicons;
				speak: none;
				height: 20px;
				margin: 2px 0;
				text-align: center;
				width: 20px;
				-webkit-font-smoothing: antialiased!important;
			}
		</style>
	<?php
	}
}
