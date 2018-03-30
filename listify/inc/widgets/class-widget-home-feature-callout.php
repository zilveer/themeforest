<?php
/**
 * Home: Feature Callout
 *
 * @since Listify 1.0.0
 */
class Listify_Widget_Feature_Callout extends Listify_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_description = __( 'Display a full-width "feature" callout', 'listify' );
		$this->widget_id          = 'listify_widget_feature_callout';
		$this->widget_name        = __( 'Listify - Page: Feature Callout', 'listify' );
		$this->control_ops        = array(
			'width' => 400
		);
		$this->settings           = array(
			'text_align' => array(
				'type'  => 'select',
				'std'   => 'left',
				'label' => __( 'Text Align:', 'listify' ),
				'options' => array(
					'left' => __( 'Left', 'listify' ),
					'right' => __( 'Right', 'listify' ),
					'center' => __( 'Center (cover only)', 'listify' )
				)
			),
			'background' => array(
				'type'  => 'select',
				'std'   => 'pull',
				'label' => __( 'Image Style:', 'listify' ),
				'options' => array(
					'cover' => __( 'Cover', 'listify' ),
					'pull'  => __( 'Pull Out', 'listify' )
				)
			),
			'background_position' => array(
				'type'  => 'select',
				'std'   => 'center center',
				'label' => __( 'Image Position:', 'listify' ),
				'options' => array(
					'left top' => __( 'Left Top', 'listify' ),
					'left center' => __( 'Left Center', 'listify' ),
					'left bottom' => __( 'Left Bottom', 'listify' ),
					'right top' => __( 'Right Top', 'listify' ),
					'right center' => __( 'Right Center', 'listify' ),
					'right bottom' => __( 'Right Bottom', 'listify' ),
					'center top' => __( 'Center Top', 'listify' ),
					'center center' => __( 'Center Center', 'listify' ),
					'center bottom' => __( 'Center Bottom', 'listify' ),
					'center top' => __( 'Center Top', 'listify' )
				)
			),
			'cover_overlay' => array(
				'type' => 'checkbox',
				'std'  => 1,
				'label' => __( 'Use transparent overlay', 'listify' )
			),
			'margin' => array(
				'type' => 'checkbox',
				'std'  => 1,
				'label' => __( 'Add standard spacing above/below widget', 'listify' )
			),
			'text_color' => array(
				'type'  => 'colorpicker',
				'std'   => '#717A8F',
				'label' => __( 'Text Color:', 'listify' )
			),
			'background_color' => array(
				'type'  => 'colorpicker',
				'std'   => '#ffffff',
				'label' => __( 'Background Color:', 'listify' )
			),
			'title' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title:', 'listify' )
			),
			'content' => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Content:', 'listify' ),
				'rows'  => 5
			),
			'image' => array(
				'type'  => 'image',
				'std'   => '',
				'label' => __( 'Image:', 'listify' )
			)
		);

		parent::__construct();

		add_filter( 'listify_feature_callout_description', 'wptexturize'        );
		add_filter( 'listify_feature_callout_description', 'convert_smilies'    );
		add_filter( 'listify_feature_callout_description', 'convert_chars'      );
		add_filter( 'listify_feature_callout_description', 'wpautop'            );
		add_filter( 'listify_feature_callout_description', 'shortcode_unautop'  );
		add_filter( 'listify_feature_callout_description', 'prepend_attachment' );
        add_filter( 'listify_feature_callout_description', 'do_shortcode'       );
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
		if ( $this->get_cached_widget( $args ) )
			return;

		extract( $args );

		$text_align = isset( $instance[ 'text_align' ] ) ? esc_attr( $instance[ 'text_align' ] ) : 'left';
		$background = isset( $instance[ 'background' ] ) ? esc_attr( $instance[ 'background' ] ) : 'cover';
		$background_color = isset( $instance[ 'background_color' ] ) ? esc_attr( $instance[ 'background_color' ] ) : '#ffffff';
		$background_position = isset( $instance[ 'background_position' ] ) ? esc_attr( $instance[ 'background_position' ] ) : 'center center';
		$overlay = isset( $instance[ 'cover_overlay' ] ) && 1 == $instance[ 'cover_overlay' ] ? 'has-overlay' : 'no-overlay';
		$margin = isset( $instance[ 'margin' ] ) && 1 == $instance[ 'margin' ] ? true : false;

		if ( ! $margin ) {
			$before_widget = str_replace( 'home-widget', 'home-widget no-margin', $before_widget );
		}

		$image = isset( $instance[ 'image' ] ) ? esc_url( $instance[ 'image' ] ) : null;
		$content = $this->assemble_content( $instance );

		ob_start();
		?>

		</div>

			<?php echo $before_widget; ?>

			<div class="feature-callout text-<?php echo $text_align; ?> image-<?php echo $background; ?>" style="background-color: <?php echo $background_color; ?>;">

				<?php if ( 'pull' == $background ) : ?>
					<div class="container">
						<div class="col-xs-12 col-sm-6 <?php echo ( 'right' == $text_align ) ? 'col-sm-offset-6' : ''; ?>">
							<?php echo $content; ?>
						</div>
					</div>

					<div class="col-xs-12 col-sm-6 <?php echo ( 'left' == $text_align ) ? 'col-sm-offset-6' : ''; ?> feature-callout-image-pull" style="background-image:url(<?php echo $image; ?>); ?>; background-position: <?php echo $background_position; ?>"></div>
				<?php else : ?>

					<div class="feature-callout-cover <?php echo $overlay; ?>" style="background-image:url(<?php echo $image; ?>); ?>; background-position: <?php echo $background_position; ?>">

						<div class="container">
							<div class="row">
								<div class="col-xs-12 <?php echo ( in_array( $text_align, array( 'left', 'right' ) ) ) ? 'col-sm-8 col-md-6' : ''; ?> <?php echo ( 'right' == $text_align ) ? 'col-sm-offset-4 col-md-offset-6' : ''; ?>">
									<?php echo $content; ?>
								</div>
							</div>
						</div>

					</div>

				<?php endif; ?>

			</div>

			<?php echo $after_widget; ?>

		<div class="container">

		<?php

		$content = ob_get_clean();

		echo apply_filters( $this->widget_id, $content );

		$this->cache_widget( $args, $content );
	}

	private function assemble_content( $instance ) {
		$text_color = isset( $instance[ 'text_color' ] ) ? esc_attr( $instance[ 'text_color' ] ) : '#717A8F';

		$title = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
		$content = isset( $instance[ 'content' ] ) ? $instance[ 'content' ] : '';

		$output  = '<div class="callout-feature-content" style="color:' . $text_color . '">';
		$output .= '<h2 class="callout-feature-title" style="color:' . $text_color . '">' . $title . '</h2>';
		$output .= wpautop( $content );
		$output .= '</div>';

        $output  = apply_filters( 'listify_feature_callout_description', $output );

		return $output;
	}
}
