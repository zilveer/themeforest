<?php
/**
 * Job Listing: Gallery Slider
 *
 * @since Listify 1.0.3
 */
class Listify_Widget_Listing_Gallery_Slider extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Display a gallery of images and thumbnails.', 'listify' );
        $this->widget_id          = 'listify_widget_panel_listing_gallery_slider';
        $this->widget_name        = __( 'Listify - Listing: Photo Gallery Slider', 'listify' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => 'Photo Gallery',
                'label' => __( 'Title:', 'listify' )
            ),
            'icon' => array(
                'type'    => 'text',
                'std'     => '',
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
        global $job_manager, $job_preview, $post;

        extract( $args );

        $title = apply_filters( 'widget_title', isset( $instance['title'] ) ? esc_attr( $instance[ 'title' ] ) : false, $instance, $this->id_base );
        $icon = isset( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : null;
        $gallery = Listify_WP_Job_Manager_Gallery::get( get_post()->ID );

        if ( empty( $gallery ) ) {
            return;
        }

        $limit = isset( $instance[ 'limit' ] ) ? $instance[ 'limit' ] : 8;
        $gallery = array_splice( $gallery, 0, $limit );

        if ( $icon ) {
            if ( strpos( $icon, 'ion-' ) !== false ) {
                $before_title = sprintf( $before_title, $icon );
            } else {
                $before_title = sprintf( $before_title, 'ion-' . $icon );
            }
        }

        ob_start();

        echo $before_widget;

        if ( $title ) {
            echo $before_title . sprintf( '<a href="%s" class="image-gallery-link">%s</a>', Listify_WP_Job_Manager_Gallery::url(), $title ) . $after_title;
        }

        do_action( 'listify_widget_job_listing_gallery_slider_before' );
?>
    <div class="listing-gallery">
        <?php foreach ( $gallery as $item ) : ?>
        <?php $image = wp_get_attachment_image_src( $item, 'fullsize' ); ?>
        <?php $link = ( $job_preview || ! listify_theme_mod( 'gallery-comments', true ) ) ? $image[0] : get_attachment_link( $item ); ?>
        <div class="listing-gallery__item"><a href="<?php echo esc_url( $link ); ?>" class="listing-gallery__item-trigger">
            <?php echo wp_get_attachment_image( $item, 'large' ); ?>
        </a></div>
        <?php endforeach; ?>
    </div>

    <div class="listing-gallery-nav">
        <?php foreach ( $gallery as $item ) : ?>
        <div class="listing-gallery-nav__item">
            <div class="item__wrapper"><?php echo wp_get_attachment_image( $item, 'thumbnail' ); ?></div>
        </div>
        <?php endforeach; ?>
    </div>
<?php
        do_action( 'listify_widget_job_listing_gallery_slider_after' );

        echo $after_widget;

        $content = ob_get_clean();

        echo apply_filters( $this->widget_id, $content );

        $this->cache_widget( $args, $content );
    }
}
