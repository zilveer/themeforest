<?php
/**
 * Author: Biography
 *
 * @since Listify 1.7.0
 * @package Listify
 * @subpackage Widget
 */
class Listify_Widget_Author_Biography extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Author biography', 'listify' );
        $this->widget_id          = 'listify_widget_author_biography';
        $this->widget_name        = __( 'Listify - Author: Biography', 'listify' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Title:', 'listify' )
            ),
            'icon' => array(
                'type'    => 'text',
                'std'     => '',
                'label'   => '<a href="http://ionicons.com/">' . __( 'Icon Class:', 'listify' ) . '</a>'
            ),
        );
        parent::__construct();
    }

	/**
	 * Echoes the widget content.
	 *
	 * @since 1.7.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance[ 'title' ] : false, $instance, $this->id_base );
        $icon = isset( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : null;
		$bio = get_the_author_meta( 'description', get_queried_object_id() );

		if ( '' == $bio ) {
			return;
		}

        ob_start();

		echo $args[ 'before_widget' ];

        if ( $title ) {
			if ( $icon ) {
				$icon = str_replace( 'ion-', '', $icon );
				$args[ 'before_title' ] = sprintf( $args[ 'before_title' ], 'ion-' . $icon );
			}

			echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
        }

		echo $bio;

		echo $args[ 'after_widget' ];

        $content = ob_get_clean();

        echo apply_filters( $this->widget_id, $content );
    }
}
