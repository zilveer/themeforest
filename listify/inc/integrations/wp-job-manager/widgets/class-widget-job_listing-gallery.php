<?php
/**
 * Job Listing: Gallery
 *
 * @since Listify 1.0.0
 */
class Listify_Widget_Listing_Gallery extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Display the listing photo gallery.', 'listify' );
        $this->widget_id          = 'listify_widget_panel_listing_gallery';
        $this->widget_name        = __( 'Listify - Listing: Photo Gallery', 'listify' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => 'Photo Gallery',
                'label' => __( 'Title:', 'listify' )
            ),
            'icon' => array(
                'type'    => 'text',
                'std'     => 'ion-image',
                'label'   => '<a href="http://ionicons.com/">' . __( 'Icon Class:', 'listify' ) . '</a>'
            ),
            'limit' => array(
                'type'    => 'number',
                'std'     => 8,
                'label'   => __( 'Number to show:', 'listify' ),
                'min'     => 1,
                'max'     => 100,
                'step'    => 1
            )
        );

        parent::__construct();
    }

    function widget( $args, $instance ) {
        if ( $this->get_cached_widget( $args ) )
            return;

        global $job_manager, $post;

        extract( $args );

        $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
        $icon = isset( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : null;
        $gallery = Listify_WP_Job_Manager_Gallery::get( get_post()->ID );
        $limit = isset( $instance[ 'limit' ] ) ? $instance[ 'limit' ] : 8;
        $has_more = count( $gallery ) > $limit;

        if ( $icon ) {
            if ( strpos( $icon, 'ion-' ) !== false ) {
                $before_title = sprintf( $before_title, $icon );
            } else {
                $before_title = sprintf( $before_title, 'ion-' . $icon );
            }
        }

        ob_start();

        if ( $has_more ) {
            $before_widget = str_replace( 'widget-job_listing', 'widget-job_listing has-more', $before_widget );
        }

        echo $before_widget;

        if ( $title ) echo $before_title . sprintf( '<a href="%s" class="image-gallery-link">%s</a>', Listify_WP_Job_Manager_Gallery::url(), $title ) . $after_title;

        do_action( 'listify_widget_job_listing_gallery_before' );

        include( locate_template( array( 'content-single-job_listing-gallery-overview.php' ) ) );

        if ( $has_more ) {
            printf( '<a href="%s" class="go-to-gallery"><i class="ion-ios-more"></i></a>', Listify_WP_Job_Manager_Gallery::url() );
        }

        do_action( 'listify_widget_job_listing_gallery_after' );

        echo $after_widget;

        $content = ob_get_clean();

        echo apply_filters( $this->widget_id, $content );

        $this->cache_widget( $args, $content );
    }
}
