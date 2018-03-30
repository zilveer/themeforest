<?php
/**
 * Job Listing: Business Hours
 *
 * @since Listify 1.0.0
 */
class Listify_Widget_Listing_Business_Hours extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Display the business hours of the listing.', 'listify' );
        $this->widget_id          = 'listify_widget_panel_listing_business_hours';
        $this->widget_name        = __( 'Listify - Listing: Business Hours', 'listify' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Title:', 'listify' )
            ),
            'icon' => array(
                'type'    => 'text',
                'std'     => 'ion-clock',
                'label'   => '<a href="http://ionicons.com/">' . __( 'Icon Class:', 'listify' ) . '</a>'
            )
        );

        parent::__construct();
    }

    function widget( $args, $instance ) {
        global $job_manager;

        extract( $args );

        $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
        $icon = isset( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : null;

        if ( $icon ) {
            if ( strpos( $icon, 'ion-' ) !== false ) {
                $before_title = sprintf( $before_title, $icon );
            } else {
                $before_title = sprintf( $before_title, 'ion-' . $icon );
            }
        }

        $hours = get_post()->_job_hours;

        if ( ! $hours ) {
            return;
        }

        global $wp_locale;

        $numericdays = listify_get_days_of_week();

        foreach ( $numericdays as $key => $i ) {
            $day = $wp_locale->get_weekday( $i );
            $start = isset( $hours[ $i ][ 'start' ] ) ? $hours[ $i ][ 'start' ] : false;
            $end = isset( $hours[ $i ][ 'end' ] ) ? $hours[ $i ][ 'end' ] : false;

            if ( ! ( $start && $end ) ) {
                continue;
            }

            $days[ $day ] = array( $start, $end );
        }

        if ( empty( $days ) ) {
            return;
        }

        ob_start();

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        do_action( 'listify_widget_job_listing_hours_before' );
?>

<?php foreach ( $days as $day => $hours ) : ?>
    <p class="business-hour" itemprop="openingHours" content="<?php echo $day; ?> <?php echo date_i18n( 'Ga', strtotime( $hours[0] ) ); ?>-<?php echo date( 'Ga', strtotime( $hours[1] ) ); ?>">
        <span class="day"><?php echo $day ?></span>
        <span class="business-hour-time">
            <?php if ( __( 'Closed', 'listify' ) == $hours[0] ) : ?>
                <?php _e( 'Closed', 'listify' ); ?>
            <?php else : ?>
                <span class="start"><?php echo $hours[0]; ?></span> &ndash; <span class="end"><?php echo $hours[1]; ?></span>
            <?php endif; ?>
        </span>
    </p>
<?php endforeach; ?>

<?php
        do_action( 'listify_widget_job_listing_hours_after' );

        echo $after_widget;

        $content = ob_get_clean();

        echo apply_filters( $this->widget_id, $content );
    }
}
