<?php
/**
 * Job Listing: Map
 *
 * @since Listify 1.0.0
 */
class Listify_Widget_Listing_Map extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Display the listing location and contact details.', 'listify' );
        $this->widget_id          = 'listify_widget_panel_listing_map';
        $this->widget_name        = __( 'Listify - Listing: Map & Contact Details', 'listify' );
        $this->settings           = array(
            'map' => array(
                'type'  => 'checkbox',
                'std'   => 1,
                'label' => __( 'Display Map', 'listify' )
            ),
            'address' => array(
                'type'  => 'checkbox',
                'std'   => 1,
                'label' => __( 'Display Address', 'listify' )
            ),
            'phone' => array(
                'type'  => 'checkbox',
                'std'   => 1,
                'label' => __( 'Display Phone Number', 'listify' )
            ),
            'email' => array(
                'type'  => 'checkbox',
                'std'   => 1,
                'label' => __( 'Display Email', 'listify' )
            ),
            'web' => array(
                'type'  => 'checkbox',
                'std'   => 1,
                'label' => __( 'Display Website', 'listify' )
            ),
            'directions' => array(
                'type'  => 'checkbox',
                'std'   => 1,
                'label' => __( 'Display "Get Directions"', 'listify' )
            )
        );

        parent::__construct();
    }

    function widget( $args, $instance ) {
        if ( $this->get_cached_widget( $args ) )
            return;

        global $job_manager, $post, $listify_job_manager;

        extract( $args );

        $fields = array( 'map', 'address', 'phone', 'email', 'web', 'directions' );
        $location = $listify_job_manager->template->get_the_location_formatted();

        foreach ( $fields as $field ) {
            $$field = isset( $instance[ $field ] ) && 1 == $instance[ $field ] ? true : false;
        }

        // map also needs location data
        $map = $map && $post->geolocation_lat;

        // figure out split
        $just_directions = $directions && ! ( $web || $address || $phone || $email );
        $split = $map && ! $just_directions && ( $phone || $web || $address || $directions || $email ) ? 'map-widget-section--split' : '';

        ob_start();

        echo $before_widget;
?>

<div class="map-widget-sections">

    <?php if ( $map && get_theme_mod( 'map-behavior-api-key', false ) ) : ?>
    <div class="map-widget-section <?php echo $split; ?>">
        <div id="listing-contact-map"></div>
    </div>
    <?php endif; ?>

    <?php if ( $phone || $web || $address || $directions ) : ?>
    <div class="map-widget-section <?php echo $split; ?>">
        <?php
            do_action( 'listify_widget_job_listing_map_before' );

            if ( $address ) :
                $listify_job_manager->template->the_location_formatted();
            endif;

            if ( $phone ) :
                $listify_job_manager->template->the_phone();
            endif;

            if ( $email ) :
				$listify_job_manager->template->the_email();
            endif;

            if ( $web ) :
                $listify_job_manager->template->the_url();
            endif;

            if ( $directions ) :
                $listify_job_manager->template->the_directions();
            endif;

            do_action( 'listify_widget_job_listing_map_after' );
        ?>
    </div>
    <?php endif; ?>

</div>

<?php
        echo $after_widget;

        $content = ob_get_clean();

        echo apply_filters( $this->widget_id, $content );

        add_filter( 'listify_page_needs_map', '__return_false' );

        $this->cache_widget( $args, $content );
    }
}
