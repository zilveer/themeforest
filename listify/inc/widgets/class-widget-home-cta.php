<?php
/**
 * Standard: Call to Action
 *
 * @since Listify 1.4.0
 */
class Listify_Widget_Call_To_Action extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Display the Call to Action', 'listify' );
        $this->widget_id          = 'listify_call_to_action';
        $this->widget_name        = __( 'Listify - Page: Call to Action', 'listify' );
        $this->settings           = array(
            'color-text' => array(
                'type'  => 'colorpicker',
                'std'   => get_theme_mod( 'color-cta-text', '#717a8f' ),
                'label' => __( 'Text Color:', 'listify' )
            ),
            'color-background' => array(
                'type'  => 'colorpicker',
                'std'   => get_theme_mod( 'color-cta-background', '#f9f9f9' ),
                'label' => __( 'Background Color:', 'listify' )
            ),
            'title' => array(
                'type'  => 'text',
				'std'   => get_theme_mod( 'call-to-action-title', sprintf( '%s is the best way to find & discover great local businesses', get_bloginfo( 'name' ) ) ),
                'label' => __( 'Title:', 'listify' )
            ),
			'description' => array(
				'type'  => 'textarea',
				'std'   => get_theme_mod( 'call-to-action-description', 'It just gets better and better' ),
				'label' => __( 'Description:', 'listify' )
			),
            'button-text' => array(
                'type'  => 'text',
                'std'   => get_theme_mod( 'call-to-action-button-text', 'Create Your Account' ),
                'label' => __( 'Button Text:', 'listify' )
            ),
            'button-href' => array(
                'type'  => 'text',
                'std'   => get_theme_mod( 'call-to-action-button-href', '#' ),
                'label' => __( 'Button URL:', 'listify' )
            ),
            'button-subtext' => array(
                'type'  => 'text',
                'std'   => get_theme_mod( 'call-to-action-button-subtext', 'and get started in minutes' ),
                'label' => __( 'Button Subtext:', 'listify' )
			),
			'button-popup' => array(
				'type' => 'checkbox',
				'std' => 0,
				'label' => __( 'Open button URL in a popup', 'listify' )
			)
        );

        parent::__construct();
    }

    function widget( $args, $instance ) {
		$text_color = isset( $instance[ 'color-text' ] ) ? $instance[ 'color-text' ] : '#717a8f';
		$background_color = isset( $instance[ 'color-background' ] ) ? $instance[ 'color-background' ] : '#ffffff';

		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		$description = isset( $instance[ 'description' ] ) ? esc_attr( $instance[ 'description' ] ) : false;
		$button_href = isset( $instance[ 'button-href' ] ) ? esc_url( $instance[ 'button-href' ] ) : false;
		$button_text = isset( $instance[ 'button-text' ] ) ? esc_attr( $instance[ 'button-text' ] ) : false;
		$button_subtext = isset( $instance[ 'button-subtext' ] ) ? esc_attr( $instance[ 'button-subtext' ] ) : false;
		$button_popup = isset( $instance[ 'button-popup' ] ) && 1 == $instance[ 'button-popup' ] ? true : false;

		echo $args[ 'before_widget' ];
?>

<div class="call-to-action">

	<div class="container">
		<div class="row">

			<div class="col-sm-12 col-md-8 col-lg-9">
				<h1 class="cta-title"><?php echo esc_attr( $title ); ?></h1>

				<div class="cta-description"><?php echo wpautop( esc_attr( $description ) ); ?></div>
			</div>

			<div class="cta-button-wrapper col-sm-12 col-md-4 col-lg-3">
				<a class="button<?php if ( $button_popup ) : ?> popup-wide popup-trigger-ajax<?php endif; ?>" href="<?php echo esc_url( $button_href ); ?>"><?php echo esc_attr( $button_text ); ?></a>
				<small class="cta-subtext"><?php echo esc_attr( $button_subtext ); ?></small>
			</div>

		</div>
	</div>

</div>

<style>
#<?php echo esc_attr( $this->id ); ?> .call-to-action {
color: <?php echo esc_attr( $text_color ); ?>;
background-color: <?php echo esc_attr( $background_color ); ?>;
}

#<?php echo esc_attr( $this->id ); ?>:after {
background-color: <?php echo esc_attr( $background_color ); ?>;
}

#<?php echo esc_attr( $this->id ); ?> .cta-description p,
#<?php echo esc_attr( $this->id ); ?> .cta-subtext {
color: <?php echo esc_attr( Listify_Customizer_CSS::darken( $text_color, 10 ) ); ?>
}
</style>

<?php
		echo $args[ 'after_widget' ];
    }

}
