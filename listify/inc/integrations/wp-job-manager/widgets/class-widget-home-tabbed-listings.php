<?php
/**
 * Home: Tabbed Listings
 *
 * @since Listify 1.0.0
 */
class Listify_Widget_Tabbed_Listings extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Display a tabbed layout of listing types', 'listify' );
        $this->widget_id          = 'listify_widget_tabbed_listings';
        $this->widget_name        = __( 'Listify - Page: Category Tabs', 'listify' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => 'What\'s New',
                'label' => __( 'Title:', 'listify' )
            ),
            'limit' => array(
                'type'  => 'number',
                'std'   => 3,
                'min'   => 3,
                'max'   => 30,
                'step'  => 3,
                'label' => __( 'Number per tab:', 'listify' )
            ),
            'featured' => array(
                'type' => 'checkbox',
                'std'  => 0,
                'label' => __( 'Use Featured listings', 'listify' )
            ),
            'terms' => array(
                'label' => __( 'Terms:', 'listify' ),
                'type' => 'multicheck',
                'std'  => '',
                'options' => $this->get_terms_simple( listify_get_top_level_taxonomy() )
            )
        );

        parent::__construct();
    }

    function widget( $args, $instance ) {
        if ( $this->get_cached_widget( $args ) ) {
            return;
		}

        $this->instance = $instance;

        extract( $args );

        $title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );
		$limit = isset( $instance[ 'limit' ] ) ? absint( $instance[ 'limit' ] ) : 3;
		$featured = isset( $instance[ 'featured' ] ) && 1 == $instance[ 'featured' ] ? true : null;
		$orderby = isset( $instance[ 'orderby' ] ) ? $instance[ 'orderby' ] : 'date';
		
		$terms = isset( $instance[ 'terms' ] ) ? maybe_unserialize( $instance[ 'terms' ] ) : false;

		$args = apply_filters( 'listify_mega_menu_list', array( 
			'include' => $terms
		) );

		if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
			$args[ 'lang' ] = apply_filters( 'wpml_current_language', NULL );
		} elseif ( function_exists( 'pll_current_language' ) ) {
			$args[ 'lang' ] = pll_current_language();
		}

		$terms = listify_get_terms( $args );

		if ( ! $terms ) {
			return;
		}

		$listings_by_term = $this->get_listings_by_term( $terms, $limit, $featured, $orderby );

        ob_start();

        echo $before_widget;

        if ( $title ) echo $before_title . $title . $after_title;
        ?>

        <ul class="tabbed-listings-tabs">
            <?php foreach ( $listings_by_term as $data ) : ?>
                <li><a href="#tab-<?php echo $data[ 'term' ]->term_id; ?>"><?php echo $data[ 'term' ]->name; ?></a></li>
            <?php endforeach; ?>

            <li><a href="<?php echo get_post_type_archive_link( 'job_listing' ); ?>"><?php _e( 'See More', 'listify' ); ?></a></li>
        </ul>

        <div class="tabbed-listings-tabs-wrapper">

            <?php foreach ( $listings_by_term as $data ) : ?>

            <div id="tab-<?php echo $data[ 'term' ]->term_id; ?>" class="listings-tab">

                <ul class="job_listings">
                    <?php while ( $data[ 'listings' ]->have_posts() ) : $data[ 'listings' ]->the_post(); ?>

                        <?php get_template_part( 'content', 'job_listing' ); ?>

                    <?php endwhile; ?>
                </ul>

            </div>

            <?php endforeach; ?>

        </div>

        <?php
        echo $after_widget;

        $content = ob_get_clean();

        echo apply_filters( $this->widget_id, $content );

        $this->cache_widget( $args, $content );
    }

	public function get_terms_simple() {
		$_terms = array();

		$terms = listify_get_terms();

		if ( empty( $terms ) || is_wp_error( $terms ) ) {
			return array();
		}

		foreach ( $terms as $term ) {
			$_terms[ $term->term_id ] = $term->name;
		}

		return $_terms;
	}

	/**
	 * Remove this dupe function
	 */
	public function get_listings_by_term( $terms, $limit, $featured, $orderby ) {
		foreach ( $terms as $term ) {
			$objects = get_objects_in_term( $term->term_id, 'job_listing_category', array( 'orderby' => $orderby ) );

			if ( empty( $objects ) ) {
				$objects = array(-1);
			}

			$_output[] = array(
				'term' => $term,
				'listings' => get_job_listings( array(
					'posts_per_page' => $limit,
					'featured' => $featured,
					'orderby' => $orderby,
					'no_found_rows' => true,
					'post__in' => $objects 
				) )
			);

		}

		return $_output;
	}
}
