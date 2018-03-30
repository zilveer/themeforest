<?php
/**
 * Job Listing: Products
 *
 * @since Listify 1.0.0
 */
class Listify_Widget_Listing_Products_Main extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Display the listings products (main content)', 'listify' );
        $this->widget_id          = 'listify_widget_panel_listing_products_main';
        $this->widget_name        = __( 'Listify - Listing: Products (Content)', 'listify' );
        $this->settings           = array(
            array(
                'type' => 'description',
                'std' => __( 'This widget has no options', 'listify' )
            )
        );

        $wpjmp = WPJMP();

        remove_action( 'single_job_listing_end', array( $wpjmp->products, 'listing_display_products' ) );

        parent::__construct();
    }

    function widget( $args, $instance ) {
        global $job_manager, $post;

        if ( 'preview' == $post->post_status ) {
            return;
        }

        extract( $args );

        $wpjmp = WPJMP();

        ob_start();

        $wpjmp->products->listing_display_products();

        wp_reset_query();

        $content = ob_get_clean();

        echo $content;

        $this->cache_widget( $args, $content );
    }
}
