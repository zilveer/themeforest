<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

/**
 * @var $instance
 * @var $before_widget
 * @var $after_widget
 * @var $title
 */

?>
<?php if ( ! empty( $instance ) ) :
    echo do_shortcode($before_widget);

    echo do_shortcode($instance['text']);

    echo do_shortcode($after_widget);
endif;