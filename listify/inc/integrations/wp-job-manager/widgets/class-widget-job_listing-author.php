<?php
/**
 * Job Listing: Author
 *
 * @since Listify 1.0.0
 */
class Listify_Widget_Listing_Author extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Display the listing\'s author', 'listify' );

		// this is a typo that has to remain or widgets will be removed from sidebars
        $this->widget_id          = 'listify_widget_panel_listing_auhtor';

        $this->widget_name        = __( 'Listify - Listing: Author', 'listify' );
        $this->settings           = array(
            'descriptor' => array(
                'type'  => 'text',
                'std'   => 'Listing Owner',
                'label' => __( 'Descriptor:', 'listify' )
            ),
            'display-contact' => array(
                'type'  => 'checkbox',
                'std'   => 1,
                'label' => __( 'Display contact link', 'listify' )
			),
            'display-profile' => array(
                'type'  => 'checkbox',
                'std'   => 1,
                'label' => __( 'Display profile link', 'listify' )
			),
            'biography' => array(
                'type'  => 'checkbox',
                'std'   => 1,
                'label' => __( 'Display biography', 'listify' )
			),
			'image' => array(
				'type' => 'select',
				'std' => 'avatar',
				'label' => __( 'Owner Image', 'listify' ),
				'options' => array(
					'avatar' => __( 'Avatar', 'listify' ),
					'logo' => __( 'Company Logo', 'listify' )
				)
			)
        );

        parent::__construct();
    }

    function widget( $args, $instance ) {
        if ( $this->get_cached_widget( $args ) ) {
            return;
		}

		global $listify_job_manager;

		$post = get_post();

		if ( ! get_the_author_meta( 'ID' ) ) {
			return;
		}

        $descriptor = isset( $instance[ 'descriptor' ] ) ? esc_attr( $instance[ 'descriptor' ] ) : false;
        $image = isset( $instance[ 'image' ] ) && 'avatar' == $instance[ 'image' ] ? 'avatar' : 'logo';

        $biography = isset( $instance[ 'biography' ] ) && 1 == $instance[ 'biography' ] ? true : false;
        $contact = ! isset( $instance[ 'display-contact' ] ) || 1 == $instance[ 'display-contact' ] ? true : false;
        $profile = ! isset( $instance[ 'display-profile' ] ) || 1 == $instance[ 'display-profile' ] ? true : false;

        extract( $args );

        ob_start();

        echo $before_widget;
        ?>

        <div class="job_listing-author">
            <div class="job_listing-author-avatar">
				<?php
					if ( 'avatar' == $image ) :
						$image = $listify_job_manager->template->the_company_avatar( array(
							'size' => 'thumbnail',
							'listing' => $post,
							'style' => 'circle'
						) );
					else :
						$image = $listify_job_manager->template->the_company_logo( array(
							'size' => 'thumbnail',
							'listing' => $post,
							'style' => 'circle'
						) );
					endif;
				?>
            </div>

            <div class="job_listing-author-info">
                <h3 class="widget-title"><?php echo get_the_author_meta( 'first_name' ) ? get_the_author_meta( 'first_name' ) : get_the_author(); ?></h3>

                <small class="job_listing-author-descriptor"><?php echo $descriptor; ?></small>

                <?php if ( 'preview' != $post->post_status ) : ?>
                <div class="job_listing-author-info-more">
					<?php if ( $contact && class_exists( 'Private_Messages' ) ) : ?>
						<a href="<?php echo esc_url( pm_get_new_message_url( get_the_author_meta( 'ID' ), apply_filters( 'listify_private_message_default_subject', '' ), apply_filters( 'listify_private_message_default_message', '' ) ) ); ?>"><span class="ion-email"></span></a>
					<?php elseif ( $contact && $post->_application ) : ?>
						<a href="#job_listing-author-apply" data-mfp-src=".job_application" class="application_button button popup-trigger"><span class="ion-email"></span></a>

						<?php if ( ! is_position_filled() && $post->post_status == 'publish' ) get_job_manager_template( 'job-application.php' ); ?>
					<?php endif; ?>

                    <?php if ( $profile && 0 != $post->post_author ) : ?>
                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><span class="ion-information-circled"></span></a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <?php if ( $biography && $bio = get_the_author_meta( 'description', get_the_author_meta( 'ID' ) ) ) : ?>
                <div class="job_listing-author-biography">
                    <?php echo $bio; ?>
                </div>
            <?php endif; ?>

            <?php do_action( 'listify_widget_job_listing_author_after' ); ?>
        </div>

        <?php
        echo $after_widget;

        $content = ob_get_clean();

        echo apply_filters( $this->widget_id, $content );

        $this->cache_widget( $args, $content );
    }
}
