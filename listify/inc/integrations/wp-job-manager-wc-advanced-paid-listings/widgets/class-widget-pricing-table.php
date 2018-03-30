<?php
/**
 * Job Listing: Social Profiles
 *
 * @since Listify 1.0.0
 */
class Listify_Widget_JWAPL_Pricing_Table extends Listify_Widget {

    /**
     * Constructor
     */
    public function __construct() {
        $this->widget_description = __( 'Display the pricing packages available for listings', 'listify' );
        $this->widget_id          = 'listify_widget_panel_wcpl_pricing_table';
        $this->widget_name        = __( 'Listify - Page: Pricing Table', 'listify' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Title:', 'listify' )
            ),
            'description' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Description:', 'listify' )
            )
        );
        parent::__construct();
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

        $packages = $this->get_packages();
		$count = count( $packages->posts );

		if ( $count > 3 ) {
			$count = 3;
		}

        if ( ! $packages->have_posts() ) {
            return;
        }

        $title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );
        $description = isset( $instance[ 'description' ] ) ? esc_attr( $instance[ 'description' ] ) : false;

        $after_title = '<h2 class="home-widget-description">' . $description . '</h2>' . $after_title;
        $layout = 'inline';

        ob_start();

        echo $before_widget;

        if ( $title ) echo $before_title . $title . $after_title;
        ?>

		<ul class="job-packages job-packages--count-<?php echo esc_attr( $count ); ?>">

        <?php while ( $packages->have_posts() ) : $packages->the_post(); $product = get_product( get_the_ID() ); ?>

            <?php $tags = $product->get_tags(); ?>

            <li class="job-package">
                <?php if ( $tags ) : ?>
                    <span class="job-package-tag"><span class="job-package-tag__text"><?php echo strip_tags( $tags ); ?></span></span>
                <?php endif; ?>

                <div class="job-package-header">
                    <div class="job-package-title">
                        <?php echo $product->get_title(); ?>
                    </div>
                    <div class="job-package-price">
                        <?php echo $product->get_price_html(); ?>
                    </div>
                </div>

                <div class="job-package-includes">
                    <?php
                        $content = $product->post->post_content;
                        $content = (array)explode( "\n", $content );
                    ?>
                    <ul>
                        <li><?php echo implode( '</li><li>', $content ); ?></li>
                    </ul>
                </div>

                <div class="job-package-purchase">
                    <a href="<?php echo $product->add_to_cart_url(); ?>" class="button"><?php _e( 'Get Started Now &rarr;', 'listify' ); ?></a>
                </div>
            </li>

        <?php endwhile; ?>

        </ul>

        <?php
        echo $after_widget;

        $content = ob_get_clean();

        echo apply_filters( $this->widget_id, $content );

        $this->cache_widget( $args, $content );
    }

    private function get_packages() {
		$args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
			'suppress_filters' => false,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => array( 'job_package', 'job_package_subscription' )
                )
            ),
            'meta_query' => array(
                array(
                    'key'     => '_visibility',
                    'value'   => array( 'visible', 'catalog' ),
                    'compare' => 'IN'
                ),
            ),
            'orderby' => 'menu_order',
            'order' => 'asc',
			'lang' => defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : substr( get_locale(), 0, 2 ),
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'no_found_rows' => true
		);

		if ( listify_has_integration( 'wp-job-manager-claim-listing' ) ) {
			$args[ 'meta_query' ][] = array(
				'key'     => '_use_for_claims',
				'value'   => 'yes',
				'compare' => '!=',
			);
		}

        $packages = new WP_Query( apply_filters( 'listify_pricing_table_packages', $args ) );

        return $packages;
    }
}
